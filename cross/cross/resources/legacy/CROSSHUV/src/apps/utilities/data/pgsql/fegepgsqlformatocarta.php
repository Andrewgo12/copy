<?php	
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeGePgsqlFormatocarta
{
 var $consult;
 var $objdb;
		
  function FeGePgsqlFormatocarta()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existFormatocarta($focacodigos)
  {
    $sql = 'SELECT * FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addFormatocarta($focacodigos,$focanombres,$focaplantils,$focaestados)
  {   
    $sql='INSERT INTO "formatocarta" ("focacodigos","focanombres","focaplantils")'
    .' VALUES(\''.$focacodigos.'\',\''.$focanombres.'\',\''.$focaplantils.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateFormatocarta($focacodigos,$focanombres,$focaplantils,$focaestados)
  {
    $sql='UPDATE "formatocarta" SET "focanombres"=\''.$focanombres.'\',"focaplantils"=\''.$focaplantils.'\',"focaestados"=\''.$focaestados.'\' WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteFormatocarta($focacodigos)
  {
    $sql='DELETE FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdFormatocarta($focacodigos)
  {
    $sql='SELECT * FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllFormatocarta()
  {
    $sql='SELECT * FROM "formatocarta"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getFocacodigos($focacodigos)
  {
    $sql='SELECT "focacodigos" FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getFocanombres($focacodigos)
  {
    $sql='SELECT "focanombres" FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getFocaplantils($focacodigos)
  {
    $sql='SELECT "focaplantils" FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getFocaestados($focacodigos)
  {
    $sql='SELECT "focaestados" FROM "formatocarta" WHERE "focacodigos"=\''.$focacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Formatocarta
?>