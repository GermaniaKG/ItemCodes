<?php
namespace Germania\Nav\ItemCodes\Actions;

use Germania\Nav\ItemCodes\ItemCodeInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Inserts or updates existing ItemCode entry in the database,
 * using MySQL's REPLACE statement.
 */
class InsertOrUpdateItemCode
{

    /**
     * The database table to work with
     *
     * @var string
     */
    public $table = 'itemcodes';


    /**
     * @var PDOStatement
     */
    protected $stmt;

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var LoggerInterface
     */
    protected $logger;



    /**
     * @param \PDO                 $pdo    PDO instance
     * @param LoggerInterface|null $logger Optional: PSR3 Logger
     * @param string               $table  Optional: table name to work with.
     */
    public function __construct(\PDO $pdo, LoggerInterface $logger = null, $table = null)
    {
        $this->table = $table ?: $this->table;

        $this->pdo    = $pdo;
        $this->logger = $logger ?: new NullLogger;

        $sql = "REPLACE INTO {$this->table}
        (code, name)
        VALUES
        (:item_code, :item_name)";
        $this->stmt = $this->pdo->prepare($sql);
    }


    /**
     * @param  ItemCodeInterface $itemcode
     * @return int Number of affected rows, i.e. 2 on REPLACE, 1 on INSERT)
     */
    public function __invoke( ItemCodeInterface $itemcode  )
    {
        return $this->execute( $itemcode );
    }


    /**
     * @param  ItemCodeInterface $itemcode
     * @return int Number of affected rows, i.e. 2 on REPLACE, 1 on INSERT)
     */
    public function execute( ItemCodeInterface $itemcode )
    {
        $bool = $this->stmt->execute([
            ':item_code' => $itemcode->getCode(),
            ':item_name' => $itemcode->getName()
        ]);

        $this->logger->debug('Logged sales', [
            'item_code' => $itemcode->getCode(),
            'result'    => $bool,
            'count'     => $this->stmt->rowCount()
        ]);

        return $this->stmt->rowCount();
    }

}
