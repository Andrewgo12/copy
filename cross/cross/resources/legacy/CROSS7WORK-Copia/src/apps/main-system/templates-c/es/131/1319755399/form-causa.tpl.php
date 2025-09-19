<?php /* Smarty version 2.6.0, created on 2020-09-23 14:09:04
         compiled from Form_Causa.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Causa.tpl', 3, false),array('block', 'body', 'Form_Causa.tpl', 10, false),array('block', 'form', 'Form_Causa.tpl', 12, false),array('block', 'textarea', 'Form_Causa.tpl', 50, false),array('block', 'fieldset', 'Form_Causa.tpl', 78, false),array('function', 'putstyle', 'Form_Causa.tpl', 6, false),array('function', 'select_row_table', 'Form_Causa.tpl', 23, false),array('function', 'select_son', 'Form_Causa.tpl', 29, false),array('function', 'textfield', 'Form_Causa.tpl', 40, false),array('function', 'select_estado', 'Form_Causa.tpl', 55, false),array('function', 'btn_command', 'Form_Causa.tpl', 65, false),array('function', 'btn_clean', 'Form_Causa.tpl', 69, false),array('function', 'hidden', 'Form_Causa.tpl', 75, false),array('function', 'message', 'Form_Causa.tpl', 79, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Subclasificaciones"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmCausa','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Las subclasificaciones son las acciones que justifican o motivan a las clasificaciones.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Subclasificaciones"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B><u>T</u>ipo de Caso</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('sqlid' => 'tipoorden','id' => 'tiorcodigos','name' => 'causa__tiorcodigos','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','command_default' => 'FeCrCmdDefaultCausa'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Cla<u>s</u>ificaci&oacute;n</B> " ?></td>
      <td>
		<?php echo smarty_function_select_son(array('name' => 'causa__evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'causa__tiorcodigos','sqlid' => 'tipoorden_evento'), $this);?>
<B>*</B>     
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'causcodigos','name' => 'causa__causcodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Nom<u>b</u>re</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'causnombres','name' => 'causa__causnombres','maxlength' => '150'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Desc<u>r</u>ipci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'causdescrips','name' => 'causa__causdescrips','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>E</u>stado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'causactivas','name' => 'causa__causactivas','table' => 'causa'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCrCmdAddCausa','form_name' => 'frmCausa'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeCrCmdUpdateCausa','form_name' => 'frmCausa','loadFields' => "causa__tiorcodigos,causa__evencodigos,causa__causcodigos,causa__causnombres",'confirm' => '33'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeCrCmdDeleteCausa','form_name' => 'frmCausa','loadFields' => "causa__tiorcodigos,causa__evencodigos,causa__causcodigos,causa__causnombres",'confirm' => '34'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdShowListCausa','form_name' => 'frmCausa'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Causa','form_name' => 'frmCausa'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'tiornombres\',\'N\');'."\n".'	jsAccessKey(\'evencodigos\',\'S\');'."\n".'	jsAccessKey(\'evennombres\',\'O\');'."\n".'	jsAccessKey(\'causcodigos\',\'D\');'."\n".'	jsAccessKey(\'causnombres\',\'B\');'."\n".'	jsAccessKey(\'causdescrips\',\'R\');'."\n".'	jsAccessKey(\'causactivas\',\'E\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>