<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Crea un arreglo en sesion con las teclas rapidas y las etiquetas de los campos de la tabla
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_compiler_loadlabels($params, &$smarty) 
{
	settype($rctmp,"array");
	settype($rctmpindice,"array");
	settype($rclabelsgen,"array");
	settype($rckeys,"array");
	settype($nucont,"integer");
	settype($nucant,"integer");
	settype($sblabel,"string");
	
	$nucant=0;

	//se organiza el arreglo
	if(isset($params)){
		parse_str($params);
	}
	//Obtiene los datos del usuario
	$rcuser = Application::getUserParam();
	if(!is_array($rcuser)){
		
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application::getSingleLang();
	}
	if(!$table_name && !is_array($rcuser)){
		return ;
	}
		
	//Carga las etiquetas de la tabla en la sesion
	$table_name = strtolower($table_name);
	include_once($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	
	//Incluye las etiquetas de los comandos genericos
	include_once($rcuser["lang"]."/".$rcuser["lang"].".generic.php");
	
	//Extrae los controles a usar
	foreach($controls as $nukey => $sbid)
		$rctmp[$sbid] = $rclabels_crl[$sbid];
	$rclabels_crl = $rctmp;
	unset($rctmp);
	
	//Procesa las etiquetas de los botones
	foreach($rclabels_crl as $sbkey => $sblabel){
		$rctmp = fncmodificarlabel($sblabel,$rckeys,false);
		$rclabelsgen[$sbkey] = array($rctmp[0],$rctmp[2]);
		$rckeys = $rctmp[1];
	}
	$title =  array_shift ($rclabels);
	$consulttitle =  array_shift ($rclabels);
	$context_help = array_shift ($rclabels);
	foreach($rclabels as $sbkey => $rcvalue)
	{
		if($rcvalue["accesskey"]){
			$rctmp = fncmodificarlabel($rcvalue["label"],$rckeys);
			$rclabel[$sbkey] = array($rctmp[0],$rctmp[2],$rcvalue["commentary"]);
			$rckeys = $rctmp[1];
		}
		else{
			$sbkey = strtolower($sbkey);
			$rclabel[$sbkey] = array($rcvalue["label"],null,$rcvalue["commentary"]);
		}
	}
	//Pone en la sesion las etiquetas
	WebSession::setProperty("labels", $rclabel);
	
	//Pone en la sesion las etiquetas de los comandos y los titulos
	WebSession::setProperty("labelscommands", $rclabelsgen);
	WebSession::setProperty("title", $title);
	WebSession::setProperty("context_help", $context_help);
	
	return ;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion		: fncmodificarlabel
Decripcion      		: Modifica el label de acuerdo a laletra escogida para el acceso rapido
Parametros      		: Descripicion
$isblabel 		: Label
$ircletrasusadas	: Arreglo con las letras ya utilizadas
Retorno         		: Descripicion
$osbresult		: Label modificado
Autor           		: freina
Fecha           		: 04-May-2004
*/
function fncmodificarlabel($isblabel,$ircletrasusadas,$isbsenal=true)
{
	settype($orcresult,"array");
	settype($sbteclarapida,"string");
	settype($sbresult,"string");
	
	//Pasa las tildes HTML a normales
	$isblabel = fncacute_a_tilde($isblabel);
	$sbteclarapida = fncteclarapida($isblabel,$ircletrasusadas);
	
	if ($sbteclarapida){
		
		if($ircletrasusadas){
			if(!in_array($sbteclarapida,$ircletrasusadas)){
				$ircletrasusadas[]=$sbteclarapida;
			}
		}
		else{
			$ircletrasusadas[]=$sbteclarapida;
		}
		
		$sbresult = fncresaltarlabel($isblabel,$sbteclarapida,$isbsenal);
		
		$osbresult = fnctildea_a_cute($sbresult);
		
		$orcresult[0] = $osbresult;
		$orcresult[1] = $ircletrasusadas;
		$orcresult[2] = $sbteclarapida;
	}
	return $orcresult;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion		: fncresaltarlabel
Decripcion		: Resalta el acceso rapido en un label
Parametros		: Descripicion
$isblabel		: label
$isbteclarapida	: Letra del acceso rapido
$isbsenal		: Indica la forma de resaltado
Retorno		: Descripicion
$osbresult		: Label con la letra resaltada
Autor			: freina
Fecha			: 04-May-2004
*/
function fncresaltarlabel($isblabel,$isbteclarapida,$isbsenal)
{
	settype($osbresult,"string");
	settype($sbinicial,"string");
	settype($sbfinal,"string");
	settype($nuposicion,"integer");
	
	$isbteclarapida = strtoupper($isbteclarapida);
	$nuposicion = strpos(strtoupper($isblabel),$isbteclarapida);
	
	if($isbsenal){
		if ($nuposicion==0){
			$sbfinal = substr($isblabel,$nuposicion+1);
			$osbresult = "<u>".$isbteclarapida."</u>".$sbfinal;
		}
		else{
			$sbinicial = substr($isblabel,0,$nuposicion);
			$sbfinal = substr($isblabel,$nuposicion+1);
			$osbresult = $sbinicial."<u>".strtolower($isbteclarapida)."</u>".$sbfinal;
			$osbresult = ucfirst($osbresult);
		}
	}
	else{
		if ($nuposicion==0){
			$sbfinal = substr($isblabel,$nuposicion+1);
			$osbresult = $isbteclarapida.$sbfinal;
		}
		else{
			$sbinicial = strtolower(substr($isblabel,0,$nuposicion));
			$sbfinal = strtolower(substr($isblabel,$nuposicion+1));
			$osbresult = $sbinicial.$isbteclarapida.$sbfinal;
		}
	}
	return $osbresult;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion         		: fncteclarapida
Decripcion      		: Obtiene la letra para el acceso rapido
Parametros      		: Descripicion
$isblabel 		: Label
$ircletrasusadas	: Arreglo con las letras ya utilizadas
Retorno        	 	: Descripicion
$osbresult		: Letra escogida
Autor           		: freina
Fecha           		: 04-May-2004
*/
function fncteclarapida($isblabel,$ircletrasusadas)
{
	settype($rcletperm,"array");
	settype($osbresult,"string");
	settype($nucontador,"integer");
	settype($nulargocadena,"integer");
	
	
	if($isblabel){
		
		$isblabel=strtoupper($isblabel);
		$nulargocadena=strlen($isblabel);
		
		$rcletperm = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","W","X","Y","Z"
		,"1","2","3","4","5","6","7","8","9","0");
		
		if(is_array($ircletrasusadas)){
			
			for ($nucontador=0;$nucontador<$nulargocadena;$nucontador++){
				
				if(!in_array($isblabel[$nucontador],$ircletrasusadas)){
					
					if(in_array($isblabel[$nucontador],$rcletperm)){
						
						$osbresult = $isblabel[$nucontador];
						break;
					}
				}
			}
		}
		if(!$osbresult){
			
			for ($nucontador=0;$nucontador<$nulargocadena;$nucontador++){
				
				if(in_array($isblabel[$nucontador],$rcletperm)){
					
					$osbresult = $isblabel[$nucontador];
					break;
				}
			}
		}
	}
	return  $osbresult;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion		: fncacute_a_tilde
Decripcion		: Cambia en una cadena las tildes tipo HTML a tipo normal de &oacute; a ï¿½
Parametros		: Descripicion
$isbcadena		: Cadena a cambiar
Retorno		: Descripicion
$isbcadena		: Cadena cambiada
Autor			: freina
Fecha			: 04-May-2004
*/
function fncacute_a_tilde($isbcadena)
{
	if(!$isbcadena){
		return $isbcadena;
	}
	
	$isbcadena = str_replace("&aacute;","á",$isbcadena);
	$isbcadena = str_replace("&eacute;","é",$isbcadena);
	$isbcadena = str_replace("&iacute;","í",$isbcadena);
	$isbcadena = str_replace("&oacute;","ó",$isbcadena);
	$isbcadena = str_replace("&uacute;","ú",$isbcadena);
	$isbcadena = str_replace("&Aacute;","Á",$isbcadena);
	$isbcadena = str_replace("&Eacute;","É",$isbcadena);
	$isbcadena = str_replace("&Iacute;","Í",$isbcadena);
	$isbcadena = str_replace("&Oacute;","Ó",$isbcadena);
	$isbcadena = str_replace("&Uacute;","Ú",$isbcadena);
	$isbcadena = str_replace("&ntilde;","ñ",$isbcadena);
	$isbcadena = str_replace("&Ntilde;","Ñ",$isbcadena);
	return $isbcadena;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion		: fnctildea_a_cute
Decripcion		: Cambia en una cadena las tildes tipo normal a tipo HTML de ï¿½ a &oacute;
Parametros		: Descripicion
$isbcadena		: Cadena a cambiar
Retorno		: Descripicion
$isbcadena		: Cadena cambiada
Autor			: freina
Fecha			: 04-May-2004
*/
function fnctildea_a_cute($isbcadena)
{
	if(!$isbcadena){
		return $isbcadena;
	}
	$isbcadena = str_replace("á","&aacute;",$isbcadena);
	$isbcadena = str_replace("é","&eacute;",$isbcadena);
	$isbcadena = str_replace("í","&iacute;",$isbcadena);
	$isbcadena = str_replace("ó","&oacute;",$isbcadena);
	$isbcadena = str_replace("ú","&uacute;",$isbcadena);
	$isbcadena = str_replace("Á","&Aacute;",$isbcadena);
	$isbcadena = str_replace("É","&Eacute;",$isbcadena);
	$isbcadena = str_replace("Í","&Iacute;",$isbcadena);
	$isbcadena = str_replace("Ó","&Oacute;",$isbcadena);
	$isbcadena = str_replace("Ú","&Uacute;",$isbcadena);
	$isbcadena = str_replace("ñ","&ntilde;",$isbcadena);
	$isbcadena = str_replace("Ñ","&Ntilde;",$isbcadena);
	return $isbcadena;
}
?>