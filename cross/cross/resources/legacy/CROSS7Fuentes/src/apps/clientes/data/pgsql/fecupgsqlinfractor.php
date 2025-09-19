<?php
		
//Paquete de conexion a bases de datos
include_once("pkdatabases.php");
class FeCuPgsqlInfractor
{
 var $consult;
 var $objdb;
		
  function FeCuPgsqlInfractor()
  {
    $config = &ASAP::getStaticProperty('Application','config');
    $this->objdb = new databases();
    $this->objdb->fncadoconn($config['database']);
  }
  
  function existInfractor($infrcodigos)
  {
    $sql = "SELECT * FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoexecute($sql);
    return $this->objdb->fncadorowcont();
  }
  
  function addInfractor($tiidcodigos,$infrcodigos,$ticlcodigos,$infrnombres,$infrrepreses,$infrlocalizs,$infrtelefons,$locacodigos,$infrnumfaxs,$infractivas)
  {   
    $sql="INSERT INTO infractor VALUES('$tiidcodigos','$infrcodigos','$ticlcodigos','$infrnombres','$infrrepreses','$infrlocalizs','$infrtelefons','$locacodigos','$infrnumfaxs')";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function updateInfractor($tiidcodigos,$infrcodigos,$ticlcodigos,$infrnombres,$infrrepreses,$infrlocalizs,$infrtelefons,$locacodigos,$infrnumfaxs,$infractivas)
  {
    $sql="UPDATE infractor SET tiidcodigos='$tiidcodigos',ticlcodigos='$ticlcodigos',infrnombres='$infrnombres',infrrepreses='$infrrepreses',infrlocalizs='$infrlocalizs',infrtelefons='$infrtelefons',locacodigos='$locacodigos',infrnumfaxs='$infrnumfaxs' WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else	
    	$this->consult = true;
  }
  
  function deleteInfractor($infrcodigos)
  {
    $sql="DELETE FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoexecute($sql);
    if(!$this->objdb->objresult)
    	$this->consult = false;
    else
    	$this->consult = true;
  }

  function getByIdInfractor($infrcodigos)
  {
    $sql="SELECT * FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }

  function getAllInfractor()
  {
    $sql="SELECT * FROM infractor";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }
  
  function getByInfractor_fkey($locacodigos)
  {
   $sql="SELECT * FROM infractor WHERE locacodigos='$locacodigos'";
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }

  function getByInfractor_fkey1($ticlcodigos)
  {
   $sql="SELECT * FROM infractor WHERE ticlcodigos='$ticlcodigos'";
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }

  function getByInfractor_fkey2($tiidcodigos)
  {
   $sql="SELECT * FROM infractor WHERE tiidcodigos='$tiidcodigos'";
   $this->objdb->fncadoselect($sql,FETCH_ASSOC);
   return $this->objdb->rcresult;
  }

  function getTiidcodigos($infrcodigos)
  {
    $sql="SELECT tiidcodigos FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfrcodigos($infrcodigos)
  {
    $sql="SELECT infrcodigos FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getTiclcodigos($infrcodigos)
  {
    $sql="SELECT ticlcodigos FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfrnombres($infrcodigos)
  {
    $sql="SELECT infrnombres FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfrrepreses($infrcodigos)
  {
    $sql="SELECT infrrepreses FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfrlocalizs($infrcodigos)
  {
    $sql="SELECT infrlocalizs FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfrtelefons($infrcodigos)
  {
    $sql="SELECT infrtelefons FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getLocacodigos($infrcodigos)
  {
    $sql="SELECT locacodigos FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfrnumfaxs($infrcodigos)
  {
    $sql="SELECT infrnumfaxs FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  function getInfractivas($infrcodigos)
  {
    $sql="SELECT infractivas FROM infractor WHERE infrcodigos='$infrcodigos'";
    $this->objdb->fncadoselect($sql,FETCH_ASSOC);
    return $this->objdb->rcresult;
  }  

  
} //End of Class Infractor
?>