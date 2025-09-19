<?php /* Smarty version 2.6.0, created on 2020-10-10 09:08:02
         compiled from Form_RepoTiemposEjec.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_RepoTiemposEjec.tpl', 3, false),array('block', 'body', 'Form_RepoTiemposEjec.tpl', 10, false),array('block', 'form', 'Form_RepoTiemposEjec.tpl', 12, false),array('block', 'fieldset', 'Form_RepoTiemposEjec.tpl', 45, false),array('function', 'putstyle', 'Form_RepoTiemposEjec.tpl', 6, false),array('function', 'textfield', 'Form_RepoTiemposEjec.tpl', 22, false),array('function', 'btn_button', 'Form_RepoTiemposEjec.tpl', 32, false),array('function', 'hidden', 'Form_RepoTiemposEjec.tpl', 42, false),array('function', 'message', 'Form_RepoTiemposEjec.tpl', 46, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Tiempos de ejecuci&oacute;n"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmRepoTiemposEjec','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;El reporte de tiempos de ejecuci&oacute;n muestra el tiempo en horas que se ha utilizado para resolver un caso.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios, mientras no digite el requerieminto, no se ejecutar&aacute; la consulta.</fieldset>" ?>
  	</div></td></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Tiempos de ejecuci&oacute;n"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C<u>a</u>so</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'repotiemposeject__ordenumeros'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'consultar','onClick' => "if(!this.form.repotiemposeject__ordenumeros.value)location='index.php?action=FeCrCmdDefaultRepoTiemposEjec&cod_message=0'; if(this.form.repotiemposeject__ordenumeros.value)fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyRepoTiemposEjec&ordenumeros='+this.form.repotiemposeject__ordenumeros.value+'&vars=ordenumeros');if(this.form.repotiemposeject__ordenumeros.value)this.form.action.value='FeCrCmdDefaultRepoTiemposEjec';"), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeCrCmdDefaultRepoTiemposEjec'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'A\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>