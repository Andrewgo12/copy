<?php
/*** @Copyright 2004 © FullEngine
 *
 * Smarty plugin: Pinta el listado de consulta
 * @author creyes <cesar.reyes@parquesoft.com>
 * @date 14-feb-2005 14:44:19
 * @location Cali - Colombia
 * example: {consult_table table_name="personal" llaves="perscodigos" form_name="
 * frmPersonalConsult" sqlid="personal" command="FeHrCmdShowListPersonal"}
 */

function smarty_function_consult_table($params, & $smarty) {
	extract($params);

	settype($rcTmp,"array");
	settype($rcParam,"array");
	settype($sbIndex,"string");
	settype($sbValue,"string");
	settype($sbId,"string");
	settype($sbSql,"string");
	settype($nuCont,"integer");

	$sbId = 'CR3';

	if(!$_REQUEST['sqlConsult']){
		 
		unset($_SESSION[$sbId."_curr_page"]);
		 
		//Trae el sql para ejecutar
		$gateWay = Application :: getDataGateway("SqlExtended");
		if($sqlid){
			$rcreq["sql"] = $gateWay->getSqlConsult($sqlid,$rcParam);
		}else{
			if(!$viewfields)
			$viewfields = '*';
			$rcreq["sql"] = $gateWay->getGenericSql($table_name, $viewfields);
		}

		//Busca los valores de la interfaz para ejecutar filtros
		foreach($_REQUEST as $key => $value){
			if((strpos($key,'__')!==false) && $value){
				if(strpos($key,'__')!==0){
					$nameField = str_replace('__',".",$key);
					$rcFields[$nameField] = $value;
				}
			}
		}
		$rcreq["sql"] = $gateWay->setFilterSql($rcreq["sql"], $rcFields);
		if($sqlid=="contacto")
		$rcreq["sql"] = str_replace("cliecodigos","cliecodigon",$rcreq["sql"]);
		$sbSql = htmlentities(html_entity_decode($rcreq["sql"]));
		echo "<input type='hidden' size=50 name='sqlConsult' value=\"".$sbSql."\">";
	}else{
		$rcreq["sql"] = html_entity_decode(stripslashes($_REQUEST['sqlConsult']));
		if($sqlid=="contacto")
		$rcreq["sql"] = str_replace("cliecodigos","cliecodigon",$rcreq["sql"]);
		$sbSql = htmlentities(html_entity_decode($rcreq["sql"]));
		echo "<input type='hidden' size=50 name='sqlConsult' value=\"".$sbSql."\">";
	}

	if(is_array($_REQUEST) && $_REQUEST){
		foreach($_REQUEST as $sbIndex=>$sbValue){
			if($sbIndex!=$sbId."_next_page" && $sbIndex!="link" && $sbIndex!="order_by"){
				unset($_REQUEST[$sbIndex]);
			}
		}
	}
	 
	$rcreq["service"] = $service;
	$rcreq["datefields"] = $date_fields;
	$rcreq["action"] = $command;
	$rcreq["table"] = $table_name;
	$rcreq["view_fields"] = "*";
	$rcreq["key_return"] = $llaves;
	$rcreq["order_by"] = $_REQUEST["order_by"];
	$appId = Application :: getAppId();
	$rcreq["command"] = $appId."CmdShowById".ucfirst($table_name);
	$rcreq["form"] = $form_name; // add by Diego Ramirez Software House
	$rcreq["jsfunction"] = "loadConsult";
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
	$rcLlaves = explode(",",$llaves);

	//'&var1='+value0+'&var2='+var3
	foreach($rcLlaves as $key => $value){
		$rcTmpParams[] = "keyValue$key";
		$rcTmpValues[] = "'&".$table_name."__".$value."='+keyValue$key";
	}
	//Pinta la funcion de javascript
	$jsCad = "\n<script language='javascript'>" .
				"\nfunction loadConsult(cmd,".implode(",",$rcTmpParams)."){" .
				"	\n\tlocation.href='index.php?action='+cmd+".implode("+",$rcTmpValues).";
			}\n</script>\n";
	echo $jsCad;

	//Carga las etiquetas de la tabla en la sesion
	include ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	$pager = Application :: loadServices("Pager");
	$pager->pagerGrid($rcreq, $rclabels, $sbId, true, false);
	$pager->Render();
}
?>