<?php 
/*
 * Smarty plugin
 * Type:     function
 * Name:     frame_centroemail
 * Version:  1.0
 * Date:     09-Oct-2004
 * Author:	 freina <freina@parquesoft.com>
 * Purpose:  display a Frameset
 * Input:
 						frame_tools="comando"
           				 frame_consult=""
           				 frame_list=""
           				 frame_preview=""
 *
 * Examples: {frame_centroemail
 *                      frame_tools="comando"
           				 frame_consult=""
           				 frame_list=""
           				 frame_preview=""
 *           }
 *
 */
function smarty_function_frame_centroemail($params, & $smarty) {
	extract($params);
	settype($sbtools,"string");
	settype($sbconsult,"string");
	settype($sblist,"string");
	settype($sbpreview,"string");
	settype($sbhtml_result,"string");
	
	$sbtools = "index.php?action=".$frame_tools;
	$sbconsult = "index.php?action=".$frame_consult;
	$sblist = "index.php?action=".$frame_list;
	$sbpreview = "index.php?action=".$frame_preview;
	//$sbpreview = "/srv/www/htdocs/prueba.php";
	
	$sbhtml_result .= "
	    <frameset rows='16%,*' cols='*' frameborder='YES' border='1' framespacing='0'>
	        <frame src='".$sbtools."' name='toolframe' frameborder='NO' scrolling='NO' noresize border='1'>
	            <frameset rows='*' cols='20%,*' framespacing='0' frameborder='YES' border='1'>
	                <frame src='".$sbconsult."' name='consultframe' frameborder='YES' resizable border='3'>
	                <frameset rows='50%,50%' framespacing='0' frameborder='YES' border='1'>
	                <frame src='".$sblist."' name='listframe' frameborder='YES' scrolling='AUTO' border='3'>
	                <frame src='".$sbpreview."' name='previewframe' frameborder='YES' scrolling='AUTO' border='3'>
	                </frameset>
	            </frameset>
	    </frameset>
	    <noframes>
	    <body>
	        Parece que su navegador no soporta Frames!!!.
	    </body>
	    </noframes>";
	print $sbhtml_result;
}
?>