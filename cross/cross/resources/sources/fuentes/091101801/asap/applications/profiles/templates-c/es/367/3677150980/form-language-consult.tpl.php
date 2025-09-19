<?php /* Smarty version 2.6.0, created on 2015-02-04 07:27:26
         compiled from Form_Language_Consult.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Language_Consult.tpl', 3, false),array('block', 'body', 'Form_Language_Consult.tpl', 9, false),array('block', 'form', 'Form_Language_Consult.tpl', 12, false),array('function', 'putstyle', 'Form_Language_Consult.tpl', 5, false),array('function', 'consult_table', 'Form_Language_Consult.tpl', 13, false),array('function', 'btn_command', 'Form_Language_Consult.tpl', 19, false),array('function', 'hidden', 'Form_Language_Consult.tpl', 24, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Consultar Language</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmLanguageConsult','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  echo smarty_function_consult_table(array('table_name' => 'language','llaves' => 'langcodigos','form_name' => 'frmLanguageConsult','sqlid' => "",'command' => 'FePrCmdShowListLanguage'), $this);?>

<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cancelar','id' => 'CmdCancel','name' => 'FePrCmdCancelShowListLanguage','form_name' => 'frmLanguageConsult'), $this);?>

			</div>
		</td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'langcodigos\',\'D\');'."\n".'	jsAccessKey(\'langnombres\',\'N\');'."\n".'	jsAccessKey(\'langobservas\',\'O\');'."\n".'	jsAccessKey(\'CmdAccept\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdCancel\',\'C\',\'Cancelar\');'."\n".'</script>'."\n";  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>