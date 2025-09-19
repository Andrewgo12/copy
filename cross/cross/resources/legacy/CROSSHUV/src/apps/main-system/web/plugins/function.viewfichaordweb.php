<?php
function smarty_function_viewfichaordweb($params, &$smarty) {
    extract($_REQUEST);
    
    if($ordenumerosFO) $orden__ordenumeros = $ordenumerosFO;
    if (!$orden__ordenumeros) return false;

    $rcuser = Application::getUserParam();
    include($rcuser["lang"]."/".$rcuser["lang"].".fichaord.php");

    // Datos básicos del caso
    $gateway = Application::getDataGateway("orden");
    $rcDataOrden = $gateway->getByIdOrden($orden__ordenumeros);
    if (!is_array($rcDataOrden)) return "<p><b>Caso no encontrado</b></p>";

    $gateway = Application::getDataGateway("OrdenempresaExtended");
    $rcData = $gateway->getByIdOrdenempresajoin($orden__ordenumeros);
    $rcTmpData = $gateway->getByOrdenOrdenempresa($orden__ordenumeros);
    $servceDate = Application::loadServices("DateController");

    // HTML simplificado
    $html = "<div style='font-family:Arial;max-width:800px;margin:0 auto;'>";
    
    // Encabezado
    $html .= "<div style='text-align:center;border-bottom:2px solid #003366;padding:10px;margin-bottom:20px;'>";
    $html .= "<h2 style='color:#003366;margin:0;'>Hospital Universitario del Valle - Evaristo García</h2>";
    $html .= "<p style='margin:5px 0;'>NIT 890303461-2<br>Calle 5 # 36-08 Cali - Colombia. Tels: 6206000</p></div>";

    $html .= "<h3 style='color:#003366;text-align:center;'>Ficha de Caso</h3>";

    // Información básica
    $html .= "<table style='width:100%;border-collapse:collapse;margin-bottom:20px;'>";
    $html .= "<tr><td style='padding:8px;border:1px solid #ddd;background:#f5f5f5;width:30%;'><b>Número de Caso</b></td>";
    $html .= "<td style='padding:8px;border:1px solid #ddd;'>".$rcDataOrden[0]['ordenumeros']."</td></tr>";
    
    $html .= "<tr><td style='padding:8px;border:1px solid #ddd;background:#f5f5f5;'><b>Fecha de registro</b></td>";
    $html .= "<td style='padding:8px;border:1px solid #ddd;'>".$servceDate->fncformatofechahora($rcDataOrden[0]['ordefecregd'])."</td></tr>";
    
    if($rcTmpData[0]['tiornombres']) {
        $html .= "<tr><td style='padding:8px;border:1px solid #ddd;background:#f5f5f5;'><b>Tipo de Caso</b></td>";
        $html .= "<td style='padding:8px;border:1px solid #ddd;'>".$rcTmpData[0]['tiornombres']."</td></tr>";
    }
    
    if($rcData['contindentis']) {
        $html .= "<tr><td style='padding:8px;border:1px solid #ddd;background:#f5f5f5;'><b>Solicitante</b></td>";
        $html .= "<td style='padding:8px;border:1px solid #ddd;'>".$rcData['contindentis']."</td></tr>";
    }

    // Estado del caso
    $gateway = Application::getDataGateway("SqlExtended");
    $rcActas = $gateway->getActas($orden__ordenumeros);
    $estadoFinal = "EN PROCESO";
    
    if(is_array($rcActas)) {
        foreach($rcActas as $acta) {
            if($acta['actaestacts'] == 'F') {
                $estadoFinal = "FINALIZADO";
                break;
            }
        }
    }
    
    $html .= "<tr><td style='padding:8px;border:1px solid #ddd;background:#f5f5f5;'><b>Estado</b></td>";
    $html .= "<td style='padding:8px;border:1px solid #ddd;'><b style='color:".($estadoFinal == "FINALIZADO" ? "green" : "orange").";'>".$estadoFinal."</b></td></tr>";
    $html .= "</table>";

    // Observaciones del usuario
    if($rcData['ordeobservs']) {
        $html .= "<div style='margin-bottom:20px;'><h4 style='color:#003366;'>Su consulta:</h4>";
        $html .= "<div style='padding:10px;border:1px solid #ddd;background:#f9f9f9;'>".nl2br(htmlspecialchars($rcData['ordeobservs']))."</div></div>";
    }

    // Respuesta oficial (solo si está finalizado)
    if($estadoFinal == "FINALIZADO" && is_array($rcActas)) {
        $html .= "<div style='margin-bottom:20px;'><h4 style='color:#003366;'>Respuesta del Hospital:</h4>";
        
        foreach($rcActas as $acta) {
            if($acta['actaestacts'] == 'F') {
                $rcAtenc = $gateway->getListActaempresa($acta['actacodigos']);
                if(is_array($rcAtenc)) {
                    foreach($rcAtenc as $atencion) {
                        if($atencion['acemobservas']) {
                            $html .= "<div style='padding:10px;border:1px solid #ddd;background:#e8f5e8;'>".nl2br(htmlspecialchars($atencion['acemobservas']))."</div>";
                            
                            // Archivos de respuesta
                            $objService = Application::loadServices('General');
                            $rcTiposFile = $objService->getConstant('TIPO_FILE');
                            $objGateway = $objService->loadGateway('Archivos');
                            $rcFiles = $objGateway->getDescArchivo($rcTiposFile["atencion"], $atencion['acemnumeros']);
                            
                            if($rcFiles) {
                                $html .= "<div style='margin-top:10px;'><b>Documentos adjuntos:</b><br>";
                                foreach($rcFiles as $file) {
                                    $html .= "<a href='#' onclick=\"window.open('index.php?action=FeCrCmdDefaultDownloadFile&archcodigon=".$file['archcodigon']."','_blank');\" style='color:#003366;'>".$file['archnombres']."</a><br>";
                                }
                                $html .= "</div>";
                            }
                            break;
                        }
                    }
                }
                break;
            }
        }
        $html .= "</div>";
    }

    $html .= "</div>";
    return $html;
}
?>