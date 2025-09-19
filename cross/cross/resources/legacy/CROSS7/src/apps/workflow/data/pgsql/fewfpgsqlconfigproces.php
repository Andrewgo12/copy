<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlConfigproces
{
 var $consult;
 var $objdb;
  function FeWFPgsqlConfigproces()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existConfigproces($coprcodigon)
  {
    $sql = 'SELECT * FROM "configproces" WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addConfigproces($coprcodigon,$coprnombres,$proccodigos)
  {   
    $sql='INSERT INTO "configproces" ("coprcodigon","coprnombres","proccodigos")'
    .' VALUES('.$coprcodigon.' ,\''.$coprnombres.'\',\''.$proccodigos.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateConfigproces($coprcodigon,$coprnombres,$proccodigos)
  {
    $sql='UPDATE "configproces" SET "coprnombres"=\''.$coprnombres.'\',"proccodigos"=\''.$proccodigos.'\' WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteConfigproces($coprcodigon)
  {
    $sql='DELETE FROM "configproces" WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdConfigproces($coprcodigon)
  {
    $sql='SELECT * FROM "configproces" WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllConfigproces()
  {
    $sql='SELECT * FROM "configproces"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getCoprcodigon($coprcodigon)
  {
    $sql='SELECT "coprcodigon" FROM "configproces" WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getCoprnombres($coprcodigon)
  {
    $sql='SELECT "coprnombres" FROM "configproces" WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getProccodigos($coprcodigon)
  {
    $sql='SELECT "proccodigos" FROM "configproces" WHERE "coprcodigon"='.$coprcodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Configproces
?>