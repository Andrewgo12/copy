<?php
/**
 * SCRIPT DE VERIFICACIÓN DE DEPENDENCIAS
 * Sistema PQRSF - Hospital Universitario del Valle
 */

echo "<html><head><title>Verificación de Dependencias PQRSF</title>";
echo "<style>body{font-family:Arial;margin:20px;} .ok{color:green;} .error{color:red;} .warning{color:orange;} .info{background:#e8f4fd;padding:10px;border-radius:5px;margin:10px 0;}</style></head><body>";

echo "<h1>🔍 VERIFICACIÓN DE DEPENDENCIAS - SISTEMA PQRSF</h1>";
echo "<div class='info'><strong>Hospital Universitario del Valle - Evaristo García</strong><br>Verificando archivos del sistema de consulta web de PQRSF</div>";

// Archivos críticos del sistema
$archivos_criticos = [
    // Comandos principales
    "web/commands/FeCrCmdDefaultFichas.class.php" => "Comando principal de fichas",
    "web/commands/FeCrCmdDefaultWebUser.class.php" => "Autenticación web",
    "web/commands/FeCrCmdDefaultFichaOrdWeb.class.php" => "Comando ficha web",
    "web/commands/FeCrCmdAddOrdenWeb.class.php" => "Procesamiento formulario PQRSF",
    "web/commands/FeCrCmdDefaultConsultSolucion.class.php" => "Consulta de casos",
    
    // Comandos nuevos
    "web/commands/FeCrCmdConsultarCasoWeb.class.php" => "Consulta web de casos (NUEVO)",
    "web/commands/FeCrCmdTestPQRSF.class.php" => "Comando de pruebas (NUEVO)",
    
    // Plugins críticos
    "web/plugins/function.viewfichaord.php" => "Plugin ficha completa (admin)",
    "web/plugins/function.viewfichaordweb.php" => "Plugin ficha simplificada (web) (NUEVO)",
    "web/plugins/function.consultsolucion.php" => "Plugin consulta de soluciones",
    "web/plugins/function.frameficha.php" => "Plugin estructura frames",
    
    // Templates
    "web/templates/Form_WebUser.tpl" => "Formulario web PQRSF",
    "web/templates/Form_ConsultSolucion.tpl" => "Template consulta",
    "web/templates/Form_Fichas.tpl" => "Template fichas",
    "web/templates/Form_BodyFichaOrd.tpl" => "Template cuerpo ficha admin",
    "web/templates/Form_BodyFichaOrdWeb.tpl" => "Template cuerpo ficha web",
    "web/templates/Form_ConsultarCasoWeb.tpl" => "Template consulta web (NUEVO)",
    "web/templates/Form_TestPQRSF.tpl" => "Template pruebas (NUEVO)",
    
    // Gateways
    "data/Pgsql/FeCrPgsqlSqlExtended.class.php" => "Gateway consultas extendidas",
    "data/Pgsql/FeCrPgsqlOrden.class.php" => "Gateway órdenes",
    "data/Pgsql/FeCrPgsqlOrdenempresaExtended.class.php" => "Gateway usuarios",
    
    // Idiomas
    "config/language/es/es.fichaord.php" => "Etiquetas fichas español",
    "config/language/es/es.webuser.php" => "Etiquetas usuario web español",
    "config/language/es/es.consultsolucion.php" => "Etiquetas consulta español"
];

// Archivos de prueba
$archivos_prueba = [
    "test_pqrsf.html" => "Página acceso directo pruebas (NUEVO)",
    "verificar_dependencias.php" => "Script verificación (NUEVO)"
];

echo "<h2>📁 VERIFICACIÓN DE ARCHIVOS CRÍTICOS</h2>";
$total_archivos = count($archivos_criticos);
$archivos_ok = 0;
$archivos_error = 0;

