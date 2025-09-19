<?php /* Smarty version 2.6.0, created on 2020-10-02 23:51:48
         compiled from Form_Integralog.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Integralog.tpl', 3, false),array('block', 'body', 'Form_Integralog.tpl', 9, false),array('block', 'form', 'Form_Integralog.tpl', 10, false),array('block', 'div', 'Form_Integralog.tpl', 71, false),array('block', 'fieldset', 'Form_Integralog.tpl', 82, false),array('function', 'putstyle', 'Form_Integralog.tpl', 5, false),array('function', 'calendar', 'Form_Integralog.tpl', 27, false),array('function', 'textfield', 'Form_Integralog.tpl', 34, false),array('function', 'select_dataservices', 'Form_Integralog.tpl', 39, false),array('function', 'select_state', 'Form_Integralog.tpl', 44, false),array('function', 'btn_button', 'Form_Integralog.tpl', 59, false),array('function', 'btn_clean', 'Form_Integralog.tpl', 61, false),array('function', 'hidden', 'Form_Integralog.tpl', 79, false),array('function', 'message', 'Form_Integralog.tpl', 83, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Administraci&oacute;n de log de integraci&oacute;n"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsIntegraLog.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmIntegraLog','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="4"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La administraci&oacute;n de log de integraci&oacute;n permite visualizar si ha existido fallos en la integraci&oacute;n con los componentes DOCUNET o SIPA.
				   <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="4"><div align="left"><?php echo "Administraci&oacute;n de log de integraci&oacute;n"; ?></div></th></tr>
	<tr><th colspan="4"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>F</u>echa de ingreso</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'inlofchaejin1','name' => 'integralog__inlofchaejin1','is_null' => 'true','form_name' => 'frmIntegraLog','hour' => 'true'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'inlofchaejin2','name' => 'integralog__inlofchaejin2','is_null' => 'true','form_name' => 'frmIntegraLog','hour' => 'true'), $this);?>

      <B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>N</u>&uacute;mero de caso " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'inloidcrosss','name' => 'integralog__inloidcrosss','size' => '30','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>U</u>suario " ?></td>
      <td><?php echo smarty_function_select_dataservices(array('id' => 'inlousuarios','name' => 'integralog__inlousuarios','service' => 'Human_resources','method' => 'getAllActiveAuthPersonal','table_name' => 'personal','value' => 'persusrnams','label' => 'persusrnams','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>A</u>plicaci&oacute;n " ?></td>
      <td><?php echo smarty_function_select_state(array('id' => 'inloapps','name' => 'integralog__inloapps','option' => '4','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "E<u>s</u>tado " ?></td>
      <td><?php echo smarty_function_select_state(array('id' => 'inloestados','name' => 'integralog__inloestados','option' => '7','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	<?php echo smarty_function_btn_button(array('value' => 'Adicionar','id' => 'CmdShow','name' => 'CmdShow','onClick' => "jsLoadIntegraLog();"), $this);?>

				<!--<?php echo smarty_function_btn_button(array('value' => 'Aceptar','id' => 'CmdAccept','name' => 'FeEnCmdSaveConfig','onClick' => "jsSaveConfig();"), $this);?>
-->
				<?php echo smarty_function_btn_clean(array('table_name' => 'Integralog','form_name' => 'frmIntegraLog'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="3"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_integralog','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'inlofchaejin\',\'F\');'."\n".'	jsAccessKey(\'inlocodigon\',\'D\');'."\n".'	jsAccessKey(\'inloidcrosss\',\'N\');'."\n".'	jsAccessKey(\'inlofchaejfn\',\'E\');'."\n".'	jsAccessKey(\'inlousuarios\',\'U\');'."\n".'	jsAccessKey(\'inloapps\',\'A\');'."\n".'	jsAccessKey(\'accion\',\'I\');'."\n".'	jsAccessKey(\'inloerrors\',\'R\');'."\n".'	jsAccessKey(\'inloestados\',\'S\');'."\n".'	jsAccessKey(\'pregunta_e\',\'M\');'."\n".'	jsAccessKey(\'pregunta_ej\',\'J\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>