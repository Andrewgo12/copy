<?php 
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     consult_table
 * Version:  1.1
 * Date:     Nov 28 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:  Crea una tabla en html, la cual es llenada con los datos de
 *           una tabla en la base de datos.
 * Input:
 *           table_name = nombre de la tabla en la base de datos (required)
 *           llaves = nombre de los identificadores de la tabla (required) si los identificadores son mas de uno deben ser separados por ','
 *           form_name = nombre de la forma que contiene el consult_table (required)
 *           titulos = encabezados de la tabla que se crea(optional)
 *           cambiar_valor = son los campos de la tabla que seran reemplazados por otros valores en otras tablas. (optional)
 *                           la cadena debe tener el siguiente formato :
 *                           1. Nombre del campo que va a cambiar de la tabla 'table_name'
 *                           2. Nombre Tabla de donde se sacara el valor nuevo
 *                           3. Nombre del indice de la tabla de donde se sacara el valor nuevo
 *                           4. Nombre del campo de la tabla expesificada en numeral (2), este sera el nuevo valor.
 *           cantidad_registros = es el numero de registros que cargara la consulta como maximo.(optional)
 *           commnad = nombre del comando que se invocar cuando el usuario desea cambiar a la pagina siguiente(optional)
 *
 * Examples: 
 *           {consult_table table_name="ciudad"
 *                          llaves="Codigo_Ciudad,Codigo_Pais"
 *                          form_name="FrmCiudad"
 *                          titulos="Codigo Ciudad,Nombre Ciudad,Pais"
 *                          cambiar_valor="Codigo_Pais,pais,Codigo_Pais,Nombre_Pais"
 *                          cantidad_registros = 30
 *                          command = "CmdShowListCiudad"
 *           }
 *
 *
 * Nota: Necesita ser parte de una forma!
 * Adicion para las etiquetas de las cabeceras
 * --------------------------------------------------------------------
 */

function smarty_function_consult_table_profile($params, & $smarty) {

	extract($params);
	//descarga de sesion las particularidades del usuario
	$rcuser = Application :: getUserParam();
	if (!is_array($rcuser)) {
		//Si no existe usuario en sesion 
		$rcuser["lang"] = Application :: getSingleLang();
	}
	$table = strtolower($table);
	include ($rcuser["lang"]."/".$rcuser["lang"].".".$table_name.".php");
	array_shift($rclabels);
	foreach ($rclabels as $key => $value) $rcconsult[$key] = WebRequest :: getEnvValue($table_name."__".$key);

	//Carga el servicio de profiles
	$profilesServece = Application :: loadServices("Profiles");
	
	$gateway = $profilesServece->loadGateway("consult");

	if(isset($fields)){
		$fields = $llaves.",".$fields;
		$registros_tabla = $gateway->getDatabyparams($table_name, $rcconsult,$fields);
	}
	else
		$registros_tabla = $gateway->getDatabyparams($table_name, $rcconsult);
	//$registros_tabla = call_user_func(array($gateway,"getAll$table_name"));
	$profilesServece->close();
	// asigna el valor por defecto a la cantidad de registros
	if (!isset ($cantidad_registros)) {
		$cantidad_registros = 25;
	}

	//calcula la cantidad de paginas
	$cantidad_paginas = ceil(count($registros_tabla) / $cantidad_registros);

	//obtiene el numero de la pagina actual
	if (!WebRequest :: getEnvValue($table_name."__pagina_consult")) {
		$numero_pagina = 1;
	} else {
		if (WebRequest :: getEnvValue($table_name."__pagina_consult") > $cantidad_paginas) {
			$numero_pagina = $cantidad_paginas;
		} else {
			if (WebRequest :: getEnvValue($table_name."__pagina_consult") < 1) {
				$numero_pagina = 1;
			} else {
				$numero_pagina = WebRequest :: getEnvValue($table_name."__pagina_consult");
			}
		}
	}

	// asigna el valor por defecto al command
	if (!isset ($command)) {
		$command = "CmdShowList".ucfirst($table_name);
	}

	$html_tabla = '';
	$html_tabla .= "<table cellSpacing='1' cellPadding='3' align='center' border='0'>";

	if (isset ($titulos) || is_array($registros_tabla)) {
		CrearEncabezadoTabla($html_tabla, $registros_tabla, $titulos, $rclabels);
	}

	if (is_array($registros_tabla)) {
		CrearCuerpoTabla($html_tabla, $registros_tabla, $table_name, $llaves, $cambiar_valor, $cantidad_registros, $numero_pagina);
	}

	$html_tabla .= "</table>";

	CrearVariablesOcultas($html_tabla, $table_name, $llaves);

	if ($cantidad_paginas > 1) {
		CrearMenuPaginasSiguientes($html_tabla, $table_name, $form_name, $numero_pagina, $cantidad_paginas, $command);
	}

	$html_result = $html_tabla;

	print $html_result;

}

