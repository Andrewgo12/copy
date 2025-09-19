<?php /* Smarty version 2.6.0, created on 2020-09-23 00:51:57
         compiled from Form_Reqeps.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'putstyle', 'Form_Reqeps.tpl', 5, false),array('function', 'calendar', 'Form_Reqeps.tpl', 19, false),array('function', 'select_row_table', 'Form_Reqeps.tpl', 26, false),array('function', 'checkbox', 'Form_Reqeps.tpl', 40, false),array('function', 'btn_button', 'Form_Reqeps.tpl', 55, false),array('function', 'btn_clean', 'Form_Reqeps.tpl', 57, false),array('function', 'hidden', 'Form_Reqeps.tpl', 63, false),array('function', 'message', 'Form_Reqeps.tpl', 66, false),array('block', 'body', 'Form_Reqeps.tpl', 8, false),array('block', 'form', 'Form_Reqeps.tpl', 10, false),array('block', 'fieldset', 'Form_Reqeps.tpl', 65, false),)), $this); ?>
<html>
<head>
      <title><?php echo "Reporte de casos por empresa aseguradora de salud"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>
</head>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmReqeps','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center"><?php echo "<fieldset class=context_help>&nbsp;&nbsp;Este reporte imforma la cantidad de casos por cada tipo de caso, clasificaci&oacute;n o subclasificaci&oacute;n impuestos por cada empresa.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?></td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Reporte de casos por empresa aseguradora de salud"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td><?php echo "<B>R<u>e</u>gistro</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecregd','name' => 'orden__ordefecregd','is_null' => 'true','form_name' => 'frmReqeps'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecregd','name' => 'orden__ordefecregd2','is_null' => 'true','form_name' => 'frmReqeps'), $this);?>
<B>*</B>
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "E<u>m</u>p. aseguradora de salud " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'ipsecodigos','name' => 'ordenempresa__ipsecodigos','sqlid' => 'ips','table_name' => 'ipsservicio','value' => 'ipsecodigos','label' => 'ipsenombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>ipo de caso " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','name' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2"><b><?php echo "<u>N</u>ivel de detalle " ?></b></td>
		<td class="piedefoto"></td>
	</tr>
   <tr>
      <td><?php echo "Cl<u>a</u>sificaciones " ?></td>
      <td><?php echo smarty_function_checkbox(array('id' => 'evencodigos','name' => 'evencodigos'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>S</u>ubclasificaciones " ?></td>
      <td><?php echo smarty_function_checkbox(array('id' => 'causcodigos','name' => 'causcodigos'), $this);?>
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
				<?php echo smarty_function_btn_button(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdDefaultReqeps','form_name' => 'frmReqeps','onClick' => "fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyReqeps&ipsecodigos='+this.form.ordenempresa__ipsecodigos.value+'&tiorcodigos='+this.form.ordenempresa__tiorcodigos.value+'&ordefecregd='+this.form.orden__ordefecregd.value+'&ordefecregd2='+this.form.orden__ordefecregd2.value+'&evencodigos='+this.form.evencodigos.checked+'&causcodigos='+this.form.causcodigos.checked+'&vars=ipsecodigos,tiorcodigos,ordefecregd,ordefecregd2,causcodigos,evencodigos');"), $this);?>
				
                <?php echo smarty_function_btn_clean(array('table_name' => 'Reqeps','form_name' => 'frmReqeps'), $this);?>

            </div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeCrCmdDefaultReqeps'), $this);?>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'subtitle\',\'R\');'."\n".'	jsAccessKey(\'ordefecregd\',\'E\');'."\n".'	jsAccessKey(\'ipsecodigos\',\'M\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'detail\',\'N\');'."\n".'	jsAccessKey(\'evencodigos\',\'A\');'."\n".'	jsAccessKey(\'causcodigos\',\'S\');'."\n".'	jsAccessKey(\'total\',\'O\');'."\n".'	jsAccessKey(\'total1\',\'T\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>