<?php /* Smarty version 2.6.0, created on 2014-06-27 18:10:25
         compiled from Form_Menu.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Menu.tpl', 2, false),array('block', 'form', 'Form_Menu.tpl', 9, false),array('function', 'putstyle', 'Form_Menu.tpl', 4, false),array('function', 'printmenu', 'Form_Menu.tpl', 11, false),array('function', 'hidden', 'Form_Menu.tpl', 13, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
       <title> Menu Principal</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/sniffer.js" type="text/javascript"></script>
<script language="javascript" src="web/js/TreeMenu.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncLoadCmd.js" type="text/javascript"></script>' ?>      

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body onkeydown="return doKeyDown(event)">
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmMenu','method' => 'get')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table align="left" width="20%" border="1">
<?php echo smarty_function_printmenu(array('user' => "",'group' => ""), $this);?>

</table>
  <?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</body>
</html>