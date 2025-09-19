<?php 
include_once ("pkdatabases.php");
class FeWFPgsqlconsult {
	var $connection;
	var $consult;
	var $objdb;
	function FeWFPgsqlconsult() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getDatabyparams($table, $rcparams, $fields_view = null, $order_by = null) {
		
		settype($rcTmp, "array");
		settype($rcfields, "array");
		settype($rcTables, "array");
		settype($sbPos, "string");
		settype($sbTable, "string");
		
		if ($fields_view){
			$rcTmp = explode(",",$fields_view);
			foreach ($rcTmp as $fields) {
				//analiza si es tabla.campo
				$sbPos = strpos($fields, ".");
				if (!($sbPos === false)) {
					$fields = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $fields);
				} else {
					$fields = '"'.$fields.'"';
				}
				$rcfields[] = $fields; 
			}
			$fields_view = implode(",",$rcfields);
		}else{
			$fields_view = '*';
		}
			
		foreach ($rcparams as $fields => $value) {
			if ($value) {
				//analiza si es tabla.campo
				$sbPos = strpos($fields, ".");
				if (!($sbPos === false)) {
					$fields = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $fields);
				} else {
					$fields = '"'.$fields.'"';
				}
				$rcwhere[] = "$fields='$value'";
			}
		}
		
		
		if ($order_by){
			unset($rcfields);
			$rcTmp = explode(",",$order_by);
			foreach ($rcTmp as $fields) {
				//analiza si es tabla.campo
				$sbPos = strpos($fields, ".");
				if (!($sbPos === false)) {
					$fields = preg_replace("#((([a-z]|[0-9])*)\.(([a-z]|[0-9])*))#", '"$2"."$4"', $fields);
				} else {
					$fields = '"'.$fields.'"';
				}
				$rcfields[] = $fields; 
			}
			$order_by = implode(",",$rcfields);
		}
		
		
		if ($table){
			
			$rcTmp = explode(",",$table);
			foreach ($rcTmp as $sbTable) {
				$sbTable = '"'.$sbTable.'"';
				$rcTables[] = $sbTable; 
			}
			$table = implode(",",$rcTables);
		}
		
		
		if (is_array($rcwhere))
			$sql = 'SELECT '.$fields_view.' FROM '.$table.' WHERE '.implode(' AND ', $rcwhere);
		else
			$sql = 'SELECT '.$fields_view.' FROM '.$table;
		if ($order_by)
			$sql .= ' ORDER BY '.$order_by;
			
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>