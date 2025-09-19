<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCrPgsqlActaempresaExtended {
	var $consult;
	var $objdb;
	function FeCrPgsqlActaempresaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function DetermineGroupRelatedProcess($acemusuars) {
		$sql = 'SELECT * FROM "actaempresa" WHERE "acemusuars"=\''.$acemusuars.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAactiveActividad($actanumeros) {
		$sbestado = Application :: getConstant("REG_ACT");
        $sql = 'SELECT '.
                    '"actividad"."acticodigos", '.
                    '"actividad"."actinombres" '.
                'FROM "acta", "actividad", "activitarea" '.
                'WHERE '.
                    '"acta"."actacodigos" = \''.$actanumeros.'\' AND '.
                    '"acta"."tarecodigos" = "activitarea"."tarecodigos" AND '.
                    '"activitarea"."acticodigos" = "actividad"."acticodigos" AND '.
                    '"actividad"."actiactivas" = \''.$sbestado.'\' '.
                'ORDER BY "actividad"."actinombres" asc ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getAllCompromiso() {
		$sbestado = Application :: getConstant("REG_ACT");
        $sql = 'SELECT "*" '.
                'FROM "compromiso" '.
                'WHERE "compactivos" = \''.$sbestado.'\' '.
                'ORDER BY "compdescris" asc ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getAllCompromisoActa($acta) {
		$sbestado = Application :: getConstant("REG_ACT");
        $sql = 'SELECT "*" '.
                'FROM "compromiso","acemcompromi" '.
                'WHERE "compromiso"."compcodigos"="acemcompromi"."compcodigos"'.
                ' AND "acemcodigos" = '.$acta.' '.
                ' AND "compactivos" = \''.$sbestado.'\' '.
                'ORDER BY "compdescris" asc ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function ActaempresaTrans($ircdata) {
		if (!$ircdata) {
			$this->consult = false;
		}
		$this->objdb->fncadoexecutetrans($ircdata);
		if (!$this->objdb->objresult) {
			$this->consult = false;
		} else {
			$this->consult = true;
		}
	}
	
	function getByActaempresa_fkey($actacodigos) {
		settype($sbEstate,"string");
		settype($sbSql,"string");
		$sbEstate = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "actaempresa" WHERE "actacodigos"=\''.$actacodigos
		.'\' AND "acemactivas"=\''.$sbEstate.'\'';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getActaempresaByActacodigos($isbActacodigos) {
		settype($sbEstate,"string");
		settype($sbSql,"string");
		$sbEstate = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "actaempresa" WHERE "actacodigos"=\''.$isbActacodigos.'\' AND "acemactivas"=\''.$sbEstate.'\' ORDER BY "acemfeccren"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function getSqlDeactivateActaempresa($isbAcemusumods,$isbAcemactivas,$isbAcemnumeros){
		
		settype($osbSql,"string");
		$osbSql = 'UPDATE "actaempresa" SET "acemusumods"=\''.$isbAcemusumods.'\',"acemactivas"=\''.$isbAcemactivas.'\' WHERE "acemnumeros"=\''.$isbAcemnumeros.'\'';
		return $osbSql; 
	}

	function getSqlDeactivateAndHideActaempresa($isbAcemusumods,$isbAcemactivas,$isbAcemnumeros){
		
		settype($osbSql,"string");
		$osbSql = 'DELETE FROM "actaempresa" WHERE "acemnumeros"=\''.$isbAcemnumeros.'\'';
		return $osbSql; 
	}
	
	function deleteSolutions($isbOrdenumeros){
		
		settype($osbSql,"string");
		$osbSql = 'UPDATE "ordenempresa" SET "oremsolucios"=NULL WHERE "ordenumeros" =\''.$isbOrdenumeros.'\'';
		return $osbSql; 
	}
	
	function deleteCommitments($isbAcemnumeros){
		
		settype($osbSql,"string");
		$active = Application :: getConstant("REG_ACT");
		$osbSql = 'DELETE FROM "acemcompromi" WHERE "acemcodigos"=\''.$isbAcemnumeros.'\'';
		return $osbSql; 
	}

	function reverseCommitment($isbAcemnumeros){
		
		settype($osbSql,"string");
		$active = Application :: getConstant("REG_ACT");
		$osbSql = 'UPDATE "acemcompromi" SET "acemnumeros"=NULL,"accoactivas"=\''.$active.'\',"accoobservas"=null WHERE "acemnumeros"=\''.$isbAcemnumeros.'\'';
		return $osbSql; 
	}

	function getCompromisosAtendidosByActa($acemnumeros) {
		$sbestado = Application :: getConstant("REG_ACT");
        $sql = 'SELECT "*" '.
                'FROM "compromiso","acemcompromi" '.
                'WHERE "compromiso"."compcodigos"="acemcompromi"."compcodigos"'.
                ' AND "acemcodigos" = '.$acemnumeros.' '.
                ' AND "accoactivas" <> \''.$sbestado.'\' '.
                'ORDER BY "compdescris" asc ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Actaempresa
?>