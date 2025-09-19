<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeEnPgsqlPreguntaExtended
{
 var $consult;
 var $objdb;
		
  function FeEnPgsqlPreguntaExtended()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existPregunta($pregcodigon)
  {
    $sql = 'SELECT * FROM "pregunta" WHERE "pregcodigon"=\''.$pregcodigon.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addPregunta($pregcodigon,$morecodigon,$pregpadren,$pregdescris,$temacodigon)
  {   
    $sql='INSERT INTO "pregunta" VALUES(\''.$pregcodigon.'\',\''.$morecodigon.'\',\''.$pregpadren.'\',\''.$pregdescris.'\',\''.$temacodigon.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updatePregunta($pregcodigon,$morecodigon,$pregpadren,$pregdescris,$temacodigon)
  {
    $sql='UPDATE "pregunta" SET "pregdescris"=\''.$pregdescris.'\',"morecodigon"=\''.$morecodigon.'\' WHERE "pregcodigon"=\''.$pregcodigon.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deletePregunta($pregcodigon)
  {
    $sql='DELETE FROM "pregunta" WHERE "pregcodigon"=\''.$pregcodigon.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdPregunta($pregcodigon)
  {
    $sql='SELECT * FROM "pregunta" WHERE "pregcodigon"=\''.$pregcodigon.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllPregunta()
  {
    $sql='SELECT * FROM "pregunta"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getDataPreguntasAgrupadas()
  {
    $sql='SELECT "ejtenombres","temanombres","pregcodigon","pregdescris" FROM "ejetematico","tema","pregunta" WHERE "ejetematico"."ejtecodigon"="tema"."ejtecodigon" AND "tema"."temacodigon"="pregunta"."temacodigon"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  

  function getPreguntaByEjetematico($ejtecodigon)
  {
    $sql='SELECT * FROM "pregunta","tema","ejetematico"';
    $sql .=' WHERE "pregunta"."temacodigon" = "tema"."temacodigon"';
    $sql .=' AND "tema"."ejtecodigon" = "ejetematico"."ejtecodigon"';
    $sql .=' AND "ejetematico"."ejtecodigon"=\''.$ejtecodigon.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getPreguntaCompleta($pregcodigon)
  {
    $sql='SELECT "ejetematico"."ejtecodigon","ejtenombres","tema"."temacodigon","temanombres","pregcodigon","pregpadren","pregdescris"';
    $sql .=' FROM "ejetematico","tema","pregunta"';
    $sql .=' WHERE "pregunta"."temacodigon" = "tema"."temacodigon"';
    $sql .=' AND "tema"."ejtecodigon" = "ejetematico"."ejtecodigon"';
    $sql .=' AND "pregunta"."pregcodigon" = \''.$pregcodigon.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

    function getPreguntaByTema($temacodigon)
  {
    $sql='SELECT * FROM "pregunta" WHERE "temacodigon"=\''.$temacodigon.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Pregunta
?>