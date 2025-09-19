<?php 	
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlDetaconfarchExtended {
	var $consult;
	var $objdb;
	function FeGePgsqlDetaconfarchExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	function getByCogacodigos($cogacodigos) {
		$sql = 'SELECT * FROM "detaconfarch" WHERE "cogacodigos"=\''.$cogacodigos.'\' ORDER BY "decocodigon"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function addDetaconfarchSql($decocodigon, $cogacodigos, $decodescris, $decolon_posn, $decotipos, $decoformats, $decovalinis, $decovalfins) {
		$sbsql = 'INSERT INTO "detaconfarch" ("decocodigon","cogacodigos","decodescris","decolon_posn","decotipos","decoformats","decovalinis","decovalfins")'
		.' VALUES('.$decocodigon.' ,\''.$cogacodigos.'\',\''.$decodescris.'\','.$decolon_posn.' ,\''.$decotipos.'\',\''.$decoformats.'\',\''.$decovalinis.'\',\''.$decovalfins.'\')';
		return $sbsql;
	}
	function deleteDetaconfarchSql($cogacodigos) {
		$sbsql = 'DELETE FROM "detaconfarch" WHERE "cogacodigos"='.$cogacodigos.' ';
		return $sbsql;
	}
} //End of Class Detaconfarch
?>