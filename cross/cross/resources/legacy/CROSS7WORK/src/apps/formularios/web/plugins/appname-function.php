<?php
function smarty_function_appname($params,&$smarty){
	return Application :: getName().Application :: getVersion();
}

?>