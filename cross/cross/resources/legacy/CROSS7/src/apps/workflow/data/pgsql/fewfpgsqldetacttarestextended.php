<?php
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeWFPgsqlDetacttarestExtended
{
 var $consult;
 var $objdb;
  function FeWFPgsqlDetacttarestExtended()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  function getByValicodigos($valicodigos)
  {
    $sql='SELECT * FROM "detacttarest" WHERE "valicodigos"=\''.$valicodigos.'\'';
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
} //End of Class Detacttarest
?>