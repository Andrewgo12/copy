<html>
<head>
    <title>Caso PQRSF Creado Exitosamente - Hospital Universitario del Valle</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f8ff; }
        .container { max-width: 700px; margin: 0 auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .header { text-align: center; border-bottom: 3px solid #003366; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { color: #003366; margin: 0; font-size: 2.2em; }
        .header p { margin: 8px 0; color: #666; }
        .success-box { background: #d4edda; border: 2px solid #28a745; border-radius: 10px; padding: 25px; margin: 20px 0; text-align: center; }
        .case-number { font-size: 2.5em; font-weight: bold; color: #28a745; margin: 15px 0; }
        .info { background: #e8f4fd; padding: 20px; border-radius: 10px; margin: 20px 0; border-left: 5px solid #003366; }
        .btn { background: #003366; color: white; padding: 15px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; transition: all 0.3s; margin: 10px; }
        .btn:hover { background: #004488; transform: translateY(-2px); }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hospital Universitario del Valle</h1>
            <p><strong>"Evaristo García E.S.E."</strong></p>
            <p>NIT 890303461-2 | Calle 5 # 36-08, Cali - Colombia | PBX: (57-2) 620-6000</p>
        </div>
        
        <div class="success-box">
            <h2 style="color: #28a745; margin-top: 0;">✅ ¡Su caso PQRSF ha sido creado exitosamente!</h2>
            <p><strong>Su número de caso es:</strong></p>
            <div class="case-number">{$numeroCaso}</div>
            <p style="color: #666; margin-bottom: 0;"><strong>Guarde este número para consultar el estado de su caso</strong></p>
        </div>
        
        <div class="info">
            <h3 style="margin-top: 0; color: #003366;">📋 Información importante:</h3>
            <ul>
                <li><strong>Fecha de registro:</strong> {$fechaRegistro}</li>
                <li><strong>Fecha de vencimiento:</strong> {$fechaVencimiento}</li>
                <li>Su caso será procesado según los tiempos establecidos</li>
                <li>Recibirá notificaciones sobre el estado de su caso</li>
                <li>Puede consultar el estado en cualquier momento usando el número de caso</li>
            </ul>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <button type="button" class="btn btn-success" onclick="consultarCaso();">
                🔍 Consultar mi Caso Ahora
            </button>
            <button type="button" class="btn btn-secondary" onclick="crearNuevoCaso();">
                📝 Crear Nuevo Caso
            </button>
        </div>
        
        <div class="info">
            <h3 style="margin-top: 0; color: #003366;">📞 Contacto:</h3>
            <p>Si tiene alguna pregunta sobre su caso, puede contactarnos:</p>
            <ul>
                <li><strong>Teléfono:</strong> (57-2) 620-6000</li>
                <li><strong>Horario:</strong> Lunes a Viernes de 7:00 AM a 5:00 PM</li>
                <li><strong>Dirección:</strong> Calle 5 # 36-08, Cali - Valle del Cauca</li>
            </ul>
        </div>
    </div>

    <script>
        function consultarCaso() {
            var numeroCaso = '{$numeroCaso}';
            var url = 'index.php?action=FeCrCmdDefaultFichas';
            url += '&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec';
            url += '&mainFrame=FeCrCmdDefaultBodyFichaOrdWeb';
            url += '&ordenumerosFO=' + encodeURIComponent(numeroCaso);
            url += '&vars=ordenumerosFO';
            window.open(url, '_blank', 'width=1200,height=800,scrollbars=yes,resizable=yes');
        }
        
        function crearNuevoCaso() {
            window.location.href = 'index.php?action=FeCrCmdDefaultWebUser&username=webuser&context=2&lang=es&clean_table=1';
        }
        
        // Copiar número de caso al portapapeles
        function copiarNumero() {
            var numeroCaso = '{$numeroCaso}';
            navigator.clipboard.writeText(numeroCaso).then(function() {
                alert('Número de caso copiado al portapapeles: ' + numeroCaso);
            });
        }
    </script>
</body>
</html>