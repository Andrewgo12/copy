<?php
/**
	* @copyright Copyright 2004 &copy; FullEngine
	*
	*  Smarty plugin 
	* Pinta un radio button 
	* @author creyes <cesar.reyes@parquesoft.com>
	* @date 14-oct-2004 14:28:43
	* @location Cali-Colombia
	*Example:
	*  {radio id="id" name="name" value="value" checked="true"}
*/
function smarty_function_radio($params,& $smarty) {
	extract($params);
	
	$html_result = "<input type='radio' id='$id' name='$name' value='$value' ";
	if(isset($checked)){
		$html_result .= "checked>";	
	}else{
		$html_result .= ">";	
	}
	echo $html_result;
}

?>