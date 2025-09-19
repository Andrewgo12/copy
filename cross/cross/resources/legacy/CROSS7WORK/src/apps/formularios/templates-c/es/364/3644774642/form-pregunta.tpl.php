<?php /* Smarty version 2.6.0, created on 2020-10-15 14:39:18
         compiled from Form_Pregunta.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Pregunta.tpl', 5, false),array('block', 'body', 'Form_Pregunta.tpl', 12, false),array('block', 'form', 'Form_Pregunta.tpl', 14, false),array('block', 'textarea', 'Form_Pregunta.tpl', 25, false),array('block', 'fieldset', 'Form_Pregunta.tpl', 70, false),array('function', 'putstyle', 'Form_Pregunta.tpl', 8, false),array('function', 'select_row_table', 'Form_Pregunta.tpl', 30, false),array('function', 'select_constant', 'Form_Pregunta.tpl', 35, false),array('function', 'select_estado', 'Form_Pregunta.tpl', 46, false),array('function', 'btn_command', 'Form_Pregunta.tpl', 56, false),array('function', 'btn_clean', 'Form_Pregunta.tpl', 60, false),array('function', 'hidden', 'Form_Pregunta.tpl', 66, false),array('function', 'message', 'Form_Pregunta.tpl', 71, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo "Preguntas"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsPregunta.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPregunta','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Las preguntas permiten determinar, por medio de una respuesta, el estado de una caracter&iacute;stica de la corporaci&oacute;n.
				    <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Preguntas"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   
   <tr>
      <td><?php echo "<B>E<u>n</u>unciado</B> " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'pregdescris','name' => 'pregunta__pregdescris','cols' => '100','rows' => '3')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>T</u>ema</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('name' => 'pregunta__temacodigon','table_name' => 'tema','is_null' => 'true','value' => 'temacodigon','label' => 'temanombres'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>T</u>ipo de pregunta</B> " ?></td>
      <td><?php echo smarty_function_select_constant(array('name' => 'pregunta__pregtipopres','id' => 'TIPO_PREG','labelfont' => 'pregunta','is_null' => 'true','onChange' => "setModeloRespuesta();"), $this);?>

      <B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "E<u>s</u>cala " ?></td>
      <td><?php echo smarty_function_select_row_table(array('name' => 'pregunta__morecodigon','id' => 'morecodigon','table_name' => 'modeloresp','is_null' => 'true','value' => 'morecodigon','label' => 'morenombres'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Estad<u>o</u> " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'pregactivas','name' => 'pregunta__pregactivas','table' => 'pregunta'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeEnCmdAddPregunta','form_name' => 'frmPregunta'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeEnCmdUpdatePregunta','form_name' => 'frmPregunta','loadFields' => "pregunta__pregcodigon,pregunta__pregdescris,pregunta__temacodigon,pregunta__pregtipopres",'confirm' => '12'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeEnCmdDeletePregunta','form_name' => 'frmPregunta','loadFields' => 'pregunta__pregcodigon','confirm' => '13'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeEnCmdShowListPregunta','form_name' => 'frmPregunta'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Pregunta','form_name' => 'frmPregunta'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'pregunta__pregcodigon'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'pregcodigon\',\'D\');'."\n".'	jsAccessKey(\'morecodigon\',\'S\');'."\n".'	jsAccessKey(\'pregtipopres\',\'T\');'."\n".'	jsAccessKey(\'pregdescris\',\'N\');'."\n".'	jsAccessKey(\'temanombres\',\'T\');'."\n".'	jsAccessKey(\'temacodigon\',\'T\');'."\n".'	jsAccessKey(\'ejtenombres\',\'J\');'."\n".'	jsAccessKey(\'A\',\'B\');'."\n".'	jsAccessKey(\'C\',\'R\');'."\n".'	jsAccessKey(\'pregactivas\',\'O\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>