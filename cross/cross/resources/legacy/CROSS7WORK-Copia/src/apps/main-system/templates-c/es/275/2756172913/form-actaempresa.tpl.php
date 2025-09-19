<?php /* Smarty version 2.6.0, created on 2020-10-26 18:01:43
         compiled from Form_Actaempresa.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Actaempresa.tpl', 4, false),array('block', 'body', 'Form_Actaempresa.tpl', 11, false),array('block', 'form', 'Form_Actaempresa.tpl', 13, false),array('block', 'textarea_ext', 'Form_Actaempresa.tpl', 50, false),array('block', 'div', 'Form_Actaempresa.tpl', 55, false),array('block', 'fieldset', 'Form_Actaempresa.tpl', 99, false),array('function', 'putstyle', 'Form_Actaempresa.tpl', 7, false),array('function', 'card_summary', 'Form_Actaempresa.tpl', 19, false),array('function', 'select_estadotarea', 'Form_Actaempresa.tpl', 25, false),array('function', 'textfield', 'Form_Actaempresa.tpl', 30, false),array('function', 'calendar', 'Form_Actaempresa.tpl', 35, false),array('function', 'textfield_hour', 'Form_Actaempresa.tpl', 40, false),array('function', 'register_activ', 'Form_Actaempresa.tpl', 63, false),array('function', 'register_attachment_atencion', 'Form_Actaempresa.tpl', 67, false),array('function', 'btn_command', 'Form_Actaempresa.tpl', 73, false),array('function', 'btn_clean', 'Form_Actaempresa.tpl', 75, false),array('function', 'hidden', 'Form_Actaempresa.tpl', 82, false),array('function', 'message_orden', 'Form_Actaempresa.tpl', 100, false),)), $this); ?>
<html>

<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Atenci&oacute;n de tareas"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsdrawDynamicColumns.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsDrawdiv.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();drawDynamicColumns('dynamic_columns');",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmActaempresa','enctype' => "multipart/form-data",'method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	
	<tr><th colspan="3"><div align="left"><?php echo "Atenci&oacute;n de tareas"; ?></div></th></tr>
	
   <tr>
      <td class="piedefoto" colspan="2"><?php echo smarty_function_card_summary(array(), $this);?>
</td>
	  <td class="piedefoto"></td>
    </tr>
	
   <tr>
      <td width='25%'><?php echo "<B><u>E</u>stado</B> " ?></td>
      <td width='60%'><?php echo smarty_function_select_estadotarea(array(), $this);?>
<b>*</b></td>
  	<td  width='15%'class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <!--<tr>
      <td><?php echo "A<u>t</u>enci&oacute;n " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'acemfeccren','name' => 'actaempresa__acemfeccren','maxlength' => '4','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <tr>
      <td><?php echo "<B>Atenc<u>i</u>&oacute;n</B> " ?></td>
      <td><?php echo smarty_function_calendar(array('name' => 'actaempresa__acemfecaten','id' => 'acemfecaten','form_name' => 'frmActaempresa','hour' => 'true'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <!--<tr>
      <td><?php echo "<B><u>H</u>ora inicial</B> " ?></td>
      <td><?php echo smarty_function_textfield_hour(array('id' => 'acemhorainn','name' => 'actaempresa__acemhorainn'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo "hh:mm:ss"; ?></td>
   </tr>-->
   <tr>
      <td><?php echo "H<u>o</u>ra final " ?></td>
      <td><?php echo smarty_function_textfield_hour(array('id' => 'acemhorafin','name' => 'actaempresa__acemhorafin'), $this);?>
</td>
  	<td class="piedefoto"><?php echo "hh:mm:ss"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>O<u>b</u>servaciones</B> " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea_ext', array('id' => 'acemobservas','name' => 'actaempresa__acemobservas','cols' => '100','rows' => '15')); smarty_block_textarea_ext($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea_ext($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
	<td colspan="3" class="piedefoto">
		<?php $_params = $this->_tag_stack[] = array('div', array('id' => 'dynamic_columns','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
		<table border="0" align="center" width="0%">
		<tr><td width='25%'>&nbsp;</td><td width='60%'>&nbsp;</td><td width='15%' class="piedefoto"></td></tr>
		</table>
   		<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
	</td>
	</tr>
   <tr>
		<td colspan="2" class="piedefoto"><?php echo smarty_function_register_activ(array('form' => 'frmActaempresa'), $this);?>
</td>
		<td class="piedefoto">&nbsp</td>
   </tr>
   <tr>
      <td colspan="2" class="piedefoto"><?php echo smarty_function_register_attachment_atencion(array('form' => 'frmActaempresa'), $this);?>
</td>
      <td class="piedefoto">&nbsp</td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCrCmdAddActaempresa','form_name' => 'frmActaempresa'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cancelar','id' => 'CmdCancel','name' => 'FeCrCmdDefaultAdminTareas','form_name' => 'frmActaempresa'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Actaempresa','form_name' => 'frmActaempresa'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>	
	
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'focusposition'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acta','id' => 'acta'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orgacodigos','id' => 'orgacodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orgacodigos_desc'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'actaempresa__acemnumeros'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'activities'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'delactiviacta','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acemcompromis'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'compromiso'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acemnumerosupd'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenumeros','id' => 'ordenumeros'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'tarecodigos','id' => 'tarecodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'delacemcompromis','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'deleteattachment','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'actacodigos\',\'D\');'."\n".'	jsAccessKey(\'acemnumeros\',\'N\');'."\n".'	jsAccessKey(\'esaccodigos\',\'E\');'."\n".'	jsAccessKey(\'acemfeccren\',\'T\');'."\n".'	jsAccessKey(\'acemfecaten\',\'I\');'."\n".'	jsAccessKey(\'acemhorainn\',\'H\');'."\n".'	jsAccessKey(\'acemhorafin\',\'O\');'."\n".'	jsAccessKey(\'acemobservas\',\'B\');'."\n".'	jsAccessKey(\'acemradicas\',\'R\');'."\n".'	jsAccessKey(\'acemcomproms\',\'M\');'."\n".'	jsAccessKey(\'acemnomexpes\',\'X\');'."\n".'	jsAccessKey(\'acemnumexpes\',\'P\');'."\n".'	jsAccessKey(\'acemaperturs\',\'U\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdCancel\',\'C\',\'Cancelar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message_orden(array('id' => $this->_tpl_vars['cod_message'],'param' => $this->_tpl_vars['param'],'signal' => $this->_tpl_vars['signal']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>