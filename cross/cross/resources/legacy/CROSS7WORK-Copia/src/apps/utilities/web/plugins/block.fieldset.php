<?php 
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     fieldset
 * Version:  1.0
 * Date:     Oct 15, 2003
 * Author:	 Hemerson Varela <hvarela@parquesoft.com>
 * Purpose:  fieldset for HTML
 * Input:
 *           legend = label of fieldset
 *
 *
 * Examples: {fieldset legend = "Note"}
 *            {$message}
 *           {/fieldset}
 * Output:  <fieldset >
 *	           <legend>Note</legend>
 *	           Hello Word!!
 *	        </fieldset>
 * -------------------------------------------------------------
 */

function smarty_block_fieldset($params, $content, & $smarty) {
	extract($params);

	if (isset ($content)) {
		if (!isset ($legend)) {
			//Obtiene los datos del usuario
			$rcuser = Application :: getUserParam();
			if (!is_array($rcuser)) {
				//Si no existe usuario en sesion obtiene el lenguaje por defecto 
				$rcuser["lang"] = Application :: getSingleLang();
			}
			//Incluye las etiquetas de los comandos genericos
			include ($rcuser["lang"]."/".$rcuser["lang"].".generic.php");
			$legend = $rclabels_generic["result"];
		}
		$result = '';
		$result .= "<fieldset>";
		if ($legend != '') {
			$result .= "<legend>$legend</legend>";
		}

		$extraData = WebSession :: getProperty("params");
		if(is_array($extraData)){
			foreach($extraData as $k => $val){
				$content = str_replace("<$k>",$val,$content);
			}
		}
		//$result .= "&nbsp;&nbsp;";
		$result = $content;
		//$result .= "</fieldset>";

		echo $result;
	}
}
?>