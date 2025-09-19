<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeGePgsqlDetaconfarch
{
 var $consult;
 var $objdb;
  function FeGePgsqlDetaconfarch()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function existDetaconfarch($decocodigon)
  {
    $sql = 'SELECT * FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  function addDetaconfarch($decocodigon,$cogacodigos,$decodescris,$decolon_posn,$decotipos,$decoformats,$decovalinis,$decovalfins)
  {   
    $sql='INSERT INTO "detaconfarch" ("decocodigon","cogacodigos","decodescris","decolon_posn","decotipos","decoformats","decovalinis","decovalfins")'
    .' VALUES('.$decocodigon.' ,\''.$cogacodigos.'\',\''.$decodescris.'\','.$decolon_posn.',\''.$decotipos.'\',\''.$decoformats.'\',\''.$decovalinis.'\',\''.$decovalfins.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function updateDetaconfarch($decocodigon,$cogacodigos,$decodescris,$decolon_posn,$decotipos,$decoformats,$decovalinis,$decovalfins)
  {
    $sql='UPDATE "detaconfarch" SET "cogacodigos"=\''.$cogacodigos.'\',"decodescris"=\''.$decodescris.'\',decolon_pos='.$decolon_posn.',"decotipos"=\''.$decotipos.'\',"decoformats"=\''.$decoformats.'\',"decovalinis"=\''.$decovalinis.'\',"decovalfins"=\''.$decovalfins.'\' WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  function deleteDetaconfarch($decocodigon)
  {
    $sql='DELETE FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }
  function getByIdDetaconfarch($decocodigon)
  {
    $sql='SELECT * FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getAllDetaconfarch()
  {
    $sql='SELECT * FROM "detaconfarch"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  function getByDetaconfarch_fkey($cogacodigos)
  {
   $sql='SELECT * FROM "detaconfarch" WHERE "cogacodigos"=\''.$cogacodigos.'\'';
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }
  function getDecocodigon($decocodigon)
  {
    $sql='SELECT "decocodigon" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getCogacodigos($decocodigon)
  {
    $sql='SELECT "cogacodigos" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecodescris($decocodigon)
  {
    $sql='SELECT "decodescris" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecolon_posn($decocodigon)
  {
    $sql='SELECT "decolon_posn" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecotipos($decocodigon)
  {
    $sql='SELECT "decotipos" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecoformats($decocodigon)
  {
    $sql='SELECT "decoformats" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecovalinis($decocodigon)
  {
    $sql='SELECT "decovalinis" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
  function getDecovalfins($decocodigon)
  {
    $sql='SELECT "decovalfins" FROM "detaconfarch" WHERE "decocodigon"='.$decocodigon.' ';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Detaconfarch
?>