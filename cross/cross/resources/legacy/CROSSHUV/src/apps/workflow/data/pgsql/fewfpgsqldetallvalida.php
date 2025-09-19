<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlDetallvalida
{
 var $consult;
 var $objdb;
  function FeWFPgsqlDetallvalida()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existDetallvalida($valicodigos,$devacodigos)
  {
    $sql = 'SELECT * FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addDetallvalida($valicodigos,$devacodigos,$devanomcams,$devaoperados,$devavalors)
  {   
    $sql='INSERT INTO "detallvalida" ("valicodigos","devacodigos","devanomcams","devaoperados","devavalors")'
    .' VALUES(\''.$valicodigos.'\',\''.$devacodigos.'\',\''.$devanomcams.'\',\''.$devaoperados.'\',\''.$devavalors.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateDetallvalida($valicodigos,$devacodigos,$devanomcams,$devaoperados,$devavalors)
  {
    $sql='UPDATE "detallvalida" SET "devanomcams"=\''.$devanomcams.'\',"devaoperados"=\''.$devaoperados.'\',"devavalors"=\''.$devavalors.'\' WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteDetallvalida($valicodigos,$devacodigos)
  {
    $sql='DELETE FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdDetallvalida($valicodigos,$devacodigos)
  {
    $sql='SELECT * FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllDetallvalida()
  {
    $sql='SELECT * FROM "detallvalida"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByDetallvalida_fkey($valicodigos)
  {
   $sql='SELECT * FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getValicodigos($valicodigos,$devacodigos)
  {
    $sql='SELECT "valicodigos" FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDevacodigos($valicodigos,$devacodigos)
  {
    $sql='SELECT "devacodigos" FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDevanomcams($valicodigos,$devacodigos)
  {
    $sql='SELECT "devanomcams" FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDevaoperados($valicodigos,$devacodigos)
  {
    $sql='SELECT "devaoperados" FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDevavalors($valicodigos,$devacodigos)
  {
    $sql='SELECT "devavalors" FROM "detallvalida" WHERE "valicodigos"=\''.$valicodigos.'\' AND "devacodigos"=\''.$devacodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Detallvalida
?>