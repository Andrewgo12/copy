<?php		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlFunciones
{
 var $consult;
 var $objdb;
		
  function FeWFPgsqlFunciones()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existFunciones($reglcodigos,$funccodigos)
  {
    $sql = 'SELECT * FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addFunciones($reglcodigos,$funccodigos,$funcnombres,$funcdescrips)
  {   
    $sql='INSERT INTO "funciones" ("reglcodigos","funccodigos","funcnombres","funcdescrips")'
    .' VALUES(\''.$reglcodigos.'\',\''.$funccodigos.'\',\''.$funcnombres.'\',\''.$funcdescrips.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateFunciones($reglcodigos,$funccodigos,$funcnombres,$funcdescrips)
  {
    $sql='UPDATE "funciones" SET "funcnombres"=\''.$funcnombres.'\',"funcdescrips"=\''.$funcdescrips.'\' WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteFunciones($reglcodigos,$funccodigos)
  {
    $sql='DELETE FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdFunciones($reglcodigos,$funccodigos)
  {
    $sql='SELECT * FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllFunciones()
  {
    $sql='SELECT * FROM "funciones"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getByFunciones_fkey($reglcodigos)
  {
   $sql='SELECT * FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }

  function getReglcodigos($reglcodigos,$funccodigos)
  {
    $sql='SELECT "reglcodigos" FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getFunccodigos($reglcodigos,$funccodigos)
  {
    $sql='SELECT "funccodigos" FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getFuncnombres($reglcodigos,$funccodigos)
  {
    $sql='SELECT "funcnombres" FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getFuncdescrips($reglcodigos,$funccodigos)
  {
    $sql='SELECT "funcdescrips" FROM "funciones" WHERE "reglcodigos"=\''.$reglcodigos.'\' AND "funccodigos"=\''.$funccodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Funciones
?>