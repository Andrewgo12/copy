<?php 
include_once ("pkdatabases.php");
class FeScPgsqlGrid {

	var $objdb;

	function FeScPgsqlGrid() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	//Genera el sql
	function fncexecpage($table, $viewfields='*', $sborder = '', $curr_page = 1,$numRows=20,$cache=true) {
		if (!$table || !$viewfields)
			return null;
		if ($sborder)
			$sborder = "ORDER BY $sborder";
		$sbsql = "SELECT $viewfields FROM $table $sborder";
		return $this->objdb->fncadoPageExecute($sbsql, $curr_page,$numRows,$cache);
	}

	function fncexecsql($sbsql, $sborder = '', $curr_page = 1, $numRows = 10,$cache=true) 
	{
		settype($rcTmp,"array");
		settype($sbPos,"string");
		settype($sbValue,"string");
		settype($sbIndex,"string");
		
		if ($sborder){
			$sbPos = strpos($sborder, '"');
			if($sbPos === false){
				$rcTmp = explode(",",$sborder);
				foreach ($rcTmp as $sbIndex =>$sbValue) {
					$sbPos = strpos($sbValue, ".");
					if (!($sbPos === false)) {
						$sbValue = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $sbValue);
					} else {
						$sbValue = '"'.$sbValue.'"';
					}
					$rcTmp[$sbIndex]=$sbValue;
				}
				$sborder = implode(",",$rcTmp);
			}
			$sbsql .= " ORDER BY $sborder";
		}
		
		return $this->objdb->fncadoPageExecute($sbsql, $curr_page, $numRows,$cache);
	}
}
?>