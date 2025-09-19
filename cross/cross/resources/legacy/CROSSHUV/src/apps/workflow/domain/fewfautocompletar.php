<?php 
class FeWFAutoCompletar {
	function fncAutoCompletar($sbdato, $tbl_field) 
	{
		$rctbl_field = explode("__", $tbl_field);
		
		//Carga la conpurta de la tabla
		$this->gateWay = Application :: getDataGateway($rctbl_field[0]);
		$sbmetodo = "get".ucfirst($rctbl_field[1]);
		$data_descriptor = $this->gateWay-> $sbmetodo ($sbdato);
		
		if (!$data_descriptor[0][$rctbl_field[1]])
			return "null";
		return $data_descriptor[0][$rctbl_field[1]];
	}
	
	/**/
	function autoReference($idSql, $params){
		
		settype($objGateway, "object");
		settype($rcTmp, "array");
		settype($rcData, "array");
		settype($rcResult, "array");
		settype($sbCharset, "string");
		settype($sbCad, "string");
		
		$objGateway = Application :: getDataGateway("SqlExtended");
		
		//Arma el vector de los parametros
		$rcTmp = explode("|", $params);
		foreach ($rcTmp as $sbCad){
			$rcData = explode(",", $sbCad);
			$rcResult[$rcData[0]] = array ($rcData[1], $rcData[2]);
		}
		//Ejecuta el sql indicado
		$rcData = $objGateway->getAutoReference($idSql, $rcResult);
		if (!$rcData[0][0]){
			return "null";
		}
		
		$sbCharset = strtoupper(ini_get("default_charset")) ;
		
		if($sbCharset=='UTF-8'){
			$rcData[0][0] = utf8_decode($rcData[0][0]);
		}
			
		$rcData[0][0] = urlencode($rcData[0][0]);
		return $rcData[0][0];
	}
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Pinta una alerta si el elemento exsite en la base de datos
	* @param string sqlId Identificador del sql en la compuerta
	* @param array params Nombres de los campos parametro separados por pipe("|");
	* @param array values Valores de los campos parametro y operador separados por pipe
	* @param integer msg Codigo del mensaje a mostar
	* @param boolean debug por defecto en false
	* @param datatype Name desc
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 11-oct-2004 10:41:18
	* @location Cali-Colombia
	*/
	function isexist($sqlId, $params) {
		$gateWay = Application :: getDataGateway("SqlExtended");
		$rcParam = explode("|", $sqlId);
		$sqlId = $rcParam[0];
		$msg = $rcParam[1];
		$rcParam = explode("|", $params);
		foreach ($rcParam as $k => $value) {
			$rcTmp = explode(",", $value);
			$rcResult[$rcTmp[0]] = array ($rcTmp[1], $rcTmp[2]);
		}
		$rcData = $gateWay->getAutoReference($sqlId, $rcResult);
		if (is_array($rcData)) {
			//Parametros del usuario
			//$rcuser = Application :: getUserParam();
			$rcuser = $_SESSION["_authsession"];
			if (!is_array($rcuser)) {
				//Si no existe usuario en sesion 
				$rcuser["lang"] = Application :: getSingleLang();
			}
			include_once ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
			return htmlentities($rcmessages[$msg]);
		}
		return "null";
	}
	//------------------------------------------------
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los valores para cargar los combos
	* @param string $isbSqlId Identificador del sql en la compuerta
	* @param string $isbParams Nombres de los campos parametro separados por
	* pipe ("|");
	* @return string $osbResult Cadena con la dupla valor,label separados por
	* (|)
	* @author freina <freina@parquesoft.com>
	* @date 05-Jul-2005 15:04
	* @location Cali-Colombia
	*/
	function Select($isbSqlId, $isbParams){
		settype($objGateway,"object");
		settype($rcTmp,"array");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcValue,"array");
		settype($osbResult,"string");
		settype($sbValue,"string");
		settype($sbTmp,"string");
		settype($sbCharset, "string");
		settype($nuCont,"integer");
		
		$osbResult = "null";
		$objGateway = Application :: getDataGateway("SqlExtended");
		
		//Arma el vector de los parametros
		if($isbParams){
			$rcTmp = explode("|", $isbParams);
			foreach ($rcTmp as $sbValue){
				$rcData = explode(",", $sbValue);
				$rcResult[$rcData[0]] = array ($rcData[1], $rcData[2]);
			}
		}
		
		//Ejecuta el sql indicado
		$rcData = $objGateway->getLoadSelect($isbSqlId, $rcResult);
		if ($rcData){
			
			$sbCharset = strtoupper(ini_get("default_charset")) ;
			foreach($rcData as $nuCont => $rcTmp){
				if($sbCharset=='UTF-8'){
					$rcTmp[1] = utf8_decode($rcTmp[1]);
				}
				$sbTmp = $rcTmp[0]."___SEPARADOR___".urlencode($rcTmp[1]);
				$rcValue[$nuCont] = $sbTmp; 
			}
			if($rcResult){
				$osbResult = implode("|",$rcValue);
			}
		}
		return ($osbResult);
	}
}
?>