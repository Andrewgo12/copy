<?php
include_once("pkdatabases.php");
class FeWFPgsqlLstHelp {
	var $objdb;
    function FeWFPgsqlLstHelp() 
    {
	    $config = &ASAP::getStaticProperty('Application','config');
	    $this->objdb = new databases();
	    $this->objdb->fncadoconn($config['database']);
    }
    //Genera el sql
    function fncexecpage($table,$viewfields,$sborder='',$curr_page=1)
    {
    	if(!$table || !$viewfields)
    		return null;
    	if($sborder)
    		$sborder = "ORDER BY $sborder";
    	$sbsql = "Select $viewfields FROM $table $sborder";
    	return $this->objdb->fncadoCachePageExecute($sbsql,$curr_page);	
    }
}
?>