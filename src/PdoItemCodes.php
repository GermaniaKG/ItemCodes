<?php
namespace Germania\Nav\ItemCodes;

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
     * @param \PDO   $pdo        PDO instance
     * @param string $table_name The table to work on
     */
    public function __construct( \PDO $pdo, $table_name, ItemCodeInterface $itemcode = null)
    {
        $this->table_name = $table_name;
        $this->pdo = $pdo;

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
