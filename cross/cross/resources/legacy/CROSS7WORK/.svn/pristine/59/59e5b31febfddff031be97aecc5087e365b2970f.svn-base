<?php
/*
 * Created on 2/Aug/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_viewNewQestions($params, & $smarty) {
	extract($_REQUEST);
	settype($rcUser,"array");
	settype($rcSession,"array");
	settype($rcDescP,"array");
	settype($rcDescR,"array");
	settype($rcTmp,"array");
	settype($rcSelect,"array");
	settype($rcData,"array");
	settype($rcAncestry,"array");
	settype($sbHtml,"string");
	settype($nuPregcodigon,"integer");
	settype($nuCont,"integer");
	settype($nuCant,"integer");


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
		$rcSelect = $rcSession["select"];
		
		//se determina la ascendencia de la pregunta pues se debe redibujar
		$rcAncestry = getAncestry($rcSession["pa"],$rcSession["all"]);
		if($rcAncestry && is_array($rcAncestry)){
			$nuCant = sizeof($rcAncestry);
			$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
			for($nuCont=0;$nuCont<$nuCant;$nuCont++){
				if(!in_array($rcAncestry[$nuCont],$rcSession["pi"])){
					$nuPregcodigon = $rcAncestry[$nuCont];
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
						$sbHtml .= "<table border=\"1\" align=\"center\" width=\"100%\">";
						$sbHtml .= "<tr>";
						$sbHtml .= getObjeto($nuPregcodigon,$rcData["objedescrips"],$rcTmp,$rcDescR,$rcSelect[$nuPregcodigon],$rcAncestry[0]);
						$sbHtml .= "</tr>";
						$sbHtml .= "</table>";
					}else{
						$sbHtml .="&nbsp";
					}
					$sbHtml .= "</td>";
					$sbHtml .= "</tr>";
				}	
			}
			$sbHtml .= "</table>";
		}
	}
	return $sbHtml;
}
function getObjeto($nuPregcodigon,$sbObjedescrips,$rcData,$rcLabels,$nuOprecodigon,$sbAncestry){
	
	settype($rcParams,"array");
	settype($rcValue,"array");
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
				$sbName = $nuPregcodigon."_Radio_".$sbAncestry;
				foreach($rcData as $rcTmp){
					unset($rcParams["checked"]);
					$sbId = $nuPregcodigon."_".$rcTmp["oprecodigon"];
					//este objeto debe pintar un radio por cada respuesta
					$rcParams = array("name"=>$sbName,"id"=>$sbId,"value"=>$rcTmp["oprecodigon"],"onClick"=>"jsSelectedAnswer(this);");
					if($nuOprecodigon){
						if($rcTmp["oprecodigon"]==$nuOprecodigon){
							$rcParams["checked"] = 'true';
						}	
					}
					$sbHtml .= "<td align='left'>";
					$sbHtml .= $sbFunction($rcParams,$this,false);
					$sbHtml .= $rcLabels[$rcTmp["oprecodigon"]];
					$sbHtml .= "</td>";	
				}
			break;
			case "select_row_table":
				$sbName = $nuPregcodigon."_Select_".$sbAncestry;
				$sbId = $sbName;
				//este pintamos lo que sera las opciones de los objetos
				unset($_REQUEST[$sbName]);
				if($nuOprecodigon){
					$_REQUEST[$sbName]=$nuOprecodigon;	
				}
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
				$sbName = $nuPregcodigon."_Textarea_".$sbAncestry;
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
function getAncestry($nuPregcodigon,$rcData){
	settype($rcIndex,"array");
	settype($nuIndex,"integer");
	
	if($nuPregcodigon && $rcData && is_array($rcData)){
		
		select($nuPregcodigon, $rcData, $rcIndex, $nuIndex);
		$rcIndex[$nuIndex] = (string)$nuPregcodigon;
	}
	return $rcIndex;
}
function select($nuPregcodigon, & $rcData, & $rcResult, & $nuIndex) {
		
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	$nuCant = sizeof($rcData);
	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($rcData[$nuCont]["pregcodigon"] == $nuPregcodigon) {
			if($rcData[$nuCont]["pregpadren"]){
				select($rcData[$nuCont]["pregpadren"], $rcData, $rcResult, $nuIndex);
				$rcResult[$nuIndex] = $rcData[$nuCont]["pregpadren"];
				$nuIndex ++;	
			}
		}
	}
	return;
}
?>