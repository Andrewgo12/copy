<?php /* Smarty version 2.6.0, created on 2015-02-04 07:26:54
         compiled from Form_Style.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Style.tpl', 3, false),array('block', 'body', 'Form_Style.tpl', 10, false),array('block', 'form', 'Form_Style.tpl', 12, false),array('block', 'textarea', 'Form_Style.tpl', 38, false),array('block', 'fieldset', 'Form_Style.tpl', 61, false),array('function', 'putstyle', 'Form_Style.tpl', 6, false),array('function', 'textfield', 'Form_Style.tpl', 23, false),array('function', 'select_row_table', 'Form_Style.tpl', 28, false),array('function', 'btn_command', 'Form_Style.tpl', 48, false),array('function', 'btn_delete', 'Form_Style.tpl', 50, false),array('function', 'btn_clean', 'Form_Style.tpl', 52, false),array('function', 'hidden', 'Form_Style.tpl', 58, false),array('function', 'message', 'Form_Style.tpl', 62, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Estilos de visualizaci&oacute;n"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmStyle','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;<b>NOTA:</b>&#33;Recuerde que los campos con asterisco (*) son obligatorios&#161;</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Estilos de visualizaci&oacute;n"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><B><?php echo "C&oacute;<u>d</u>igo " ?></B></td>
      <td><?php echo smarty_function_textfield(array('id' => 'stylcodigos','name' => 'style__stylcodigos','maxlength' => '10'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><B><?php echo "A<u>p</u>licaci&oacute;n " ?></B></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'applcodigos','name' => 'style__applcodigos','table_name' => 'applications','value' => 'applcodigos','label' => 'applnombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><B><?php echo "N<u>o</u>mbre " ?></B></td>
      <td><?php echo smarty_function_textfield(array('id' => 'stylnombres','name' => 'style__stylnombres','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "O<u>b</u>servaciones " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'stylobservas','name' => 'style__stylobservas','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FePrCmdAddStyle','form_name' => 'frmStyle'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FePrCmdUpdateStyle','form_name' => 'frmStyle'), $this);?>

				<?php echo smarty_function_btn_delete(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FePrCmdDeleteStyle','form_name' => 'frmStyle','table' => 'style'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FePrCmdShowListStyle','form_name' => 'frmStyle'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Style','form_name' => 'frmStyle'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'stylcodigos\',\'D\');'."\n".'	jsAccessKey(\'applcodigos\',\'P\');'."\n".'	jsAccessKey(\'applnombres\',\'N\');'."\n".'	jsAccessKey(\'stylnombres\',\'O\');'."\n".'	jsAccessKey(\'stylobservas\',\'B\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>