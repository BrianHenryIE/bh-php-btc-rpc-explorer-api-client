<?php

namespace BrianHenryIE\BtcRpcExplorer;

use BrianHenryIE\BtcRpcExplorer\Exceptions\BtcRpcExplorerException;
use BrianHenryIE\BtcRpcExplorer\JsonMapper\AssociativeArrayMiddleware;
use JsonMapper\Exception\BuilderException as JsonMapperBuilderException;
use JsonMapper\JsonMapperBuilder;
use JsonMapper\Handler\FactoryRegistry;
use JsonMapper\Handler\PropertyMapper;
use JsonMapper\Enums\TextNotation;
use JsonMapper\Middleware\CaseConversion;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use UnexpectedValueException;

abstract class AbstractApi
{
    protected const string API_ROOT = '/api';

    /**
     * Constructor
     *
     * @param RequestFactoryInterface $requestFactory PSR HTTP implementation.
     * @param StreamFactoryInterface $streamFactory PSR HTTP implementation.
     * @param ClientInterface $client PSR HTTP client for making requests.
     * @param string $explorerUrl The BTC RPC Explorer server URL.
     */
    public function __construct(
        protected RequestFactoryInterface $requestFactory,
        protected StreamFactoryInterface $streamFactory,
        protected ClientInterface $client,
        protected string $explorerUrl
    ) {
    }

    /**
     * Call arbitrary API endpoints and return `json_decode()`d `array`.
     *
     * Ideally, we would have every endpoint documented and typed, but this is to allow for others.
     *
     * @return array<mixed>
     */
    public function call(string $endpoint): array
    {
        /**
         * TODO: strip `$this->explorerUrl`, `self::API_ROOT` from `^\$endpoint`
         */
        /** @var array<mixed> */
        return $this->callApi($endpoint, 'array');
    }

    /**
     * Queries the API via PSR client and casts the value to an object.
     *
     * @template T of object
     * @param string $endpoint The REST route, excluding the domain.
     * @param class-string<T>|'string'|'int'|'float'|'array' $type The object type to cast/deserialize the response to, or primitive type.
     *
     * @return (
     *     $type is 'string' ? string :
     *     ($type is 'int' ? int :
     *     ($type is 'float' ? float :
     *     ($type is 'array' ? array<mixed> :
     *     (T|array<int, T>))))
     * )
     *
     * @throws ClientExceptionInterface PSR HTTP client exception.
     * @throws BtcRpcExplorerException
     * @throws JsonMapperBuilderException
     */
    protected function callApi(string $endpoint, string $type)
    {
        $request = $this->requestFactory->createRequest(
            'GET',
            "{$this->explorerUrl}" . self::API_ROOT . "{$endpoint}"
        );

        $response = $this->client->sendRequest($request);

        if (2 !== (int) ($response->getStatusCode() / 100)) {
            throw new UnexpectedValueException('API request failed with status code: ' . $response->getStatusCode());
        }

        $responseBody = (string) $response->getBody();

        // Handle primitive types
        if (in_array($type, ['string', 'int', 'float', 'array'])) {
            return match ($type) {
                'string' => trim($responseBody),
                'int' => (int)$responseBody,
                'float' => (float)$responseBody,
                default => json_decode($responseBody, true),
            };
        }

        if (! class_exists($type)) {
            throw new UnexpectedValueException("{$type} class does not exist");
        }

        $decoded = json_decode($responseBody, true);

        // Check is the response an error
        if (
            json_last_error() === JSON_ERROR_NONE
            && is_array($decoded)
            && isset($decoded['success'])
            && $decoded['success'] === false
            && isset($decoded['error'])
        ) {
            throw new BtcRpcExplorerException($responseBody, is_string($decoded['error']) ? $decoded['error'] : '');
        }

        $factoryRegistry = new FactoryRegistry();
        $mapper = JsonMapperBuilder::new()
                                    ->withPropertyMapper(new PropertyMapper($factoryRegistry))
                                    ->withAttributesMiddleware()
                                    ->withDocBlockAnnotationsMiddleware()
                                    ->withTypedPropertiesMiddleware()
                                    ->withNamespaceResolverMiddleware()
                                    ->withObjectConstructorMiddleware($factoryRegistry)
                                    ->build();

        $mapper->push(new CaseConversion(TextNotation::UNDERSCORE(), TextNotation::CAMEL_CASE()));
        $mapper->push(new AssociativeArrayMiddleware());

        // Check if the response is an array
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && isset($decoded[0])) {
            return $mapper->mapToClassArrayFromString($responseBody, $type);
        }

        return $mapper->mapToClassFromString($responseBody, $type);
    }
}
