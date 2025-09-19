<?php 		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlCausaExtended {
	var $consult;
	var $objdb;

	function FeCrPgsqlCausaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function getAllActiveCausa($isbtiorcodigos,$isbevencodigos) {
		
		settype($sbstate,"string");
		settype($sbtmp,"string");
		settype($osbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		if($isbtiorcodigos){
			$sbtmp = " AND \"tiorcodigos\" ='".$isbtiorcodigos."'";
		}
		if($isbevencodigos){
			$sbtmp .= " AND \"evencodigos\" ='".$isbevencodigos."'";
		}
		$osbsql = 'SELECT * FROM "causa" WHERE "causactivas"=\''.$sbstate.'\''.$sbtmp;
		return $osbsql;
	}
	
	function getActiveCausa($isbtiorcodigos,$isbevencodigos,$isbcauscodigos) {
		
		settype($sbstate,"string");
		settype($sbtmp,"string");
		settype($sbsql,"string");
		
		$sbstate = Application :: getConstant("REG_ACT");
		if($isbtiorcodigos){
			$sbtmp = " AND \"tiorcodigos\" ='".$isbtiorcodigos."'";
		}
		if($isbevencodigos){
			$sbtmp .= " AND \"evencodigos\" ='".$isbevencodigos."'";
		}
		$sbsql = 'SELECT "causnombres" FROM "causa" WHERE "causactivas"=\''.$sbstate.'\' AND "causcodigos"=\''.$isbcauscodigos.'\''.$sbtmp;
		$this->objdb->fncadoselect($sbsql, FETCH_NUM);
		return $this->objdb->rcresult;
	}
} //End of Class Causa
?>