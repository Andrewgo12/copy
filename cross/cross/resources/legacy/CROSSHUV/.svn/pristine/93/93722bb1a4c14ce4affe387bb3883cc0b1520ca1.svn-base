<?php
		
/**
* @Copyright 2004 FullEngine
*
* Clase compuerta para la tabla $tabla
* @author Ingravity 0.0.8
* @location Cali - Colombia
*/
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FePrPgsqlCommands
{
 var $consult;
 var $objdb;
		
  function FePrPgsqlCommands()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existCommands($commnombres,$applcodigos)
  {
    $sql = 'SELECT * FROM "commands" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addCommands($commnombres,$applcodigos,$commobservas)
  {   
    $sql='INSERT INTO "commands" ("commnombres","applcodigos","commobservas")'
    .' VALUES(\''.$commnombres.'\',\''.$applcodigos.'\',\''.$commobservas.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateCommands($commnombres,$applcodigos,$commobservas)
  {
    $sql='UPDATE "commands" SET "commobservas"=\''.$commobservas.'\' WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteCommands($commnombres,$applcodigos)
  {
    $sql='DELETE FROM "commands" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdCommands($commnombres,$applcodigos)
  {
    $sql='SELECT * FROM "commands" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllCommands()
  {
    $sql='SELECT * FROM "commands"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getByCommands_fkey($applcodigos)
  {
   $sql='SELECT * FROM "commands" WHERE "applcodigos"=\''.$applcodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }

  function getCommnombres($commnombres,$applcodigos)
  {
    $sql='SELECT "commnombres" FROM "commands" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getApplcodigos($commnombres,$applcodigos)
  {
    $sql='SELECT "applcodigos" FROM "commands" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getCommobservas($commnombres,$applcodigos)
  {
    $sql='SELECT "commobservas" FROM "commands" WHERE "commnombres"=\''.$commnombres.'\' AND "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Commands
?>