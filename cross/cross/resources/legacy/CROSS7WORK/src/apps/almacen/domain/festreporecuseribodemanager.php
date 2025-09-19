<?php 

class FeStReporecuseribodeManager {
	function FeStReporecuseribodeManager() {
		return true;
	}
	function UnsetRequest() {
		unset ($_REQUEST["recuseribode__numrows"]);
		unset ($_REQUEST["recuseribode__resources"]);
		unset ($_REQUEST["recuseribode__resources_desc"]);
		unset ($_REQUEST["recuseribode__serial"]);
	}
}
?>