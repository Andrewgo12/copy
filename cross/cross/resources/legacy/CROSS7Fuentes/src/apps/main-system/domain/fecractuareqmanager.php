<?php  
class FeCrActuareqManager {
	function FeCrActuareqManager() {
		return true;
	}
	function UnsetRequest() {
		foreach($_REQUEST as $key => $value){
			if((strpos($key,'__')!==false)){
				unset($_REQUEST["$key"]);
			}
		}
        unset($_REQUEST["orgacodigos_desc"]);
		return true;
	}
}
?>	
 	