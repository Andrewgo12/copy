<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeHrPgsqlEstadogrupo
{
 var $consult;
 var $objdb;
		
  function FeHrPgsqlEstadogrupo()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existEstadogrupo($esgrcodigos)
  {
    $sql = 'SELECT * FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addEstadogrupo($esgrcodigos,$esgrnombres,$esgrdescrips,$esgractivas)
  {   
    $sql='INSERT INTO "estadogrupo" ("esgrcodigos","esgrnombres","esgrdescrips","esgractivas")'
    .' VALUES(\''.$esgrcodigos.'\',\''.$esgrnombres.'\',\''.$esgrdescrips.'\',\''.$esgractivas.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateEstadogrupo($esgrcodigos,$esgrnombres,$esgrdescrips,$esgractivas)
  {
    $sql='UPDATE "estadogrupo" SET "esgrnombres"=\''.$esgrnombres.'\',"esgrdescrips"=\''.$esgrdescrips.'\',"esgractivas"=\''.$esgractivas.'\' WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteEstadogrupo($esgrcodigos)
  {
    $sql='DELETE FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdEstadogrupo($esgrcodigos)
  {
    $sql='SELECT * FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllEstadogrupo()
  {
    $sql='SELECT * FROM "estadogrupo"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getEsgrcodigos($esgrcodigos)
  {
    $sql='SELECT "esgrcodigos" FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEsgrnombres($esgrcodigos)
  {
    $sql='SELECT "esgrnombres" FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEsgrdescrips($esgrcodigos)
  {
    $sql='SELECT "esgrdescrips" FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEsgractivas($esgrcodigos)
  {
    $sql='SELECT "esgractivas" FROM "estadogrupo" WHERE "esgrcodigos"=\''.$esgrcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Estadogrupo
?>