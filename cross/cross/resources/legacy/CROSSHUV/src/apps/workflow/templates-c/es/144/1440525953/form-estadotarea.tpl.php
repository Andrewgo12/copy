<?php /* Smarty version 2.6.0, created on 2020-10-02 13:29:08
         compiled from Form_Estadotarea.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Estadotarea.tpl', 3, false),array('block', 'body', 'Form_Estadotarea.tpl', 9, false),array('block', 'form', 'Form_Estadotarea.tpl', 10, false),array('block', 'fieldset', 'Form_Estadotarea.tpl', 49, false),array('function', 'putstyle', 'Form_Estadotarea.tpl', 5, false),array('function', 'select_row_table', 'Form_Estadotarea.tpl', 21, false),array('function', 'btn_command', 'Form_Estadotarea.tpl', 36, false),array('function', 'hidden', 'Form_Estadotarea.tpl', 46, false),array('function', 'message', 'Form_Estadotarea.tpl', 50, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Estados por tarea"; ?></title>
<?php echo smarty_function_putstyle(array(), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEstadotarea','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Permite definir los estado que aplican a las determinadas tareas.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Estados por tarea"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td class="celda"><?php echo "<B><u>T</u>area</B> " ?></td>
      <td class="celda"><?php echo smarty_function_select_row_table(array('id' => 'tarecodigos','name' => 'estadotarea__tarecodigos','sqlid' => 'tarea','table_name' => 'tarea','value' => 'tarecodigos','label' => 'tarenombres','is_null' => 'true'), $this);?>
<b>*</b></td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td class="celda"><?php echo "<B>E<u>s</u>tado</B> " ?></td>
      <td class="celda"><?php echo smarty_function_select_row_table(array('id' => 'esaccodigos','name' => 'estadotarea__esaccodigos','sqlid' => 'estadoacta','table_name' => 'estadoacta','value' => 'esaccodigos','label' => 'esacnombres','is_null' => 'true'), $this);?>
<b>*</b></td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
    	<td colspan="2">
    		<div align="center">
	    		<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeWFCmdAddEstadotarea','form_name' => 'frmEstadotarea'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeWFCmdUpdateEstadotarea','form_name' => 'frmEstadotarea','loadFields' => "estadotarea__tarecodigos,estadotarea__esaccodigos",'confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeWFCmdDeleteEstadotarea','form_name' => 'frmEstadotarea','loadFields' => "estadotarea__tarecodigos,estadotarea__esaccodigos",'confirm' => '10'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeWFCmdShowListEstadotarea','form_name' => 'frmEstadotarea'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Limpiar','id' => 'CmdClean','name' => 'FeWFCmdClearEstadotarea','form_name' => 'frmEstadotarea'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'tarecodigos\',\'T\');'."\n".'	jsAccessKey(\'esaccodigos\',\'S\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>