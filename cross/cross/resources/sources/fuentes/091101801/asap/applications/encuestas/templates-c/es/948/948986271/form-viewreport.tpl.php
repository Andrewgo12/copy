<?php /* Smarty version 2.6.0, created on 2014-07-18 10:17:13
         compiled from Form_ViewReport.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_ViewReport.tpl', 3, false),array('block', 'body', 'Form_ViewReport.tpl', 10, false),array('block', 'form', 'Form_ViewReport.tpl', 12, false),array('block', 'fieldset', 'Form_ViewReport.tpl', 45, false),array('function', 'putstyle', 'Form_ViewReport.tpl', 6, false),array('function', 'openPdf', 'Form_ViewReport.tpl', 20, false),array('function', 'viewReport', 'Form_ViewReport.tpl', 23, false),array('function', 'closePdfDurCal', 'Form_ViewReport.tpl', 26, false),array('function', 'btn_command', 'Form_ViewReport.tpl', 35, false),array('function', 'hidden', 'Form_ViewReport.tpl', 42, false),array('function', 'message', 'Form_ViewReport.tpl', 46, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Reporte de Gesti&oacute;n"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsReporte.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmViewReport','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Reporte de Gesti&oacute;n"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<?php echo smarty_function_openPdf(array(), $this);?>

	
	<tr><td class="piedefoto">
	<?php echo smarty_function_viewReport(array(), $this);?>

	</td></tr>
	
	<?php echo smarty_function_closePdfDurCal(array('name' => 'reporte'), $this);?>

	
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Imprimir','onClick' => "print();",'id' => 'CmdPrint','name' => 'FeEnCmdViewReport','form_name' => 'frmViewReport'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cerrar','onClick' => "window.close();",'id' => 'CmdClose','name' => 'FeEnCmdViewReport','form_name' => 'frmViewReport'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'CmdPrint\',\'I\',\'Imprimir\');'."\n".'	jsAccessKey(\'CmdClose\',\'C\',\'Cerrar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>