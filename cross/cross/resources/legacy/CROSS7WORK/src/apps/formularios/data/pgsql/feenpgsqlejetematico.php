<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlEjetematico
{
 var $consult;
 var $objdb;
		
  function FeEnPgsqlEjetematico()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existEjetematico($ejtecodigon)
  {
    $sql = 'SELECT * FROM "ejetematico" WHERE "ejtecodigon"=\''.$ejtecodigon.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addEjetematico($ejtecodigon,$ejtenombres,$ejtedescrips)
  {   
    $sql='INSERT INTO "ejetematico" VALUES(\''.$ejtecodigon.'\',\''.$ejtenombres.'\',\''.$ejtedescrips.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateEjetematico($ejtecodigon,$ejtenombres,$ejtedescrips)
  {
    $sql='UPDATE "ejetematico" SET "ejtenombres"=\''.$ejtenombres.'\',"ejtedescrips"=\''.$ejtedescrips.'\' WHERE "ejtecodigon"=\''.$ejtecodigon.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteEjetematico($ejtecodigon)
  {
    $sql='DELETE FROM "ejetematico" WHERE "ejtecodigon"=\''.$ejtecodigon.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdEjetematico($ejtecodigon)
  {
    $sql='SELECT * FROM "ejetematico" WHERE "ejtecodigon"=\''.$ejtecodigon.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllEjetematico()
  {
    $sql='SELECT * FROM "ejetematico"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  

} //End of Class Ejetematico
?>