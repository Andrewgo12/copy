<?php
class form_publicaciones_grid_edit_form extends form_publicaciones_grid_edit_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " " . $this->Ini->Nm_lang['lang_tbl_publicaciones'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " " . $this->Ini->Nm_lang['lang_tbl_publicaciones'] . ""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
header("X-XSS-Protection: 0");
?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></SCRIPT>
<input type="hidden" id="sc-mobile-lock" value='true' />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <style type="text/css">
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_desc ?>'], 
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_asc ?>']{opacity:1!important;} 
   .scFormLabelOddMult a img{opacity:0;transition:all .2s;} 
   .scFormLabelOddMult:HOVER a img{opacity:1;transition:all .2s;} 
 </style>
 <style type="text/css">
  #quicksearchph_t {
   position: relative;
  }
  #quicksearchph_t img {
   position: absolute;
   top: 0;
   right: 0;
  }
 </style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
 <style type="text/css">
  .scSpin_publpuerton__obj {
   border: 0 !important;
   margin: 0 20px 0 0 !important;
  }
 </style>
<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_publicaciones_grid_edit/form_publicaciones_grid_edit_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_publicaciones_grid_edit_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_binicio_off = "<?php echo $this->arr_buttons['binicio_off']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bavanca_off = "<?php echo $this->arr_buttons['bavanca_off']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bretorna_off = "<?php echo $this->arr_buttons['bretorna_off']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_bfinal_off  = "<?php echo $this->arr_buttons['bfinal_off']['type']; ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).show();
       $("#sc_b_ini_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ini_" + str_pos).show();
       $("#gbl_sc_b_ini_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).show();
       $("#sc_b_ret_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ret_" + str_pos).show();
       $("#gbl_sc_b_ret_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).hide();
       $("#sc_b_ini_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ini_" + str_pos).hide();
       $("#gbl_sc_b_ini_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).hide();
       $("#sc_b_ret_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ret_" + str_pos).hide();
       $("#gbl_sc_b_ret_off_" + str_pos).show();
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).show();
       $("#sc_b_fim_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_fim_" + str_pos).show();
       $("#gbl_sc_b_fim_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).show();
       $("#sc_b_avc_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_avc_" + str_pos).show();
       $("#gbl_sc_b_avc_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).hide();
       $("#sc_b_fim_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_fim_" + str_pos).hide();
       $("#gbl_sc_b_fim_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).hide();
       $("#sc_b_avc_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_avc_" + str_pos).hide();
       $("#gbl_sc_b_avc_off_" + str_pos).show();
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_publicaciones_grid_edit_jquery.php');

?>
var applicationKeys = "";
applicationKeys += "ctrl+shift+right";
applicationKeys += ",";
applicationKeys += "ctrl+shift+left";
applicationKeys += ",";
applicationKeys += "ctrl+right";
applicationKeys += ",";
applicationKeys += "ctrl+left";
applicationKeys += ",";
applicationKeys += "alt+q";
applicationKeys += ",";
applicationKeys += "escape";
applicationKeys += ",";
applicationKeys += "ctrl+enter";
applicationKeys += ",";
applicationKeys += "ctrl+s";
applicationKeys += ",";
applicationKeys += "ctrl+delete";
applicationKeys += ",";
applicationKeys += "f1";
applicationKeys += ",";
applicationKeys += "ctrl+shift+c";

var hotkeyList = "";

function execHotKey(e, h) {
    var hotkey_fired = false;
  switch (true) {
    case (["ctrl+shift+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_fim");
      break;
    case (["ctrl+shift+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ini");
      break;
    case (["ctrl+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ava");
      break;
    case (["ctrl+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ret");
      break;
    case (["alt+q"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_sai");
      break;
    case (["escape"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_cnl");
      break;
    case (["ctrl+enter"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_inc");
      break;
    case (["ctrl+s"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_alt");
      break;
    case (["ctrl+delete"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_exc");
      break;
    case (["f1"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_webh");
      break;
    case (["ctrl+shift+c"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_copy");
      break;
    default:
      return true;
  }
  if (hotkey_fired) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}
</script>
<script type="text/javascript" src="../_lib/lib/js/hotkeys.inc.js"></script>
<script type="text/javascript" src="../_lib/lib/js/hotkeys_setup.js"></script>
<script type="text/javascript">
function process_hotkeys(hotkey)
{
  if (hotkey == "sys_format_fim") {
    if (typeof scBtnFn_sys_format_fim !== "undefined" && typeof scBtnFn_sys_format_fim === "function") {
      scBtnFn_sys_format_fim();
        return true;
    }
  }
  if (hotkey == "sys_format_ini") {
    if (typeof scBtnFn_sys_format_ini !== "undefined" && typeof scBtnFn_sys_format_ini === "function") {
      scBtnFn_sys_format_ini();
        return true;
    }
  }
  if (hotkey == "sys_format_ava") {
    if (typeof scBtnFn_sys_format_ava !== "undefined" && typeof scBtnFn_sys_format_ava === "function") {
      scBtnFn_sys_format_ava();
        return true;
    }
  }
  if (hotkey == "sys_format_ret") {
    if (typeof scBtnFn_sys_format_ret !== "undefined" && typeof scBtnFn_sys_format_ret === "function") {
      scBtnFn_sys_format_ret();
        return true;
    }
  }
  if (hotkey == "sys_format_sai") {
    if (typeof scBtnFn_sys_format_sai !== "undefined" && typeof scBtnFn_sys_format_sai === "function") {
      scBtnFn_sys_format_sai();
        return true;
    }
  }
  if (hotkey == "sys_format_cnl") {
    if (typeof scBtnFn_sys_format_cnl !== "undefined" && typeof scBtnFn_sys_format_cnl === "function") {
      scBtnFn_sys_format_cnl();
        return true;
    }
  }
  if (hotkey == "sys_format_inc") {
    if (typeof scBtnFn_sys_format_inc !== "undefined" && typeof scBtnFn_sys_format_inc === "function") {
      scBtnFn_sys_format_inc();
        return true;
    }
  }
  if (hotkey == "sys_format_alt") {
    if (typeof scBtnFn_sys_format_alt !== "undefined" && typeof scBtnFn_sys_format_alt === "function") {
      scBtnFn_sys_format_alt();
        return true;
    }
  }
  if (hotkey == "sys_format_exc") {
    if (typeof scBtnFn_sys_format_exc !== "undefined" && typeof scBtnFn_sys_format_exc === "function") {
      scBtnFn_sys_format_exc();
        return true;
    }
  }
  if (hotkey == "sys_format_webh") {
    if (typeof scBtnFn_sys_format_webh !== "undefined" && typeof scBtnFn_sys_format_webh === "function") {
      scBtnFn_sys_format_webh();
        return true;
    }
  }
  if (hotkey == "sys_format_copy") {
    if (typeof scBtnFn_sys_format_copy !== "undefined" && typeof scBtnFn_sys_format_copy === "function") {
      scBtnFn_sys_format_copy();
        return true;
    }
  }
    return false;
}

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {


  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
     scQuickSearchInit(false, '');
     if (document.getElementById('SC_fast_search_t')) {
         scQuickSearchKeyUp('t', null);
     }
     scQSInit = false;
   });
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchInit(bPosOnly, sPos) {
     if (!bPosOnly) {
       if (document.getElementById('SC_fast_search_t')) {
           if ('' == sPos || 't' == sPos) {
               scQuickSearchSize('SC_fast_search_t', 'SC_fast_search_close_t', 'SC_fast_search_submit_t', 'quicksearchph_t');
           }
       }
     }
   }
   function scQuickSearchSize(sIdInput, sIdClose, sIdSubmit, sPlaceHolder) {
     var oInput = $('#' + sIdInput),
         oClose = $('#' + sIdClose),
         oSubmit = $('#' + sIdSubmit),
         oPlace = $('#' + sPlaceHolder),
         iInputP = parseInt(oInput.css('padding-right')) || 0,
         iInputB = parseInt(oInput.css('border-right-width')) || 0,
         iInputW = oInput.outerWidth(),
         iPlaceW = oPlace.outerWidth(),
         oInputO = oInput.offset(),
         oPlaceO = oPlace.offset(),
         iNewRight;
     iNewRight = (iPlaceW - iInputW) - (oInputO.left - oPlaceO.left) + iInputB + 1;
     oInput.css({
       'height': Math.max(oInput.height(), 16) + 'px',
       'padding-right': iInputP + 16 + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px'
     });
     oClose.css({
       'right': iNewRight + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px',
       'cursor': 'pointer'
     });
     oSubmit.css({
       'right': iNewRight + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px',
       'cursor': 'pointer'
     });
   }
   function scQuickSearchKeyUp(sPos, e) {
     if ('' != scQSInitVal && $('#SC_fast_search_' + sPos).val() == scQSInitVal && scQSInit) {
       $('#SC_fast_search_close_' + sPos).show();
       $('#SC_fast_search_submit_' + sPos).hide();
     }
     else {
       $('#SC_fast_search_close_' + sPos).hide();
       $('#SC_fast_search_submit_' + sPos).show();
     }
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
     }
   }
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_publicaciones_grid_edit_js0.php");
?>
<script type="text/javascript"> 
  sc_quant_excl = <?php echo count($sc_check_excl); ?>; 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="script_case_session" value="<?php  echo $this->form_encode_input(session_id()); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_publicaciones_grid_edit'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_publicaciones_grid_edit'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<script type="text/javascript">
var scMsgDefTitle = "<?php echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl']; ?>";
var scMsgDefButton = "Ok";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->page; ?>";
</script>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['mostra_cab'] != "N") && (!$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard'] || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['compact_mode'] || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['maximized']))
  {
?>
<tr><td>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " " . $this->Ini->Nm_lang['lang_tbl_publicaciones'] . ""; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " " . $this->Ini->Nm_lang['lang_tbl_publicaciones'] . ""; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"></div>
</div></td></tr>
<?php
  }
?>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['fast_search'][2] : "";
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <input type="hidden" name="nmgp_fast_search_t" value="SC_all_Cmp">
          <input type="hidden" name="nmgp_cond_fast_search_t" value="qp">
          <script type="text/javascript">var scQSInitVal = "<?php echo $OPC_dat ?>";</script>
          <span id="quicksearchph_t">
           <input type="text" id="SC_fast_search_t" class="scFormToolbarInput" style="vertical-align: middle" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">
           <img style="position: absolute; display: none; height: 16px; width: 16px" id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
           <img style="position: absolute; display: none; height: 16px; width: 16px" id="SC_fast_search_submit_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
          </span>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-1", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-2", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-3", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-4", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-5", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-6", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-7", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-8", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-9", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-10", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
?>
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;">   <tr>
<?php
$orderColName = '';
$orderColOrient = '';
?>
    <script type="text/javascript">
     var orderImgAsc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc ?>";
     var orderImgDesc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc ?>";
     var orderImgNone = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort ?>";
     var orderColName = "";
     function scSetOrderColumn(clickedColumn) {
      $(".sc-ui-img-order-column").attr("src", orderImgNone);
      if (clickedColumn != orderColName) {
       orderColName = clickedColumn;
       orderColOrient = orderImgAsc;
      }
      else if ("" != orderColName) {
       orderColOrient = orderColOrient == orderImgAsc ? orderImgDesc : orderImgAsc;
      }
      else {
       orderColName = "";
       orderColOrient = "";
      }
      $("#sc-id-img-order-" + orderColName).attr("src", orderColOrient);
     }
    </script>
<?php
     $Col_span = "";


       if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") { $Col_span = " colspan=2"; }
    if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { $Col_span = " colspan=2"; }
 ?>

    <TD class="scFormLabelOddMult" style="display: none;" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="scFormLabelOddMult"  width="10">  </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="scFormLabelOddMult"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ((!isset($this->nmgp_cmp_hidden['publcodigon_']) || $this->nmgp_cmp_hidden['publcodigon_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['publcodigon_'])) {
          $this->nm_new_label['publcodigon_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publcodigon'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publcodigon__label" id="hidden_field_label_publcodigon_" style="<?php echo $sStyleHidden_publcodigon_; ?>" > <?php echo $this->nm_new_label['publcodigon_'] ?> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['cliecodigon_']) && $this->nmgp_cmp_hidden['cliecodigon_'] == 'off') { $sStyleHidden_cliecodigon_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['cliecodigon_']) || $this->nmgp_cmp_hidden['cliecodigon_'] == 'on') {
      if (!isset($this->nm_new_label['cliecodigon_'])) {
          $this->nm_new_label['cliecodigon_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_cliecodigon'] . ""; } ?>

    <TD class="scFormLabelOddMult css_cliecodigon__label" id="hidden_field_label_cliecodigon_" style="<?php echo $sStyleHidden_cliecodigon_; ?>" > <?php echo $this->nm_new_label['cliecodigon_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publgrupusrs_']) && $this->nmgp_cmp_hidden['publgrupusrs_'] == 'off') { $sStyleHidden_publgrupusrs_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publgrupusrs_']) || $this->nmgp_cmp_hidden['publgrupusrs_'] == 'on') {
      if (!isset($this->nm_new_label['publgrupusrs_'])) {
          $this->nm_new_label['publgrupusrs_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publgrupusrs'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publgrupusrs__label" id="hidden_field_label_publgrupusrs_" style="<?php echo $sStyleHidden_publgrupusrs_; ?>" > <?php echo $this->nm_new_label['publgrupusrs_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['aplicodigon_']) && $this->nmgp_cmp_hidden['aplicodigon_'] == 'off') { $sStyleHidden_aplicodigon_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['aplicodigon_']) || $this->nmgp_cmp_hidden['aplicodigon_'] == 'on') {
      if (!isset($this->nm_new_label['aplicodigon_'])) {
          $this->nm_new_label['aplicodigon_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_aplicodigon'] . ""; } ?>

    <TD class="scFormLabelOddMult css_aplicodigon__label" id="hidden_field_label_aplicodigon_" style="<?php echo $sStyleHidden_aplicodigon_; ?>" > <?php echo $this->nm_new_label['aplicodigon_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publpuerton_']) && $this->nmgp_cmp_hidden['publpuerton_'] == 'off') { $sStyleHidden_publpuerton_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publpuerton_']) || $this->nmgp_cmp_hidden['publpuerton_'] == 'on') {
      if (!isset($this->nm_new_label['publpuerton_'])) {
          $this->nm_new_label['publpuerton_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publpuerton'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publpuerton__label" id="hidden_field_label_publpuerton_" style="<?php echo $sStyleHidden_publpuerton_; ?>" > <?php echo $this->nm_new_label['publpuerton_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['meaucodigon_']) && $this->nmgp_cmp_hidden['meaucodigon_'] == 'off') { $sStyleHidden_meaucodigon_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['meaucodigon_']) || $this->nmgp_cmp_hidden['meaucodigon_'] == 'on') {
      if (!isset($this->nm_new_label['meaucodigon_'])) {
          $this->nm_new_label['meaucodigon_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_meaucodigon'] . ""; } ?>

    <TD class="scFormLabelOddMult css_meaucodigon__label" id="hidden_field_label_meaucodigon_" style="<?php echo $sStyleHidden_meaucodigon_; ?>" > <?php echo $this->nm_new_label['meaucodigon_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publurls_']) && $this->nmgp_cmp_hidden['publurls_'] == 'off') { $sStyleHidden_publurls_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publurls_']) || $this->nmgp_cmp_hidden['publurls_'] == 'on') {
      if (!isset($this->nm_new_label['publurls_'])) {
          $this->nm_new_label['publurls_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publurls'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publurls__label" id="hidden_field_label_publurls_" style="<?php echo $sStyleHidden_publurls_; ?>" > <?php echo $this->nm_new_label['publurls_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publipss_']) && $this->nmgp_cmp_hidden['publipss_'] == 'off') { $sStyleHidden_publipss_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publipss_']) || $this->nmgp_cmp_hidden['publipss_'] == 'on') {
      if (!isset($this->nm_new_label['publipss_'])) {
          $this->nm_new_label['publipss_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publipss'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publipss__label" id="hidden_field_label_publipss_" style="<?php echo $sStyleHidden_publipss_; ?>" > <?php echo $this->nm_new_label['publipss_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publhorarios_']) && $this->nmgp_cmp_hidden['publhorarios_'] == 'off') { $sStyleHidden_publhorarios_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publhorarios_']) || $this->nmgp_cmp_hidden['publhorarios_'] == 'on') {
      if (!isset($this->nm_new_label['publhorarios_'])) {
          $this->nm_new_label['publhorarios_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publhorarios'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publhorarios__label" id="hidden_field_label_publhorarios_" style="<?php echo $sStyleHidden_publhorarios_; ?>" > <?php echo $this->nm_new_label['publhorarios_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['usuacodigos_']) && $this->nmgp_cmp_hidden['usuacodigos_'] == 'off') { $sStyleHidden_usuacodigos_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['usuacodigos_']) || $this->nmgp_cmp_hidden['usuacodigos_'] == 'on') {
      if (!isset($this->nm_new_label['usuacodigos_'])) {
          $this->nm_new_label['usuacodigos_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_usuacodigos'] . ""; } ?>

    <TD class="scFormLabelOddMult css_usuacodigos__label" id="hidden_field_label_usuacodigos_" style="<?php echo $sStyleHidden_usuacodigos_; ?>" > <?php echo $this->nm_new_label['usuacodigos_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publfecregd_']) && $this->nmgp_cmp_hidden['publfecregd_'] == 'off') { $sStyleHidden_publfecregd_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publfecregd_']) || $this->nmgp_cmp_hidden['publfecregd_'] == 'on') {
      if (!isset($this->nm_new_label['publfecregd_'])) {
          $this->nm_new_label['publfecregd_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publfecregd'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publfecregd__label" id="hidden_field_label_publfecregd_" style="<?php echo $sStyleHidden_publfecregd_; ?>" > <?php echo $this->nm_new_label['publfecregd_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['publestados_']) && $this->nmgp_cmp_hidden['publestados_'] == 'off') { $sStyleHidden_publestados_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['publestados_']) || $this->nmgp_cmp_hidden['publestados_'] == 'on') {
      if (!isset($this->nm_new_label['publestados_'])) {
          $this->nm_new_label['publestados_'] = "" . $this->Ini->Nm_lang['lang_publicaciones_fld_publestados'] . ""; } ?>

    <TD class="scFormLabelOddMult css_publestados__label" id="hidden_field_label_publestados_" style="<?php echo $sStyleHidden_publestados_; ?>" > <?php echo $this->nm_new_label['publestados_'] ?> </TD>
   <?php } ?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert; 
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_publicaciones_grid_edit);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_publicaciones_grid_edit = $this->form_vert_form_publicaciones_grid_edit;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_publicaciones_grid_edit))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['publcodigon_']))
           {
               $this->nmgp_cmp_readonly['publcodigon_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['usuacodigos_']))
           {
               $this->nmgp_cmp_readonly['usuacodigos_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['publfecregd_']))
           {
               $this->nmgp_cmp_readonly['publfecregd_'] = 'on';
           }
   foreach ($this->form_vert_form_publicaciones_grid_edit as $sc_seq_vert => $sc_lixo)
   {
       $this->loadRecordState($sc_seq_vert);
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['publcodigon_'] = true;
           $this->nmgp_cmp_readonly['cliecodigon_'] = true;
           $this->nmgp_cmp_readonly['publgrupusrs_'] = true;
           $this->nmgp_cmp_readonly['aplicodigon_'] = true;
           $this->nmgp_cmp_readonly['publpuerton_'] = true;
           $this->nmgp_cmp_readonly['meaucodigon_'] = true;
           $this->nmgp_cmp_readonly['publurls_'] = true;
           $this->nmgp_cmp_readonly['publipss_'] = true;
           $this->nmgp_cmp_readonly['publhorarios_'] = true;
           $this->nmgp_cmp_readonly['usuacodigos_'] = true;
           $this->nmgp_cmp_readonly['publfecregd_'] = true;
           $this->nmgp_cmp_readonly['publestados_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['publcodigon_']) || $this->nmgp_cmp_readonly['publcodigon_'] != "on") {$this->nmgp_cmp_readonly['publcodigon_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['cliecodigon_']) || $this->nmgp_cmp_readonly['cliecodigon_'] != "on") {$this->nmgp_cmp_readonly['cliecodigon_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publgrupusrs_']) || $this->nmgp_cmp_readonly['publgrupusrs_'] != "on") {$this->nmgp_cmp_readonly['publgrupusrs_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['aplicodigon_']) || $this->nmgp_cmp_readonly['aplicodigon_'] != "on") {$this->nmgp_cmp_readonly['aplicodigon_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publpuerton_']) || $this->nmgp_cmp_readonly['publpuerton_'] != "on") {$this->nmgp_cmp_readonly['publpuerton_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['meaucodigon_']) || $this->nmgp_cmp_readonly['meaucodigon_'] != "on") {$this->nmgp_cmp_readonly['meaucodigon_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publurls_']) || $this->nmgp_cmp_readonly['publurls_'] != "on") {$this->nmgp_cmp_readonly['publurls_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publipss_']) || $this->nmgp_cmp_readonly['publipss_'] != "on") {$this->nmgp_cmp_readonly['publipss_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publhorarios_']) || $this->nmgp_cmp_readonly['publhorarios_'] != "on") {$this->nmgp_cmp_readonly['publhorarios_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['usuacodigos_']) || $this->nmgp_cmp_readonly['usuacodigos_'] != "on") {$this->nmgp_cmp_readonly['usuacodigos_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publfecregd_']) || $this->nmgp_cmp_readonly['publfecregd_'] != "on") {$this->nmgp_cmp_readonly['publfecregd_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['publestados_']) || $this->nmgp_cmp_readonly['publestados_'] != "on") {$this->nmgp_cmp_readonly['publestados_'] = false;}
       }
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
        $this->publcodigon_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publcodigon_']; 
       $publcodigon_ = $this->publcodigon_; 
       $sStyleHidden_publcodigon_ = '';
       if (isset($sCheckRead_publcodigon_))
       {
           unset($sCheckRead_publcodigon_);
       }
       if (isset($this->nmgp_cmp_readonly['publcodigon_']))
       {
           $sCheckRead_publcodigon_ = $this->nmgp_cmp_readonly['publcodigon_'];
       }
       if (isset($this->nmgp_cmp_hidden['publcodigon_']) && $this->nmgp_cmp_hidden['publcodigon_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publcodigon_']);
           $sStyleHidden_publcodigon_ = 'display: none;';
       }
       $bTestReadOnly_publcodigon_ = true;
       $sStyleReadLab_publcodigon_ = 'display: none;';
       $sStyleReadInp_publcodigon_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["publcodigon_"]) &&  $this->nmgp_cmp_readonly["publcodigon_"] == "on"))
       {
           $bTestReadOnly_publcodigon_ = false;
           unset($this->nmgp_cmp_readonly['publcodigon_']);
           $sStyleReadLab_publcodigon_ = '';
           $sStyleReadInp_publcodigon_ = 'display: none;';
       }
       $this->cliecodigon_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['cliecodigon_']; 
       $cliecodigon_ = $this->cliecodigon_; 
       $sStyleHidden_cliecodigon_ = '';
       if (isset($sCheckRead_cliecodigon_))
       {
           unset($sCheckRead_cliecodigon_);
       }
       if (isset($this->nmgp_cmp_readonly['cliecodigon_']))
       {
           $sCheckRead_cliecodigon_ = $this->nmgp_cmp_readonly['cliecodigon_'];
       }
       if (isset($this->nmgp_cmp_hidden['cliecodigon_']) && $this->nmgp_cmp_hidden['cliecodigon_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['cliecodigon_']);
           $sStyleHidden_cliecodigon_ = 'display: none;';
       }
       $bTestReadOnly_cliecodigon_ = true;
       $sStyleReadLab_cliecodigon_ = 'display: none;';
       $sStyleReadInp_cliecodigon_ = '';
       if (isset($this->nmgp_cmp_readonly['cliecodigon_']) && $this->nmgp_cmp_readonly['cliecodigon_'] == 'on')
       {
           $bTestReadOnly_cliecodigon_ = false;
           unset($this->nmgp_cmp_readonly['cliecodigon_']);
           $sStyleReadLab_cliecodigon_ = '';
           $sStyleReadInp_cliecodigon_ = 'display: none;';
       }
       $this->publgrupusrs_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publgrupusrs_']; 
       $publgrupusrs_ = $this->publgrupusrs_; 
       $publgrupusrs__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $publgrupusrs_);
       $publgrupusrs__val = $publgrupusrs__tmp;
       $sStyleHidden_publgrupusrs_ = '';
       if (isset($sCheckRead_publgrupusrs_))
       {
           unset($sCheckRead_publgrupusrs_);
       }
       if (isset($this->nmgp_cmp_readonly['publgrupusrs_']))
       {
           $sCheckRead_publgrupusrs_ = $this->nmgp_cmp_readonly['publgrupusrs_'];
       }
       if (isset($this->nmgp_cmp_hidden['publgrupusrs_']) && $this->nmgp_cmp_hidden['publgrupusrs_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publgrupusrs_']);
           $sStyleHidden_publgrupusrs_ = 'display: none;';
       }
       $bTestReadOnly_publgrupusrs_ = true;
       $sStyleReadLab_publgrupusrs_ = 'display: none;';
       $sStyleReadInp_publgrupusrs_ = '';
       if (isset($this->nmgp_cmp_readonly['publgrupusrs_']) && $this->nmgp_cmp_readonly['publgrupusrs_'] == 'on')
       {
           $bTestReadOnly_publgrupusrs_ = false;
           unset($this->nmgp_cmp_readonly['publgrupusrs_']);
           $sStyleReadLab_publgrupusrs_ = '';
           $sStyleReadInp_publgrupusrs_ = 'display: none;';
       }
       $this->aplicodigon_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['aplicodigon_']; 
       $aplicodigon_ = $this->aplicodigon_; 
       $sStyleHidden_aplicodigon_ = '';
       if (isset($sCheckRead_aplicodigon_))
       {
           unset($sCheckRead_aplicodigon_);
       }
       if (isset($this->nmgp_cmp_readonly['aplicodigon_']))
       {
           $sCheckRead_aplicodigon_ = $this->nmgp_cmp_readonly['aplicodigon_'];
       }
       if (isset($this->nmgp_cmp_hidden['aplicodigon_']) && $this->nmgp_cmp_hidden['aplicodigon_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['aplicodigon_']);
           $sStyleHidden_aplicodigon_ = 'display: none;';
       }
       $bTestReadOnly_aplicodigon_ = true;
       $sStyleReadLab_aplicodigon_ = 'display: none;';
       $sStyleReadInp_aplicodigon_ = '';
       if (isset($this->nmgp_cmp_readonly['aplicodigon_']) && $this->nmgp_cmp_readonly['aplicodigon_'] == 'on')
       {
           $bTestReadOnly_aplicodigon_ = false;
           unset($this->nmgp_cmp_readonly['aplicodigon_']);
           $sStyleReadLab_aplicodigon_ = '';
           $sStyleReadInp_aplicodigon_ = 'display: none;';
       }
       $this->publpuerton_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publpuerton_']; 
       $publpuerton_ = $this->publpuerton_; 
       $sStyleHidden_publpuerton_ = '';
       if (isset($sCheckRead_publpuerton_))
       {
           unset($sCheckRead_publpuerton_);
       }
       if (isset($this->nmgp_cmp_readonly['publpuerton_']))
       {
           $sCheckRead_publpuerton_ = $this->nmgp_cmp_readonly['publpuerton_'];
       }
       if (isset($this->nmgp_cmp_hidden['publpuerton_']) && $this->nmgp_cmp_hidden['publpuerton_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publpuerton_']);
           $sStyleHidden_publpuerton_ = 'display: none;';
       }
       $bTestReadOnly_publpuerton_ = true;
       $sStyleReadLab_publpuerton_ = 'display: none;';
       $sStyleReadInp_publpuerton_ = '';
       if (isset($this->nmgp_cmp_readonly['publpuerton_']) && $this->nmgp_cmp_readonly['publpuerton_'] == 'on')
       {
           $bTestReadOnly_publpuerton_ = false;
           unset($this->nmgp_cmp_readonly['publpuerton_']);
           $sStyleReadLab_publpuerton_ = '';
           $sStyleReadInp_publpuerton_ = 'display: none;';
       }
       $this->meaucodigon_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['meaucodigon_']; 
       $meaucodigon_ = $this->meaucodigon_; 
       $sStyleHidden_meaucodigon_ = '';
       if (isset($sCheckRead_meaucodigon_))
       {
           unset($sCheckRead_meaucodigon_);
       }
       if (isset($this->nmgp_cmp_readonly['meaucodigon_']))
       {
           $sCheckRead_meaucodigon_ = $this->nmgp_cmp_readonly['meaucodigon_'];
       }
       if (isset($this->nmgp_cmp_hidden['meaucodigon_']) && $this->nmgp_cmp_hidden['meaucodigon_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['meaucodigon_']);
           $sStyleHidden_meaucodigon_ = 'display: none;';
       }
       $bTestReadOnly_meaucodigon_ = true;
       $sStyleReadLab_meaucodigon_ = 'display: none;';
       $sStyleReadInp_meaucodigon_ = '';
       if (isset($this->nmgp_cmp_readonly['meaucodigon_']) && $this->nmgp_cmp_readonly['meaucodigon_'] == 'on')
       {
           $bTestReadOnly_meaucodigon_ = false;
           unset($this->nmgp_cmp_readonly['meaucodigon_']);
           $sStyleReadLab_meaucodigon_ = '';
           $sStyleReadInp_meaucodigon_ = 'display: none;';
       }
       $this->publurls_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publurls_']; 
       $publurls_ = $this->publurls_; 
       $sStyleHidden_publurls_ = '';
       if (isset($sCheckRead_publurls_))
       {
           unset($sCheckRead_publurls_);
       }
       if (isset($this->nmgp_cmp_readonly['publurls_']))
       {
           $sCheckRead_publurls_ = $this->nmgp_cmp_readonly['publurls_'];
       }
       if (isset($this->nmgp_cmp_hidden['publurls_']) && $this->nmgp_cmp_hidden['publurls_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publurls_']);
           $sStyleHidden_publurls_ = 'display: none;';
       }
       $bTestReadOnly_publurls_ = true;
       $sStyleReadLab_publurls_ = 'display: none;';
       $sStyleReadInp_publurls_ = '';
       if (isset($this->nmgp_cmp_readonly['publurls_']) && $this->nmgp_cmp_readonly['publurls_'] == 'on')
       {
           $bTestReadOnly_publurls_ = false;
           unset($this->nmgp_cmp_readonly['publurls_']);
           $sStyleReadLab_publurls_ = '';
           $sStyleReadInp_publurls_ = 'display: none;';
       }
       $this->publipss_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publipss_']; 
       $publipss_ = $this->publipss_; 
       $publipss__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $publipss_);
       $publipss__val = $publipss__tmp;
       $sStyleHidden_publipss_ = '';
       if (isset($sCheckRead_publipss_))
       {
           unset($sCheckRead_publipss_);
       }
       if (isset($this->nmgp_cmp_readonly['publipss_']))
       {
           $sCheckRead_publipss_ = $this->nmgp_cmp_readonly['publipss_'];
       }
       if (isset($this->nmgp_cmp_hidden['publipss_']) && $this->nmgp_cmp_hidden['publipss_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publipss_']);
           $sStyleHidden_publipss_ = 'display: none;';
       }
       $bTestReadOnly_publipss_ = true;
       $sStyleReadLab_publipss_ = 'display: none;';
       $sStyleReadInp_publipss_ = '';
       if (isset($this->nmgp_cmp_readonly['publipss_']) && $this->nmgp_cmp_readonly['publipss_'] == 'on')
       {
           $bTestReadOnly_publipss_ = false;
           unset($this->nmgp_cmp_readonly['publipss_']);
           $sStyleReadLab_publipss_ = '';
           $sStyleReadInp_publipss_ = 'display: none;';
       }
       $this->publhorarios_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publhorarios_']; 
       $publhorarios_ = $this->publhorarios_; 
       $publhorarios__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $publhorarios_);
       $publhorarios__val = $publhorarios__tmp;
       $sStyleHidden_publhorarios_ = '';
       if (isset($sCheckRead_publhorarios_))
       {
           unset($sCheckRead_publhorarios_);
       }
       if (isset($this->nmgp_cmp_readonly['publhorarios_']))
       {
           $sCheckRead_publhorarios_ = $this->nmgp_cmp_readonly['publhorarios_'];
       }
       if (isset($this->nmgp_cmp_hidden['publhorarios_']) && $this->nmgp_cmp_hidden['publhorarios_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publhorarios_']);
           $sStyleHidden_publhorarios_ = 'display: none;';
       }
       $bTestReadOnly_publhorarios_ = true;
       $sStyleReadLab_publhorarios_ = 'display: none;';
       $sStyleReadInp_publhorarios_ = '';
       if (isset($this->nmgp_cmp_readonly['publhorarios_']) && $this->nmgp_cmp_readonly['publhorarios_'] == 'on')
       {
           $bTestReadOnly_publhorarios_ = false;
           unset($this->nmgp_cmp_readonly['publhorarios_']);
           $sStyleReadLab_publhorarios_ = '';
           $sStyleReadInp_publhorarios_ = 'display: none;';
       }
       $this->usuacodigos_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['usuacodigos_']; 
       $usuacodigos_ = $this->usuacodigos_; 
       $sStyleHidden_usuacodigos_ = '';
       if (isset($sCheckRead_usuacodigos_))
       {
           unset($sCheckRead_usuacodigos_);
       }
       if (isset($this->nmgp_cmp_readonly['usuacodigos_']))
       {
           $sCheckRead_usuacodigos_ = $this->nmgp_cmp_readonly['usuacodigos_'];
       }
       if (isset($this->nmgp_cmp_hidden['usuacodigos_']) && $this->nmgp_cmp_hidden['usuacodigos_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['usuacodigos_']);
           $sStyleHidden_usuacodigos_ = 'display: none;';
       }
       $bTestReadOnly_usuacodigos_ = true;
       $sStyleReadLab_usuacodigos_ = 'display: none;';
       $sStyleReadInp_usuacodigos_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["usuacodigos_"]) &&  $this->nmgp_cmp_readonly["usuacodigos_"] == "on"))
       {
           $bTestReadOnly_usuacodigos_ = false;
           unset($this->nmgp_cmp_readonly['usuacodigos_']);
           $sStyleReadLab_usuacodigos_ = '';
           $sStyleReadInp_usuacodigos_ = 'display: none;';
       }
       $this->publfecregd_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publfecregd_'] . ' ' . $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publfecregd__hora']; 
       $publfecregd_ = $this->publfecregd_; 
       $sStyleHidden_publfecregd_ = '';
       if (isset($sCheckRead_publfecregd_))
       {
           unset($sCheckRead_publfecregd_);
       }
       if (isset($this->nmgp_cmp_readonly['publfecregd_']))
       {
           $sCheckRead_publfecregd_ = $this->nmgp_cmp_readonly['publfecregd_'];
       }
       if (isset($this->nmgp_cmp_hidden['publfecregd_']) && $this->nmgp_cmp_hidden['publfecregd_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publfecregd_']);
           $sStyleHidden_publfecregd_ = 'display: none;';
       }
       $bTestReadOnly_publfecregd_ = true;
       $sStyleReadLab_publfecregd_ = 'display: none;';
       $sStyleReadInp_publfecregd_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["publfecregd_"]) &&  $this->nmgp_cmp_readonly["publfecregd_"] == "on"))
       {
           $bTestReadOnly_publfecregd_ = false;
           unset($this->nmgp_cmp_readonly['publfecregd_']);
           $sStyleReadLab_publfecregd_ = '';
           $sStyleReadInp_publfecregd_ = 'display: none;';
       }
       $this->publestados_ = $this->form_vert_form_publicaciones_grid_edit[$sc_seq_vert]['publestados_']; 
       $publestados_ = $this->publestados_; 
       $sStyleHidden_publestados_ = '';
       if (isset($sCheckRead_publestados_))
       {
           unset($sCheckRead_publestados_);
       }
       if (isset($this->nmgp_cmp_readonly['publestados_']))
       {
           $sCheckRead_publestados_ = $this->nmgp_cmp_readonly['publestados_'];
       }
       if (isset($this->nmgp_cmp_hidden['publestados_']) && $this->nmgp_cmp_hidden['publestados_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['publestados_']);
           $sStyleHidden_publestados_ = 'display: none;';
       }
       $bTestReadOnly_publestados_ = true;
       $sStyleReadLab_publestados_ = 'display: none;';
       $sStyleReadInp_publestados_ = '';
       if (isset($this->nmgp_cmp_readonly['publestados_']) && $this->nmgp_cmp_readonly['publestados_'] == 'on')
       {
           $bTestReadOnly_publestados_ = false;
           unset($this->nmgp_cmp_readonly['publestados_']);
           $sStyleReadLab_publestados_ = '';
           $sStyleReadInp_publestados_ = 'display: none;';
       }

       $nm_cor_fun_vert = ($nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?>>


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if ($this->Embutida_form) {?>
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_publicaciones_grid_edit_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_publicaciones_grid_edit_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_publicaciones_grid_edit_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_publicaciones_grid_edit_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_publicaciones_grid_edit_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_publicaciones_grid_edit_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['publcodigon_']) && $this->nmgp_cmp_hidden['publcodigon_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publcodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publcodigon_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_publcodigon__line" id="hidden_field_data_publcodigon_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publcodigon_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publcodigon__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_publcodigon_<?php echo $sc_seq_vert ?>" class="css_publcodigon__line" style="<?php echo $sStyleReadLab_publcodigon_; ?>"><?php echo $this->form_encode_input($this->publcodigon_); ?></span><span id="id_read_off_publcodigon_<?php echo $sc_seq_vert ?>" style="<?php echo $sStyleReadInp_publcodigon_; ?>"><input type="hidden" id="id_sc_field_publcodigon_<?php echo $sc_seq_vert ?>" name="publcodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publcodigon_) . "\">"?>
<span id="id_ajax_label_publcodigon_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($publcodigon_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publcodigon_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publcodigon_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['cliecodigon_']) && $this->nmgp_cmp_hidden['cliecodigon_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cliecodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->cliecodigon_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_cliecodigon__line" id="hidden_field_data_cliecodigon_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_cliecodigon_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_cliecodigon__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_cliecodigon_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliecodigon_"]) &&  $this->nmgp_cmp_readonly["cliecodigon_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_'] = array(); 
    }

   $old_value_publcodigon_ = $this->publcodigon_;
   $old_value_publpuerton_ = $this->publpuerton_;
   $old_value_publfecregd_ = $this->publfecregd_;
   $old_value_publfecregd__hora = $this->publfecregd__hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_publcodigon_ = $this->publcodigon_;
   $unformatted_value_publpuerton_ = $this->publpuerton_;
   $unformatted_value_publfecregd_ = $this->publfecregd_;
   $unformatted_value_publfecregd__hora = $this->publfecregd__hora;

   $nm_comando = "SELECT cliecodigon, clienombres  FROM clientes  ORDER BY clienombres";

   $this->publcodigon_ = $old_value_publcodigon_;
   $this->publpuerton_ = $old_value_publpuerton_;
   $this->publfecregd_ = $old_value_publfecregd_;
   $this->publfecregd__hora = $old_value_publfecregd__hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $cliecodigon__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliecodigon__1))
          {
              foreach ($this->cliecodigon__1 as $tmp_cliecodigon_)
              {
                  if (trim($tmp_cliecodigon_) === trim($cadaselect[1])) { $cliecodigon__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliecodigon_) === trim($cadaselect[1])) { $cliecodigon__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="cliecodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($cliecodigon_) . "\">" . $cliecodigon__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_cliecodigon_();
   $x = 0 ; 
   $cliecodigon__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->cliecodigon__1))
          {
              foreach ($this->cliecodigon__1 as $tmp_cliecodigon_)
              {
                  if (trim($tmp_cliecodigon_) === trim($cadaselect[1])) { $cliecodigon__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->cliecodigon_) === trim($cadaselect[1])) { $cliecodigon__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($cliecodigon__look))
          {
              $cliecodigon__look = $this->cliecodigon_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_cliecodigon_" . $sc_seq_vert . "\" class=\"css_cliecodigon__line\" style=\"" .  $sStyleReadLab_cliecodigon_ . "\">" . $this->form_encode_input($cliecodigon__look) . "</span><span id=\"id_read_off_cliecodigon_" . $sc_seq_vert . "\" style=\"" . $sStyleReadInp_cliecodigon_ . "\">";
   echo " <span id=\"idAjaxSelect_cliecodigon_" .  $sc_seq_vert . "\"><select class=\"sc-js-input scFormObjectOddMult css_cliecodigon__obj\" style=\"\" id=\"id_sc_field_cliecodigon_" . $sc_seq_vert . "\" name=\"cliecodigon_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_cliecodigon_'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->cliecodigon_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->cliecodigon_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliecodigon_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliecodigon_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['publgrupusrs_']) && $this->nmgp_cmp_hidden['publgrupusrs_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publgrupusrs_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publgrupusrs_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publgrupusrs__line" id="hidden_field_data_publgrupusrs_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publgrupusrs_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publgrupusrs__line" style="vertical-align: top;padding: 0px">
<?php
$publgrupusrs__val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($publgrupusrs_));

?>

<?php if ($bTestReadOnly_publgrupusrs_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publgrupusrs_"]) &&  $this->nmgp_cmp_readonly["publgrupusrs_"] == "on") { 

 ?>
<input type="hidden" name="publgrupusrs_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publgrupusrs_) . "\">" . $publgrupusrs__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_publgrupusrs_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-publgrupusrs_<?php echo $sc_seq_vert ?> css_publgrupusrs__line" style="<?php echo $sStyleReadLab_publgrupusrs_; ?>"><?php echo $this->form_encode_input($publgrupusrs__val); ?></span><span id="id_read_off_publgrupusrs_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publgrupusrs_; ?>">
 <textarea  class="sc-js-input scFormObjectOddMult css_publgrupusrs__obj" style="white-space: pre-wrap;" name="publgrupusrs_<?php echo $sc_seq_vert ?>" id="id_sc_field_publgrupusrs_<?php echo $sc_seq_vert ?>" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $publgrupusrs_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publgrupusrs_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publgrupusrs_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['aplicodigon_']) && $this->nmgp_cmp_hidden['aplicodigon_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aplicodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->aplicodigon_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_aplicodigon__line" id="hidden_field_data_aplicodigon_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_aplicodigon_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_aplicodigon__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_aplicodigon_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aplicodigon_"]) &&  $this->nmgp_cmp_readonly["aplicodigon_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_'] = array(); 
    }

   $old_value_publcodigon_ = $this->publcodigon_;
   $old_value_publpuerton_ = $this->publpuerton_;
   $old_value_publfecregd_ = $this->publfecregd_;
   $old_value_publfecregd__hora = $this->publfecregd__hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_publcodigon_ = $this->publcodigon_;
   $unformatted_value_publpuerton_ = $this->publpuerton_;
   $unformatted_value_publfecregd_ = $this->publfecregd_;
   $unformatted_value_publfecregd__hora = $this->publfecregd__hora;

   $nm_comando = "SELECT aplicodigon, aplinombres  FROM aplicaciones  ORDER BY aplinombres";

   $this->publcodigon_ = $old_value_publcodigon_;
   $this->publpuerton_ = $old_value_publpuerton_;
   $this->publfecregd_ = $old_value_publfecregd_;
   $this->publfecregd__hora = $old_value_publfecregd__hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $aplicodigon__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aplicodigon__1))
          {
              foreach ($this->aplicodigon__1 as $tmp_aplicodigon_)
              {
                  if (trim($tmp_aplicodigon_) === trim($cadaselect[1])) { $aplicodigon__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->aplicodigon_) === trim($cadaselect[1])) { $aplicodigon__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="aplicodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($aplicodigon_) . "\">" . $aplicodigon__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_aplicodigon_();
   $x = 0 ; 
   $aplicodigon__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aplicodigon__1))
          {
              foreach ($this->aplicodigon__1 as $tmp_aplicodigon_)
              {
                  if (trim($tmp_aplicodigon_) === trim($cadaselect[1])) { $aplicodigon__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->aplicodigon_) === trim($cadaselect[1])) { $aplicodigon__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($aplicodigon__look))
          {
              $aplicodigon__look = $this->aplicodigon_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_aplicodigon_" . $sc_seq_vert . "\" class=\"css_aplicodigon__line\" style=\"" .  $sStyleReadLab_aplicodigon_ . "\">" . $this->form_encode_input($aplicodigon__look) . "</span><span id=\"id_read_off_aplicodigon_" . $sc_seq_vert . "\" style=\"" . $sStyleReadInp_aplicodigon_ . "\">";
   echo " <span id=\"idAjaxSelect_aplicodigon_" .  $sc_seq_vert . "\"><select class=\"sc-js-input scFormObjectOddMult css_aplicodigon__obj\" style=\"\" id=\"id_sc_field_aplicodigon_" . $sc_seq_vert . "\" name=\"aplicodigon_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_aplicodigon_'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->aplicodigon_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->aplicodigon_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aplicodigon_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aplicodigon_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['publpuerton_']) && $this->nmgp_cmp_hidden['publpuerton_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publpuerton_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publpuerton_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publpuerton__line" id="hidden_field_data_publpuerton_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publpuerton_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publpuerton__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_publpuerton_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publpuerton_"]) &&  $this->nmgp_cmp_readonly["publpuerton_"] == "on") { 

 ?>
<input type="hidden" name="publpuerton_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publpuerton_) . "\">" . $publpuerton_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_publpuerton_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-publpuerton_<?php echo $sc_seq_vert ?> css_publpuerton__line" style="<?php echo $sStyleReadLab_publpuerton_; ?>"><?php echo $this->form_encode_input($this->publpuerton_); ?></span><span id="id_read_off_publpuerton_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publpuerton_; ?>">
 <input class="scFormObjectOddMult scFormObjectOddMultSpin scSpin_publpuerton__obj css_publpuerton__obj" style="" id="id_sc_field_publpuerton_<?php echo $sc_seq_vert ?>" type=text name="publpuerton_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publpuerton_) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 9, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['publpuerton_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['publpuerton_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['publpuerton_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publpuerton_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publpuerton_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['meaucodigon_']) && $this->nmgp_cmp_hidden['meaucodigon_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="meaucodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->meaucodigon_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_meaucodigon__line" id="hidden_field_data_meaucodigon_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_meaucodigon_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_meaucodigon__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_meaucodigon_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["meaucodigon_"]) &&  $this->nmgp_cmp_readonly["meaucodigon_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_'] = array(); 
    }

   $old_value_publcodigon_ = $this->publcodigon_;
   $old_value_publpuerton_ = $this->publpuerton_;
   $old_value_publfecregd_ = $this->publfecregd_;
   $old_value_publfecregd__hora = $this->publfecregd__hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_publcodigon_ = $this->publcodigon_;
   $unformatted_value_publpuerton_ = $this->publpuerton_;
   $unformatted_value_publfecregd_ = $this->publfecregd_;
   $unformatted_value_publfecregd__hora = $this->publfecregd__hora;

   $nm_comando = "SELECT meaucodigon, meaunombres  FROM metodosauths  ORDER BY meaunombres";

   $this->publcodigon_ = $old_value_publcodigon_;
   $this->publpuerton_ = $old_value_publpuerton_;
   $this->publfecregd_ = $old_value_publfecregd_;
   $this->publfecregd__hora = $old_value_publfecregd__hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $meaucodigon__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->meaucodigon__1))
          {
              foreach ($this->meaucodigon__1 as $tmp_meaucodigon_)
              {
                  if (trim($tmp_meaucodigon_) === trim($cadaselect[1])) { $meaucodigon__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->meaucodigon_) === trim($cadaselect[1])) { $meaucodigon__look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="meaucodigon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($meaucodigon_) . "\">" . $meaucodigon__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_meaucodigon_();
   $x = 0 ; 
   $meaucodigon__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->meaucodigon__1))
          {
              foreach ($this->meaucodigon__1 as $tmp_meaucodigon_)
              {
                  if (trim($tmp_meaucodigon_) === trim($cadaselect[1])) { $meaucodigon__look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->meaucodigon_) === trim($cadaselect[1])) { $meaucodigon__look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($meaucodigon__look))
          {
              $meaucodigon__look = $this->meaucodigon_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_meaucodigon_" . $sc_seq_vert . "\" class=\"css_meaucodigon__line\" style=\"" .  $sStyleReadLab_meaucodigon_ . "\">" . $this->form_encode_input($meaucodigon__look) . "</span><span id=\"id_read_off_meaucodigon_" . $sc_seq_vert . "\" style=\"" . $sStyleReadInp_meaucodigon_ . "\">";
   echo " <span id=\"idAjaxSelect_meaucodigon_" .  $sc_seq_vert . "\"><select class=\"sc-js-input scFormObjectOddMult css_meaucodigon__obj\" style=\"\" id=\"id_sc_field_meaucodigon_" . $sc_seq_vert . "\" name=\"meaucodigon_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_meaucodigon_'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->meaucodigon_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->meaucodigon_)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_meaucodigon_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_meaucodigon_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['publurls_']) && $this->nmgp_cmp_hidden['publurls_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publurls_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publurls_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publurls__line" id="hidden_field_data_publurls_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publurls_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publurls__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_publurls_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publurls_"]) &&  $this->nmgp_cmp_readonly["publurls_"] == "on") { 

 ?>
<input type="hidden" name="publurls_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publurls_) . "\">" . $publurls_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_publurls_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-publurls_<?php echo $sc_seq_vert ?> css_publurls__line" style="<?php echo $sStyleReadLab_publurls_; ?>"><?php echo $this->form_encode_input($this->publurls_); ?></span><span id="id_read_off_publurls_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publurls_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_publurls__obj" style="" id="id_sc_field_publurls_<?php echo $sc_seq_vert ?>" type=text name="publurls_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publurls_) ?>"
 size=30 maxlength=32767 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.publurls_" . $sc_seq_vert . ".value), '_blank')", "window.open(nm_link_url(document.F1.publurls_" . $sc_seq_vert . ".value), '_blank')", "publurls_" . $sc_seq_vert . "_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publurls_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publurls_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['publipss_']) && $this->nmgp_cmp_hidden['publipss_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publipss_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publipss_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publipss__line" id="hidden_field_data_publipss_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publipss_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publipss__line" style="vertical-align: top;padding: 0px">
<?php
$publipss__val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($publipss_));

