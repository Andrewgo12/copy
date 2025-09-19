<?php	
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlTipolocalizaExtended {
	var $consult;
	var $objdb;

	function FeGePgsqlTipolocalizaExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function addTipolocaliza($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados) {
		settype($sbDbNull, "string");
		settype($sbSql, "string");
			$sbDbNull = Application :: getConstant("DB_NULL");
			if ($tilocodpadrs && $tilocodpadrs!= $sbDbNull) {
				$tilocodpadrs = "'$tilocodpadrs'";
			}
			if ($tiloimagens && $tiloimagens!= $sbDbNull) {
				$tiloimagens = "'$tiloimagens'";
			}
		$sbSql = 'INSERT INTO "tipolocaliza" ("tilocodigos","tilonombres","tilodesc","tilocodpadrs","tiloimagens","tiloestados")'
		.' VALUES(\''.$tilocodigos.'\',\''.$tilonombres.'\',\''.$tilodesc.'\','.$tilocodpadrs.' ,'.$tiloimagens.' , \''.$tiloestados.'\')';
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	function updateTipolocaliza($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados) {
		$sql = 'UPDATE "tipolocaliza" SET "tilonombres"=\''.$tilonombres.'\',"tilodesc"=\''.$tilodesc.'\',"tilocodpadrs"='.$tilocodpadrs.' ,"tiloimagens"=\''.$tiloimagens.'\', "tiloestados"=\''.$tiloestados.'\' WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	function updateTipolocalizaSql($tilocodigos, $tilonombres, $tilodesc, $tilocodpadrs, $tiloimagens, $tiloestados) {
		settype($sbDbNull, "string");
		settype($sbSql, "string");
		$sbDbNull = Application :: getConstant("DB_NULL");
		if ($tilocodpadrs && $tilocodpadrs!= $sbDbNull) {
			$tilocodpadrs = "'$tilocodpadrs'";
		}
		if ($tiloimagens && $tiloimagens!= $sbDbNull) {
			$tiloimagens = "'$tiloimagens'";
		}
		$sbSql = 'UPDATE "tipolocaliza" SET "tilonombres"=\''.$tilonombres.'\',"tilodesc"=\''.$tilodesc.'\',"tilocodpadrs"='.$tilocodpadrs.' ,"tiloimagens"='.$tiloimagens.' , "tiloestados"=\''.$tiloestados.'\' WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		return $sbSql;
	}
	
	function TipolocalizaTrans($ircdata) {
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
	function updateTiloestadosSql($tilocodigos, $tiloestados) {
		$sbsql = 'UPDATE "tipolocaliza" SET "tiloestados"=\''.$tiloestados.'\'  WHERE "tilocodigos"=\''.$tilocodigos.'\'';
		return $sbsql;
	}
	function deleteTipolocalizaSql($sbTilocodigos) {
		settype($osbSql,"string");
		$osbSql = 'DELETE FROM "tipolocaliza" WHERE "tilocodigos"=\''.$sbTilocodigos.'\'';
		return $osbSql;
	}
	function getTipolocalizaByLocacodigos($sbLocacodigos){
		
		settype($sbSql,"string");
		settype($sbState,"string");
		
		$sbState = Application :: getConstant("REG_ACT");
		
		$sbSql = 'SELECT "tipolocaliza"."tilocodigos","tipolocaliza"."tilonombres" FROM "localizacion","tipolocaliza" ' .
				'WHERE "localizacion"."locacodigos"=\''.$sbLocacodigos.'\' AND "localizacion"."tilocodigos"="tipolocaliza"."tilocodpadrs" ' .
				'AND "tipolocaliza"."tiloestados"=\''.$sbState.'\'';
				
		$this->objdb->fncadoselect($sbSql,FETCH_NUM);
		return $this->objdb->rcresult;
	}
} //End of Class Tipolocaliza
?>