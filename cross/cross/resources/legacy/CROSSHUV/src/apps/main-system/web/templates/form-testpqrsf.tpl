<!DOCTYPE html>
<html>
<head>
    <title>TEST PQRSF - Hospital Universitario del Valle</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f0f8ff; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; background: #003366; color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
        .test-section { background: white; padding: 20px; margin: 20px 0; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .test-section h3 { color: #003366; border-bottom: 2px solid #003366; padding-bottom: 10px; }
        .btn { background: #003366; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin: 5px; text-decoration: none; display: inline-block; }
        .btn:hover { background: #004488; }
        .btn-success { background: #28a745; }
        .btn-warning { background: #ffc107; color: #000; }
        .btn-danger { background: #dc3545; }
        .status { padding: 10px; border-radius: 5px; margin: 10px 0; }
        .status.success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .status.error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .code { background: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace; margin: 10px 0; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        iframe { width: 100%; height: 400px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧪 SISTEMA DE PRUEBAS PQRSF</h1>
            <p><strong>Hospital Universitario del Valle - Evaristo García</strong></p>
            <p>Pruebas del Sistema de Consulta Web de PQRSF</p>
        </div>

        <!-- SECCIÓN 1: PRUEBAS DE AUTENTICACIÓN -->
        <div class="test-section">
            <h3>🔐 1. PRUEBAS DE AUTENTICACIÓN WEB</h3>
            <p>Probar el sistema de autenticación para usuarios web</p>
            
            <div class="grid">
                <div>
                    <h4>✅ Autenticación Correcta:</h4>
                    <div class="code">
                        ?action=FeCrCmdDefaultWebUser&username=webuser&context=2&lang=es
                    </div>
                    <a href="index.php?action=FeCrCmdDefaultWebUser&username=webuser&context=2&lang=es" class="btn btn-success" target="_blank">
                        Probar Autenticación OK
                    </a>
                </div>
                
                <div>
                    <h4>❌ Autenticación Incorrecta:</h4>
                    <div class="code">
                        ?action=FeCrCmdDefaultWebUser&username=invalid&context=999
                    </div>
                    <a href="index.php?action=FeCrCmdDefaultWebUser&username=invalid&context=999" class="btn btn-danger" target="_blank">
                        Probar Error de Auth
                    </a>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 2: PRUEBAS DE CONSULTA -->
        <div class="test-section">
            <h3>🔍 2. PRUEBAS DE CONSULTA DE CASOS</h3>
            <p>Probar la funcionalidad de consulta de casos PQRSF</p>
            
            <div class="grid">
                <div>
                    <h4>📋 Formulario de Consulta:</h4>
                    <a href="index.php?action=FeCrCmdTestPQRSF" class="btn btn-success" target="_blank">
                        Abrir Formulario de Consulta
                    </a>
                    <p><small>Simula la autenticación y muestra el formulario</small></p>
                </div>
                
                <div>
                    <h4>🔍 Consulta por Número:</h4>
                    <form method="get" action="index.php" target="_blank" style="margin: 10px 0;">
                        <input type="hidden" name="action" value="FeCrCmdConsultarCasoWeb">
                        <input type="text" name="numeroCaso" placeholder="Ej: 1061242025" style="padding: 8px; width: 200px;">
                        <button type="submit" class="btn">Consultar Caso</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 3: PRUEBAS DE FICHAS -->
        <div class="test-section">
            <h3>📄 3. PRUEBAS DE VISUALIZACIÓN DE FICHAS</h3>
            <p>Probar la visualización de fichas completas y simplificadas</p>
            
            <div class="grid">
                <div>
                    <h4>👥 Vista Web Simplificada:</h4>
                    <div class="code">
                        mainFrame=FeCrCmdDefaultBodyFichaOrdWeb
                    </div>
                    <a href="index.php?action=FeCrCmdDefaultFichas&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrdWeb&ordenumerosFO=1061242025&vars=ordenumerosFO" class="btn btn-success" target="_blank">
                        Ver Ficha Web (Simplificada)
                    </a>
                </div>
                
                <div>
                    <h4>👨💼 Vista Admin Completa:</h4>
                    <div class="code">
                        mainFrame=FeCrCmdDefaultBodyFichaOrd
                    </div>
                    <a href="index.php?action=FeCrCmdDefaultFichas&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO=1061242025&vars=ordenumerosFO" class="btn btn-warning" target="_blank">
                        Ver Ficha Admin (Completa)
                    </a>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 4: PRUEBAS DE PLUGINS -->
        <div class="test-section">
            <h3>🔌 4. PRUEBAS DE PLUGINS</h3>
            <p>Probar los plugins de visualización directamente</p>
            
            <div class="grid">
                <div>
                    <h4>🌐 Plugin Web:</h4>
                    <div class="code">
                        function.viewfichaordweb.php
                    </div>
                    <p>Plugin simplificado para usuarios web</p>
                </div>
                
                <div>
                    <h4>⚙️ Plugin Admin:</h4>
                    <div class="code">
                        function.viewfichaord.php
                    </div>
                    <p>Plugin completo para administradores</p>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 5: CASOS DE PRUEBA -->
        <div class="test-section">
            <h3>📊 5. CASOS DE PRUEBA DISPONIBLES</h3>
            <p>Números de casos para probar el sistema</p>
            
            <div class="grid">
                <div>
                    <h4>📋 Caso de Ejemplo:</h4>
                    <div class="status success">
                        <strong>Número:</strong> 1061242025<br>
                        <strong>Tipo:</strong> SUGERENCIA-RECOMENDACIÓN<br>
                        <strong>Estado:</strong> FINALIZADO<br>
                        <strong>Solicitante:</strong> ALEXANDRA MOLINA NAVIA
                    </div>
                    <a href="index.php?action=FeCrCmdConsultarCasoWeb&numeroCaso=1061242025" class="btn btn-success" target="_blank">
                        Consultar Este Caso
                    </a>
                </div>
                
                <div>
                    <h4>🔍 Búsqueda de Casos:</h4>
                    <a href="index.php?action=FeCrCmdDefaultConsultSolucion" class="btn btn-warning" target="_blank">
                        Abrir Buscador de Casos
                    </a>
                    <p><small>Sistema de búsqueda por categorías</small></p>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 6: FLUJO COMPLETO -->
        <div class="test-section">
            <h3>🔄 6. FLUJO COMPLETO DE PRUEBA</h3>
            <p>Secuencia completa de pruebas paso a paso</p>
            
            <ol style="font-size: 16px; line-height: 1.8;">
                <li><strong>Paso 1:</strong> <a href="index.php?action=FeCrCmdDefaultWebUser&username=webuser&context=2&lang=es" target="_blank">Autenticarse como usuario web</a></li>
                <li><strong>Paso 2:</strong> <a href="index.php?action=FeCrCmdTestPQRSF" target="_blank">Acceder al formulario de consulta</a></li>
                <li><strong>Paso 3:</strong> <a href="index.php?action=FeCrCmdConsultarCasoWeb&numeroCaso=1061242025" target="_blank">Consultar caso específico</a></li>
                <li><strong>Paso 4:</strong> Verificar que solo se muestra información básica y respuesta final</li>
                <li><strong>Paso 5:</strong> <a href="index.php?action=FeCrCmdDefaultFichas&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO=1061242025" target="_blank">Comparar con vista de administrador</a></li>
            </ol>
        </div>

        <!-- SECCIÓN 7: ARCHIVOS CREADOS -->
        <div class="test-section">
            <h3>📁 7. ARCHIVOS CREADOS/MODIFICADOS</h3>
            <div class="grid">
                <div>
                    <h4>✅ Archivos Nuevos:</h4>
                    <ul>
                        <li>function.viewfichaordweb.php</li>
                        <li>FeCrCmdConsultarCasoWeb.class.php</li>
                        <li>Form_ConsultarCasoWeb.tpl</li>
                        <li>FeCrCmdTestPQRSF.class.php</li>
                    </ul>
                </div>
                <div>
                    <h4>🔧 Archivos Modificados:</h4>
                    <ul>
                        <li>FeCrCmdDefaultFichas.class.php</li>
                        <li>function.consultsolucion.php</li>
                        <li>FeCrPgsqlSqlExtended.class.php</li>
                        <li>FeCrCmdDefaultFichaOrdWeb.class.php</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div style="text-align: center; margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
            <p><strong>🧪 Sistema de Pruebas PQRSF - Hospital Universitario del Valle</strong></p>
            <p>Todas las pruebas están configuradas para funcionar con el caso de ejemplo: <strong>1061242025</strong></p>
        </div>
    </div>
</body>
</html>