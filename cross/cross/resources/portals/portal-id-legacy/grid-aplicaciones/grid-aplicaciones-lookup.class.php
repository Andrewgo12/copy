<?php
class grid_aplicaciones_lookup
{
//  
   function lookup_apliestados(&$apliestados) 
   {
      $conteudo = "" ; 
      if ($apliestados == "A")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_activo'] . "";
      } 
      if ($apliestados == "I")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $apliestados = $conteudo; 
      } 
   }  
}
?>
