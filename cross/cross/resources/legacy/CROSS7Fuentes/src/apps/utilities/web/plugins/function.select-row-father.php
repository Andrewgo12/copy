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
	settype($rcTmp, "array");
	settype($sbId, "string");
	settype($sbHtml, "string");
	settype($sbFuncion, "string");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($sbCommand, "string");

	if ($command) {
		$sbCommand .= " onchange=\"action.value = '".$command."';submit();\" ";
	}

	if (!isset ($sqlid)) {
		$gateway = Application :: getDataGateway("$table_name");
		$sbFuncion = "getAll".$table_name;
		$rcTmp = $gateway-> $sbFuncion ();
	} else {
		$gateway = Application :: getDataGateway("SqlExtended");
		$rcTmp = $gateway->getDataCombo($sqlid);
	}

    //Verifica si existe el padre
	$gateway = Application :: getDataGateway("$table_name");
	$sbFuncion = "getById".$table_name;
	$rcId = $gateway-> $sbFuncion ($_REQUEST[$table_name."__".$value]);
    
	$rcTmp = BorrarValoresDuplicadosFather($rcTmp, $value);

	if ($_REQUEST[$table_name."__".$value] && is_array($rcId)) {
		//se obtiene los ascendentes del nodo
		$rcTmp = fncinicio($rcTmp, $father, $value, $_REQUEST[$table_name."__".$value]);
	}

	if (!isset ($label)) {
		$label = $value;
	}

	if (!isset ($size)) {
		$size = 1;
	}

	if (isset ($id)) {
		$sbId = " id=\"$id\"";
	}

	$sbHtml = '';
	$sbHtml .= "<select name='$name' size='$size' $sbId $sbCommand>";

	if ($is_null == "true") {
		$sbHtml .= "<option value=''>---</optional>";
	}

	if ($rcTmp) {

		$nuCant = sizeof($rcTmp);
		for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
			if ($_REQUEST[$table_name."__".$value] != $rcTmp[$nuCont][$value]) {
				$sbHtml .= "<option value='";
				$sbHtml .= $rcTmp[$nuCont][$value];
				if ($_REQUEST[$name] == $rcTmp[$nuCont][$value]) {
					$sbHtml .= "' selected>";
				} else {
					$sbHtml .= "'>";
				}
				$sbHtml .= $rcTmp[$nuCont][$label];
				$sbHtml .= "</option>";
			}
		}
	}
	$sbHtml .= "</select>";

	print $sbHtml;

}
/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Funcion de busqueda recursivo
	*   @param array $ircData (matriz con la data de la tabla)
	*   @param string $isbIndPadre   (Nombre del campo padre)
	*   @param string $isbIndHijo (Nombre del campo hijo)
	*   @param string $isbInicio (Nodo inicio)
	*   @param $inuIndice integer   Indice consecutivo
	*   @param $ircPadre array  Data acumulada
	*   @author freina
	*   @date 11-Nov-2004 21:20
	*   @location Cali-Colombia 
	*/
function fncseleccion($isbIndPadre, $isbIndHijo, $isbInicio, & $ircData, & $ircPadre, & $inuIndice) {
	settype($orcresult, "array");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	$nuCant = 0;
	$nuCant = sizeof($ircData);
	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($ircData[$nuCont][$isbIndPadre] == $isbInicio) {
			fncseleccion($isbIndPadre, $isbIndHijo, $ircData[$nuCont][$isbIndHijo], $ircData, $ircPadre, $inuIndice);
			$ircPadre[$inuIndice] = $ircData[$nuCont][$isbIndHijo];
			$inuIndice ++;
		}
	}
	return;
}
/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Obtiene los ascendientes de un nodo
	*   @param array $ircData (matriz con la data de la tabla)
	*   @param string $isbIndPadre   (Nombre del campo padre)
	*   @param string $isbIndHijo (Nombre del campo hijo)
	*   @param string $isbInicio (Nodo inicio)
	*   @author freina
	*   @date 11-Nov-2004 21:01 
	*   @location Cali-Colombia
	*/
function fncinicio($ircData, $isbIndPadre, $isbIndHijo, $isbInicio) {

	settype($orcResult, "array");
	settype($rcResult, "array");
	settype($rcTmp, "array");
	settype($nuIndice, "integer");
	settype($nuCont, "integer");

	if ($ircData) {
		$rcResult[$nuIndice] = $isbInicio;
		$nuIndice ++;
		fncseleccion($isbIndPadre, $isbIndHijo, $isbInicio, $ircData, $rcResult, $nuIndice);
		if($rcResult){
			//se descartan los descendientes y el mismo como posible padre
			foreach($ircData as $rcTmp){
				if(!in_array($rcTmp[$isbIndHijo],$rcResult)){
					$orcResult[$nuCont] = $rcTmp;
					$nuCont ++;
				}
			}
		}
	}
	return $orcResult;
}
/*
* Borra los valores duplicados que tenga una vector multidimencional.
*/
function BorrarValoresDuplicadosFather($ircData, $indice) {

	settype($orcResult, "array");
	settype($nuCant, "integer");
	settype($nuCont, "integer");
	settype($nuContreg, "integer");

	if ($ircData) {
		$nuCant = sizeof($ircData);
		for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
			if (!ExiteRegistroFather($orcResult, $indice, $ircData[$nuCont][$indice])) {
				$orcResult[$nuContreg] = $ircData[$nuCont];
				$nuContreg ++;
			}
		}
	}

	return $orcResult;
}
/*
* Busca un registro en el vector,retorna 1 si lo encuentra
* retorna 0 si no lo encuentra.
*/
function ExiteRegistroFather($ircData, $indice, $dato_buscar) {

	settype($nuCant, "integer");
	settype($nuCont, "integer");

	$nuCant = sizeof($ircData);
	for ($nuCont = 0; $nuCont < $nuCant; $nuCont ++) {
		if ($ircData[$nuCont][$indice] === $dato_buscar) {
			return true;
		}
	}
	return false;
}
?>