<?php

namespace BrianHenryIE\BtcRpcExplorer;

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
     * Queries the API via PSR client and casts the value to an object.
     *
     * @template T of object
     * @param string $endpoint The REST route, excluding the domain.
     * @param class-string<T>|string $type The object type to cast/deserialize the response to, or primitive type.
     *
     * @return T|array<T>|string|int|float|array
     *
     * @throws ClientExceptionInterface PSR HTTP client exception.
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
            if ($type === 'string') {
                return $responseBody;
            }
            if ($type === 'int') {
                return (int) $responseBody;
            }
            if ($type === 'float') {
                return (float) $responseBody;
            }
            if ($type === 'array') {
                return json_decode($responseBody, true);
            }
        }

        if (! class_exists($type)) {
            throw new UnexpectedValueException("{$type} class does not exist");
        }

        $factoryRegistry = new FactoryRegistry();
        $mapper = JsonMapperBuilder::new()
                                    ->withAttributesMiddleware()
                                    ->withObjectConstructorMiddleware($factoryRegistry)
                                    ->withPropertyMapper(new PropertyMapper($factoryRegistry))
                                    ->withTypedPropertiesMiddleware()
                                    ->withNamespaceResolverMiddleware()
                                    ->build();

        $mapper->push(new CaseConversion(TextNotation::UNDERSCORE(), TextNotation::CAMEL_CASE()));

        // Check if the response is an array
        $decoded = json_decode($responseBody, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && isset($decoded[0])) {
            return $mapper->mapToClassArrayFromString($responseBody, $type);
        }

        return $mapper->mapToClassFromString($responseBody, $type);
    }
}
