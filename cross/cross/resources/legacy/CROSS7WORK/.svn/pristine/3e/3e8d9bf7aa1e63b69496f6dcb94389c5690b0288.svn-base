<?php
#!/bin/sh

$Application_constant = array (
		0 => array( //Constantes para empresa(esquema 2)
             "REG_ACT" => "A", //Indicador de registros activos
             "REG_INACT" => "I", //Indicador de registros inactivos
            'PDF_SUFIX' => ".pdf",//extencion del pdf
            'DB_NULL' => 'NULL',
            'ENCU_PROFILE' => "3",//extencion del pdf
            'SI' => "Si",//extencion del pdf
            'NO' => "No",//extencion del pdf
            'NSNR' => "3",//extencion del pdf
			'PREG_CER' => "C",//Estado para una pregunta cerrada
			'FORM_PRED'=>'S',
			'FORM_NO_PRED'=>'N',
			'TIPO_PREG'=>array('A','C'),
			'PREG_ABIERTA'=>'A',
			'EST_FORM'=>array('S','N'),
			"max_combo_options" => 30,
        ),
);

$path = dirname(__FILE__)."/application.constant.data";
$fd = fopen($path,"w");
if($fd){
    fwrite($fd, serialize($Application_constant));
    fclose($fd);
}else{
    die("[ENCUESTAS] constant file ERROR\n");
}
die("[ENCUESTAS] constant file OK\n");
?>
