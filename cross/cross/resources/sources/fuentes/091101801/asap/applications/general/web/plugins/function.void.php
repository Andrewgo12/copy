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
function smarty_function_void($params, & $smarty) {
	
	return "</b>";
}
?>