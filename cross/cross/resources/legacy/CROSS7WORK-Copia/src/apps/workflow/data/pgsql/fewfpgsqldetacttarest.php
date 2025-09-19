<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlDetacttarest
{
 var $consult;
 var $objdb;
  function FeWFPgsqlDetacttarest()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existDetacttarest($valicodigos,$acticodigos)
  {
    $sql = 'SELECT * FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addDetacttarest($valicodigos,$acticodigos)
  {   
    $sql='INSERT INTO "detacttarest" ("valicodigos","acticodigos")'
    .' VALUES(\''.$valicodigos.'\',\''.$acticodigos.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteDetacttarest($valicodigos,$acticodigos)
  {
    $sql='DELETE FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdDetacttarest($valicodigos,$acticodigos)
  {
    $sql='SELECT * FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllDetacttarest()
  {
    $sql='SELECT * FROM "detacttarest"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByDetacttarest_fkey($valicodigos)
  {
   $sql='SELECT * FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getByDetacttarest_fkey1($acticodigos)
  {
   $sql='SELECT * FROM "detacttarest" WHERE "acticodigos"=\''.$acticodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getValicodigos($valicodigos,$acticodigos)
  {
    $sql='SELECT "valicodigos" FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getActicodigos($valicodigos,$acticodigos)
  {
    $sql='SELECT "acticodigos" FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\' AND "acticodigos"=\''.$acticodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Detacttarest
?>