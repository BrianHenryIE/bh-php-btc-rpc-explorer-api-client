<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use DateTimeImmutable;
use DateTimeInterface;
use JsonMapper\Middleware\Attributes\MapFrom;
use RuntimeException;

/**
 * Block Details - comprehensive information about a Bitcoin block.
 *
 * A block is a collection of transactions bundled together and added to the blockchain.
 * Blocks are created approximately every 10 minutes through the mining process.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::blockWithHash()
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::blockWithHeight()
 */
readonly class BlockDetails
{
    /**
     * @param string $hash Block hash - unique 64-character hexadecimal identifier for this block, created by hashing the block header.
     * @param int $confirmations Confirmation count - number of blocks built on top of this block (higher = more secure).
     * @param int $height Block height - the number of blocks in the blockchain before this block (genesis block = height 0).
     * @param int $version Block version - protocol version number used to create this block.
     * @param string $versionHex Version in hexadecimal - the version field encoded as hex.
     * @param string $merkleRoot Merkle root - hash of all transactions in the block, organized in a Merkle tree structure.
     * @param int $time Block timestamp - Unix timestamp (seconds since Jan 1, 1970) when the miner created this block.
     * @param int $medianTime Median time past - median timestamp of the previous 11 blocks, used for time-based consensus rules.
     * @param int $nonce Nonce - number that miners increment while trying to find a valid block hash (proof-of-work).
     * @param string $bits Difficulty target - compact representation of the difficulty target that the block hash must be less than.
     * @param string $difficulty Mining difficulty - how hard it is to find a valid block hash (adjusts every 2016 blocks).
     * @param string $chainWork Cumulative chainwork - total computational work in the blockchain from genesis to this block (hex-encoded).
     * @param int $nTx Transaction count - number of transactions included in this block.
     * @param string $previousBlockHash Previous block hash - hash of the block that comes before this one in the chain.
     * @param string $nextBlockHash Next block hash - hash of the block that comes after this one in the chain.
     * @param int $strippedSize Stripped size - block size in bytes excluding witness data (used for pre-SegWit compatibility).
     * @param int $size Block size - total size in bytes including witness data.
     * @param int $weight Block weight - size metric where non-witness data counts 4x more than witness data.
     * @param string[] $tx Transaction IDs - array of txids for all transactions in this block.
     * @param CoinbaseTx|null $coinbaseTx Coinbase transaction - the first transaction that creates new bitcoin as miner reward.
     * @param string|null $totalFees Total fees - sum of all transaction fees collected by the miner (in BTC).
     * @param string|null $miner Mining entity - identifier of the mining pool or entity that mined this block.
     * @param string|null $subsidy Block subsidy - amount of newly created bitcoin awarded to the miner (halves every ~4 years).
     */
    public function __construct(
        public string $hash,
        public int $confirmations,
        public int $height,
        public int $version,
        public string $versionHex,
        #[MapFrom('merkleroot')]
        public string $merkleRoot,
        public int $time,
        #[MapFrom('mediantime')]
        public int $medianTime,
        public int $nonce,
        public string $bits,
        public string $difficulty,
        #[MapFrom('chainwork')]
        public string $chainWork,
        public int $nTx,
        #[MapFrom('previousblockhash')]
        public string $previousBlockHash,
        #[MapFrom('nextblockhash')]
        public string $nextBlockHash,
        #[MapFrom('strippedsize')]
        public int $strippedSize,
        public int $size,
        public int $weight,
        public array $tx,
        public ?CoinbaseTx $coinbaseTx,
        public ?string $totalFees,
        public ?string $miner,
        public ?string $subsidy,
    ) {
    }

    /**
     * Parse the Unix time to DateTimeInterface.
     *
     * Converts the Unix timestamp to a DateTimeImmutable object for easier date manipulation.
     *
     * @return DateTimeInterface The block time as a DateTimeImmutable object.
     * @throws RuntimeException If the timestamp cannot be parsed.
     */
    public function getTime(): DateTimeInterface
    {
        $result = DateTimeImmutable::createFromFormat('U', (string) $this->time);
        if ($result === false) {
            throw new RuntimeException('Failed to parse block time');
        }
        return $result;
    }

    /**
     * Parse the Unix medianTime to DateTimeInterface.
     *
     * Converts the median time past (median of previous 11 blocks) to a DateTimeImmutable object.
     *
     * @return DateTimeInterface The median time as a DateTimeImmutable object.
     * @throws RuntimeException If the timestamp cannot be parsed.
     */
    public function getMedianTime(): DateTimeInterface
    {
        $result = DateTimeImmutable::createFromFormat('U', (string) $this->medianTime);
        if ($result === false) {
            throw new RuntimeException('Failed to parse median time');
        }
        return $result;
    }
}
