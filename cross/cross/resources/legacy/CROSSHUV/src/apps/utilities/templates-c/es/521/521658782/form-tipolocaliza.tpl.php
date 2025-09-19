<?php /* Smarty version 2.6.0, created on 2020-10-05 13:19:38
         compiled from Form_Tipolocaliza.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Tipolocaliza.tpl', 3, false),array('block', 'body', 'Form_Tipolocaliza.tpl', 10, false),array('block', 'form', 'Form_Tipolocaliza.tpl', 12, false),array('block', 'textarea', 'Form_Tipolocaliza.tpl', 33, false),array('block', 'fieldset', 'Form_Tipolocaliza.tpl', 71, false),array('function', 'putstyle', 'Form_Tipolocaliza.tpl', 6, false),array('function', 'textfield', 'Form_Tipolocaliza.tpl', 23, false),array('function', 'select_row_father', 'Form_Tipolocaliza.tpl', 38, false),array('function', 'select_estado', 'Form_Tipolocaliza.tpl', 48, false),array('function', 'btn_command', 'Form_Tipolocaliza.tpl', 58, false),array('function', 'btn_clean', 'Form_Tipolocaliza.tpl', 62, false),array('function', 'hidden', 'Form_Tipolocaliza.tpl', 68, false),array('function', 'message', 'Form_Tipolocaliza.tpl', 72, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Tipo de localizaci&oacute;n"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTipolocaliza','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La interfaz de tipo de localizaci&oacute;n permite crear, modificar y eliminar un tipo de localizaci&oacute;n, ejemplo : pa&iacute;s, departamento, ciudad<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Tipo de localizaci&oacute;n"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tilocodigos','name' => 'tipolocaliza__tilocodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tilonombres','name' => 'tipolocaliza__tilonombres','maxlength' => '200'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "De<u>s</u>cripci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'tilodesc','name' => 'tipolocaliza__tilodesc','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>adre " ?></td>
      <td><?php echo smarty_function_select_row_father(array('father' => 'tilocodpadrs','id' => 'tilocodpadrs','name' => 'tipolocaliza__tilocodpadrs','sqlid' => 'tipolocalizaall','table_name' => 'tipolocaliza','value' => 'tilocodigos','label' => 'tilonombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <!--<tr>
      <td><?php echo "<u>I</u>m&aacute;gen " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tiloimagens','name' => 'tipolocaliza__tiloimagens','maxlength' => '200'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'tiloestados','name' => 'tipolocaliza__tiloestados','table' => 'tipolocaliza'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeGeCmdAddTipolocaliza','form_name' => 'frmTipolocaliza'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdateTipolocaliza','form_name' => 'frmTipolocaliza','loadFields' => "tipolocaliza__tilocodigos,tipolocaliza__tilonombres",'confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeGeCmdDeleteTipolocaliza','form_name' => 'frmTipolocaliza','loadFields' => "tipolocaliza__tilocodigos,tipolocaliza__tilonombres",'confirm' => '47'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeGeCmdShowListTipolocaliza','form_name' => 'frmTipolocaliza'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Tipolocaliza','form_name' => 'frmTipolocaliza'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'tilocodigos\',\'D\');'."\n".'	jsAccessKey(\'tilonombres\',\'N\');'."\n".'	jsAccessKey(\'tilodesc\',\'S\');'."\n".'	jsAccessKey(\'tilocodpadrs\',\'P\');'."\n".'	jsAccessKey(\'tiloimagens\',\'I\');'."\n".'	jsAccessKey(\'tiloestados\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message'],'param' => $this->_tpl_vars['param']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>