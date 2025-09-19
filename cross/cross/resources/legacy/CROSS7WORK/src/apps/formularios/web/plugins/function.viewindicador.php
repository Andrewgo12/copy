<?php
/**
 * * @Copyright 2009 Parquesoft
 *
 * Reporte por tipo de servicios
 * @author freina<freina@fullengine.com>
 *
 * @location Cali - Colombia
 */
function smarty_function_viewIndicador($params, & $smarty) {
	extract($params);
	extract($_REQUEST);

	settype($objManager,"object");
	settype($objDate,"object");
	settype($rcReport,"array");
	settype($rcData,"array");
	settype($rcUser, "array");
	settype($sbHtml, "string");

	$rcUser = Application::getUserParam();
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".viewreport.php");

	if($fechaini && $fechafin && $formcodigon && $orgacodigos){

		$objManager = Application::getDomainController("IndicadorManager");
		$objDate = Application::loadServices("DateController");

		//Ajusta las fechas de inicio y fin
		$rcData["fechaini"] = $objDate->fncdatehourtoint($fechaini);
		$rcData["fechafin"] = $objDate->fncdatehourtoint($fechafin);
		$rcData["formcodigon"] = $formcodigon;
		$rcData["orgacodigos"] = $orgacodigos;

		$objManager->setData($rcData);
		$objManager->getIndicador();
		$rcReport = $objManager->getResult();
			
		if(is_array($rcReport) && $rcReport){
			$sbHtml .= getTablaReport($rcReport);
		}
		else {
			$sbHtml .= "<script>alert('".$rcmessages[22]."');window.close();</script>";
		}
	}else{
		$sbHtml .= "<script>alert('".$rcmessages[0]."');window.close();</script>";
	}

	return $sbHtml;
}

