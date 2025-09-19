<?php /* Smarty version 2.6.0, created on 2020-09-28 14:58:13
         compiled from Form_Paciente.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadlabels_pub', 'Form_Paciente.tpl', 2, false),array('function', 'printtitle_pub', 'Form_Paciente.tpl', 4, false),array('function', 'putstyle', 'Form_Paciente.tpl', 5, false),array('function', 'printlabel_pub', 'Form_Paciente.tpl', 19, false),array('function', 'textfield', 'Form_Paciente.tpl', 20, false),array('function', 'printcoment_pub', 'Form_Paciente.tpl', 21, false),array('function', 'select_row_table', 'Form_Paciente.tpl', 25, false),array('function', 'calendar', 'Form_Paciente.tpl', 50, false),array('function', 'href', 'Form_Paciente.tpl', 67, false),array('function', 'select_estado', 'Form_Paciente.tpl', 101, false),array('function', 'checkbox', 'Form_Paciente.tpl', 106, false),array('function', 'btn_command', 'Form_Paciente.tpl', 116, false),array('function', 'btn_clean', 'Form_Paciente.tpl', 120, false),array('function', 'hidden', 'Form_Paciente.tpl', 126, false),array('function', 'putjsacceskey_pub', 'Form_Paciente.tpl', 128, false),array('function', 'message', 'Form_Paciente.tpl', 130, false),array('block', 'head', 'Form_Paciente.tpl', 3, false),array('block', 'body', 'Form_Paciente.tpl', 9, false),array('block', 'form', 'Form_Paciente.tpl', 11, false),array('block', 'textarea', 'Form_Paciente.tpl', 96, false),array('block', 'fieldset', 'Form_Paciente.tpl', 129, false),)), $this); ?>
<html>
<?php echo smarty_function_loadlabels_pub(array('table_name' => 'Paciente','controls' => "CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"), $this);?>

<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo smarty_function_printtitle_pub(array(), $this);?>
</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/SelectControl.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsPaciente.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPaciente','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="70%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;<b>Nota: </b> Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo smarty_function_printtitle_pub(array(), $this);?>
</div></th></tr>
   <tr>
      <td width='25%'><?php echo smarty_function_printlabel_pub(array('name' => 'paciindentis','blBold' => 'true'), $this);?>
</td>
      <td width='60%'><?php echo smarty_function_textfield(array('id' => 'paciindentis','name' => 'paciente__paciindentis','maxlength' => '100','onChange' => "jsLoadPaciente();"), $this);?>
<b>*</b></td>
  	<td width='15%' class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'paciindentis'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'tiidcodigos','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiidcodigos','name' => 'paciente__tiidcodigos','table_name' => 'tipoidentifi','value' => 'tiidcodigos','label' => 'tiidnombres','is_null' => 'true','sqlid' => 'tipoidentifi'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'tiidcodigos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'paciprinoms','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'paciprinoms','name' => 'paciente__paciprinoms','maxlength' => '20','typeData' => 'string'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'paciprinoms'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacisegnoms'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'pacisegnoms','name' => 'paciente__pacisegnoms','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacisegnoms'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacipriapes','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'pacipriapes','name' => 'paciente__pacipriapes','maxlength' => '30','typeData' => 'string'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacipriapes'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacisegapes'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'pacisegapes','name' => 'paciente__pacisegapes','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacisegapes'), $this);?>
</td>
   </tr>
	<tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacifecnacis'), $this);?>
</td>
      <td><?php echo smarty_function_calendar(array('id' => 'pacifecnacis','name' => 'paciente__pacifecnacis','form_name' => 'frmPaciente','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacifecnacis'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'sexocodigos','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'sexocodigos','name' => 'paciente__sexocodigos','table_name' => 'sexo','value' => 'sexocodigos','label' => 'sexonombres','is_null' => 'true','sqlid' => 'sexo'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'sexocodigos'), $this);?>
</td>
   </tr>   
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'paciemail'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'paciemail','name' => 'paciente__paciemail','maxlength' => '100','size' => '52'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'paciemail'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'locacodigos'), $this);?>
</td>
      <td> 
      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'paciente__locacodigos','onBlur' => "if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmPaciente.paciente_locacodigos_desc);else document.frmPaciente.paciente_locacodigos_desc.value='';"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:fncopenwindows('FeCuCmdTreeHelp',  'table=localizacion&sqlid=localizacion&return_obj=paciente__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmPaciente.paciente__locacodigos.value+'&localizacion__locanombres='+document.frmPaciente.paciente_locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('id' => 'paciente_locacodigos_desc','name' => 'paciente_locacodigos_desc'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'locacodigos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacidirecios'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'pacidirecios','name' => 'paciente__pacidirecios','maxlength' => '100','size' => '52'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacidirecios'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacitelefons'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'pacitelefons','name' => 'paciente__pacitelefons','maxlength' => '13','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacitelefons'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'pacinumcels'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'pacinumcels','name' => 'paciente__pacinumcels','maxlength' => '13','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacinumcels'), $this);?>
</td>
   </tr>
   <tr>
      <td width='25%'><?php echo smarty_function_printlabel_pub(array('name' => 'pacihisclis'), $this);?>
</td>
      <td width='60%'><?php echo smarty_function_textfield(array('id' => 'pacihisclis','name' => 'paciente__pacihisclis','maxlength' => '100','size' => '52'), $this);?>
</td>
  	<td width='15%' class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'pacihisclis'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'paciobservs'), $this);?>
</td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'paciobservs','name' => 'paciente__paciobservs','cols' => '50','rows' => '2')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'paciobservs'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'paciactivos'), $this);?>
</td>
      <td><?php echo smarty_function_select_estado(array('id' => 'paciactivos','name' => 'paciente__paciactivos','table' => 'paciente'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'paciactivos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo " " ?></td>
      <td><?php echo smarty_function_checkbox(array('id' => 'contacto','value' => '1','name' => 'contacto'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCuCmdAddPaciente','form_name' => 'frmPaciente'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeCuCmdUpdatePaciente','form_name' => 'frmPaciente','loadFields' => "paciente__paciindentis,paciente__paciprinoms,paciente__pacipriapes,paciente__sexocodigos",'confirm' => '8'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Borrar','id' => 'CmdDelete','name' => 'FeCuCmdDeletePaciente','form_name' => 'frmPaciente','loadFields' => 'paciente__paciindentis','confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCuCmdShowListPaciente','form_name' => 'frmPaciente'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Paciente','form_name' => 'frmPaciente'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_putjsacceskey_pub(array(), $this);?>

<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>