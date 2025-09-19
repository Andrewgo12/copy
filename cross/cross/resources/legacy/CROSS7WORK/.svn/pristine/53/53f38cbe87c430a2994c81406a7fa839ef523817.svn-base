<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlUsuarentrada
{
 var $consult;
 var $objdb;
		
  function FeScPgsqlUsuarentrada()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existUsuarentrada($entrcodigon,$usenlogins)
  {
    $sql = 'SELECT * FROM "usuarentrada" WHERE "entrcodigon"='.$entrcodigon.' AND "usenlogins"=\''.$usenlogins.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addUsuarentrada($entrcodigon,$usenlogins)
  {   
    $sql='INSERT INTO "usuarentrada" VALUES('.$entrcodigon.',\''.$usenlogins.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteUsuarentrada($entrcodigon,$usenlogins)
  {
    $sql='DELETE FROM "usuarentrada" WHERE "entrcodigon"='.$entrcodigon.' AND "usenlogins"=\''.$usenlogins.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdUsuarentrada($entrcodigon,$usenlogins)
  {
    $sql='SELECT * FROM "usuarentrada" WHERE "entrcodigon"='.$entrcodigon.' AND "usenlogins"=\''.$usenlogins.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllUsuarentrada()
  {
    $sql='SELECT * FROM "usuarentrada"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
   function deleteAllUsuarentrada($entrcodigon)
  {
    $sql = 'DELETE FROM "usuarentrada" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoexecute($sql);
  }  
} //End of Class Usuarentrada
?>