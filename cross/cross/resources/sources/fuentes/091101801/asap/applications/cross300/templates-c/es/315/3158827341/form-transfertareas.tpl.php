<?php /* Smarty version 2.6.0, created on 2016-08-26 16:56:58
         compiled from Form_TransferTareas.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_TransferTareas.tpl', 3, false),array('block', 'body', 'Form_TransferTareas.tpl', 9, false),array('block', 'form', 'Form_TransferTareas.tpl', 12, false),array('block', 'textarea', 'Form_TransferTareas.tpl', 32, false),array('block', 'fieldset', 'Form_TransferTareas.tpl', 51, false),array('function', 'putstyle', 'Form_TransferTareas.tpl', 5, false),array('function', 'select_transference', 'Form_TransferTareas.tpl', 22, false),array('function', 'date_set_proc', 'Form_TransferTareas.tpl', 27, false),array('function', 'btn_command', 'Form_TransferTareas.tpl', 42, false),array('function', 'message', 'Form_TransferTareas.tpl', 52, false),array('function', 'fichatarea', 'Form_TransferTareas.tpl', 65, false),array('function', 'hidden', 'Form_TransferTareas.tpl', 69, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Permisions</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTranferTareas','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
  <table border="0" align="center" width="80%">
  <tr><td class="piedefoto" colspan="3"><div align="center">
	<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La transferencia de tareas permite al usuario mover o delegar el trabajo asignado a sus dependencias o entes subordinados.<br><b>Nota: </b>Para transferir, seleccione en la lista de dependencias y presione el bot&oacute;n Aceptar.</fieldset>" ?>
  </div></td></tr>
  <tr><th colspan="3">&nbsp;</th></tr>
  <tr><th colspan="3"><div align="left"><?php echo "Transferencia de tareas"; ?></div></th></tr>
  <tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
		<tr>
	      <td><?php echo "<B><u>D</u>ependencia</B> " ?></td>
	      <td><?php echo smarty_function_select_transference(array('id' => 'orgacodigost','name' => 'orgacodigost','is_null' => 'true','form' => 'frmTranferTareas'), $this);?>
<b>*</b></td>
	      <td class="piedefoto"><?php echo ""; ?></td>
        </tr>
         <tr>
      	 <td><?php echo "<B>Fecha de registro</B> " ?></td>
      	 <td><?php echo smarty_function_date_set_proc(array('name' => 'trtafechan','id' => 'trtafechan','form_name' => 'frmTranferTareas','is_null' => 'true'), $this);?>
<b>*</b></td>
  		 <td class="piedefoto"><?php echo ""; ?></td>
   		</tr>
        <tr>
	      <td><?php echo "<u>O</u>bservaciones " ?></td>
	      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'trtaobservas','name' => 'trtaobservas','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
	      <td class="piedefoto"><?php echo ""; ?></td>
        </tr>
	    <tr> 
	      <td colspan="2">&nbsp;</td>
	      <td class="piedefoto" ></td>
	    </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCrCmdTransferTareas','form_name' => 'frmTranferTareas'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cancelar','id' => 'CmdCancel','name' => 'FeCrCmdDefaultAdminTareas','form_name' => 'frmTranferTareas'), $this);?>

			</div>
		</td>
        <td class="piedefoto" ></td>
	</tr>
 	<tr>	<td class="piedefoto" colspan="3">&nbsp;</td></tr>
 	<tr>
 		<td class="piedefoto" colspan="3">
			<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
			   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

			<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
 		</td>
 	</tr>
  </table><br>
  <table border="0" align="center" width="80%">
    <tr>
       <td class="piedefoto" colspan="3"><hr></td>
    </tr>
    <!-- Pinta el titulo de la ficha-->
    <tr><th colspan="3"><div align="left"><?php echo "Ficha de la tarea " ?></div></th></tr>
    <tr>
    	<!-- Pinta la ficha de tarea -->
    	<td class="piedefoto" colspan="3"><div align="center"><?php echo smarty_function_fichatarea(array(), $this);?>
</div></td>
    </tr>
  </table>
  
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acta'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orgacodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orgacodigos_desc'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'tareas\',\'F\');'."\n".'	jsAccessKey(\'actacodigos\',\'I\');'."\n".'	jsAccessKey(\'actanumeros\',\'N\');'."\n".'	jsAccessKey(\'ordenumeros\',\'M\');'."\n".'	jsAccessKey(\'tarecodigos\',\'T\');'."\n".'	jsAccessKey(\'actaestacts\',\'E\');'."\n".'	jsAccessKey(\'actaestants\',\'S\');'."\n".'	jsAccessKey(\'actafechingn\',\'G\');'."\n".'	jsAccessKey(\'usuacodigos\',\'U\');'."\n".'	jsAccessKey(\'actaactivas\',\'A\');'."\n".'	jsAccessKey(\'acemnumeros\',\'R\');'."\n".'	jsAccessKey(\'esaccodigos\',\'O\');'."\n".'	jsAccessKey(\'acemfeccren\',\'R\');'."\n".'	jsAccessKey(\'acemfecaten\',\'A\');'."\n".'	jsAccessKey(\'acemhorainn\',\'H\');'."\n".'	jsAccessKey(\'acemhorafin\',\'L\');'."\n".'	jsAccessKey(\'acemusuars\',\'P\');'."\n".'	jsAccessKey(\'acemobservas\',\'B\');'."\n".'	jsAccessKey(\'acemradicas\',\'R\');'."\n".'	jsAccessKey(\'acemcomproms\',\'C\');'."\n".'	jsAccessKey(\'acemnomexpes\',\'X\');'."\n".'	jsAccessKey(\'acemnumexpes\',\'N\');'."\n".'	jsAccessKey(\'acemaperturs\',\'A\');'."\n".'	jsAccessKey(\'trtaobservas\',\'O\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdCancel\',\'C\',\'Cancelar\');'."\n".'</script>'."\n";  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>