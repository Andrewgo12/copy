<?php /* Smarty version 2.6.0, created on 2014-07-16 17:09:33
         compiled from Form_ConfigEncuesta.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_ConfigEncuesta.tpl', 3, false),array('block', 'body', 'Form_ConfigEncuesta.tpl', 9, false),array('block', 'form', 'Form_ConfigEncuesta.tpl', 10, false),array('block', 'div', 'Form_ConfigEncuesta.tpl', 50, false),array('block', 'fieldset', 'Form_ConfigEncuesta.tpl', 83, false),array('function', 'putstyle', 'Form_ConfigEncuesta.tpl', 5, false),array('function', 'select_row_table', 'Form_ConfigEncuesta.tpl', 26, false),array('function', 'href', 'Form_ConfigEncuesta.tpl', 46, false),array('function', 'btn_button', 'Form_ConfigEncuesta.tpl', 60, false),array('function', 'btn_clean', 'Form_ConfigEncuesta.tpl', 62, false),array('function', 'hidden', 'Form_ConfigEncuesta.tpl', 80, false),array('function', 'message', 'Form_ConfigEncuesta.tpl', 84, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Configuraci&oacute;n de Encuestas"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
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
<script language="javascript" src="web/js/configEncuesta.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmConfigEncuesta','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="4"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La configuraci&oacute;n de encuestas permite relacionar las preguntas y respuestas que se presentaran al usuario.
				  <br>El bot&oacute;n adicionar suma las preguntas al formulario, el bot&oacute;n aceptar realiza el ingreso de la configuraci&oacute;n al sistema.
				   <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="4"><div align="left"><?php echo "Configuraci&oacute;n de Encuestas"; ?></div></th></tr>
	<tr><th colspan="4"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>F</u>ormulario</B> " ?></td>
      <td colspan="2"><?php echo smarty_function_select_row_table(array('id' => 'formcodigon','sqlid' => 'formulario','name' => 'formulario__formcodigon','table_name' => 'formulario','value' => 'formcodigon','label' => 'formnombres','is_null' => 'true','onchange' => "jsLoadFormulario();"), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>regunta padre " ?></td>
      <td colspan="2"><select id="pregpadren" name="formulario__pregpadren" onchange="jsAction();"><option value="">---</option></select></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
      <td><?php echo "<B>P<u>r</u>egunta</B> " ?></td>
      <td colspan="2"><?php echo smarty_function_select_row_table(array('id' => 'pregcodigon','sqlid' => 'pregunta','name' => 'formulario__pregcodigon','table_name' => 'pregunta','value' => 'pregcodigon','label' => 'pregdescris','is_null' => 'true','onchange' => "jsLoadRespuesta();"), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>O</u>bjeto</B> " ?></td>
      <td colspan="2"><select id="objecodigon" name="formulario__objecodigon" ><option value="">---</option></select><B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   </tr>
      <td><?php echo "<B>R<u>e</u>spuestas</B> " ?></td>
      <td><select id="oprecodigon" name="formulario__oprecodigon" multiple><option value="">---</option></select><B>*</B>
      <?php echo smarty_function_href(array('label' => "<img src='web/images/positivo_002.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:drawRespuesta();"), $this);?>

      </td>
      <td><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_respuesta','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	<?php echo smarty_function_btn_button(array('value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeEnCmdAddAnswers','onClick' => "jsAddPregunta();"), $this);?>

				<?php echo smarty_function_btn_button(array('value' => 'Aceptar','id' => 'CmdAccept','name' => 'FeEnCmdSaveConfig','onClick' => "jsSaveConfig();"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'ConfigEncuesta','form_name' => 'frmConfigEncuesta'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="3"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_configuracion','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'answertitle\',\'C\');'."\n".'	jsAccessKey(\'questiontitle\',\'C\');'."\n".'	jsAccessKey(\'formcodigon\',\'F\');'."\n".'	jsAccessKey(\'pregpadren\',\'P\');'."\n".'	jsAccessKey(\'pregcodigon\',\'R\');'."\n".'	jsAccessKey(\'oprecodigon\',\'E\');'."\n".'	jsAccessKey(\'oprecodigon_1\',\'S\');'."\n".'	jsAccessKey(\'oprepadren\',\'U\');'."\n".'	jsAccessKey(\'objecodigon\',\'O\');'."\n".'	jsAccessKey(\'accion\',\'I\');'."\n".'	jsAccessKey(\'reprordenn\',\'D\');'."\n".'	jsAccessKey(\'reprpeson\',\'P\');'."\n".'	jsAccessKey(\'pregunta\',\'M\');'."\n".'	jsAccessKey(\'pregunta_e\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'	jsAccessKey(\'CmdAccept\',\'C\',\'aCeptar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>