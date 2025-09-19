<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeStPgsqlTipobodega
{
 var $consult;
 var $objdb;
  function FeStPgsqlTipobodega()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existTipobodega($tibocodigos)
  {
    $sql = 'SELECT * FROM "tipobodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addTipobodega($tibocodigos,$tibonombres,$tibodescrips)
  {   
    $sql='INSERT INTO "tipobodega" ("tibocodigos","tibonombres","tibodescrips")'
    .' VALUES(\''.$tibocodigos.'\',\''.$tibonombres.'\',\''.$tibodescrips.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateTipobodega($tibocodigos,$tibonombres,$tibodescrips)
  {
    $sql='UPDATE "tipobodega" SET "tibonombres"=\''.$tibonombres.'\',"tibodescrips"=\''.$tibodescrips.'\' WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteTipobodega($tibocodigos)
  {
    $sql='DELETE FROM "tipobodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdTipobodega($tibocodigos)
  {
    $sql='SELECT * FROM "tipobodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllTipobodega()
  {
    $sql='SELECT * FROM "tipobodega"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getTibocodigos($tibocodigos)
  {
    $sql='SELECT "tibocodigos" FROM "tipobodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getTibonombres($tibocodigos)
  {
    $sql='SELECT "tibonombres" FROM "tipobodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getTibodescrips($tibocodigos)
  {
    $sql='SELECT "tibodescrips" FROM "tipobodega" WHERE "tibocodigos"=\''.$tibocodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Tipobodega
?>