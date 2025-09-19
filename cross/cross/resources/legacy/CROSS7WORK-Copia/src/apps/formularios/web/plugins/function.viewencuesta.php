<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_viewEncuesta($params, & $smarty) {
	extract($_REQUEST);
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcDescP,"array");
	settype($rcDescR,"array");
	settype($rcDescE,"array");
	settype($rcDescT,"array");
	settype($rcTmp,"array");
	settype($rcData,"array");
	settype($rcData_E,"array");
	settype($rcData_T,"array");
	settype($rcRow,"array");
	settype($sbHtml,"string");
	settype($sbIndex,"string");
	settype($sbLabel,"string");
	settype($nuPregcodigon,"integer");
	settype($nuCont,"integer");
	settype($nuContE,"integer");
	settype($nuContT,"integer");

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".encuesta.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	$rcSession = WebSession :: getProperty("_rcEncuesta");
	
	if($rcSession && is_array($rcSession)){
		//se pinta las respuestas configuradas.
		$rcDescP=$rcSession["lp"];
		$rcDescR=$rcSession["lr"];
		$rcDescE=$rcSession["le"];
		$rcDescT=$rcSession["lt"];
		$rcData_E=$rcSession["ae"];
		$rcData_T=$rcSession["at"];
		
		$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'>&nbsp</td>";
		$sbHtml .= "</tr>";
		//ciclo para pintar los ejes
		if(is_array($rcData_E) && $rcData_E){
			$nuContE = 1;
			foreach($rcData_E as $sbIndex=>$rcRow){
				$sbLabel = (string)$nuContE.". ".$rcDescE[$sbIndex];
				$sbHtml .= "<tr>";
				$sbHtml .= "<td align='left'><strong><font size=\"3\">".$sbLabel."</font></strong></td>";
				$sbHtml .= "</tr>";
				$sbHtml .= "<tr>";
				if(is_array($rcRow) && $rcRow){
					$sbHtml .= "<td align='center'>";
						$sbHtml .= "<table align=\"center\" border=\"0\" width=\"100%\">";
						foreach($rcRow as $nuContT=>$sbIndex){
							$nuContT++;
							$sbLabel = (string)$nuContE.".".(string)$nuContT." ".$rcDescT[$sbIndex];
							$sbHtml .= "<tr>";
							$sbHtml .= "<td align='left'><strong><font size=\"3\">".$sbLabel."</font></strong></td>";
							$sbHtml .= "</tr>";
							$sbHtml .= "<tr>";
							$sbHtml .= "<td align='center'>";
							
							//pinta las respuestas
							$sbHtml .= "<table align=\"center\" border=\"1\" width=\"100%\">";
							$sbHtml .= "<tr>";
							$sbHtml .= "<td align='center'>&nbsp</td>";
							$sbHtml .= "</tr>";
							
							foreach($rcSession["pi"] as $nuCont=>$nuPregcodigon){
								if(in_array($nuPregcodigon,$rcData_T[$sbIndex])){
									$rcData = $rcSession["cp"][$nuPregcodigon];
									$sbHtml .= "<tr>";
									$sbHtml .= "<td align='left'><strong>";
									$sbHtml .= $rcDescP[$nuPregcodigon];
									$sbHtml .= "</strong></td>";
									$sbHtml .= "</tr>";
									$sbHtml .= "<tr>";
									$sbHtml .= "<td  align='center'>";
									$rcTmp = $rcData["answer"];
									if($rcTmp && is_array($rcTmp)){
										$sbHtml .= "<table border=\"0\" align=\"center\" width=\"100%\">";
										$sbHtml .= "<tr>";
										$sbHtml .= getObjeto($nuPregcodigon,$rcData["objedescrips"],$rcTmp,$rcDescR);
										$sbHtml .= "</tr>";
										$sbHtml .= "</table>";
									}else{
										$sbHtml .="&nbsp";
									}
									$sbHtml .= "</td>";
									$sbHtml .= "</tr>";
									$sbHtml .= "<tr>";
									$sbHtml .= "<td align='center'><div id=\"div_".$nuPregcodigon."\" align=\"center\" style=\"visibility:hidden;display:'none';height:0\"></div></td>";
									$sbHtml .= "</tr>";	
								}
							}
							$sbHtml .= "</table>";
							
							$sbHtml .= "</td>";
							$sbHtml .= "</tr>";
						}
						$sbHtml .= "</table>";
					$sbHtml .= "</td>";
				}else{
					$sbHtml .= "<td align='center'>&nbsp</td>";	
				}
				$sbHtml .= "</tr>";
				$nuContE++;
			}
		}
		$sbHtml .= "</table>";
		
	}
	return $sbHtml;
}
function getObjeto($nuPregcodigon,$sbObjedescrips,$rcData, $rcLabels){
	
	settype($rcParams,"array");
	settype($rcValue,"string");
	settype($sbPath,"string");
	settype($sbHtml,"string");
	settype($sbFunction,"string");
	settype($sbName,"string");
	settype($sbId,"string");
	settype($nuCont,"integer");
	
	if($nuPregcodigon && $sbObjedescrips && $rcData){

		$sbFunction = 'smarty_function_'.$sbObjedescrips;
		$sbPath = Application::getPluginsDirectory()."/function.".$sbObjedescrips.".php";
		include_once($sbPath);
		
		switch($sbObjedescrips){
			case "radio":
				$sbName = $nuPregcodigon."_Radio_".$nuPregcodigon;
				foreach($rcData as $rcTmp){
					$sbId = $nuPregcodigon."_".$rcTmp["oprecodigon"];
					//este objeto debe pintar un radio por cada respuesta
					$rcParams = array("name"=>$sbName,"id"=>$sbId,"value"=>$rcTmp["oprecodigon"],"onClick"=>"jsSelectedAnswer(this);");
					$sbHtml .= "<td align='left'>";
					$sbHtml .= $sbFunction($rcParams,$this,false);
					$sbHtml .= $rcLabels[$rcTmp["oprecodigon"]];
					$sbHtml .= "</td>";	
				}
			break;
			case "select_row_table":
				$sbName = $nuPregcodigon."_Select_".$nuPregcodigon;
				$sbId = $sbName;
				//este pintamos lo que sera las opciones de los objetos
				$rcValue[$nuCont]["indice"] = "";
				$rcValue[$nuCont]["desc"] = "---";
				$nuCont++;
				foreach($rcData as $rcTmp){
					$rcValue[$nuCont]["indice"] = $rcTmp["oprecodigon"];
					$rcValue[$nuCont]["desc"] = $rcLabels[$rcTmp["oprecodigon"]];
					$nuCont++;
				}	
				$rcParams = array("name"=>$sbName,"id"=>$sbName,"value"=>"indice","label"=>"desc","rcValues"=>$rcValue,"onchange"=>"jsSelectedAnswer(this);");
				$sbHtml .= "<td align='left'>";
				$sbHtml .= $sbFunction($rcParams,$this,false);
				$sbHtml .= "</td>";	
			break;
			case "textarea":
				$sbName = $nuPregcodigon."_Textarea_".$nuPregcodigon;
				$sbId = $nuPregcodigon."_".$rcData[0]["oprecodigon"];
				$rcParams = array("id"=>$sbId,"name"=>$sbName,"cols"=>"200","rows"=>"10");
				$sbHtml .= "<td align='left'>";
				$sbHtml .= $sbFunction($rcParams,$this,false);
				$sbHtml .= "</td>";	 
			break;
		}
	}
	
	return $sbHtml;
}
?>