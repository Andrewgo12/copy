<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
*  Consulta y pinta la ficha de una tarea
* @author creyes <cesar.reyes@parquesoft.com>
* @date 21-sep-2004 9:05:31
* @location Cali-Colombia
*/
function smarty_function_fichatarea($params, &$smarty){

	extract($_REQUEST);
	if(!$acta)
		return null;
	//Trae los datos del acta
	$service = Application :: loadServices("Workflow");
	$rcFicha = $service->getByIdActaFicha($acta);
	$rcFicha = $rcFicha[0];
	
	//Trae los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	//Carga el servicio de control de fechas 
	$servceDate = Application :: loadServices("DateController");
    
	//Trae las etiquetas
	include ($rcuser["lang"]."/".$rcuser["lang"].".transfertareas.php");
		
	//Carga el servicio de HTML para elaborar las fichas y los listados
	$htmlService = Application::loadServices("Html");
	$rcParams["cols"] = 2;

	//Ficha del acta
    $rcTarea["tarecodigos"] = $rcFicha["tarecodigos"];

	$objGeneral = Application::loadServices("General");
	$seguimiento = $objGeneral->getParam("cross300","TAREA_SEGUIMIENTO");
	if($rcFicha["tarecodigos"] == $seguimiento[0])
	    unset($rcFicha["actaestacts"]);

	unset($rcFicha["tarecodigos"]);
	$sbHtmlFicha = $htmlService->genCard($rcTarea,$rclabels,$rcParams);
	$sbHtmlFicha .= $htmlService->genCard($rcFicha,$rclabels,$rcParams)."<hr><br>";
	
    //Pinta las transferencias
	$gatewaySql = Application :: getDataGateway("SqlExtended");
    $rcTranferencias = $gatewaySql->getTranfertarea($acta);
    if(is_array($rcTranferencias)){
        $rcHtml[] = "<tr><th><div align='left'>".$rclabels["transferencia"]["label"]."</div></th></tr>";
        $rcHtml[] = "<tr><td class='piedefoto'><table align='center' width='80%'>";
        
		//Pinta el encabezado
		$rcHtml[] = "<tr>
						<td class='titulofila'>".$rclabels["orgacodigos"]["label"]."</td>
						<td class='titulofila'>".$rclabels["trtafechan"]["label"]."</td>
						<td class='titulofila'>".$rclabels["trtaobservas"]["label"]."</td>
					</tr>";
		foreach($rcTranferencias as $rcTmpValues){
			$rcHtml[] = "<tr>
							<td class=''>".$rcTmpValues["organombres"]."</td>
							<td class=''>".$servceDate->fncformatofechahora($rcTmpValues["trtafechan"])."</td>
							<td class=''>".$rcTmpValues["trtaobservas"]."</td>
					 	</tr>";
		}
        $rcHtml[] = "</table></td></tr>";
        $sbHtmlFicha .= implode("\n",$rcHtml);
        unset($rcHtml);
    }
   	//Lista de actenciones
	$rcActas = $gatewaySql->getListActaempresa($acta);
	
	//$rcParams["size_label"] = "30%";
	$rcParams["size_table"] = "70%";
	$rcParams["size_data"] = "100%";
	$rcParams["size_label"] = "25%";
	$rcParams["size_puntos"] = "5%";
	$rcParams["size_datos"] = "70%";
    
	if(is_array($rcActas))
	{
		foreach($rcActas as $key => $rcFichaActa)
		{
			//Consulta las actividades
			$rcActividades = $gatewaySql->getActiviactaByAcem($rcFichaActa["acemnumeros"]);
            unset($rcFichaActa["acemnumeros"]);
            $rcObservaciones["acemobservas"] = $rcFichaActa["acemobservas"];
            unset($rcFichaActa["acemobservas"]);
            
			//acomoda los datos del grupo
			if(is_array($rcFichaActa["acemusuars"])){
				foreach($rcFichaActa["acemusuars"] as $k => $rcPersonal){
					($rcPersonal["persrespons"] == 'S')?$respon = "*":$respon = "";
					$rcTemporal[$k] = ($k + 1).". ({$rcPersonal["persidentifs"]}) {$rcPersonal["persnombres"]} {$rcPersonal["persapell1s"]} {$rcPersonal["persapell2s"]}$respon";
				}
				$rcFichaActa["acemusuars"] = implode("<br>\n",$rcTemporal);
			}else{
				$rcFichaActa["acemusuars"] = "---";
			}
			//Pinta los datos
			$rcParams["cols"] = 1;
			$sbHtmlFicha .=  $htmlService->genCard($rcFichaActa,$rclabels,$rcParams);
            $rcParams["cols"] = 1;
			$sbHtmlFicha .=  $htmlService->genCard($rcObservaciones,$rclabels,$rcParams);
			
			//Pinta las actividades
			if(is_array($rcActividades)){
				$rcHtml[] = "<table border='0' align='center' width='70%'>";
				$rcHtml[] = "<tr>
								<td class='titulofila'>".$rclabels["acticodigos"]["label"]."</td>
								<td class='titulofila'>".$rclabels["actinombres"]["label"]."</td>
						 	</tr>";
				foreach($rcActividades as $rcTmpValues){
					$rcHtml[] = "<tr>
									<td class=''>".$rcTmpValues["acticodigos"]."</td>
									<td class=''>".$rcTmpValues["actinombres"]."</td>
							 	</tr>";
				}
				$rcHtml[] = "</table><br>";	
				$sbHtmlFicha .= implode("\n",$rcHtml);					
                unset($rcHtml);
			}
			$sbHtmlFicha .= "<hr>";
		}
	}
	return $sbHtmlFicha;
}
?>