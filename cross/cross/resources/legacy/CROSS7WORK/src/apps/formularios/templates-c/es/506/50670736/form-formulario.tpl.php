<?php /* Smarty version 2.6.0, created on 2020-10-15 14:39:31
         compiled from Form_Formulario.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Formulario.tpl', 5, false),array('block', 'body', 'Form_Formulario.tpl', 13, false),array('block', 'form', 'Form_Formulario.tpl', 15, false),array('block', 'textarea', 'Form_Formulario.tpl', 35, false),array('block', 'fieldset', 'Form_Formulario.tpl', 72, false),array('function', 'putstyle', 'Form_Formulario.tpl', 9, false),array('function', 'textfield', 'Form_Formulario.tpl', 25, false),array('function', 'calendar', 'Form_Formulario.tpl', 30, false),array('function', 'select_constant', 'Form_Formulario.tpl', 41, false),array('function', 'select_estado', 'Form_Formulario.tpl', 48, false),array('function', 'btn_command', 'Form_Formulario.tpl', 58, false),array('function', 'btn_clean', 'Form_Formulario.tpl', 62, false),array('function', 'hidden', 'Form_Formulario.tpl', 68, false),array('function', 'message', 'Form_Formulario.tpl', 73, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo "Cuestionarios"; ?></title>

     
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmFormulario','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Un Cuestionario es un mecanismo de recolecci&oacute;n de opiniones sobre un tema concreto el cual la organizaci&oacute;n tiene inter&eacute;s de evaluar.
				  <br>Una vez se inicie la configuraci&oacute;n del cuestionario, los datos b&aacute;sicos del mismo no podr&aacute;n ser modificados a excepci&oacute;n del dato que define si es el cuestionario predeterminado
				  <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Cuestionarios"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td><?php echo "<B>De<u>s</u>cripci&oacute;n</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'formnombres','name' => 'formulario__formnombres','size' => '100','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>F</u>echa de creaci&oacute;n</B> " ?></td>
      <td><?php echo smarty_function_calendar(array('id' => 'formfeccrean','name' => 'formulario__formfeccrean','form_name' => 'frmFormulario','hour' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>I</u>ntroducci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'formintrodus','name' => 'formulario__formintrodus','cols' => '100','rows' => '3')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
      <td><?php echo "<u>P</u>redeterminado " ?></td>
      <td><?php echo smarty_function_select_constant(array('name' => 'formulario__formpredets','id' => 'EST_FORM','labelfont' => 'formulario','is_null' => 'true'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'formactivos','name' => 'formulario__formactivos','table' => 'formulario'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeEnCmdAddFormulario','form_name' => 'frmFormulario'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeEnCmdUpdateFormulario','form_name' => 'frmFormulario','loadFields' => "formulario__formcodigon,formulario__formnombres",'confirm' => '12'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeEnCmdDeleteFormulario','form_name' => 'frmFormulario','loadFields' => 'formulario__formcodigon','confirm' => '13'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeEnCmdShowListFormulario','form_name' => 'frmFormulario'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Formulario','form_name' => 'frmFormulario'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'formulario__formcodigon'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'formcodigon\',\'D\');'."\n".'	jsAccessKey(\'formnombres\',\'S\');'."\n".'	jsAccessKey(\'formfeccrean\',\'F\');'."\n".'	jsAccessKey(\'formintrodus\',\'I\');'."\n".'	jsAccessKey(\'formpredets\',\'P\');'."\n".'	jsAccessKey(\'formactivos\',\'T\');'."\n".'	jsAccessKey(\'S\',\'S\');'."\n".'	jsAccessKey(\'N\',\'N\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>