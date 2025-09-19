<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlRefercross
{
 var $consult;
 var $objdb;
		
  function FeScPgsqlRefercross()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function deleteAllRefercrossEntrada($entrcodigon)
  {
    $sql = 'DELETE FROM "refercross" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoexecute($sql);
  }  
  
  function existRefercross($recrcodigon)
  {
    $sql = 'SELECT * FROM "refercross" WHERE "recrcodigon"='.$recrcodigon;
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function existRefercrossEntrada($entrcodigon)
  {
    $sql = 'SELECT * FROM "refercross" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoselect($sql);
    return is_array($this->objdb->rcresult);
  }
  
    function getReferCrossByEntrada($entrcodigon)
    {
	  	$sql = 'SELECT *';
	  	$sql .= ' FROM "refercross"';
	  	$sql .= ' WHERE "entrcodigon"='.$entrcodigon;
	
	  	$this->objdb->fncadoselect($sql,FETCH_ASSOC);
	  	return $this->objdb->rcresult[0];
    }
  
  function addRefercross($entrcodigon,$recrcodigon,$ordenumexps,$ordenumeros,$actacodigos)
  {   
    $sql='INSERT INTO "refercross" ("entrcodigon","recrcodigon","ordenumexps","ordenumeros","actacodigos") VALUES('.$entrcodigon.','.$recrcodigon.',\''.$ordenumexps.'\',\''.$ordenumeros.'\',\''.$actacodigos.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
} //End of Class Usuarentrada
?>