<?php
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlContacto {

	function FeCuPgsqlContacto() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	function existContacto($contcodigon) {
		$sql = 'SELECT * FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function existContactoByIdentis($contindentis) {
		$sql = 'SELECT * FROM "contacto" WHERE "contindentis"=\''.$contindentis.'\'';
		$this->objdb->fncadoexecute($sql);
		return $this->objdb->fncadorowcont();
	}

	function addContacto($contcodigon, $contindentis, $tiidcodigos, $cliecodigon, 
	$contprinoms, $contsegnoms, $contpriapes, $contsegapes, $contfecnacis, $contedadn, $contsexos, $contemail, $locacodigos, 
	$contdirecios, $conttelefons, $contobservs,$contnumcels) {
		$sql = 'INSERT INTO "contacto" ("contcodigon","contindentis","tiidcodigos",' .
				'"cliecodigon","contprinoms","contsegnoms","contpriapes","contsegapes","contfecnacis","contedadn","contsexos",' .
				'"contemail","locacodigos","contdirecios","conttelefons","contobservs","contnumcels")'.
				' VALUES('.$contcodigon.' ,\''.$contindentis.'\',\''.$tiidcodigos.'\',\''.
				$cliecodigon.'\',\''.$contprinoms.'\',\''.$contsegnoms.'\',\''.$contpriapes.'\',\''.$contsegapes.'\','.$contfecnacis.','.$contedadn.
				',\''.$contsexos.'\',\''.$contemail.'\',\''.$locacodigos.'\',\''.
				$contdirecios.'\',\''.$conttelefons.'\',\''.$contobservs.'\',\''.$contnumcels.'\')';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function updateContacto($contcodigon, $contindentis, $tiidcodigos, 
	$cliecodigon, $contprinoms, $contsegnoms, $contpriapes, $contsegapes, 
	$contfecnacis, $contedadn, $contsexos, $contemail, $locacodigos, 
	$contdirecios, $conttelefons, $contobservs, $contactivas,$contnumcels) {
		$sql = 'UPDATE "contacto" SET "contindentis"=\''.$contindentis.
		'\',"tiidcodigos"=\''.$tiidcodigos.'\',"cliecodigon"=\''.$cliecodigon.
		'\',"contprinoms"=\''.$contprinoms.'\',"contsegnoms"=\''.$contsegnoms.
		'\',"contpriapes"=\''.$contpriapes.'\',"contsegapes"=\''.$contsegapes.'\',"contfecnacis"='.$contfecnacis.
		', "contedadn"='.$contedadn.', "contsexos"=\''.$contsexos.'\',"contemail"=\''.
		$contemail.'\',"locacodigos"=\''.$locacodigos.'\',"contdirecios"=\''.
		$contdirecios.'\',"conttelefons"=\''.$conttelefons.'\',"contobservs"=\''.
		$contobservs.'\',"contactivas"=\''.$contactivas.'\',"contnumcels"=\''.$contnumcels.'\' 
		WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function deleteContacto($contcodigon) {
		$sql = 'DELETE FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoexecute($sql);
		if (!$this->objdb->objresult)
			$this->consult = false;
		else
			$this->consult = true;
	}

	function getByIdContacto($contcodigon) {
		$sql = 'SELECT "contacto".*, (COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getAllContacto() {
		$sql = 'SELECT "contacto".*, (COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto"';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getContcodigon($contcodigon) {
		$sql = 'SELECT "contcodigon" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getContindentis($contcodigon) {
		$sql = 'SELECT "contindentis" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getCliecodigon($contcodigon) {
		$sql = 'SELECT "cliecodigon" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getContnombre($contcodigon) {
		$sql = 'SELECT (COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getContemail($contcodigon) {
		$sql = 'SELECT "contemail" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getLocacodigos($contcodigon) {
		$sql = 'SELECT "locacodigos" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getContdirecios($contcodigon) {
		$sql = 'SELECT "contdirecios" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getConttelefons($contcodigon) {
		$sql = 'SELECT "conttelefons" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getContobservs($contcodigon) {
		$sql = 'SELECT "contobservs" FROM "contacto" WHERE "contcodigon"='.$contcodigon.' ';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByIdcontindentis($contindentis) {
		$sql = 'SELECT "contacto".*, (COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto" WHERE "contindentis"=\''.$contindentis.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}

	function getByIdcliecodigon($cliecodigon) {
		$sql = 'SELECT "contacto".*, (COALESCE("contacto"."contprinoms", \'\') || \' \' || COALESCE("contacto"."contsegnoms", \'\') || \' \' || COALESCE("contacto"."contpriapes", \'\') || \' \' || COALESCE("contacto"."contsegapes", \'\'))  AS "contnombre" FROM "contacto" WHERE "cliecodigon"=\''.$cliecodigon.'\'';
		$this->objdb->fncadoselect($sql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si el contacto existe y esta activo, por medio de su identificacion
	* @param string $sbContindentis Identificacion del contacto
	* @return integer 0 no existe 1 existe
	* @author freina<freina@parquesoft.com>
	* @date 25-Oct-2006 16:01
	* @location Cali-Colombia
	*/
	function existActiveContactoByIdentis($sbContindentis) {
		settype($sbSql, "string");
		settype($sbState, "string");
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "contacto" WHERE "contindentis"=\''.$sbContindentis.'\''.' AND "contactivas"=\''.$sbState.'\'';
		
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Determina si el contacto existe y esta activo, por medio de codigo interno
	* @param integer $nuContcodigon codigo del contacto
	* @return integer 0 no existe 1 existe
	* @author freina<freina@parquesoft.com>
	* @date 27-Nov-2010 09:28
	* @location Cali-Colombia
	*/
	function existActiveContactoById($nuContcodigon) {
		settype($sbSql, "string");
		settype($sbState, "string");
		$sbState = Application :: getConstant("REG_ACT");
		$sbSql = 'SELECT * FROM "contacto" WHERE "contcodigon"='.$nuContcodigon.' AND "contactivas"=\''.$sbState.'\'';
		
		$this->objdb->fncadoexecute($sbSql);
		return $this->objdb->fncadorowcont();
	}
} //End of Class Contacto
?>