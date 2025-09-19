<?php /* Smarty version 2.6.0, created on 2020-10-02 18:34:34
         compiled from Form_Grupo.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Grupo.tpl', 3, false),array('block', 'body', 'Form_Grupo.tpl', 9, false),array('block', 'form', 'Form_Grupo.tpl', 12, false),array('block', 'fieldset', 'Form_Grupo.tpl', 62, false),array('function', 'putstyle', 'Form_Grupo.tpl', 5, false),array('function', 'textfield', 'Form_Grupo.tpl', 23, false),array('function', 'select_row_table', 'Form_Grupo.tpl', 33, false),array('function', 'btn_command', 'Form_Grupo.tpl', 43, false),array('function', 'btn_clean', 'Form_Grupo.tpl', 47, false),array('function', 'viewgrupodetalle', 'Form_Grupo.tpl', 55, false),array('function', 'hidden', 'Form_Grupo.tpl', 56, false),array('function', 'hiddenactiveregistry', 'Form_Grupo.tpl', 59, false),array('function', 'message', 'Form_Grupo.tpl', 63, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Grupos"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/overlib_mini.js" type="text/javascript"></script>
<script language="javascript" src="web/js/Calendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmGrupo','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="70%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Para evitar que un grupo sea ingresado sin personal revise que el personal haya sido adicionado en el detalle.<br><b>NOTA: </b>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Grupos"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo de grupo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'grupcodigos','name' => 'grupo__grupcodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre del grupo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'grupnombres','name' => 'grupo__grupnombres','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>E<u>s</u>tado del grupo</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'esgrcodigos','name' => 'grupo__esgrcodigos','table_name' => 'estadogrupo','value' => 'esgrcodigos','label' => 'esgrnombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeHrCmdAddGrupo','form_name' => 'frmGrupo'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeHrCmdUpdateGrupo','form_name' => 'frmGrupo','loadFields' => "grupo__grupcodigos,grupo__grupnombres,grupo__esgrcodigos",'confirm' => '14'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeHrCmdDeleteGrupo','form_name' => 'frmGrupo','loadFields' => "grupo__grupcodigos,grupo__grupnombres,grupo__esgrcodigos",'confirm' => '15'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeHrCmdShowListGrupo','form_name' => 'frmGrupo'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Grupo','form_name' => 'frmGrupo'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<br><p>
<br><p>
<center><?php echo smarty_function_viewgrupodetalle(array('table' => 'grupodetalle','form' => 'frmGrupo'), $this);?>
</center>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'grupo__grupcodigon'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'indice','id' => 'indice','value' => ""), $this);?>

<?php echo smarty_function_hiddenactiveregistry(array('name' => 'grupo__grupactivos'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'grupcodigos\',\'D\');'."\n".'	jsAccessKey(\'grupnombres\',\'N\');'."\n".'	jsAccessKey(\'esgrcodigos\',\'S\');'."\n".'	jsAccessKey(\'grupfchainin\',\'F\');'."\n".'	jsAccessKey(\'grupfchafinn\',\'H\');'."\n".'	jsAccessKey(\'grupactivos\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>