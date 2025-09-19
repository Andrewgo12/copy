<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultFichaOrd {
    function execute() {
        $numeroOrden = $_REQUEST['orden'] ?? '';
        if ($numeroOrden) {
            $this->mostrarFichaOrd($numeroOrden);
        }
        return "success";  
    }
    
    private function mostrarFichaOrd($numero) {
        echo "<h2>Orden: $numero</h2>";
    }
}
?>