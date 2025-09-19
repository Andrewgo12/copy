<?php
/**Copyright 2005 FullEngine

consulta y pinta la informacion de los dealers a ser aprobados para liquidacion
@author freina <freina@parquesoft.com>
@date 01-Mar-2005 13:55
@location Cali - Colombia
*/
function smarty_function_viewScheduleList($params,&$smarty)
{
	settype($objDate,"object");
	settype($objGateway,"object");
	settype($rcUser,"array");
	settype($rcData,"array");
	settype($rcOrg,"array");

	extract($_REQUEST);
	extract($params);

	$rcUser = Application::getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}
	include($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
	include($rcUser["lang"]."/".$rcUser["lang"].".listschedule.php");

	if(!$orgacodigos || !$entrfechorun || !$entrdurationn){
		if($consulta){
			echo "<script>alert('".$rcmessages[0]."');</script>";
		}
		return null;
	}else{

		//se obtiene las descendencia de la dependencia
		if($children){
			$rcOrg = getSon($orgacodigos);
		}
		$rcOrg[] = $orgacodigos;
		
		$objDate = Application::loadServices("DateController");
		$objGateway = Application::getDataGateway("sqlExtended");
		$entrfechorun = $objDate->fncdatehourtoint($entrfechorun);
		$entrdurationn = $objDate->fncdatehourtoint($entrdurationn);
		$rcData = $objGateway->getListaEventos($entrfechorun,$entrdurationn,$rcOrg,$catecodigon);
		if(!is_array($rcData)){
			echo "<script>alert('".$rcmessages[33]."');</script>";
			return null;
		}

		//Traigamos todos los entes organizacionales para no hacer una consulta en cada iteración del foreach
		$objHHRR = Application::loadServices("Human_resources");
		$rcDependencias = $objHHRR->getAllEntesOrg();
		if(is_array($rcDependencias))
		foreach ($rcDependencias as $rcRow)
		$rcEntes[$rcRow["orgacodigos"]] = $rcRow["organombres"];

		//Traigamos todos los contactos para no hacer una consulta en cada iteración del foreach
		$objHHRR = Application::loadServices("Customers");
		$rcDependencias = $objHHRR->getAllContacto();
		if(is_array($rcDependencias))
		foreach ($rcDependencias as $rcRow)
		$rcContactos[$rcRow["contindentis"]] = $rcRow["contnombre"];

		//Como no pasó nada, procedo a listar
		$Pager = Application::loadservices("Pager");
		$objDate = Application::loadServices("DateController");
		$sbHtml .= $Pager->paginar($rcData,$sbTabla);

		$sbHtml .= "<table border=0 width=60% align='center'><tr>";
		$sbHtml .= "<td class='titulofila'>".$rclabels["entrcodigon"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["entrfechorun"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["entrdurationn"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["catecodigon"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["orgacodigos"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["contindentis"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["entrdescris"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["esennombres"]["label"]."</td>\n";
		$sbHtml .= "</tr>\n";

		foreach ($rcData as $nuCont => $rcRow)
		{
			if (fmod($nuCount,2)==0)
			$sbEstilo = "celda";
			else
			$sbEstilo = "celda2";
			$sbHtml .= "<tr>\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["entrcodigon"]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$objDate->fncformatofechahora($rcRow["entrfechorun"])."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$objDate->fncformatofechahora($rcRow["entrdurationn"])."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["catecodigon"]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcEntes[$rcRow["orgacodigos"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcContactos[$rcRow["contindentis"]]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["entrdescris"]."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$rcRow["esennombres"]."</td>"."\n";
			$sbHtml .= "</tr>";
			$nuCount++;
			$rcExcel[$nuCont][] = $objDate->fncformatofechahora($rcRow["entrfechorun"]);
			$rcExcel[$nuCont][] = $objDate->fncformatofechahora($rcRow["entrdurationn"]);
			$rcExcel[$nuCont][] = $rcRow["catecodigon"];
			$rcExcel[$nuCont][] = $rcEntes[$rcRow["orgacodigos"]];
			$rcExcel[$nuCont][] = $rcContactos[$rcRow["contindentis"]];
			$rcExcel[$nuCont][] = $rcRow["entrdescris"];
			$rcExcel[$nuCont][] = $rcRow["esennombres"];
		}
		$sbHtml .= "</table>";

		//EXCEL
		$rcLabelsExcel = array($rclabels["entrfechorun"]["label"],$rclabels["entrdurationn"]["label"],
		$rclabels["catecodigon"]["label"],$rclabels["orgacodigos"]["label"],
		$rclabels["contindentis"]["label"],$rclabels["entrdescris"]["label"],$rclabels["esennombres"]["label"]);
		array_unshift($rcExcel,$rcLabelsExcel);

		$sbTmp = "tmp/";
		$nameExcel = $name.rand(0,1000).".xls";
		$sbPath = $sbTmp.$nameExcel;
		$objLib = Application::loadLib("excel");
		$sbResult = $objLib->execute($rcExcel,$sbPath);

		$sbHtml .= "<tr><td align=center class='piedefoto'><a href=javascript:abrirPdf('".$sbTmp.$nameExcel."');><img border=0 src='web/images/generar_excel.gif' title='".$rclabels['excel']['label']."'></a></td></tr>";

		return $sbHtml;
	}
}
/**Copyright 2010 FullEngine

Consulta y pinta las tareas asignadas a un ente organizacional
@author freina<freina@parquesoft.com>
@date 08-Sep-2010 18:48:00
@location Cali - Colombia
*/

function getSon($sbOrgacodigos){

	settype($objService,"object");
	settype($rcResult,"array");
	settype($rcData,"array");
	settype($rcTmp,"array");

	if($sbOrgacodigos){
		$objService = Application::loadServices('Human_resources');
		$rcData = $objService->getEnteSon($sbOrgacodigos);
		if(is_array($rcData)&& $rcData){
			foreach($rcData as $rcTmp){
				$rcResult[] = $rcTmp['orgacodigos'];
			}
		}
	}

	return $rcResult;
}
?>