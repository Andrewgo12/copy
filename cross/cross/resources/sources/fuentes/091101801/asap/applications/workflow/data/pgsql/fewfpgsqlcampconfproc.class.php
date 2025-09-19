<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlCampconfproc
{
 var $consult;
 var $objdb;
  function FeWFPgsqlCampconfproc()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existCampconfproc($cacocodigon)
  {
    $sql = 'SELECT * FROM "campconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addCampconfproc($cacocodigon,$caconombres,$cacoprocedes)
  {   
    $sql='INSERT INTO "campconfproc" ("cacocodigon","caconombres","cacoprocedes")'
    .' VALUES('.$cacocodigon.' ,\''.$caconombres.'\',\''.$cacoprocedes.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateCampconfproc($cacocodigon,$caconombres,$cacoprocedes)
  {
    $sql='UPDATE "campconfproc" SET "caconombres"=\''.$caconombres.'\',"cacoprocedes"=\''.$cacoprocedes.'\' WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteCampconfproc($cacocodigon)
  {
    $sql='DELETE FROM "campconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdCampconfproc($cacocodigon)
  {
    $sql='SELECT * FROM "campconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllCampconfproc()
  {
    $sql='SELECT * FROM "campconfproc"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getCacocodigon($cacocodigon)
  {
    $sql='SELECT "cacocodigon" FROM "campconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getCaconombres($cacocodigon)
  {
    $sql='SELECT "caconombres" FROM "campconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getCacoprocedes($cacocodigon)
  {
    $sql='SELECT "cacoprocedes" FROM "campconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Campconfproc
?>