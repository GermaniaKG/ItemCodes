<?php
namespace Germania\Nav\ItemCodes;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class PdoItemCodes extends ItemCodes
{

    /**
     * @var string
     */
    public $table_name;

    /**
     * @var \PDO
     */
    public $pdo;

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @param \PDO   $pdo        PDO instance
     * @param string $table_name The table to work on
     */
    public function __construct( \PDO $pdo, $table_name, ItemCodeInterface $itemcode = null, LoggerInterface $logger = null )
    {
        $this->table_name = $table_name;
        $this->pdo = $pdo;
        $this->logger = $logger ?: new NullLogger;

        $sql = "SELECT
        -- This is the unique key
        code,
        -- and here the instance data
        code,
        name,
        enabled,
        display
        FROM {$this->table_name}
        WHERE 1";

        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode( \PDO::FETCH_CLASS, $itemcode ? get_class($itemcode) : ItemCode::class );
        $stmt->execute();

        $this->item_codes = $stmt->fetchAll( \PDO::FETCH_UNIQUE );

    }
}
