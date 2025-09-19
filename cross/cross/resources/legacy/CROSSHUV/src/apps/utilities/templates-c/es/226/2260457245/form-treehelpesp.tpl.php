<?php /* Smarty version 2.6.0, created on 2020-09-28 10:10:21
         compiled from Form_TreeHelpEsp.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_TreeHelpEsp.tpl', 3, false),array('block', 'body', 'Form_TreeHelpEsp.tpl', 10, false),array('block', 'form', 'Form_TreeHelpEsp.tpl', 12, false),array('block', 'fieldset', 'Form_TreeHelpEsp.tpl', 44, false),array('function', 'putstyle', 'Form_TreeHelpEsp.tpl', 6, false),array('function', 'hidden', 'Form_TreeHelpEsp.tpl', 23, false),array('function', 'consult_treehelp_esp', 'Form_TreeHelpEsp.tpl', 24, false),array('function', 'message', 'Form_TreeHelpEsp.tpl', 45, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Jerarqu&iacute;a"; ?></title>

<?php echo smarty_function_putstyle(array('style' => "estilotreehelp.css"), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/sniffer.js" type="text/javascript"></script>
<script language="javascript" src="web/js/TreeMenu.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsTreeHelp.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('class' => 'menugen','onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTreeHelp','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La interfaz de jerarqu&iacute;a permite seleccionar un valor al dar click sobre el enlace.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Jerarqu&iacute;a"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td class="piedefoto">&nbsp;</td>
      <?php echo smarty_function_hidden(array('name' => 'message'), $this);?>

      <td><?php echo smarty_function_consult_treehelp_esp(array('form' => 'frmTreeHelp','submit' => 'FeGeCmdTreeHelpEsp','cache' => 'false'), $this);?>

	 </td>
  	<td class="piedefoto">&nbsp;</td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'table'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'sqlid'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'return_obj'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'return_key'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'father'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'son'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'label'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'param'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'valor','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'organizacion\',\'O\');'."\n".'	jsAccessKey(\'localizacion\',\'I\');'."\n".'	jsAccessKey(\'\',\'\',\'\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message'],'close' => $this->_tpl_vars['close']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>