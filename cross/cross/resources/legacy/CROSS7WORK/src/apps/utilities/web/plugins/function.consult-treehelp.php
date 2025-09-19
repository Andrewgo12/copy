<?php
include_once ('HTML_Menu.php');
/**
 *   Propiedad intelectual del FullEngine.
 *
 *	Pinta un arbol para las tablas reflexivas
 *	@author freina<freina@parquesoft.com>
 *	@date 08-Jul-2005 14:20
 *	@location Cali-Colombia
 */
function smarty_function_consult_treehelp($params, & $smarty) {
	extract($params);
	extract($_REQUEST);

	settype($objArbol, "object");
	settype($objService,"object");
	settype($objNode, "object");
	settype($objBegin, "object");
	settype($objGateway, "object");
	settype($rcNode, "array");
	settype($rcParams, "array");
	settype($rcTmp, "array");
	settype($rcTmpA, "array");
	settype($rcValue, "array");
	settype($rcUser, "array");
	settype($rcTmpf, "array");
	settype($rcTmps, "array");
	settype($rcReference, "array");
	settype($rcObjNodos, "array");
	settype($rcDepth, "array");
	settype($rcAncestry, "array");
	settype($rcAncestryC, "array");
	settype($sbIndex, "string");
	settype($sbFlag, "string");
	settype($sbJavascript, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($nuIndicef, "integer");
	settype($nuIndices, "integer");
	settype($nuIndiceA, "integer");
	settype($nuContA, "integer");

	if($_REQUEST["message"]){
		return null;
	}
	
	$objService = Application :: loadServices("Data_type");
	
	if ($sqlid) {
		//Obtiene los datos del usuario
		$rcUser = getDataUser();

		include ($rcUser["lang"]."/".$rcUser["lang"].".treehelp.php");
		include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
			
		//todos los nodos
		if($param){
			$rcParams = explode(",",$param);
		}
		$objGateway = Application :: getDataGateway("SqlExtended");
		$sql = $objGateway->getDataTree($sqlid,$rcParams);

		//ADICIONAMOS ESTE BLOQUE PARA APLICAR FILTRO A SELECT_ENTES POR APELLIDO
		//Busca los valores de la interfaz para ejecutar filtros
		foreach($_REQUEST as $sbKey => $sbValue){
			if((strpos($sbKey,"__")!==false) && strlen($sbValue)){
				if(strpos($sbKey,'__')!==0){
					$sbNameField = str_replace('__',".",$sbKey);
					$rcFields[$sbNameField] = $sbValue;
				}
			}
		}

		$objGateway->objdb->fncadoselect($sql, FETCH_ASSOC);
		$rcNode = $objGateway->objdb->rcresult;

		if($rcFields)
		{
			$sql = $objGateway->setFilterSql($sql, $rcFields);
			$objGateway->objdb->fncadoselect($sql, FETCH_ASSOC);
			$rcShow = $objGateway->objdb->rcresult;
			if($rcShow)
			{
				$rcShow = orderNodes($rcShow,$return_key);
				getListConsult($sql,$sqlid,$rcFields,$form,$submit,$return_key);
			}
			else
			{
				$sbHtml = "<script>alert('".$rcmessages[45]."');window.close();</script>";
				echo $sbHtml;
			}
		}
		else
		{
			//constantes
			$sbIndex = Application :: getConstant("DEPTH");

			//inicio del arbol
			$objArbol = new HTML_TreeMenu("menuLayer1", 'web/images/menu');

			$objBegin = new HTML_TreeNode($rclabels[$table]["label"], "javascript:LoadValue(\'\')");

			//se crean todos los posibles nodos
			if(is_array($rcNode))
			foreach ($rcNode as $rcValue)
			{
				$rcObjNodos[$rcValue[$son]] = new HTML_TreeNode($rcValue[$label], "javascript:PutValue(\'".$return_obj."\',\'".$rcValue[$return_key]."\');");
			}
			$nuCant = sizeof($rcNode);

			//si un valor es cargado
			if($rcFields==null)
			{
				if (strlen($valor)) {
					for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
						if ($rcNode[$nuCont][$son] === $valor) {
								
							//se cambia el nodo para que inicie abierto
							$rcObjNodos[$valor]->expanded=true;
								
							//ascendencia
							fncseleccionF($rcNode[$nuCont][$father], $rcNode, $rcAncestry, $father, $son, $nuIndiceA);
							if ($rcAncestry) {
								foreach ($rcAncestry as $nuContA => $rcTmpA)
								{
									//se modifican los nodos
									$rcObjNodos[$rcTmpA[$son]]->expanded=true;
									$rcObjNodos[$rcTmpA[$son]]->js="LoadValue\\(\\\\\\'".$rcTmpA[$return_key]."\\\\\\'\\)";
								}
								$sbFlag = true;
								$rcAncestryC = $rcAncestry;
								$rcTmpf[0] = array_shift($rcAncestryC);
							} else {
								$rcTmpf[0] = $rcNode[$nuCont];
							}
							//descendencia
							fncseleccion($rcNode[$nuCont][$son], $rcNode, $rcTmps, $father, $son, $nuIndices, $rcDepth,$valor,$rcShow);
							if ($sbFlag) {
								$rcTmps[$nuIndices] = $rcNode[$nuCont];
							}
						}
					}
					//Se colocan los ascendentes en $rcTmps
					if ($rcAncestryC) {
						$nuIndices ++;
						krsort($rcAncestryC);
						foreach ($rcAncestryC as $rcTmp) {
							$rcTmps[$nuIndices] = $rcTmp;
							$nuIndices ++;
						}
					}
				} else {

					//armada normal
					for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
						if (!strlen($rcNode[$nuCont][$father])) {
							$rcTmpf[$nuIndicef] = $rcNode[$nuCont];
							$nuIndicef ++;
							$rcDepth[$rcNode[$nuCont][$son]] = 0;
							fncseleccion($rcNode[$nuCont][$son], $rcNode, $rcTmps, $father, $son, $nuIndices, $rcDepth,null,$rcShow);
						}
					}
				}

				if ($rcTmps && $rcTmpf) {
					$nuCant = sizeof($rcTmps);
					for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
						$rcTmp = $rcTmps[$nuCont];
						if (!array_key_exists($sbIndex, $rcTmp))
						{
							//se pone el nodo utilizado para descender si es necesario
							$rcObjNodos[$rcTmp[$father]]->addItem($rcObjNodos[$rcTmp[$son]]);
						} else {
							$rcObjNodos[$rcTmp[$sbIndex]]->js="LoadValue\\(\\\\\\'".$rcTmp[$sbIndex]."\\\\\\'\\)";
							$objNode = new HTML_TreeNode($rclabels["descend"]["label"], "javascript:LoadValue(\'".$rcTmp[$sbIndex]."\');", "");
							$rcObjNodos[$rcTmp[$sbIndex]]->addItem($objNode);
						}
					}

					$nuCant = sizeof($rcTmpf);
						
					//adhiere los nodos superiores
					for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
						$rcTmp = $rcTmpf[$nuCont];
						$objBegin->addItem($rcObjNodos[$rcTmp[$son]]);
					}
				}else
				{
					$sbHtml = "<script>alert('".$objService->my_html_entity_decode($rcmessages[45])."');window.close();</script>";
					echo $sbHtml;
				}
			}
			$objArbol->addItem($objBegin);
				
			//pinta el arbol
			$objArbol->printMenu();
		}
	}
}

