<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeCrPgsqlOrdenempresa
{
 var $consult;
 var $objdb;
  function FeCrPgsqlOrdenempresa()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existOrdenempresa($ordenumeros)
  {
    $sql = 'SELECT * FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function updateOrdenempresaSolucios($ordenumeros,$oremsolucios)
  {
    $sql='UPDATE "ordenempresa" SET "oremsolucios"=\''.$oremsolucios.'\' WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteOrdenempresa($ordenumeros)
  {
    $sql='DELETE FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdOrdenempresa($ordenumeros)
  {
    $sql='SELECT * FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByIdOrdenempresa2($ordenumeros)
  {
    $sql='SELECT "ordenempresa".*,"acta"."orgacodigos" FROM "ordenempresa","acta" WHERE "acta"."ordenumeros"="ordenempresa"."ordenumeros" AND "acta"."ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllOrdenempresa()
  {
    $sql='SELECT * FROM "ordenempresa"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByOrdenempresa_fkey($ordenumeros)
  {
   $sql='SELECT * FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getByOrdenempresa_fkey2($priocodigos)
  {
   $sql='SELECT * FROM "ordenempresa" WHERE "priocodigos"=\''.$priocodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getByOrdenempresa_fkey3($tiorcodigos)
  {
   $sql='SELECT * FROM "ordenempresa" WHERE "tiorcodigos"=\''.$tiorcodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getByOrdenempresa_fkey4($evencodigos)
  {
   $sql='SELECT * FROM "ordenempresa" WHERE "evencodigos"=\''.$evencodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getByOrdenempresa_fkey6($locacodigos)
  {
   $sql='SELECT * FROM "ordenempresa" WHERE "locacodigos"=\''.$locacodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getOrdenumeros($ordenumeros)
  {
    $sql='SELECT "ordenumeros" FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getPriocodigos($ordenumeros)
  {
    $sql='SELECT "priocodigos" FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getTiorcodigos($ordenumeros)
  {
    $sql='SELECT "tiorcodigos" FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getEvencodigos($ordenumeros)
  {
    $sql='SELECT "evencodigos" FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getCauscodigos($ordenumeros)
  {
    $sql='SELECT "causcodigos" FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getLocacodigos($ordenumeros)
  {
    $sql='SELECT "locacodigos" FROM "ordenempresa" WHERE "ordenumeros"=\''.$ordenumeros.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Ordenempresa
?>