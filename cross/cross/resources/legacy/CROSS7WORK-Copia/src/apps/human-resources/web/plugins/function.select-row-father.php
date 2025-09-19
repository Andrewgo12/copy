<?php     
/*
 * Smarty plugin
 * Type:     function
 * Name:     select_row_table
 * Version:  1.0
 * Date:     Dic 03, 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:  
 * Input:
 *      name = is the name of the select (required)
 *      table_name = name of table in data base (required)
 *      value = is the name of the row in the tabla that specifies the value of select (required)
 *      label = is the name of the row in the tabla that specifies the laber of select(optional)
 *      size = this sets the number of visible choices(optional)
 *      is_null = especifica si el 'select_row_table' debe tener el valor nulo.  'true|false' (optional)
 *		id = Id del objeto
 *     command = name of the command (optional)
 *		$father = nombre del campo donde se almacenan el padre de cada nodo
 *
 * Examples: 
 *       {select_row_table name="Mycombo" table_name="dept" value="deptno"}
 *       {select_row_table name="Mycombo" table_name="dept" value="deptno" label="dname" size="5" is_null="true" command="FeCrCmdDefaultOrden"}
 *
 */
function smarty_function_select_row_father($params, & $smarty) {

	extract($params);
	settype($rctmp, "array");
	settype($sbid, "string");
	settype($sbhtml_result, "string");
	settype($sbfuncion, "string");
	settype($nucant, "integer");
	settype($nucont, "integer");
	settype($sbcommand, "string");

	if ($command) {
		$sbcommand .= " onchange=\"action.value = '".$command."';submit();\" ";
	}

	if (!isset ($sqlid)) {
		$gateway = Application :: getDataGateway("$table_name");
		$sbfuncion = "getAll".$table_name;
		$rctmp = $gateway-> $sbfuncion ();
	} else {
		$gateway = Application :: getDataGateway("SqlExtended");
		$rctmp = $gateway->getDataCombo($sqlid);
	}

    //Verifica si existe el registro
	$gateway = Application :: getDataGateway("$table_name");
	$sbfuncion = "getById".$table_name;
	$rcId = $gateway-> $sbfuncion ($_REQUEST[$table_name."__".$value]);
    
	$rctmp = BorrarValoresDuplicadosFather($rctmp, $value);

	if ($_REQUEST[$table_name."__".$value] && is_array($rcId)) {
		//se obtiene los descendentes del nodo
		$rctmp = fncinicio($rctmp, $father, $value, $_REQUEST[$table_name."__".$value]);
	}

	if (!isset ($label)) {
		$label = $value;
	}

	if (!isset ($size)) {
		$size = 1;
	}

	if (isset ($id)) {
		$sbid = " id=\"$id\"";
	}

	$sbhtml_result = '';
	$sbhtml_result .= "<select name='$name' size='$size' $sbid $sbcommand>";

	if ($is_null == "true") {
		$sbhtml_result .= "<option value=''>---</optional>";
	}

	if ($rctmp) {

		$nucant = sizeof($rctmp);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
            $sbhtml_result .= "<option value='";
            $sbhtml_result .= $rctmp[$nucont][$value];
            if ($_REQUEST[$name] == $rctmp[$nucont][$value]) {
                $sbhtml_result .= "' selected>";
            } else {
                $sbhtml_result .= "'>";
            }
            $sbhtml_result .= $rctmp[$nucont][$label];
            $sbhtml_result .= "</option>";
		}
	}
	$sbhtml_result .= "</select>";

	print $sbhtml_result;

}
/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Funcion de busqueda recursivo
	*   @param array $ircdata (matriz con la data de la tabla)
	*   @param string $isbindpadre   (Nombre del campo padre)
	*   @param string $isbindhijo (Nombre del campo hijo)
	*   @param string $isbinicio (Nodo inicio)
	*   @param $inuindice integer   Indice consecutivo
	*   @param $ircpadre array  Data acumulada
	*   @author freina
	*   @date 11-Nov-2004 21:20
	*   @location Cali-Colombia 
	*/
function fncseleccion($isbindpadre, $isbindhijo, $isbinicio, & $ircdata, & $ircpadre, & $inuindice) {
	settype($orcresult, "array");
	settype($nucant, "integer");
	settype($nucont, "integer");
	$nucant = 0;
	$nucant = sizeof($ircdata);
	for ($nucont = 0; $nucont < $nucant; $nucont ++) {
		if ($ircdata[$nucont][$isbindpadre] == $isbinicio) {
			fncseleccion($isbindpadre, $isbindhijo, $ircdata[$nucont][$isbindhijo], $ircdata, $ircpadre, $inuindice);
			$ircpadre[$inuindice] = $ircdata[$nucont][$isbindhijo];
			$inuindice ++;
		}
	}
	return;
}
/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Obtiene los ascendientes de un nodo
	*   @param array $ircdata (matriz con la data de la tabla)
	*   @param string $isbindpadre   (Nombre del campo padre)
	*   @param string $isbindhijo (Nombre del campo hijo)
	*   @param string $isbinicio (Nodo inicio)
	*   @author freina
	*   @date 11-Nov-2004 21:01 
	*   @location Cali-Colombia
	*/
function fncinicio($ircdata, $isbindpadre, $isbindhijo, $isbinicio) {

	settype($orcresult, "array");
    settype($rcresult, "array");
	settype($nuindice, "integer");
	settype($nucant, "integer");
	settype($nucont, "integer");
    settype($nucontreg, "integer");

	$nuindice = 1;

	if ($ircdata) {

		$nucant = sizeof($ircdata);

		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if ($ircdata[$nucont][$isbindhijo] == $isbinicio) {
				$rcresult[0] = $isbinicio;
				break;
			}
		}

		fncseleccion($isbindpadre, $isbindhijo, $isbinicio, $ircdata, $rcresult, $nuindice);
         
         if($rcresult){
             for ($nucont = 0; $nucont < $nucant; $nucont ++) {
                 if(!in_array($ircdata[$nucont][$isbindhijo],$rcresult)){
                     $orcresult[$nucontreg] = $ircdata[$nucont];
                     $nucontreg ++;
                 }
             }
         }else{
             $orcresult = $ircdata;
         }
	}
	return $orcresult;
}
/*
* Borra los valores duplicados que tenga una vector multidimencional.
*/
function BorrarValoresDuplicadosFather($ircdata, $indice) {

	settype($orcresult, "array");
	settype($nucant, "integer");
	settype($nucont, "integer");
	settype($nucontreg, "integer");

	if ($ircdata) {
		$nucant = sizeof($ircdata);
		for ($nucont = 0; $nucont < $nucant; $nucont ++) {
			if (!ExiteRegistroFather($orcresult, $indice, $ircdata[$nucont][$indice])) {
				$orcresult[$nucontreg] = $ircdata[$nucont];
				$nucontreg ++;
			}
		}
	}

	return $orcresult;
}
/*
* Busca un registro en el vector,retorna 1 si lo encuentra
* retorna 0 si no lo encuentra.
*/
function ExiteRegistroFather($ircdata, $indice, $dato_buscar) {

	settype($nucant, "integer");
	settype($nucont, "integer");

	$nucant = sizeof($ircdata);
	for ($nucont = 0; $nucont < $nucant; $nucont ++) {
		if ($ircdata[$nucont][$indice] === $dato_buscar) {
			return true;
		}
	}
	return false;
}
?>