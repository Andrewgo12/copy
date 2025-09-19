<?php
require_once "Web/WebRequest.class.php";

class FeCrCmdCasoCreado {
    
    function execute() {
        extract($_REQUEST);
        
        // Validar que se haya pasado el número de caso
        if (!$numeroCaso) {
            die('<p><b>ERROR: Número de caso no encontrado</b></p>');
        }
        
        // Obtener información del caso
        $objService = Application::loadServices('DateController');
        $fechaActual = $objService->fncformatofecha($objService->fncintdatehour());
        
        // Calcular fecha de vencimiento (ejemplo: 7 días hábiles)
        $fechaVencimiento = $objService->fncformatofecha($objService->fncintdatehour() + (7 * 24 * 60 * 60));
        
        // Pasar datos a la plantilla
        WebRequest::setProperty('numeroCaso', $numeroCaso);
        WebRequest::setProperty('fechaRegistro', $fechaActual);
        WebRequest::setProperty('fechaVencimiento', $fechaVencimiento);
        
        return "success";
    }
}
?>