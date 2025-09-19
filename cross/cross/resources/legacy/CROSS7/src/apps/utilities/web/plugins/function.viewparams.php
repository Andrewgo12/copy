<?php
	/*
	* Smarty plugin
	* --------------------------------------------------------------------
	* @copyright Copyright 2006 &copy; FullEngine
	* Type:     function
	* Name:     viewParams
	* Version:  1.0
	* Date:     Mar 21, 2006
	* Author:	 Mario F. Restrepo <mrestrepo@parquesoft.com>
	* Purpose:	 Show applications params in order to update'em
	* Examples : {viewParams}
	* --------------------------------------------------------------------
	*/
	function smarty_function_viewParams($params, &$smarty)
	{
		settype($rcTmp,"array");
		settype($rcTmpCrl,"array");
		settype($rcIds,"array");
		settype($rcParams,"array");
		settype($rcValues,"array");
		settype($rckeys,"array");
		settype($rcMod,"array");
		settype($sbHtml,"string");
		settype($sbkey,"string");
		settype($sbLabelCrl,"string");
		
		extract($_REQUEST);
		extract($params);

		if(strlen($schema)==0)
			$schema = 0;
			
		//Traemos los parametros del serializado
	    $objDomain = Application::getDomainController("ParamsManager");
	    $rcTmp = $objDomain->getAllParams($schema);
	    
	    //Algunos de ellos definitivamente no se deben dejar modificar
	    $sbNAllowParams = Application::getConstant("NOT_ALLOWED_PARAMS");
	    
	    //Algunos necesitan objetos "especiales" para ser mostrados. Solo queda uno por fuera:  human_resources=>permisos_entes
	    $rcObjects = Application::getConstant("PARAMS_OBJECTS");
        
        //Ahora, hay casos en los que un grupo de parAmetros no pueden mostrase, si no hay valores para su parAmetro padre
        popArrayParams($sbNAllowParams,$rcObjects);
	    	    
	    $rcuser = Application::getUserParam();
		if(!is_array($rcuser))
		{
			//Si no existe usuario en sesion 
			$rcuser["lang"] = Application::getSingleLang();
		}
		//Se replica el calculo de las teclas rapidas de los botones
		//Incluye las etiquetas de los comandos genericos
		$rcTmpCrl=explode(",",$controls);
		if($rcTmpCrl){
			include($rcuser["lang"]."/".$rcuser["lang"].".generic.php");
		
			foreach($rclabels_crl as $sbkey => $sbLabelCrl){
				if(in_array($sbkey,$rcTmpCrl)){
					$rcMod = fncmodificarlabel1($sbLabelCrl,$rckeys,false);
					$rckeys = $rcMod[1];
				}
			}
		}
		
		include($rcuser["lang"]."/".$rcuser["lang"].".params.php");
		
		foreach($rclabels as $sbkey => $rcvalue){
			if(is_array($rcvalue) && $rcvalue["accesskey"]){
				$rcMod = fncmodificarlabel1($rcvalue["label"],$rckeys);
				$rclabels[$sbkey] = array($rcMod[0],$rcMod[2],$rcvalue["commentary"]);
				$rckeys = $rcMod[1];
			}else{
				$sbkey = strtolower($sbkey);
				$rclabels[$sbkey] = array($rcvalue["label"],null,$rcvalue["commentary"]);
			}
		}
		
		if($rcTmp)	{
			while (list($sbModule,$rcParams) = each($rcTmp)){
				while (list($sbIdParam,$rcValues) = each($rcParams)){
					if((strpos(strtolower($sbNAllowParams),strtolower($sbIdParam)))===false){
						$sbHtml .= "<tr>";
						$sbHtml .= getInputControl($sbModule,$sbIdParam,$rcValues,$rclabels,$rcObjects);
						$sbHtml .= "</tr>";
					}
				}
			}
		}
		$sbHtml .= "<input type=hidden name=schema value='".$schema."'>";
	    unset($rcTmp,$rcParams,$rcValues,$sbIdParam,$sbModule,$objDomain);
	    return $sbHtml;
	}

	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Obtiene todos los parÃ¯Â¿Â½metros
	* @return mixed
	* @author creyes <mrestrepo@parquesoft.com>
	* @date 21-mar-2006 16:42:13
	* @location Cali-Colombia
	*/
	function getInputControl($sbIdModule,$sbIdParam,$rcValues,$rclabels,$rcObjects)
	{
		settype($sbHtml,"string");
	    if($sbIdParam == Application::getConstant('GRANTS_LABEL_PARAM'))
	    {
	    	//return $sbHtml;
	    }
	    else
	    {
			if(!is_array($rcValues))
			{
				$sbHtml .= getControl($sbIdModule,$sbIdParam,$rcValues,$rclabels,$rcObjects);
			}
			else
			{
				//Algunos parÃ¯Â¿Â½metros son matrices con tuplas id=>valor
				$sbLabel = strip_tags($rclabels[$sbIdParam][0]);
				$sbHtml .= "<tr><td colspan=3><B>".$sbLabel;
				$sbHtml .= "</B></td><td class='piedefoto'>&nbsp;</td></tr>";
				
				list($sbIdSPar,$sbSValue) = each($rcValues);
				reset($rcValues);
				if(strlen($sbIdSPar)>2)
				{
					while (list($sbIdSPar,$sbSValue) = each($rcValues))
					{
						$sbHtml .= "<tr>";
						$sbHtml .= getControl($sbIdModule,$sbIdParam,$sbSValue,$rclabels,$rcObjects,$sbIdSPar);
						$sbHtml .= "</tr>";
					}
				}
				else
				{
					$sbHtml .= "<tr>";
					$sbHtml .= getControl($sbIdModule,$sbIdParam,$rcValues,$rclabels,$rcObjects);
					$sbHtml .= "</tr>";
				}
			}
	    }
		return $sbHtml;
	}

	/**
	* @copyright Copyright 2006 &copy; FullEngine
	*
	* Obtiene todos los parÃ¯Â¿Â½metros
	* @return mixed
	* @author creyes <mrestrepo@parquesoft.com>
	* @date 21-mar-2006 16:42:13
	* @location Cali-Colombia
	*/
	function getControl($sbIdModule,$sbIdParam,$rcValues,$rclabels,$rcObjects,$sbIdSPar=0)
	{
		settype($sbHtml,"string");
		settype($rcInclude,"array");
		extract($_REQUEST);
		
		//Determinamos el tipo de control, el tipo de dato, etc.
		$sbName = $sbIdModule."__".$sbIdParam."__".$sbIdSPar;
		$_type = "function";
		$maxlength = 100;
		
		if(is_array($rcValues))
		{
			$_name = "select_params";
			$typedata = "string";
			$size = 20;
		}
		else
		{
			$size = (strlen($rcValues)*1.5)<20?20:(strlen($rcValues)*1.5);
			$_name = "textfield";
			if(is_numeric($rcValues))
				$typedata = "integer";
			else
				$typedata = "string";
		}
		
		//Veamos si este necesita ser dubujado en algo distinto:
		if(array_key_exists($sbIdSPar,$rcObjects))
		{
			$_name = $rcObjects[$sbIdSPar]['object'];
			$_rcVal = $rcObjects[$sbIdSPar];
			if($rcValues)
				$_rcVal['load'] = $rcValues;
			$_rcVal['id'] = $sbIdSPar;
			$_rcVal['name'] = $sbName;
		}
		elseif(array_key_exists($sbIdParam,$rcObjects))
		{
			$_name = $rcObjects[$sbIdParam]['object'];
			$_rcVal = $rcObjects[$sbIdParam];
			if($rcValues)
				$_rcVal['load'] = $rcValues;
			$_rcVal['id'] = $sbIdParam;
			$_rcVal['name'] = $sbName;
		}
		else
		{
			//Por "default"
			if(strlen($sbIdSPar)>1)
				$_rcVal = array("id"=>$sbIdSPar,"name"=>$sbName,"typeData"=>$typedata,"maxlength"=>$maxlength,"size"=>$size,"value"=>$rcValues,"rcValues"=>$rcValues,"action"=>$action);
			else
				$_rcVal = array("id"=>$sbIdParam,"name"=>$sbName,"typeData"=>$typedata,"maxlength"=>$maxlength,"size"=>$size,"value"=>$rcValues,"rcValues"=>$rcValues,"action"=>$action);
			if($rcValues)
				$_rcVal['load'] = $rcValues;
		}
		
		if(array_key_exists($sbIdSPar,$rclabels))
		{
			$sbHtml .= "<td colspan=2>";
			$sbHtml .= $rclabels[$sbIdSPar][0];
			$sbHtml .= "</td>";
		}
		else if(array_key_exists($sbIdParam,$rclabels))
		{
			$sbHtml .= "<td colspan=2>";
			$sbHtml .= $rclabels[$sbIdParam][0];
			$sbHtml .= "</td>";
		}
		else
			$sbHtml .= "<td colspan=2>".$sbIdSPar."</td>";
	    $sbHtml .= "<td>";
	    
	    //Plugin
		$_plugin_file = Application::getPluginsDirectory()."/".$_type.".".$_name.".php";
		if(file_exists($_plugin_file))
		{
			$_plugin_func = 'smarty_' .$_type.'_'.$_name;
			if(!in_array($_plugin_func,$rcInclude))
			{
				$rcInclude[] = $_plugin_func;
				include_once $_plugin_file;
			}
			//Se hace el llamado al plugin correspondiente
			$sbHtml .= $_plugin_func($_rcVal,$this,false);
		}
		$sbHtml .= "</td>";
		
		//Se agregan comentarios
		if(array_key_exists($sbIdSPar,$rclabels))
	   		$sbHtml .= "<td class='piedefoto'>".$rclabels[$sbIdSPar][2]."</td>";
	    else
	    	$sbHtml .= "<td class='piedefoto'>".$rclabels[$sbIdParam][2]."</td>";
		
		return $sbHtml;
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
function fncmodificarlabel1($isblabel,$ircletrasusadas,$isbsenal=true)
{
	settype($orcresult,"array");
	settype($sbteclarapida,"string");
	settype($sbresult,"string");
	
	$sbteclarapida = fncteclarapida1($isblabel,$ircletrasusadas);
	
	if ($sbteclarapida){
		
		if($ircletrasusadas){
			if(!in_array($sbteclarapida,$ircletrasusadas)){
				$ircletrasusadas[]=$sbteclarapida;
			}
		}
		else{
			$ircletrasusadas[]=$sbteclarapida;
		}
		
		$sbresult = fncresaltarlabel1($isblabel,$sbteclarapida,$isbsenal);
		
		$osbresult = fnctildea_a_cute1($sbresult);
		
		$orcresult[0] = $sbresult;
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
function fncresaltarlabel1($isblabel,$isbteclarapida,$isbsenal)
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
function fncteclarapida1($isblabel,$ircletrasusadas)
{
	settype($rcletperm,"array");
	settype($osbresult,"string");
	settype($nucontador,"integer");
	settype($nulargocadena,"integer");
	
	
	if($isblabel){
		
		//Pasa las tildes HTML a normales
		$isblabel = fncacute_a_tilde1($isblabel);
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
Decripcion		: Cambia en una cadena las tildes tipo HTML a tipo normal de &oacute; a Ã¯Â¿Â½
Parametros		: Descripicion
$isbcadena		: Cadena a cambiar
Retorno		: Descripicion
$isbcadena		: Cadena cambiada
Autor			: freina
Fecha			: 04-May-2004
*/
function fncacute_a_tilde1($isbcadena)
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
Decripcion		: Cambia en una cadena las tildes tipo normal a tipo HTML de Ã¯Â¿Â½ a &oacute;
Parametros		: Descripicion
$isbcadena		: Cadena a cambiar
Retorno		: Descripicion
$isbcadena		: Cadena cambiada
Autor			: freina
Fecha			: 04-May-2004
*/
function fnctildea_a_cute1($isbcadena)
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

function popArrayParams(&$sbNAllowParams,$rcObjects)
{
    $rcCheckValuesParams = Application::getConstant('CHEK_VALUES_PARAMS');
    if(is_array($rcCheckValuesParams)) {
        foreach($rcCheckValuesParams as $sbKey=>$sbValue) {
            if(array_key_exists($sbValue,$rcObjects)) {
                if(array_key_exists('service',$rcObjects[$sbValue])){
                    if(array_key_exists('method',$rcObjects[$sbValue])){
                        $objService = Application::loadServices($rcObjects[$sbValue]['service']);
                        $rcData = $objService->$rcObjects[$sbValue]['method']();
                        if(!$rcData)
                            $sbNAllowParams .= ",".$sbKey;
                    }
                }
            }
        }
    }
}
?>
