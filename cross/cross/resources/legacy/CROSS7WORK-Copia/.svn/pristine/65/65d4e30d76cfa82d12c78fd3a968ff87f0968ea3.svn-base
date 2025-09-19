<?php                      
/**Copyright 2005 FullEngine
	
	Muestra todos los pdfs generados
	@author freina<freina@parquesoft.com>
	@date 21-Jun-2005 14:21
	@location Cali - Colombia
*/
function smarty_function_viewfilesystem($params, & $smarty) {
	extract($params);

	settype($rcUser, "array");
	settype($rcFiles, "array");
	settype($sbImgDir, "string");
	settype($sbHtml, "string");
	settype($sbPathDir, "string");
	settype($sbPathDirRel, "string");
	settype($sbTmp, "string");
	settype($sbEstilo, "string");
	settype($sbImgDir, "string");

	//trae el directorio de imagenes
	$sbImgDir = Application :: getImagesDirectory();
	$sbDirName = Application :: getConstant("PDF_DIR");
	$sbPathDir = Application :: getTmpDirectory()."/".$sbDirName;
	$sbPathDirRel = Application :: getTmpDir()."/".$sbDirName;
	$sbPathDirRel = substr($sbPathDirRel,1);

	$rcUser = getDataUser();
	include ($rcUser["lang"]."/".$rcUser["lang"].".comunicacionopen.php");
	include ($rcUser["lang"]."/".$rcUser["lang"].".generic.php");

	//Obtiene el nombre de los archivos
	$rcFiles = getDirectoryFiles($sbPathDir);
	
	if ($rcFiles) {
		
		//se pinta el listado
		$sbHtml .= "<tr>";
		$sbHtml .= "<td colspan=\"3\">";
		$sbHtml .= "<table cellSpacing='1' cellPadding='3' align='center' border='0' width=\"100% \">"."\n";
		$sbHtml .= "<tr><th colspan='2' align=\"center\"><div align='center'>".$rclabels["archivos"]["label"]."</div></th></tr>"."\n";
		$sbHtml .= "<tr>"."\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["nombre"]["label"]."</td>\n";
		$sbHtml .= "<td class='titulofila'>".$rclabels["download"]["label"]."</td>\n";
		$sbHtml .= "</tr>\n";
		foreach ($rcFiles as $sbTmp) {
			if (fmod($nuCont, 2) == 0) {
				$sbEstilo = "celda";
			} else {
				$sbEstilo = "celda2";
			}
			$sbHtml .= "<tr>\n";
			$sbHtml .= "<td class='".$sbEstilo."'>".$sbTmp."</td>"."\n";
			$sbHtml .= "<td class='".$sbEstilo."'><div align=\"center\">\n";
			$sbHtml .= "<img alt=\"".$rclabels_crl["CmdDownload"]."\" ";
			$sbHtml .= "onClick=\"jsDownloadFileCT('".$sbPathDirRel."/".$sbTmp."');\"";
			$sbHtml .= " src='".$sbImgDir."/descargar_archivo_peq.gif' border='0'></div>\n";
			$sbHtml .= "</td>"."\n";
			$sbHtml .= "</tr>\n";
			$nuCont ++;
		}
		$sbHtml .= "</table>";
		$sbHtml .= "</td>";
		$sbHtml .= "</tr>";
		print $sbHtml;
	}
}

/**
*   Propiedad intelectual del FullEngine.
*   Obtiene la data de usuario
*   @author  freina
*	@return array $orcresult (Array con la data del usuario o null)
*   @date 01-Mar-2005 14:04
*   @location Cali-Colombia
*/
function getDataUser() {
	settype($orcresult, "array");

	//Trae los datos del usuario
	$orcresult = Application :: getUserParam();
	if (!is_array($orcresult)) {
		//Si no existe usuario en sesion
		$orcresult["lang"] = Application :: getSingleLang();
	}
	return $orcresult;
}
/**
*   Propiedad intelectual del FullEngine.
*   Obtiene los  nobres de archivo de un directorio
* @param string $isbDirectorio ruta del directorio
*   @author  freina<freina@parquesoft.com>
*	@return array $orcresult Arreglo con los nombre de archivo
*   @date 21-Jun-2005 14:41
*   @location Cali-Colombia
*/
function getDirectoryFiles($isbDirectorio) {

	settype($orcResult, "array");
	settype($sbHandle, "string");
	settype($sbFile, "string");
	settype($nuCont, "integer");

	if (is_dir($isbDirectorio)) {

		chdir($isbDirectorio);
		if ($sbHandle = opendir(".")) {

			//se recorre el directorio
			while ($sbFile = readdir($sbHandle)) {

				//se excluyen
				if (($sbFile != '..') && ($sbFile != '.')) {

					if (is_file($sbFile)) {
						$orcResult[$nuCont] = $sbFile;
						$nuCont ++;
					}
				}
			}
			closedir($sbHandle);
		}
	}

	return $orcResult;
}
?>