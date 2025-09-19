<?php /* Smarty version 2.6.0, created on 2020-10-02 18:19:59
         compiled from Form_Cliente.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadlabels_pub', 'Form_Cliente.tpl', 2, false),array('function', 'printtitle_pub', 'Form_Cliente.tpl', 4, false),array('function', 'putstyle', 'Form_Cliente.tpl', 5, false),array('function', 'help_context_pub', 'Form_Cliente.tpl', 14, false),array('function', 'printlabel_pub', 'Form_Cliente.tpl', 21, false),array('function', 'textfield', 'Form_Cliente.tpl', 22, false),array('function', 'printcoment_pub', 'Form_Cliente.tpl', 23, false),array('function', 'select_row_table_lang', 'Form_Cliente.tpl', 32, false),array('function', 'href', 'Form_Cliente.tpl', 79, false),array('function', 'select_estado', 'Form_Cliente.tpl', 119, false),array('function', 'btn_command', 'Form_Cliente.tpl', 129, false),array('function', 'btn_clean', 'Form_Cliente.tpl', 133, false),array('function', 'hidden', 'Form_Cliente.tpl', 139, false),array('function', 'putjsacceskey_pub', 'Form_Cliente.tpl', 142, false),array('function', 'message', 'Form_Cliente.tpl', 144, false),array('block', 'head', 'Form_Cliente.tpl', 3, false),array('block', 'body', 'Form_Cliente.tpl', 9, false),array('block', 'form', 'Form_Cliente.tpl', 11, false),array('block', 'fieldset', 'Form_Cliente.tpl', 143, false),)), $this); ?>
<html>
<?php echo smarty_function_loadlabels_pub(array('table_name' => 'Cliente','controls' => "CmdAdd,CmdUpdate,CmdDelete,CmdShow,CmdClean"), $this);?>

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
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmCliente','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo smarty_function_help_context_pub(array(), $this);?>

  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo smarty_function_printtitle_pub(array(), $this);?>
</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <!-- <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'cliecodigos','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'cliecodigos','name' => 'cliente__cliecodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'cliecodigos'), $this);?>
</td>
   </tr>-->
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clieidentifs','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clieidentifs','name' => 'cliente__clieidentifs','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clieidentifs'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'tiidcodigos','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table_lang(array('id' => 'tiidcodigos','name' => 'cliente__tiidcodigos','table_name' => 'tipoidentifi','value' => 'tiidcodigos','label' => 'tiidnombres','is_null' => 'true','sqlid' => 'tipoidentifi'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'tiidcodigos'), $this);?>
</td>
   </tr>   
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'ticlcodigos','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table_lang(array('id' => 'ticlcodigos','name' => 'cliente__ticlcodigos','table_name' => 'tipocliente','value' => 'ticlcodigos','label' => 'ticlnombres','is_null' => 'true','sqlid' => 'tipocliente'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'ticlcodigos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clienombres','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clienombres','name' => 'cliente__clienombres','size' => '50','maxlength' => '150'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clienombres'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clierepprnos'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clierepprnos','name' => 'cliente__clierepprnos','maxlength' => '20','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clierepprnos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clierepsenos'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clierepsenos','name' => 'cliente__clierepsenos','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clierepsenos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'cliereppraps'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'cliereppraps','name' => 'cliente__cliereppraps','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'cliereppraps'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clierepseaps'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clierepseaps','name' => 'cliente__clierepseaps','maxlength' => '30','typeData' => 'string'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clierepseaps'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clielocalizs','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clielocalizs','name' => 'cliente__clielocalizs','size' => '50','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clielocalizs'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clietelefons','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clietelefons','name' => 'cliente__clietelefons','maxlength' => '13','typeData' => 'int'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clietelefons'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'locacodigos','blBold' => true), $this);?>
</td>
      <td> 
      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'cliente__locacodigos','onBlur' => "if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmCliente.cliente_locacodigos_desc);else document.frmCliente.cliente_locacodigos_desc.value='';"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:fncopenwindows('FeCuCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=cliente__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmCliente.locacodigos.value+'&localizacion__locanombres='+document.frmCliente.cliente_locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'cliente_locacodigos_desc'), $this);?>
<B>*</B>
     </td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'locacodigos'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'cliepagwebs'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'cliepagwebs','name' => 'cliente__cliepagwebs','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'cliepagwebs'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'cliemails'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'cliemails','name' => 'cliente__cliemails','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'cliemails'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'esclcodigos','blBold' => true), $this);?>
</td>
      <td><?php echo smarty_function_select_row_table_lang(array('id' => 'esclcodigos','name' => 'cliente__esclcodigos','table_name' => 'estadoclient','value' => 'esclcodigos','label' => 'esclnombres','is_null' => 'true','sqlid' => 'estadoclient'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'esclcodigos'), $this);?>
</td>
   </tr>

   <!--<tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'grclcodigos'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'grclcodigos','name' => 'cliente__grclcodigos','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'grclcodigos'), $this);?>
</td>
   </tr>-->
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clienumfaxs'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clienumfaxs','name' => 'cliente__clienumfaxs','maxlength' => '13','typeData' => 'int'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clienumfaxs'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clieaparaers'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'clieaparaers','name' => 'cliente__clieaparaers','maxlength' => '200'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clieaparaers'), $this);?>
</td>
   </tr>
   <tr>
      <td><?php echo smarty_function_printlabel_pub(array('name' => 'clieactivas'), $this);?>
</td>
      <td><?php echo smarty_function_select_estado(array('id' => 'clieactivas','name' => 'cliente__clieactivas','table' => 'cliente'), $this);?>
</td>
  	<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'clieactivas'), $this);?>
</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCuCmdAddCliente','form_name' => 'frmCliente'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeCuCmdUpdateCliente','form_name' => 'frmCliente','loadFields' => "cliente__cliecodigos,cliente__clieidentifs,cliente__locacodigos,cliente__esclcodigos,cliente__ticlcodigos,cliente__clienombres,cliente__tiidcodigos,cliente__clielocalizs,cliente__clietelefons",'confirm' => '8'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeCuCmdDeleteCliente','form_name' => 'frmCliente','loadFields' => 'cliente__cliecodigos','confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCuCmdShowListCliente','form_name' => 'frmCliente'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Cliente','form_name' => 'frmCliente'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('id' => 'cliecodigos','name' => 'cliente__cliecodigos'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_putjsacceskey_pub(array(), $this);?>

<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>