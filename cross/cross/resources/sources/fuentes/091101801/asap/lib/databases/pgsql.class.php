<?php
class pgsql{
	
    function pgsql(){
    	settype($sbDbNull,"string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if(defined("CLOB")==false)
			define("CLOB", $sbDbNull);
		$this->setRcLike();
	    return true;
    }
    
    function getLike($sbField,$sbValue){
    		$sbValue = addcslashes ($sbValue,"\\");
			return ' '.$sbField.' IlIKE \'%'.$sbValue.'%\' ';
    }
     
    function getRcLike(){
			return $this->rcType_to_Like;
    }
    
    function setRcLike(){
    	$this->rcType_to_Like=array("varchar","text","VARCHAR","TEXT");
    }
    
}
?>