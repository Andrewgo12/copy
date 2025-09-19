<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlEstadoproces
{
 var $consult;
 var $objdb;
		
  function FeWFPgsqlEstadoproces()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existEstadoproces($esprcodigos)
  {
    $sql = 'SELECT * FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addEstadoproces($esprcodigos,$esprnombres,$esprdescrips,$espractivas)
  {   
    $sql='INSERT INTO "estadoproces" ("esprcodigos","esprnombres","esprdescrips","espractivas")'
    .' VALUES(\''.$esprcodigos.'\',\''.$esprnombres.'\',\''.$esprdescrips.'\',\''.$espractivas.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateEstadoproces($esprcodigos,$esprnombres,$esprdescrips,$espractivas)
  {
    $sql='UPDATE "estadoproces" SET "esprnombres"=\''.$esprnombres.'\',"esprdescrips"=\''.$esprdescrips.'\',"espractivas"=\''.$espractivas.'\' WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteEstadoproces($esprcodigos)
  {
    $sql='DELETE FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdEstadoproces($esprcodigos)
  {
    $sql='SELECT * FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllEstadoproces()
  {
    $sql='SELECT * FROM "estadoproces"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getEsprcodigos($esprcodigos)
  {
    $sql='SELECT "esprcodigos" FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEsprnombres($esprcodigos)
  {
    $sql='SELECT "esprnombres" FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEsprdescrips($esprcodigos)
  {
    $sql='SELECT "esprdescrips" FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEspractivas($esprcodigos)
  {
    $sql='SELECT "espractivas" FROM "estadoproces" WHERE "esprcodigos"=\''.$esprcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Estadoproces
?>