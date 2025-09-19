<?php    
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeHrPgsqlGrupodetalleExtended {
	function FeHrPgsqlGrupodetalleExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	/**
	Copyright 2004 FullEngine
	 Elimina el detalle de personas de un grupo
	@param string $grupcodigon Codigo de grupo
	@return string $osbresult (Cadena con el sql) 
	@author freina <freina@parquesoft.com>
	@date 12-nov-2004 15:40
	@location Cali - Colombia
	*/
	function deleteGrupodetalleByGrupcodigon($grupcodigon) {

		settype($osbresult, "string");
		$osbresult = 'DELETE FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' ';
		return $osbresult;
	}

	/**
	Copyright 2004 FullEngine
	 Obtiene el detalle de personal de un grupo
	@param string $grupcodigon Codigo de grupo
	@return array  Matriz con la data del personal 
	@author freina<freina@parquesoft.com>
	@date 24-Nov-2004 12:07
	@location Cali - Colombia
	*/
	function getByGrupcodigon($grupcodigon) {
		$sql = 'SELECT ' .
						'"grupodetalle"."grupcodigon", ' .
						'"grupodetalle"."perscodigos",' .
						'"grupodetalle"."persrespons",' .
						'"personal"."persnombres"||\' \'||' .
						'COALESCE("personal"."persapell1s",\'\')||\' \'||' .
						'COALESCE("personal"."persapell2s",\'\') AS "persnombres"' .
					'FROM "grupodetalle","personal" ' .
					'WHERE ' .
						'"grupodetalle"."grupcodigon"=\''.$grupcodigon.'\' AND ' .
						'"grupodetalle"."perscodigos"="personal"."perscodigos"' .
					'ORDER BY "perscodigos"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function addSqlGrupodetalle($grupcodigon, $perscodigos, $persrespons) {
		$sbsql = 'INSERT INTO "grupodetalle" ("grupcodigon","perscodigos","persrespons")'
		.' VALUES('.$grupcodigon.' ,\''.$perscodigos.'\',\''.$persrespons.'\')';
		return $sbsql;
	}

	function getGrupodetalleByGrupcodigon($grupcodigon) {
		$sql = 'SELECT "perscodigos" FROM "grupodetalle" WHERE "grupcodigon"='.$grupcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
}
?>