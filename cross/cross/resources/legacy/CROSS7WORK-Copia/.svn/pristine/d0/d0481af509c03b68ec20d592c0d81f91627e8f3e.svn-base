<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Crea un boton para la lista de ayuda de las tablas
*	@param array $params ["table"] -> Nombre de la tabla 
						 ["view_fields"] -> campos a ver se parados por coma
						 ["field_return"] -> Campo de la tabla a retornar
						 ["jsobjget"] -> Nombre del campo de html a recibir el valor
*	@author creyes
*	@date 06-Jul-2004 11:59 
*	@location Cali-Colombia
*/
function smarty_function_btn_lsthelp($params, &$smarty)
{
	if(!is_array($params))
		return;
	extract($params);
	if (!$table || !$view_fields || !$field_return || !$jsobjget)
		return;
    return "<input type=\"button\" name=\"lst_help\" value=\"?\" onclick=\"fncopenlst_help('$table','$view_fields','$field_return','$jsobjget')\">";
}
?>