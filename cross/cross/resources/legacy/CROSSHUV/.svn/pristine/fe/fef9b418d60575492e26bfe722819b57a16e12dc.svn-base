<?php  
//Paquete de conexion a bases de datos
include_once ("pkdatabases.php");
class FeCuPgsqlSqlExtendedCustomers {
	var $consult;
	var $objdb;
	function FeCuPgsqlSqlExtendedCustomers() {
		$config = & ASAP :: getStaticProperty('Application', 'config');
		$this->objdb = new databases();
		$this->objdb->fncadoconn($config['database']);
	}

	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Trae un contrato con los descriptores de sus datos referenciales
	* @param string $contnics Numero del contrato
	* @return Array
	* @author cazapata <cazapata@parquesoft.com>
	* @date 25-sep-2004 12:20:58
	* @location Cali-Colombia
	*/
	function getListContrato($contnics) {
		$sbSql = 'SELECT
										"contrato"."contnics",
										"contrato"."cliecodigos",
										"contrato"."clienombres",
										"contrato"."ticocodigos",
										"tipocontrato"."ticonombres",
										"contrato"."contobjetos",
										"contrato"."timocodigos",
										"tipomoneda"."timonombres",
										"contrato"."contmonton",
										"contrato"."fopacodigos",
										"formapago"."fopanombres",
										"contrato"."contfchainin",
										"contrato"."contfchafinn", 
										"contrato"."contfchfirmn", 
										"contrato"."contestados", 
										"contrato"."contdescrips" 
									FROM
										"contrato","cliente","tipocontrato","tipomoneda","formapago"
									WHERE 
										"contrato"."contnics"=\''.$contnics.'\' AND
										"contrato"."cliecodigos"="cliente"."cliecodigos" AND
										"contrato"."ticocodigos"="tipocontrato"."ticocodigos" AND
										"contrato"."timocodigos"="tipomoneda"."timocodigos" AND
										"contrato"."fopacodigos"="formapago"."fopacodigos" AND
									ORDER BY
										"contrato"."contnics"';
		//Ejecuta el sql en db pero haciendo el fectch para hacer la conversion de fechas
		$this->objdb->fncadosetmodefetch(FETCH_ASSOC);
		$this->objdb->fncadoexecute($sbSql);
		if (!$this->objdb->objresult)
			return null;
		//Carga el servicio de control de fechas 
		$servceDate = Application :: loadServices("DateController");
		$nuCont = 0;
		while (!$this->objdb->objresult->EOF) {
			$rcTmp = $this->objdb->fncadofetch();
			$this->objdb->fncadomovenext();
			//Hace la conversion de fechas
			$rcTmp["contfchainin"] = $servceDate->fncformatofecha($rcTmp["contfchainin"]);
			$rcTmp["contfchafinn"] = $servceDate->fncformatofecha($rcTmp["contfchafinn"]);
			$rcTmp["contfchfirmn"] = $servceDate->fncformatofecha($rcTmp["contfchfirmn"]);
			$rcContratos[$nuCont] = $rcTmp;
			$nuCont ++;
		}
		return $rcContratos;
	}
	
	function getClienteByContrato($contnics) {
		settype($sbSql,"string");
		$sbSql = 'SELECT
								"contrato"."cliecodigos",
								"cliente"."clienombres",
								"cliente"."cliemails"
							FROM
								"contrato","cliente"
							WHERE 
								"contrato"."contnics"=\''.$contnics.'\' AND
								"contrato"."cliecodigos"="cliente"."cliecodigos"';
		$this->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		return $this->objdb->rcresult;
	}
	//End of Class SqlExtended
}
?>