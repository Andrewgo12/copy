<?php /* Smarty version 2.6.0, created on 2020-11-02 16:29:04
         compiled from Form_Contacto.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadlabels_pub', 'Form_Contacto.tpl', 2, false),array('function', 'printtitle_pub', 'Form_Contacto.tpl', 4, false),array('function', 'putstyle', 'Form_Contacto.tpl', 5, false),array('function', 'help_context_pub', 'Form_Contacto.tpl', 14, false),array('function', 'printlabel_pub', 'Form_Contacto.tpl', 19, false),array('function', 'textfield', 'Form_Contacto.tpl', 20, false),array('function', 'printcoment_pub', 'Form_Contacto.tpl', 21, false),array('function', 'select_row_table_lang', 'Form_Contacto.tpl', 25, false),array('function', 'dataselectdojo', 'Form_Contacto.tpl', 31, false),array('function', 'href', 'Form_Contacto.tpl', 32, false),array('function', 'calendar', 'Form_Contacto.tpl', 60, false),array('function', 'select_estado', 'Form_Contacto.tpl', 111, false),array('function', 'btn_command', 'Form_Contacto.tpl', 121, false),array('function', 'btn_clean', 'Form_Contacto.tpl', 125, false),array('function', 'hidden', 'Form_Contacto.tpl', 131, false),array('function', 'putjsacceskey_pub', 'Form_Contacto.tpl', 135, false),array('function', 'message', 'Form_Contacto.tpl', 137, false),array('block', 'head', 'Form_Contacto.tpl', 3, false),array('block', 'body', 'Form_Contacto.tpl', 9, false),array('block', 'form', 'Form_Contacto.tpl', 11, false),array('block', 'textarea', 'Form_Contacto.tpl', 106, false),array('block', 'fieldset', 'Form_Contacto.tpl', 136, false),)), $this); ?>
<html>
<?php echo smarty_function_loadlabels_pub(array('table_name' => 'Contacto','controls' => "CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"), $this);?>

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
<script language="javascript" src="web/js/SelectControl.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmContacto','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="70%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo smarty_function_help_context_pub(array(), $this);?>

  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo smarty_function_printtitle_pub(array(), $this);?>
</div></th></tr>
   <tr>
      <td width='25%'><?php echo smarty_function_printlabel_pub(array('name' => 'contindentis','blBold' => 'true'), $this);?>
</td>
      <td width='60%'><?php echo smarty_function_textfield(array('id' => 'contindentis','name' => 'contacto__contindentis','maxlength' => '100'), $this);?>
<b>*</b></td>
  	<td width='15%' class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contindentis'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'tiidcodigos','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table_lang(array('id' => 'tiidcodigos','name' => 'contacto__tiidcodigos','table_name' => 'tipoidentifi','value' => 'tiidcodigos','label' => 'tiidnombres','is_null' => 'true','sqlid' => 'tipoidentifi'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'tiidcodigos'), $this);?>
</td>
   </tr>
   <!-- <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'cliecodigos'), $this);?>
</td>
      <td>
      	 <?php echo smarty_function_dataselectdojo(array('htmlid' => 'contacto__cliecodigos','name' => 'contacto__cliecodigos','sqlid' => 'cliente_ref','value' => 'cliecodigos','label' => 'clienombres','forceautoreference' => 'true'), $this);?>
 
	    <?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:fncopenwindows('FeCuCmdDefaultCliente','');"), $this);?>

     </td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'cliecodigos'), $this);?>
</td>
   </tr>-->
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contprinoms','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contprinoms','name' => 'contacto__contprinoms','maxlength' => '20','typeData' => 'string'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contprinoms'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contsegnoms'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contsegnoms','name' => 'contacto__contsegnoms','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contsegnoms'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contpriapes','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contpriapes','name' => 'contacto__contpriapes','maxlength' => '30','typeData' => 'string'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contpriapes'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contsegapes'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contsegapes','name' => 'contacto__contsegapes','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contsegapes'), $this);?>
</td>
   </tr>
	<tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contfecnacis'), $this);?>
</td>
      <td><?php echo smarty_function_calendar(array('id' => 'contfecnacis','name' => 'contacto__contfecnacis','form_name' => 'frmContacto','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contfecnacis'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contedadn'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contedadn','name' => 'contacto__contedadn','maxlength' => '3','readonly' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contedadn'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contsexos','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table_lang(array('id' => 'contsexos','name' => 'contacto__contsexos','table_name' => 'sexo','value' => 'sexocodigos','label' => 'sexonombres','is_null' => 'true','sqlid' => 'sexo'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contsexos'), $this);?>
</td>
   </tr>   
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contemail'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contemail','name' => 'contacto__contemail','maxlength' => '100','size' => '52'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contemail'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'locacodigos'), $this);?>
</td>
      <td> 
      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'contacto__locacodigos','onBlur' => "if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmContacto.contacto_locacodigos_desc);else document.frmContacto.contacto_locacodigos_desc.value='';"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:fncopenwindows('FeCuCmdTreeHelp',  'table=localizacion&sqlid=localizacion&return_obj=contacto__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmContacto.contacto__locacodigos.value+'&localizacion__locanombres='+document.frmContacto.contacto_locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'contacto_locacodigos_desc'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'locacodigos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contdirecios'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contdirecios','name' => 'contacto__contdirecios','maxlength' => '100','size' => '52'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contdirecios'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'conttelefons'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'conttelefons','name' => 'contacto__conttelefons','maxlength' => '13','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'conttelefons'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contnumcels'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'contnumcels','name' => 'contacto__contnumcels','maxlength' => '13','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contnumcels'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contobservs'), $this);?>
</td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'contobservs','name' => 'contacto__contobservs','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contobservs'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'contactivas'), $this);?>
</td>
      <td><?php echo smarty_function_select_estado(array('id' => 'contactivas','name' => 'contacto__contactivas','table' => 'contacto'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'contactivas'), $this);?>
</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCuCmdAddContacto','form_name' => 'frmContacto'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeCuCmdUpdateContacto','form_name' => 'frmContacto','loadFields' => "contacto__contindentis,contacto__contprinoms,contacto__contpriapes,contacto__contsexos",'confirm' => '8'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Borrar','id' => 'CmdDelete','name' => 'FeCuCmdDeleteContacto','form_name' => 'frmContacto','loadFields' => 'contacto__contindentis','confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCuCmdShowListContacto','form_name' => 'frmContacto'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Contacto','form_name' => 'frmContacto'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'contacto__contcodigon'), $this);?>

<?php echo smarty_function_hidden(array('id' => 'contacto__cliecodigos','name' => 'contacto__cliecodigos'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_putjsacceskey_pub(array(), $this);?>

<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>