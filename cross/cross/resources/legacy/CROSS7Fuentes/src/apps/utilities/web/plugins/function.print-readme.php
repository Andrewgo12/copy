<?php
/*
 * Smarty plugin
 * Type:     function
 * Name:     print_readme
 * Version:  1.0
 * Date:     Jan 10, 2010
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  display the VERSION File
 *
 *
 */
function smarty_function_print_readme($params, & $smarty) {

	settype($rcUser, "array");
	settype($rcInfo, "array");
	settype($sbHtml, "string");
	settype($sbPath, "string");
	extract($params);


	//Trae los datos del usuario
	$rcUser = Application :: getUserParam();
	if (!is_array($rcUser)) {
		//Si no existe usuario en sesion
		$rcUser["lang"] = Application :: getSingleLang();
	}

	include ($rcUser["lang"]."/".$rcUser["lang"].".readme.php");

	//Arma la ruta de la imagen
	$sbPath = Application :: getImagesDirectory()."/logo.jpg";
	$rcInfo = getReadmeFile();

	$sbHtml .= "<table width=\"100%\"  border=\"0\" align=\"center\">";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"center\"><img src=\"".$sbPath."\" width=\"100\" height=\"88\"></td>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"center\"><strong>".$rclabels["text1"]["label"]."</strong></td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\" colspan=\"2\">&nbsp</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\" colspan=\"2\"><strong>".$rclabels["text2"]["label"]."</strong></td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\" colspan=\"2\">&nbsp</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" colspan=\"2\" align=\"left\" valign=\"bottom\">".$rclabels["text10"]["label"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" colspan=\"2\">";
	$sbHtml .= "<table width=\"50%\"  border=\"1\" align=\"left\">";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td align=\"left\" class=\"piedefoto\">".$rclabels["text3"]["label"].$rcInfo["cli"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td align=\"left\" class=\"piedefoto\">".$rclabels["text4"]["label"].$rcInfo["prod"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td align=\"left\" class=\"piedefoto\">".$rclabels["text5"]["label"].$rcInfo["ver"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td align=\"left\" class=\"piedefoto\">".$rclabels["text11"]["label"].$rcInfo["rep"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td align=\"left\" class=\"piedefoto\">".$rclabels["text7"]["label"].$rcInfo["rev"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td align=\"left\" class=\"piedefoto\">".$rclabels["text8"]["label"].$rcInfo["fec"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "</table>";
	$sbHtml .= "</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\" colspan=\"2\">&nbsp</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\" colspan=\"2\">";
	$sbHtml .= "<table width=\"100%\"  border=\"0\" align=\"left\">";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\">".$rclabels["text9"]["label"]."</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"justify\"><hr  size=\"1\"></td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "<tr>";
	$sbHtml .= "<td class=\"piedefoto\" align=\"center\"><input class=boton type=\"button\" name=\"aceptar\" id=\"aceptar\" value=\"".$rclabels["text12"]["label"]."\" onClick=\"window.close();\"></td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "</table>";
	$sbHtml .= "</td>";
	$sbHtml .= "</tr>";
	$sbHtml .= "</table>";

	echo $sbHtml;
}
function getReadmeFile(){

	settype($rcFile,"array");
	settype($rcTmp,"array");
	settype($rcResult,"array");
	settype($sbFile,"string");
	settype($sbTmp,"string");
	settype($sbRev,"string");
	settype($sbCli,"string");
	settype($sbProd,"string");
	settype($sbVer,"string");
	settype($sbFec,"string");
	settype($sbRep,"string");

	$sbFile = "../../../VERSION";

	if(file_exists($sbFile)){
		$rcFile = file($sbFile);

		if (is_array($rcFile) && $rcFile){
			//se analisa el archivo
			foreach($rcFile as $sbTmp){
				if(!$sbRev){
					if(!(strpos($sbTmp, "RELEASE")===false)){
						$rcTmp = explode(":",$sbTmp);
						if(is_array($rcTmp) && $rcTmp){
							$sbRev = trim($rcTmp[1]);
						}
					}
				}
				if(!(strpos($sbTmp, "Revision")===false)){
					$rcTmp = explode(":",$sbTmp);
					if(is_array($rcTmp) && $rcTmp){
						$sbRev = trim($rcTmp[1]);
					}
				}
				if(!$sbCli){
					if(!(strpos($sbTmp, "CLIENTE")===false)){
						$rcTmp = explode(":",$sbTmp);
						if(is_array($rcTmp) && $rcTmp){
							$sbCli = trim($rcTmp[1]);
						}
					}
				}
				if(!$sbProd){
					if(!(strpos($sbTmp, "PRODUCTO")===false)){
						$rcTmp = explode(":",$sbTmp);
						if(is_array($rcTmp) && $rcTmp){
							$sbProd = trim($rcTmp[1]);
						}
					}
				}
				if(!$sbVer){
					if(!(strpos($sbTmp, "VERSION")===false)){
						$rcTmp = explode(":",$sbTmp);
						if(is_array($rcTmp) && $rcTmp){
							$sbVer = trim($rcTmp[1]);
						}
					}
				}
				if(!$sbFec){
					if(!(strpos($sbTmp, "FECHA")===false)){
						$rcTmp = explode(":",$sbTmp);
						if(is_array($rcTmp) && $rcTmp){
							$sbFec = trim($rcTmp[1]);
						}
					}
				}
				if(!$sbRep){
					if(!(strpos($sbTmp, "REPOSITORIO")===false)){
						$rcTmp = explode(":",$sbTmp);
						if(is_array($rcTmp) && $rcTmp){
							$sbRep = trim($rcTmp[1]);
							$sbRep = substr($sbRep, (strrpos ($sbRep, "/") + 1));
						}
					}
				}
			}
		}
		$rcResult["cli"] = str_replace("#","",$sbCli);
		$rcResult["prod"] = str_replace("#","",$sbProd);
		$rcResult["ver"] = str_replace("#","",$sbVer);
		$rcResult["rev"] = str_replace("#","",$sbRev);
		$rcResult["rep"] = str_replace("#","",$sbRep);
		$rcResult["fec"] = str_replace("#","",$sbFec);
	}

	return $rcResult;
}
?>