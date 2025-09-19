<?php /* Smarty version 2.6.0, created on 2014-07-15 15:22:55
         compiled from Form_Personal_Consult.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Personal_Consult.tpl', 3, false),array('block', 'body', 'Form_Personal_Consult.tpl', 9, false),array('block', 'form', 'Form_Personal_Consult.tpl', 12, false),array('function', 'putstyle', 'Form_Personal_Consult.tpl', 5, false),array('function', 'consult_table', 'Form_Personal_Consult.tpl', 13, false),array('function', 'btn_command', 'Form_Personal_Consult.tpl', 19, false),array('function', 'hidden', 'Form_Personal_Consult.tpl', 24, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Consultar Personal</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPersonalConsult','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  echo smarty_function_consult_table(array('table_name' => 'personal','llaves' => 'perscodigos','form_name' => 'frmPersonalConsult','sqlid' => 'personal','command' => 'FeHrCmdShowListPersonal'), $this);?>

<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cancelar','id' => 'CmdCancel','name' => 'FeHrCmdCancelShowListPersonal','form_name' => 'frmPersonalConsult'), $this);?>

			</div>
		</td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'perscodigos\',\'D\');'."\n".'	jsAccessKey(\'persidentifs\',\'I\');'."\n".'	jsAccessKey(\'persnombres\',\'N\');'."\n".'	jsAccessKey(\'persapell1s\',\'P\');'."\n".'	jsAccessKey(\'persapell2s\',\'S\');'."\n".'	jsAccessKey(\'persusrnams\',\'O\');'."\n".'	jsAccessKey(\'cargcodigos\',\'R\');'."\n".'	jsAccessKey(\'persprofecs\',\'F\');'."\n".'	jsAccessKey(\'perstelefo1\',\'T\');'."\n".'	jsAccessKey(\'perstelefo2\',\'E\');'."\n".'	jsAccessKey(\'locacodigos\',\'L\');'."\n".'	jsAccessKey(\'persdireccis\',\'D\');'."\n".'	jsAccessKey(\'persemails\',\'C\');'."\n".'	jsAccessKey(\'perscontacts\',\'C\');'."\n".'	jsAccessKey(\'perstelcont\',\'T\');'."\n".'	jsAccessKey(\'persestadoc\',\'E\');'."\n".'	jsAccessKey(\'CmdAccept\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdCancel\',\'C\',\'Cancelar\');'."\n".'</script>'."\n";  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>