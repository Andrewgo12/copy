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
* Examples : {textfield name="textfield" type="text" size="60" value="LIDIS"}
*
*
*
* --------------------------------------------------------------------
*/
function smarty_function_bienv_metrika($params,&$smarty)
{
    extract($params);
    extract($_REQUEST);
    //extraemos del entorno en lenguaje usado
    $rcuser = Application :: getUserParam();
    if (!is_array($rcuser)){
        //Si no existe usuario en sesion
        $rcuser["lang"] = Application :: getSingleLang();
    }
   //incluimos las librerias de lenguaje
    include ($rcuser["lang"]."/".$rcuser["lang"].".entrevistado.php");
    
    //$pathimage = "../general/tmp/images/".$rcUser["logo"];
    //debemos traer de profiles el logo de la empresa
    
   $sbHtml =$rclabels['title']; 
    
    return $sbHtml;
    
}

?>