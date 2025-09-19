<?php /* Smarty version 2.6.0, created on 2020-10-07 03:24:58
         compiled from Form_Dayview.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Dayview.tpl', 5, false),array('block', 'body', 'Form_Dayview.tpl', 15, false),array('block', 'form', 'Form_Dayview.tpl', 17, false),array('block', 'fieldset', 'Form_Dayview.tpl', 53, false),array('function', 'putstyle', 'Form_Dayview.tpl', 11, false),array('function', 'loadPerscodigos', 'Form_Dayview.tpl', 26, false),array('function', 'select_personal', 'Form_Dayview.tpl', 30, false),array('function', 'viewSchedule_day', 'Form_Dayview.tpl', 39, false),array('function', 'hidden', 'Form_Dayview.tpl', 49, false),array('function', 'message', 'Form_Dayview.tpl', 54, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo "Calendario de eventos - Agenda Personal"; ?></title>


<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/entrada.js" type="text/javascript"></script>' ?>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>



<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEntrada','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La siguiente es su programaci&oacute;n de audiencias y citas personales:</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Calendario de eventos - Agenda Personal"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<?php echo smarty_function_loadPerscodigos(array(), $this);?>

	
	<tr>
      <td><?php echo "<u>U</u>suario " ?></td>
      <td><?php echo smarty_function_select_personal(array('id' => 'perscodigos','name' => 'perscodigos','cols' => '40','rows' => '5','onChange' => "onChange='loadPerscodigos(this.value,2);'"), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
	<td colspan="3">
	<?php echo smarty_function_viewSchedule_day(array(), $this);?>

	</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
		
	
</table>
<?php echo smarty_function_hidden(array('name' => 'usuacodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'orgtitle\',\'D\');'."\n".'	jsAccessKey(\'entrcodigon\',\'E\');'."\n".'	jsAccessKey(\'entrusucreas\',\'N\');'."\n".'	jsAccessKey(\'entrfechorun\',\'F\');'."\n".'	jsAccessKey(\'entrduracion\',\'H\');'."\n".'	jsAccessKey(\'agprcodigos\',\'P\');'."\n".'	jsAccessKey(\'catecodigon\',\'T\');'."\n".'	jsAccessKey(\'entrdescris\',\'S\');'."\n".'	jsAccessKey(\'orgacodigos\',\'I\');'."\n".'	jsAccessKey(\'ordenumeros\',\'M\');'."\n".'	jsAccessKey(\'caso\',\'A\');'."\n".'	jsAccessKey(\'acta\',\'R\');'."\n".'	jsAccessKey(\'ente\',\'O\');'."\n".'	jsAccessKey(\'entepart\',\'L\');'."\n".'	jsAccessKey(\'rf\',\'U\');'."\n".'	jsAccessKey(\'datarepet\',\'R\');'."\n".'	jsAccessKey(\'freq\',\'F\');'."\n".'	jsAccessKey(\'perscodigos\',\'F\');'."\n".'	jsAccessKey(\'usuacodigos\',\'U\');'."\n".'	jsAccessKey(\'deenprocesas\',\'P\');'."\n".'	jsAccessKey(\'deenvictimas\',\'C\');'."\n".'	jsAccessKey(\'deenfiscalis\',\'Y\');'."\n".'	jsAccessKey(\'deendefensas\',\'D\');'."\n".'	jsAccessKey(\'pregunta\',\'D\');'."\n".'	jsAccessKey(\'CmdClose\',\'C\',\'Cerrar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>


</html>