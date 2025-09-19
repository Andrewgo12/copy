<?php
/*
 * Created on 13/04/2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawIndoprequre($params, & $smarty) {

	extract($_REQUEST);

	settype($objDate, "object");
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcTmp,"array");
	settype($rcTime,"array");
	settype($rcParams, "array");
	settype($sbHtml,"string");
	settype($sbTotalC, "string");
	settype($sbOrdenumeros, "string");
	settype($nuCant, "integer");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".indoprequre.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	$objDate = Application :: loadServices("DateController");

	$rcSession = WebSession :: getProperty("_rcIndoprequre");

	if($rcSession["data"] && is_array($rcSession["data"])){
		//primero se debe pintar la ficha del indicador

		$sbHtml = "<table align=\"center\" border=\"1\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'  colspan='4'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'  colspan='4' >";
		$sbHtml .= $rclabels["indtitle"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center' colspan='4'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["cantcasos"]["label"];
		$sbHtml .= "</B></td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='left'><B>";
		$sbHtml .= (string) sizeof($rcSession["data"]["dataT"]);
		$sbHtml .= "</B></td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["canttcasos"]["label"];
		$sbHtml .= "</B></td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='left'><B>";

		$rcTime = $objDate->seconds2days_ha($rcSession["data"]["cantT"]);

		if(is_array($rcTime) && $rcTime){
			//seconds2days days hours minutes seconds
			$sbTotalC .= $rcTime["days"]." ".$rclabels["day"]["label"]." ".$rcTime["hours"]." ".$rclabels["hour"]["label"]." ".
			$rcTime["minutes"]." ".$rclabels["min"]["label"]." ".$rcTime["seconds"]." ".$rclabels["seg"]["label"];
			$sbHtml .= $sbTotalC;
		}else{
			$sbHtml .= "&nbsp;";
		}

		$sbHtml .= "</B></td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["formulal"]["label"];
		$sbHtml .= "</B></td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'><B>";
		$sbHtml .= $rclabels["formula"]["label"];
		$sbHtml .= "</B></td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["resultado"]["label"];
		$sbHtml .= "</B></td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'><B>";
		$nuCant = (int) sizeof($rcSession["data"]["dataT"]);
		$rcTime["days"] = (int) $rcTime["days"];
		if($rcTime["days"] > 0){
			$sbHtml .= round($rcTime["days"]/ $nuCant);	
		}else{
			$sbHtml .= "0";
		}
		$sbHtml .= "</B></td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["parametros"]["label"];
		$sbHtml .= "</B></td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		
		$sbHtml .= "<table align=\"center\" border=\"1\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["ordefecregdb"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		$sbHtml .= $objDate->fncformatofecha($rcSession["params"]["ordefecregdb"]);
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["ordefecregde"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		$sbHtml .= $objDate->fncformatofecha($rcSession["params"]["ordefecregde"]);
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["ordefecingdb"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		if($rcSession["params"]["ordefecingdb"]){
			$sbHtml .= $objDate->fncformatofecha($rcSession["params"]["ordefecingdb"]);	
		}else{
			$sbHtml .= "&nbsp;";
		}
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["ordefecingde"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		if($rcSession["params"]["ordefecingde"]){
			$sbHtml .= $objDate->fncformatofecha($rcSession["params"]["ordefecingde"]);	
		}else{
			$sbHtml .= "&nbsp;";
		}
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["tiorcodigos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		if($rcSession["params"]["tiorcodigos"]){
			$rcParams["tabla"] = "tipoorden";
			$rcParams["descriptor"] = "tiornombres";
			$rcParams["tiorcodigos"] = $rcSession["params"]["tiorcodigos"];
			$sbHtml .= getDesc($rcParams);	
		}else{
			$sbHtml .= "&nbsp;";
		}
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["evencodigos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		if($rcSession["params"]["evencodigos"]){
			$rcParams["tabla"] = "evento";
			$rcParams["descriptor"] = "evennombres";
			$rcParams["evencodigos"] = $rcSession["params"]["evencodigos"];
			$sbHtml .= getDesc($rcParams);	
		}else{
			$sbHtml .= "&nbsp;";
		}
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='left'><B>";
		$sbHtml .= $rclabels["causcodigos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='piedefoto' colspan='3' align='center'>";
		if($rcSession["params"]["causcodigos"]){
			$rcParams["tabla"] = "causa";
			$rcParams["descriptor"] = "causnombres";
			$rcParams["causcodigos"] = $rcSession["params"]["causcodigos"];
			$sbHtml .= getDesc($rcParams);	
		}else{
			$sbHtml .= "&nbsp;";
		}
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		
		
		$sbHtml .= "</table>";
		
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center' colspan='4'>&nbsp;</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='center'  colspan='4' ><b>";
		$sbHtml .= $rclabels["deptitle"];
		$sbHtml .= "</b></td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center' colspan='4'>&nbsp;</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='center'  colspan='4' ><b>";
		$sbHtml .= $rclabels["casotitle"];
		$sbHtml .= "</b></td>";
		$sbHtml .= "</tr>";
			
		if(is_array($rcSession["data"]["dataT"]) && $rcSession["data"]["dataT"]){
			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='piedefoto' align='center'  colspan='4' >";
			$sbHtml .= "<table align=\"center\" border=\"1\" width=\"100%\">";
			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["caso"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"75\">".$rclabels["cantidad"]["label"]."</td>";
			$sbHtml .= "</tr>";
			foreach($rcSession["data"]["dataT"] as $sbOrdenumeros=>$rcTmp){

				$sbHtml .= "<tr>";
				$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".$sbOrdenumeros."</td>";
				$sbHtml .= "<td class='piedefoto' align='left' width=\"75\">";

				$rcTime = $objDate->seconds2days_ha($rcTmp["CT"]);
					
				if(is_array($rcTime) && $rcTime){
					//seconds2days days hours minutes seconds
					$sbHtml .= $rcTime["days"]." ".$rclabels["day"]["label"]." ".$rcTime["hours"]." ".$rclabels["hour"]["label"]." ".
					$rcTime["minutes"]." ".$rclabels["min"]["label"]." ".$rcTime["seconds"]." ".$rclabels["seg"]["label"];
				}else{
					$sbHtml .= "&nbsp;";
				}
				$sbHtml .= "</td>";
				$sbHtml .= "</tr>";
			}
			$sbHtml .= "</table>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
		}

		$sbHtml .= "</table>";
		
	}
	return $sbHtml;
}
function getDesc($rcParams){

	settype($objGateway,"object");
	settype($rcTmp,"array");
	settype($sbResult,"string");

	if(is_array($rcParams) && $rcParams){
		
		$objGateway = Application::getDataGateway($rcParams["tabla"]);
		
		switch ($rcParams["tabla"]){
			case "tipoorden" :
				$rcTmp =  $objGateway->getByIdTipoorden($rcParams["tiorcodigos"]);
			break;
			case "evento" : 
				$rcTmp =  $objGateway->getByIdEvento($rcParams["tiorcodigos"],$rcParams["evencodigos"]);
			break;
			case "causa" :
				$rcTmp =  $objGateway->getByIdCausa($rcParams["tiorcodigos"],$rcParams["evencodigos"],$rcParams["causcodigos"]);
			break;
		}

		if(is_array($rcTmp) && $rcTmp){
			$rcTmp = $rcTmp[0];
			$sbResult = $rcTmp[$rcParams["descriptor"]];
		}
	}

	return $sbResult;
}
?>