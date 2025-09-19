<?php
/*
 * Created on 23/01/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
function smarty_function_drawListCom($params, & $smarty) {

	extract($_REQUEST);
	settype($rcUser,"array");
	settype($rcTmp,"array");
	settype($rcRow,"array");
	settype($sbHtml,"string");
	settype($sbEstilo,"string");
	settype($nuCont,"integer");

	//Para cargar el lenguaje
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".comunicacionconsult.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");
	
	$objgateway = Application :: getDataGateway("SqlExtended");
	$rcTmp = $objgateway->getAllComunicacion($params);
	
	if($rcTmp && is_array($rcTmp)){
		//se pinta la informacion las comunicaciones
		
		$sbHtml = "<table align=\"center\" border=\"0\" width=\"100%\">";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td align='center'  colspan='6'>&nbsp;</td>";
		$sbHtml .= "</tr>";
		$sbHtml .= "<tr>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["comucodigos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["ordenumeros"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["focacodigos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["comuasuntos"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["comuestados"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "<td class='titulofila' align='center'>";
		$sbHtml .= $rclabels["accion"]["label"];
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		foreach($rcTmp as $nuCont=>$rcRow){
			if (fmod($nuCont, 2) == 0) {
				$sbEstilo = "celda";
			} else {
				$sbEstilo = "celda2";
			}
			
			$sbHtml .= "<tr>";
			$sbHtml .= "<td align='left' class='".$sbEstilo."'>";
			$sbHtml .= $rcRow["comucodigos"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='left' class='".$sbEstilo."'>";
			$sbHtml .= $rcRow["ordenumeros"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='left' class='".$sbEstilo."'>";
			$sbHtml .= $rcRow["focacodigos"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='left' class='".$sbEstilo."'>";
			$sbHtml .= $rcRow["comuasuntos"];
			$sbHtml .= "</td>";
			$sbHtml .= "<td align='left' class='".$sbEstilo."'>";
			$sbHtml .= $rcRow["comuestados"];
			$sbHtml .= "</td>";
			
			$sbHtml .= "<td align='center' class='".$sbEstilo."'>";
			$sbHtml .= "<table align=\"center\" border=\"0\" width=\"100%\">";
			$sbHtml .= "<tr>";
			$sbHtml .= "<td class='".$sbEstilo."'>";
			$sbHtml .= "<a href=# title='".$rclabels_crl['CmdGenerate']."' onclick=\"jsGenerate('".$rcRow["comucodigos"]."');disableButtons();\">";
			$sbHtml .= "<img src=web/images/insertar.gif border=0></a>";
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='".$sbEstilo."'>";
			$sbHtml .= "<a href=# title='".$rclabels_crl['CmdDownload']."' onclick=\"jsDownload();\">";
			$sbHtml .= "<img src=web/images/descargar_archivo_peq.gif border=0></a>";
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='".$sbEstilo."'>";
			$sbHtml .= "<a title='".$rclabels_crl['CmdShow']."' href=# onclick=\"jsPreview('".$rcRow["comucodigos"]."');\">";
			$sbHtml .= "<img src=web/images/consultar_002.gif border=0></a>";
			$sbHtml .= "</td>";
			$sbHtml .= "<td class='".$sbEstilo."'>";
			$sbHtml .= "<a title='".$rclabels_crl['CmdDelete']."' href=# onclick=\"var sbResult = confirm('".$rclabels["pregunta"]["label"]."'); if(sbResult == true){jsDelete('".$rcRow["comucodigos"]."');disableButtons();}\">";
			$sbHtml .= "<img src=web/images/ico_basura.gif border=0></a>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
			$sbHtml .= "</table>";
			$sbHtml .= "</td>";
			$sbHtml .= "</tr>";
			
		}
		$sbHtml .= "</table>";
	}
	return $sbHtml;
}
?>