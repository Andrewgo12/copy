<?php /* Smarty version 2.6.0, created on 2014-07-28 09:47:45
         compiled from Form_ViewIndicador.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_ViewIndicador.tpl', 3, false),array('block', 'body', 'Form_ViewIndicador.tpl', 10, false),array('block', 'form', 'Form_ViewIndicador.tpl', 12, false),array('block', 'fieldset', 'Form_ViewIndicador.tpl', 40, false),array('function', 'putstyle', 'Form_ViewIndicador.tpl', 6, false),array('function', 'viewIndicador', 'Form_ViewIndicador.tpl', 21, false),array('function', 'btn_command', 'Form_ViewIndicador.tpl', 31, false),array('function', 'hidden', 'Form_ViewIndicador.tpl', 37, false),array('function', 'message', 'Form_ViewIndicador.tpl', 41, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Indicador de encuestas por servicio"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsIndicador.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmViewIndicador','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Indicador de encuestas por servicio"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr><td class="piedefoto">
	<?php echo smarty_function_viewIndicador(array(), $this);?>

	</td></tr>
	
	<tr>
		<td colspan="2" class="piedefoto">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2" class="piedefoto">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cerrar','onClick' => "window.close();",'id' => 'CmdClose','name' => 'FeEnCmdViewIndicador','form_name' => 'frmViewIndicador'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'servicio\',\'S\');'."\n".'	jsAccessKey(\'fecha\',\'F\');'."\n".'	jsAccessKey(\'promedio\',\'P\');'."\n".'	jsAccessKey(\'formula\',\'R\');'."\n".'	jsAccessKey(\'encuesta\',\'N\');'."\n".'	jsAccessKey(\'si\',\'A\');'."\n".'	jsAccessKey(\'no\',\'T\');'."\n".'	jsAccessKey(\'por\',\'O\');'."\n".'	jsAccessKey(\'WU\',\'U\');'."\n".'	jsAccessKey(\'OU\',\'O\');'."\n".'	jsAccessKey(\'CmdPrint\',\'I\',\'Imprimir\');'."\n".'	jsAccessKey(\'CmdClose\',\'C\',\'Cerrar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>