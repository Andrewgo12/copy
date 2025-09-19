<?php
/**
 * @copyright Copyright 2004 FullEngine S.A.
 * 
 * Plugin function de smarty, Carga opciones en un combo,
 * Depende de la constante del config.ini "max_combo_options", si la cantidad de opciones sobrepasa
 * este valor se pinta la opcion para consulta con ajax
 * 
 *
 * OPCIONES:
 * sqlid : Id del sql, debe estar escrito en extended::getDataCombo (obligatorio)
 * value : Nombre del campo con el valor, lo asume como el name html (obligatorio)
 * label : Nombre del campo con la etiqueta de la lista(obligatorio)
 * usrlabel: {string} Texto de identificador del campo desde la db de lenguaje container:label_id, Indica el label o nombre (obligatorio)
 * 						del campo alte el usuario final, es utilizado para generar los mensajes de error y extraer las ayudas
 * htmlid : Id del objeto html (opcional), si no existe se asume el valor de value
 * firstnull : true|false Indica si el primer elemento del combo es vacio (opcional) por defecto true
 * multiple : number Indica que es de multiple seleccion, y cuantas opciones visibles
 * onchange : Codigo js a ejecutarse en este evento (opcional)
 * onblur : Codigo js a ejecutarse en este evento (opcional)
 * onfocus : Codigo js a ejecutarse en este evento (opcional)
 * selected : Codigo(s) de la opcion(es) seleccionada(s) por default, separadas por coma, tambien puede ser un array 
 * size : Tamano del objeto
 * forceautoreference : true Sirve para forzar el uso del autoreferenciado (opcional) por defecto false
 * required : {true|false} Indica si el campo es requerido. El valor predeterminado es falso. (opcional)
 * 
 * Notas: 
 * 1. Para el optimo funcionamiento del plugin en los autoreferenciados se deben tener incluidos en el documento el archivo js SelectControl.js
 * 
*/
function smarty_function_dataselectdojo($params, & $smarty) {

	extract($params);
	settype($objGateway,"object");
	settype($objSelect,"object");
	settype($rcData,"array");
	settype($nuCant,"integer");
			
	if (!$sqlid || !$value || !$label)
		return "<b>ERROR: Faltan parametros para la function smarty" . __FUNCTION__ . '</b>';

	//Carga la compuerta
	$objGateway = Application :: getDataGateway('sqlExtended');

	/* Verfica la cantidad de registros*/
	if ($forceautoreference) {
		$select = false;
		if($_REQUEST[$name]){
			$rcData = $objGateway->getDataCombo($sqlid);
		}
	} else {
		//Determina la cantidad de registros
		$rcData = $objGateway->getDataCombo($sqlid);
		
		if(is_array($rcData) & $rcData){
			$nuCant = sizeof($rcData);
		}

		$configCanrRegs = (integer) Application :: getConstant('max_combo_options');
		if ($nuCant <= $configCanrRegs)
			$select = true;				
	}

	include_once "dojo/htmlresources.inc.php";

	//Pinta un combo normal
	$objSelect = new htmlSelect;
	$objSelect->name = $name ? $name : $value;
	$objSelect->id = $htmlid ? $htmlid : $value;
	$objSelect->selected = $selected ? $selected : $_REQUEST[$objSelect->name];
	$objSelect->multiple = $multiple;
	$objSelect->onchange = $onchange;
	$objSelect->onblur = $onblur;
	$objSelect->onfocus = $onfocus;
	$objSelect->valueField = $value;
	$objSelect->labelField = $label;
	$objSelect->required = $required;
	if($adicParamName)
		$objSelect->adicParamName = $adicParamName;
	
	if ($firstnull == 'false'){
		$objSelect->firstNull = false;
	}
	if ($select) {
		if(is_array($rcData)){
			$objSelect->options = $rcData;
		}
	} else {
		$objSelect->autoreference = true;
		$objSelect->sqlid = $sqlid;
		if($_REQUEST[$objSelect->name]){
			$objSelect->is_null = true;
			$objSelect->options = $rcData;
		}
	}
	return $objSelect->generate();

}
?>
