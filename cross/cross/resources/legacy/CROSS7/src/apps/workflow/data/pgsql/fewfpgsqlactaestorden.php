<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlActaestorden
{
 var $connection;
 var $consult;
 var $objdb;
  function FeWFPgsqlActaestorden()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existActaestorden($acescodigos)
  {
    $sql = 'SELECT * FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addActaestorden($acescodigos,$actacodigos,$acesestrecis,$acesestentrs,$acesfechmovs)
  {   
    $sql='INSERT INTO "actaestorden" ("acescodigos","actacodigos","acesestrecis","acesestentrs","acesfechmovs")'
    .' VALUES(\''.$acescodigos.'\',\''.$actacodigos.'\',\''.$acesestrecis.'\',\''.$acesestentrs.'\',\''.$acesfechmovs.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateActaestorden($acescodigos,$actacodigos,$acesestrecis,$acesestentrs,$acesfechmovs)
  {
    $sql='UPDATE "actaestorden" SET "actacodigos"=\''.$actacodigos.'\',"acesestrecis"=\''.$acesestrecis.'\',"acesestentrs"=\''.$acesestentrs.'\',"acesfechmovs"=\''.$acesfechmovs.'\' WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteActaestorden($acescodigos)
  {
    $sql='DELETE FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdActaestorden($acescodigos)
  {
    $sql='SELECT * FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllActaestorden()
  {
    $sql='SELECT * FROM "actaestorden"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByActaestorden_fkey($actacodigos)
  {
   $sql='SELECT * FROM "actaestorden" WHERE "actacodigos"=\''.$actacodigos.'\'';
   $this->connection->fncadoselect($sql,FETCH_ASSOC);
   return $this->connection->rcresult;
  }
  function getAcescodigos($acescodigos)
  {
    $sql='SELECT "acescodigos" FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getActacodigos($acescodigos)
  {
    $sql='SELECT "actacodigos" FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getAcesestrecis($acescodigos)
  {
    $sql='SELECT "acesestrecis" FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getAcesestentrs($acescodigos)
  {
    $sql='SELECT "acesestentrs" FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getAcesfechmovs($acescodigos)
  {
    $sql='SELECT "acesfechmovs" FROM "actaestorden" WHERE "acescodigos"=\''.$acescodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
} //End of Class Actaestorden
?>