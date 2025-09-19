<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlObjeto{
 var $consult;
 var $objdb;
		
  function FeEnPgsqlObjeto(){
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
    $this->sbReturn=false;
  }
  
	function setObjecodigon($nuObjecodigon){
		$this->nuObjecodigon = $nuObjecodigon;
	}
	
	function getResult(){
		return $this->rcResult; 
	}
	
	function setReturn($sbReturn){
		$this->sbReturn=$sbReturn;	
	}

  function getAllObjeto(){
  	settype($sbSql,"string");
    $sbSql='SELECT * FROM "objeto" ORDER BY "objeto"."objenombres"';
    $this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
    if($this->sbReturn){
    	return $this->objdb->rcresult;
    }else{
    	$this->rcResult = $this->objdb->rcresult;
    } 
  }
	
  function getByIdObjeto(){
	settype($sbSql,"string");
    $sbSql='SELECT * FROM "objeto" WHERE "objecodigon"='.$this->nuObjecodigon;
    $this->objdb->fncadoselect($sbSql,FETCH_ASSOC);
    $this->rcResult = $this->objdb->rcresult;
  }
  
} //End of Class Opcionrepues
?>