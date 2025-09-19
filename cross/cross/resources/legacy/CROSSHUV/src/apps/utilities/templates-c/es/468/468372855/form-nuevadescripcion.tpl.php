<?php /* Smarty version 2.6.0, created on 2020-09-25 14:38:40
         compiled from Form_NuevaDescripcion.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_NuevaDescripcion.tpl', 3, false),array('block', 'body', 'Form_NuevaDescripcion.tpl', 10, false),array('block', 'form', 'Form_NuevaDescripcion.tpl', 11, false),array('block', 'div', 'Form_NuevaDescripcion.tpl', 51, false),array('function', 'putstyle', 'Form_NuevaDescripcion.tpl', 6, false),array('function', 'select_row_table_service', 'Form_NuevaDescripcion.tpl', 30, false),array('function', 'btn_button', 'Form_NuevaDescripcion.tpl', 40, false),array('function', 'btn_clean', 'Form_NuevaDescripcion.tpl', 41, false),array('function', 'hidden', 'Form_NuevaDescripcion.tpl', 59, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Descripciones por idioma"; ?></title>

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
<script language="javascript" src="web/js/jsAccionesND.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "jsLoadTabla();putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmDescription','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Esta interfaz permite crear nuevas descripciones en diferentes lenguajes para las tablas tipo del sistema.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Descripciones por idioma"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>T</u>abla tipo</B> " ?></td>
      <td><select id="entidad" name="descripcion__entidad" onchange="clearContainer('div_listado');"><option value="">---</option></select><B>*</B></td>
      <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>L<u>e</u>nguaje</B> " ?></td>
      <td><?php echo smarty_function_select_row_table_service(array('id' => 'langcodigos','service' => 'Profiles','name' => 'descripcion__langcodigos','method' => 'getAllLanguage','value' => 'langcodigos','label' => 'langnombres','is_null' => 'true','onchange' => "clearContainer('div_listado');"), $this);?>
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
				<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'FeGeCmdDrawND','onClick' => "jsDrawListado();"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'NuevaDescripcion','form_name' => 'frmDescription'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_listado','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'entidad\',\'T\');'."\n".'	jsAccessKey(\'tipoorden\',\'I\');'."\n".'	jsAccessKey(\'evento\',\'A\');'."\n".'	jsAccessKey(\'accion\',\'O\');'."\n".'	jsAccessKey(\'preguntar\',\'D\');'."\n".'	jsAccessKey(\'langcodigos\',\'E\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'P\');'."\n".'	jsAccessKey(\'evencodigos\',\'S\');'."\n".'	jsAccessKey(\'tiidcodigos\',\'F\');'."\n".'	jsAccessKey(\'tipoidentifi\',\'T\');'."\n".'	jsAccessKey(\'ticlcodigos\',\'T\');'."\n".'	jsAccessKey(\'tipocliente\',\'T\');'."\n".'	jsAccessKey(\'esclcodigos\',\'E\');'."\n".'	jsAccessKey(\'estadoclient\',\'E\');'."\n".'	jsAccessKey(\'desc_tipoorden\',\'R\');'."\n".'	jsAccessKey(\'mediorecepcion\',\'M\');'."\n".'	jsAccessKey(\'merecodigos\',\'M\');'."\n".'	jsAccessKey(\'prioridad\',\'P\');'."\n".'	jsAccessKey(\'priocodigos\',\'P\');'."\n".'	jsAccessKey(\'tarea\',\'T\');'."\n".'	jsAccessKey(\'tarecodigos\',\'T\');'."\n".'	jsAccessKey(\'estadoacta\',\'E\');'."\n".'	jsAccessKey(\'esaccodigos\',\'E\');'."\n".'	jsAccessKey(\'actividad\',\'A\');'."\n".'	jsAccessKey(\'acticodigos\',\'A\');'."\n".'	jsAccessKey(\'compromiso\',\'C\');'."\n".'	jsAccessKey(\'compcodigos\',\'C\');'."\n".'	jsAccessKey(\'pregcodigon\',\'G\');'."\n".'	jsAccessKey(\'pregunta\',\'U\');'."\n".'	jsAccessKey(\'oprecodigon\',\'R\');'."\n".'	jsAccessKey(\'opcionrepues\',\'R\');'."\n".'	jsAccessKey(\'sexo\',\'X\');'."\n".'	jsAccessKey(\'sexocodigos\',\'S\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdNew\',\'N\',\'Nuevo\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>