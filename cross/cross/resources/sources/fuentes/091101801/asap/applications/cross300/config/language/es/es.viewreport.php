<?php
/*
 This is the language's file to the  Orden table
*/
	$rclabels = array(
				"title"=>"Reportes de Gestión",
                "context_help"=>"Presione IMPRIMIR para imprimir el reporte.  Presione CERRAR para cerrar esta ventana.<br>Como puede observar, están habilitadas las opciones para exportar este reporte a PDF y WORD.",
                
                "ordefecingd"=>array("label"=>"Ingreso","accesskey"=>true,"commentary"=>""),
				"pdf"=>array("label"=>"Exportar a PDF","accesskey"=>false,"commentary"=>""),
				"excel"=>array("label"=>"Exportar a MS EXCEL","accesskey"=>false,"commentary"=>""),
				"word"=>array("label"=>"Exportar a MS WORD","accesskey"=>false,"commentary"=>""),
				);

	$rcReportLabels = array(
		14 => array(
			0=>array(
				"col1"=>"Dependencia",
				"col2"=>"Tipo Caso",
				"col3"=>"Periodo",
				"col4"=>"Casos",),
			1=>array(
				"x-label"=>"Periodo",
				"y-label"=>"Casos",
				"title"=>"Casos por Frecuencia"),
		),
		15 => array(
			0=>array(
				"col1"=>"Tipo de Caso",
				"col2"=>"Localizaci&oacute;n",
				"col3"=>"Tipo localizaci&oacute;n",
				"col4"=>"Casos",),
			1=>array(
				"x-label"=>"Tipo de Caso",
				"y-label"=>"Casos",
				"title"=>"Casos por Localizaci&oacute;n"),
		),
		16 => array(
			0=>array(
				"col9"=>"Clasificación",
				"col0"=>"Subclasificación",
				"col1"=>"Localización",
				"col2"=>"Denuncias",),
			1=>array(
				"x-label"=>"Localización",
				"y-label"=>"Denuncias",
				"title"=>"Cantidad de denuncias por localización"),
		),
		17 => array(
			0=>array(
				"col1"=>"Actividad",
				"col2"=>"Casos",),
			1=>array(
				"x-label"=>"Actividad",
				"y-label"=>"Casos",
				"title"=>"Actividades por tarea"),
		),
		18 => array(
			0=>array(
				"col1"=>"Usuario",
				"col2"=>"Casos",),
			1=>array(
				"x-label"=>"Usuario",
				"y-label"=>"Casos",
				"title"=>"Casos por Usuario"),
		),
		19 => array(
			0=>array(
				"col1"=>"Tipo de Caso",
				"col2"=>"Indicador",),
			1=>array(
				"x-label"=>"Tipo de Caso",
				"y-label"=>"Indicador",
				"title"=>"Indicador de satisfacción del cliente"),
		),
	   /*
		* oldorgacodigos, neworgacodigos, neworganombres, oldorgacodpads, neworgacodpads, 
		* ordenestopadres, ordenesneworgs, logrfechorregn, authusernames
		*/
		20 => array(
			0=>array(
				"col1"=>"Ente Inicial",
				"col2"=>"Ente Imagen",
				"col3"=>"Nombre Nuevo",
				"col4"=>"Padre Anterior",
				"col5"=>"Padre Nuevo",
				"col6"=>"Casos Transferidos al Padre",
				"col7"=>"Casos Cerrados",
				"col8"=>"Fecha Hora de Rotación",
				"col9"=>"Usuario",),
			1=>array(
				"title"=>"Histórico de rotación de personal"),
		),
		21 => array(
			0=>array(
				"col1"=>"Usuario que solicita",
				"col2"=>"Llav. solicitadas",
				"col3"=>"Llav. utilizadas",
				"col4"=>"Llav. perdidas"),
			1=>array(
				"title"=>"Reporte de autorizaciones"),
			2=>array(
				0=>"Código usuario que autoriza",
				1=>"Usuario que autoriza",
				2=>"Código usuario que solicita",
				3=>"Usuario que solicita",
				4=>"Llav. solicitadas",
				5=>"Llav. utilizadas",
				6=>"Llav. perdidas"),
		),
	);
	
	$rcMonths = array(
		1=>"Enero",
		2=>"Febrero",
		3=>"Marzo",
		4=>"Abril",
		5=>"Mayo",
		6=>"Junio",
		7=>"Julio",
		8=>"Agosto",
		9=>"Septiembre",
		10=>"Octubre",
		11=>"Noviembre",
		12=>"Diciembre",
	);
?>