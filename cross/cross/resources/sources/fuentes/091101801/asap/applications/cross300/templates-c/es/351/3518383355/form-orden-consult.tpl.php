<?php /* Smarty version 2.6.0, created on 2014-10-30 13:58:52
         compiled from Form_Orden_Consult.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Orden_Consult.tpl', 3, false),array('block', 'body', 'Form_Orden_Consult.tpl', 9, false),array('block', 'form', 'Form_Orden_Consult.tpl', 12, false),array('function', 'putstyle', 'Form_Orden_Consult.tpl', 5, false),array('function', 'consult_table_orden', 'Form_Orden_Consult.tpl', 13, false),array('function', 'btn_command', 'Form_Orden_Consult.tpl', 25, false),array('function', 'hidden', 'Form_Orden_Consult.tpl', 30, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Consultar Orden</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmOrdenConsult','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  echo smarty_function_consult_table_orden(array('table_name' => 'orden','llaves' => 'ordenumeros','form_name' => 'frmOrdenConsult','sqlid' => 'orden','command' => 'FeCrCmdShowListOrden','date_fields' => 'ordefecingd'), $this);?>

<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Cancelar','id' => 'CmdCancel','name' => 'FeCrCmdCancelShowListOrden','form_name' => 'frmOrdenConsult'), $this);?>

			</div>
		</td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'N\');'."\n".'	jsAccessKey(\'ordesitiejes\',\'R\');'."\n".'	jsAccessKey(\'ordeobservs\',\'D\');'."\n".'	jsAccessKey(\'ordefecregd\',\'E\');'."\n".'	jsAccessKey(\'ordefecvend\',\'I\');'."\n".'	jsAccessKey(\'contidentis_p\',\'U\');'."\n".'	jsAccessKey(\'contidentis\',\'L\');'."\n".'	jsAccessKey(\'priocodigos\',\'P\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'evencodigos\',\'S\');'."\n".'	jsAccessKey(\'causcodigos\',\'B\');'."\n".'	jsAccessKey(\'locacodigos\',\'O\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'merecodigos\',\'M\');'."\n".'	jsAccessKey(\'denunciante\',\'R\');'."\n".'	jsAccessKey(\'proccodigos\',\'P\');'."\n".'	jsAccessKey(\'ordefecingd\',\'G\');'."\n".'	jsAccessKey(\'oremnumsegs\',\'N\');'."\n".'	jsAccessKey(\'infrcodigos\',\'A\');'."\n".'	jsAccessKey(\'paciente\',\'P\');'."\n".'	jsAccessKey(\'sesocodigos\',\'S\');'."\n".'	jsAccessKey(\'couscodigos\',\'C\');'."\n".'	jsAccessKey(\'ipscodigos\',\'E\');'."\n".'	jsAccessKey(\'CmdAccept\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdCancel\',\'C\',\'Cancelar\');'."\n".'</script>'."\n";  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>