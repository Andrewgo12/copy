<?php
class grid_estadosclientes_lookup
{
//  
   function lookup_esclactivos(&$esclactivos) 
   {
      $conteudo = "" ; 
      if ($esclactivos == "A")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_activo'] . "";
      } 
      if ($esclactivos == "I")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $esclactivos = $conteudo; 
      } 
   }  
}
?>
