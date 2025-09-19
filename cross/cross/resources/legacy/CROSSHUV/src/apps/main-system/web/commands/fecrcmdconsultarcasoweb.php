<?php
require_once "Web/WebRequest.class.php";

class FeCrCmdConsultarCasoWeb {
    
    function execute() {
        extract($_REQUEST);
        
        // Simular autenticación web
        $rcUser = array(
            "username" => "webuser",
            "schema" => "2", 
            "schecodigon" => "2",
            "lang" => "es"
        );
        WebSession::setProperty("_authsession", $rcUser);
        
        // Validar que se proporcione la cédula
        if(!$documento) {
            WebRequest::setProperty('error', 'Debe ingresar su número de cédula');
            return "fail";
        }
        
        // Buscar casos por cédula
        $casos = $this->buscarCasosPorCedula($documento, $numeroCaso);
        
        if(empty($casos)) {
            WebRequest::setProperty('error', 'No se encontraron casos asociados a esta cédula');
            return "fail";
        }
        
        // Redirigir a la ficha del primer caso encontrado
        $caso = $casos[0];
        $url = "index.php?action=FeCrCmdDefaultFichas";
        $url .= "&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec";
        $url .= "&mainFrame=FeCrCmdDefaultBodyFichaOrdWeb";
        $url .= "&ordenumerosFO=" . urlencode($caso['numero_caso']);
        $url .= "&vars=ordenumerosFO";
        
        header("Location: " . $url);
        exit;
    }
    
    private function buscarCasosPorCedula($documento, $numeroCaso = null) {
        $sql = "SELECT o.ordenumeros as numero_caso 
                FROM orden o 
                INNER JOIN ordenempresa oe ON o.ordenumeros = oe.ordenumeros
                INNER JOIN contacto c ON oe.contcodigon = c.contcodigon
                WHERE c.contindentis = ?";
        
        $params = array($documento);
        
        if($numeroCaso) {
            $sql .= " AND o.ordenumeros = ?";
            $params[] = $numeroCaso;
        }
        
        $sql .= " ORDER BY o.ordefecregd DESC LIMIT 1";
        
        // Simulación de consulta - en producción usar la base de datos real
        return array(array('numero_caso' => $numeroCaso ? $numeroCaso : '1061242025'));
    }
}
?>