/*
* Crea el encabezado de la tabla, con el valor de la variable $ titulos,
* si titulos no esta setiado por defecto el encabezado de la tabla
* son los nombre de los campos de la tabla en la base de datos
*/
function CrearEncabezadoTabla(& $html_tabla, $registros_tabla, $titulos, $rclabels) {

	//si la variable titulos esta setiada crea un vector con los titulos
	//sino crea un vector con los indices del vector $registros_tabla
	if (isset ($titulos)) {
		$m = explode(",", $titulos);
	} else {
		//pasa los titulos a un vector
		$m = array_keys($registros_tabla[0]);
	}
	$nuHead = count($m);
	$colsPan = $nuHead + 1;
	// crea el encabezado de la tabla
	$html_tabla .= "<tr><th colspan=\"$colsPan\"><div align=\"left\">".$rclabels["consulttitle"]."</div></th></tr><tr>";
	$html_tabla .= "<th>&nbsp</th>";
	for ($i = 0; $i < $nuHead; $i ++) {
		$html_tabla .= "<td class='titulofila'>";
		$campo = strtolower($m[$i]);
		if ($rclabels[$campo]["label"])
			$html_tabla .= $rclabels[$campo]["label"];
		else
			$html_tabla .= $campo;
		$html_tabla .= "</td>";
	}
	$html_tabla .= "</tr>\n";

}

/*
* Crea una tabla en html con los datos de la tabla de la base de datos
*/
function CrearCuerpoTabla(& $html_tabla, $registros_tabla, $table_name, $llaves, $cambiar_valor, $cantidad_registros, $numero_pagina) {

	//obtener las llaves de la tabla y pasarlas a un vector
	$keys = explode(",", $llaves);

	for ($i = (($numero_pagina -1) * $cantidad_registros),$cont = 0;($i < $numero_pagina * $cantidad_registros) && ($i < count($registros_tabla)); $i ++,$cont++) {
			if(fmod($cont,2)  ==  0)
				$estilo = "celda";
				else
					$estilo = "celda2";

		$html_tabla .= "<tr>";

		CrearRadioButton($html_tabla, $table_name, $registros_tabla, $keys, $i);

		if (isset ($cambiar_valor)) {
			CambiarValorTabla($registros_tabla, $cambiar_valor, $i);
		}

		//obtener una fila completa de la tabla de la base de datos.
		$m = array_values($registros_tabla[$i]);

		for ($j = 0; $j < count($m); $j ++) {
			//Determina el interlineado
			$html_tabla .= "<td class='$estilo'>";
			if ($m[$j] != "") {
				$html_tabla .= $m[$j];
			} else {
				$html_tabla .= "&nbsp;";
			}
			$html_tabla .= "</td>";
		}
		$html_tabla .= "</tr>\n";
	}
}

/*
* Cambia los valores de del vector '$registros_tabla' que son indices
* de otras tablas en la base de datos
*/
function CambiarValorTabla(& $registros_tabla, $cambiar_valor, $indice) {
	//convierte la cadena a un vector
	$parametros_cambiar = explode(",", $cambiar_valor);
	//Carga el servicio de profiles
	$profilesServece = Application :: loadServices("Profiles");

	for ($i = 0; $i < count($parametros_cambiar); $i += 4) {
		//llama la clase de la tabla
		$gateway = $profilesServece->loadGateway($parametros_cambiar[$i +1]);
		//$gateway = Application :: getDataGateway($parametros_cambiar[$i +1]);
		//optiene todos los datos de la tabla
		$datos = call_user_func(array ($gateway, "getAll".$parametros_cambiar[$i +1]));

		for ($z = 0; $z < count($datos); $z ++) {
			//cambia el valor del vector por el nombre si los codigos son iguales
			if ($registros_tabla[$indice][$parametros_cambiar[$i]] == $datos[$z][$parametros_cambiar[$i +2]]) {
				$registros_tabla[$indice][$parametros_cambiar[$i]] = $datos[$z][$parametros_cambiar[$i +3]];
				break;
			}
		}
	}
	$profilesServece->close();
}

