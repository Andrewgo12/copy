<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     menu_frameficha
 * Version:  1.0
 * Date:     Sept 16, 2004
 * Author:	 Carlos Zapata<cazapata@parquesoft.com>
 * Purpose:  display a Frameset
 * Input:
 *           frame_superior:
 *           frame_izquierdo:
 *           frame_principal:
 *
 * Examples: {menu_frameficha
 *                       frameficha_superior=""
 *                       frameficha_principal=""
 *           }
 *
 * --------------------------------------------------------------------
 */
function smarty_function_frameficha($params, &$smarty)
{
  extract($params);
  $sbCadena = '';  
  if($_REQUEST["vars"]){
  	$rcValores = explode(",",$_REQUEST["vars"]);
  	foreach ($rcValores as $key => $valor)
  		$rcValores[$key] = $valor."=".$_REQUEST[$valor];
  	$sbCadena = "&".implode("&",$rcValores);
  }
  $template1 = "index.php?action=".$_REQUEST["topFrame"];
  $template3 = "index.php?action=".$_REQUEST["mainFrame"].$sbCadena;
  //1 titulo
  //3 area_trabajo
  $html_result = "";
  $html_result .= "
    <frameset rows='94,*' cols='*' frameborder='NO' border='0' framespacing='0'>
        <frame src='".$template1."' name='topFrame' scrolling='NO' noresize>
        <frame src='".$template3."' name='mainFrame' scrolling='AUTO'>
    </frameset>
    <noframes>
    <body>
        Parece que su navegador no soporta Frames!!!.
    </body>
    </noframes>";
  print $html_result;
}
?>