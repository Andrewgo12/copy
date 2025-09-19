<?php
/**
 * SCRIPT DE PRUEBA COMPLETO - SISTEMA CROSS300
 * Verifica dependencias, rutas y funcionalidad
 */

// Activar reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "<h1>🔍 DIAGNÓSTICO COMPLETO - SISTEMA CROSS300</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .success { color: green; font-weight: bold; }
    .error { color: red; font-weight: bold; }
    .warning { color: orange; font-weight: bold; }
    .info { color: blue; }
    .section { background: #f5f5f5; padding: 15px; margin: 10px 0; border-left: 4px solid #007bff; }
    pre { background: #f8f9fa; padding: 10px; border: 1px solid #ddd; overflow-x: auto; }
</style>";

// ============================================================================
// 1. VERIFICACIÓN DE RUTAS Y ARCHIVOS
// ============================================================================
echo "<div class='section'>";
echo "<h2>📁 1. VERIFICACIÓN DE ARCHIVOS CRÍTICOS</h2>";

$archivos_criticos = [
    'config/config.inc.php' => 'Configuración principal',
    'web/commands/FeCrCmdDefaultFichas.class.php' => 'Comando principal de fichas',
    'web/commands/FeCrCmdDefaultBodyFichaOrd.class.php' => 'Comando del cuerpo',
    'web/commands/FeCrCmdDefaultHeadRepoTiemposEjec.class.php' => 'Comando de cabecera',
    'web/templates/Form_Fichas.tpl' => 'Template principal',
    'web/templates/Form_BodyFichaOrd.tpl' => 'Template del cuerpo',
    'web/plugins/function.frameficha.php' => 'Plugin de frames',
    'web/plugins/function.viewfichaord.php' => 'Plugin principal de ficha',
    'config/web.conf.data' => 'Configuración web',
    'config/application.conf.data' => 'Configuración aplicación',
    'index.php' => 'Punto de entrada'
];

foreach ($archivos_criticos as $archivo => $descripcion) {
    if (file_exists($archivo)) {
        echo "<span class='success'>✅ $archivo</span> - $descripcion<br>";
        echo "<span class='info'>   Tamaño: " . filesize($archivo) . " bytes, Permisos: " . substr(sprintf('%o', fileperms($archivo)), -4) . "</span><br>";
    } else {
        echo "<span class='error'>❌ $archivo</span> - $descripcion <strong>NO ENCONTRADO</strong><br>";
    }
}
echo "</div>";

// ============================================================================
// 2. VERIFICACIÓN DE DIRECTORIOS Y PERMISOS
// ============================================================================
echo "<div class='section'>";
echo "<h2>📂 2. VERIFICACIÓN DE DIRECTORIOS</h2>";

$directorios = [
    'web/commands/' => 'Comandos del sistema',
    'web/templates/' => 'Templates Smarty',
    'web/plugins/' => 'Plugins Smarty',
    'web/css/' => 'Hojas de estilo',
    'web/js/' => 'JavaScript',
    'web/images/' => 'Imágenes',
    'config/' => 'Configuración',
    'config/language/' => 'Archivos de idioma',
    'config/language/es/' => 'Idioma español',
    'config/language/en/' => 'Idioma inglés',
    'data/' => 'Clases de datos',
    'data/Pgsql/' => 'Gateways PostgreSQL',
    'domain/' => 'Lógica de negocio',
    'templates_c/' => 'Cache Smarty'
];

foreach ($directorios as $directorio => $descripcion) {
    if (is_dir($directorio)) {
        $permisos = substr(sprintf('%o', fileperms($directorio)), -4);
        $escribible = is_writable($directorio) ? "Escribible" : "Solo lectura";
        echo "<span class='success'>✅ $directorio</span> - $descripcion (Permisos: $permisos, $escribible)<br>";
    } else {
        echo "<span class='error'>❌ $directorio</span> - $descripcion <strong>NO ENCONTRADO</strong><br>";
    }
}
echo "</div>";

// ============================================================================
// 3. VERIFICACIÓN DE CONFIGURACIÓN
// ============================================================================
echo "<div class='section'>";
echo "<h2>⚙️ 3. VERIFICACIÓN DE CONFIGURACIÓN</h2>";

try {
    if (file_exists('config/config.inc.php')) {
        require_once 'config/config.inc.php';
        echo "<span class='success'>✅ config.inc.php cargado correctamente</span><br>";
        
        // Verificar variables definidas
        if (isset($asap_dir)) {
            echo "<span class='info'>📁 ASAP Directory: $asap_dir</span><br>";
        }
        if (isset($app_dir)) {
            echo "<span class='info'>📁 App Directory: $app_dir</span><br>";
        }
        if (isset($app_name)) {
            echo "<span class='info'>📱 App Name: $app_name</span><br>";
        }
        
        // Verificar include_path
        echo "<span class='info'>🔗 Include Path: " . ini_get('include_path') . "</span><br>";
        
    } else {
        echo "<span class='error'>❌ config.inc.php no encontrado</span><br>";
    }
} catch (Exception $e) {
    echo "<span class='error'>❌ Error cargando configuración: " . $e->getMessage() . "</span><br>";
}
echo "</div>";

// ============================================================================
// 4. VERIFICACIÓN DE CLASES DEL SISTEMA
// ============================================================================
echo "<div class='section'>";
echo "<h2>🏗️ 4. VERIFICACIÓN DE CLASES</h2>";

// Intentar cargar Application class
try {
    if (class_exists('Application')) {
        echo "<span class='success'>✅ Clase Application disponible</span><br>";
    } else {
        echo "<span class='warning'>⚠️ Clase Application no disponible</span><br>";
    }
} catch (Exception $e) {
    echo "<span class='error'>❌ Error con clase Application: " . $e->getMessage() . "</span><br>";
}

// Verificar comandos específicos
$comandos = [
    'FeCrCmdDefaultFichas',
    'FeCrCmdDefaultBodyFichaOrd',
    'FeCrCmdDefaultHeadRepoTiemposEjec'
];

foreach ($comandos as $comando) {
    $archivo_comando = "web/commands/$comando.class.php";
    if (file_exists($archivo_comando)) {
        try {
            require_once $archivo_comando;
            if (class_exists($comando)) {
                echo "<span class='success'>✅ Comando $comando cargado</span><br>";
            } else {
                echo "<span class='error'>❌ Comando $comando no se pudo instanciar</span><br>";
            }
        } catch (Exception $e) {
            echo "<span class='error'>❌ Error cargando $comando: " . $e->getMessage() . "</span><br>";
        }
    } else {
        echo "<span class='error'>❌ Archivo de comando $comando no encontrado</span><br>";
    }
}
echo "</div>";

// ============================================================================
// 5. VERIFICACIÓN DE PLUGINS SMARTY
// ============================================================================
echo "<div class='section'>";
echo "<h2>🔌 5. VERIFICACIÓN DE PLUGINS SMARTY</h2>";

$plugins = [
    'function.frameficha.php' => 'Plugin de frames',
    'function.viewfichaord.php' => 'Plugin principal de ficha',
    'function.textfield.php' => 'Plugin de campos de texto',
    'function.select_row_table.php' => 'Plugin de tablas'
];

foreach ($plugins as $plugin => $descripcion) {
    $ruta_plugin = "web/plugins/$plugin";
    if (file_exists($ruta_plugin)) {
        echo "<span class='success'>✅ $plugin</span> - $descripcion<br>";
        
        // Verificar función principal del plugin
        $contenido = file_get_contents($ruta_plugin);
        $nombre_funcion = str_replace(['.php'], '', $plugin);
        $nombre_funcion = str_replace(['function.'], ['smarty_function_'], $nombre_funcion);
        
        if (strpos($contenido, $nombre_funcion) !== false) {
            echo "<span class='info'>   Función $nombre_funcion encontrada</span><br>";
        } else {
            echo "<span class='warning'>   ⚠️ Función principal no encontrada</span><br>";
        }
    } else {
        echo "<span class='error'>❌ $plugin</span> - $descripcion <strong>NO ENCONTRADO</strong><br>";
    }
}
echo "</div>";

// ============================================================================
// 6. VERIFICACIÓN DE TEMPLATES
// ============================================================================
echo "<div class='section'>";
echo "<h2>🎨 6. VERIFICACIÓN DE TEMPLATES</h2>";

$templates = [
    'Form_Fichas.tpl' => 'Template principal con frames',
    'Form_BodyFichaOrd.tpl' => 'Template del cuerpo de ficha',
    'Form_WebUser.tpl' => 'Template de usuario web',
    'Form_Orden.tpl' => 'Template de órdenes'
];

foreach ($templates as $template => $descripcion) {
    $ruta_template = "web/templates/$template";
    if (file_exists($ruta_template)) {
        echo "<span class='success'>✅ $template</span> - $descripcion<br>";
        
        // Verificar contenido básico
        $contenido = file_get_contents($ruta_template);
        if (strpos($contenido, '{') !== false && strpos($contenido, '}') !== false) {
            echo "<span class='info'>   Contiene tags Smarty válidos</span><br>";
        } else {
            echo "<span class='warning'>   ⚠️ No contiene tags Smarty</span><br>";
        }
    } else {
        echo "<span class='error'>❌ $template</span> - $descripción <strong>NO ENCONTRADO</strong><br>";
    }
}

// Verificar directorio de compilación
if (is_dir('templates_c/')) {
    if (is_writable('templates_c/')) {
        echo "<span class='success'>✅ Directorio templates_c/ escribible</span><br>";
    } else {
        echo "<span class='error'>❌ Directorio templates_c/ no escribible</span><br>";
    }
} else {
    echo "<span class='error'>❌ Directorio templates_c/ no existe</span><br>";
}
echo "</div>";

// ============================================================================
// 7. VERIFICACIÓN DE ARCHIVOS DE IDIOMA
// ============================================================================
echo "<div class='section'>";
echo "<h2>🌍 7. VERIFICACIÓN DE ARCHIVOS DE IDIOMA</h2>";

$idiomas = ['es', 'en'];
$archivos_idioma = [
    'fichaord.php' => 'Etiquetas de ficha',
    'messages.php' => 'Mensajes del sistema',
    'generic.php' => 'Etiquetas genéricas',
    'webuser.php' => 'Etiquetas de usuario'
];

foreach ($idiomas as $idioma) {
    echo "<h4>Idioma: $idioma</h4>";
    foreach ($archivos_idioma as $archivo => $descripcion) {
        $ruta = "config/language/$idioma/$idioma.$archivo";
        if (file_exists($ruta)) {
            echo "<span class='success'>✅ $ruta</span> - $descripcion<br>";
        } else {
            echo "<span class='error'>❌ $ruta</span> - $descripcion <strong>NO ENCONTRADO</strong><br>";
        }
    }
}
echo "</div>";

// ============================================================================
// 8. TEST DE FUNCIONALIDAD BÁSICA
// ============================================================================
echo "<div class='section'>";
echo "<h2>🧪 8. TEST DE FUNCIONALIDAD BÁSICA</h2>";

// Test de parámetros GET
echo "<h4>Parámetros recibidos:</h4>";
if (!empty($_GET)) {
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
} else {
    echo "<span class='info'>No hay parámetros GET</span><br>";
}

// Test de sesión
session_start();
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<span class='success'>✅ Sesiones PHP funcionando</span><br>";
} else {
    echo "<span class='error'>❌ Problema con sesiones PHP</span><br>";
}

// Test de funciones PHP requeridas
$funciones_requeridas = ['file_get_contents', 'file_put_contents', 'serialize', 'unserialize', 'json_encode', 'json_decode'];
foreach ($funciones_requeridas as $funcion) {
    if (function_exists($funcion)) {
        echo "<span class='success'>✅ Función $funcion disponible</span><br>";
    } else {
        echo "<span class='error'>❌ Función $funcion NO disponible</span><br>";
    }
}
echo "</div>";

// ============================================================================
// 9. INFORMACIÓN DEL SISTEMA
// ============================================================================
echo "<div class='section'>";
echo "<h2>💻 9. INFORMACIÓN DEL SISTEMA</h2>";

echo "<strong>PHP Version:</strong> " . phpversion() . "<br>";
echo "<strong>Sistema Operativo:</strong> " . php_uname() . "<br>";
echo "<strong>Servidor Web:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "<strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "<strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "<strong>Request URI:</strong> " . $_SERVER['REQUEST_URI'] . "<br>";
echo "<strong>Directorio Actual:</strong> " . getcwd() . "<br>";

// Extensiones PHP importantes
$extensiones = ['pgsql', 'pdo', 'pdo_pgsql', 'session', 'json'];
echo "<h4>Extensiones PHP:</h4>";
foreach ($extensiones as $ext) {
    if (extension_loaded($ext)) {
        echo "<span class='success'>✅ $ext</span><br>";
    } else {
        echo "<span class='error'>❌ $ext NO disponible</span><br>";
    }
}
echo "</div>";

// ============================================================================
// 10. RECOMENDACIONES
// ============================================================================
echo "<div class='section'>";
echo "<h2>💡 10. RECOMENDACIONES</h2>";

echo "<h4>Para resolver problemas encontrados:</h4>";
echo "<ol>";
echo "<li><strong>Archivos faltantes:</strong> Subir archivos desde el repositorio local</li>";
echo "<li><strong>Permisos:</strong> Ejecutar <code>chmod 755</code> en directorios y <code>chmod 644</code> en archivos PHP</li>";
echo "<li><strong>Templates_c:</strong> Crear directorio y dar permisos <code>chmod 777</code></li>";
echo "<li><strong>Configuración:</strong> Verificar config.inc.php y web.conf.data</li>";
echo "<li><strong>Base de datos:</strong> Verificar conexión PostgreSQL</li>";
echo "</ol>";

echo "<h4>URLs de prueba sugeridas:</h4>";
echo "<ol>";
echo "<li><a href='index.php'>index.php</a> - Página principal</li>";
echo "<li><a href='index.php?action=FeCrCmdDefaultWebUser'>Login básico</a></li>";
echo "<li><a href='index.php?action=FeCrCmdDefaultFichas&ordenumerosFO=1061242025'>Ficha de caso</a></li>";
echo "</ol>";
echo "</div>";

echo "<hr>";
echo "<p><strong>🕐 Test completado:</strong> " . date('Y-m-d H:i:s') . "</p>";
echo "<p><strong>📧 Para soporte:</strong> Enviar este reporte al equipo técnico</p>";
?>