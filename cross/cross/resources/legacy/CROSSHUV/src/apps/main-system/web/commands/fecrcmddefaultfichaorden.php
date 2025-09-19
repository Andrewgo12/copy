<?php 
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultFichaOrden {

	function execute() {
		$numeroOrden = $_REQUEST['orden'] ?? '';
		if ($numeroOrden) {
			$this->mostrarFichaOrden($numeroOrden);
		}
		return "success";
	}
	
	private function mostrarFichaOrden($numero) {
		echo "<h2>Ficha de Orden: $numero</h2>";
	}
}
?>