<?php /* Smarty version 2.6.0, created on 2014-06-27 18:10:25
         compiled from Form_Splash.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Splash.tpl', 2, false),array('function', 'putstyle', 'Form_Splash.tpl', 5, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
  
  <title>Splash</title>
  <?php echo smarty_function_putstyle(array('style' => ""), $this);?>

  <?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>
  
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body onkeydown="return doKeyDown(event)">
<table cellpadding="1" cellspacing="0" border="0" width="100%">
  <tbody>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td class="piedefoto">&nbsp;</td></tr>
    <tr><td><div align="right">Copyright 2004 © FullEngine</div></td></tr>
  </tbody>
</table>
<br>
</body>
</html>