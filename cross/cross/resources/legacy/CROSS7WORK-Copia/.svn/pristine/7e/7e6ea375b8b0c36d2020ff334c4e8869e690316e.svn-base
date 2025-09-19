<?php   
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlGrupoExtended {
	var $consult;
	var $objdb;
	function FeHrPgsqlGrupoExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Trae todos los grupos en donde un usuario es responsable
	* @param string $persocodigos 
	* @return array
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 06-nov-2004 11:12:20
	* @location Cali-Colombia
	*/
	function getGruposByPerscodigosResp($persocodigos) {
		//Trae los codigos de estado de grupo que se consideran inactivos
		$sbestado = Application :: getConstant("REG_ACT");
		if ($sbestado) {
			$sbwhere = "AND \"grupo\".\"grupactivos\"='$sbestado'";
		}
		$sql = 'SELECT
												"grupo"."grupcodigon",
												"grupo"."grupcodigos",
												"grupo"."grupnombres",
												"grupo"."esgrcodigos",
												"grupo"."grupfchainin",
												"grupo"."grupfchafinn",
												"grupo"."grupactivos"
											 FROM "grupo","grupodetalle" 
											 WHERE 
											 	"grupodetalle"."perscodigos"=\''.$persocodigos.'\' AND 
											 	"grupodetalle"."persrespons"=\'S\' AND 
											 	"grupodetalle"."grupcodigon"="grupo"."grupcodigon" '. 
											 	$sbwhere;
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* obtiene el sql de borrado de un grupo
	* @param string $grupcodigon (Cadena con el codigo del grupo) 
	* @return string $osbresult (Cadena con el sql)
	* @author freina <freina@parquesoft.com>
	* @date 12-nov-2004 15:32
	* @location Cali-Colombia
	*/
	function deleteGrupo($grupcodigon) {
		settype($osbresult, "string");
		$osbresult = 'DELETE FROM "grupo" WHERE "grupcodigon"='.$grupcodigon.' ';
		return $osbresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* realiza transacciones
	* @param array $ircdata (arreglo con los sql) 
	* @author freina <freina@parquesoft.com>
	* @date 12-nov-2004 15:47
	* @location Cali-Colombia
	*/
	function GrupoTrans($ircdata) {
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
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* valida si el codigo externo de un grupo ya existe
	* @param string $grupcodigos (Codigo externo del grupo) 
	* @author freina <freina@parquesoft.com>
	* @date 25-nov-2004 10:21
	* @location Cali-Colombia
	*/
	function existGrupo($grupcodigos) {
		$sql = 'SELECT * FROM "grupo" WHERE "grupcodigos"=\''.$grupcodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addSqlGrupo($grupcodigon, $grupcodigos, $grupnombres, $esgrcodigos, $grupfchainin, $grupfchafinn) {
		$sbsql = 'INSERT INTO "grupo" ("grupcodigon","grupcodigos","grupnombres","esgrcodigos","grupfchainin","grupfchafinn")'
		.' VALUES('.$grupcodigon.' ,\''.$grupcodigos.'\',\''.$grupnombres.'\',\''.$esgrcodigos.'\','.$grupfchainin.' ,'.$grupfchafinn.' )';
		return $sbsql;
	}

	function updateSqlGrupo($grupcodigon, $grupnombres, $esgrcodigos, $grupfchafinn) {
		$sbsql = 'UPDATE "grupo" SET "grupnombres"=\''.$grupnombres.'\',"esgrcodigos"=\''.$esgrcodigos.'\',"grupfchafinn"='.$grupfchafinn.' WHERE "grupcodigon"='.$grupcodigon.' ';
		return $sbsql;
	}
	
	function updateSqlDeactivateGroup($grupcodigon, $grupactivos) {
		$sbsql = 'UPDATE "grupo" SET "grupactivos"=\''.$grupactivos.'\' WHERE "grupcodigon"='.$grupcodigon.' ';
		return $sbsql;
	}
}
?>