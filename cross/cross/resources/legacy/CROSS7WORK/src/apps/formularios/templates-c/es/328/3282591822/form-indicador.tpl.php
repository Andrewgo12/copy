<?php /* Smarty version 2.6.0, created on 2020-10-15 14:40:10
         compiled from Form_Indicador.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Indicador.tpl', 3, false),array('block', 'body', 'Form_Indicador.tpl', 9, false),array('block', 'form', 'Form_Indicador.tpl', 11, false),array('block', 'fieldset', 'Form_Indicador.tpl', 83, false),array('function', 'putstyle', 'Form_Indicador.tpl', 5, false),array('function', 'calendar', 'Form_Indicador.tpl', 24, false),array('function', 'textfield', 'Form_Indicador.tpl', 32, false),array('function', 'href', 'Form_Indicador.tpl', 33, false),array('function', 'select_row_table', 'Form_Indicador.tpl', 42, false),array('function', 'btn_button', 'Form_Indicador.tpl', 53, false),array('function', 'btn_clean', 'Form_Indicador.tpl', 54, false),array('function', 'hidden', 'Form_Indicador.tpl', 79, false),array('function', 'message', 'Form_Indicador.tpl', 84, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Indicador</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmIndicador','enctype' => "multipart/form-data",'method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
<tr>
	<td class="piedefoto">
		<table border="0" align="center" width="100%">
		<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;El indicador de encuestas por servicio presenta el an&aacute;lisis de resultados de las encuestas para cada servicio.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Indicador de encuestas por servicio"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td><?php echo "<B>Fecha de registro</B> " ?></td>
      <td><?php echo smarty_function_calendar(array('name' => 'indicador__fechaini','id' => 'fechaini','form_name' => 'frmIndicador','hour' => 'true'), $this);?>

      <?php echo "<B> Hasta </B> " ?>
      <?php echo smarty_function_calendar(array('name' => 'indicador__fechafin','id' => 'fechafin','form_name' => 'frmIndicador','hour' => 'true'), $this);?>
<b>*</b></td>
      <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
      <td width='25%'><?php echo "<B><u>S</u>ervicio</B> " ?></td>
      <td width='60%'><?php echo smarty_function_textfield(array('id' => 'orgacodigos','name' => 'indicador__orgacodigos','value' => "",'onBlur' => "if(this.value!='')autoReference('organizacion','orgacodigos',Array(this),document.frmIndicador.orgacodigos_desc);else document.frmIndicador.orgacodigos_desc.value=''"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindows('../cross300/index.php?action=FeCrCmdTreeHelp&table=organizacion&sqlid=organizacion&return_obj=indicador__orgacodigos&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.frmIndicador.indicador__orgacodigos.value+'&orgacodigos_desc='+document.frmIndicador.orgacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'orgacodigos_desc','value' => ""), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
      <td width='25%'><?php echo "<B><u>F</u>ormulario</B> " ?></td>
      <td width='60%'><?php echo smarty_function_select_row_table(array('id' => 'formcodigon','sqlid' => 'formulario','name' => 'indicador__formcodigon','table_name' => 'formulario','value' => 'formcodigon','label' => 'formnombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
	<td class="piedefoto" colspan="2">
		<table border="0" align="center" width="100%">
		<tr><td colspan="3"><div align="center">
		    	<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'consultar','onClick' => "if(valDatos())fncopenwindows('FeEnCmdViewIndicador','fechaini='+this.form.indicador__fechaini.value+'&fechafin='+this.form.indicador__fechafin.value+'&formcodigon='+this.form.indicador__formcodigon.value+'&orgacodigos='+this.form.indicador__orgacodigos.value);"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Indicador','form_name' => 'frmIndicador'), $this);?>

			</div></td></tr>
		<tr><td colspan="3" class="piedefoto">&nbsp;</td></tr>
		</table>
		<td class="piedefoto">&nbsp;</td>
	</td>
</tr>
</table>
	</td>
</tr>
</table>
<?php echo '
<script language=\'javascript\'>
    function valDatos(){
        if(!document.frmIndicador.indicador__fechaini.value || 
           !document.frmIndicador.indicador__orgacodigos.value ||
           !document.frmIndicador.indicador__fechafin.value){
            location=\'index.php?action=FeEnCmdDefaultIndicador&cod_message=0\';
            return false
        }
        return true;
    }
</script>
'; ?>


<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'focusposition'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'formcodigon\',\'F\');'."\n".'	jsAccessKey(\'orgacodigos\',\'S\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Adicionar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>