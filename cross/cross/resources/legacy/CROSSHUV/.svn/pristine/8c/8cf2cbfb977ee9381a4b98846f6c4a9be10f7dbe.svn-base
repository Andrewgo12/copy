<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlDetaconfproc
{
 var $consult;
 var $objdb;
  function FeWFPgsqlDetaconfproc()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existDetaconfproc($coprcodigon,$cacocodigon)
  {
    $sql = 'SELECT * FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addDetaconfproc($coprcodigon,$cacocodigon,$decooperados,$decovalors)
  {   
    $sql='INSERT INTO "detaconfproc" ("coprcodigon","cacocodigon","decooperados","decovalors")'
    .' VALUES('.$coprcodigon.' ,'.$cacocodigon.' ,\''.$decooperados.'\',\''.$decovalors.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateDetaconfproc($coprcodigon,$cacocodigon,$decooperados,$decovalors)
  {
    $sql='UPDATE "detaconfproc" SET "decooperados"=\''.$decooperados.'\',"decovalors"=\''.$decovalors.'\' WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteDetaconfproc($coprcodigon,$cacocodigon)
  {
    $sql='DELETE FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdDetaconfproc($coprcodigon,$cacocodigon)
  {
    $sql='SELECT * FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllDetaconfproc()
  {
    $sql='SELECT * FROM "detaconfproc"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByDetaconfproc_fkey($coprcodigon)
  {
   $sql='SELECT * FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' ';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getByDetaconfproc_fkey1($cacocodigon)
  {
   $sql='SELECT * FROM "detaconfproc" WHERE "cacocodigon"='.$cacocodigon.' ';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getCoprcodigon($coprcodigon,$cacocodigon)
  {
    $sql='SELECT "coprcodigon" FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getCacocodigon($coprcodigon,$cacocodigon)
  {
    $sql='SELECT "cacocodigon" FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecooperados($coprcodigon,$cacocodigon)
  {
    $sql='SELECT "decooperados" FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecovalors($coprcodigon,$cacocodigon)
  {
    $sql='SELECT "decovalors" FROM "detaconfproc" WHERE "coprcodigon"='.$coprcodigon.' AND "cacocodigon"='.$cacocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Detaconfproc
?>