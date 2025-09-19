<?php /* Smarty version 2.6.0, created on 2020-09-24 15:54:36
         compiled from Form_Schema.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Schema.tpl', 3, false),array('block', 'body', 'Form_Schema.tpl', 9, false),array('block', 'form', 'Form_Schema.tpl', 10, false),array('block', 'textarea', 'Form_Schema.tpl', 31, false),array('block', 'fieldset', 'Form_Schema.tpl', 54, false),array('function', 'putstyle', 'Form_Schema.tpl', 5, false),array('function', 'textfield', 'Form_Schema.tpl', 21, false),array('function', 'btn_command', 'Form_Schema.tpl', 41, false),array('function', 'btn_clean', 'Form_Schema.tpl', 45, false),array('function', 'hidden', 'Form_Schema.tpl', 51, false),array('function', 'message', 'Form_Schema.tpl', 55, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Contextos"; ?></title>
<?php echo smarty_function_putstyle(array(), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $_params = $this->_tag_stack[] = array('form', array('name' => 'frmSchema','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;<b>NOTA: </b>Recuerde que los campos con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Contextos"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
    <!-- Impide la modificación del código y el nombre -->
   <tr>
      <td class="celda"><?php echo "C&oacute;<u>d</u>igo " ?></td>
      <td class="celda"><?php echo smarty_function_textfield(array('id' => 'schecodigon','name' => 'schema__schecodigon','class' => 'campos','maxlength' => '30','readonly' => 'true'), $this);?>
</td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td class="celda"><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td class="celda"><?php echo smarty_function_textfield(array('id' => 'schenombres','name' => 'schema__schenombres','class' => 'campos','maxlength' => '100'), $this);?>
<b>*</b></td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td class="celda"><?php echo "<B><u>O</u>bservaciones</B> " ?></td>
      <td class="celda"><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'scheobservas','name' => 'schema__scheobservas','class' => 'campos','cols' => '40','rows' => '5','wrap' => 'OFF')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><b>*</b></td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FePrCmdAddSchema','form_name' => 'frmSchema'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FePrCmdUpdateSchema','form_name' => 'frmSchema','loadFields' => "schema__schecodigon,schema__schenombres,schema__scheobservas",'confirm' => '11'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FePrCmdDeleteSchema','form_name' => 'frmSchema','loadFields' => "schema__schecodigon,schema__schenombres",'confirm' => '12'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FePrCmdShowListSchema','form_name' => 'frmSchema'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Schema','form_name' => 'frmSchema'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'schecodigon\',\'D\');'."\n".'	jsAccessKey(\'schenombres\',\'N\');'."\n".'	jsAccessKey(\'schedbusers\',\'U\');'."\n".'	jsAccessKey(\'schedbkeys\',\'C\');'."\n".'	jsAccessKey(\'scheobservas\',\'O\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message'],'param' => $this->_tpl_vars['param']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>