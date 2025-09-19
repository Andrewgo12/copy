<?php  		
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlLocalizacionExtended {
	var $consult;
	var $objdb;

	function FeGePgsqlLocalizacionExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene todas las localizaciones activas 
	* @return array 
	* @author freina <freina@parquesoft.com>
	* @date 02-Nov-2004 10:44
	* @location Cali-Colombia
	*/
	function getAllActiveLocations() {
		$sbestado = Application :: getConstant("REG_ACT");
		$sql = 'SELECT * FROM "localizacion" WHERE "locaestados"=\''.$sbestado.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function updateLocalizacionSql($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados) {
		settype($sbDbNull,"string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if($locacodpadrs && $locacodpadrs!=$sbDbNull){
			$locacodpadrs = "'$locacodpadrs'";
		}
		$sbsql = 'UPDATE "localizacion" SET "locanombres"=\''.$locanombres.'\',"locadescrips"=\''.$locadescrips.'\',"tilocodigos"=\''.$tilocodigos.'\',"locacodpadrs"='.$locacodpadrs.' ,"locaordenn"='.$locaordenn.' ,"locazonas"=\''.$locazonas.'\', "locaestados"=\''.$locaestados.'\'  WHERE "locacodigos"=\''.$locacodigos.'\'';
		return $sbsql;
	}
	function updatelocaestadosSql($locacodigos, $locaestados) {
		$sbsql = 'UPDATE "localizacion" SET "locaestados"=\''.$locaestados.'\'  WHERE "locacodigos"=\''.$locacodigos.'\'';
		return $sbsql;
	}
	function LocalizacionTrans($ircdata) {
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
	function addLocalizacion($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados) {
		settype($sbDbNull,"string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if($locacodpadrs && $locacodpadrs!=$sbDbNull){
			$locacodpadrs = "'$locacodpadrs'";
		}
		$sql = 'INSERT INTO "localizacion" ("locacodigos","locanombres","locadescrips","tilocodigos","locacodpadrs","locaordenn","locazonas","locaestados")'
		.' VALUES(\''.$locacodigos.'\',\''.$locanombres.'\',\''.$locadescrips.'\',\''.$tilocodigos.'\','.$locacodpadrs.' ,'.$locaordenn.' ,\''.$locazonas.'\', \''.$locaestados.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateLocalizacion($locacodigos, $locanombres, $locadescrips, $tilocodigos, $locacodpadrs, $locaordenn, $locazonas, $locaestados) {
		$sql = 'UPDATE "localizacion" SET "locanombres"=\''.$locanombres.'\',"locadescrips"=\''.$locadescrips.'\',"tilocodigos"=\''.$tilocodigos.'\',"locacodpadrs"='.$locacodpadrs.' ,"locaordenn"='.$locaordenn.' ,"locazonas"=\''.$locazonas.'\', "locaestados"=\''.$locaestados.'\'  WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta localizaciones
	* @param string $tilocodigos
	* @param string $locacodpadrs
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 10-nov-2004 16:44:00
	* @location Cali-Colombia
	*/
	function getLocalizaciones($tilocodigos, $locacodpadrs) {
		
		settype($sbwhere,"string");
		settype($sbestado,"string");
		
		$sbestado = Application :: getConstant("REG_ACT");
		
		if (is_array($tilocodigos)){
            $sbIn = "('".implode("','",$tilocodigos)."')";
			$sbwhere .= " AND \"tilocodigos\" IN $sbIn ";
        }
		if ($locacodpadrs)
			$sbwhere .= " AND \"locacodpadrs\"='$locacodpadrs' ";
		
		echo $sql = 'SELECT * FROM "localizacion" WHERE  "locaestados"=\''.$sbestado.'\' '.$sbwhere.' ORDER BY "locanombres"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Consulta las localizaciones para cargar combos
	* @param string $isbTilocodigos
	* @param string $isbLocacodpadrs
	* @return array
	* @author freina <freina@parquesoft.com>
	* @date 06-Jul-2005 13:00
	* @location Cali-Colombia
	*/
	function getLocation($isbTilocodigos, $isbLocacodpadrs) {
		
		settype($sbWhere,"string");
		settype($sbEstate,"string");
		settype($sbSql,"string");
		settype($sbIn,"string");
		
		$sbEstate = Application :: getConstant("REG_ACT");
		
		if (is_array($isbTilocodigos)){
            $sbIn = "('".implode("','",$isbTilocodigos)."')";
			$sbWhere .= " AND \"tilocodigos\" IN ".$sbIn." ";
        }
		if ($isbLocacodpadrs)
			$sbWhere .= " AND \"locacodpadrs\"='".$isbLocacodpadrs."' ";
		
		$sbSql = 'SELECT "locacodigos","locanombres" FROM "localizacion" WHERE  "locaestados"=\''.$sbEstate.'\' '.$sbWhere.' ORDER BY "locanombres"';
		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult;
	}
	function deleteLocalizacionSql($sbLocacodigos) {
		settype($osbSql,"string");
		$osbSql = 'DELETE FROM "localizacion" WHERE "locacodigos"=\''.$sbLocacodigos.'\'';
		return $osbSql;
	}
	
	function get2LevelsUpLocalizacion($locacodigos)
	{
		$sbSql = 'SELECT "C"."locanombres" as "hijo","B"."locanombres" as "padre","A"."locanombres" as "abuelo" FROM "localizacion" "A","localizacion" "B","localizacion" "C" ';
		$sbSql .= 'WHERE  "C"."locacodigos"=\''.$locacodigos.'\' AND "A"."locacodigos"="B"."locacodpadrs" AND "B"."locacodigos"="C"."locacodpadrs"';
		$this->objdb->fncadoselect($sbSql);
		return $this->objdb->rcresult;
	}
	
	function getTreeLocalization($iniType=false) {
		
		$sql = 'SELECT "tilonombres","localizacion".* '.
				'FROM "localizacion","tipolocaliza" '.
				'WHERE "localizacion"."tilocodigos"="tipolocaliza"."tilocodigos" ';
		if($iniType) {
			$sql .= 'AND "tipolocaliza"."tilocodigos">=\''.$iniType.'\' ';
		}
		$this->objdb->fncadoselect($sql,FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Localizacion
?>