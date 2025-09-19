<?php /* Smarty version 2.6.0, created on 2020-10-05 14:26:18
         compiled from Form_Localizacion.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Localizacion.tpl', 3, false),array('block', 'body', 'Form_Localizacion.tpl', 10, false),array('block', 'form', 'Form_Localizacion.tpl', 12, false),array('block', 'textarea', 'Form_Localizacion.tpl', 33, false),array('block', 'fieldset', 'Form_Localizacion.tpl', 82, false),array('function', 'putstyle', 'Form_Localizacion.tpl', 6, false),array('function', 'textfield', 'Form_Localizacion.tpl', 23, false),array('function', 'select_row_table', 'Form_Localizacion.tpl', 38, false),array('function', 'select_estado', 'Form_Localizacion.tpl', 59, false),array('function', 'btn_command', 'Form_Localizacion.tpl', 69, false),array('function', 'btn_clean', 'Form_Localizacion.tpl', 73, false),array('function', 'hidden', 'Form_Localizacion.tpl', 79, false),array('function', 'message', 'Form_Localizacion.tpl', 83, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Localizaci&oacute;n"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmLocalizacion','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La interfaz de localizaci&oacute;n permite crear, modificar y eliminar una localizaci&oacute;n, ejemplo : Colombia, Valle del cauca, Santiago de cali<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Localizaci&oacute;n"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'localizacion__locacodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'locanombres','name' => 'localizacion__locanombres','maxlength' => '200'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "De<u>s</u>cripci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'locadescrips','name' => 'localizacion__locadescrips','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "C&oacute;di<u>g</u>o Padre " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'locacodpadrs','name' => 'localizacion__locacodpadrs','sqlid' => 'localizacion','table_name' => 'localizacion','label' => 'locanombres','value' => 'locacodigos','is_null' => 'true','onchange' => "LoadSelect('tipolocaliza','locacodpadrs',Array(this),this.form.localizacion__tilocodigos)",'param' => 'localizacion__locacodpadrs'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>C&oacute;d<u>i</u>go Tipo</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tilocodigos','name' => 'localizacion__tilocodigos','sqlid' => 'tipolocaliza','table_name' => 'tipolocaliza','label' => 'tilonombres','value' => 'tilocodigos','is_null' => 'true','param' => 'localizacion__locacodpadrs'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <!--<tr>
      <td><?php echo "O<u>r</u>den " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'locaordenn','name' => 'localizacion__locaordenn','maxlength' => '4','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <tr>
      <td><?php echo "<u>Z</u>ona " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'locazonas','name' => 'localizacion__locazonas','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'locaestados','name' => 'localizacion__locaestados','table' => 'localizacion'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeGeCmdAddLocalizacion','form_name' => 'frmLocalizacion'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdateLocalizacion','form_name' => 'frmLocalizacion','loadFields' => "localizacion__locacodigos,localizacion__locanombres,localizacion__tilocodigos",'confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeGeCmdDeleteLocalizacion','form_name' => 'frmLocalizacion','loadFields' => "localizacion__locacodigos,localizacion__locanombres,localizacion__tilocodigos",'confirm' => '47'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeGeCmdShowListLocalizacion','form_name' => 'frmLocalizacion'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Localizacion','form_name' => 'frmLocalizacion'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'locacodigos\',\'D\');'."\n".'	jsAccessKey(\'locanombres\',\'N\');'."\n".'	jsAccessKey(\'locadescrips\',\'S\');'."\n".'	jsAccessKey(\'tilocodigos\',\'I\');'."\n".'	jsAccessKey(\'tilonombres\',\'O\');'."\n".'	jsAccessKey(\'locacodpadrs\',\'G\');'."\n".'	jsAccessKey(\'locaordenn\',\'R\');'."\n".'	jsAccessKey(\'locazonas\',\'Z\');'."\n".'	jsAccessKey(\'locaestados\',\'T\');'."\n".'	jsAccessKey(\'nombrepadre\',\'B\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>