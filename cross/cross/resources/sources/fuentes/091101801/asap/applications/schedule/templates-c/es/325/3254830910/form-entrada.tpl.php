<?php /* Smarty version 2.6.0, created on 2017-04-25 16:40:00
         compiled from Form_Entrada.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Entrada.tpl', 5, false),array('block', 'body', 'Form_Entrada.tpl', 14, false),array('block', 'form', 'Form_Entrada.tpl', 16, false),array('block', 'textarea', 'Form_Entrada.tpl', 63, false),array('block', 'div', 'Form_Entrada.tpl', 98, false),array('block', 'fieldset', 'Form_Entrada.tpl', 110, false),array('function', 'loadDatosAppoint', 'Form_Entrada.tpl', 9, false),array('function', 'putstyle', 'Form_Entrada.tpl', 10, false),array('function', 'hidden', 'Form_Entrada.tpl', 28, false),array('function', 'calendar', 'Form_Entrada.tpl', 32, false),array('function', 'select_row_table', 'Form_Entrada.tpl', 42, false),array('function', 'select_row_table_service', 'Form_Entrada.tpl', 53, false),array('function', 'href', 'Form_Entrada.tpl', 55, false),array('function', 'select_constant_repet', 'Form_Entrada.tpl', 74, false),array('function', 'calendar_repet', 'Form_Entrada.tpl', 79, false),array('function', 'btn_command', 'Form_Entrada.tpl', 89, false),array('function', 'btn_clean', 'Form_Entrada.tpl', 91, false),array('function', 'message', 'Form_Entrada.tpl', 111, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo "Calendario de eventos - Agenda Personal"; ?></title>

     
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
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();jsLoadEntrada();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEntrada','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
<tr>
<td>
<table border="0" align="center" width="80%">

  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La siguiente es su programaci&oacute;n de audiencias y citas personales:</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="4"><div align="left"><?php echo "Calendario de eventos - Agenda Personal"; ?></div></th></tr>
	<tr><th colspan="4"><div align="left">&nbsp;</div></th></tr>
	<?php echo smarty_function_hidden(array('name' => 'focusposition'), $this);?>

	<?php echo smarty_function_hidden(array('name' => 'date'), $this);?>

   <tr>
      <td><?php echo "<B><u>F</u>echa hora inicio</B> " ?></td>
      <td colspan="2"><?php echo smarty_function_calendar(array('hour' => 'yes','id' => 'entrfechorun','name' => 'entrada__entrfechorun','is_null' => 'true','form_name' => 'frmEntrada'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Fe<u>c</u>ha hora fin</B> " ?></td>
      <td colspan="2"><?php echo smarty_function_calendar(array('hour' => 'yes','id' => 'entrduracion','name' => 'entrada__entrduracion','is_null' => 'true','form_name' => 'frmEntrada'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>rioridad " ?></td>
      <td colspan="2"><?php echo smarty_function_select_row_table(array('id' => 'agprcodigos','name' => 'entrada__agprcodigos','sqlid' => 'agendapriori','table_name' => 'agprcodigos','value' => 'agprcodigos','label' => 'agprnombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>T</u>ipo de evento</B> " ?></td>
      <td colspan="2"><?php echo smarty_function_select_row_table(array('id' => 'catecodigon','is_null' => 'true','name' => 'entrada__catecodigon','table_name' => 'categoria','value' => 'catecodigon','label' => 'catenombres'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Dependenc<u>i</u>a " ?></td>
      <td colspan="2">
        <?php echo smarty_function_select_row_table_service(array('service' => 'Human_resources','method' => 'getAllEntesOrg','table_name' => 'organizacion','label' => 'organombres','id' => 'orgacodigos','value' => 'orgacodigos','name' => 'orgacodigos','form' => 'frmEntrada','is_null' => true), $this);?>

        <a href='javascript:Availability(0,"orgacodigos","orgacodigos");'><img border=0 src='web/images/calendar.gif'></a>
        <?php echo smarty_function_href(array('label' => "<img src='web/images/positivo_002.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:drawOrg();"), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>De<u>s</u>cripci&oacute;n</B> " ?></td>
      <td colspan="2"><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'entrdescris','name' => 'entrada__entrdescris','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
      <td><b><?php echo "<u>R</u>epetici&oacute;n " ?></b></td>
      <td colspan="2">&nbsp;</td>
  	<td class="piedefoto">&nbsp;</td>
   </tr>
   <tr>
      <td><?php echo "<u>F</u>recuencia " ?></td>
      <td colspan="2"><?php echo smarty_function_select_constant_repet(array('id' => 'frequency','is_null' => 'true','name' => 'frequency'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Fecha fin " ?></td>
      <td colspan="2"><?php echo smarty_function_calendar_repet(array('hour' => 'yes','id' => 'fechafinfreq','name' => 'fechafinfreq','is_null' => 'true','form_name' => 'frmEntrada'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="3">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeScCmdAddEntrada','form_name' => 'frmEntrada'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeScCmdUpdateEntrada','form_name' => 'frmEntrada'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Entrada','form_name' => 'frmEntrada'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>	
</td>	
 <td align="center"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_org','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
 </tr>	
</table>
<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'perscodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orgacodigospart'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'preecodigon'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'entrada__entrcodigon','id' => 'entrcodigon'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'entrada__entrusucreas'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'entrada__entractivas'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'orgtitle\',\'D\');'."\n".'	jsAccessKey(\'entrcodigon\',\'E\');'."\n".'	jsAccessKey(\'entrusucreas\',\'N\');'."\n".'	jsAccessKey(\'entrfechorun\',\'F\');'."\n".'	jsAccessKey(\'entrduracion\',\'C\');'."\n".'	jsAccessKey(\'agprcodigos\',\'P\');'."\n".'	jsAccessKey(\'catecodigon\',\'T\');'."\n".'	jsAccessKey(\'entrdescris\',\'S\');'."\n".'	jsAccessKey(\'orgacodigos\',\'I\');'."\n".'	jsAccessKey(\'ordenumeros\',\'R\');'."\n".'	jsAccessKey(\'caso\',\'O\');'."\n".'	jsAccessKey(\'acta\',\'T\');'."\n".'	jsAccessKey(\'ente\',\'D\');'."\n".'	jsAccessKey(\'entepart\',\'F\');'."\n".'	jsAccessKey(\'rf\',\'U\');'."\n".'	jsAccessKey(\'datarepet\',\'R\');'."\n".'	jsAccessKey(\'freq\',\'F\');'."\n".'	jsAccessKey(\'perscodigos\',\'F\');'."\n".'	jsAccessKey(\'usuacodigos\',\'U\');'."\n".'	jsAccessKey(\'deenprocesas\',\'P\');'."\n".'	jsAccessKey(\'deenvictimas\',\'C\');'."\n".'	jsAccessKey(\'deenfiscalis\',\'Y\');'."\n".'	jsAccessKey(\'deendefensas\',\'D\');'."\n".'	jsAccessKey(\'pregunta\',\'D\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>


</html>