<?php
// Script para actualizar la configuración web con las nuevas vistas

// Leer configuración actual
$configFile = 'config/web.conf.data';
$config = unserialize(file_get_contents($configFile));

// Agregar nuevos comandos
$config['commands']['FeCrCmdCasoCreado'] = array(
    'class' => 'FeCrCmdCasoCreado',
    'validated' => 'false',
    'views' => array(
        'success' => array(
            'view' => 'Form_CasoCreado',
            'redirect' => 0
        ),
        'fail' => array(
            'view' => 'error',
            'redirect' => 0
        )
    )
);

$config['commands']['FeCrCmdConsultarCasoWeb'] = array(
    'class' => 'FeCrCmdConsultarCasoWeb',
    'validated' => 'false',
    'views' => array(
        'success' => array(
            'view' => 'Form_ConsultarCasoWeb',
            'redirect' => 0
        ),
        'fail' => array(
            'view' => 'error',
            'redirect' => 0
        )
    )
);

$config['commands']['FeCrCmdConsultarMiPQRSF'] = array(
    'class' => 'FeCrCmdConsultarMiPQRSF',
    'validated' => 'false',
    'views' => array(
        'success' => array(
            'view' => 'Form_ConsultarMiPQRSF',
            'redirect' => 0
        ),
        'fail' => array(
            'view' => 'error',
            'redirect' => 0
        )
    )
);

// Agregar nuevas vistas
$config['views']['Form_CasoCreado'] = array(
    'template' => 'Form_CasoCreado.tpl'
);

$config['views']['Form_ConsultarCasoWeb'] = array(
    'template' => 'Form_ConsultarCasoWeb.tpl'
);

$config['views']['Form_ConsultarMiPQRSF'] = array(
    'template' => 'Form_ConsultarMiPQRSF.tpl'
);

// Guardar configuración actualizada
file_put_contents($configFile, serialize($config));

echo "Configuración actualizada exitosamente.\n";
echo "Nuevos comandos agregados:\n";
echo "- FeCrCmdCasoCreado\n";
echo "- FeCrCmdConsultarCasoWeb\n";
echo "- FeCrCmdConsultarMiPQRSF\n";
echo "\nNuevas vistas agregadas:\n";
echo "- Form_CasoCreado\n";
echo "- Form_ConsultarCasoWeb\n";
echo "- Form_ConsultarMiPQRSF\n";
?>