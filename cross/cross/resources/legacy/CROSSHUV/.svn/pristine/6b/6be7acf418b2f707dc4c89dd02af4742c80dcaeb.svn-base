<?php 
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta la lista de ayuda para cada tabla 
*	@author freina
*	@date 11-Oct-2004 16:42 
*	@location Cali-Colombia
*/

/*
{consult_table_comunicacion
   table="asigenc" 
   sql_sess_name_var //Nombre de la variable de sesion que contiene el sql a ejecutar, si existe este parametro la 
   										consulta no calculara el sql
   idlabels="asicod,estado,asiprio,porasi,resnom,asinom,asunom,relnom,asides,feclim,horlim,clinom,grunom" 
   view_fields="asicod,estado,asiprio,porasi,resnom,asinom,asunom,relnom,asides,feclim,horlim,clinom,grunom" 
   submit="CmdDefaultAdmact" // Comando a ejecutar para los ordenamientos normalmente es el que carga la forma
   command="CmdShowByIdAsigenc" // Comando a ejecutarse al onclick de las filas de la grilla
   key_return="empres,asicod"  //Campos de la tabla parametro de la funcion javascript
   jsfunction="fncviewdata" //Nombre de la funcion javascript que recibira los par�metros, recibira como primer parametro
   													el comando (command) y seguidamente los valores de key_return en el orden propuesto
   form="frmAdmact"
   cache="true"  //Si la consulta es ejecuta con cache esta por defecto en false (Opcional)
   num_rows="20" //Cantidad de registros por pagina por defecto en 20 (Opcional)
   }
*/

function smarty_function_consult_table_comunicacion($params, & $smarty) {
	extract($params);
	settype($objgateway,"object");
	settype($serviceDate,"object");
	settype($rcparametros,"array");
	
	$serviceDate = Application :: loadServices("DateController");
	
	if($_REQUEST["comunicacion__ordenumeros"]){
		$rcparametros["ordenumeros"] =$_REQUEST["comunicacion__ordenumeros"];
	}
	if($_REQUEST["comunicacion__focacodigos"]){
		$rcparametros["focacodigos"] =$_REQUEST["comunicacion__focacodigos"];
	}  
	if($_REQUEST["orden__ordefecregdi"] &&$_REQUEST["orden__ordefecregdf"]){
		$rcparametros["ordefecregdi"] =$serviceDate->fncdatehourtoint($_REQUEST["orden__ordefecregdi"]);
		$rcparametros["ordefecregdf"] =$serviceDate->fncdatehourtoint($_REQUEST["orden__ordefecregdf"]);
	}
	if($_REQUEST["comunicacion__comuestados"]){
		$rcparametros["comuestados"] =$_REQUEST["comunicacion__comuestados"];
	}
	
	if(!$rcparametros){
		return false;
	}
	
	$objgateway = Application :: getDataGateway("SqlExtended");
	$rcreq["sql"] = $objgateway->getAllComunicacionSql($rcparametros);

	$rcreq["action"] = $submit;
	$rcreq["table"] = $table;
	$rcreq["view_fields"] = $view_fields;
	$rcreq["key_return"] = $key_return;
	$rcreq["order_by"] = $order_by;
	$rcreq["command"] = $command; // add by Diego Ramirez Software House
	$rcreq["form"] = $form; // add by Diego Ramirez Software House
	$rcreq["jsfunction"] = $jsfunction;
	$rcreq["checkbox"] = $checkbox;
	$rcreq["checkbox_value"] = $checkbox_value;
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
	$pager = Application :: loadServices("PagerCheck");
	$pager->pagerGrid($rcreq, $rclabels, 'CR3', true, false);
	$pager->Render();
}
?>