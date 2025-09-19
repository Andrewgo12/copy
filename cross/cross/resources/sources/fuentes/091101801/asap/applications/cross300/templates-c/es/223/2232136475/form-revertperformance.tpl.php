<?php /* Smarty version 2.6.0, created on 2014-07-08 09:19:58
         compiled from Form_RevertPerformance.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_RevertPerformance.tpl', 3, false),array('block', 'body', 'Form_RevertPerformance.tpl', 10, false),array('block', 'form', 'Form_RevertPerformance.tpl', 12, false),array('block', 'fieldset', 'Form_RevertPerformance.tpl', 51, false),array('function', 'putstyle', 'Form_RevertPerformance.tpl', 5, false),array('function', 'textfield', 'Form_RevertPerformance.tpl', 18, false),array('function', 'btn_command', 'Form_RevertPerformance.tpl', 28, false),array('function', 'btn_clean', 'Form_RevertPerformance.tpl', 29, false),array('function', 'viewrevertperformance', 'Form_RevertPerformance.tpl', 41, false),array('function', 'hidden', 'Form_RevertPerformance.tpl', 44, false),array('function', 'message_orden', 'Form_RevertPerformance.tpl', 52, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Eliminar &uacute;ltima tarea"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmRevertPerformance','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
	<tr><td colspan="3" class="piedefoto" align="center"><?php echo "<fieldset class=context_help>&nbsp;&nbsp;La pantalla para eliminar actuaciones permite consultar toda la informaci&oacute;n de un Caso, para determinar la informaci&oacute;n a ser eliminada.
				   <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios. <BR>S&oacute;lo se elimina una actuaci&oacute;n a la vez.</fieldset>" ?></td></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Eliminar &uacute;ltima tarea"; ?></div></th></tr>
   <tr>
      <td><?php echo "<B>Ca<u>s</u>o</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'orden__ordenumeros','is_null' => 'true'), $this);?>
<B>*</B></td>
      <td class="piedefoto"><?php echo ""; ?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','onClick' => "signal.value=1;",'id' => 'CmdShow','name' => 'FeCrCmdDefaultRevertPerformance','form_name' => 'frmRevertPerformance'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'RevertPerformance','onClick' => "signal.value=0;",'form_name' => 'frmRevertPerformance'), $this);?>
				
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<table border="0" align="center" width="80%">
    <tr>
        <td class='piedefoto'><?php echo smarty_function_viewrevertperformance(array('form' => 'frmRevertPerformance'), $this);?>
</td>
    </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'signal'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'message'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orden'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acta'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acemnumeros'), $this);?>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'subtitgenral\',\'I\');'."\n".'	jsAccessKey(\'subtitespec\',\'I\');'."\n".'	jsAccessKey(\'subtittarea\',\'T\');'."\n".'	jsAccessKey(\'subtitatencion\',\'A\');'."\n".'	jsAccessKey(\'ordenumeros\',\'S\');'."\n".'	jsAccessKey(\'compcodigos\',\'O\');'."\n".'	jsAccessKey(\'paciindentis\',\'P\');'."\n".'	jsAccessKey(\'sesocodigos\',\'E\');'."\n".'	jsAccessKey(\'couscodigos\',\'N\');'."\n".'	jsAccessKey(\'ipscodigos\',\'M\');'."\n".'	jsAccessKey(\'pacihisclis\',\'R\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
     <?php echo smarty_function_message_orden(array('id' => $this->_tpl_vars['cod_message'],'param' => $this->_tpl_vars['param'],'signal' => $this->_tpl_vars['signal']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>