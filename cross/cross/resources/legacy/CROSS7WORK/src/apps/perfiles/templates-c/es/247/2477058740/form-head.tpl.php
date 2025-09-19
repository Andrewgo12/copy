<?php /* Smarty version 2.6.0, created on 2020-09-22 17:33:24
         compiled from Form_Head.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Head.tpl', 3, false),array('block', 'form', 'Form_Head.tpl', 9, false),array('function', 'putstyle', 'Form_Head.tpl', 6, false),array('function', 'hidden', 'Form_Head.tpl', 20, false),array('function', 'geturlhelp', 'Form_Head.tpl', 52, false),)), $this); ?>
<!--
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title>CROSS</title>
<meta http-equiv="Content-Type" content="text/html;" content="text/html; charset=ISO-8859-1">
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onkeydown="return doKeyDown(event);" onunload="windowclose();">
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmHead','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<p>&nbsp;</p>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <th><div align="right">
      		<img src="web/images/salir.gif" width="40" height="40" border="0" align="middle" onclick="document.frmHead.action.value='FePrCmdExit';frmHead.submit();"></div></th>
    <tr>
      <th><div align="left">Profiles Manager</div>
      </th>
  </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</body>
</html>
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title></title>


<?php echo smarty_function_putstyle(array('style' => "head.css"), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/cmdExit.js" type="text/javascript"></script>
<script language="javascript" src="web/js/headControl.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body onLoad="MM_preloadImages('web/images/contacto.gif','web/images/ayuda.gif','web/images/salir.gif')">
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmHead','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  width="186"><img src="web/images/i_cabe01.gif" width="186" height="95"></td>
    <td  width="487" background="web/images/i_expam1.gif"><img src="web/images/i_cabe02.gif" width="487" height="95"></td>
    <td class="single1" background="web/images/i_cabexpan.jpg">&nbsp;</td>
    <td  width="239"><img src="web/images/i_cabelogo.jpg" width="239" height="94"></td>
  </tr>
</table>
<table width="100%" height="40"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="single" background="web/images/i_downexpan.jpg">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  >&nbsp;</td>
            <td  width="45"><a href="mailto:soporte_fullengine@hotmail.com" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','web/images/contacto.gif',1)"><img src="web/images/contacto.gif" name="Image13" width="40" height="40" border="0" title="Contacto"></a></td>
            <td  width="45"><a href="#" onClick="<?php echo smarty_function_geturlhelp(array(), $this);?>
" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','web/images/ayuda.gif',1)"><img src="web/images/ayuda.gif" name="Image14" width="40" height="40" border="0" title="Ayuda"></a></td>
            <td  width="45"><a href="javascript:cmdExit()" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','web/images/salir.gif',1)"><img src="web/images/salir.gif" name="Image15" width="40" height="40" border="0" title="Salir"></a></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FePrCmdDefaultHead'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</body>
</html>