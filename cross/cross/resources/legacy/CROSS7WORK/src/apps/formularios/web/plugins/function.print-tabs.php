<?php

/*
* Smarty plugin
* --------------------------------------------------------------------
* Type:     function
* Name:     topbar
* Version:  1.0
* Date:     Oct 20, 2003
* Author:	 Idaly Arcos <iarcos@parquesoft.com>
* Purpose:
* Definicion: pinta una barra de navegacion con base a los labels de la libreria topbar
*
*
* Examples : {textfield name="textfield" type="text" size="60" value="LIDIS"}
*
*
*
* --------------------------------------------------------------------
*/
function smarty_function_print_tabs($params,&$smarty)
{
    extract($params);
    extract($_REQUEST);
    //extraemos del entorno en lenguaje usado
    $rcuser = Application :: getUserParam();
    if (!is_array($rcuser))
    {
        //Si no existe usuario en sesion
        $rcuser["lang"] = Application :: getSingleLang();
    }
   
   
    //Pinta la tabla
    include ($rcuser["lang"]."/".$rcuser["lang"].".topbar.php");
    
    //extraemos el estado de tipo activo para consultar
    $rcestados = Application::getConstant('ESTADOS');
    $rcestado = array_keys($rcestados,'Activo');

    //BAJAR EL CÓDIGO DEL USUARIO DE LA SESIÓN
    $usuacodigon = $rcuser["usuacodigon"];
    
    //DEBEMOS CONSULTAR LOS TIPOS DE FORMULARIO A LOS QUE TIENE ACCESO EL USUARIO PARA RESPONDER
    $estudio_manager = Application::getDomainController('EstudioManagerExtended');
    $data_topbar = $estudio_manager->getTipoFormByEstudio($usuacodigon,$rcestado[0]);
    
    
    $Url ="=index.php?action=";
    $sbColor ="0A51A1";
   
    //$html_result = "<div class='halfmoon'><ul>";
    $html_result = "<div class='ddoverlap'><ul>";
    //seleccionamos el ultimo elemento del arreglo para mandarle la variable de finalizacion del estudio
    $rcKeys = array_keys($data_topbar);
    $ultimo = array_pop($rcKeys);
    
    
    if(is_array($data_topbar))
    {
        //conseguimos las etiquetas para barra
        $rcEtiquetas = Application::getConstant('ETIQUETA_TOPBAR_ENTRE');
        $sbPestana ='';
        foreach ($data_topbar as $key => $rcValue)
        {
        	$html_result .="<li";
        	if($propiedad__proptipopros == $rcValue['formmodelon'])
        		$html_result .="  class='selected'";
        	
        	if($key == $ultimo)
        		$sbUltimo = "&ultimo=true";
        	else 
        		$sbUltimo = "";
        	
        			
        	$html_result .=">";
        	$html_result .="<a href='index.php?action=FeEnCmdDefaultRecolectar&propiedad__proptipopros=".$rcValue['formmodelon'].$sbUltimo."'>".$rcEtiquetas[$rcValue['formmodelon']]."</a>";
        	$html_result .="</li>";
        }
    }

    $html_result ."</ul></div><br style=clear: left' />";
	    
   
    return $html_result;
    
}
?>