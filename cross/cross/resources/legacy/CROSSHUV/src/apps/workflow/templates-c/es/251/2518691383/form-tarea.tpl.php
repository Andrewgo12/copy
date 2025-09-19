<?php /* Smarty version 2.6.0, created on 2020-10-02 13:29:12
         compiled from Form_Tarea.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Tarea.tpl', 3, false),array('block', 'body', 'Form_Tarea.tpl', 10, false),array('block', 'form', 'Form_Tarea.tpl', 12, false),array('block', 'textarea', 'Form_Tarea.tpl', 38, false),array('block', 'fieldset', 'Form_Tarea.tpl', 66, false),array('function', 'putstyle', 'Form_Tarea.tpl', 6, false),array('function', 'textfield', 'Form_Tarea.tpl', 23, false),array('function', 'select_dataservices', 'Form_Tarea.tpl', 33, false),array('function', 'select_estado', 'Form_Tarea.tpl', 43, false),array('function', 'btn_command', 'Form_Tarea.tpl', 53, false),array('function', 'btn_clean', 'Form_Tarea.tpl', 57, false),array('function', 'hidden', 'Form_Tarea.tpl', 63, false),array('function', 'message', 'Form_Tarea.tpl', 67, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Tareas"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTarea','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Las tareas son las acciones a ejecutar por las personas de la organizaci&oacute;n, estas tareas son las que componen un proceso.<br><br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Tareas"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tarecodigos','name' => 'tarea__tarecodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'tarenombres','name' => 'tarea__tarenombres','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "De<u>p</u>endencia " ?></td>
      <td><?php echo smarty_function_select_dataservices(array('service' => 'Human_resources','method' => 'getActiveEntesOrg','id' => 'orgacodigos','name' => 'tarea__orgacodigos','value' => 'orgacodigos','label' => 'organombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "De<u>s</u>cripci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'taredescris','name' => 'tarea__taredescris','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'tareactivas','name' => 'tarea__tareactivas','table' => 'tarea'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeWFCmdAddTarea','form_name' => 'frmTarea'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeWFCmdUpdateTarea','form_name' => 'frmTarea','loadFields' => "tarea__tarecodigos,tarea__tarenombres",'confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeWFCmdDeleteTarea','form_name' => 'frmTarea','loadFields' => "tarea__tarecodigos,tarea__tarenombres",'confirm' => '10'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeWFCmdShowListTarea','form_name' => 'frmTarea'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Tarea','form_name' => 'frmTarea'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'tarecodigos\',\'D\');'."\n".'	jsAccessKey(\'tarenombres\',\'N\');'."\n".'	jsAccessKey(\'orgacodigos\',\'P\');'."\n".'	jsAccessKey(\'taredescris\',\'S\');'."\n".'	jsAccessKey(\'tareactivas\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>