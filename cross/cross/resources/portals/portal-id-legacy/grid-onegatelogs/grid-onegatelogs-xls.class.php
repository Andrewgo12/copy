<?php

class grid_onegatelogs_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $Arquivo;
   var $Tit_doc;
   //---- 
   function __construct()
   {
   }

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida']) {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xls_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($this->Arr_result);
              exit;
          }
          else
          {
              $this->monta_html();
          }
      }
      else { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['opcao'] = "";
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $this->Xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
      { 
          set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
      } 
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->Xls_col    = 0;
      $this->nm_data    = new nm_data("es");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
      { 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arquivo   .= "_grid_onegatelogs";
          $this->Arquivo   .= ".xlsx";
          $this->Tit_doc    = "grid_onegatelogs.xlsx";
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );;
          $this->Xls_dados = new PHPExcel();
          $this->Xls_dados->setActiveSheetIndex(0);
          $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
          if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
          {
              $this->Nm_ActiveSheet->setRightToLeft(true);
          }
      }
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->New_label['ongacodigon'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongacodigon'] . "";
      $this->New_label['ongafechas'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongafechas'] . "";
      $this->New_label['ongahorad'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongahorad'] . "";
      $this->New_label['onganodos'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_onganodos'] . "";
      $this->New_label['ongaidonegas'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongaidonegas'] . "";
      $this->New_label['ongavirhosts'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongavirhosts'] . "";
      $this->New_label['ongacadenas'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongacadenas'] . "";
      $this->New_label['ongaarchivs'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongaarchivs'] . "";
      $this->New_label['ongafechains'] = "" . $this->Ini->Nm_lang['lang_onegatelogs_fld_ongafechains'] . "";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['xls_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_onegatelogs']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_onegatelogs']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_onegatelogs']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_pesq_filtro'];
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();
      $this->count_span = 0;

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['ongacodigon'])) ? $this->New_label['ongacodigon'] : ""; 
          if ($Cada_col == "ongacodigon" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ongafechas'])) ? $this->New_label['ongafechas'] : ""; 
          if ($Cada_col == "ongafechas" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ongahorad'])) ? $this->New_label['ongahorad'] : ""; 
          if ($Cada_col == "ongahorad" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['onganodos'])) ? $this->New_label['onganodos'] : ""; 
          if ($Cada_col == "onganodos" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ongaidonegas'])) ? $this->New_label['ongaidonegas'] : ""; 
          if ($Cada_col == "ongaidonegas" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ongavirhosts'])) ? $this->New_label['ongavirhosts'] : ""; 
          if ($Cada_col == "ongavirhosts" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ongacadenas'])) ? $this->New_label['ongacadenas'] : ""; 
          if ($Cada_col == "ongacadenas" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida_label'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
          return;
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->ongafechas = $Busca_temp['ongafechas']; 
          $tmp_pos = strpos($this->ongafechas, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongafechas))
          {
              $this->ongafechas = substr($this->ongafechas, 0, $tmp_pos);
          }
          $this->ongafechas_2 = $Busca_temp['ongafechas_input_2']; 
          $this->ongahorad = $Busca_temp['ongahorad']; 
          $tmp_pos = strpos($this->ongahorad, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongahorad))
          {
              $this->ongahorad = substr($this->ongahorad, 0, $tmp_pos);
          }
          $this->onganodos = $Busca_temp['onganodos']; 
          $tmp_pos = strpos($this->onganodos, "##@@");
          if ($tmp_pos !== false && !is_array($this->onganodos))
          {
              $this->onganodos = substr($this->onganodos, 0, $tmp_pos);
          }
          $this->ongaidonegas = $Busca_temp['ongaidonegas']; 
          $tmp_pos = strpos($this->ongaidonegas, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongaidonegas))
          {
              $this->ongaidonegas = substr($this->ongaidonegas, 0, $tmp_pos);
          }
          $this->ongavirhosts = $Busca_temp['ongavirhosts']; 
          $tmp_pos = strpos($this->ongavirhosts, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongavirhosts))
          {
              $this->ongavirhosts = substr($this->ongavirhosts, 0, $tmp_pos);
          }
          $this->ongacadenas = $Busca_temp['ongacadenas']; 
          $tmp_pos = strpos($this->ongacadenas, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongacadenas))
          {
              $this->ongacadenas = substr($this->ongacadenas, 0, $tmp_pos);
          }
          $this->ongaarchivs = $Busca_temp['ongaarchivs']; 
          $tmp_pos = strpos($this->ongaarchivs, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongaarchivs))
          {
              $this->ongaarchivs = substr($this->ongaarchivs, 0, $tmp_pos);
          }
          $this->ongafechains = $Busca_temp['ongafechains']; 
          $tmp_pos = strpos($this->ongafechains, "##@@");
          if ($tmp_pos !== false && !is_array($this->ongafechains))
          {
              $this->ongafechains = substr($this->ongafechains, 0, $tmp_pos);
          }
          $this->ongafechains_2 = $Busca_temp['ongafechains_input_2']; 
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT ongacodigon, str_replace (convert(char(10),ongafechas,102), '.', '-') + ' ' + convert(char(8),ongafechas,20), ongahorad, onganodos, ongaidonegas, ongavirhosts, ongacadenas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT ongacodigon, ongafechas, ongahorad, onganodos, ongaidonegas, ongavirhosts, ongacadenas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT ongacodigon, convert(char(23),ongafechas,121), ongahorad, onganodos, ongaidonegas, ongavirhosts, ongacadenas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT ongacodigon, ongafechas, ongahorad, onganodos, ongaidonegas, ongavirhosts, ongacadenas from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT ongacodigon, EXTEND(ongafechas, YEAR TO DAY), ongahorad, onganodos, ongaidonegas, ongavirhosts, ongacadenas from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT ongacodigon, ongafechas, ongahorad, onganodos, ongaidonegas, ongavirhosts, ongacadenas from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->ongacodigon = $rs->fields[0] ;  
         $this->ongacodigon = (string)$this->ongacodigon;
         $this->ongafechas = $rs->fields[1] ;  
         $this->ongahorad = $rs->fields[2] ;  
         $this->onganodos = $rs->fields[3] ;  
         $this->ongaidonegas = $rs->fields[4] ;  
         $this->ongavirhosts = $rs->fields[5] ;  
         $this->ongacadenas = $rs->fields[6] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
                { 
                    $NM_func_exp = "NM_sub_cons_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
                else 
                { 
                    $NM_func_exp = "NM_export_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
            } 
         } 
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['embutida'])
      { 
          $objWriter = new PHPExcel_Writer_Excel2007($this->Xls_dados);
          $objWriter->save($this->Xls_f);
      } 
      else 
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
      } 
      $rs->Close();
   }
   //----- ongacodigon
   function NM_export_ongacodigon()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->ongacodigon))
         {
             $this->ongacodigon = sc_convert_encoding($this->ongacodigon, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ongacodigon))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('###0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ongacodigon);
         $this->Xls_col++;
   }
   //----- ongafechas
   function NM_export_ongafechas()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ongafechas = substr($this->ongafechas, 0, 10);
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ongafechas) || $this->ongafechas == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ongafechas, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ongafechas);
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ongahorad
   function NM_export_ongahorad()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ongahorad = html_entity_decode($this->ongahorad, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongahorad = strip_tags($this->ongahorad);
         if (!NM_is_utf8($this->ongahorad))
         {
             $this->ongahorad = sc_convert_encoding($this->ongahorad, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ongahorad, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- onganodos
   function NM_export_onganodos()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->onganodos = html_entity_decode($this->onganodos, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->onganodos = strip_tags($this->onganodos);
         if (!NM_is_utf8($this->onganodos))
         {
             $this->onganodos = sc_convert_encoding($this->onganodos, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->onganodos, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ongaidonegas
   function NM_export_ongaidonegas()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ongaidonegas = html_entity_decode($this->ongaidonegas, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongaidonegas = strip_tags($this->ongaidonegas);
         if (!NM_is_utf8($this->ongaidonegas))
         {
             $this->ongaidonegas = sc_convert_encoding($this->ongaidonegas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ongaidonegas, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ongavirhosts
   function NM_export_ongavirhosts()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ongavirhosts = html_entity_decode($this->ongavirhosts, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongavirhosts = strip_tags($this->ongavirhosts);
         if (!NM_is_utf8($this->ongavirhosts))
         {
             $this->ongavirhosts = sc_convert_encoding($this->ongavirhosts, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ongavirhosts, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ongacadenas
   function NM_export_ongacadenas()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ongacadenas = html_entity_decode($this->ongacadenas, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongacadenas = strip_tags($this->ongacadenas);
         if (!NM_is_utf8($this->ongacadenas))
         {
             $this->ongacadenas = sc_convert_encoding($this->ongacadenas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ongacadenas, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ongacodigon
   function NM_sub_cons_ongacodigon()
   {
         if (!NM_is_utf8($this->ongacodigon))
         {
             $this->ongacodigon = sc_convert_encoding($this->ongacodigon, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ongacodigon;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "###0";
         $this->Xls_col++;
   }
   //----- ongafechas
   function NM_sub_cons_ongafechas()
   {
         $this->ongafechas = substr($this->ongafechas, 0, 10);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ongafechas;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "data";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = $this->SC_date_conf_region;
         $this->Xls_col++;
   }
   //----- ongahorad
   function NM_sub_cons_ongahorad()
   {
         $this->ongahorad = html_entity_decode($this->ongahorad, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongahorad = strip_tags($this->ongahorad);
         if (!NM_is_utf8($this->ongahorad))
         {
             $this->ongahorad = sc_convert_encoding($this->ongahorad, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ongahorad;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- onganodos
   function NM_sub_cons_onganodos()
   {
         $this->onganodos = html_entity_decode($this->onganodos, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->onganodos = strip_tags($this->onganodos);
         if (!NM_is_utf8($this->onganodos))
         {
             $this->onganodos = sc_convert_encoding($this->onganodos, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->onganodos;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- ongaidonegas
   function NM_sub_cons_ongaidonegas()
   {
         $this->ongaidonegas = html_entity_decode($this->ongaidonegas, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongaidonegas = strip_tags($this->ongaidonegas);
         if (!NM_is_utf8($this->ongaidonegas))
         {
             $this->ongaidonegas = sc_convert_encoding($this->ongaidonegas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ongaidonegas;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- ongavirhosts
   function NM_sub_cons_ongavirhosts()
   {
         $this->ongavirhosts = html_entity_decode($this->ongavirhosts, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongavirhosts = strip_tags($this->ongavirhosts);
         if (!NM_is_utf8($this->ongavirhosts))
         {
             $this->ongavirhosts = sc_convert_encoding($this->ongavirhosts, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ongavirhosts;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- ongacadenas
   function NM_sub_cons_ongacadenas()
   {
         $this->ongacadenas = html_entity_decode($this->ongacadenas, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ongacadenas = strip_tags($this->ongacadenas);
         if (!NM_is_utf8($this->ongacadenas))
         {
             $this->ongacadenas = sc_convert_encoding($this->ongacadenas, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ongacadenas;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_onegatelogs'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> <?php echo $this->Ini->Nm_lang['lang_tbl_onegatelogs'] ?> :: Excel</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XLS</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_onegatelogs_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_onegatelogs"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}

?>
