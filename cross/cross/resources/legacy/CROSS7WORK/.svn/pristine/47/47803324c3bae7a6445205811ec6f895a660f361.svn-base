<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlTemaExtended
{
 var $consult;
 var $objdb;
		
  function FeEnPgsqlTemaExtended()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existTema($temacodigon,$ejtecodigon)
  {
    $sql = "SELECT * FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addTema($temacodigon,$ejtecodigon,$temanombres,$temadescri)
  {   
    $sql="INSERT INTO tema VALUES($temacodigon,$ejtecodigon,'$temanombres','$temadescri')";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateTema($temacodigon,$ejtecodigon,$temanombres,$temadescri)
  {
    $sql="UPDATE tema SET temanombres='$temanombres',temadescri='$temadescri' WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteTema($temacodigon,$ejtecodigon)
  {
    $sql="DELETE FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdTema($temacodigon,$ejtecodigon)
  {
    $sql="SELECT * FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllTema()
  {
    $sql="SELECT * FROM tema";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getTemacodigon($temacodigon,$ejtecodigon)
  {
    $sql="SELECT temacodigon FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getEjtecodigon($temacodigon,$ejtecodigon)
  {
    $sql="SELECT ejtecodigon FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getTemanombres($temacodigon,$ejtecodigon)
  {
    $sql="SELECT temanombres FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getTemadescri($temacodigon,$ejtecodigon)
  {
    $sql="SELECT temadescri FROM tema WHERE temacodigon=$temacodigon AND ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getAllTemaByEje($ejtecodigon)
  {
    $sql="SELECT ejetematico.ejtecodigon,ejtenombres,temacodigon,temanombres,temadescri";
    $sql .=" FROM tema,ejetematico";
    $sql .=" WHERE tema.ejtecodigon = ejetematico.ejtecodigon";
    $sql .=" AND ejetematico.ejtecodigon=$ejtecodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getByIdTemaAll($temacodigon,$ejtecodigon)
  {
    $sql="SELECT ejetematico.ejtecodigon, ejtenombres, temacodigon, temanombres, temadescri";
    $sql .=" FROM tema, ejetematico";
    $sql .=" WHERE tema.ejtecodigon = ejetematico.ejtecodigon";
    $sql .=" AND ejetematico.ejtecodigon=$ejtecodigon";
    $sql .=" AND temacodigon=$temacodigon";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Tema
?>