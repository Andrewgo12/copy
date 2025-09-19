<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeStPgsqlTiporecurso
{
 var $consult;
 var $objdb;
  function FeStPgsqlTiporecurso()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existTiporecurso($tirecodigos)
  {
    $sql = 'SELECT * FROM "tiporecurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addTiporecurso($tirecodigos,$tirenombres,$tiredescrips)
  {   
    $sql='INSERT INTO "tiporecurso" ("tirecodigos","tirenombres","tiredescrips")'
    .' VALUES(\''.$tirecodigos.'\',\''.$tirenombres.'\',\''.$tiredescrips.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateTiporecurso($tirecodigos,$tirenombres,$tiredescrips)
  {
    $sql='UPDATE "tiporecurso" SET "tirenombres"=\''.$tirenombres.'\',"tiredescrips"=\''.$tiredescrips.'\' WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteTiporecurso($tirecodigos)
  {
    $sql='DELETE FROM "tiporecurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdTiporecurso($tirecodigos)
  {
    $sql='SELECT * FROM "tiporecurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllTiporecurso()
  {
    $sql='SELECT * FROM "tiporecurso"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getTirecodigos($tirecodigos)
  {
    $sql='SELECT "tirecodigos" FROM "tiporecurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getTirenombres($tirecodigos)
  {
    $sql='SELECT "tirenombres" FROM "tiporecurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getTiredescrips($tirecodigos)
  {
    $sql='SELECT "tiredescrips" FROM "tiporecurso" WHERE "tirecodigos"=\''.$tirecodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Tiporecurso
?>