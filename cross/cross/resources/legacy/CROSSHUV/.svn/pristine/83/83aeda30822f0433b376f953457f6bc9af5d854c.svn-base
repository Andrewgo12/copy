<?php                 
/**Copyright 2004 � FullEngine
	 Consulta y pinta  el detalle de personal de un grupo 
	@author freina <freina@parquesoft.com>
	@date 24-Nov-2004 11:49
	@location Cali - Colombia
*/
function smarty_function_viewgrupodetalle($params, & $smarty) {

	extract($_REQUEST);
	extract($params);
	settype($objgateway, "object");
	settype($rctmp, "array");
	settype($rctmpp, "array");
	settype($rcvalue, "array");
	settype($rctmpc, "array");
	settype($rctmpr, "array");
	settype($rcuser, "array");
	settype($sbimgdir, "string");
	settype($sbhtml_result, "string");
	settype($sbindex, "string");
	settype($sbindexo, "string");
	settype($sbopciont, "string");
	settype($sbopcionf, "string");
	settype($sbvalue, "string");
	settype($nucols, "integer");
	settype($nucontr, "integer");

	if (!(WebSession :: issetProperty("Grupodetalle"))) {
		$objgateway = Application :: getDataGateway("GrupodetalleExtended");
		$rctmp = $objgateway->getByGrupcodigon($grupo__grupcodigon);
		if(is_array($rctmp))
			WebSession :: setProperty("Grupodetalle", $rctmp);
	} else {
		$rctmp = WebSession :: getProperty("Grupodetalle");
	}
	//Trae los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	//Trae las etiquetas
	include ($rcuser["lang"]."/".$rcuser["lang"].".grupodetalle.php");
	include ($rcuser["lang"]."/".$rcuser["lang"].".generic.php");
	include ($rcuser["lang"]."/".$rcuser["lang"].".state.php");
	//Trae el directorio de imagenes
	$sbimgdir = Application :: getImagesDirectory();

	//arreglo comodin
	$rctmpc = array ('perscodigos' => NULL, 'persrespons' => NULL,);

	//numero de columnas
	$nucols = sizeof($rctmpc);

	//Pinta la tabla
	$sbhtml_result .= "<table cellSpacing='1' cellPadding='3' align='center' border='0' width='70%'>";
	$sbhtml_result .= "<tr>";
	//Pinta las cabeceras
	foreach ($rctmpc as $sbindex => $sbvalue) {
		$sbhtml_result .= "<td class='titulofila'>".$rclabels[$sbindex]["label"]."*</td>";
	}
	$sbhtml_result .= "<td class='titulofila'>".$rclabels["consulttitle"]."</td></tr>";

	//se pinta la linea generica

	//se arman los option de las listas
	$sbopciont = "<option value=''>---</optional>";
	foreach ($rcstate[0] as $sbindex => $rcvalue) {
		$sbopciont .= "<option value='".$rcvalue["value"]."'>".$rcvalue["label"]."</option>";
	}

	$sbhtml_result .= "<tr>";
	foreach ($rctmpc as $sbindex => $sbvalue) {
		if ($sbindex == "perscodigos") {
			$nameObj = $table."__".$sbindex;
			$nameObjDesc = $table."__".$sbindex."_desc";
			$sbhtml_result .= "<td class='$estilo'>" .
												"<input type='text'  id='$sbindex'  name='$nameObj' onBlur=\"if(this.value)autoReference('personal','perscodigos',Array(this),this.form.$nameObjDesc)\">" .
												"<a href='#' onclick=\"javascript:fncopenwindows('FeHrCmdLstHelp','table=personal&sqlid=personal&return_obj=$nameObj&return_key=perscodigos&$nameObjDesc='+document.frmGrupo.$nameObjDesc.value);\">" .
													"<img src='web/images/referencia.gif' border='0' align='absmiddle'/>" .
												"</a>" .
												"<input type='text'  id='$sbindex'  name='$nameObjDesc' size='40'>";
			$sbhtml_result .= "</td>";
		} else {
			if ($sbindex == "persrespons") {
				$sbhtml_result .= "<td class='$estilo'>" .
							"<select  id=\"$sbindex\"  name=\"".$table."__".$sbindex."\" id=\"$sbindex\" >";
				$sbhtml_result .= $sbopciont;
				$sbhtml_result .= "</select></td>";
			}
		}
	}
	$sbhtml_result .= "<td class='$estilo'><a href='#' title=\"".$rclabels_crl["CmdAdd"]."\" onClick=\"$form.action.value='FeHrCmdAddGrupodetalle';$form.submit();\" ><img src='$sbimgdir/insertar.gif' border='0' align='middle' title=\"".$rclabels_crl["CmdAdd"]."\"></a></td></tr>";
	
	//Pinta los datos
	if ($rctmp) {
		foreach ($rctmp as $sbindexey => $rctmpr) {

			//indice
			$nucontr ++;
			//Calcula el interlineado
			if (fmod($sbindexey, 2) == 0) {
				$estilo = "celda";
			} else {
				$estilo = "celda2";
			}
			$sbhtml_result .= "<tr>";
			foreach ($rctmpr as $sbindex => $sbvalue) {
				if ($sbindex == "perscodigos") {
					$nameObj = $table."__".$sbindex.$nucontr;
					$nameObjDesc = $table."__".$sbindex.$nucontr."_desc";
					$sbhtml_result .= "<td class='$estilo'>" .
												"<input type='text'  value='{$rctmpr['perscodigos']}' id='$sbindex'  name='$nameObj' onBlur=\"if(this.value)autoReference('personal','perscodigos',Array(this),this.form.$nameObjDesc)\">" .
												"<a href='#' onclick=\"javascript:fncopenwindows('FeHrCmdLstHelp','table=personal&sqlid=personal&return_obj=$nameObj&return_key=perscodigos');\">" .
													"<img src='web/images/referencia.gif' border='0' align='absmiddle'/>" .
												"</a>" .
												"<input type='text'  id='$sbindex'  name='$nameObjDesc' size='40' value='{$rctmpr['persnombres']}'>";
					$sbhtml_result .= "</td>";
				} else {
					if ($sbindex == "persrespons") {
						$sbopcionf = "<option value=''>---</optional>";
						foreach ($rcstate[0] as $sbindexo => $rcvalue) {
							$sbopcionf .= "<option value='".$rcvalue["value"];
							if ($rcvalue["value"] == $sbvalue) {
								$sbopcionf .= "' selected >";
							} else {
								$sbopcionf .= "'>";
							}
							$sbopcionf .= $rcvalue["label"]."</option>";
						}
						$sbhtml_result .= "<td class='$estilo'><select id=\"$sbindex".$nucontr."\" name=\"".$table."__".$sbindex.$nucontr."\">";
						$sbhtml_result .= $sbopcionf;
						$sbhtml_result .= "</select></td>";
					}
				}
			}
			$sbhtml_result .= "<td class='$estilo'><a href='#' title=\"".$rclabels_crl["CmdUpdate"]."\" onClick=\"$form.action.value='FeHrCmdUpdateGrupodetalle';$form.indice.value='".$nucontr."';$form.submit();\" ><img src='$sbimgdir/editar.gif' align='middle' border='0' alt=\"".$rclabels_crl["CmdUpdate"]."\"></a>";
			$sbhtml_result .= "<a href='#' title=\"".$rclabels_crl["CmdDelete"]."\" onClick=\"$form.action.value='FeHrCmdDeleteGrupodetalle';$form.indice.value='".$nucontr."';$form.submit();\" ><img src='$sbimgdir/cortar.gif' border='0' align='middle' alt=\"".$rclabels_crl["CmdDelete"]."\"></a></td></tr>"."\n";
		}
	}
	$sbhtml_result .= "</table>";

	echo $sbhtml_result;
}
?>