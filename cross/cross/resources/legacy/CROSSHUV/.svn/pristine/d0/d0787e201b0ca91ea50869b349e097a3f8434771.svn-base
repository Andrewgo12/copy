<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     btn_command
 * Version:  1.0
 * Date:     Oct 20, 2003
 * Author:	 Leider Vivas <leiderv@hotmail.com>
 * Purpose:
 * Input:
 *           name = name of btn_command (optional)
 *           id = id of btn_command (optional)
 *           type = define the type of the btn_command ('button'|'submit')(required)
 *           disabled = disable the btn_command (optional)
 *           onClick = To introduce code javascript (optional)
 *           value = define the label of the btn_command (optional)
 *           form_name = nombre de la forma que contiene el btn_command
 *                      (SI type = 'button' entonces form_name es requerido)
 *           loadFields = Campos de la forma que deben estar cargados para ejecutar dicha acción, 
 *                          separados por coma. (optional)
 *           confirm = numero del mensaje para hacer confirmación antes de ejecutar la acción (optional). 
 *
 *
 * Examples : {btn_command type="button" form_name="frmPais" value="Modificar" name="CmdUpdatePais" onClick="alert('click al button');"}
 *            {btn_command type="submit" value="Adicionar" name="CmdAddPais" onClick="alert('click al submit');"}
 *
 *
 * --------------------------------------------------------------------
 */

function smarty_function_btn_viewinnova($params, &$smarty)
{
	settype($objService,"object");
	settype($sbPath,"string");
	
	//se obtiene la URL de un parametro
	$objService = Application::loadServices('General');
    $sbPath = $objService->getParam("cross300","DOCUNET_PATH");
    
    if(!$sbPath){
    	return null;
    }
	
    //Valida si existe integración con innova
    $rcIntegracion = Application::getConstant('INT_INNOVA');
    if($rcIntegracion['status'] == false)
        return null;
    extract($params);
    $html_result = '';
    $html_result .= "<input class=boton";
    if (isset($name)){
        $html_result .= " name='".$name."'";
    }
    if (isset($type)){
        $html_result .= " type='".$type."'";
    }
    if (isset($id)){
        $html_result .= " id='".$id."'";
    }
    if (isset($value)){
        $html_result .= " value='".$value."'";
    }
	
    //actualiza el path
    $rcIntegracion["url"] = $sbPath;
    
    $html_result .= " onClick=\"if(!this.form.orden__ordenumeros.value){\n".
                                    "location='index.php?action=FeCrCmdDefaultFichaOrd&cod_message=0';\n".
                                "}else{\n".
                                    "var opciones='top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500';\n".
                                    "url ='{$rcIntegracion["url"]}?{$rcIntegracion["paramname"]}='+this.form.orden__ordenumeros.value;\n".
                                    "win = window.open(url,'Docunet',opciones);\n".
                                "}\">";

    print $html_result;

}

?>