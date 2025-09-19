<?php /* Smarty version 2.6.0, created on 2020-10-24 14:27:59
         compiled from Form_Seguimiento.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Seguimiento.tpl', 3, false),array('block', 'body', 'Form_Seguimiento.tpl', 9, false),array('block', 'form', 'Form_Seguimiento.tpl', 11, false),array('block', 'fieldset', 'Form_Seguimiento.tpl', 139, false),array('function', 'putstyle', 'Form_Seguimiento.tpl', 5, false),array('function', 'loadTarecodigos', 'Form_Seguimiento.tpl', 19, false),array('function', 'textfield_ordenumeros', 'Form_Seguimiento.tpl', 22, false),array('function', 'calendar', 'Form_Seguimiento.tpl', 29, false),array('function', 'textfield', 'Form_Seguimiento.tpl', 36, false),array('function', 'href', 'Form_Seguimiento.tpl', 37, false),array('function', 'select_row_table', 'Form_Seguimiento.tpl', 46, false),array('function', 'select_son', 'Form_Seguimiento.tpl', 52, false),array('function', 'select_entes_esp', 'Form_Seguimiento.tpl', 78, false),array('function', 'checkbox', 'Form_Seguimiento.tpl', 79, false),array('function', 'select_constant', 'Form_Seguimiento.tpl', 111, false),array('function', 'btn_command', 'Form_Seguimiento.tpl', 119, false),array('function', 'btn_clean', 'Form_Seguimiento.tpl', 120, false),array('function', 'hidden', 'Form_Seguimiento.tpl', 126, false),array('function', 'viewListadoSeguimientos', 'Form_Seguimiento.tpl', 135, false),array('function', 'message', 'Form_Seguimiento.tpl', 140, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Listado de compromisos"; ?></title>
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

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmSeguimiento','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;El listado de compromisos toma los datos digitados para hacer la consulta.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Listado de compromisos"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<?php echo smarty_function_loadTarecodigos(array(), $this);?>

	<tr>
      <td width='25%'><?php echo "<u>N</u>&uacute;mero del caso " ?></td>
      <td width='60%'><?php echo smarty_function_textfield_ordenumeros(array('id' => 'ordenumeros','name' => 'ordenumeros','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto" width='15%'><?php echo ""; ?></td>
   </tr>
  	
   <tr>
      <td><?php echo "<u>F</u>echa de registro de caso " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecregd','name' => 'ordefecregd','is_null' => 'true','form_name' => 'frmSeguimiento'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>ersona / Entidad infractora " ?></td>
      <td> 
      	<?php echo smarty_function_textfield(array('id' => 'infrcodigos','name' => 'infrcodigos','onBlur' => "if(this.value!='')autoReference('infractor','infrcodigos',Array(this),document.frmSeguimiento.infrcodigos_desc); else document.frmSeguimiento.infrcodigos_desc.value='';"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/referencia.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:fncopenwindows('FeCrCmdLstHelp','table=infractor&sqlid=infractor&return_obj=infrcodigos&return_key=infrcodigos&infractor__infrcodigos='+document.frmSeguimiento.infrcodigos.value+'&infractor__infrnombres='+document.frmSeguimiento.infrcodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'infrcodigos_desc'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>ipo de Caso " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','name' => 'tiorcodigos','sqlid' => 'tipoorden','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','command_default' => 'FeCrCmdDefaultSeguimiento'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>C</u>lasificaci&oacute;n " ?></td>
   	  <td>
		<?php echo smarty_function_select_son(array('name' => 'evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'tiorcodigos','sqlid' => 'tipoorden_evento','command_default' => 'FeCrCmdDefaultSeguimiento'), $this);?>

  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>S</u>ubclasificaci&oacute;n " ?></td>
      <td>
		<?php echo smarty_function_select_son(array('name' => 'causcodigos','table_hijo' => 'causa','id_hijo' => 'causcodigos','label_hijo' => 'causnombres','foreign_name' => "",'select_papa' => "tiorcodigos,evencodigos",'sqlid' => 'tipoorden_evento_causa'), $this);?>
     
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>D</u>ependencia " ?></td>
      <td>
          <?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'orgacodigos','is_null' => 'true','form' => 'frmSeguimiento'), $this);?>

          <?php echo smarty_function_checkbox(array('name' => 'children','value' => 'OK'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "Locali<u>z</u>aci&oacute;n " ?></td>
   	  <td>
      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'locacodigos','onBlur' => "if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.locacodigos_desc)"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeCrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmSeguimiento.locacodigos.value+'&locacodigos_desc='+document.frmSeguimiento.locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'locacodigos_desc'), $this);?>
      
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>C</u>ompromiso " ?></td>
   	  <td>
      	<?php echo smarty_function_select_row_table(array('table_name' => 'compromiso','is_null' => 'true','id' => 'compcodigos','name' => 'compcodigos','value' => 'compcodigos','label' => 'compdescris'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "V<u>e</u>ncimiento de compromisos " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'accofecrevn','name' => 'accofecrevn','is_null' => 'true','form_name' => 'frmSeguimiento'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>E</u>stado del compromiso " ?></td>
   	  <td>
      	<?php echo smarty_function_select_constant(array('id' => 'accoactivas','name' => 'accoactivas'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','onClick' => "document.frmSeguimiento.consult__flag.value = 1;",'id' => 'CmdShow','name' => 'FeCrCmdDefaultSeguimiento','form_name' => 'frmSeguimiento'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Seguimiento','form_name' => 'frmSeguimiento'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table><br><br>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'consult__flag'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acta'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'tarecodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'compromiso'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acemnumerosupd'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orga'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orden'), $this);?>


<?php echo smarty_function_viewListadoSeguimientos(array('form' => 'frmSeguimiento'), $this);?>


<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'N\');'."\n".'	jsAccessKey(\'proccodigos\',\'P\');'."\n".'	jsAccessKey(\'ordesitiejes\',\'D\');'."\n".'	jsAccessKey(\'usuacodigos\',\'U\');'."\n".'	jsAccessKey(\'ordeobservs\',\'O\');'."\n".'	jsAccessKey(\'accoobservas\',\'B\');'."\n".'	jsAccessKey(\'ordefecingd\',\'G\');'."\n".'	jsAccessKey(\'ordefecregd\',\'F\');'."\n".'	jsAccessKey(\'ordefecvend\',\'E\');'."\n".'	jsAccessKey(\'ordefecfinad\',\'A\');'."\n".'	jsAccessKey(\'ordefecentn\',\'T\');'."\n".'	jsAccessKey(\'contidentis\',\'S\');'."\n".'	jsAccessKey(\'priocodigos\',\'R\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'evencodigos\',\'C\');'."\n".'	jsAccessKey(\'causcodigos\',\'S\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'merecodigos\',\'M\');'."\n".'	jsAccessKey(\'locacodigos\',\'Z\');'."\n".'	jsAccessKey(\'oremanexos\',\'X\');'."\n".'	jsAccessKey(\'oremradicas\',\'R\');'."\n".'	jsAccessKey(\'ordenamiento\',\'O\');'."\n".'	jsAccessKey(\'action\',\'A\');'."\n".'	jsAccessKey(\'actaestacts\',\'E\');'."\n".'	jsAccessKey(\'infrcodigos\',\'P\');'."\n".'	jsAccessKey(\'compcodigos\',\'C\');'."\n".'	jsAccessKey(\'accofecrevn\',\'E\');'."\n".'	jsAccessKey(\'accoactivas\',\'E\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdPrint\',\'I\',\'Imprimir\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>