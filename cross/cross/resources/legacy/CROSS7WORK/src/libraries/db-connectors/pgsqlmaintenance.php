<?php
include_once("pkdatabases.php");
class maintenance{

    function maintenance(){
	    $config = &ASAP::getStaticProperty('Application','config');
	    $this->objdb = new databases();
	    $this->objdb->fncadoconn($config['database']);
    }
    
    function execute(){
		$sql = "VACUUM ANALYZE";
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			return false;
		else
			return true;
    }
}
?>