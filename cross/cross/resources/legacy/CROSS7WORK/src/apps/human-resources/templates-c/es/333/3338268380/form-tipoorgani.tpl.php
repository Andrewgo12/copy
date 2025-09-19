<?php /* Smarty version 2.6.0, created on 2020-10-15 14:36:16
         compiled from Form_Tipoorgani.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Tipoorgani.tpl', 3, false),array('block', 'body', 'Form_Tipoorgani.tpl', 10, false),array('block', 'form', 'Form_Tipoorgani.tpl', 12, false),array('block', 'textarea', 'Form_Tipoorgani.tpl', 33, false),array('block', 'fieldset', 'Form_Tipoorgani.tpl', 61, false),array('function', 'putstyle', 'Form_Tipoorgani.tpl', 6, false),array('function', 'textfield', 'Form_Tipoorgani.tpl', 23, false),array('function', 'select_estado', 'Form_Tipoorgani.tpl', 38, false),array('function', 'btn_command', 'Form_Tipoorgani.tpl', 48, false),array('function', 'btn_clean', 'Form_Tipoorgani.tpl', 52, false),array('function', 'hidden', 'Form_Tipoorgani.tpl', 58, false),array('function', 'message', 'Form_Tipoorgani.tpl', 62, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Tipos de dependencias"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTipoorgani','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;<b>NOTA: </b>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Tipos de dependencias"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tiorcodigos','name' => 'tipoorgani__tiorcodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tiornombres','name' => 'tipoorgani__tiornombres','maxlength' => '200'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "De<u>s</u>cripci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'tiordesc','name' => 'tipoorgani__tiordesc','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'tioractivos','name' => 'tipoorgani__tioractivos','table' => 'tipoorgani'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeHrCmdAddTipoorgani','form_name' => 'frmTipoorgani'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeHrCmdUpdateTipoorgani','form_name' => 'frmTipoorgani','loadFields' => "tipoorgani__tiorcodigos,tipoorgani__tiornombres",'confirm' => '14'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeHrCmdDeleteTipoorgani','form_name' => 'frmTipoorgani','loadFields' => "tipoorgani__tiorcodigos,tipoorgani__tiornombres",'confirm' => '15'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeHrCmdShowListTipoorgani','form_name' => 'frmTipoorgani'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Tipoorgani','form_name' => 'frmTipoorgani'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'tiorcodigos\',\'D\');'."\n".'	jsAccessKey(\'tiornombres\',\'N\');'."\n".'	jsAccessKey(\'tiordesc\',\'S\');'."\n".'	jsAccessKey(\'tiorcodpadrs\',\'P\');'."\n".'	jsAccessKey(\'tioractivos\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>