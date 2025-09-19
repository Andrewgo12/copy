<?php /* Smarty version 2.6.0, created on 2020-09-25 15:01:10
         compiled from Form_Auth.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Auth.tpl', 3, false),array('block', 'body', 'Form_Auth.tpl', 9, false),array('block', 'form', 'Form_Auth.tpl', 11, false),array('block', 'fieldset', 'Form_Auth.tpl', 127, false),array('function', 'putstyle', 'Form_Auth.tpl', 5, false),array('function', 'textfield', 'Form_Auth.tpl', 22, false),array('function', 'select_father', 'Form_Auth.tpl', 53, false),array('function', 'select_son', 'Form_Auth.tpl', 65, false),array('function', 'select_row_table', 'Form_Auth.tpl', 85, false),array('function', 'select_multiple', 'Form_Auth.tpl', 90, false),array('function', 'select_estado', 'Form_Auth.tpl', 104, false),array('function', 'btn_command', 'Form_Auth.tpl', 114, false),array('function', 'btn_clean', 'Form_Auth.tpl', 118, false),array('function', 'hidden', 'Form_Auth.tpl', 124, false),array('function', 'message', 'Form_Auth.tpl', 128, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Usuarios"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmAuth','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;El nombre de usuario no debe ser menor a cuatro caracteres y s&oacute;lo permite los siguientes caracteres [A-Z][a-z][0-9] punto(.) y gui&oacute;n bajo (_).<br>Cuando se inserta un usuario el sistema los tomar&aacute; como activo.<b>NOTA: </b>Recuerde que los campos con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Usuarios"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B><u>N</u>ombre de Usuario</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authusernams','name' => 'auth__authusernams','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>C</u>lave</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authuserpasss','name' => 'auth__authuserpasss','maxlength' => '100','type' => 'password'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>N<u>o</u>mbres</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authrealname','name' => 'auth__authrealname','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "A<u>p</u>ellido 1 " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authrealape1','name' => 'auth__authrealape1','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Apell<u>i</u>do 2 " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authrealape2','name' => 'auth__authrealape2','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>E</u>-mail " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authemail','name' => 'auth__authemail','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
    <tr>
        <td><?php echo "<B><u>A</u>plicaci&oacute;n</B> " ?></td>
		<td>
            <?php echo smarty_function_select_father(array('name' => 'auth__applcodigos','table_papa' => 'applications','id_papa' => 'applcodigos','label_papa' => 'applnombres','sqlid' => 'applications','command_default' => 'FePrCmdDefaultAuth'), $this);?>
<B>*</B> 
		</td>
        <td class="piedefoto"><?php echo ""; ?></td>
    </tr>
    <tr>
	   <td><?php echo "<B>Pe<u>r</u>fil</B> " ?></td>
	   <td>
		<?php echo smarty_function_select_son(array('name' => 'auth__profcodigos','table_hijo' => 'profiles','id_hijo' => 'profcodigos','label_hijo' => 'profnombres','select_papa' => 'auth__applcodigos'), $this);?>
<B>*</B></td>
        <td class="piedefoto"><?php echo ""; ?></td>
    </tr>   
   <tr>
      <td><?php echo "<B>E<u>s</u>tilo</B> " ?></td>
      <td><?php echo smarty_function_select_son(array('name' => 'auth__stylcodigos','table_hijo' => 'style','id_hijo' => 'stylcodigos','label_hijo' => 'stylnombres','select_papa' => 'auth__applcodigos'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>I<u>d</u>ioma</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'langcodigos','name' => 'auth__langcodigos','table_name' => 'language','value' => 'langcodigos','label' => 'langnombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Conte<u>x</u>to</B> " ?></td>
      <td><?php echo smarty_function_select_multiple(array('service' => 'Profiles','id' => 'schecodigon','field' => 'schecodigon','name' => 'auth__schecodigon','table_name' => 'schema','value' => 'schecodigon','label' => 'schenombres','is_null' => 'true','sqlid' => 'schema'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'authestados','name' => 'auth__authestados','table' => 'auth'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FePrCmdAddAuth','form_name' => 'frmAuth'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FePrCmdUpdateAuth','form_name' => 'frmAuth','loadFields' => "auth__authusernams,auth__authuserpasss,auth__authrealname,auth__stylcodigos,auth__langcodigos,auth__profcodigos",'confirm' => '11'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FePrCmdDeleteAuth','form_name' => 'frmAuth','loadFields' => "auth__authusernams,auth__authuserpasss,auth__authrealname,auth__stylcodigos,auth__langcodigos,auth__profcodigos",'confirm' => '12'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FePrCmdShowListAuth','form_name' => 'frmAuth'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Auth','form_name' => 'frmAuth'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>
 
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'authusernams\',\'N\');'."\n".'	jsAccessKey(\'authuserpasss\',\'C\');'."\n".'	jsAccessKey(\'authrealname\',\'O\');'."\n".'	jsAccessKey(\'authrealape1\',\'P\');'."\n".'	jsAccessKey(\'authrealape2\',\'I\');'."\n".'	jsAccessKey(\'authemail\',\'E\');'."\n".'	jsAccessKey(\'applcodigos\',\'A\');'."\n".'	jsAccessKey(\'stylcodigos\',\'S\');'."\n".'	jsAccessKey(\'langcodigos\',\'D\');'."\n".'	jsAccessKey(\'profcodigos\',\'R\');'."\n".'	jsAccessKey(\'authestados\',\'T\');'."\n".'	jsAccessKey(\'schecodigon\',\'X\');'."\n".'	jsAccessKey(\'username\',\'U\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>