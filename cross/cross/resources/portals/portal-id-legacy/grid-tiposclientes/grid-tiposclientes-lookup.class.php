<?php
class grid_tiposclientes_lookup
{
//  
   function lookup_ticlestados(&$ticlestados) 
   {
      $conteudo = "" ; 
      if ($ticlestados == "A")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_activo'] . "";
      } 
      if ($ticlestados == "I")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $ticlestados = $conteudo; 
      } 
   }  
}
?>
