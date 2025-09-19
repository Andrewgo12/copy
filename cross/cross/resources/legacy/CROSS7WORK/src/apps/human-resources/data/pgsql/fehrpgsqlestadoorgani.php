<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeHrPgsqlEstadoorgani
{
 var $consult;
 var $objdb;
  function FeHrPgsqlEstadoorgani()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existEstadoorgani($esorcodigos)
  {
    $sql = 'SELECT * FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addEstadoorgani($esorcodigos,$esornombres,$esordescrips,$esoractivas)
  {   
    $sql='INSERT INTO "estadoorgani" ("esorcodigos","esornombres","esordescrips","esoractivas")'
    .' VALUES(\''.$esorcodigos.'\',\''.$esornombres.'\',\''.$esordescrips.'\',\''.$esoractivas.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateEstadoorgani($esorcodigos,$esornombres,$esordescrips,$esoractivas)
  {
    $sql='UPDATE "estadoorgani" SET "esornombres"=\''.$esornombres.'\',"esordescrips"=\''.$esordescrips.'\',"esoractivas"=\''.$esoractivas.'\' WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteEstadoorgani($esorcodigos)
  {
    $sql='DELETE FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdEstadoorgani($esorcodigos)
  {
    $sql='SELECT * FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllEstadoorgani()
  {
    $sql='SELECT * FROM "estadoorgani"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getEsorcodigos($esorcodigos)
  {
    $sql='SELECT "esorcodigos" FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getEsornombres($esorcodigos)
  {
    $sql='SELECT "esornombres" FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getEsordescrips($esorcodigos)
  {
    $sql='SELECT "esordescrips" FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getEsoractivas($esorcodigos)
  {
    $sql='SELECT "esoractivas" FROM "estadoorgani" WHERE "esorcodigos"=\''.$esorcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Estadoorgani
?>