/**
 *   Propiedad intelectual del FullEngine.
 *
 *   Inicia el formateo de la matriz utilizada para pintar el arbol
 *   @param $ircData array   Data total
 *   @param $ircPadre array  Data acumulada
 *   @param $isbPadre string Codigo a analizar
 *   @param $isbIndPadre string Indice Padre
 *   @param $isbIndHijo string   Indice hijo
 *   @param $inuIndice integer   Indice consecutivo
 * @param $ircDepth array Arreglo con la profundidad
 * @param string $isbNodoIni Cadena con el valor del nodo de inicio
 *   @author freina <freina@parquesoft>
 *   @date 08-Jul-2005 16:20
 *   @location Cali-Colombia
 */
function fncseleccion($isbPadre, & $ircData, & $ircPadre, $isbIndPadre, $isbIndHijo, & $inuIndice, & $ircDepth,$isbNodoIni=null,&$rcShow) {
	settype($sbIndex, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($nuNivel, "integer");

	$sbIndex = Application :: getConstant("DEPTH");
	$nuNivel = Application :: getConstant("NIVEL_DEPTH");

	$nuCant = sizeof($ircData);

	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++)
	{
		if ($ircData[$nuCont][$isbIndPadre] === $isbPadre)  //is_array($rcShow) && (in_array($ircData[$nuCont][$isbIndHijo],$rcShow))
		{
			if($isbNodoIni != null)
			{
				if($isbPadre != $isbNodoIni)
				$ircDepth[$ircData[$nuCont][$isbIndHijo]] = $ircDepth[$isbPadre] + 1;
			}
			else
			$ircDepth[$ircData[$nuCont][$isbIndHijo]] = $ircDepth[$isbPadre] + 1;
				
			if ($ircDepth[$ircData[$nuCont][$isbIndHijo]] < $nuNivel)
			{
				fncseleccion($ircData[$nuCont][$isbIndHijo], $ircData, $ircPadre, $isbIndPadre, $isbIndHijo, $inuIndice, $ircDepth, $isbNodoIni,$rcShow);
				$ircPadre[$inuIndice] = $ircData[$nuCont];
			}
			else
			{
				$ircPadre[$inuIndice] = array ($sbIndex => $isbPadre);
				$inuIndice ++;
				return;
			}
			$inuIndice ++;
		}
	}
	return;
}
//------------------------------
/**
 *   Propiedad intelectual del FullEngine.
 *
 *   obtiene los ascendientes de un nodo
 *   @param $ircData array   Data total
 *   @param $ircPadre array  Data acumulada
 *   @param $isbPadre string Codigo a analizar
 *   @param $isbIndPadre string Indice Padre
 *   @param $isbIndHijo string   Indice hijo
 *   @param $inuIndice integer   Indice consecutivo
 *   @author freina <freina@parquesoft>
 *   @date 08-Jul-2005 16:20
 *   @location Cali-Colombia
 */
