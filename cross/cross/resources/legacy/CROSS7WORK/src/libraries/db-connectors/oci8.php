<?php
class oci8{
	
    function oci8(){
    	define("CLOB", "empty_clob()");
    	$this->setRcLike();
	    return true;
    }
    
    function getLike($sbField,$sbValue){
			return ' UPPER('.$sbField.') LIKE UPPER(\'%'.$sbValue.'%\') ';
    }
     
    function getRcLike(){
			return $this->rcType_to_Like;
    }
    
     function setRcLike(){
    	$this->rcType_to_Like=array("varchar2","VARCHAR2");
    }
}
?>