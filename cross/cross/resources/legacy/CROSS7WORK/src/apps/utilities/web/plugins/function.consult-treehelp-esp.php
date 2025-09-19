<?php
include_once ('HTML_Menu.php');
/**
 *   Propiedad intelectual del FullEngine.
 *
 *	Pinta un arbol para las tablas reflexivas
 *	@author freina<freina@parquesoft.com>
 *	@date 29-Sep-2015 15:32
 *	@location Cali-Colombia
 */
function smarty_function_consult_treehelp_esp($params, & $smarty) {
	extract($params);
	extract($_REQUEST);

	settype($objService,"object");
	settype($objGateway, "object");
	settype($rcUser, "array");
	settype($rcNode, "array");
	settype($rcPersDatos, "array");
	settype($rcEntes, "array");
	settype($rcTmp, "array");
	settype($rcResult, "array");
	settype($rcLista, "array");
	settype($sbFlag, "string");
	settype($sbHtml, "string");
	settype($sbIndex, "string");
	settype($sbValue, "string");
	settype($nuCont, "integer");

	if($_REQUEST["message"]){
		return null;
	}

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
		$sbSql = $objGateway->getDataTree($sqlid,$rcParams);

		$objGateway->objdb->fncadoselect($sbSql, FETCH_ASSOC);
		$rcNode = $objGateway->objdb->rcresult;

		if(is_array($rcNode) && $rcNode){
			
			echo "<table align=\"center\" width=\"100%\">";
			echo "<tr>";
			echo "<td class='titulofila' align='center'>";
			echo $rclabels["organizacion"]["label"];
			echo "</td>";
			echo "</tr>";
				
			//Obtiene los entes organizacionales en los cuales el usuario es responsable
			$objService = Application :: loadServices("Human_resources");
			$rcPersDatos = $objService->getPersDatos($rcUser["username"], true);
			$rcEntes = $objService->getActiveBeingEmployee($rcPersDatos["perscodigos"]);
			echo "<tr>";
			echo "<td>";
			if(is_array($rcEntes) && $rcEntes){
				
				echo "<table>";
				foreach($rcEntes as $rcTmp){

					//funcion que arma el arbol lo pinta
					echo "<tr>";
					echo "<td>";
					$rcResult = getTree($rcNode,$rcTmp["orgacodigos"],$table,$father,$son,$label,$return_obj,$return_key,$rclabels);
					echo "</td>";
					echo "</tr>";
					if(!$rcResult["result"]){
						$rcLista[$nuCont] = $rcTmp["orgacodigos"];
						$nuCont ++;
					}
				}
				echo "</table>";
			}
			
			echo "</td>";
			echo "</tr>";
				
			//se obtienen los permisos de acceso a otros entes organizacionales
			$objService = Application :: loadServices("General");
			$rcTmp = $objService->getParam("human_resources", "permisos_entes");
			$rcTmp = $rcTmp[$rcUser["username"]];
				
			if(is_array($rcTmp) && $rcTmp){
				if(is_array($rcLista) && $rcLista){
					$rcLista = array_merge($rcLista,$rcTmp);
				}else{
					$rcLista = $rcTmp;
				}
			}

			if(is_array($rcLista) && $rcLista){
				
				echo "<tr><td><hr></tr>"."\n";
				
				echo "<tr>";
				echo "<td>";
				//Carga el servicio de human_resources
				$objService = Application :: loadServices("Human_resources");
				$rcLista = $objService->getEntesByIdInArray($rcLista);

				if(is_array($rcLista) && $rcLista){
					$sbHtml = "<table>";
					foreach ($rcLista as $sbIndex=>$sbValue){
						$sbHtml .= "<tr>";
						$sbHtml .= "<td>";
						$sbHtml .= "<a href='#' onclick=\"PutValue('".$return_obj."','".$sbIndex."');\">".$sbValue."</a>";
						$sbHtml .= "</td>";
						$sbHtml .= "</tr>";
					}
					$sbHtml .= "</table>";
					
					print $sbHtml;
				}
				
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}
}
/**
 *   Propiedad intelectual de FullEngine.
 *
 *   arma el arbol para cada dependencia a cargo del empleado
 *   @param $rcNode array   Data total
 *   @return true;
 *   @author freina <freina@fullengine.com>
 *   @date 29-Sep-2015 15:16
 *   @location Cali-Colombia
 */
function getTree($rcNode,$valor,$table,$father,$son,$label,$return_obj,$return_key,$rclabels){

	settype($objArbol, "object");
	settype($objBegin, "object");
	settype($objNode, "object");
	settype($rcObjNodos, "array");
	settype($rcValue, "array");
	settype($rcAncestry, "array");
	settype($rcTmpA, "array");
	settype($rcAncestryC, "array");
	settype($rcTmpf, "array");
	settype($rcTmps, "array");
	settype($rcDepth, "array");
	settype($rcTmp, "array");
	settype($rcResult, "array");
	settype($sbIndex, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($nuContA, "integer");
	settype($nuIndices, "integer");
	settype($nuIndiceA, "integer");
	settype($nuContA, "integer");


	$rcResult["result"] = false;

	if (strlen($valor)) {
		//constantes
		$sbIndex = Application :: getConstant("DEPTH");

		//inicio del arbol
		$objArbol = new HTML_TreeMenu("menuLayer".$valor, 'web/images/menu');
		$objArbol->menuobj = 'objTreeMenu'.$valor;

		$objBegin = new HTML_TreeNode("", "javascript:LoadValue(\'\')");

		//se crean todos los posibles nodos
		if(is_array($rcNode) && $rcNode){
			foreach ($rcNode as $rcValue){
				$rcObjNodos[$rcValue[$son]] = new HTML_TreeNode($rcValue[$label], "javascript:PutValue(\'".$return_obj."\',\'".$rcValue[$return_key]."\');");
			}
		}
		$nuCant = sizeof($rcNode);

		for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
			if ($rcNode[$nuCont][$son] === $valor) {

				//se cambia el nodo para que inicie abierto
				//$rcObjNodos[$valor]->expanded=true;

				//ascendencia
				$rcTmpf[0] = $rcNode[$nuCont];

				//descendencia
				fncseleccion($rcNode[$nuCont][$son], $rcNode, $rcTmps, $father, $son, $nuIndices, $rcDepth,$valor,$rcShow);
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
				
			$objArbol->addItem($objBegin);

			//pinta el arbol
			$objArbol->printMenu();
				
			$rcResult["result"] = true;
				
		}
	}
	return $rcResult;
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
?>