foreach ($archivos_criticos as $archivo => $descripcion) {
    $ruta_completa = __DIR__ . "/" . $archivo;
    if (file_exists($ruta_completa)) {
        $size = filesize($ruta_completa);
        echo "<div class='ok'>✅ $archivo - $descripcion ($size bytes)</div>";
        $archivos_ok++;
    } else {
        echo "<div class='error'>❌ $archivo - $descripcion (NO ENCONTRADO)</div>";
        $archivos_error++;
    }
}

echo "<h2>🧪 VERIFICACIÓN DE ARCHIVOS DE PRUEBA</h2>";
foreach ($archivos_prueba as $archivo => $descripcion) {
    $ruta_completa = __DIR__ . "/" . $archivo;
    if (file_exists($ruta_completa)) {
        $size = filesize($ruta_completa);
        echo "<div class='ok'>✅ $archivo - $descripcion ($size bytes)</div>";
    } else {
        echo "<div class='warning'>⚠️ $archivo - $descripcion (NO ENCONTRADO)</div>";
    }
}

echo "<h2>📊 RESUMEN DE VERIFICACIÓN</h2>";
echo "<div class='info'>";
echo "<strong>Total archivos críticos:</strong> $total_archivos<br>";
echo "<strong>Archivos encontrados:</strong> <span class='ok'>$archivos_ok</span><br>";
echo "<strong>Archivos faltantes:</strong> <span class='error'>$archivos_error</span><br>";
$porcentaje = round(($archivos_ok / $total_archivos) * 100, 2);
echo "<strong>Porcentaje completitud:</strong> $porcentaje%<br>";
echo "</div>";

if ($archivos_error == 0) {
    echo "<div class='ok'><h3>🎉 ¡SISTEMA COMPLETO!</h3>Todos los archivos críticos están presentes. El sistema está listo para pruebas.</div>";
} else {
    echo "<div class='error'><h3>⚠️ SISTEMA INCOMPLETO</h3>Faltan $archivos_error archivos críticos. Revisa la instalación.</div>";
}

echo "<h2>🔗 ENLACES DE PRUEBA</h2>";
echo "<div class='info'>";
echo "<strong>🧪 Página de Pruebas:</strong> <a href='test_pqrsf.html' target='_blank'>Abrir Panel de Pruebas</a><br>";
echo "<strong>🚀 Pruebas Directas:</strong> <a href='index.php?action=FeCrCmdTestPQRSF' target='_blank'>Iniciar Pruebas</a><br>";
echo "<strong>👥 Vista Web:</strong> <a href='index.php?action=FeCrCmdDefaultFichas&mainFrame=FeCrCmdDefaultBodyFichaOrdWeb&ordenumerosFO=1061242025' target='_blank'>Ficha Web</a><br>";
echo "<strong>👨💼 Vista Admin:</strong> <a href='index.php?action=FeCrCmdDefaultFichas&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO=1061242025' target='_blank'>Ficha Admin</a><br>";
echo "</div>";

echo "<h2>📋 INSTRUCCIONES DE PRUEBA</h2>";
echo "<ol>";
echo "<li><strong>Verificar autenticación:</strong> Probar login web con usuario 'webuser' y contexto '2'</li>";
echo "<li><strong>Comparar vistas:</strong> Abrir ficha web vs ficha admin del caso 1061242025</li>";
echo "<li><strong>Verificar restricciones:</strong> Confirmar que vista web NO muestra información interna</li>";
echo "<li><strong>Probar consulta:</strong> Buscar casos por número específico</li>";
echo "<li><strong>Validar funcionalidad:</strong> Descargar archivos adjuntos desde vista web</li>";
echo "</ol>";

echo "<div style='text-align:center;margin-top:30px;padding:20px;background:#f8f9fa;border-radius:10px;'>";
echo "<strong>Hospital Universitario del Valle - Evaristo García</strong><br>";
echo "Sistema CROSS300 - Verificación de Dependencias PQRSF<br>";
echo "<small>Generado: " . date('Y-m-d H:i:s') . "</small>";
echo "</div>";

echo "</body></html>";
?>