<?php /* Smarty version 2.6.0, created on 2020-10-02 23:51:38
         compiled from Form_CentroComunicacionConsult.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_CentroComunicacionConsult.tpl', 3, false),array('block', 'body', 'Form_CentroComunicacionConsult.tpl', 10, false),array('block', 'form', 'Form_CentroComunicacionConsult.tpl', 11, false),array('block', 'div', 'Form_CentroComunicacionConsult.tpl', 58, false),array('function', 'putstyle', 'Form_CentroComunicacionConsult.tpl', 6, false),array('function', 'textfield', 'Form_CentroComunicacionConsult.tpl', 25, false),array('function', 'date_set_proc', 'Form_CentroComunicacionConsult.tpl', 30, false),array('function', 'select_row_table', 'Form_CentroComunicacionConsult.tpl', 36, false),array('function', 'select_state', 'Form_CentroComunicacionConsult.tpl', 41, false),array('function', 'btn_button', 'Form_CentroComunicacionConsult.tpl', 47, false),array('function', 'hidden', 'Form_CentroComunicacionConsult.tpl', 66, false),array('function', 'hidden_message', 'Form_CentroComunicacionConsult.tpl', 67, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Centro de comunicaciones"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccionesCC.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/../../../../lib/dojo/dojo.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $_params = $this->_tag_stack[] = array('form', array('name' => 'frmComunicacionConsult','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Los campos con (*) son obligatorios para la generaci&oacute;n de una nueva comunicaci&oacute;n. Para la consulta son obligatorias la fechas.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Centro de comunicaciones"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "<B>N&uacute;<u>m</u>ero de caso</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'comunicacion__ordenumeros','maxlength' => '30'), $this);?>
<B>*</B></td>
      <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Fec<u>h</u>a registro " ?></td>
      <td><?php echo smarty_function_date_set_proc(array('id' => 'ordefecregdi','name' => 'orden__ordefecregdi','form_name' => 'frmComunicacionConsult'), $this); echo "Hasta " ?>
   		  <?php echo smarty_function_date_set_proc(array('id' => 'ordefecregdf','name' => 'orden__ordefecregdf','form_name' => 'frmComunicacionConsult'), $this);?>
</td>
   	  <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>F</u>ormato de la carta</B> " ?></td> 
      <td><?php echo smarty_function_select_row_table(array('id' => 'focacodigos','name' => 'comunicacion__focacodigos','value' => 'focacodigos','sqlid' => 'formatocarta','label' => 'focanombres','is_null' => 'true'), $this);?>
<B>*</B></td>
      <td class="piedefoto"><?php echo ""; ?></td>
    </tr>
   <tr>
      <td><?php echo "E<u>s</u>tado " ?></td>
      <td><?php echo smarty_function_select_state(array('id' => 'comuestados','name' => 'comunicacion__comuestados','option' => '6','is_null' => 'true'), $this);?>
</td>
      <td class="piedefoto"><?php echo ""; ?></td>
    </tr>
   <tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'FeGeCmdCentroComunicacionConsult','onClick' => "jsDrawListado();"), $this);?>

				<?php echo smarty_function_btn_button(array('value' => 'Nuevo','id' => 'CmdNew','name' => 'FeGeCmdCentroComunicacionCreate','onClick' => "jsCreateCT();"), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_listado','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden_message(array('value' => '66'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'M\');'."\n".'	jsAccessKey(\'focacodigos\',\'F\');'."\n".'	jsAccessKey(\'ordefecregdi\',\'H\');'."\n".'	jsAccessKey(\'comuestados\',\'S\');'."\n".'	jsAccessKey(\'comuasuntos\',\'A\');'."\n".'	jsAccessKey(\'comucodigos\',\'D\');'."\n".'	jsAccessKey(\'accion\',\'I\');'."\n".'	jsAccessKey(\'pregunta\',\'L\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdNew\',\'N\',\'Nuevo\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'</script>'."\n";  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>