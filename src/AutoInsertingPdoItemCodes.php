<?php
namespace Germania\Nav\ItemCodes;

use Germania\Nav\ItemCodes\Actions\InsertOrUpdateItemCode;

class AutoInsertingPdoItemCodes extends PdoItemCodes
{
    public function push(ItemCodeInterface $itemcode)
    {
        $code = $itemcode->getCode();

        if (!$this->has($code)):
            $inserter = new InsertOrUpdateItemCode($this->pdo, $this->table_name, $this->logger);
	        $result = $inserter->execute($itemcode);
	        $this->logger->notice("Inserted missing Item code '{code}'", [
                'code' => $code,
                'result' => $result
            ]);
        endif;

        return parent::push($itemcode);
    }


    /**
     * Alias for autoGet()
     *
     * @param  string $itemcode_str Item code string
     * @return ItemCode
     */
    public function get($itemcode_str)
    {
        // Grab Item code instance from container:
        if ($this->has($itemcode_str)):
            return parent::get($itemcode_str); 
           endif;

        // So its missing in the database:
        // create new Instance and push it to the container.
        $itemcode = new ItemCode;
    	$itemcode->setCode($itemcode_str)->setName($itemcode_str);
    	$this->push($itemcode);
    	return $itemcode;
    }
}
