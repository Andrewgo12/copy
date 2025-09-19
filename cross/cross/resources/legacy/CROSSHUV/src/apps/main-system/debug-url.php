<?php
/**
 * DEBUG DE URL ESPECÍFICA
 * Script para debuggear la URL problemática paso a paso
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🐛 DEBUG URL FICHA DE CASO</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .step { background: #e3f2fd; padding: 15px; margin: 10px 0; border-left: 4px solid #2196f3; }
    .success { color: green; font-weight: bold; }
    .error { color: red; font-weight: bold; }
    .warning { color: orange; font-weight: bold; }
    .info { color: blue; }
    pre { background: #f8f9fa; padding: 10px; border: 1px solid #ddd; overflow-x: auto; }
    .code { background: #f5f5f5; padding: 5px; font-family: monospace; }
</style>";

// URL objetivo
$url_objetivo = "index.php?action=FeCrCmdDefaultFichas&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO=1061242025&vars=ordenumerosFO";

echo "<div class='step'>";
echo "<h2>🎯 URL OBJETIVO</h2>";
echo "<span class='code'>$url_objetivo</span><br><br>";
echo "<strong>Parámetros esperados:</strong><br>";
echo "• action = FeCrCmdDefaultFichas<br>";
echo "• topFrame = FeCrCmdDefaultHeadRepoTiemposEjec<br>";
echo "• mainFrame = FeCrCmdDefaultBodyFichaOrd<br>";
echo "• ordenumerosFO = 1061242025<br>";
echo "• vars = ordenumerosFO<br>";
echo "</div>";

// ============================================================================
// PASO 1: VERIFICAR PARÁMETROS RECIBIDOS
// ============================================================================
echo "<div class='step'>";
echo "<h2>📥 PASO 1: PARÁMETROS RECIBIDOS</h2>";

echo "<h4>$_GET:</h4>";
if (!empty($_GET)) {
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
} else {
    echo "<span class='warning'>⚠️ No hay parámetros GET</span><br>";
}

echo "<h4>$_REQUEST:</h4>";
if (!empty($_REQUEST)) {
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
} else {
    echo "<span class='warning'>⚠️ No hay parámetros REQUEST</span><br>";
}

// Verificar parámetros específicos
$parametros_requeridos = ['action', 'topFrame', 'mainFrame', 'ordenumerosFO', 'vars'];
foreach ($parametros_requeridos as $param) {
    if (isset($_REQUEST[$param])) {
        echo "<span class='success'>✅ $param = " . $_REQUEST[$param] . "</span><br>";
    } else {
        echo "<span class='error'>❌ $param NO recibido</span><br>";
    }
}
echo "</div>";

// ============================================================================
// PASO 2: SIMULAR CARGA DE CONFIGURACIÓN
// ============================================================================
echo "<div class='step'>";
echo "<h2>⚙️ PASO 2: CARGA DE CONFIGURACIÓN</h2>";

try {
    if (file_exists('config/config.inc.php')) {
        echo "<span class='info'>Cargando config.inc.php...</span><br>";
        
        ob_start();
        require_once 'config/config.inc.php';
        $output = ob_get_clean();
        
        echo "<span class='success'>✅ Configuración cargada</span><br>";
        
        if ($output) {
            echo "<span class='warning'>⚠️ Output generado:</span><br>";
            echo "<pre>$output</pre>";
        }
        
        // Verificar variables definidas
        if (isset($app)) {
            echo "<span class='success'>✅ Variable \$app definida</span><br>";
        } else {
            echo "<span class='error'>❌ Variable \$app NO definida</span><br>";
        }
        
    } else {
        echo "<span class='error'>❌ config/config.inc.php no encontrado</span><br>";
    }
} catch (Exception $e) {
    echo "<span class='error'>❌ Error: " . $e->getMessage() . "</span><br>";
}
echo "</div>";

// ============================================================================
// PASO 3: SIMULAR FRONTCONTROLLER
// ============================================================================
echo "<div class='step'>";
echo "<h2>🎯 PASO 3: SIMULACIÓN FRONTCONTROLLER</h2>";

// Simular lógica del FrontController
$action_name = isset($_REQUEST["action"]) ? $_REQUEST["action"] : 'FeCrCmdDefaultWebUser';
echo "<span class='info'>Action detectado: $action_name</span><br>";

// Verificar si el comando existe
$comando_file = "web/commands/$action_name.class.php";
if (file_exists($comando_file)) {
    echo "<span class='success'>✅ Archivo de comando encontrado: $comando_file</span><br>";
    
    try {
        require_once $comando_file;
        if (class_exists($action_name)) {
            echo "<span class='success'>✅ Clase $action_name cargada</span><br>";
            
            // Intentar instanciar
            $comando = new $action_name();
            echo "<span class='success'>✅ Comando instanciado</span><br>";
            
            // Intentar ejecutar
            if (method_exists($comando, 'execute')) {
                $resultado = $comando->execute();
                echo "<span class='success'>✅ Comando ejecutado, resultado: $resultado</span><br>";
            } else {
                echo "<span class='error'>❌ Método execute() no existe</span><br>";
            }
            
        } else {
            echo "<span class='error'>❌ Clase $action_name no encontrada en el archivo</span><br>";
        }
    } catch (Exception $e) {
        echo "<span class='error'>❌ Error cargando comando: " . $e->getMessage() . "</span><br>";
    }
} else {
    echo "<span class='error'>❌ Archivo de comando NO encontrado: $comando_file</span><br>";
}
echo "</div>";

// ============================================================================
// PASO 4: VERIFICAR TEMPLATE
// ============================================================================
echo "<div class='step'>";
echo "<h2>🎨 PASO 4: VERIFICACIÓN DE TEMPLATE</h2>";

$template_name = 'Form_Fichas.tpl';
$template_path = "web/templates/$template_name";

if (file_exists($template_path)) {
    echo "<span class='success'>✅ Template encontrado: $template_path</span><br>";
    
    // Mostrar contenido del template
    $contenido = file_get_contents($template_path);
    echo "<h4>Contenido del template:</h4>";
    echo "<pre>" . htmlspecialchars($contenido) . "</pre>";
    
    // Verificar tags Smarty
    if (strpos($contenido, '{frameficha}') !== false) {
        echo "<span class='success'>✅ Tag {frameficha} encontrado</span><br>";
    } else {
        echo "<span class='error'>❌ Tag {frameficha} NO encontrado</span><br>";
    }
    
} else {
    echo "<span class='error'>❌ Template NO encontrado: $template_path</span><br>";
}
echo "</div>";

// ============================================================================
// PASO 5: VERIFICAR PLUGIN FRAMEFICHA
// ============================================================================
echo "<div class='step'>";
echo "<h2>🔌 PASO 5: VERIFICACIÓN PLUGIN FRAMEFICHA</h2>";

$plugin_path = 'web/plugins/function.frameficha.php';
if (file_exists($plugin_path)) {
    echo "<span class='success'>✅ Plugin encontrado: $plugin_path</span><br>";
    
    // Cargar plugin
    require_once $plugin_path;
    
    if (function_exists('smarty_function_frameficha')) {
        echo "<span class='success'>✅ Función smarty_function_frameficha disponible</span><br>";
        
        // Simular llamada al plugin
        $params = $_REQUEST;
        $smarty = null; // Simulado
        
        echo "<h4>Simulando llamada al plugin:</h4>";
        echo "<pre>";
        echo "Parámetros: ";
        print_r($params);
        echo "</pre>";
        
        // Mostrar lógica del plugin
        echo "<h4>Lógica del plugin (simulada):</h4>";
        if (isset($_REQUEST["vars"])) {
            $rcValores = explode(",", $_REQUEST["vars"]);
            echo "<span class='info'>Variables procesadas: " . implode(", ", $rcValores) . "</span><br>";
            
            $sbCadena = "";
            foreach ($rcValores as $key => $valor) {
                if (isset($_REQUEST[$valor])) {
                    $rcValores[$key] = $valor . "=" . $_REQUEST[$valor];
                }
            }
            $sbCadena = "&" . implode("&", $rcValores);
            echo "<span class='info'>Cadena generada: $sbCadena</span><br>";
        }
        
        if (isset($_REQUEST["topFrame"])) {
            $template1 = "index.php?action=" . $_REQUEST["topFrame"];
            echo "<span class='info'>URL Frame Superior: $template1</span><br>";
        }
        
        if (isset($_REQUEST["mainFrame"])) {
            $template3 = "index.php?action=" . $_REQUEST["mainFrame"] . (isset($sbCadena) ? $sbCadena : "");
            echo "<span class='info'>URL Frame Principal: $template3</span><br>";
        }
        
    } else {
        echo "<span class='error'>❌ Función smarty_function_frameficha NO disponible</span><br>";
    }
} else {
    echo "<span class='error'>❌ Plugin NO encontrado: $plugin_path</span><br>";
}
echo "</div>";

// ============================================================================
// PASO 6: VERIFICAR COMANDOS DE FRAMES
// ============================================================================
echo "<div class='step'>";
echo "<h2>🖼️ PASO 6: VERIFICACIÓN COMANDOS DE FRAMES</h2>";

$comandos_frame = [
    'FeCrCmdDefaultHeadRepoTiemposEjec' => 'Comando frame superior',
    'FeCrCmdDefaultBodyFichaOrd' => 'Comando frame principal'
];

foreach ($comandos_frame as $comando => $descripcion) {
    $archivo_comando = "web/commands/$comando.class.php";
    if (file_exists($archivo_comando)) {
        echo "<span class='success'>✅ $comando</span> - $descripcion<br>";
    } else {
        echo "<span class='error'>❌ $comando</span> - $descripcion <strong>NO ENCONTRADO</strong><br>";
    }
}
echo "</div>";

// ============================================================================
// PASO 7: VERIFICAR PLUGIN VIEWFICHAORD
// ============================================================================
echo "<div class='step'>";
echo "<h2>📋 PASO 7: VERIFICACIÓN PLUGIN VIEWFICHAORD</h2>";

$plugin_ficha = 'web/plugins/function.viewfichaord.php';
if (file_exists($plugin_ficha)) {
    echo "<span class='success'>✅ Plugin principal encontrado: $plugin_ficha</span><br>";
    echo "<span class='info'>Tamaño: " . filesize($plugin_ficha) . " bytes</span><br>";
    
    // Verificar función principal
    $contenido = file_get_contents($plugin_ficha);
    if (strpos($contenido, 'smarty_function_viewfichaord') !== false) {
        echo "<span class='success'>✅ Función smarty_function_viewfichaord encontrada</span><br>";
    } else {
        echo "<span class='error'>❌ Función smarty_function_viewfichaord NO encontrada</span><br>";
    }
    
    // Verificar parámetro ordenumerosFO
    if (strpos($contenido, 'ordenumerosFO') !== false) {
        echo "<span class='success'>✅ Parámetro ordenumerosFO manejado</span><br>";
    } else {
        echo "<span class='error'>❌ Parámetro ordenumerosFO NO manejado</span><br>";
    }
    
} else {
    echo "<span class='error'>❌ Plugin principal NO encontrado: $plugin_ficha</span><br>";
}
echo "</div>";

// ============================================================================
// PASO 8: GENERAR URLs DE PRUEBA
// ============================================================================
echo "<div class='step'>";
echo "<h2>🔗 PASO 8: URLs DE PRUEBA PROGRESIVAS</h2>";

$base_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';

echo "<h4>Probar estas URLs en orden:</h4>";
echo "<ol>";
echo "<li><a href='index.php' target='_blank'>$base_url" . "index.php</a> - Página básica</li>";
echo "<li><a href='test_sistema.php' target='_blank'>$base_url" . "test_sistema.php</a> - Test completo</li>";
echo "<li><a href='verificar_dependencias.php' target='_blank'>$base_url" . "verificar_dependencias.php</a> - Verificar dependencias</li>";
echo "<li><a href='index.php?action=FeCrCmdDefaultWebUser' target='_blank'>$base_url" . "index.php?action=FeCrCmdDefaultWebUser</a> - Login básico</li>";
echo "<li><a href='index.php?action=FeCrCmdDefaultFichas' target='_blank'>$base_url" . "index.php?action=FeCrCmdDefaultFichas</a> - Comando fichas sin parámetros</li>";
echo "<li><a href='$url_objetivo' target='_blank'>$base_url$url_objetivo</a> - URL completa objetivo</li>";
echo "</ol>";
echo "</div>";

// ============================================================================
// RESUMEN
// ============================================================================
echo "<div class='step'>";
echo "<h2>📋 RESUMEN DEL DEBUG</h2>";

echo "<h4>Estado de componentes críticos:</h4>";
$componentes = [
    'config/config.inc.php' => file_exists('config/config.inc.php'),
    'web/commands/FeCrCmdDefaultFichas.class.php' => file_exists('web/commands/FeCrCmdDefaultFichas.class.php'),
    'web/templates/Form_Fichas.tpl' => file_exists('web/templates/Form_Fichas.tpl'),
    'web/plugins/function.frameficha.php' => file_exists('web/plugins/function.frameficha.php'),
    'web/plugins/function.viewfichaord.php' => file_exists('web/plugins/function.viewfichaord.php')
];

foreach ($componentes as $componente => $existe) {
    if ($existe) {
        echo "<span class='success'>✅ $componente</span><br>";
    } else {
        echo "<span class='error'>❌ $componente</span><br>";
    }
}

echo "<h4>Próximos pasos:</h4>";
echo "<ol>";
echo "<li>Subir archivos faltantes al servidor</li>";
echo "<li>Verificar permisos de archivos y directorios</li>";
echo "<li>Probar URLs progresivamente</li>";
echo "<li>Revisar logs de error del servidor</li>";
echo "</ol>";
echo "</div>";

echo "<hr>";
echo "<p><strong>🕐 Debug completado:</strong> " . date('Y-m-d H:i:s') . "</p>";
?>