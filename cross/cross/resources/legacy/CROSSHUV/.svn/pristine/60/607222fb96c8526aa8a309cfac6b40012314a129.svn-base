<?php
/*
 * Created on 08/11/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawIndicator($params, & $smarty) {

	extract($_REQUEST);

	settype($objDate, "object");
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcNameDep,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($rcTime,"array");
	settype($sbHtml,"string");
	settype($sbOrgacodigos,"string");
	settype($sbTotalC, "string");
	settype($sbOrdenumeros, "string");
	settype($nuPor, "float");
	settype($nuPorTmp, "float");
	settype($nuCant, "integer");
	settype($nuCantTmp, "integer");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".indicador.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	$objDate = Application :: loadServices("DateController");

	$rcSession = WebSession :: getProperty("_rcIndicador");

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

		$rcTime = $objDate->seconds2days($rcSession["data"]["cantT"]);

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
		$sbHtml .= "<td align='center' colspan='4'>&nbsp;</td>";
		$sbHtml .= "</tr>";

		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='piedefoto' align='center'  colspan='4' ><b>";
		$sbHtml .= $rclabels["deptitle"];
		$sbHtml .= "</b></td>";
		$sbHtml .= "</tr>";

		if(is_array($rcSession["data"]["dataD"]) && $rcSession["data"]["dataD"]){

			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["orgacodigos_i"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["organombres"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["cantidad"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["porcentaje"]["label"]."</td>";
			$sbHtml .= "</tr>";

			foreach($rcSession["data"]["dataD"] as $sbOrgacodigos=>$nuCant){
				$sbHtml .= "<tr>";
				$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".$sbOrgacodigos."</td>";
				$rcNameDep[$sbOrgacodigos] = getDescDep($sbOrgacodigos);
				$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".$rcNameDep[$sbOrgacodigos]."</td>";
				$sbHtml .= "<td class='piedefoto' align='left' width=\"25\">";
				$rcTime = $objDate->seconds2days($nuCant);
					
				if(is_array($rcTime) && $rcTime){
					//seconds2days days hours minutes seconds
					$sbHtml .= $rcTime["days"]." ".$rclabels["day"]["label"]." ".$rcTime["hours"]." ".$rclabels["hour"]["label"]." ".
					$rcTime["minutes"]." ".$rclabels["min"]["label"]." ".$rcTime["seconds"]." ".$rclabels["seg"]["label"];
				}else{
					$sbHtml .= "&nbsp;";
				}
				$sbHtml .= "</td>";
					
				//porcentaje
				$nuPor = round(($nuCant*100)/$rcSession["data"]["cantT"]);
					
				$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".(string)$nuPor."%</td>";
				$sbHtml .= "</tr>";
				$nuCantTmp += $nuCant;
				$nuPorTmp += $nuPor;
			}
			$sbHtml .= "<td class='piedefoto' align='left' width=\"25\">&nbsp;</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["total"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='left' width=\"25\">";
			$rcTime = $objDate->seconds2days($nuCantTmp);
				
			if(is_array($rcTime) && $rcTime){
				//seconds2days days hours minutes seconds
				$sbHtml .= $rcTime["days"]." ".$rclabels["day"]["label"]." ".$rcTime["hours"]." ".$rclabels["hour"]["label"]." ".
				$rcTime["minutes"]." ".$rclabels["min"]["label"]." ".$rcTime["seconds"]." ".$rclabels["seg"]["label"];
			}else{
				$sbHtml .= "&nbsp;";
			}
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".(string)$nuPorTmp."%</td>";
			$sbHtml .= "<tr>";
		}
		$nuPorTmp = 0;
		$nuCantTmp = 0;

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
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["caso"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["cantidad"]["label"]."</td>";
			$sbHtml .= "<td class='titulofila' align='center' colspan=\"2\">".$rclabels["deptitle"]."</td>";
			$sbHtml .= "</tr>";
			foreach($rcSession["data"]["dataT"] as $sbOrdenumeros=>$rcTmp){

				$sbHtml .= "<tr>";
				$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".$sbOrdenumeros."</td>";
				$sbHtml .= "<td class='piedefoto' align='left' width=\"25\">";

				$rcTime = $objDate->seconds2days($rcTmp["CT"]);
					
				if(is_array($rcTime) && $rcTime){
					//seconds2days days hours minutes seconds
					$sbHtml .= $rcTime["days"]." ".$rclabels["day"]["label"]." ".$rcTime["hours"]." ".$rclabels["hour"]["label"]." ".
					$rcTime["minutes"]." ".$rclabels["min"]["label"]." ".$rcTime["seconds"]." ".$rclabels["seg"]["label"];
				}else{
					$sbHtml .= "&nbsp;";
				}
				$sbHtml .= "</td>";
				$sbHtml .= "<td class='piedefoto' align='center' colspan=\"2\">";

				if(is_array($rcTmp["AT"]) && $rcTmp["AT"]){

					$sbHtml .= "<table align=\"center\" border=\"1\" width=\"100%\">";
					$sbHtml .= "<tr>";
					$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["orgacodigos_i"]["label"]."</td>";
					$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["organombres"]["label"]."</td>";
					$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["cantidad"]["label"]."</td>";
					$sbHtml .= "<td class='titulofila' align='center' width=\"25\">".$rclabels["porcentaje"]["label"]."</td>";
					$sbHtml .= "</tr>";
					foreach($rcTmp["AT"] as $sbOrgacodigos=>$nuCant){
						$sbHtml .= "<tr>";
						$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".$sbOrgacodigos."</td>";
						if(!array_key_exists($sbOrgacodigos, $rcNameDep)){
							$rcNameDep[$sbOrgacodigos] = getDescDep($sbOrgacodigos);
						}
						$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".$rcNameDep[$sbOrgacodigos]."</td>";
						$sbHtml .= "<td class='piedefoto' align='left' width=\"25\">";
						$rcTime = $objDate->seconds2days($nuCant);
							
						if(is_array($rcTime) && $rcTime){
							//seconds2days days hours minutes seconds
							$sbHtml .= $rcTime["days"]." ".$rclabels["day"]["label"]." ".$rcTime["hours"]." ".$rclabels["hour"]["label"]." ".
							$rcTime["minutes"]." ".$rclabels["min"]["label"]." ".$rcTime["seconds"]." ".$rclabels["seg"]["label"];
						}else{
							$sbHtml .= "&nbsp;";
						}
						$sbHtml .= "</td>";
							
						//porcentaje
						$nuPor = round(($nuCant*100)/$rcTmp["CT"]);
							
						$sbHtml .= "<td class='piedefoto' align='center' width=\"25\">".(string)$nuPor."%</td>";
						$sbHtml .= "</tr>";
					}

					$sbHtml .= "</table>";
						
				}else{
					$sbHtml .= "&nbsp;";
				}
				$sbHtml .= "</td>";
				$sbHtml .= "</tr>";
			}
		}

		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
function getDescDep($sbOrgacodigos){

	settype($objService,"object");
	settype($rcTmp,"array");
	settype($sbResult,"string");

	if($sbOrgacodigos!="" && $sbOrgacodigos!=null){

		$objService = Application::loadServices("Human_resources");
		$rcTmp =  $objService->getDataEntesOrg($sbOrgacodigos,true);

		if(is_array($rcTmp) && $rcTmp){
			$sbResult = $rcTmp["nombre"];
		}
	}

	return $sbResult;
}
?>