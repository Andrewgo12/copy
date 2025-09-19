<?php
class grid_tiposidentifis_lookup
{
//  
   function lookup_tiidactivos(&$tiidactivos) 
   {
      $conteudo = "" ; 
      if ($tiidactivos == "A")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_activo'] . "";
      } 
      if ($tiidactivos == "I")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $tiidactivos = $conteudo; 
      } 
   }  
}
?>
