<?php
namespace tests;

use Daveismyname\SqlImport\Import;

trait NewDatabaseTestTrait
{


    // Only instantiate pdo once for test clean-up/fixture load
    static protected $pdo = null;



    /**
     * @return PDO
     */
    public function getPdo()
    {
        if (!static::$pdo):
        	static::$pdo = new \PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
        	static::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

	        if (!empty($GLOBALS['DB_DUMP'])):
	            $this->loadSqlDump( $GLOBALS['DB_DUMP'] );
	        endif;
      	
        endif;

        return static::$pdo;
    }


    /**
     * Drops all tables and loads SQL dump, if given.
     * 
     * @param  string $sql_dump Optional: SQL dump file
     * @return self
     */
    protected function resetDatabase( string $sql_dump = null )
    {
		$sql_dump = $sql_dump ?: ($GLOBALS['DB_DUMP'] ?? null);   	

    	$this->dropTables();
    	$this->loadSqlDump( $sql_dump );

		return $this;
    }




	/**
	 * Lodas an SQL Dump file
     * @param  string $sql_dump SQL dump file
     * @return self
	 */
	protected function loadSqlDump( string $sql_dump )
    {
		if (!is_readable( $sql_dump )):
			$msg = sprintf("SQL dump not readable: '%s'", $sql_dump);
			throw new \RuntimeException( $msg );
		endif;


		// Use external "Import" library
    	$dropTables = true;
    	$db_host = $GLOBALS['DB_HOST'] ?? "127.0.0.1";

		new Import($sql_dump, $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_DBNAME'], $db_host, $dropTables);

		return $this;
    }



    /**
     * Select all tables, loop through and delete/drop them.
    */
    protected function dropTables()
    {
    	$pdo = $this->getPdo();
        $tables = $pdo->query('SHOW TABLES');

        if ($tables != null) {
            foreach($tables->fetchAll(\PDO::FETCH_COLUMN) as $table) {
                //delete table
            	$sql = sprintf('DROP TABLE `%s`', $table);
            	$pdo->query( $sql );
            }
        }

        return $this;
    }


}
