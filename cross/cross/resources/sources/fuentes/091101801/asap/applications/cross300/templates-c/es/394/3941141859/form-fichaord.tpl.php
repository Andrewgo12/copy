<?php /* Smarty version 2.6.0, created on 2014-07-08 09:18:53
         compiled from Form_FichaOrd.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_FichaOrd.tpl', 3, false),array('block', 'body', 'Form_FichaOrd.tpl', 9, false),array('block', 'form', 'Form_FichaOrd.tpl', 11, false),array('block', 'fieldset', 'Form_FichaOrd.tpl', 39, false),array('function', 'putstyle', 'Form_FichaOrd.tpl', 5, false),array('function', 'textfield', 'Form_FichaOrd.tpl', 19, false),array('function', 'btn_button', 'Form_FichaOrd.tpl', 29, false),array('function', 'btn_viewinnova', 'Form_FichaOrd.tpl', 31, false),array('function', 'hidden', 'Form_FichaOrd.tpl', 37, false),array('function', 'message', 'Form_FichaOrd.tpl', 40, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Ficha de Caso"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmFichaOrd','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center"><?php echo "<fieldset class=context_help>&nbsp;&nbsp;En la ficha de Caso se puede consultar toda la informaci&oacute;n de un Caso.
				   <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?></td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Ficha de Caso"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td><?php echo "<B>N&uacute;mero de Caso</B> " ?></td>
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
				<?php echo smarty_function_btn_button(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdDefaultFichaOrd','form_name' => 'frmFichaOrd','onClick' => "if(!this.form.orden__ordenumeros.value)location='index.php?action=FeCrCmdDefaultFichaOrd&cod_message=0'; if(this.form.orden__ordenumeros.value)fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO='+this.form.orden__ordenumeros.value+'&vars=ordenumerosFO');if(this.form.orden__ordenumeros.value)this.form.action.value='FeCrCmdDefaultFichaOrd';"), $this);?>
				
				<?php echo smarty_function_btn_viewinnova(array('type' => 'button','value' => 'Consultar','id' => 'CmdShowInnova','name' => 'FeCrCmdDefaultDocsInnova','form_name' => 'frmFichaOrd'), $this);?>
				
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeCrCmdDefaultFichaOrd'), $this);?>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'subtitgenral\',\'I\');'."\n".'	jsAccessKey(\'subtitespec\',\'I\');'."\n".'	jsAccessKey(\'subtittarea\',\'T\');'."\n".'	jsAccessKey(\'subtitatencion\',\'A\');'."\n".'	jsAccessKey(\'sesocodigos\',\'S\');'."\n".'	jsAccessKey(\'couscodigos\',\'O\');'."\n".'	jsAccessKey(\'paciindentis\',\'P\');'."\n".'	jsAccessKey(\'ipscodigos\',\'E\');'."\n".'	jsAccessKey(\'pacihisclis\',\'N\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdShowInnova\',\'D\',\'Documentos\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>