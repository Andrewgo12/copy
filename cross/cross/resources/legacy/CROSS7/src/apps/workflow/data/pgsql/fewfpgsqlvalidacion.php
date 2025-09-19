<?php		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlValidacion
{
 var $consult;
 var $objdb;
  function FeWFPgsqlValidacion()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existValidacion($valicodigos)
  {
    $sql = 'SELECT * FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addValidacion($valicodigos,$proccodigos,$tarecodigos,$valiestacts,$valiestants,$validescrips)
  {   
    $sql='INSERT INTO "validacion" ("valicodigos","proccodigos","tarecodigos","valiestacts","valiestants","validescrips")'
    .' VALUES(\''.$valicodigos.'\',\''.$proccodigos.'\',\''.$tarecodigos.'\',\''.$valiestacts.'\',\''.$valiestants.'\',\''.$validescrips.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateValidacion($valicodigos,$proccodigos,$tarecodigos,$valiestacts,$valiestants,$validescrips)
  {
    $sql='UPDATE "validacion" SET "proccodigos"=\''.$proccodigos.'\',"tarecodigos"=\''.$tarecodigos.'\',"valiestacts"=\''.$valiestacts.'\',"valiestants"=\''.$valiestants.'\',"validescrips"=\''.$validescrips.'\' WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteValidacion($valicodigos)
  {
    $sql='DELETE FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdValidacion($valicodigos)
  {
    $sql='SELECT * FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllValidacion()
  {
    $sql='SELECT * FROM "validacion"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getValicodigos($valicodigos)
  {
    $sql='SELECT "valicodigos" FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getProccodigos($valicodigos)
  {
    $sql='SELECT "proccodigos" FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getTarecodigos($valicodigos)
  {
    $sql='SELECT "tarecodigos" FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getValiestacts($valicodigos)
  {
    $sql='SELECT "valiestacts" FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getValiestants($valicodigos)
  {
    $sql='SELECT "valiestants" FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getValidescrips($valicodigos)
  {
    $sql='SELECT "validescrips" FROM "validacion" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Validacion
?>