<?php /* Smarty version 2.6.0, created on 2014-07-08 09:20:41
         compiled from Form_Actuareq.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Actuareq.tpl', 3, false),array('block', 'body', 'Form_Actuareq.tpl', 9, false),array('block', 'form', 'Form_Actuareq.tpl', 11, false),array('block', 'fieldset', 'Form_Actuareq.tpl', 60, false),array('function', 'putstyle', 'Form_Actuareq.tpl', 5, false),array('function', 'textfield', 'Form_Actuareq.tpl', 19, false),array('function', 'select_row_table', 'Form_Actuareq.tpl', 24, false),array('function', 'calendar', 'Form_Actuareq.tpl', 30, false),array('function', 'btn_button', 'Form_Actuareq.tpl', 50, false),array('function', 'btn_clean', 'Form_Actuareq.tpl', 52, false),array('function', 'hidden', 'Form_Actuareq.tpl', 58, false),array('function', 'message', 'Form_Actuareq.tpl', 61, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Listado de atenciones"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmActuareq','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center"><?php echo "<fieldset class=context_help>&nbsp;&nbsp;Este listado permite la b&uacute;squeda de actuaciones.</fieldset>" ?></td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Listado de atenciones"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td><?php echo "C<u>a</u>so " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'orden__ordenumeros','is_null' => 'true'), $this);?>
</td>
      <td class="piedefoto"><?php echo ""; ?></td>
	</tr>
   <tr>
      <td><?php echo "Grupo " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'grupcodigos','name' => 'organizacion__grupcodigos','sqlid' => 'grupo','table_name' => 'grupo','value' => 'grupcodigos','label' => 'grupnombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>R</u>egistro " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'acemfeccren','name' => 'actaempresa__acemfeccren','is_null' => 'true','form_name' => 'frmActuareq'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'acemfeccren','name' => 'actaempresa__acemfeccren2','is_null' => 'true','form_name' => 'frmActuareq'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "A<u>t</u>enci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'acemfecaten','name' => 'actaempresa__acemfecaten','is_null' => 'true','form_name' => 'frmActuareq'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'acemfecaten','name' => 'actaempresa__acemfecaten2','is_null' => 'true','form_name' => 'frmActuareq'), $this);?>

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
				<?php echo smarty_function_btn_button(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdDefaultActuareq','form_name' => 'frmActuareq','onClick' => "fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyActuareq&ordenumeros='+this.form.orden__ordenumeros.value+'&grupcodigos='+this.form.organizacion__grupcodigos.value+'&acemfeccren='+this.form.actaempresa__acemfeccren.value+'&acemfeccren2='+this.form.actaempresa__acemfeccren2.value+'&acemfecaten='+this.form.actaempresa__acemfecaten.value+'&acemfecaten2='+this.form.actaempresa__acemfecaten2.value+'&vars=ordenumeros,grupcodigos,acemradics,orgacodigos,acemfeccren,acemfeccren2,acemfecaten,acemfecaten2');"), $this);?>
				
                <?php echo smarty_function_btn_clean(array('table_name' => 'Actuareq','form_name' => 'frmActuareq'), $this);?>

            </div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeCrCmdDefaultfrmActuareq'), $this);?>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'A\');'."\n".'	jsAccessKey(\'acemfecaten\',\'T\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'acemfeccren\',\'R\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>