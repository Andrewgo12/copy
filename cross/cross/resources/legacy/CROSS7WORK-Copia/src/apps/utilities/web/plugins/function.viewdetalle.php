<?php          
/**Copyright 2004 � FullEngine
	 Consulta y pinta las el detalle de una configuracion de archivo asignadas a un ente organizacional
	@author freina <freina@parquesoft.com>
	@date 24-Sep-2004 10:20
	@location Cali - Colombia
*/
function smarty_function_viewdetalle($params, & $smarty) {

	extract($_REQUEST);
	extract($params);
	settype($objgateway, "object");
	settype($rctmp, "array");
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

	if (!(WebSession :: issetProperty("Detaconfarch"))) {
		$objgateway = Application :: getDataGateway("DetaconfarchExtended");
		$rctmp = $objgateway->getByCogacodigos($configarchiv__cogacodigos);
		WebSession :: setProperty("Detaconfarch", $rctmp);
	} else {
		$rctmp = WebSession :: getProperty("Detaconfarch");
	}

	//Trae los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}

	//Trae las etiquetas
	include ($rcuser["lang"]."/".$rcuser["lang"].".detaconfarch.php");
	include ($rcuser["lang"]."/".$rcuser["lang"].".generic.php");
	include ($rcuser["lang"]."/".$rcuser["lang"].".state.php");
	//Trae el directorio de imagenes
	$sbimgdir = Application :: getImagesDirectory();

	//arreglo comodin
	$rctmpc = array ('decocodigon' => NULL, 'cogacodigos' => NULL, 'decodescris' => NULL, 'decolon_posn' => NULL, 'decotipos' => NULL, 'decoformats' => NULL, 'decovalinis' => NULL, 'decovalfins' => NULL,);

	//numero de columnas
	$nucols = sizeof($rctmpc);

	//Pinta la tabla
	$sbhtml_result .= "<table cellSpacing='1' cellPadding='3' align='center' border='0'>";
	$sbhtml_result .= "<tr>";
	//Pinta las cabeceras
	foreach ($rctmpc as $sbindex => $sbvalue) {
		if ($sbindex != "cogacodigos") {
			if ($sbindex == "decodescris" ||$sbindex == "decocodigon" || $sbindex == "decolon_posn") {
				$sbhtml_result .= "<td class='titulofila'>".$rclabels[$sbindex]["label"]."*</td>";
			} else {
				$sbhtml_result .= "<td class='titulofila'>".$rclabels[$sbindex]["label"]."</td>";
			}
		}
	}
	$sbhtml_result .= "<td class='titulofila'>".$rclabels["consulttitle"]."</td></tr>";

	//se pinta la linea generica

	//se arman los option de las listas
	$sbopciont = "<option value=''>---</optional>";
	foreach ($rcstate[2] as $sbindex => $rcvalue) {
		$sbopciont .= "<option value='".$rcvalue["value"]."'>".$rcvalue["label"]."</option>";
	}
	$sbopcionf = "<option value=''>---</optional>";
	foreach ($rcstate[3] as $sbindex => $rcvalue) {
		$sbopcionf .= "<option value='".$rcvalue["value"]."'>".$rcvalue["label"]."</option>";
	}

	$sbhtml_result .= "<tr>";
	foreach ($rctmpc as $sbindex => $sbvalue) {
		if ($sbindex == "decocodigon") {
			$sbhtml_result .= "<td class='$estilo'>&nbsp;</td>";
		} else {
			if ($sbindex == "decotipos") {
				$sbhtml_result .= "<td class='$estilo'><select  id=\"$sbindex\"  name=\"".$table."__".$sbindex."\" id=\"$sbindex\" >";
				$sbhtml_result .= $sbopciont;
				$sbhtml_result .= "</select></td>";
			} else {
				if ($sbindex == "decoformats") {
					$sbhtml_result .= "<td class='$estilo'><select  id=\"$sbindex\"  name=\"".$table."__".$sbindex."\" id=\"$sbindex\" >";
					$sbhtml_result .= $sbopcionf;
					$sbhtml_result .= "</select></td>";
				} else {
					if ($sbindex != "cogacodigos") {
						$sbhtml_result .= "<td class='$estilo'><input type=\"text\"  id=\"$sbindex\"  name=\"".$table."__".$sbindex."\" size=\"15\" value=\"\"></td>";
					}
				}
			}
		}
	}
	$sbhtml_result .= "<td class='$estilo'><a href='#' title=\""
	.$rclabels_crl["CmdAdd"]."\" onClick=\"$form.action.value='FeGeCmdAddDetaconfarch';$form.submit();\" ><img src='$sbimgdir/insertar.gif' border='0' alt=\""
	.$rclabels_crl["CmdAdd"]."\"></a></td></tr>";

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
				if ($sbindex == "decocodigon") {
					$sbhtml_result .= "<td class='$estilo'><input type=\"text\"  id=\"$sbindex".$nucontr."\"  name=\"".$table."__".$sbindex.$nucontr."\" size=\"5\" value=\"$nucontr\"></td>";
				} else {
					if ($sbindex == "decotipos") {
						$sbopciont = "<option value=''>---</optional>";
						foreach ($rcstate[2] as $sbindexo => $rcvalue) {
							$sbopciont .= "<option value='".$rcvalue["value"];
							if ($rcvalue["value"] == $sbvalue) {
								$sbopciont .= "' selected >";
							} else {
								$sbopciont .= "'>";
							}
							$sbopciont .= $rcvalue["label"]."</option>";
						}
						$sbhtml_result .= "<td class='$estilo'><select  id=\"$sbindex".$nucontr."\"  name=\"".$table."__".$sbindex.$nucontr."\">";
						$sbhtml_result .= $sbopciont;
						$sbhtml_result .= "</select></td>";
					} else {
						if ($sbindex == "decoformats") {
							$sbopcionf = "<option value=''>---</optional>";
							foreach ($rcstate[3] as $sbindexo => $rcvalue) {
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
						} else {
							if ($sbindex != "cogacodigos") {
								$sbhtml_result .= "<td class='$estilo'><input type=\"text\"  id=\"$sbindex".$nucontr."\"  name=\"".$table."__".$sbindex.$nucontr."\" size=\"15\" value=\"$sbvalue\"></td>";
							}
						}
					}
				}
			}
			$sbhtml_result .= "<td class='$estilo'><a href='#' title=\""
			.$rclabels_crl["CmdUpdate"]."\" onClick=\"$form.action.value='FeGeCmdUpdateDetaconfarch';$form.indice.value='"
			.$nucontr."';$form.submit();\" ><img src='$sbimgdir/editar.gif' border='0' alt=\""
			.$rclabels_crl["CmdUpdate"]."\"></a>";
			$sbhtml_result .= "<a href='#' title=\"".$rclabels_crl["CmdDelete"]."\" onClick=\"$form.action.value='FeGeCmdDeleteDetaconfarch';$form.indice.value='"
			.$nucontr."';$form.submit();\" ><img src='$sbimgdir/cortar.gif' border='0' alt=\""
			.$rclabels_crl["CmdDelete"]."\"></a></td></tr>"."\n";
		}
	}
	$sbhtml_result .= "</table>";
	echo $sbhtml_result;
}
?>