function getTablaReport($rcReport){

	settype($objDate,"object");
	settype($objService,"object");
	settype($rcUser,"array");
	settype($rcDescP,"array");
	settype($rcDescE,"array");
	settype($rcDescT,"array");
	settype($rcTmp,"array");
	settype($rcData_E,"array");
	settype($rcData_T,"array");
	settype($rcRow,"array");
	settype($rcIndex, "array");
	settype($rcAll, "array");
	settype($rcExcel, "array");
	settype($rcTotal, "array");
	settype($rcTmpPA, "array");
	settype($rcTmp_RU, "array");
	settype($rcTmp_DR, "array");
	settype($rcRowRU, "array");
	settype($rcData,"array");
	settype($rcIndex_P, "array");
	settype($rcAv, "array");
	settype($rcAvt, "array");
	settype($rcPor, "array");
	settype($rcRowAv, "array");
	settype($rcUserW, "array");
	settype($sbHtml,"string");
	settype($sbIndex,"string");
	settype($sbIndexT, "string");
	settype($sbValue, "string");
	settype($sbIndexAv, "string");
	settype($nuPregcodigon,"integer");
	settype($nuCont,"integer");
	settype($nuContT,"integer");
	settype($nuCant, "integer");
	settype($nuIndex, "integer");
	settype($nuContEx, "integer");
	settype($nuCantCell, "integer");
	settype($nuConst1, "integer");
	settype($nuConst2, "integer");
	settype($nuConst3, "integer");
	settype($nuCantU, "integer");

	//dos celdas para el servicio y la fecha
	$nuConst1 = 2;
	//celdas para totales por tema
	$nuConst2 = 3;
	//determina si deacuredo al promedio esta satisfecho
	$nuConst3 = 4;
	//catidad de encuestas usuario web
	$nuCantU = 0;
	
	$objService = Application::loadServices('General');
    $rcUserW = $objService->getParam("cross300","web_user_conf");

	//conteo inicial
	$nuCantCell = $nuConst1;

	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".viewindicador.php");
	
	$objDate = Application::loadServices("DateController");

	if($rcReport && is_array($rcReport)){
		//se pinta las respuestas configuradas.
		$rcDescP=$rcReport["lp"];
		$rcDescE=$rcReport["le"];
		$rcDescT=$rcReport["lt"];
		$rcData_E=$rcReport["ae"];
		$rcData_T=$rcReport["at"];
		$nuCant = $rcReport["total"];
		$rcAll = $rcReport["all"];
		$rcTmpPA = $rcReport["preg_a"];
		$rcTmp_RU = $rcReport["resp_usu"] ;
		$rcTmp_DR = $rcReport["det_resp_usu"];
		$rcIndex_P = $rcReport["cp"];

		//se realiza el analisis de opraciones que se deben realizar en cada celda
		if(is_array($rcData_E) && $rcData_E){
			//recorre los ejes
			foreach($rcData_E as $sbIndex=>$rcRow){
				if(is_array($rcRow) && $rcRow){
					//recorre los temas
					foreach($rcRow as $nuContT=>$sbIndexT){
						//recorre todas las preguntas iniciales de la configuracion y selecciona la de los temas
						foreach($rcReport["pi"] as $nuCont=>$nuPregcodigon){
							if(in_array($nuPregcodigon,$rcData_T[$sbIndexT])){
								$rcIndex = array();
								$nuIndex = 0;
								select($nuPregcodigon, $rcAll, $rcIndex, $nuIndex);

								if(is_array($rcIndex) && $rcIndex){
									$rcTmp = array();
									foreach($rcIndex as $sbValue){
										if(!in_array($sbValue,$rcTmpPA)){
											$rcTmp[] = $sbValue;
										}
									}
									$rcIndex = $rcTmp;
								}

								if(!in_array($nuPregcodigon,$rcTmpPA)){
									if(is_array($rcIndex) && $rcIndex){
										array_unshift($rcIndex,$nuPregcodigon);
									}else{
										$rcIndex=array($nuPregcodigon);
									}
								}

								if(is_array($rcIndex) && $rcIndex){
									if(is_array($rcTotal[$sbIndex][$sbIndexT]) && $rcTotal[$sbIndex][$sbIndexT]){
										$rcTmp = $rcTotal[$sbIndex][$sbIndexT];
										$rcTotal[$sbIndex][$sbIndexT] = array_merge($rcTmp,$rcIndex);
									}else{
										$rcTotal[$sbIndex][$sbIndexT] = $rcIndex;
									}
									$nuCantCell += sizeof($rcIndex);
								}
							}
						}
						//si el tema tiene preguntas suma las celdas de operaciones
						if(is_array($rcTotal[$sbIndex][$sbIndexT]) && $rcTotal[$sbIndex][$sbIndexT]){
							$nuCantCell +=$nuConst2;
						}
					}
				}
			}
		}


		//se inicia el armado de la matriz

		if(is_array($rcTotal) && $rcTotal){

			$rcExcel[0] = array_pad(array(), $nuCantCell, null);
			$rcExcel[1] = array_pad(array(), $nuCantCell, null);
			$rcExcel[2] = array_pad(array(), $nuCantCell, null);
			$nuContEx = 3;
			//arma el arreglo total
			for($nuCont=0;$nuCont<$nuCant;$nuCont++){
				$rcExcel[$nuContEx] = array_pad(array(), $nuCantCell, 0);
				$nuContEx ++;
			}
			$nuCont = $nuConst1;
			$nuContT = $nuConst1;
			$nuIndex = $nuConst1;			

			//se arma la primera linea del excel
			//el primer ciclo es de ejes
			foreach($rcTotal as $sbIndex => $rcTmp){
				$rcExcel[0][$nuCont] = $rcDescE[$sbIndex];
				
				//label servicio y fechas
				$rcExcel[2][0] = $rclabels["servicio"]["label"];
				$rcExcel[2][1] = $rclabels["fecha"]["label"];
				
				//ciclo de temas
				foreach($rcTmp as $sbIndexT=>$rcRow){
					
					$rcAv = array();
					$rcExcel[1][$nuContT] = $rcDescT[$sbIndexT];
					foreach ($rcRow as $nuPregcodigon) {
						$rcExcel[2][$nuIndex] = $rcDescP[$nuPregcodigon];
						
						//aca se evaluan una a una las respuestas
						$nuContEx = 3;
						foreach($rcTmp_RU as $rcRowRU){
							
							if(!$rcExcel[$nuContEx][0]){
								$objService = Application :: loadServices("Human_resources");
								$rcData = $objService->getDataEntesOrg($rcRowRU["orgacodigos"],true);
								
								if(is_array($rcData) && $rcData){
									$rcExcel[$nuContEx][0] = $rcData["nombre"];	
								}else{
									$rcExcel[$nuContEx][0] = $rcRowRU["orgacodigos"];
								}
								$rcExcel[$nuContEx][1] = $objDate->fncformatofecha($rcRowRU["reusfecingn"]);

								//cantidad de encuestas con usuario web
								if($rcRowRU["usuacodigos"]==$rcUserW["user"]){
									$nuCantU ++;	
								}
							}
							
							$rcExcel[$nuContEx][$nuIndex] = $rcIndex_P[$nuPregcodigon][$rcTmp_DR[$rcRowRU["reuscodigon"]][$nuPregcodigon]["oprecodigon"]];
							
							if($rcTmp_DR[$rcRowRU["reuscodigon"]][$nuPregcodigon]["oprecodigon"]){
								$rcAv[$nuContEx][0] += $rcIndex_P[$nuPregcodigon][$rcTmp_DR[$rcRowRU["reuscodigon"]][$nuPregcodigon]["oprecodigon"]];
								$rcAv[$nuContEx][1] ++;
							}
							
							$nuContEx ++;
						}
						
						$nuIndex ++;
					}
					//labels de los calculos por tema
					$rcExcel[2][$nuIndex] = $rclabels["promedio"]["label"];
					//calculo de promedios
					foreach($rcAv as $sbIndexAv => $rcRowAv){
						$rcExcel[$sbIndexAv][$nuIndex]	= number_format (($rcRowAv[0]/$rcRowAv[1]),3);
						
						$rcAvt[$nuIndex][0] += $rcExcel[$sbIndexAv][$nuIndex];
						$rcAvt[$nuIndex][1] ++;
						
						if($rcExcel[$sbIndexAv][$nuIndex] >= $nuConst3){
							$rcRowAv[2] = true;
						}else{
							$rcRowAv[2] = false;
						}
						$rcAv[$sbIndexAv] = $rcRowAv;
						
						//cambio de formato
						$rcExcel[$sbIndexAv][$nuIndex]	= number_format ($rcExcel[$sbIndexAv][$nuIndex],3,',','.');
					}
					
					//total de promedio por tema
					if(is_array($rcAvt[$nuIndex]) && $rcAvt[$nuIndex]){
						$rcAvt[$nuIndex] = number_format (($rcAvt[$nuIndex][0]/$rcAvt[$nuIndex][1]),3,',','.');
					}else{
						$rcAvt[$nuIndex] = 0;
					}
					
					$nuIndex ++;
					
					$rcExcel[2][$nuIndex] = $rclabels["formula"]["label"];
					foreach($rcAv as $sbIndexAv => $rcRowAv){
						if($rcRowAv[2]){
							$rcExcel[$sbIndexAv][$nuIndex]	= $rclabels["si"]["label"];
							$rcAvt[$nuIndex] ++;	
						}else{
							$rcExcel[$sbIndexAv][$nuIndex]	= $rclabels["no"]["label"];
						}
						
					}
					
					//cantidad de encuestas satisfechas
					if($rcAvt[$nuIndex]){
						$rcPor[$nuIndex-1] = $rclabels["por"]["label"];
						$rcPor[$nuIndex] = number_format (($rcAvt[$nuIndex]*100)/$nuCant,2,',','.');
						$rcPor[$nuIndex] = (string) $rcPor[$nuIndex]."%";
					}else{
						$rcAvt[$nuIndex] = 0;
						$rcPor[$nuIndex-1] = $rclabels["por"]["label"];
						$rcPor[$nuIndex] = "0%";
					}
					$nuIndex ++;
					
					$rcExcel[2][$nuIndex] = $rclabels["encuesta"]["label"];
					foreach($rcAv as $sbIndexAv => $rcRowAv){
						$rcExcel[$sbIndexAv][$nuIndex]	= 1;
						$rcAvt[$nuIndex] ++;
					}
					
					//cantidad de encuestas
					if(!$rcAvt[$nuIndex]){
						$rcAvt[$nuIndex] = 0;
					}
					$nuIndex ++;
					
					$nuCont += (sizeof($rcRow) + $nuConst2);
					$nuContT += (sizeof($rcRow) + $nuConst2 );
				}
			}
		}
		if(is_array($rcAvt) && $rcAvt){
			$rcExcel[$nuContEx] = array_pad(array(), $nuCantCell, null);
			foreach ($rcAvt as $sbIndexAv=>$sbValue) {				
				$rcExcel[$nuContEx][$sbIndexAv]=$sbValue;
			}
		}
		$nuContEx ++;
		if(is_array($rcPor) && $rcPor){
			$rcExcel[$nuContEx] = array_pad(array(), $nuCantCell, null);
			foreach ($rcPor as $sbIndexAv=>$sbValue) {				
				$rcExcel[$nuContEx][$sbIndexAv]=$sbValue;
			}
		}
		$nuContEx ++;
		$rcExcel[$nuContEx] = array_pad(array(), $nuCantCell, null);
		$rcExcel[$nuContEx][0] = $rclabels["WU"]["label"];
		$rcExcel[$nuContEx][1] = $nuCantU;
		$rcExcel[$nuContEx][2] = $rclabels["OU"]["label"];
		$rcExcel[$nuContEx][3] = $nuCant - $nuCantU;
	}

	$sbHtml = getExcel($rcExcel);

	return $sbHtml;

}
function getExcel($rcData){

	settype($objLib, "object");
	settype($rcUser,"array");
	settype($sbUmask,"string");
	settype($sbPath,"string");
	settype($sbTmp,"string");
	settype($sbHtml, "string");

	$rcUser = Application::getUserParam();
	include ($rcUser["lang"]."/".$rcUser["lang"].".viewindicador.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	if(is_array($rcData) && $rcData){
		//Hallemos el nombre del documento a generar
		$sbPath = Application::getTmpDirectory();
		//se valida la existencia del directorio
		if(!is_dir($sbPath)){
			$sbUmask = umask(0);
			mkdir($sbPath, 0775);
			umask($sbUmask);
		}
		$sbTmp = Application :: getTmpDir();
		$sbTmp = substr($sbTmp,(strpos($sbTmp,"/")+1));
		$nameExcel = $name.rand(0,1000).".xls";

		//HTML TO EXCEL
		//Instancia la libreria y genera el libro
		$sbPath = $sbTmp."/".$nameExcel;
		$objLib = Application::loadLib("excel");
		$sbResult = $objLib->execute($rcData,$sbPath);

		$sbHtml = "<tr><td align=center class='piedefoto'><a href=javascript:abrirPdf('".$sbPath."');window.close();>".$rclabels_crl["CmdDownload"]."</a></td></tr>";
	}

	return $sbHtml;
}
function select($nuPregcodigon, & $rcData, & $rcResult, & $nuIndex) {

	settype($sbIndex, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");

	$nuCant = sizeof($rcData);
	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($rcData[$nuCont]["pregpadren"] == $nuPregcodigon) {
			$rcResult[$nuIndex] = $rcData[$nuCont]["pregcodigon"];
			$nuIndex ++;
			select($rcData[$nuCont]["pregcodigon"], $rcData, $rcResult, $nuIndex);
		}
	}
	return;
}
?>