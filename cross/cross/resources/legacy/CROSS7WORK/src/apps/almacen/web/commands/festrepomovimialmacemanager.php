<?php 

class FeStRepomovimialmaceManager {
	function FeStRepomovimialmaceManager() {
		return true;
	}
	function UnsetRequest() {
		unset ($_REQUEST["movimialmace__bodecodigos"]);
		unset ($_REQUEST["movimialmace__numrows"]);
		unset ($_REQUEST["movimialmace__resources"]);
		unset ($_REQUEST["movimialmace__resources_desc"]);
		unset ($_REQUEST["movimialmace__moalnumedocs"]);
		unset ($_REQUEST["movimialmace__moalfechmovd1"]);
		unset ($_REQUEST["movimialmace__moalfechmovd2"]);
	}
}
?>