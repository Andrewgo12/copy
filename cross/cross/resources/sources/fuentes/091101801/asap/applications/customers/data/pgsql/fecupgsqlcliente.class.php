<?php 
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlCliente {
	
	function FeCuPgsqlCliente() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}
	
	function existCliente($cliecodigos) {
		$sql = 'SELECT * FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	
	function existClientebyId($clieidentifs) {
		$sql = 'SELECT * FROM "cliente" WHERE "clieidentifs"=\''.$clieidentifs.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}
	
	function addCliente($cliecodigos, $clieidentifs, $ticlcodigos, $clienombres, 
						$clierepprnos, $clierepsenos, $cliereppraps, $clierepseaps,
						$clielocalizs, $clietelefons, $locacodigos, $cliepagwebs, 
						$cliemails, $esclcodigos, $tiidcodigos, $grclcodigos, 
						$clienumfaxs, $clieaparaers,$clieactivas) {
		$sql = 'INSERT INTO "cliente" ("cliecodigos","clieidentifs","ticlcodigos","clienombres",
									   "clierepprnos", "clierepsenos", "cliereppraps", "clierepseaps",
									   "clielocalizs","clietelefons","locacodigos","cliepagwebs",
									   "cliemails","esclcodigos","tiidcodigos","grclcodigos","clienumfaxs",
									   "clieaparaers","clieactivas")'
		.' VALUES(\''.$cliecodigos.'\',\''.$clieidentifs.'\',\''.$ticlcodigos.'\',\''.$clienombres.'\',\''.
		 $clierepprnos.'\',\''.$clierepsenos.'\',\''.$cliereppraps.'\',\''.$clierepseaps.'\',\''.
		 $clielocalizs.'\',\''.$clietelefons.'\',\''.$locacodigos.'\',\''.$cliepagwebs.'\',\''.$cliemails.'\',\''.
		 $esclcodigos.'\',\''.$tiidcodigos.'\',\''.$grclcodigos.'\',\''.$clienumfaxs.'\',\''.$clieaparaers.'\',\''.$clieactivas.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function updateCliente($cliecodigos, $clieidentifs, $ticlcodigos, $clienombres, 
						   $clierepprnos, $clierepsenos, $cliereppraps, $clierepseaps, 
						   $clielocalizs, $clietelefons, $locacodigos, $cliepagwebs, 
						   $cliemails, $esclcodigos, $tiidcodigos, $grclcodigos, 
						   $clienumfaxs, $clieaparaers, $clieactivas) {
		$sql = 'UPDATE "cliente" SET "clieidentifs"=\''.$clieidentifs.'\',"ticlcodigos"=\''.$ticlcodigos.'\',"clienombres"=\''.$clienombres
		.'\',"clierepprnos"=\''.$clierepprnos.'\',"clierepsenos"=\''.$clierepsenos.'\',"cliereppraps"=\''.$cliereppraps.'\',"clierepseaps"=\''.$clierepseaps.
		'\',"clielocalizs"=\''.$clielocalizs.'\',"clietelefons"=\''.$clietelefons
		.'\',"locacodigos"=\''.$locacodigos.'\',"cliepagwebs"=\''.$cliepagwebs.'\',"cliemails"=\''.$cliemails
		.'\',"esclcodigos"=\''.$esclcodigos.'\',"tiidcodigos"=\''.$tiidcodigos.'\',"grclcodigos"=\''.$grclcodigos
		.'\',"clienumfaxs"=\''.$clienumfaxs.'\',"clieaparaers"=\''.$clieaparaers.'\',"clieactivas"=\''.$clieactivas
		.'\' WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function deleteCliente($cliecodigos) {
		$sql = 'DELETE FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}
	function getByIdCliente($cliecodigos) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByIdenfitfsCliente($clieidentifs) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "clieidentifs"=\''.$clieidentifs.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByIdentif($clieidentifs) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "clieidentifs"=\''.$clieidentifs.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getAllCliente() {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByCliente_fkey($locacodigos) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "locacodigos"=\''.$locacodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByCliente_fkey1($esclcodigos) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "esclcodigos"=\''.$esclcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByCliente_fkey2($ticlcodigos) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "ticlcodigos"=\''.$ticlcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getByCliente_fkey3($tiidcodigos) {
		$sql = 'SELECT "cliente".*, (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "tiidcodigos"=\''.$tiidcodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCliecodigos($cliecodigos) {
		$sql = 'SELECT "cliecodigos" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClieidentifs($cliecodigos) {
		$sql = 'SELECT "clieidentifs" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiclcodigos($cliecodigos) {
		$sql = 'SELECT "ticlcodigos" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClienombres($cliecodigos) {
		$sql = 'SELECT "clienombres" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClierepreses($cliecodigos) {
		$sql = 'SELECT (COALESCE("cliente"."clierepprnos", \'\') || \' \' || COALESCE("cliente"."clierepsenos", \'\') || \' \' || COALESCE("cliente"."cliereppraps", \'\') || \' \' || COALESCE("cliente"."clierepseaps", \'\'))  AS "clierepreses" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClielocalizs($cliecodigos) {
		$sql = 'SELECT "clielocalizs" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClietelefons($cliecodigos) {
		$sql = 'SELECT "clietelefons" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getLocacodigos($cliecodigos) {
		$sql = 'SELECT "locacodigos" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCliepagwebs($cliecodigos) {
		$sql = 'SELECT "cliepagwebs" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getCliemails($cliecodigos) {
		$sql = 'SELECT "cliemails" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getEsclcodigos($cliecodigos) {
		$sql = 'SELECT "esclcodigos" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getTiidcodigos($cliecodigos) {
		$sql = 'SELECT "tiidcodigos" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getGrclcodigos($cliecodigos) {
		$sql = 'SELECT "grclcodigos" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClienumfaxs($cliecodigos) {
		$sql = 'SELECT "clienumfaxs" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	function getClieaparaers($cliecodigos) {
		$sql = 'SELECT "clieaparaers" FROM "cliente" WHERE "cliecodigos"=\''.$cliecodigos.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
} //End of Class Cliente
?>