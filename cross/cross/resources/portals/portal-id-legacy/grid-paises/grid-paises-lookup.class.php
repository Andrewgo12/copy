<?php
class grid_paises_lookup
{
//  
   function lookup_paisactivos(&$paisactivos) 
   {
      $conteudo = "" ; 
      if ($paisactivos == "A")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_activo'] . "";
      } 
      if ($paisactivos == "I")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $paisactivos = $conteudo; 
      } 
   }  
}
?>