function fncseleccionF($isbHijo, & $ircData, & $ircPadre, $isbIndPadre, $isbIndHijo, & $inuIndice) {
	settype($nuCant, "integer");
	settype($nuCont, "integer");

	$nuCant = sizeof($ircData);
	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($ircData[$nuCont][$isbIndHijo] === $isbHijo && strlen($isbHijo)) {
			fncseleccionF($ircData[$nuCont][$isbIndPadre], $ircData, $ircPadre, $isbIndPadre, $isbIndHijo, $inuIndice);
			$ircPadre[$inuIndice] = $ircData[$nuCont];
			$inuIndice ++;
		}
	}
	return;
}
//-------------------------
/**
 *   Propiedad intelectual del FullEngine.
 *   Obtiene la data de usuario
 *  @author  freina
 *	@return array $orcresult (Array con la data del usuario o null)
 *   @date 08-Jul-2005 16:35
 *   @location Cali-Colombia
 */
function getDataUser() {

	settype($orcResult, "array");

	//Trae los datos del usuario
	$orcResult = Application :: getUserParam();
	if (!is_array($orcResult))
	{
		//Si no existe usuario en sesion
		$orcResult["lang"] = Application :: getSingleLang();
	}
	return $orcResult;
}

function orderNodes($rcShow,$return_key)
{
	settype($rcResult,"array");
	foreach ($rcShow as $rcRow)
	$rcResult[] = $rcRow[$return_key];
	return $rcResult;
}
//----------------------------------------------------
function getListConsult($sql,$table_name,$rcFields,$form_name,$command,$return_key)
{
	settype($sbIndex,"string");
	settype($sbSql,"string");
	settype($sbValue,"string");
	settype($sbNameField, "string");

	$sbId = 'CR3';
	
	if(!$_REQUEST['sqlConsult']){
		unset($_SESSION[$sbId."_curr_page"]);
	}
	
	if(is_array($rcFields) && $rcFields){
		foreach($rcFields as $sbIndex=>$sbValue){
			if((strpos($sbIndex,".")!==false) && strlen($sbValue)){
				$sbNameField = str_replace('.',"__",$sbIndex);
				echo "<input type='hidden' name='".$sbNameField."' value=\"".$sbValue."\">";
			}
		}
	}

	echo "<input type='hidden' name='sqlConsult' value=\"".$sql."\">";
	$rcreq["sql"] = html_entity_decode($sql);

	$rcreq["action"] = $command;
	$rcreq["table"] = $table_name;
	$rcreq["view_fields"] = "*";
	$rcreq["return_key"] = $return_key;
	if($key_return)
	$rcreq["key_return"] = $key_return;
	else
	$rcreq["key_return"] = $return_key;
	$rcreq["order_by"] = $_REQUEST["order_by"];
	$appId = Application :: getAppId();
	$rcreq["command"] = false;
	$rcreq["form"] = $form_name; // add by Diego Ramirez Software House
	$rcreq["jsfunction"] = "PutValue";
	if($cache == "true")
	$rcreq["cache"] = true;
	else
	$rcreq["cache"] = false;
	if($num_rows)
	$rcreq["num_rows"] = $num_rows;
	else
	$rcreq["num_rows"] = 20;

	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!$table && !is_array($rcuser))
	return;
	$rcLlaves = explode(",",$return_key);

	//'&var1='+value0+'&var2='+var3
	foreach($rcLlaves as $key => $value){
		$rcTmpParams[] = "keyValue$key";
		$rcTmpValues[] = "'&".$table_name."__".$value."='+keyValue$key";
	}

	//Carga las etiquetas de la tabla en la sesion
	include ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, $sbId, true, false);
	$pager->Render();
}
?>