<?php
 /**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Despliega un calendario en un div
 	* Smarty plugin
 	* NOTA: El tpl que usara este plugin debe incluir las librerias js:
 	* libCalendar.js y libCalendarPopupCode.js
 	* params: id: Identificador para colocar el accekey (opcional) 
 	* name: nombre del input text * 
 	* form_name Nombre del formulario * 
 	* hour: si se debe usar horas (opcional por defecto en false), 
 	* size: tamaño del input text (opcional por defecto en 20)
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 30-mar-2005 12:43:32
	* @location Cali-Colombia
	* Ejemplo: 
	* {calendar id="ordefecregd" name="orden__ordefecregd" form_name="frmOrden"
	* hour="true"}
*/
function smarty_function_calendar($params, & $smarty) {
	
	extract($params);

	$imgPath = "web/images/calendar.gif";
	//Trae los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	//Carga el servicio de control de fechas 
	$serviceDate = Application :: loadServices("DateController");

	//Deatermina si la fecha es con horas o no
	if($hour == "true"){
		$nufecha = $serviceDate->fncintdatehour();
		$sbformato = $serviceDate->sbformat_date_time;
		$maxlength = 19;
	}else{
		$nufecha = $serviceDate->fncintdate();
		$sbformato = $serviceDate->sbformat_date_single;
		$maxlength = 10;
	}

	if(!isset($is_null))
		$sbfecha = $serviceDate->fncformatofechahora($nufecha);
	
	
	if (!isset ($size)) {
		$size = 20;
	}
	if(isset($id)){
		$sbid=" id='$id' ";
	}

    include ($rcuser["lang"]."/".$rcuser["lang"].".messages.php");
	$sbhtml_result = "<input type=text name='$name' size='$size' $sbid  maxlength='$maxlength' ";
	if ($_REQUEST[$name] !== null) { //Si la fecha viene en el request
        if(is_numeric($_REQUEST[$name])){ //Si esta en formato timestamp
            if($hour == "true"){ // esta definido con horas
                $_REQUEST[$name] = $serviceDate->fncformatofechahora($_REQUEST[$name]);
            }else{
                $_REQUEST[$name] = $serviceDate->fncformatofecha($_REQUEST[$name]);
            }
        }
		$sbhtml_result .= "value='".$_REQUEST[$name]."'";
	} else {
		$sbhtml_result .= "value='".$sbfecha."'";
	}
	$sbhtml_result .= " onBlur=\"if(this.value){var Tentativa = new Date(this.value);
                                if(isNaN(Tentativa)){
                                    alert('".$rcmessages[8]."');
                                    this.value = '';
                                    this.focus();
                                }}\">";
	if(isset($hour))	
		$horas = "cal1.time_comp = true;";
	else 
		$horas = "cal1.time_comp = false;";
	
	$sbhtml_result .= "<a href=\"#\" onclick=\"javascript:var Tentativa = new Date(document.forms['$form_name'].elements['$name'].value); 
                                                if(!isNaN(Tentativa) || document.forms['$form_name'].elements['$name'].value==''){
                                                    var cal1 = new calendar1(document.forms['$form_name'].elements['$name']);
                                                    cal1.year_scroll = true;
                                                    cal1.style='".$rcuser["style"]."';
                                                    $horas
                                                    cal1.format_date = '".$serviceDate->calendarFormat."';
                                                    cal1.language = '".$rcuser["lang"]."';
                                                    cal1.first_day = 'Su';
                                                    cal1.popup();
                                                }else{
                                                    alert('".$rcmessages[8]."');
                                                    document.forms['$form_name'].elements['$name'].value = '';
                                                    document.forms['$form_name'].elements['$name'].focus();
                                                }\">".
                        "<img src='$imgPath' border='0' align='middle'></a>";	
	return $sbhtml_result;
}
?>