<?php	
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeGePgsqlFormatoemail
{
 var $consult;
 var $objdb;
		
  function FeGePgsqlFormatoemail()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existFormatoemail($foemcodigos)
  {
    $sql = 'SELECT * FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addFormatoemail($foemcodigos,$foemnombres,$foemasuntos,$foemplantils,$foemestados)
  {   
    $sql='INSERT INTO "formatoemail" ("foemcodigos","foemnombres","foemasuntos","foemplantils")'
    .' VALUES(\''.$foemcodigos.'\',\''.$foemnombres.'\',\''.$foemasuntos.'\',\''.$foemplantils.'\')';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateFormatoemail($foemcodigos,$foemnombres,$foemasuntos,$foemplantils,$foemestados)
  {
    $sql='UPDATE "formatoemail" SET "foemnombres"=\''.$foemnombres.'\',"foemasuntos"=\''.$foemasuntos.'\',"foemplantils"=\''.$foemplantils.'\',"foemestados"=\''.$foemestados.'\' WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteFormatoemail($foemcodigos)
  {
    $sql='DELETE FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdFormatoemail($foemcodigos)
  {
    $sql='SELECT * FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllFormatoemail()
  {
    $sql='SELECT * FROM "formatoemail"';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getfoemcodigos($foemcodigos)
  {
    $sql='SELECT "foemcodigos" FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getfoemnombres($foemcodigos)
  {
    $sql='SELECT "foemnombres" FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getfoemasuntos($foemcodigos)
  {
    $sql='SELECT "foemasuntos" FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getfoemplantils($foemcodigos)
  {
    $sql='SELECT "foemplantils" FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getfoemestados($foemcodigos)
  {
    $sql='SELECT "foemestados" FROM "formatoemail" WHERE "foemcodigos"=\''.$foemcodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  
} //End of Class Formatoemail
?>