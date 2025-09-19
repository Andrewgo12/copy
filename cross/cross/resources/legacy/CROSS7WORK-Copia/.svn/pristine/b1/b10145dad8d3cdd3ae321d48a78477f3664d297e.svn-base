<?php 

function smarty_function_select_father($params, & $smarty) {
	extract($params);

	//llama a la compuerta del select father
	$gateway_papa = Application :: getDataGateway("$table_papa");
	$v_papa = call_user_func(array ($gateway_papa, "getAll$table_papa"));

	$html_result = '';
	generar_select($v_papa, $html_result, $name, $id_papa, $label_papa, $command_default);

	return $html_result;

}

function generar_select($vect, & $html_result, $name, $id_papa, $label_papa, $command_default) {

	//llena el select father
	$html_result .= "<select name='".$name."' id='".$id_papa."' onchange=\"action.value = '".$command_default."';submit();\">";

	$html_result .= "<option value=''>---</option>";

	for ($i = 0; $i < count($vect); $i ++) {
		$html_result .= "<option value='";
		$html_result .= $vect[$i][$id_papa];
		if ($_REQUEST[$name] == $vect[$i][$id_papa]) {
			$html_result .= "' selected>";
		} else {

			$html_result .= "'>";
		}
		$html_result .= $vect[$i][$label_papa];
		$html_result .= "</option>";
	}
	$html_result .= "</select>";
}
?>