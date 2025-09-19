<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeScPgsqlCategoria
{
 var $consult;
 var $objdb;
		
  function FeScPgsqlCategoria()
  {
    $config = ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existCategoria($catecodigon)
  {
    $sql = 'SELECT * FROM "categoria" WHERE "catecodigon"='.$catecodigon;
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addCategoria($catecodigon,$catenombres,$catedescris,$cateactivas)
  {   
    $sql='INSERT INTO "categoria" ("catecodigon","catenombres","catedescris") VALUES('.$catecodigon.',\''.$catenombres.'\',\''.$catedescris.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateCategoria($catecodigon,$catenombres,$catedescris,$cateactivas)
  {
    $sql='UPDATE "categoria" SET "catenombres"=\''.$catenombres.'\',"catedescris"=\''.$catedescris.'\' WHERE "catecodigon"='.$catecodigon;
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteCategoria($catecodigon)
  {
    $sql='DELETE FROM "categoria" WHERE "catecodigon"='.$catecodigon;
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdCategoria($catecodigon)
  {
    $sql='SELECT * FROM "categoria" WHERE "catecodigon"='.$catecodigon;
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllCategoria()
  {
    $sql='SELECT * FROM "categoria" ORDER BY "catenombres"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
} //End of Class Categoria
?>