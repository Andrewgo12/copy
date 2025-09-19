<?php /* Smarty version 2.6.0, created on 2017-03-23 11:43:12
         compiled from Form_ShowListSchedule.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_ShowListSchedule.tpl', 5, false),array('block', 'body', 'Form_ShowListSchedule.tpl', 14, false),array('block', 'form', 'Form_ShowListSchedule.tpl', 16, false),array('block', 'fieldset', 'Form_ShowListSchedule.tpl', 67, false),array('function', 'loadDatosAppoint', 'Form_ShowListSchedule.tpl', 9, false),array('function', 'putstyle', 'Form_ShowListSchedule.tpl', 10, false),array('function', 'hidden', 'Form_ShowListSchedule.tpl', 24, false),array('function', 'calendar', 'Form_ShowListSchedule.tpl', 28, false),array('function', 'select_entes_esp', 'Form_ShowListSchedule.tpl', 38, false),array('function', 'checkbox', 'Form_ShowListSchedule.tpl', 38, false),array('function', 'select_row_table', 'Form_ShowListSchedule.tpl', 43, false),array('function', 'btn_command', 'Form_ShowListSchedule.tpl', 53, false),array('function', 'btn_clean', 'Form_ShowListSchedule.tpl', 54, false),array('function', 'viewScheduleList', 'Form_ShowListSchedule.tpl', 61, false),array('function', 'message', 'Form_ShowListSchedule.tpl', 68, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo "Listado de citas"; ?></title>

     
<?php echo smarty_function_loadDatosAppoint(array(), $this);?>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/entrada.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEntrada','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Seleccione los campos por los cuales desea filtrar y presione CONSULTAR.  Recuerde que los campos marcados con * son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Listado de citas"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<?php echo smarty_function_hidden(array('name' => 'focusposition'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'date'), $this);?>

   <tr>
      <td><?php echo "<B><u>F</u>echa hora de inicio</B> " ?></td>
      <td><?php echo smarty_function_calendar(array('hour' => 'yes','id' => 'entrfechorun','name' => 'entrfechorun','is_null' => 'true','form_name' => 'frmEntrada'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B></B> " ?></td>
      <td><?php echo smarty_function_calendar(array('hour' => 'yes','id' => 'entrdurationn','name' => 'entrdurationn','is_null' => 'true','form_name' => 'frmEntrada'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Dependencia</B> " ?></td>
      <td><?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'orgacodigos','form' => 'frmEntrada'), $this); echo smarty_function_checkbox(array('name' => 'children','value' => 'OK'), $this);?>
<B>*</B></td>
      <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>ipo de evento " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'catecodigon','is_null' => 'true','name' => 'catecodigon','table_name' => 'categoria','value' => 'catecodigon','label' => 'catenombres'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','onClick' => "this.form.consulta.value=1;",'name' => 'FeScCmdShowListSchedule','form_name' => 'frmEntrada'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Entrada','form_name' => 'frmEntrada'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>

	<center><?php echo smarty_function_viewScheduleList(array(), $this);?>
</center>

<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'consulta'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'entrfechorun\',\'F\');'."\n".'	jsAccessKey(\'entrduracion\',\'E\');'."\n".'	jsAccessKey(\'catecodigon\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>