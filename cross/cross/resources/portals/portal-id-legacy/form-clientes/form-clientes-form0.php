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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " " . $this->Ini->Nm_lang['lang_tbl_clientes'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " " . $this->Ini->Nm_lang['lang_tbl_clientes'] . ""); } ?></TITLE>
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
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

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
<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_clientes/form_clientes_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_clientes_sajax_js.php");
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
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
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

include_once('form_clientes_jquery.php');

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

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $("#hidden_bloco_0,#hidden_bloco_1,#hidden_bloco_2,#hidden_bloco_3,#hidden_bloco_4").each(function() {
   $(this.rows[0]).bind("click", {block: this}, toggleBlock)
                  .mouseover(function() { $(this).css("cursor", "pointer"); })
                  .mouseout(function() { $(this).css("cursor", ""); });
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
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
    "hidden_bloco_0": true,
    "hidden_bloco_1": true,
    "hidden_bloco_2": true,
    "hidden_bloco_3": true,
    "hidden_bloco_4": true
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
    if ("hidden_bloco_5" == block_id) {
      scAjaxDetailHeight("grid_publicaciones", "600");
    }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['recarga'];
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
 include_once("form_clientes_js0.php");
?>
<script type="text/javascript"> 
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
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['insert_validation']; ?>">
<?php
}
?>
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
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_clientes'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_clientes'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['mostra_cab'] != "N") && (!$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard'] || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['compact_mode'] || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['maximized']))
  {
?>
<tr><td>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " " . $this->Ini->Nm_lang['lang_tbl_clientes'] . ""; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " " . $this->Ini->Nm_lang['lang_tbl_clientes'] . ""; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"></div>
</div></td></tr>
<?php
  }
?>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['fast_search'][2] : "";
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-1", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-2", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-3", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-4", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-5", "", "");?>
 
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
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-6", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-7", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-8", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-9", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "sc-unique-btn-10", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['run_iframe'] != "R")
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
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; text-align: center; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['empty_filter'] = true;
       }
  }
?>
<script type="text/javascript">
var pag_ativa = "form_clientes_form0";
</script>
<ul class="scTabLine sc-ui-page-tab-line">
<?php
    $this->tabCssClass = array(
        'form_clientes_form0' => array(
            'title' => "Información básica",
            'class' => empty($nmgp_num_form) || $nmgp_num_form == "form_clientes_form0" ? "scTabActive" : "scTabInactive",
        ),
        'form_clientes_form1' => array(
            'title' => "Publicaciones",
            'class' => $nmgp_num_form == "form_clientes_form1" ? "scTabActive" : "scTabInactive",
        ),
    );
        if (!empty($this->Ini->nm_hidden_pages)) {
                foreach ($this->Ini->nm_hidden_pages as $pageName => $pageStatus) {
                        if ('Información básica' == $pageName && 'off' == $pageStatus) {
                                $this->tabCssClass['form_clientes_form0']['class'] = 'scTabInactive';
                        }
                        if ('Publicaciones' == $pageName && 'off' == $pageStatus) {
                                $this->tabCssClass['form_clientes_form1']['class'] = 'scTabInactive';
                        }
                }
                $displayingPage = false;
                foreach ($this->tabCssClass as $pageInfo) {
                        if ('scTabActive' == $pageInfo['class']) {
                                $displayingPage = true;
                                break;
                        }
                }
                if (!$displayingPage) {
                        foreach ($this->tabCssClass as $pageForm => $pageInfo) {
                                if (!isset($this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) || 'off' != $this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) {
                                        $this->tabCssClass[$pageForm]['class'] = 'scTabActive';
                                        break;
                                }
                        }
                }
        }
?>
<?php
    $css_celula = $this->tabCssClass["form_clientes_form0"]['class'];
?>
   <li id="id_form_clientes_form0" class="<?php echo $css_celula; ?> sc-form-page">
    <a href="javascript: sc_exib_ocult_pag ('form_clientes_form0')">
     <img src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ico__NM__address_book_edit_24.png" align="absmiddle">
     Información básica
    </a>
   </li>
<?php
    $css_celula = $this->tabCssClass["form_clientes_form1"]['class'];
?>
   <li id="id_form_clientes_form1" class="<?php echo $css_celula; ?> sc-form-page">
    <a href="javascript: sc_exib_ocult_pag ('form_clientes_form1')">
     <img src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ico__NM__address_book_add_16.png" align="absmiddle">
     Publicaciones
    </a>
   </li>
</ul>
<div style='clear:both'></div>
</td></tr> 
<tr><td style="padding: 0px">
<div id="form_clientes_form0" style='display: none; width: 1px; height: 0px; overflow: scroll'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['cliecodigon']))
           {
               $this->nmgp_cmp_readonly['cliecodigon'] = 'on';
           }
