<?php
/*
 * Smarty plugin
 * --------------------------------------------------------------------
 * Type:     function
 * Name:     menu_frame
 * Version:  1.0
 * Date:     ene 12, 2004
 * Author:	 Hemerson Varela <hemerson_varela@yahoo.com>
 * Purpose:  display a Frameset
 * Input:
 *           frame_superior:
 *           frame_izquierdo:
 *           frame_principal:
 *
 * Examples: {menu_frame
 *                       frame_superior=""
 *                       frame_izquierdo=""
 *                       frame_principal=""
 *           }
 *
 * --------------------------------------------------------------------
 */
function smarty_function_menu_frame($params, &$smarty)
{
  extract($params);
  
  settype($html_result,"string");
  
  $template1 = "index.php?action=".$frame_superior;
  $template2 = "index.php?action=".$frame_izquierdo;
  $template3 = "index.php?action=".$frame_principal;
  //1 titulo
  //2 menu
  //3 area_trabajo
  $html_result .= "
    <frameset rows='70,*' cols='*' frameborder='NO' border='0' framespacing='0'>
        <frame src='".$template1."' name='topFrame' scrolling='NO' noresize >
            <frameset rows='*' cols='220,*' id='workFrame' framespacing='0' frameborder='1' border='1'>
                <frame src='".$template2."' name='leftFrame' scrolling='AUTO' noresize>
                <frame src='".$template3."' name='mainFrame' scrolling='AUTO'>
            </frameset>
    </frameset>
    <noframes>
    <body>
        Parece que su navegador no soporta Frames!!!.
    </body>
    </noframes>";
  print $html_result;
}
?>