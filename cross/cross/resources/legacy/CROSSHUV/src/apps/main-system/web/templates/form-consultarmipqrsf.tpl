<html>
<head>
    <title>Consultar mi PQRSF - Hospital Universitario del Valle</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f8ff; }
        .container { max-width: 700px; margin: 0 auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .header { text-align: center; border-bottom: 3px solid #003366; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { color: #003366; margin: 0; font-size: 2.2em; }
        .header p { margin: 8px 0; color: #666; }
        .form-section { background: #f8f9fa; padding: 25px; border-radius: 10px; margin: 20px 0; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; font-size: 16px; }
        .form-group input { width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s; }
        .form-group input:focus { border-color: #003366; outline: none; }
        .btn { background: #003366; color: white; padding: 15px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; transition: all 0.3s; }
        .btn:hover { background: #004488; transform: translateY(-2px); }
        .info { background: #e8f4fd; padding: 20px; border-radius: 10px; margin: 20px 0; border-left: 5px solid #003366; }
        .example { background: #fff3cd; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #ffc107; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hospital Universitario del Valle</h1>
            <p><strong>"Evaristo García E.S.E."</strong></p>
            <p>NIT 890303461-2 | Calle 5 # 36-08, Cali - Colombia | PBX: (57-2) 620-6000</p>
        </div>
        
        <h2 style="color: #003366; text-align: center; margin-bottom: 30px;">🔍 Consultar mi PQRSF</h2>
        
        <div class="info">
            <h3 style="margin-top: 0; color: #003366;">📋 ¿Cómo consultar mi caso?</h3>
            <p>Para consultar el estado de su PQRSF, necesita ingresar su <strong>número de cédula</strong>. 
            Opcionalmente puede incluir el número de caso si lo recuerda.</p>
        </div>
        
        <div class="example">
            <strong>🆔 Requerido:</strong> Su número de cédula<br>
            <strong>📝 Opcional:</strong> Número de caso (Ej: 1061242025)<br>
            <small>El sistema buscará todos sus casos registrados con esa cédula</small>
        </div>
        
        <div class="form-section">
            <form method="post" action="index.php" target="_blank">
                <input type="hidden" name="action" value="FeCrCmdConsultarCasoWeb">
                
                <div class="form-group">
                    <label for="documento">🆔 Número de Cédula:</label>
                    <input type="text" id="documento" name="documento" placeholder="Ingrese su número de cédula" required>
                </div>
                
                <div class="form-group">
                    <label for="numeroCaso">🔢 Número de Caso (Opcional):</label>
                    <input type="text" id="numeroCaso" name="numeroCaso" placeholder="Si lo conoce, ingrese el número de caso">
                </div>
                
                <div style="text-align: center;">
                    <button type="submit" class="btn">🔍 Consultar mi PQRSF</button>
                </div>
            </form>
        </div>
        
        <div class="info">
            <h3 style="margin-top: 0; color: #003366;">ℹ️ Información importante:</h3>
            <ul>
                <li>Su consulta se abrirá en una nueva ventana</li>
                <li>Podrá ver el estado actual de su caso</li>
                <li>Si su caso está finalizado, verá la respuesta oficial</li>
                <li>Podrá descargar documentos adjuntos si los hay</li>
            </ul>
        </div>
        
        <div style="text-align: center; margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
            <p><strong>¿No recuerda su número de caso?</strong></p>
            <p>Contáctenos al PBX (57-2) 620-6000 o visite nuestras oficinas</p>
            <p><small>Horario de atención: Lunes a Viernes de 7:00 AM a 5:00 PM</small></p>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:window.close();" style="color: #666; text-decoration: none;">← Regresar al formulario</a>
        </div>
    </div>
</body>
</html>