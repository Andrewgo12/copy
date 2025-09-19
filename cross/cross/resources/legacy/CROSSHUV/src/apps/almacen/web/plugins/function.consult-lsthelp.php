<?php 
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta la lista de ayuda para cada tabla 
*	@author creyes
*	@date 06-Jul-2004 11:59 
*	@location Cali-Colombia
*/

/*
{grilla 
   table="asigenc" 
   sql_sess_name_var //Nombre de la variable de sesion que contiene el sql a ejecutar, si existe este parametro la 
   										consulta no calculara el sql
   idlabels="asicod,estado,asiprio,porasi,resnom,asinom,asunom,relnom,asides,feclim,horlim,clinom,grunom" 
   view_fields="asicod,estado,asiprio,porasi,resnom,asinom,asunom,relnom,asides,feclim,horlim,clinom,grunom" 
   submit="CmdDefaultAdmact" // Comando a ejecutar para los ordenamientos normalmente es el que carga la forma
   command="CmdShowByIdAsigenc" // Comando a ejecutarse al onclick de las filas de la grilla
   key_return="empres,asicod"  //Campos de la tabla parametro de la funcion javascript
   jsfunction="fncviewdata" //Nombre de la funcion javascript que recibira los parámetros, recibira como primer parametro
   													el comando (command) y seguidamente los valores de key_return en el orden propuesto
   form="frmAdmact"
   cache="true"  //Si la consulta es ejecuta con cache esta por defecto en false (Opcional)
   num_rows="20" //Cantidad de registros por pagina por defecto en 20 (Opcional)
   }
*/

function smarty_function_consult_lsthelp($params, & $smarty) {
	extract($params);
	//Trae el sql para ejecutar
	$gateWay = Application :: getDataGateway("SqlExtended");
	$rcreq["sql"] = $gateWay->getSqlHelp($_REQUEST["sqlid"]);
	$rcreq["action"] = $submit;
	$rcreq["table"] = $_REQUEST["table"];
	//$rcreq["view_fields"] = $view_fields;
	$rcreq["key_return"] = $_REQUEST["return_key"];
	$rcreq["order_by"] = $order_by;
	$rcreq["command"] = $_REQUEST["return_obj"];
	$rcreq["form"] = $form; // add by Diego Ramirez Software House
	$rcreq["jsfunction"] = "fncputvalue";
	if($cache == "true")	
		$rcreq["cache"] = true;
	else 
		$rcreq["cache"] = false;
	if($num_rows)
		$rcreq["num_rows"] = $num_rows;
	else
		$rcreq["num_rows"] = 20;
	//Obtiene los datos del usuario
	$rcuser = Application :: getUserParam();
	if (!$table && !is_array($rcuser))
		return;
	//Carga las etiquetas de la tabla en la sesion
	$table_name = strtolower($rcreq["table"]);
	include_once ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");

	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();
}

?>