<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlEntrada
{
 var $consult;
 var $objdb;
		
  function FeScPgsqlEntrada()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existEntrada($entrcodigon)
  {
    $sql = 'SELECT *  FROM "entrada" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addEntrada($entrcodigon,$entrusucreas,$entrfechorun,$entrduracion,$agprcodigos,$catecodigon,$entrdescris)
  {   
	$sql='INSERT INTO "entrada" ("entrcodigon","entrusucreas","entrfechorun","entrduracion","agprcodigos","catecodigon","entrdescris") VALUES('.$entrcodigon.',\''.$entrusucreas.'\','.$entrfechorun.','.$entrduracion.',\''.$agprcodigos.'\','.$catecodigon.',\''.$entrdescris.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateEntrada($entrcodigon,$entrusucreas,$entrfechorun,$entrduracion,$agprcodigos,$catecodigon,$entrdescris)
  {
    $sql='UPDATE "entrada" SET "entrfechorun"='.$entrfechorun.',"entrduracion"='.$entrduracion.',"agprcodigos"=\''.$agprcodigos.'\',"catecodigon"='.$catecodigon.',"entrdescris"=\''.$entrdescris.'\' WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteEntrada($entrcodigon)
  {
    $sql='DELETE FROM "entrada" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdEntrada($entrcodigon)
  {
    $sql='SELECT * FROM "entrada" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getByIdReferCross($entrcodigon)
  {
    $sql= 'SELECT * FROM "refercross" WHERE "entrcodigon"='.$entrcodigon;
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
	
  	function getAllEntrada()
  	{
		$sql='SELECT * FROM "entrada"';
	    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
	    return $this->objdb->rcresult;
	}
} //End of Class Entrada
?>