?>
   <tr>


    <TD colspan="4" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf0\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_clientes_bl_1'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cliecodigon']))
    {
        $this->nm_new_label['cliecodigon'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliecodigon'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliecodigon = $this->cliecodigon;
   $sStyleHidden_cliecodigon = '';
   if (isset($this->nmgp_cmp_hidden['cliecodigon']) && $this->nmgp_cmp_hidden['cliecodigon'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliecodigon']);
       $sStyleHidden_cliecodigon = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliecodigon = 'display: none;';
   $sStyleReadInp_cliecodigon = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["cliecodigon"]) &&  $this->nmgp_cmp_readonly["cliecodigon"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliecodigon']);
       $sStyleReadLab_cliecodigon = '';
       $sStyleReadInp_cliecodigon = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliecodigon']) && $this->nmgp_cmp_hidden['cliecodigon'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliecodigon" value="<?php echo $this->form_encode_input($cliecodigon) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliecodigon_label" id="hidden_field_label_cliecodigon" style="<?php echo $sStyleHidden_cliecodigon; ?>"><span id="id_label_cliecodigon"><?php echo $this->nm_new_label['cliecodigon']; ?></span></TD>
    <TD class="scFormDataOdd css_cliecodigon_line" id="hidden_field_data_cliecodigon" style="<?php echo $sStyleHidden_cliecodigon; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliecodigon_line" style="vertical-align: top;padding: 0px">
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { 
 ?>
<span id="id_read_on_cliecodigon" css_cliecodigon_line" style="<?php echo $sStyleReadLab_cliecodigon; ?>"><?php echo $this->form_encode_input($this->cliecodigon); ?></span><span id="id_read_off_cliecodigon" style="<?php echo $sStyleReadInp_cliecodigon; ?>"><input type="hidden" name="cliecodigon" value="<?php echo $this->form_encode_input($cliecodigon) . "\">"?><span id="id_ajax_label_cliecodigon"><?php echo nl2br($cliecodigon); ?></span>
</span><?php } else { ?>
&nbsp;
<?php } ?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliecodigon_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliecodigon_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['tiidcodigos']))
   {
       $this->nm_new_label['tiidcodigos'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_tiidcodigos'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tiidcodigos = $this->tiidcodigos;
   $sStyleHidden_tiidcodigos = '';
   if (isset($this->nmgp_cmp_hidden['tiidcodigos']) && $this->nmgp_cmp_hidden['tiidcodigos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tiidcodigos']);
       $sStyleHidden_tiidcodigos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tiidcodigos = 'display: none;';
   $sStyleReadInp_tiidcodigos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tiidcodigos']) && $this->nmgp_cmp_readonly['tiidcodigos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tiidcodigos']);
       $sStyleReadLab_tiidcodigos = '';
       $sStyleReadInp_tiidcodigos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tiidcodigos']) && $this->nmgp_cmp_hidden['tiidcodigos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tiidcodigos" value="<?php echo $this->form_encode_input($this->tiidcodigos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tiidcodigos_label" id="hidden_field_label_tiidcodigos" style="<?php echo $sStyleHidden_tiidcodigos; ?>"><span id="id_label_tiidcodigos"><?php echo $this->nm_new_label['tiidcodigos']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['tiidcodigos']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['tiidcodigos'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_tiidcodigos_line" id="hidden_field_data_tiidcodigos" style="<?php echo $sStyleHidden_tiidcodigos; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tiidcodigos_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tiidcodigos"]) &&  $this->nmgp_cmp_readonly["tiidcodigos"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos'] = array(); 
    }

   $old_value_cliecodigon = $this->cliecodigon;
   $old_value_cliefcharegd = $this->cliefcharegd;
   $old_value_cliefcharegd_hora = $this->cliefcharegd_hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_cliecodigon = $this->cliecodigon;
   $unformatted_value_cliefcharegd = $this->cliefcharegd;
   $unformatted_value_cliefcharegd_hora = $this->cliefcharegd_hora;

   $nm_comando = "SELECT tiidcodigos, tiidnombres  FROM tiposidentifis  ORDER BY tiidnombres";

   $this->cliecodigon = $old_value_cliecodigon;
   $this->cliefcharegd = $old_value_cliefcharegd;
   $this->cliefcharegd_hora = $old_value_cliefcharegd_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos'][] = $rs->fields[0];
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
   $tiidcodigos_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tiidcodigos_1))
          {
              foreach ($this->tiidcodigos_1 as $tmp_tiidcodigos)
              {
                  if (trim($tmp_tiidcodigos) === trim($cadaselect[1])) { $tiidcodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tiidcodigos) === trim($cadaselect[1])) { $tiidcodigos_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tiidcodigos" value="<?php echo $this->form_encode_input($tiidcodigos) . "\">" . $tiidcodigos_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tiidcodigos();
   $x = 0 ; 
   $tiidcodigos_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tiidcodigos_1))
          {
              foreach ($this->tiidcodigos_1 as $tmp_tiidcodigos)
              {
                  if (trim($tmp_tiidcodigos) === trim($cadaselect[1])) { $tiidcodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tiidcodigos) === trim($cadaselect[1])) { $tiidcodigos_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tiidcodigos_look))
          {
              $tiidcodigos_look = $this->tiidcodigos;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tiidcodigos\" class=\"css_tiidcodigos_line\" style=\"" .  $sStyleReadLab_tiidcodigos . "\">" . $this->form_encode_input($tiidcodigos_look) . "</span><span id=\"id_read_off_tiidcodigos\" style=\"" . $sStyleReadInp_tiidcodigos . "\">";
   echo " <span id=\"idAjaxSelect_tiidcodigos\"><select class=\"sc-js-input scFormObjectOdd css_tiidcodigos_obj\" style=\"\" id=\"id_sc_field_tiidcodigos\" name=\"tiidcodigos\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_tiidcodigos'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tiidcodigos) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tiidcodigos)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tiidcodigos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tiidcodigos_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['clieidentifs']))
    {
        $this->nm_new_label['clieidentifs'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_clieidentifs'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $clieidentifs = $this->clieidentifs;
   $sStyleHidden_clieidentifs = '';
   if (isset($this->nmgp_cmp_hidden['clieidentifs']) && $this->nmgp_cmp_hidden['clieidentifs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['clieidentifs']);
       $sStyleHidden_clieidentifs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_clieidentifs = 'display: none;';
   $sStyleReadInp_clieidentifs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['clieidentifs']) && $this->nmgp_cmp_readonly['clieidentifs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['clieidentifs']);
       $sStyleReadLab_clieidentifs = '';
       $sStyleReadInp_clieidentifs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['clieidentifs']) && $this->nmgp_cmp_hidden['clieidentifs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="clieidentifs" value="<?php echo $this->form_encode_input($clieidentifs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_clieidentifs_label" id="hidden_field_label_clieidentifs" style="<?php echo $sStyleHidden_clieidentifs; ?>"><span id="id_label_clieidentifs"><?php echo $this->nm_new_label['clieidentifs']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['clieidentifs']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['clieidentifs'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_clieidentifs_line" id="hidden_field_data_clieidentifs" style="<?php echo $sStyleHidden_clieidentifs; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_clieidentifs_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["clieidentifs"]) &&  $this->nmgp_cmp_readonly["clieidentifs"] == "on") { 

 ?>
<input type="hidden" name="clieidentifs" value="<?php echo $this->form_encode_input($clieidentifs) . "\">" . $clieidentifs . ""; ?>
<?php } else { ?>
<span id="id_read_on_clieidentifs" class="sc-ui-readonly-clieidentifs css_clieidentifs_line" style="<?php echo $sStyleReadLab_clieidentifs; ?>"><?php echo $this->form_encode_input($this->clieidentifs); ?></span><span id="id_read_off_clieidentifs" style="white-space: nowrap;<?php echo $sStyleReadInp_clieidentifs; ?>">
 <input class="sc-js-input scFormObjectOdd css_clieidentifs_obj" style="" id="id_sc_field_clieidentifs" type=text name="clieidentifs" value="<?php echo $this->form_encode_input($clieidentifs) ?>"
 size=15 maxlength=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_clieidentifs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_clieidentifs_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['clienombres']))
    {
        $this->nm_new_label['clienombres'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_clienombres'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $clienombres = $this->clienombres;
   $sStyleHidden_clienombres = '';
   if (isset($this->nmgp_cmp_hidden['clienombres']) && $this->nmgp_cmp_hidden['clienombres'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['clienombres']);
       $sStyleHidden_clienombres = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_clienombres = 'display: none;';
   $sStyleReadInp_clienombres = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['clienombres']) && $this->nmgp_cmp_readonly['clienombres'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['clienombres']);
       $sStyleReadLab_clienombres = '';
       $sStyleReadInp_clienombres = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['clienombres']) && $this->nmgp_cmp_hidden['clienombres'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="clienombres" value="<?php echo $this->form_encode_input($clienombres) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_clienombres_label" id="hidden_field_label_clienombres" style="<?php echo $sStyleHidden_clienombres; ?>"><span id="id_label_clienombres"><?php echo $this->nm_new_label['clienombres']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['clienombres']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['clienombres'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_clienombres_line" id="hidden_field_data_clienombres" style="<?php echo $sStyleHidden_clienombres; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_clienombres_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["clienombres"]) &&  $this->nmgp_cmp_readonly["clienombres"] == "on") { 

 ?>
<input type="hidden" name="clienombres" value="<?php echo $this->form_encode_input($clienombres) . "\">" . $clienombres . ""; ?>
<?php } else { ?>
<span id="id_read_on_clienombres" class="sc-ui-readonly-clienombres css_clienombres_line" style="<?php echo $sStyleReadLab_clienombres; ?>"><?php echo $this->form_encode_input($this->clienombres); ?></span><span id="id_read_off_clienombres" style="white-space: nowrap;<?php echo $sStyleReadInp_clienombres; ?>">
 <input class="sc-js-input scFormObjectOdd css_clienombres_obj" style="" id="id_sc_field_clienombres" type=text name="clienombres" value="<?php echo $this->form_encode_input($clienombres) ?>"
 size=30 maxlength=250 alt="{datatype: 'text', maxLength: 250, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_clienombres_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_clienombres_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable" width="100%" style="height: 100%;">   <tr>


    <TD colspan="4" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf1\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_clientes_bl_2'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['paiscodigos']))
   {
       $this->nm_new_label['paiscodigos'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_paiscodigos'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $paiscodigos = $this->paiscodigos;
   $sStyleHidden_paiscodigos = '';
   if (isset($this->nmgp_cmp_hidden['paiscodigos']) && $this->nmgp_cmp_hidden['paiscodigos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['paiscodigos']);
       $sStyleHidden_paiscodigos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_paiscodigos = 'display: none;';
   $sStyleReadInp_paiscodigos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['paiscodigos']) && $this->nmgp_cmp_readonly['paiscodigos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['paiscodigos']);
       $sStyleReadLab_paiscodigos = '';
       $sStyleReadInp_paiscodigos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['paiscodigos']) && $this->nmgp_cmp_hidden['paiscodigos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="paiscodigos" value="<?php echo $this->form_encode_input($this->paiscodigos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_paiscodigos_label" id="hidden_field_label_paiscodigos" style="<?php echo $sStyleHidden_paiscodigos; ?>"><span id="id_label_paiscodigos"><?php echo $this->nm_new_label['paiscodigos']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['paiscodigos']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['paiscodigos'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_paiscodigos_line" id="hidden_field_data_paiscodigos" style="<?php echo $sStyleHidden_paiscodigos; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_paiscodigos_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["paiscodigos"]) &&  $this->nmgp_cmp_readonly["paiscodigos"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos'] = array(); 
    }

   $old_value_cliecodigon = $this->cliecodigon;
   $old_value_cliefcharegd = $this->cliefcharegd;
   $old_value_cliefcharegd_hora = $this->cliefcharegd_hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_cliecodigon = $this->cliecodigon;
   $unformatted_value_cliefcharegd = $this->cliefcharegd;
   $unformatted_value_cliefcharegd_hora = $this->cliefcharegd_hora;

   $nm_comando = "SELECT paiscodigos, paisnombres  FROM paises  ORDER BY paisnombres";

   $this->cliecodigon = $old_value_cliecodigon;
   $this->cliefcharegd = $old_value_cliefcharegd;
   $this->cliefcharegd_hora = $old_value_cliefcharegd_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos'][] = $rs->fields[0];
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
   $paiscodigos_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->paiscodigos_1))
          {
              foreach ($this->paiscodigos_1 as $tmp_paiscodigos)
              {
                  if (trim($tmp_paiscodigos) === trim($cadaselect[1])) { $paiscodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->paiscodigos) === trim($cadaselect[1])) { $paiscodigos_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="paiscodigos" value="<?php echo $this->form_encode_input($paiscodigos) . "\">" . $paiscodigos_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_paiscodigos();
   $x = 0 ; 
   $paiscodigos_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->paiscodigos_1))
          {
              foreach ($this->paiscodigos_1 as $tmp_paiscodigos)
              {
                  if (trim($tmp_paiscodigos) === trim($cadaselect[1])) { $paiscodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->paiscodigos) === trim($cadaselect[1])) { $paiscodigos_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($paiscodigos_look))
          {
              $paiscodigos_look = $this->paiscodigos;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_paiscodigos\" class=\"css_paiscodigos_line\" style=\"" .  $sStyleReadLab_paiscodigos . "\">" . $this->form_encode_input($paiscodigos_look) . "</span><span id=\"id_read_off_paiscodigos\" style=\"" . $sStyleReadInp_paiscodigos . "\">";
   echo " <span id=\"idAjaxSelect_paiscodigos\"><select class=\"sc-js-input scFormObjectOdd css_paiscodigos_obj\" style=\"\" id=\"id_sc_field_paiscodigos\" name=\"paiscodigos\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_paiscodigos'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->paiscodigos) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->paiscodigos)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_paiscodigos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_paiscodigos_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['cliedireccis']))
    {
        $this->nm_new_label['cliedireccis'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliedireccis'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliedireccis = $this->cliedireccis;
   $sStyleHidden_cliedireccis = '';
   if (isset($this->nmgp_cmp_hidden['cliedireccis']) && $this->nmgp_cmp_hidden['cliedireccis'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliedireccis']);
       $sStyleHidden_cliedireccis = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliedireccis = 'display: none;';
   $sStyleReadInp_cliedireccis = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliedireccis']) && $this->nmgp_cmp_readonly['cliedireccis'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliedireccis']);
       $sStyleReadLab_cliedireccis = '';
       $sStyleReadInp_cliedireccis = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliedireccis']) && $this->nmgp_cmp_hidden['cliedireccis'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliedireccis" value="<?php echo $this->form_encode_input($cliedireccis) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliedireccis_label" id="hidden_field_label_cliedireccis" style="<?php echo $sStyleHidden_cliedireccis; ?>"><span id="id_label_cliedireccis"><?php echo $this->nm_new_label['cliedireccis']; ?></span></TD>
    <TD class="scFormDataOdd css_cliedireccis_line" id="hidden_field_data_cliedireccis" style="<?php echo $sStyleHidden_cliedireccis; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliedireccis_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliedireccis"]) &&  $this->nmgp_cmp_readonly["cliedireccis"] == "on") { 

 ?>
<input type="hidden" name="cliedireccis" value="<?php echo $this->form_encode_input($cliedireccis) . "\">" . $cliedireccis . ""; ?>
<?php } else { ?>
<span id="id_read_on_cliedireccis" class="sc-ui-readonly-cliedireccis css_cliedireccis_line" style="<?php echo $sStyleReadLab_cliedireccis; ?>"><?php echo $this->form_encode_input($this->cliedireccis); ?></span><span id="id_read_off_cliedireccis" style="white-space: nowrap;<?php echo $sStyleReadInp_cliedireccis; ?>">
 <input class="sc-js-input scFormObjectOdd css_cliedireccis_obj" style="" id="id_sc_field_cliedireccis" type=text name="cliedireccis" value="<?php echo $this->form_encode_input($cliedireccis) ?>"
 size=30 maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliedireccis_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliedireccis_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['clietelfijs']))
    {
        $this->nm_new_label['clietelfijs'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_clietelfijs'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $clietelfijs = $this->clietelfijs;
   $sStyleHidden_clietelfijs = '';
   if (isset($this->nmgp_cmp_hidden['clietelfijs']) && $this->nmgp_cmp_hidden['clietelfijs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['clietelfijs']);
       $sStyleHidden_clietelfijs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_clietelfijs = 'display: none;';
   $sStyleReadInp_clietelfijs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['clietelfijs']) && $this->nmgp_cmp_readonly['clietelfijs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['clietelfijs']);
       $sStyleReadLab_clietelfijs = '';
       $sStyleReadInp_clietelfijs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['clietelfijs']) && $this->nmgp_cmp_hidden['clietelfijs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="clietelfijs" value="<?php echo $this->form_encode_input($clietelfijs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_clietelfijs_label" id="hidden_field_label_clietelfijs" style="<?php echo $sStyleHidden_clietelfijs; ?>"><span id="id_label_clietelfijs"><?php echo $this->nm_new_label['clietelfijs']; ?></span></TD>
    <TD class="scFormDataOdd css_clietelfijs_line" id="hidden_field_data_clietelfijs" style="<?php echo $sStyleHidden_clietelfijs; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_clietelfijs_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["clietelfijs"]) &&  $this->nmgp_cmp_readonly["clietelfijs"] == "on") { 

 ?>
<input type="hidden" name="clietelfijs" value="<?php echo $this->form_encode_input($clietelfijs) . "\">" . $clietelfijs . ""; ?>
<?php } else { ?>
<span id="id_read_on_clietelfijs" class="sc-ui-readonly-clietelfijs css_clietelfijs_line" style="<?php echo $sStyleReadLab_clietelfijs; ?>"><?php echo $this->form_encode_input($this->clietelfijs); ?></span><span id="id_read_off_clietelfijs" style="white-space: nowrap;<?php echo $sStyleReadInp_clietelfijs; ?>">
 <input class="sc-js-input scFormObjectOdd css_clietelfijs_obj" style="" id="id_sc_field_clietelfijs" type=text name="clietelfijs" value="<?php echo $this->form_encode_input($clietelfijs) ?>"
 size=15 maxlength=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_clietelfijs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_clietelfijs_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['cliepagwebs']))
    {
        $this->nm_new_label['cliepagwebs'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliepagwebs'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliepagwebs = $this->cliepagwebs;
   $sStyleHidden_cliepagwebs = '';
   if (isset($this->nmgp_cmp_hidden['cliepagwebs']) && $this->nmgp_cmp_hidden['cliepagwebs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliepagwebs']);
       $sStyleHidden_cliepagwebs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliepagwebs = 'display: none;';
   $sStyleReadInp_cliepagwebs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliepagwebs']) && $this->nmgp_cmp_readonly['cliepagwebs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliepagwebs']);
       $sStyleReadLab_cliepagwebs = '';
       $sStyleReadInp_cliepagwebs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliepagwebs']) && $this->nmgp_cmp_hidden['cliepagwebs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliepagwebs" value="<?php echo $this->form_encode_input($cliepagwebs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliepagwebs_label" id="hidden_field_label_cliepagwebs" style="<?php echo $sStyleHidden_cliepagwebs; ?>"><span id="id_label_cliepagwebs"><?php echo $this->nm_new_label['cliepagwebs']; ?></span></TD>
    <TD class="scFormDataOdd css_cliepagwebs_line" id="hidden_field_data_cliepagwebs" style="<?php echo $sStyleHidden_cliepagwebs; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliepagwebs_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliepagwebs"]) &&  $this->nmgp_cmp_readonly["cliepagwebs"] == "on") { 

 ?>
<input type="hidden" name="cliepagwebs" value="<?php echo $this->form_encode_input($cliepagwebs) . "\">" . $cliepagwebs . ""; ?>
<?php } else { ?>
<span id="id_read_on_cliepagwebs" class="sc-ui-readonly-cliepagwebs css_cliepagwebs_line" style="<?php echo $sStyleReadLab_cliepagwebs; ?>"><?php echo $this->form_encode_input($this->cliepagwebs); ?></span><span id="id_read_off_cliepagwebs" style="white-space: nowrap;<?php echo $sStyleReadInp_cliepagwebs; ?>">
 <input class="sc-js-input scFormObjectOdd css_cliepagwebs_obj" style="" id="id_sc_field_cliepagwebs" type=text name="cliepagwebs" value="<?php echo $this->form_encode_input($cliepagwebs) ?>"
 size=30 maxlength=120 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.cliepagwebs.value), '_blank')", "window.open(nm_link_url(document.F1.cliepagwebs.value), '_blank')", "cliepagwebs_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliepagwebs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliepagwebs_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable" width="100%" style="height: 100%;">   <tr>


    <TD colspan="4" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf2\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_clientes_bl_3'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cliecontacts']))
    {
        $this->nm_new_label['cliecontacts'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliecontacts'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliecontacts = $this->cliecontacts;
   $sStyleHidden_cliecontacts = '';
   if (isset($this->nmgp_cmp_hidden['cliecontacts']) && $this->nmgp_cmp_hidden['cliecontacts'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliecontacts']);
       $sStyleHidden_cliecontacts = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliecontacts = 'display: none;';
   $sStyleReadInp_cliecontacts = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliecontacts']) && $this->nmgp_cmp_readonly['cliecontacts'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliecontacts']);
       $sStyleReadLab_cliecontacts = '';
       $sStyleReadInp_cliecontacts = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliecontacts']) && $this->nmgp_cmp_hidden['cliecontacts'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliecontacts" value="<?php echo $this->form_encode_input($cliecontacts) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliecontacts_label" id="hidden_field_label_cliecontacts" style="<?php echo $sStyleHidden_cliecontacts; ?>"><span id="id_label_cliecontacts"><?php echo $this->nm_new_label['cliecontacts']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['cliecontacts']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['cliecontacts'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_cliecontacts_line" id="hidden_field_data_cliecontacts" style="<?php echo $sStyleHidden_cliecontacts; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliecontacts_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliecontacts"]) &&  $this->nmgp_cmp_readonly["cliecontacts"] == "on") { 

 ?>
<input type="hidden" name="cliecontacts" value="<?php echo $this->form_encode_input($cliecontacts) . "\">" . $cliecontacts . ""; ?>
<?php } else { ?>
<span id="id_read_on_cliecontacts" class="sc-ui-readonly-cliecontacts css_cliecontacts_line" style="<?php echo $sStyleReadLab_cliecontacts; ?>"><?php echo $this->form_encode_input($this->cliecontacts); ?></span><span id="id_read_off_cliecontacts" style="white-space: nowrap;<?php echo $sStyleReadInp_cliecontacts; ?>">
 <input class="sc-js-input scFormObjectOdd css_cliecontacts_obj" style="" id="id_sc_field_cliecontacts" type=text name="cliecontacts" value="<?php echo $this->form_encode_input($cliecontacts) ?>"
 size=30 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliecontacts_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliecontacts_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['cliecelconts']))
    {
        $this->nm_new_label['cliecelconts'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliecelconts'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliecelconts = $this->cliecelconts;
   $sStyleHidden_cliecelconts = '';
   if (isset($this->nmgp_cmp_hidden['cliecelconts']) && $this->nmgp_cmp_hidden['cliecelconts'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliecelconts']);
       $sStyleHidden_cliecelconts = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliecelconts = 'display: none;';
   $sStyleReadInp_cliecelconts = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliecelconts']) && $this->nmgp_cmp_readonly['cliecelconts'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliecelconts']);
       $sStyleReadLab_cliecelconts = '';
       $sStyleReadInp_cliecelconts = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliecelconts']) && $this->nmgp_cmp_hidden['cliecelconts'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliecelconts" value="<?php echo $this->form_encode_input($cliecelconts) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliecelconts_label" id="hidden_field_label_cliecelconts" style="<?php echo $sStyleHidden_cliecelconts; ?>"><span id="id_label_cliecelconts"><?php echo $this->nm_new_label['cliecelconts']; ?></span></TD>
    <TD class="scFormDataOdd css_cliecelconts_line" id="hidden_field_data_cliecelconts" style="<?php echo $sStyleHidden_cliecelconts; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliecelconts_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliecelconts"]) &&  $this->nmgp_cmp_readonly["cliecelconts"] == "on") { 

 ?>
<input type="hidden" name="cliecelconts" value="<?php echo $this->form_encode_input($cliecelconts) . "\">" . $cliecelconts . ""; ?>
<?php } else { ?>
<span id="id_read_on_cliecelconts" class="sc-ui-readonly-cliecelconts css_cliecelconts_line" style="<?php echo $sStyleReadLab_cliecelconts; ?>"><?php echo $this->form_encode_input($this->cliecelconts); ?></span><span id="id_read_off_cliecelconts" style="white-space: nowrap;<?php echo $sStyleReadInp_cliecelconts; ?>">
 <input class="sc-js-input scFormObjectOdd css_cliecelconts_obj" style="" id="id_sc_field_cliecelconts" type=text name="cliecelconts" value="<?php echo $this->form_encode_input($cliecelconts) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliecelconts_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliecelconts_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cliemailcons']))
    {
        $this->nm_new_label['cliemailcons'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliemailcons'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cliemailcons = $this->cliemailcons;
   $sStyleHidden_cliemailcons = '';
   if (isset($this->nmgp_cmp_hidden['cliemailcons']) && $this->nmgp_cmp_hidden['cliemailcons'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliemailcons']);
       $sStyleHidden_cliemailcons = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliemailcons = 'display: none;';
   $sStyleReadInp_cliemailcons = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cliemailcons']) && $this->nmgp_cmp_readonly['cliemailcons'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliemailcons']);
       $sStyleReadLab_cliemailcons = '';
       $sStyleReadInp_cliemailcons = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliemailcons']) && $this->nmgp_cmp_hidden['cliemailcons'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliemailcons" value="<?php echo $this->form_encode_input($cliemailcons) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliemailcons_label" id="hidden_field_label_cliemailcons" style="<?php echo $sStyleHidden_cliemailcons; ?>"><span id="id_label_cliemailcons"><?php echo $this->nm_new_label['cliemailcons']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['cliemailcons']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['cliemailcons'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_cliemailcons_line" id="hidden_field_data_cliemailcons" style="<?php echo $sStyleHidden_cliemailcons; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliemailcons_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cliemailcons"]) &&  $this->nmgp_cmp_readonly["cliemailcons"] == "on") { 

 ?>
<input type="hidden" name="cliemailcons" value="<?php echo $this->form_encode_input($cliemailcons) . "\">" . $cliemailcons . ""; ?>
<?php } else { ?>
<span id="id_read_on_cliemailcons" class="sc-ui-readonly-cliemailcons css_cliemailcons_line" style="<?php echo $sStyleReadLab_cliemailcons; ?>"><?php echo $this->form_encode_input($this->cliemailcons); ?></span><span id="id_read_off_cliemailcons" style="white-space: nowrap;<?php echo $sStyleReadInp_cliemailcons; ?>">
 <input class="sc-js-input scFormObjectOdd css_cliemailcons_obj" style="" id="id_sc_field_cliemailcons" type=text name="cliemailcons" value="<?php echo $this->form_encode_input($cliemailcons) ?>"
 size=30 maxlength=60 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.cliemailcons.value != '') {window.open('mailto:' + document.F1.cliemailcons.value); }", "if (document.F1.cliemailcons.value != '') {window.open('mailto:' + document.F1.cliemailcons.value); }", "cliemailcons_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliemailcons_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliemailcons_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="2" >&nbsp;</TD>
<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable" width="100%" style="height: 100%;">   <tr>


    <TD colspan="4" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf3\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_clientes_bl_4'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['cliefcharegd']))
           {
               $this->nmgp_cmp_readonly['cliefcharegd'] = 'on';
           }
?>


   <?php
   if (!isset($this->nm_new_label['esclcodigos']))
   {
       $this->nm_new_label['esclcodigos'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_esclcodigos'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $esclcodigos = $this->esclcodigos;
   $sStyleHidden_esclcodigos = '';
   if (isset($this->nmgp_cmp_hidden['esclcodigos']) && $this->nmgp_cmp_hidden['esclcodigos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['esclcodigos']);
       $sStyleHidden_esclcodigos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_esclcodigos = 'display: none;';
   $sStyleReadInp_esclcodigos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['esclcodigos']) && $this->nmgp_cmp_readonly['esclcodigos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['esclcodigos']);
       $sStyleReadLab_esclcodigos = '';
       $sStyleReadInp_esclcodigos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['esclcodigos']) && $this->nmgp_cmp_hidden['esclcodigos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="esclcodigos" value="<?php echo $this->form_encode_input($this->esclcodigos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_esclcodigos_label" id="hidden_field_label_esclcodigos" style="<?php echo $sStyleHidden_esclcodigos; ?>"><span id="id_label_esclcodigos"><?php echo $this->nm_new_label['esclcodigos']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['esclcodigos']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['esclcodigos'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_esclcodigos_line" id="hidden_field_data_esclcodigos" style="<?php echo $sStyleHidden_esclcodigos; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_esclcodigos_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["esclcodigos"]) &&  $this->nmgp_cmp_readonly["esclcodigos"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos'] = array(); 
    }

   $old_value_cliecodigon = $this->cliecodigon;
   $old_value_cliefcharegd = $this->cliefcharegd;
   $old_value_cliefcharegd_hora = $this->cliefcharegd_hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_cliecodigon = $this->cliecodigon;
   $unformatted_value_cliefcharegd = $this->cliefcharegd;
   $unformatted_value_cliefcharegd_hora = $this->cliefcharegd_hora;

   $nm_comando = "SELECT esclcodigos, esclnombres  FROM estadosclientes  ORDER BY esclnombres";

   $this->cliecodigon = $old_value_cliecodigon;
   $this->cliefcharegd = $old_value_cliefcharegd;
   $this->cliefcharegd_hora = $old_value_cliefcharegd_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos'][] = $rs->fields[0];
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
   $esclcodigos_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->esclcodigos_1))
          {
              foreach ($this->esclcodigos_1 as $tmp_esclcodigos)
              {
                  if (trim($tmp_esclcodigos) === trim($cadaselect[1])) { $esclcodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->esclcodigos) === trim($cadaselect[1])) { $esclcodigos_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="esclcodigos" value="<?php echo $this->form_encode_input($esclcodigos) . "\">" . $esclcodigos_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_esclcodigos();
   $x = 0 ; 
   $esclcodigos_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->esclcodigos_1))
          {
              foreach ($this->esclcodigos_1 as $tmp_esclcodigos)
              {
                  if (trim($tmp_esclcodigos) === trim($cadaselect[1])) { $esclcodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->esclcodigos) === trim($cadaselect[1])) { $esclcodigos_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($esclcodigos_look))
          {
              $esclcodigos_look = $this->esclcodigos;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_esclcodigos\" class=\"css_esclcodigos_line\" style=\"" .  $sStyleReadLab_esclcodigos . "\">" . $this->form_encode_input($esclcodigos_look) . "</span><span id=\"id_read_off_esclcodigos\" style=\"" . $sStyleReadInp_esclcodigos . "\">";
   echo " <span id=\"idAjaxSelect_esclcodigos\"><select class=\"sc-js-input scFormObjectOdd css_esclcodigos_obj\" style=\"\" id=\"id_sc_field_esclcodigos\" name=\"esclcodigos\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_esclcodigos'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->esclcodigos) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->esclcodigos)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_esclcodigos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_esclcodigos_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['ticlcodigos']))
   {
       $this->nm_new_label['ticlcodigos'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_ticlcodigos'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ticlcodigos = $this->ticlcodigos;
   $sStyleHidden_ticlcodigos = '';
   if (isset($this->nmgp_cmp_hidden['ticlcodigos']) && $this->nmgp_cmp_hidden['ticlcodigos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ticlcodigos']);
       $sStyleHidden_ticlcodigos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ticlcodigos = 'display: none;';
   $sStyleReadInp_ticlcodigos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ticlcodigos']) && $this->nmgp_cmp_readonly['ticlcodigos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ticlcodigos']);
       $sStyleReadLab_ticlcodigos = '';
       $sStyleReadInp_ticlcodigos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ticlcodigos']) && $this->nmgp_cmp_hidden['ticlcodigos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ticlcodigos" value="<?php echo $this->form_encode_input($this->ticlcodigos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ticlcodigos_label" id="hidden_field_label_ticlcodigos" style="<?php echo $sStyleHidden_ticlcodigos; ?>"><span id="id_label_ticlcodigos"><?php echo $this->nm_new_label['ticlcodigos']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['ticlcodigos']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['php_cmp_required']['ticlcodigos'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_ticlcodigos_line" id="hidden_field_data_ticlcodigos" style="<?php echo $sStyleHidden_ticlcodigos; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ticlcodigos_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ticlcodigos"]) &&  $this->nmgp_cmp_readonly["ticlcodigos"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos'] = array(); 
    }

   $old_value_cliecodigon = $this->cliecodigon;
   $old_value_cliefcharegd = $this->cliefcharegd;
   $old_value_cliefcharegd_hora = $this->cliefcharegd_hora;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_cliecodigon = $this->cliecodigon;
   $unformatted_value_cliefcharegd = $this->cliefcharegd;
   $unformatted_value_cliefcharegd_hora = $this->cliefcharegd_hora;

   $nm_comando = "SELECT ticlcodigos, ticlnombres  FROM tiposclientes  ORDER BY ticlnombres";

   $this->cliecodigon = $old_value_cliecodigon;
   $this->cliefcharegd = $old_value_cliefcharegd;
   $this->cliefcharegd_hora = $old_value_cliefcharegd_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos'][] = $rs->fields[0];
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
   $ticlcodigos_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ticlcodigos_1))
          {
              foreach ($this->ticlcodigos_1 as $tmp_ticlcodigos)
              {
                  if (trim($tmp_ticlcodigos) === trim($cadaselect[1])) { $ticlcodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->ticlcodigos) === trim($cadaselect[1])) { $ticlcodigos_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="ticlcodigos" value="<?php echo $this->form_encode_input($ticlcodigos) . "\">" . $ticlcodigos_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_ticlcodigos();
   $x = 0 ; 
   $ticlcodigos_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ticlcodigos_1))
          {
              foreach ($this->ticlcodigos_1 as $tmp_ticlcodigos)
              {
                  if (trim($tmp_ticlcodigos) === trim($cadaselect[1])) { $ticlcodigos_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->ticlcodigos) === trim($cadaselect[1])) { $ticlcodigos_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($ticlcodigos_look))
          {
              $ticlcodigos_look = $this->ticlcodigos;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_ticlcodigos\" class=\"css_ticlcodigos_line\" style=\"" .  $sStyleReadLab_ticlcodigos . "\">" . $this->form_encode_input($ticlcodigos_look) . "</span><span id=\"id_read_off_ticlcodigos\" style=\"" . $sStyleReadInp_ticlcodigos . "\">";
   echo " <span id=\"idAjaxSelect_ticlcodigos\"><select class=\"sc-js-input scFormObjectOdd css_ticlcodigos_obj\" style=\"\" id=\"id_sc_field_ticlcodigos\" name=\"ticlcodigos\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_ticlcodigos'][] = ''; 
   echo "  <option value=\"\">" . $this->Ini->Nm_lang['lang_select_opcion'] . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->ticlcodigos) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->ticlcodigos)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ticlcodigos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ticlcodigos_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_4"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_4"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable" width="100%" style="height: 100%;">   <tr>


    <TD colspan="4" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf4\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;\" class=\"scFormBlockAlign\">"; } ?><?php echo $this->Ini->Nm_lang['lang_clientes_bl_5'] ?><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>
   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cliefcharegd']))
    {
        $this->nm_new_label['cliefcharegd'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_cliefcharegd'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_cliefcharegd = $this->cliefcharegd;
   $this->cliefcharegd .= ' ' . $this->cliefcharegd_hora;
   $cliefcharegd = $this->cliefcharegd;
   $sStyleHidden_cliefcharegd = '';
   if (isset($this->nmgp_cmp_hidden['cliefcharegd']) && $this->nmgp_cmp_hidden['cliefcharegd'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cliefcharegd']);
       $sStyleHidden_cliefcharegd = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cliefcharegd = 'display: none;';
   $sStyleReadInp_cliefcharegd = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["cliefcharegd"]) &&  $this->nmgp_cmp_readonly["cliefcharegd"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cliefcharegd']);
       $sStyleReadLab_cliefcharegd = '';
       $sStyleReadInp_cliefcharegd = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cliefcharegd']) && $this->nmgp_cmp_hidden['cliefcharegd'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cliefcharegd" value="<?php echo $this->form_encode_input($cliefcharegd) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cliefcharegd_label" id="hidden_field_label_cliefcharegd" style="<?php echo $sStyleHidden_cliefcharegd; ?>"><span id="id_label_cliefcharegd"><?php echo $this->nm_new_label['cliefcharegd']; ?></span></TD>
    <TD class="scFormDataOdd css_cliefcharegd_line" id="hidden_field_data_cliefcharegd" style="<?php echo $sStyleHidden_cliefcharegd; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cliefcharegd_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["cliefcharegd"]) &&  $this->nmgp_cmp_readonly["cliefcharegd"] == "on")) { 

 ?>
<input type="hidden" name="cliefcharegd" value="<?php echo $this->form_encode_input($cliefcharegd) . "\"><span id=\"id_ajax_label_cliefcharegd\">" . $cliefcharegd . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_cliefcharegd" class="sc-ui-readonly-cliefcharegd css_cliefcharegd_line" style="<?php echo $sStyleReadLab_cliefcharegd; ?>"><?php echo $this->form_encode_input($cliefcharegd); ?></span><span id="id_read_off_cliefcharegd" style="white-space: nowrap;<?php echo $sStyleReadInp_cliefcharegd; ?>">
 <input class="sc-js-input scFormObjectOdd css_cliefcharegd_obj" style="" id="id_sc_field_cliefcharegd" type=text name="cliefcharegd" value="<?php echo $this->form_encode_input($cliefcharegd) ?>"
 size=18 alt="{datatype: 'datetime', dateSep: '<?php echo $this->field_config['cliefcharegd']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['cliefcharegd']['date_format']; ?>', timeSep: '<?php echo $this->field_config['cliefcharegd']['time_sep']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['cliefcharegd']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<?php echo $tmp_form_data; ?></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cliefcharegd_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cliefcharegd_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->cliefcharegd = $old_dt_cliefcharegd;
?>

   <?php
   if (!isset($this->nm_new_label['clieactivos']))
   {
       $this->nm_new_label['clieactivos'] = "" . $this->Ini->Nm_lang['lang_clientes_fld_clieactivos'] . "";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $clieactivos = $this->clieactivos;
   $sStyleHidden_clieactivos = '';
   if (isset($this->nmgp_cmp_hidden['clieactivos']) && $this->nmgp_cmp_hidden['clieactivos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['clieactivos']);
       $sStyleHidden_clieactivos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_clieactivos = 'display: none;';
   $sStyleReadInp_clieactivos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['clieactivos']) && $this->nmgp_cmp_readonly['clieactivos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['clieactivos']);
       $sStyleReadLab_clieactivos = '';
       $sStyleReadInp_clieactivos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['clieactivos']) && $this->nmgp_cmp_hidden['clieactivos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="clieactivos" value="<?php echo $this->form_encode_input($this->clieactivos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_clieactivos_label" id="hidden_field_label_clieactivos" style="<?php echo $sStyleHidden_clieactivos; ?>"><span id="id_label_clieactivos"><?php echo $this->nm_new_label['clieactivos']; ?></span></TD>
    <TD class="scFormDataOdd css_clieactivos_line" id="hidden_field_data_clieactivos" style="<?php echo $sStyleHidden_clieactivos; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_clieactivos_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["clieactivos"]) &&  $this->nmgp_cmp_readonly["clieactivos"] == "on") { 

$clieactivos_look = "";
 if ($this->clieactivos == "A") { $clieactivos_look .= "" . $this->Ini->Nm_lang['lang_select_activo'] . "" ;} 
 if ($this->clieactivos == "I") { $clieactivos_look .= "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "" ;} 
 if (empty($clieactivos_look)) { $clieactivos_look = $this->clieactivos; }
?>
<input type="hidden" name="clieactivos" value="<?php echo $this->form_encode_input($clieactivos) . "\">" . $clieactivos_look . ""; ?>
<?php } else { ?>
<?php

$clieactivos_look = "";
 if ($this->clieactivos == "A") { $clieactivos_look .= "" . $this->Ini->Nm_lang['lang_select_activo'] . "" ;} 
 if ($this->clieactivos == "I") { $clieactivos_look .= "" . $this->Ini->Nm_lang['lang_select_inactivo'] . "" ;} 
 if (empty($clieactivos_look)) { $clieactivos_look = $this->clieactivos; }
?>
<span id="id_read_on_clieactivos" class="css_clieactivos_line"  style="<?php echo $sStyleReadLab_clieactivos; ?>"><?php echo $this->form_encode_input($clieactivos_look); ?></span><span id="id_read_off_clieactivos" style="<?php echo $sStyleReadInp_clieactivos; ?>">
 <span id="idAjaxSelect_clieactivos"><select class="sc-js-input scFormObjectOdd css_clieactivos_obj" style="" id="id_sc_field_clieactivos" name="clieactivos" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->clieactivos == "A") { echo " selected" ;} ?><?php  if (empty($this->clieactivos)) { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_select_activo']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_clieactivos'][] = 'A'; ?>
 <option  value="I" <?php  if ($this->clieactivos == "I") { echo " selected" ;} ?>><?php echo $this->Ini->Nm_lang['lang_select_inactivo']; ?></option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_clientes']['Lookup_clieactivos'][] = 'I'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_clieactivos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_clieactivos_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
