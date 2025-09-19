<?php /* Smarty version 2.6.0, created on 2020-10-07 08:14:47
         compiled from Form_Equivalencias_Consult.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'putstyle', 'Form_Equivalencias_Consult.tpl', 5, false),array('function', 'consult_table', 'Form_Equivalencias_Consult.tpl', 12, false),array('function', 'btn_command', 'Form_Equivalencias_Consult.tpl', 25, false),array('function', 'hidden', 'Form_Equivalencias_Consult.tpl', 30, false),array('block', 'body', 'Form_Equivalencias_Consult.tpl', 8, false),array('block', 'form', 'Form_Equivalencias_Consult.tpl', 11, false),)), $this); ?>
<html>
<head>
      <title>Consultar Equivalencias</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>
</head>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEquivalenciasConsult','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  echo smarty_function_consult_table(array('table_name' => 'equivalencias','llaves' => 'equicodigon','fields' => 'equicodigon','form_name' => 'frmEquivalenciasConsult','sqlid' => 'equivalencias','command' => 'FeGeCmdShowListEquivalencias','date_fields' => 'equifechacrn'), $this);?>

<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cancelar','id' => 'CmdCancel','name' => 'FeGeCmdCancelShowListEquivalencias','form_name' => 'frmEquivalenciasConsult'), $this);?>

			</div>
		</td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'equicodigon\',\'D\');'."\n".'	jsAccessKey(\'equitablcros\',\'N\');'."\n".'	jsAccessKey(\'equicampcros\',\'O\');'."\n".'	jsAccessKey(\'equivalcros\',\'L\');'."\n".'	jsAccessKey(\'equinomcros\',\'R\');'."\n".'	jsAccessKey(\'equitabldocs\',\'M\');'."\n".'	jsAccessKey(\'equicampdocs\',\'B\');'."\n".'	jsAccessKey(\'equivaldocs\',\'I\');'."\n".'	jsAccessKey(\'equinomdocs\',\'E\');'."\n".'	jsAccessKey(\'equifechacrn\',\'F\');'."\n".'	jsAccessKey(\'equiestados\',\'S\');'."\n".'	jsAccessKey(\'equiareacros\',\'R\');'."\n".'	jsAccessKey(\'equiareadocs\',\'U\');'."\n".'	jsAccessKey(\'equiseridocs\',\'T\');'."\n".'	jsAccessKey(\'CmdAccept\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdCancel\',\'C\',\'Cancelar\');'."\n".'</script>'."\n";  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>