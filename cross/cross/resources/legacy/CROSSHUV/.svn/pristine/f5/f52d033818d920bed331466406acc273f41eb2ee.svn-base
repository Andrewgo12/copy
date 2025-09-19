<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeCrPgsqlCompromiso
{
 var $consult;
 var $objdb;
		
  function FeCrPgsqlCompromiso()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existCompromiso($compcodigos)
  {
    $sql = "SELECT * FROM compromiso WHERE compcodigos='".$compcodigos."'";
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addCompromiso($compcodigos,$compdescris,$compactivos)
  {   
    $sql="INSERT INTO compromiso VALUES('$compcodigos','$compdescris','$compactivos')";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateCompromiso($compcodigos,$compdescris,$compactivos)
  {
    $sql="UPDATE compromiso SET compcodigos='".$compcodigos."',compdescris='".$compdescris."',compactivos='".$compactivos."' WHERE compcodigos='".$compcodigos."'";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteCompromiso($compcodigos)
  {
    $sql="DELETE FROM compromiso WHERE compcodigos='".$compcodigos."'";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdCompromiso($compcodigos)
  {
    $sql="SELECT * FROM compromiso WHERE compcodigos='".$compcodigos."'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getAllCompromiso() {
		$sbestado = Application :: getConstant("REG_ACT");
        $sql = 'SELECT * '.
                'FROM "compromiso" '.
                'WHERE "compactivos" = \''.$sbestado.'\' '.
                'ORDER BY "compdescris" asc ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getCompnombres($compcodigos) {
        $sql = 'SELECT "compdescris" '.
                'FROM "compromiso" '.
                'WHERE "compcodigos" = \''.$compcodigos.'\' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		$rcTmp = $this->objdb->rcresult;
		return $rcTmp[0]["compdescris"];
	}
  
} //End of Class Compromiso
?>