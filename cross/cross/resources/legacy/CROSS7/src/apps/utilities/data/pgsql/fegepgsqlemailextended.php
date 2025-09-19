<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeGePgsqlEmailExtended {
	var $consult;
	var $objdb;

	function FeGePgsqlEmailExtended() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function addEmailSql($emaicodigos, $ordenumeros, $foemcodigos, $orgacodigos, $emaiparas, $emaidesdes, $emaiasuntos, $emaitextos, $emaiestados, $usuacodigos, $emaifecregn, $emaifecenvn, $emaiadjuntos) {
		$sbsql = 'INSERT INTO "email" ("emaicodigos","ordenumeros","foemcodigos","orgacodigos","emaiparas","emaidesdes","emaiasuntos","emaitextos","emaiestados","usuacodigos","emaifecregn","emaifecenvn","emaiadjuntos")'
		.' VALUES(\''.$emaicodigos.'\',\''.$ordenumeros.'\',\''.$foemcodigos.'\',\''.$orgacodigos.'\',\''.$emaiparas.'\',\''.$emaidesdes.'\',\''.$emaiasuntos.'\',\''.$emaitextos.'\',\''.$emaiestados.'\',\''.$usuacodigos.'\','.$emaifecregn.' ,'.$emaifecenvn.' ,\''.$emaiadjuntos.'\')';
		return $sbsql;
	}
	
	function getByIdEmailIn($ircemaicodigos) {
		
		settype($sbtmp,"string");
		settype($sbsql,"string");
		
		$sbtmp = implode("','",$ircemaicodigos);
		$sbsql = 'SELECT * FROM "email" WHERE "emaicodigos" IN (\''.$sbtmp.'\')';
		$this->objdb->fncadoselect($sbsql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	
	function updateEmailEmaiestadosById($emaicodigos, $emaiestados,$emaifecenvn=0) {
		if($emaifecenvn){
			$sbtmp = " ,\"emaifecenvn\"=$emaifecenvn";
		}
		$sbsql = 'UPDATE "email" SET "emaiestados"=\''.$emaiestados.'\''.$sbtmp.'  WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		$this->objdb->fncadoexecute($sbsql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	
	function deleteEmailSql($emaicodigos) {
		$sbsql = 'DELETE FROM "email" WHERE "emaicodigos"=\''.$emaicodigos.'\'';
		return $sbsql;
	}
	
	function EmailTrans($ircdata) {
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
} //End of Class Email
?>