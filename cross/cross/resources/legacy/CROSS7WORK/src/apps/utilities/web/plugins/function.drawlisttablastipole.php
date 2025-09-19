<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawListTablastipole($params, & $smarty) {

	extract($_REQUEST);
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcConstante,"array");
	settype($rcConf,"array");
	settype($rcValues,"array");
	settype($sbHtml,"string");
	settype($sbEstilo,"string");
	settype($nuCont,"integer");
	settype($nuCant,"integer");
	settype($sbPor,"string");
	settype($sbCharset, "string");
	settype($nuColspan,"integer");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	
	$sbCharset = strtoupper(ini_get("default_charset")) ;
	
	include ($rcUser["lang"]."/".$rcUser["lang"].".nuevadescripcion.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	$rcConstante = Application :: getConstant("TAB_TIP_DESC");
	$rcConf = $rcConstante[$entidad];
	$rcTmp = getData($entidad,$langcodigos,$rcConf);
	if($rcTmp && is_array($rcTmp)){
		//se pinta la informacion las comunicaciones
		
		$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$rcValues = explode(",",$rcConf["primarykey"]);
		$nuCant = sizeof($rcValues);
		$sbPor = (string) floor(40/$nuCant);
		$nuColspan = $nuCant + 3;
		$sbHtml .= "<td align='center'  colspan='".$nuColspan."'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		for($nuCont=0;$nuCont<$nuCant;$nuCont++){
			$sbHtml .= "<td class='titulofila' align='center' width='".$sbPor."%'>";
			$sbHtml .= $rclabels[$rcValues[$nuCont]]["label"];
			$sbHtml .= "</td>";	
		}
		$sbHtml .= "<td class='titulofila' align='center'  width='30%'>";
		$sbHtml .= $rclabels["desc"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'  width='25%'>";
		$sbHtml .= $rclabels["tatlvaldesls"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center' width='5%'>";
		$sbHtml .= $rclabels["accion"]["label"];
		$sbHtml .= "</td>";
		
		$sbHtml .= "</tr>";
		foreach($rcTmp as $nuCont=>$rcRow){
			if($sbCharset=='UTF-8'){
				$rcRow["tatlvaldesls"] = utf8_decode($rcRow["tatlvaldesls"]);
				$rcRow["tatlvaldescs"] = utf8_decode($rcRow["tatlvaldescs"]);	
			}
			$rcRow["tatlvaldesls"] = trim($rcRow["tatlvaldesls"]);
			$rcRow["tatlvaldescs"] = trim($rcRow["tatlvaldescs"]);
			if (fmod($nuCont, 2) == 0) {
				$sbEstilo = "celda";
			} else {
				$sbEstilo = "celda2";
			}
			$sbHtml .= "<tr>";
			for($nuCont=0;$nuCont<$nuCant;$nuCont++){
				$sbHtml .= "<td align='left' class='".$sbEstilo."' width='".$sbPor."%'>";
				$sbHtml .= $rcRow[$rcValues[$nuCont]];
				$sbHtml .= "</td>";	
			}
			$sbHtml .= "<td align='left' class='".$sbEstilo."' width='30%'>";
			$sbHtml .= $rcRow["tatlvaldescs"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='left' class='".$sbEstilo."' width='25%'>";
			$rcRow["tatlvalcods"]= str_replace(",","_",$rcRow["tatlvalcods"]) ;
			$sbHtml .="<textarea name='".$rcRow["tatlvalcods"]."' id='".$rcRow["tatlvalcods"]."' rows='2' cols='100'>".$rcRow["tatlvaldesls"]."</textarea>";
			$sbHtml .="<input name='tatlcodigos_".$rcRow["tatlvalcods"]."' type='hidden' id='tatlcodigos_".$rcRow["tatlvalcods"]."' value='".$rcRow["tatlcodigos"]."'>";
			$sbHtml .= "<B>*</B></td>";
			
			$sbHtml .= "<td align='center' class='".$sbEstilo."' width='5%'>";
			$sbHtml .= "<table align=\"center\" border=\"0\" width=\"100%\">";
			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='".$sbEstilo."'>";
			$sbHtml .= "<a href=# title='".$rclabels_crl['CmdSend']."' onclick=\"jsUpdate('".$entidad."','".$rcConf["primarykey"]."','".$rcConf["name_desc"]."','".$rcRow["tatlvalcods"]."','".$rcRow["tatlvaldescs"]."','".$langcodigos."');disableButtons();\">";
			$sbHtml .= "<img src=web/images/insertar.gif border=0></a>";
			$sbHtml .= "</td>";
			if($rcRow["tatlcodigos"]){
				$sbHtml .= "<td class='".$sbEstilo."'>";
				$sbHtml .= "<a title='".$rclabels_crl['CmdDelete']."' href=# onclick=\"var sbResult = confirm('".$rclabels["preguntar"]["label"]."'); if(sbResult == true){jsDelete('".$rcRow["tatlvalcods"]."');disableButtons();}\">";
				$sbHtml .= "<img src=web/images/ico_basura.gif border=0></a>";
				$sbHtml .= "</td>";	
			}
			$sbHtml .= "</tr>";
			$sbHtml .= "</table>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
			
		}
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
/**
	*   Propiedad intelectual del FullEngine.
	*
	*   Obtiene la informacion de los registros a presentar
	*   @author freina
	*	@param string $entidad Nombre de la tabla
	*	@param string $langcodigos lenguaje
	*	@return boolean true o false
	*   @date 09-Aug-2009 09:30
	*   @location Cali-Colombia
	*/
function getData($entidad,$langcodigos,$rcConstante){
	
	settype($objService,"object");
	settype($objGateway,"object");	
	settype($rcResult,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcValues,"array");
	settype($rcData,"array");
	settype($sbFunction,"string");
	settype($sbTmp,"string");
	settype($sbTable,"string");
	settype($nuRow,"integer");
	settype($nuCont,"integer");
	settype($nuCant,"integer");
	
	if($entidad && $langcodigos && $rcConstante && is_array($rcConstante)){
		
		$rcValues = explode(",",$rcConstante["primarykey"]);
		$nuCant = sizeof($rcValues);
		//se obtiene la data de la tabla
		$objService = Application :: loadServices($rcConstante["service"]);
		//control de tabla
		if(!(strpos($entidad,"_")===false)){
			$sbTable = substr($entidad,(strpos($entidad,"_")+1));
		}else{
			$sbTable = $entidad;
		}
		$objGateway = $objService->getGateWay($sbTable);
		$sbFunction = "getAll".ucfirst($sbTable);
		$rcTmp = $objGateway->$sbFunction();
		$objService->close();
		
		if($rcTmp & is_array($rcTmp)){
			//se formatea la informacion para adecuarla a lo configurado
			foreach($rcTmp as $nuRow=>$rcRow){
				//se arma la cadena de codigos.
				$sbTmp = "";
				for($nuCont=0;$nuCont<$nuCant;$nuCont++){
					$sbTmp .= ($nuCont+1==$nuCant)?$rcRow[$rcValues[$nuCont]]:$rcRow[$rcValues[$nuCont]].",";
					$rcResult[$nuRow][$rcValues[$nuCont]]=$rcRow[$rcValues[$nuCont]];
				}
				$rcResult[$nuRow]["tatlvalcods"]=$sbTmp;
				$rcResult[$nuRow]["tatlvaldescs"]=$rcRow[$rcConstante["name_desc"]];
			}
		}
		
		//se obtiene la informacion de datos almacenados
		$objGateway = Application :: getDataGateway("tablastipole");
		$objGateway->setData(array("entidad"=>$entidad,"langcodigos"=>$langcodigos));
		$objGateway->getByTatlnomtabls_Langcodigos();
		$rcData = $objGateway->getResult();
		unset($rcTmp);
		if($rcData && is_array($rcData)){
			
			foreach($rcData as $rcRow){
				$rcTmp[$rcRow["tatlvalcods"]] = $rcRow;
			}
			
			//se actualiza el arreglo resultado
			foreach($rcResult as $nuCont=>$rcRow){
				$rcResult[$nuCont]["tatlcodigos"] = $rcTmp[$rcRow["tatlvalcods"]]["tatlcodigos"];
				$rcResult[$nuCont]["tatlvaldesls"] = $rcTmp[$rcRow["tatlvalcods"]]["tatlvaldesls"];
			}
		}
		
	}
	
	return $rcResult;
}
?>