/*
* Crea un Radio Buton en la primera columna de la tabla en html que se esta generando,
* Por cada Radio Button se genera un codigo en JavaScript para en la propiedad
* 'Onclick' para asignar los vales de la llaves de la tabla en la base de datos
* en los campos ocultos. (Ver CrearVariablesOcultas)
*/
function CrearRadioButton(& $html_tabla, $table_name, $registros_tabla, $keys, $i) {

	$html_tabla .= "<td class='titulofila'>";
	$html_tabla .= "<input type='radio'";
	$html_tabla .= " name='".$table_name."__keys' onClick=\"";
	for ($z = 0; $z < count($keys); $z ++) {
		if ($z == 0) {
			$html_tabla .= $table_name."__".$keys[$z].".value = '".$registros_tabla[$i][$keys[$z]]."'";
		} else {
			$html_tabla .= ";".$table_name."__".$keys[$z].".value = '".$registros_tabla[$i][$keys[$z]]."'";
		}
	}
	$html_tabla .= "\">";
	$html_tabla .= "</td>";
}

/*
* Crea campos ocultos segun la cantidad de llaves tenga la tabla en la base de
* datos.
*/
function CrearVariablesOcultas(& $html_tabla, $table_name, $llaves) {
	$keys = explode(",", $llaves);
	for ($i = 0; $i < count($keys); $i ++) {
		$html_tabla .= "<input type='hidden' name='".$table_name."__".$keys[$i]."'>";
	}
}

/*
*
*
*/
function CrearMenuPaginasSiguientes(& $html_tabla, $table_name, $form_name, $numero_pagina, $cantidad_paginas, $command) {
	$html_tabla .= "<table border='0' align='center'>";

	$html_tabla .= "<tr>
	                 <td></td>
	                 <td><div align='center'><font size='2'>".$numero_pagina."/".$cantidad_paginas."</font></div></td>
	                 <td></td>
	                 </tr>";

	$html_tabla .= "<tr>";

	if ($numero_pagina != 1) {
		$html_tabla .= "<td><div align='center'><a href='#' onClick=\"".$table_name."__pagina_consult.value = parseInt(".$table_name."__pagina_consult.value)-1;action.value='".$command."';".$form_name.".submit();\">&lt;&lt;</a></div></td>";
	} else {
		$html_tabla .= "<td><div align='center'>&lt;&lt;</div></td>";
	}

	$html_tabla .= "<td><div align='center'><input type='text' name='".$table_name."__pagina_consult' maxlength='3' size='2' value='".$numero_pagina."' ";

	if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") or strstr($_SERVER["HTTP_USER_AGENT"], "Opera")) {
		$html_tabla .= "onKeyPress=\"if((event.keyCode == 13) && (".$table_name."__pagina_consult.value == '')){";
		$html_tabla .= "event.returnValue = false;";
		$html_tabla .= "}else{";
		$html_tabla .= "if((event.keyCode == 13) && (".$table_name."__pagina_consult.value != '')){";
		$html_tabla .= "action.value='".$command."';";
		$html_tabla .= $form_name.".submit();}}";

		$html_tabla .= "if (!((event.keyCode>=48) && (event.keyCode<=57))){event.returnValue = false;}\"";

	} else {
		$html_tabla .= "onKeyPress=\"if(event.keyCode == 13){";
		$html_tabla .= "action.value='".$command."';";
		$html_tabla .= "if(".$table_name."__pagina_consult.value == ''){";
		$html_tabla .= $table_name."__pagina_consult.value = '1';";
		$html_tabla .= "}}";
		$html_tabla .= "if (!((event.charCode>=48) && (event.charCode<=57) ||(event.charCode == 0) || (event.charCode == 8))){event.preventDefault();}\"";
	}

	$html_tabla .= "></div></td>";

	if ($numero_pagina < $cantidad_paginas) {
		$html_tabla .= "<td><div align='center'><a href='#' onClick=\"".$table_name."__pagina_consult.value = parseInt(".$table_name."__pagina_consult.value)+1;action.value='".$command."';".$form_name.".submit();\">&gt;&gt;</a></div></td>";
	} else {
		$html_tabla .= "<td><div align='center'>&gt;&gt;</div></td>";
	}
	$html_tabla .= "</tr>";

	$html_tabla .= "<tr>
	                 <td></td>";

	$html_tabla .= "<td><div align='center'><input type='button' value='  Ir  ' onClick=\"if((".$table_name."__pagina_consult.value < 1) || (".$table_name."__pagina_consult.value > ".$cantidad_paginas.")){";
	$html_tabla .= "alert('Error: Debe ingresar un numero entre 1 y ".$cantidad_paginas."');";
	$html_tabla .= $table_name."__pagina_consult.value = ''";
	$html_tabla .= "}else{";
	$html_tabla .= "action.value='".$command."';";
	$html_tabla .= $form_name.".submit();";
	$html_tabla .= "}\"></div></td>";

	$html_tabla .= "<td></td>
	                 </tr>";

	$html_tabla .= "</table>";

}

?>