?>

<?php if ($bTestReadOnly_publipss_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publipss_"]) &&  $this->nmgp_cmp_readonly["publipss_"] == "on") { 

 ?>
<input type="hidden" name="publipss_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publipss_) . "\">" . $publipss__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_publipss_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-publipss_<?php echo $sc_seq_vert ?> css_publipss__line" style="<?php echo $sStyleReadLab_publipss_; ?>"><?php echo $this->form_encode_input($publipss__val); ?></span><span id="id_read_off_publipss_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publipss_; ?>">
 <textarea  class="sc-js-input scFormObjectOddMult css_publipss__obj" style="white-space: pre-wrap;" name="publipss_<?php echo $sc_seq_vert ?>" id="id_sc_field_publipss_<?php echo $sc_seq_vert ?>" rows="2" cols="30"
 alt="{datatype: 'text', maxLength: 250, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $publipss_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publipss_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publipss_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['publhorarios_']) && $this->nmgp_cmp_hidden['publhorarios_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publhorarios_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publhorarios_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publhorarios__line" id="hidden_field_data_publhorarios_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publhorarios_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publhorarios__line" style="vertical-align: top;padding: 0px">
<?php
$publhorarios__val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($publhorarios_));

?>

<?php if ($bTestReadOnly_publhorarios_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publhorarios_"]) &&  $this->nmgp_cmp_readonly["publhorarios_"] == "on") { 

 ?>
<input type="hidden" name="publhorarios_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publhorarios_) . "\">" . $publhorarios__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_publhorarios_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-publhorarios_<?php echo $sc_seq_vert ?> css_publhorarios__line" style="<?php echo $sStyleReadLab_publhorarios_; ?>"><?php echo $this->form_encode_input($publhorarios__val); ?></span><span id="id_read_off_publhorarios_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publhorarios_; ?>">
 <textarea  class="sc-js-input scFormObjectOddMult css_publhorarios__obj" style="white-space: pre-wrap;" name="publhorarios_<?php echo $sc_seq_vert ?>" id="id_sc_field_publhorarios_<?php echo $sc_seq_vert ?>" rows="2" cols="30"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $publhorarios_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publhorarios_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publhorarios_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['usuacodigos_']) && $this->nmgp_cmp_hidden['usuacodigos_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="usuacodigos_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($usuacodigos_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_usuacodigos__line" id="hidden_field_data_usuacodigos_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_usuacodigos_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_usuacodigos__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_usuacodigos_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["usuacodigos_"]) &&  $this->nmgp_cmp_readonly["usuacodigos_"] == "on")) { 

 ?>
<input type="hidden" name="usuacodigos_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($usuacodigos_) . "\"><span id=\"id_ajax_label_usuacodigos_" . $sc_seq_vert . "\">" . $usuacodigos_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_usuacodigos_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-usuacodigos_<?php echo $sc_seq_vert ?> css_usuacodigos__line" style="<?php echo $sStyleReadLab_usuacodigos_; ?>"><?php echo $this->form_encode_input($this->usuacodigos_); ?></span><span id="id_read_off_usuacodigos_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_usuacodigos_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_usuacodigos__obj" style="" id="id_sc_field_usuacodigos_<?php echo $sc_seq_vert ?>" type=text name="usuacodigos_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($usuacodigos_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_usuacodigos_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_usuacodigos_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['publfecregd_']) && $this->nmgp_cmp_hidden['publfecregd_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publfecregd_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publfecregd_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publfecregd__line" id="hidden_field_data_publfecregd_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publfecregd_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publfecregd__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_publfecregd_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["publfecregd_"]) &&  $this->nmgp_cmp_readonly["publfecregd_"] == "on")) { 

 ?>
<input type="hidden" name="publfecregd_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publfecregd_) . "\"><span id=\"id_ajax_label_publfecregd_" . $sc_seq_vert . "\">" . $publfecregd_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_publfecregd_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-publfecregd_<?php echo $sc_seq_vert ?> css_publfecregd__line" style="<?php echo $sStyleReadLab_publfecregd_; ?>"><?php echo $this->form_encode_input($publfecregd_); ?></span><span id="id_read_off_publfecregd_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publfecregd_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_publfecregd__obj" style="" id="id_sc_field_publfecregd_<?php echo $sc_seq_vert ?>" type=text name="publfecregd_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publfecregd_) ?>"
 size=18 alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['publfecregd_']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['publfecregd_']['date_format']; ?>', timeSep: '<?php echo $this->field_config['publfecregd_']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['publfecregd_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publfecregd_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publfecregd_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php
   $this->publfecregd_ = $old_dt_publfecregd_;
?>

   <?php if (isset($this->nmgp_cmp_hidden['publestados_']) && $this->nmgp_cmp_hidden['publestados_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="publestados_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->publestados_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_publestados__line" id="hidden_field_data_publestados_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_publestados_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_publestados__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_publestados_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publestados_"]) &&  $this->nmgp_cmp_readonly["publestados_"] == "on") { 

$publestados__look = "";
 if ($this->publestados_ == "A") { $publestados__look .= "" . $this->Ini->Nm_lang['lang_select_activo'] . "" ;} 
 if ($this->publestados_ == "I") { $publestados__look .= "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "" ;} 
 if (empty($publestados__look)) { $publestados__look = $this->publestados_; }
?>
<input type="hidden" name="publestados_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($publestados_) . "\">" . $publestados__look . ""; ?>
<?php } else { ?>
<?php

$publestados__look = "";
 if ($this->publestados_ == "A") { $publestados__look .= "" . $this->Ini->Nm_lang['lang_select_activo'] . "" ;} 
 if ($this->publestados_ == "I") { $publestados__look .= "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "" ;} 
 if (empty($publestados__look)) { $publestados__look = $this->publestados_; }
?>
<span id="id_read_on_publestados_<?php echo $sc_seq_vert ; ?>" class="css_publestados__line"  style="<?php echo $sStyleReadLab_publestados_; ?>"><?php echo $this->form_encode_input($publestados__look); ?></span><span id="id_read_off_publestados_<?php echo $sc_seq_vert ; ?>" style="<?php echo $sStyleReadInp_publestados_; ?>">
 <span id="idAjaxSelect_publestados_<?php echo $sc_seq_vert ?>"><select class="sc-js-input scFormObjectOddMult css_publestados__obj" style="" id="id_sc_field_publestados_<?php echo $sc_seq_vert ?>" name="publestados_<?php echo $sc_seq_vert ?>" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->publestados_ == "A") { echo " selected" ;} ?><?php  if (empty($this->publestados_)) { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_select_activo']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_publestados_'][] = 'A'; ?>
 <option  value="I" <?php  if ($this->publestados_ == "I") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_select_inactivo']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['Lookup_publestados_'][] = 'I'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publestados_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publestados_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_publcodigon_))
       {
           $this->nmgp_cmp_readonly['publcodigon_'] = $sCheckRead_publcodigon_;
       }
       if ('display: none;' == $sStyleHidden_publcodigon_)
       {
           $this->nmgp_cmp_hidden['publcodigon_'] = 'off';
       }
       if (isset($sCheckRead_cliecodigon_))
       {
           $this->nmgp_cmp_readonly['cliecodigon_'] = $sCheckRead_cliecodigon_;
       }
       if ('display: none;' == $sStyleHidden_cliecodigon_)
       {
           $this->nmgp_cmp_hidden['cliecodigon_'] = 'off';
       }
       if (isset($sCheckRead_publgrupusrs_))
       {
           $this->nmgp_cmp_readonly['publgrupusrs_'] = $sCheckRead_publgrupusrs_;
       }
       if ('display: none;' == $sStyleHidden_publgrupusrs_)
       {
           $this->nmgp_cmp_hidden['publgrupusrs_'] = 'off';
       }
       if (isset($sCheckRead_aplicodigon_))
       {
           $this->nmgp_cmp_readonly['aplicodigon_'] = $sCheckRead_aplicodigon_;
       }
       if ('display: none;' == $sStyleHidden_aplicodigon_)
       {
           $this->nmgp_cmp_hidden['aplicodigon_'] = 'off';
       }
       if (isset($sCheckRead_publpuerton_))
       {
           $this->nmgp_cmp_readonly['publpuerton_'] = $sCheckRead_publpuerton_;
       }
       if ('display: none;' == $sStyleHidden_publpuerton_)
       {
           $this->nmgp_cmp_hidden['publpuerton_'] = 'off';
       }
       if (isset($sCheckRead_meaucodigon_))
       {
           $this->nmgp_cmp_readonly['meaucodigon_'] = $sCheckRead_meaucodigon_;
       }
       if ('display: none;' == $sStyleHidden_meaucodigon_)
       {
           $this->nmgp_cmp_hidden['meaucodigon_'] = 'off';
       }
       if (isset($sCheckRead_publurls_))
       {
           $this->nmgp_cmp_readonly['publurls_'] = $sCheckRead_publurls_;
       }
       if ('display: none;' == $sStyleHidden_publurls_)
       {
           $this->nmgp_cmp_hidden['publurls_'] = 'off';
       }
       if (isset($sCheckRead_publipss_))
       {
           $this->nmgp_cmp_readonly['publipss_'] = $sCheckRead_publipss_;
       }
       if ('display: none;' == $sStyleHidden_publipss_)
       {
           $this->nmgp_cmp_hidden['publipss_'] = 'off';
       }
       if (isset($sCheckRead_publhorarios_))
       {
           $this->nmgp_cmp_readonly['publhorarios_'] = $sCheckRead_publhorarios_;
       }
       if ('display: none;' == $sStyleHidden_publhorarios_)
       {
           $this->nmgp_cmp_hidden['publhorarios_'] = 'off';
       }
       if (isset($sCheckRead_usuacodigos_))
       {
           $this->nmgp_cmp_readonly['usuacodigos_'] = $sCheckRead_usuacodigos_;
       }
       if ('display: none;' == $sStyleHidden_usuacodigos_)
       {
           $this->nmgp_cmp_hidden['usuacodigos_'] = 'off';
       }
       if (isset($sCheckRead_publfecregd_))
       {
           $this->nmgp_cmp_readonly['publfecregd_'] = $sCheckRead_publfecregd_;
       }
       if ('display: none;' == $sStyleHidden_publfecregd_)
       {
           $this->nmgp_cmp_hidden['publfecregd_'] = 'off';
       }
       if (isset($sCheckRead_publestados_))
       {
           $this->nmgp_cmp_readonly['publestados_'] = $sCheckRead_publestados_;
       }
       if ('display: none;' == $sStyleHidden_publestados_)
       {
           $this->nmgp_cmp_hidden['publestados_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_publicaciones_grid_edit = $guarda_form_vert_form_publicaciones_grid_edit;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div> 
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; text-align: center; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<span class="scFormRequiredOddColorMult">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq()", "scBtnFn_sys_GridPermiteSeq()", "brec_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-11", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio_off", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-12", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-13", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna_off", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-14", "", "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b" class="scFormToolbarPadding"></span> 
<?php 
}
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-15", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca_off", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-16", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-17", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal_off", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-18", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b" class="scFormToolbarPadding"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none; position: absolute; left: 50px; top: 50px"><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_publicaciones_grid_edit");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_publicaciones_grid_edit");
 parent.scAjaxDetailHeight("form_publicaciones_grid_edit", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_publicaciones_grid_edit", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_publicaciones_grid_edit", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
?>
<script type="text/javascript">
_scAjaxShowMessage(scMsgDefTitle, "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", false, sc_ajaxMsgTime, false, "Ok", 0, 0, 0, 0, "", "", "", false, true);
</script>
<?php
}
?>
<?php
if ('' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_publicaciones_grid_edit']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<script type="text/javascript">
	function scBtnFn_sys_format_inc() {
		if ($("#sc_b_new_t.sc-unique-btn-1").length && $("#sc_b_new_t.sc-unique-btn-1").is(":visible")) {
			do_ajax_form_publicaciones_grid_edit_add_new_line(); return false;
			 return;
		}
		if ($("#sc_b_new_t.sc-unique-btn-2").length && $("#sc_b_new_t.sc-unique-btn-2").is(":visible")) {
			nm_move ('novo');
			 return;
		}
		if ($("#sc_b_ins_t.sc-unique-btn-3").length && $("#sc_b_ins_t.sc-unique-btn-3").is(":visible")) {
			nm_atualiza ('incluir');
			 return;
		}
	}
	function scBtnFn_sys_format_cnl() {
		if ($("#sc_b_sai_t.sc-unique-btn-4").length && $("#sc_b_sai_t.sc-unique-btn-4").is(":visible")) {
			<?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
			 return;
		}
	}
	function scBtnFn_sys_format_alt() {
		if ($("#sc_b_upd_t.sc-unique-btn-5").length && $("#sc_b_upd_t.sc-unique-btn-5").is(":visible")) {
			nm_atualiza ('alterar');
			 return;
		}
	}
	function scBtnFn_sys_format_hlp() {
		if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
			window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
			 return;
		}
	}
	function scBtnFn_sys_format_sai() {
		if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
			document.F5.action='<?php echo $nm_url_saida; ?>'; document.F5.submit();
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
			document.F5.action='<?php echo $nm_url_saida; ?>'; document.F5.submit();
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-8").length && $("#sc_b_sai_t.sc-unique-btn-8").is(":visible")) {
			document.F6.action='<?php echo $nm_url_saida; ?>'; document.F6.submit(); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-9").length && $("#sc_b_sai_t.sc-unique-btn-9").is(":visible")) {
			document.F6.action='<?php echo $nm_url_saida; ?>'; document.F6.submit(); return false;
			 return;
		}
		if ($("#sc_b_sai_t.sc-unique-btn-10").length && $("#sc_b_sai_t.sc-unique-btn-10").is(":visible")) {
			document.F6.action='<?php echo $nm_url_saida; ?>'; document.F6.submit(); return false;
			 return;
		}
	}
	function scBtnFn_sys_GridPermiteSeq() {
		if ($("#brec_b").length && $("#brec_b").is(":visible")) {
			nm_navpage(document.F1.nmgp_rec_b.value, 'P'); document.F1.nmgp_rec_b.value = '';
			 return;
		}
	}
	function scBtnFn_sys_format_ini() {
		if ($("#sc_b_ini_b.sc-unique-btn-11").length && $("#sc_b_ini_b.sc-unique-btn-11").is(":visible")) {
			nm_move ('inicio');
			 return;
		}
		if ($("#sc_b_ini_off_b.sc-unique-btn-12").length && $("#sc_b_ini_off_b.sc-unique-btn-12").is(":visible")) {
			nm_move ('inicio');
			 return;
		}
	}
	function scBtnFn_sys_format_ret() {
		if ($("#sc_b_ret_b.sc-unique-btn-13").length && $("#sc_b_ret_b.sc-unique-btn-13").is(":visible")) {
			nm_move ('retorna');
			 return;
		}
		if ($("#sc_b_ret_off_b.sc-unique-btn-14").length && $("#sc_b_ret_off_b.sc-unique-btn-14").is(":visible")) {
			nm_move ('retorna');
			 return;
		}
	}
	function scBtnFn_sys_format_ava() {
		if ($("#sc_b_avc_b.sc-unique-btn-15").length && $("#sc_b_avc_b.sc-unique-btn-15").is(":visible")) {
			nm_move ('avanca');
			 return;
		}
		if ($("#sc_b_avc_off_b.sc-unique-btn-16").length && $("#sc_b_avc_off_b.sc-unique-btn-16").is(":visible")) {
			nm_move ('avanca');
			 return;
		}
	}
	function scBtnFn_sys_format_fim() {
		if ($("#sc_b_fim_b.sc-unique-btn-17").length && $("#sc_b_fim_b.sc-unique-btn-17").is(":visible")) {
			nm_move ('final');
			 return;
		}
		if ($("#sc_b_fim_off_b.sc-unique-btn-18").length && $("#sc_b_fim_off_b.sc-unique-btn-18").is(":visible")) {
			nm_move ('final');
			 return;
		}
	}
</script>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
<?php 
 } 
} 
?> 
