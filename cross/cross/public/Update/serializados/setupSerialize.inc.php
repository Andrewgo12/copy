<?php

/* Adicionar o modificar parametros si no existen parametros a adicionar o modificar se deja en null Ej: $rcAddParams = null;
 * contexto => string: El contexto en donde aplica si se debe aplicar en todos los contextos dejar con valor null, 
 * 						si aplica para diferentes contextos pero no a todos se replica el registro para cada contexto.
 * modulo => string: Nombre del modulo en el cual esta el parametro 
 * nombre => string: Nombre del par�metro
 * valor => mixed: Valor inicial para el par�metro, si el tipo de dato es un vector se debe colocar vector vacio Ej: array() y null para los otros tipos
 * 
 * */
$rcAddParams = null;


/* Eliminar parametros, si no existen parametros a eliminar se deja en null. Ej: $rcDelParams = null;
 * contexto => string: El contexto en donde aplica si se debe aplicar en todos los contextos dejar con valor null, 
 * 						si aplica para diferentes contextos pero no a todos se replica el registro para cada contexto.
 * modulo => string: Nombre del modulo en el cual esta el parametro
 * nombre => string: Nombre del par�metro
 *  
 * */
$rcDelParams = null;


/* Adicionar o modificar constantes si no existen constantes a adicionar o modificar se deja en null Ej: $rcAddConstant = null;
 * contexto => string: El contexto en donde aplica si se debe aplicar en todos los contextos dejar con valor null, 
 * 						si aplica para diferentes contextos pero no a todos se replica el registro para cada contexto.
 * modulo => string: Determina el modulo en el cual se debe modificar esta constante
 * nombre => string: Nombre de la constante
 * pathindex => string: Indica el path en donde debe almacenarse el valor dentro del array de la cte, aplica para cuando la cte es un array
 * 						de lo contrario debe tener valor null. 
 * 			
 * 			//Se desea adicionar un valor a la cte PARAMS_OBJECTS la cual es un array, la conf seria asi: 
 * 			array(
 * 				'contexto' => '0',
 * 				'nombre' => 'PARAMS_OBJECTS',
 * 				'pathindex' => 'RUL_INS_RUE', //Este es el indice que se quiere adicionar, colocar la cantidad de indices que indique la profundidad
 * 				'valor' => 'Pepito S.A.', //Este valor sera adicionado al indice
 * 			),
 * 
 * 			array(
 * 				'contexto' => '0',
 * 				'nombre' => 'PARAMS_OBJECTS',
 * 				'pathindex' => 'RUL_INS_RUE/object', //Colocara el valor en el indice 'object'
 * 				'valor' => 'Pepito S.A.', //Este valor sera adicionado al indice
 * 			),
 * 			
 * valor => mixed: Valor inicial para la constante, si el tipo de dato es un vector se debe colocar vector vacio Ej: array() y null para los otros tipos
 * 
 * */
$rcAddConstants = array (
	array(
		'contexto' => '0',
		'modulo' => 'general',
		'nombre' => 'ARCH_P',
		'pathindex' => '',
		'valor' => 'P',
	),
	array(
		'contexto' => '2',
		'modulo' => 'general',
		'nombre' => 'ARCH_P',
		'pathindex' => '',
		'valor' => 'P',
	),
	array(
		'contexto' => '0',
		'modulo' => 'general',
		'nombre' => 'ARCH_F',
		'pathindex' => '',
		'valor' => 'F',
	),
	array(
		'contexto' => '2',
		'modulo' => 'general',
		'nombre' => 'ARCH_F',
		'pathindex' => '',
		'valor' => 'F',
	),
	array(
		'contexto' => '0',
		'modulo' => 'general',
		'nombre' => 'ANEXOS',
		'pathindex' => '',
		'valor' => 'dirname(dirname(__FILE__))."/data/anexos"',
	),
	array(
		'contexto' => '2',
		'modulo' => 'general',
		'nombre' => 'ANEXOS',
		'pathindex' => '',
		'valor' => 'dirname(dirname(__FILE__))."/data/anexos"',
	)
);
?>
