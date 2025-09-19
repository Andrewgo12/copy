<?php 
class FeCrAutoCompletar 
{
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
//				if($sbCharset=='UTF-8'){
//					$rcTmp[1] = utf8_decode($rcTmp[1]);
//				}
				$sbTmp = $rcTmp[0]."___SEPARADOR___".urlencode($rcTmp[1]);
				$rcValue[$nuCont] = $sbTmp; 
			}
			if($rcResult){
				$osbResult = implode("|",$rcValue);
			}
		}
		return ($osbResult);
	}
	
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	* Obtiene el html para las columnas dinamicas
	* @param string $isbParams Nombres de los campos parametro separados por
	* pipe ("|");
	* @return string $osbResult Cadena con el html
	* @author freina <freina@parquesoft.com>
	* @date 01-Mar-2006 13:24
	* @location Cali-Colombia
	*/
	function obtainHtmlDynamicColumns($isbParams) {
		
		settype($objService,"object");
		settype($objGateway,"object");
		settype($rcTmp,"array");
		settype($sbProccodigos,"string");
		settype($sbHtml, "string");
		settype($sbCodidominios, "string");
		settype($sbCodidomicams, "string");
		settype($sbCodidomivals, "string");

		$rcTemp = explode("|", $isbParams);
		foreach ($rcTemp as $rcArg) {
			$rcRow = explode(",", $rcArg);
			if ($rcRow[0])
				$rcParams[$rcRow[1]] = $rcRow[0];
		}
		
		if($rcParams["ordenumeros"]){
			$objGateway = Application :: getDataGateway("Orden");
			$rcTmp = $objGateway->getByIdOrden($rcParams["ordenumeros"]);
			if(is_array($rcTmp) && $rcTmp){
				$sbProccodigos = $rcTmp[0]["proccodigos"];
			}
		}else{
			//servicio de reglas del motor
			$objService = Application :: loadServices("Workflow");
			$sbProccodigos = $objService->getIdprocess($rcParams,true);
		}
		
		if($sbProccodigos){
			$rcParams["codidominios"] = "proceso";
			$rcParams["codidomicams"] = "proccodigos";
			$rcParams["codidomivals"] = $sbProccodigos;	
		}
		
		if($rcParams["codidominios"]){
			$sbCodidominios=$rcParams["codidominios"];
		}else{
			$sbCodidominios=null;
		}
		unset($rcParams["codidominios"]);
		if($rcParams["codidomicams"]){
			$sbCodidomicams=$rcParams["codidomicams"];
		}else{
			$sbCodidomicams=null;
		}
		unset($rcParams["codidomicams"]);
		if($rcParams["codidomivals"]){
			$sbCodidomivals=$rcParams["codidomivals"];
		}else{
			$sbCodidomivals=null;
		}
		unset($rcParams["codidomivals"]);

		$rcPlugins = Application :: getConstant("RCPLUGINS");
		$rcUser = Application :: getUserParam();
		if (!is_array($rcUser)) {
			//Si no existe usuario en sesion 
			$rcUser["lang"] = Application :: getSingleLang();
		}
		include ($rcUser["lang"]."/".$rcUser["lang"].".fichaord.php");

		
		$objService = Application :: loadServices("Dimentions");
		do {
			$sbHtml = $objService->PluginsFactory($rclabels, $rcUser, $rcPlugins, 
			$rcParams,$sbCodidominios,$sbCodidomicams,$sbCodidomivals);
			if (is_array($rcParams))
				array_pop($rcParams);
		} while (!$sbHtml && sizeof($rcParams));

		$objService->close();
		if (!$sbHtml)
			return 0;
		else
			return base64_encode($sbHtml);
	}
	//===========================================
	/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Obtiene los valores para cargar los combos y valida si se debe presentar la informacion de acuerdo al idioma
	* @param string $isbSqlId Identificador del sql en la compuerta
	* @param string $isbParams Nombres de los campos parametro separados por
	* pipe ("|");
	* @return string $osbResult Cadena con la dupla valor,label separados por
	* (|)
	* @author freina <freina@parquesoft.com>
	*   @date 19-Apr-2012 14:28
	* @location Cali-Colombia
	*/
	function Select_lang($isbSqlId, $isbParams,$sbTemplate){
		
		settype($objGateway,"object");
		settype($rcTmp,"array");
		settype($rcData,"array");
		settype($rcResult,"array");
		settype($rcValue,"array");
		settype($osbResult,"string");
		settype($sbValue,"string");
		settype($sbTmp,"string");
		settype($nuCont,"integer");

		$osbResult = "null";
		$objGateway = Application :: getDataGateway("SqlExtended");

		//Arma el vector de los parametros
		if($isbParams)
		{
			$rcTmp = explode("|", $isbParams);
			foreach ($rcTmp as $sbValue)
			{
				$rcData = explode(",", $sbValue);
				$rcResult[$rcData[0]] = array ($rcData[1], $rcData[2]);
			}
		}

		//Ejecuta el sql indicado
		$rcData = $objGateway->getLoadSelect($isbSqlId, $rcResult);
		$rcTmp = explode("_",$sbTemplate);
		$rcData = FeCrAutoCompletar::getDescLang($rcData,$rcResult,$rcTmp);
		if ($rcData){
			foreach($rcData as $nuCont => $rcTmp)
			{
				$sbTmp = $rcTmp[0]."___SEPARADOR___".urlencode($rcTmp[1]);
				$rcValue[$nuCont] = $sbTmp;
			}
			if($rcResult){
				$osbResult = implode("|",$rcValue);
			}
		}
		return ($osbResult);
	}
	/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene los descripotores de acuerdo al lenguaje.
	*   @author freina<freina@fullenine.com>
	*   @date 19-Apr-2012 14:28
	*   @location Cali-Colombia
	*/
	function getDescLang($rcData,$rcParams,$rcTemplate){
	
		settype($objService,"object");
		settype($rcResult,"array");
		settype($rcConstante,"array");
		settype($rcUser,"array");
		settype($rcTmp,"array");
		settype($rcRow,"array");
		settype($rcIndex,"array");
		settype($rcValues,"array");
		settype($rcConf,"array");
		settype($rcTatlvalcods,"array");
		settype($sbValue,"string");
		settype($nuCont,"integer");
		settype($nuRow,"integer");
		settype($nuCant,"integer");
		settype($nuTest,"integer");
		
		if($rcData && is_array($rcData) && $rcParams && is_array($rcParams) && $rcTemplate && is_array($rcTemplate)){
			
			//Para cargar el lenguaje
			$rcUser = Application :: getUserParam();
			if (!is_array($rcUser)) {
				//Si no existe usuario en sesion
				$rcUser["lang"] = Application :: getSingleLang();
			}
			
			$sbTable = strtolower($rcTemplate[0]);
			$sbKey = strtolower($rcTemplate[1]);
			$sbName = strtolower($rcTemplate[2]);
			
			//se obtiene la constante de configuracion
			$objService = Application :: loadServices("General");
			$rcConstante = Application :: getConstant("TAB_TIP_DESC");
			$objGateway = $objService->getGateWay("tablastipole");
			$objGateway->setData(array("entidad"=>$sbTable,"langcodigos"=>$rcUser["lang"]));
			$objGateway->getByTatlnomtabls_Langcodigos();
			$rcResult = $objGateway->getResult();
			$objService->close();
			if($rcConstante && is_array($rcConstante) && $rcResult && is_array($rcResult)){
				$rcConstante = $rcConstante[$sbTable];
				//valores de la llave
				$rcValues = explode(",",$rcConstante["primarykey"]);
				$nuCant = sizeof($rcParams);
				//se recorre el valor almacemado en la tabla de multilenguaje
				foreach($rcResult as $nuRow=>$rcRow){
					unset($rcConf);
					unset($rcTatlvalcods);
					$nuTest=0;
					//se hace explode del campo de los valores y se almacenan de forma temporal
					$rcTatlvalcods = explode(",",$rcRow["tatlvalcods"]);
					foreach($rcValues as $nuCont=>$sbValue){
						$rcConf[$sbValue] = $rcTatlvalcods[$nuCont];
					}
					
					foreach($rcParams as $sbIndex=>$rcTmp){
						if($rcTmp[0]==$rcConf[$sbIndex]){
							$nuTest++;
						}
					}
					
					if($nuTest==$nuCant){
						$rcIndex[$rcConf[$sbKey]] = $rcRow["tatlvaldesls"];
					}
				}
				unset($rcResult);
				//por ultimo se toma el valor de del nuevo lenguaje y se actualiza
				foreach($rcData as $nuCont=>$rcTmp){
					$rcResult[$nuCont][$sbKey] = $rcTmp[$sbKey];
					$rcResult[$nuCont][$sbName] = $rcIndex[$rcTmp[$sbKey]];
					$rcResult[$nuCont][0] = $rcTmp[$sbKey];
					$rcResult[$nuCont][1] = $rcIndex[$rcTmp[$sbKey]];
				}
			}else{
				$rcResult = $rcData;
			}
		}
		
		return $rcResult;
	}
}
?>