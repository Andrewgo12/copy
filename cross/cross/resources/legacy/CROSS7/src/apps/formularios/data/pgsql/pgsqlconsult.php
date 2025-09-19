<?php
include_once("pkdatabases.php");
class Pgsqlconsult {

 var $connection;
 var $consult;
 var $objdb;

    function Pgsqlconsult() 
    {
	    $config = &ASAP::getStaticProperty('Application','config');
	    $this->objdb = new databases();
	    $this->objdb->fncadoconn($config['database']);
    }
	function getDatabyparams($table,$rcparams,$fields_view=null,$order_by=null)
	{
		if(!$fields_view)
			$fields_view = '*';
		foreach($rcparams as $fields => $value)
		{
			if($value)
				$rcwhere[] = "$fields='$value'";
		}
		if(is_array($rcwhere))			
			$sql="SELECT $fields_view FROM $table WHERE ".implode(" AND ",$rcwhere);
			else
				$sql="SELECT $fields_view FROM $table";
		if($order_by)
			$sql .= " ORDER BY ".$order_by;
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}
    
}
?>