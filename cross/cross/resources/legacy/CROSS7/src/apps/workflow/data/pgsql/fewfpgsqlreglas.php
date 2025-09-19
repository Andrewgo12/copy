<?php		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlReglas
{
 var $consult;
 var $objdb;
		
  function FeWFPgsqlReglas()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existReglas($reglcodigos)
  {
    $sql = 'SELECT * FROM "reglas" WHERE "reglcodigos"=\''.$reglcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addReglas($reglcodigos,$regldescrips)
  {   
    $sql='INSERT INTO "reglas" ("reglcodigos","regldescrips")'
    .' VALUES(\''.$reglcodigos.'\',\''.$regldescrips.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateReglas($reglcodigos,$regldescrips)
  {
    $sql='UPDATE "reglas" SET "regldescrips"=\''.$regldescrips.'\' WHERE "reglcodigos"=\''.$reglcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteReglas($reglcodigos)
  {
    $sql='DELETE FROM "reglas" WHERE "reglcodigos"=\''.$reglcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdReglas($reglcodigos)
  {
    $sql='SELECT * FROM "reglas" WHERE "reglcodigos"=\''.$reglcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllReglas()
  {
    $sql='SELECT * FROM "reglas"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getReglcodigos($reglcodigos)
  {
    $sql='SELECT "reglcodigos" FROM "reglas" WHERE "reglcodigos"=\''.$reglcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getRegldescrips($reglcodigos)
  {
    $sql='SELECT "regldescrips" FROM "reglas" WHERE "reglcodigos"=\''.$reglcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Reglas
?>