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
class FePrPgsqlApplications
{
 var $consult;
 var $objdb;
		
  function FePrPgsqlApplications()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existApplications($applcodigos)
  {
    $sql = 'SELECT * FROM "applications" WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addApplications($applcodigos,$applnombres,$applobservas)
  {   
    $sql='INSERT INTO "applications" ("applcodigos","applnombres","applobservas")'
    .' VALUES(\''.$applcodigos.'\',\''.$applnombres.'\',\''.$applobservas.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateApplications($applcodigos,$applnombres,$applobservas)
  {
    $sql='UPDATE "applications" SET "applnombres"=\''.$applnombres.'\',"applobservas"=\''.$applobservas.'\' WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteApplications($applcodigos)
  {
    $sql='DELETE FROM "applications" WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdApplications($applcodigos)
  {
    $sql='SELECT * FROM "applications" WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllApplications()
  {
    $sql='SELECT * FROM "applications"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getApplcodigos($applcodigos)
  {
    $sql='SELECT "applcodigos" FROM "applications" WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getApplnombres($applcodigos)
  {
    $sql='SELECT "applnombres" FROM "applications" WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getApplobservas($applcodigos)
  {
    $sql='SELECT "applobservas" FROM "applications" WHERE "applcodigos"=\''.$applcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Applications
?>