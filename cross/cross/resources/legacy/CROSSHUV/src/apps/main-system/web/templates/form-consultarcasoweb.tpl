<html>
<head>
    <title>Consultar mi PQRSF - Hospital Universitario del Valle</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #003366; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { color: #003366; margin: 0; }
        .header p { margin: 5px 0; color: #666; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
        .btn { background: #003366; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #004488; }
        .info { background: #e8f4fd; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #003366; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hospital Universitario del Valle</h1>
            <p><strong>"Evaristo García E.S.E."</strong></p>
            <p>NIT 890303461-2<br>Calle 5 # 36-08, Cali - Valle del Cauca, Colombia<br>PBX: (57-2) 620-6000</p>
        </div>
        
        <h2 style="color: #003366; text-align: center;">Consultar mi PQRSF</h2>
        
        <div class="info">
            <strong>¿Cómo consultar mi caso?</strong><br>
            Ingrese el número de caso que le fue asignado cuando registró su PQRSF. 
            Este número tiene el formato: 1061242025
        </div>
        
        <form method="post" action="index.php">
            <input type="hidden" name="action" value="FeCrCmdConsultarCasoWeb">
            
            <div class="form-group">
                <label for="numeroCaso">Número de Caso:</label>
                <input type="text" id="numeroCaso" name="numeroCaso" placeholder="Ejemplo: 1061242025" required>
            </div>
            
            <div style="text-align: center;">
                <button type="submit" class="btn">Consultar mi Caso</button>
            </div>
        </form>
        
        <div style="margin-top: 30px; text-align: center; color: #666; font-size: 14px;">
            <p>Si no recuerda su número de caso, puede contactarnos al PBX (57-2) 620-6000</p>
        </div>
    </div>
</body>
</html>