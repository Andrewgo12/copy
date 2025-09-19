<?php /* Smarty version 2.6.0, created on 2014-08-25 12:18:00
         compiled from Form_Activitarea.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Activitarea.tpl', 3, false),array('block', 'body', 'Form_Activitarea.tpl', 10, false),array('block', 'form', 'Form_Activitarea.tpl', 12, false),array('block', 'fieldset', 'Form_Activitarea.tpl', 77, false),array('function', 'putstyle', 'Form_Activitarea.tpl', 6, false),array('function', 'select_row_table', 'Form_Activitarea.tpl', 23, false),array('function', 'textfield', 'Form_Activitarea.tpl', 33, false),array('function', 'select_state', 'Form_Activitarea.tpl', 39, false),array('function', 'select_estado', 'Form_Activitarea.tpl', 54, false),array('function', 'btn_command', 'Form_Activitarea.tpl', 64, false),array('function', 'btn_clean', 'Form_Activitarea.tpl', 68, false),array('function', 'hidden', 'Form_Activitarea.tpl', 74, false),array('function', 'message', 'Form_Activitarea.tpl', 78, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Actividades por tarea"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmActivitarea','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Las actividades por tarea indican qu&eacute; actividades describen una tarea en particular.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Actividades por tarea"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B><u>T</u>area</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tarecodigos','name' => 'activitarea__tarecodigos','sqlid' => 'tarea','table_name' => 'tarea','value' => 'tarecodigos','label' => 'tarenombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Act<u>i</u>vidad</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'acticodigos','name' => 'activitarea__acticodigos','sqlid' => 'actividad','table_name' => 'actividad','value' => 'acticodigos','label' => 'actinombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Valo<u>r</u> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'actavalorn','name' => 'activitarea__actavalorn','maxlength' => '12','typeData' => 'double'), $this);?>
</td>
  	<td class="piedefoto"><?php echo "En moneda"; ?></td>
   </tr>
   <tr>
   
      <td><?php echo "O<u>b</u>ligatoria " ?></td>
      <td><?php echo smarty_function_select_state(array('id' => 'actaobligats','name' => 'activitarea__actaobligats','option' => '1','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>osici&oacute;n " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'actaordenn','name' => 'activitarea__actaordenn','maxlength' => '4','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Porcenta<u>j</u>e " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'actaporcetan','name' => 'activitarea__actaporcetan','maxlength' => '5','typeData' => 'double'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "E<u>s</u>tado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'actaactivas','name' => 'activitarea__actaactivas','table' => 'activitarea'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeWFCmdAddActivitarea','form_name' => 'frmActivitarea'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeWFCmdUpdateActivitarea','form_name' => 'frmActivitarea','loadFields' => "activitarea__tarecodigos,activitarea__acticodigos",'confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeWFCmdDeleteActivitarea','form_name' => 'frmActivitarea','loadFields' => "activitarea__tarecodigos,activitarea__acticodigos",'confirm' => '10'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeWFCmdShowListActivitarea','form_name' => 'frmActivitarea'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Activitarea','form_name' => 'frmActivitarea'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'tarecodigos\',\'T\');'."\n".'	jsAccessKey(\'tarenombres\',\'N\');'."\n".'	jsAccessKey(\'acticodigos\',\'I\');'."\n".'	jsAccessKey(\'actinombres\',\'O\');'."\n".'	jsAccessKey(\'actavalorn\',\'R\');'."\n".'	jsAccessKey(\'actaobligats\',\'B\');'."\n".'	jsAccessKey(\'actaordenn\',\'P\');'."\n".'	jsAccessKey(\'actaporcetan\',\'J\');'."\n".'	jsAccessKey(\'actaactivas\',\'S\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>