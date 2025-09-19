<?php
/*
* @copyright Copyright 2004 &copy; FullEngine
*
* smarty function
* Pinta el reporte de tiempos de ejecuci�
* @author creyes <cesar.reyes@parquesoft.com>
* @date 19-oct-2004 8:59:21
* @location Cali-Colombia*
*/
function smarty_function_repo_tiemposejec($params,&$smarty) {
	
	extract($_REQUEST);
	if(!$ordenumeros){
		return null;
	}
	//Obtiene los datos del usuario
	$rcUser = Application::getUserParam();
	if(!is_array($rcuser)){
		//Si no existe usuario en sesion 
		$rcUser["lang"] = Application::getSingleLang();
	}
	//Manager del reporte 
	$manager = Application :: getDomainController("RepoTiemposEjecManager");
	$rcReporte = $manager->getRepoTiemposEjec($ordenumeros);

	if(!is_array($rcReporte)){
        include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
        $cad = "<script language='javascript'>".
                "alert('{$rcmessages[22]}');\n".
                "parent.close();".
               "</script>";
        return $cad;
	}

	include($rcUser["lang"]."/".$rcUser["lang"].".repotiemposejec.php");
	//Carga el servicio de HTML
	$htmlService = Application :: loadServices("Html");
	//Carga el servicio de fechas
	$dateService = Application :: loadServices("DateController");
	
	echo "<table width='100%'><tr><th><div align='left'>{$rclabels["title"]}</div></th></tr></table>\n";
	$rcParams["size_table"] = "100%";
	foreach($rcReporte as $rcTmp){
		$rcParams["cols"] = 3;
		echo "<table width='100%'>\n<tr><td colspan='3' class='piedefoto'>\n";
//		$rcTmp["vencimiento"] = floor(($rcTmp["vencimiento"] / 60) / 60);
		if($rcTmp["ordefecfinad"]){
			$rcOrden["ordenumeros"] = $rcTmp["ordenumeros"];
			$rcOrden["ordefecfinad"] = $dateService->fncformatofechahora($rcTmp["ordefecfinad"]);
			if($rcTmp["vencimiento"] < 0){
				$rcOrden["vencimiento"] = "<font color='#FF0000'>".$rcTmp["vencimiento"]." h</font>";
				$rcOrden["ordenumeros"] = "<font color='#FF0000'>".$rcTmp["ordenumeros"]."</font>";
			}else
				$rcOrden["vencimiento"] = $rcTmp["vencimiento"]." d";
		}else{
			if($rcTmp["vencimiento"] < 0){
				$rcOrden["ordenumeros"] = "<font color='#FF0000'>".$rcTmp["ordenumeros"]."</font>";
				$rcOrden["ordefecfinad"] = "";
				$rcOrden["vencimiento"] = "<font color='#FF0000'>".$rcTmp["vencimiento"]." d</font>";
			}else{
				$rcOrden["ordenumeros"] = $rcTmp["ordenumeros"];
				$rcOrden["ordefecfinad"] = "";
				$rcOrden["vencimiento"] = $rcTmp["vencimiento"]." d";
			}
		}
		
		$rcOrden["procnombres"] = $rcTmp["procnombres"];
		$rcOrden["organombres"] = $rcTmp["organombres"];
		$rcOrden["ordefecregd"] = $dateService->fncformatofechahora($rcTmp["ordefecregd"]);
		$rcOrden["finalizacion"] = $dateService->fncformatofechahora($rcTmp["finalizacion"]);
		$rcOrden["actualizada"] = $dateService->fncformatofechahora($rcTmp["actualizada"]);
		//$duracion = ($rcTmp["duracion"] / 60) / 60;
		//$rcOrden["duracion"] = floor($duracion)." h";
		$rcOrden["duracion"] = $rcTmp["duracion"]." d";
		echo "\t".$htmlService->genCard($rcOrden,$rclabels,$rcParams);
		echo "</td></tr>\n";
		//Pinta las actas
		$rcActas = $rcTmp["actas"];
		if(is_array($rcActas)){
			foreach($rcActas as $rcTmpActa){
                echo "<tr><td colspan='3' class='piedefoto'><hr></td></tr>";
				echo "<tr><td width='2%' class='piedefoto'>&nbsp;</td><td colspan='2' class='piedefoto'>";
				$rcParams["cols"] = 2;
				//$rcPrActa["actacodigos"] = $rcTmpActa["actacodigos"];
				$rcPrActa["tarenombres"] = $rcTmpActa["tarenombres"];
				$rcPrActa["esacnombres"] = $rcTmpActa["esacnombres"];
				$rcPrActa["actafechingn"] = $dateService->fncformatofechahora($rcTmpActa["actafechingn"]);
				//$duracion = ($rcTmpActa["duracion"] / 60) / 60;
				$rcPrActa["duracion"] = $rcTmpActa["duracion"]." d";
				echo "\t".$htmlService->genCard($rcPrActa,$rclabels,$rcParams);
				echo "</td></tr>";
				//Pinta las atenciones
				$rcAtenciones = $rcTmpActa["atenciones"];
				if(is_array($rcAtenciones)){
				echo "<tr> 
				    <td width='2%' class='piedefoto'>&nbsp;</td>
				    <td width='2%' class='piedefoto'>&nbsp;</td>
				    <td width='96%' class='piedefoto'>".$rclabels["atenciones"]["label"]."
				      <table width='100%' border='0'>
				        <tr>
				          <!--<td class='titulofila'>".$rclabels["acemnumeros"]["label"]."</td>-->
				          <td class='titulofila'>".$rclabels["esacnombres"]["label"]."</td>
				          <td class='titulofila'>".$rclabels["organombres"]["label"]."</td>
				          <td class='titulofila'>".$rclabels["acemfeccren"]["label"]."</td>
				          <td class='titulofila'>".$rclabels["acemfecaten"]["label"]."</td>
				          <td class='titulofila'>".$rclabels["horas"]["label"]."</td>
				          <td class='titulofila'>".$rclabels["duracion"]["label"]."</td>
				        </tr>";
					foreach($rcAtenciones as $rcTmpAtenc){
						echo "<tr>";
						//echo "<td>".$rcTmpAtenc["acemnumeros"]."</td>";
						echo "<td>".$rcTmpAtenc["esacnombres"]."</td>";
						echo "<td>".$rcTmpAtenc["organombres"]."</td>";
						echo "<td>".$dateService->fncformatofechahora($rcTmpAtenc["acemfeccren"])."</td>";
						echo "<td>".$dateService->fncformatofechahora($rcTmpAtenc["acemfecaten"])."</td>";
						echo "<td>".$dateService->secs2hour($rcTmpAtenc["acemhorainn"])." - ".$dateService->secs2hour($rcTmpAtenc["acemhorafin"])."</td>"; //Convertir las horas
						$rcTime = $dateService->seconds2days($rcTmpAtenc["duracion"]);
                        $table = "<table>
                                    <tr>
                                        <td class='titulofila'>{$rclabels["DD"]["label"]}</td>
                                        <td class='titulofila'>{$rclabels["HH"]["label"]}</td>
                                        <td class='titulofila'>{$rclabels["MM"]["label"]}</td>
                                        <td class='titulofila'>{$rclabels["SS"]["label"]}</td>
                                    </tr>
                                    <tr>
                                        <td>{$rcTime['days']}</td>
                                        <td>{$rcTime['hours']}</td>
                                        <td>{$rcTime['minutes']}</td>
                                        <td>{$rcTime['seconds']}</td>
                                    </tr></table>";
						echo "<td class='piedefoto'>$table</td>";
						echo "</tr>";
					}
					echo "</table>
						 </td>
						</tr>";	
				}
			}
		}
		echo "</table><hr>\n";
	}
}
?>