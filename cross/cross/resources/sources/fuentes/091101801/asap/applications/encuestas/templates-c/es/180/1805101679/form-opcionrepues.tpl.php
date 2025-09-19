<?php /* Smarty version 2.6.0, created on 2016-06-15 16:00:01
         compiled from Form_Opcionrepues.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Opcionrepues.tpl', 5, false),array('block', 'body', 'Form_Opcionrepues.tpl', 12, false),array('block', 'form', 'Form_Opcionrepues.tpl', 14, false),array('block', 'textarea', 'Form_Opcionrepues.tpl', 25, false),array('block', 'fieldset', 'Form_Opcionrepues.tpl', 59, false),array('function', 'putstyle', 'Form_Opcionrepues.tpl', 8, false),array('function', 'select_row_table', 'Form_Opcionrepues.tpl', 30, false),array('function', 'select_estado', 'Form_Opcionrepues.tpl', 35, false),array('function', 'btn_command', 'Form_Opcionrepues.tpl', 45, false),array('function', 'btn_clean', 'Form_Opcionrepues.tpl', 49, false),array('function', 'hidden', 'Form_Opcionrepues.tpl', 55, false),array('function', 'message', 'Form_Opcionrepues.tpl', 60, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo "Respuestas"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmOpcionrepues','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Las respuestas son valores que permiten conocer la opini&oacute;n de las personas frente a una pregunta. Estas respuestas adem&aacute;s se acompa&ntilde;an de pesos que no son m&aacute;s que puntaje que permite cuantificar la opini&oacute;n de las personas.
				    <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Respuestas"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   
   <tr>
      <td><?php echo "<B>Val<u>o</u>r</B> " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'opredescrisp','name' => 'opcionrepues__opredescrisp','cols' => '100','rows' => '3')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "E<u>s</u>cala " ?></td>
      <td><?php echo smarty_function_select_row_table(array('name' => 'opcionrepues__morecodigon','id' => 'morecodigon','table_name' => 'modeloresp','is_null' => 'true','value' => 'morecodigon','label' => 'morenombres'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Es<u>t</u>ado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'pregactivas','name' => 'opcionrepues__opreactivas','table' => 'opcionrepues'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeEnCmdAddOpcionrepues','form_name' => 'frmOpcionrepues'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeEnCmdUpdateOpcionrepues','form_name' => 'frmOpcionrepues','loadFields' => "opcionrepues__oprecodigon,opcionrepues__opredescrisp",'confirm' => '12'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeEnCmdDeleteOpcionrepues','form_name' => 'frmOpcionrepues','loadFields' => 'opcionrepues__oprecodigon','confirm' => '13'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeEnCmdShowListOpcionrepues','form_name' => 'frmOpcionrepues'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Opcionrepues','form_name' => 'frmOpcionrepues'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'opcionrepues__oprecodigon'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'oprecodigon\',\'D\');'."\n".'	jsAccessKey(\'morecodigon\',\'S\');'."\n".'	jsAccessKey(\'opredescrisp\',\'O\');'."\n".'	jsAccessKey(\'opreactivas\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>