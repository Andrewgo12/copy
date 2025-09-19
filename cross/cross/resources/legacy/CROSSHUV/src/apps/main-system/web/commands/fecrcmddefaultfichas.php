<?php
require_once "Web/WebRequest.class.php";
class FeCrCmdDefaultFichas {
    function execute() {
        // Validar que el usuario esté autenticado
        $rcUser = WebSession::getProperty("_authsession");
        if(!is_array($rcUser)) {
            die('<p><b>ERROR: Acceso no autorizado</b></p>');
        }
        
        // Validar que se proporcione el número de orden
        $ordenumerosFO = $_REQUEST['ordenumerosFO'] ?? '';
        if(!$ordenumerosFO) {
            die('<p><b>ERROR: Número de caso requerido</b></p>');
        }
        
        // Validar que el caso existe
        $gateway = Application::getDataGateway("orden");
        $rcCaso = $gateway->getByIdOrden($ordenumerosFO);
        
        if(!is_array($rcCaso)) {
            die('<p><b>ERROR: Caso no encontrado: ' . htmlspecialchars($ordenumerosFO) . '</b></p>');
        }
        
        return "success";
    }
}
?>