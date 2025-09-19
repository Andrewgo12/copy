<?php /* Smarty version 2.6.0, created on 2020-10-15 12:42:43
         compiled from Form_DatosAdicionales.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_DatosAdicionales.tpl', 3, false),array('block', 'body', 'Form_DatosAdicionales.tpl', 10, false),array('block', 'form', 'Form_DatosAdicionales.tpl', 12, false),array('block', 'fieldset', 'Form_DatosAdicionales.tpl', 82, false),array('function', 'putstyle', 'Form_DatosAdicionales.tpl', 6, false),array('function', 'viewDimensiones', 'Form_DatosAdicionales.tpl', 20, false),array('function', 'textfield', 'Form_DatosAdicionales.tpl', 29, false),array('function', 'select_constant', 'Form_DatosAdicionales.tpl', 34, false),array('function', 'btn_command', 'Form_DatosAdicionales.tpl', 65, false),array('function', 'btn_clean', 'Form_DatosAdicionales.tpl', 66, false),array('function', 'viewDetalles', 'Form_DatosAdicionales.tpl', 73, false),array('function', 'hidden', 'Form_DatosAdicionales.tpl', 77, false),array('function', 'message', 'Form_DatosAdicionales.tpl', 83, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Datos Din&aacute;micos"; ?></title>

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
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmDatosAdic','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	
	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Esta interfaz permite la configuraci&oacute;n de datos din&aacute;micos. Primero seleccione la dimensi&oacute;n , configure los datos din&aacute;micos (nomre, tipo, objeto, dominio) y presione GUARDAR.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
  	
  	<tr><td colspan="3">
	<?php echo smarty_function_viewDimensiones(array('sbTabla' => 'dimension','sbLlave' => "dimecodigon,dimedescrips,dimeusuarios"), $this);?>

	</td></tr> 	
	
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Datos Din&aacute;micos"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'dedinombres','name' => 'dedinombres','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>T<u>i</u>po de dato</B> " ?></td>
      <td><?php echo smarty_function_select_constant(array('id' => 'deditipodats','name' => 'deditipodats'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Tama&ntilde;<u>o</u> del campo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'deditamtips','name' => 'deditamtips','maxlength' => '3','typeData' => 'int'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Ti<u>p</u>o de objeto</B> " ?></td>
      <td><?php echo smarty_function_select_constant(array('id' => 'deditipobjes','name' => 'deditipobjes'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>N<u>u</u>lo</B> " ?></td>
      <td><?php echo smarty_function_select_constant(array('id' => 'dedinotnulls','name' => 'dedinotnulls'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>O</u>rden</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'dediordenn','name' => 'dediordenn','maxlength' => '2','typeData' => 'int'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeGeCmdAddDatosAdicionalesWeb','form_name' => 'frmDatosAdic'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Localizacion','form_name' => 'frmDatosAdic'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	
	<tr><td colspan="3">
	<?php echo smarty_function_viewDetalles(array('sbTabla' => 'detalledimens','sbLlave' => "dimecodigon,dedinombres,deditipodats,deditipobjes,dediordenn"), $this);?>

	</td></tr> 	
	
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'dimecodigon'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'dededidefaults'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'dimecodigon\',\'D\');'."\n".'	jsAccessKey(\'dedinombres\',\'N\');'."\n".'	jsAccessKey(\'dedilabels\',\'T\');'."\n".'	jsAccessKey(\'deditipodats\',\'I\');'."\n".'	jsAccessKey(\'deditamtips\',\'O\');'."\n".'	jsAccessKey(\'tilonombres\',\'B\');'."\n".'	jsAccessKey(\'dediformatos\',\'F\');'."\n".'	jsAccessKey(\'dediorigens\',\'R\');'."\n".'	jsAccessKey(\'deditipobjes\',\'P\');'."\n".'	jsAccessKey(\'dedivalidas\',\'A\');'."\n".'	jsAccessKey(\'dedinotnulls\',\'U\');'."\n".'	jsAccessKey(\'dededidefaults\',\'A\');'."\n".'	jsAccessKey(\'dediordenn\',\'O\');'."\n".'	jsAccessKey(\'dedijseventos\',\'J\');'."\n".'	jsAccessKey(\'dimedescrips\',\'S\');'."\n".'	jsAccessKey(\'dimeusuarios\',\'U\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>