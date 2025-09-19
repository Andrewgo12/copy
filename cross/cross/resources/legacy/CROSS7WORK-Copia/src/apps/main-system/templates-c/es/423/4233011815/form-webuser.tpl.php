<?php /* Smarty version 2.6.0, created on 2020-11-09 23:56:49
         compiled from Form_WebUser.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadlabels_pub', 'Form_WebUser.tpl', 2, false),array('function', 'printtitle_pub', 'Form_WebUser.tpl', 4, false),array('function', 'putstylepub', 'Form_WebUser.tpl', 5, false),array('function', 'help_context_pub', 'Form_WebUser.tpl', 17, false),array('function', 'printlabel_pub', 'Form_WebUser.tpl', 23, false),array('function', 'select_row_table_lang', 'Form_WebUser.tpl', 25, false),array('function', 'printcoment_pub', 'Form_WebUser.tpl', 32, false),array('function', 'select_son', 'Form_WebUser.tpl', 37, false),array('function', 'textfield', 'Form_WebUser.tpl', 71, false),array('function', 'href', 'Form_WebUser.tpl', 72, false),array('function', 'dataselectdojo', 'Form_WebUser.tpl', 99, false),array('function', 'btn_command', 'Form_WebUser.tpl', 127, false),array('function', 'btn_clean', 'Form_WebUser.tpl', 128, false),array('function', 'register_attachment_web', 'Form_WebUser.tpl', 133, false),array('function', 'hidden', 'Form_WebUser.tpl', 140, false),array('function', 'putjsacceskey_pub', 'Form_WebUser.tpl', 157, false),array('function', 'message_orden', 'Form_WebUser.tpl', 159, false),array('block', 'head', 'Form_WebUser.tpl', 3, false),array('block', 'body', 'Form_WebUser.tpl', 8, false),array('block', 'form', 'Form_WebUser.tpl', 10, false),array('block', 'textarea_ext', 'Form_WebUser.tpl', 65, false),array('block', 'div', 'Form_WebUser.tpl', 115, false),array('block', 'fieldset', 'Form_WebUser.tpl', 158, false),)), $this); ?>
<html>
<?php echo smarty_function_loadlabels_pub(array('table_name' => 'WebUser','controls' => "CmdAdd,CmdClean"), $this);?>

<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo smarty_function_printtitle_pub(array(), $this);?>
</title>
<?php echo smarty_function_putstylepub(array(), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsdrawDynamicColumns.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsDrawdiv.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsOrden.js" type="text/javascript"></script>
<script language="javascript" src="web/js/SelectControl.js" type="text/javascript"></script>' ?>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();drawDynamicColumns('dynamic_columns');",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmOrden','enctype' => "multipart/form-data",'method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="70%">
	<tr>
		<td class="piedefoto">
			<table border="0" align="center" width="100%">
				<tr><td class="piedefoto" colspan="3">
						<div align="justify">
							<?php echo smarty_function_help_context_pub(array(), $this);?>

  						</div>
					</td>
				</tr>
				<tr><th colspan="3"><div align="left"><?php echo smarty_function_printtitle_pub(array(), $this);?>
</div></th></tr>
   				<tr>
      				<td width='25%' class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'tiorcodigos','blBold' => 'true'), $this);?>
</td>
      				<td width='60%'>
      					<?php echo smarty_function_select_row_table_lang(array('id' => 'tiorcodigos','name' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden_web','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','param' => 'pto','onchange' => "if(this.value!='')LoadSelect_lang('tipoorden_evento','tiorcodigos',Array(this),this.form.ordenempresa__evencodigos,'evento_evencodigos_evennombres','ordenempresa__evencodigos,ordenempresa__causcodigos');
      					if(this.value!='')LoadDescTipoorden(this.value);
      					drawDynamicColumns('dynamic_columns');"), $this);?>
<b>*</b>
      					<br>
      					<div id="tiordescrips"></div>
      				</td>
  	  				<td class="piedefoto" width='15%'><?php echo smarty_function_printcoment_pub(array('name' => 'tiorcodigos'), $this);?>
</td>
   				</tr>
   				<tr>
   	  				<td class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'evencodigos','blBold' => 'true'), $this);?>
</td>
   	  				<td>
   	  					<?php echo smarty_function_select_son(array('name' => 'ordenempresa__evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden_evento','onchange' => "if(this.value)LoadSelect_lang('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,this.form.ordenempresa__tiorcodigos),this.form.ordenempresa__causcodigos,'causa_causcodigos_causnombres');
		     				drawDynamicColumns('dynamic_columns');"), $this);?>
<b>*</b>
   	  				</td>
  					<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'evencodigos'), $this);?>
</td>
   				</tr>
   				<tr>
      				<td class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'causcodigos'), $this);?>
</td>
      				<td>
      					<?php echo smarty_function_select_son(array('name' => 'ordenempresa__causcodigos','table_hijo' => 'causa','id_hijo' => 'causcodigos','label_hijo' => 'causnombres','foreign_name' => "",'select_papa' => "ordenempresa__tiorcodigos,ordenempresa__evencodigos",'sqlid' => 'tipoorden_evento_causa','onchange' => "drawDynamicColumns('dynamic_columns');"), $this);?>
 
      				</td>
  					<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'causcodigos'), $this);?>
</td>
   				</tr>
   				<tr>
      				<td class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'ordeobservs','blBold' => 'true'), $this);?>
</td>
      				<td><?php $_params = $this->_tag_stack[] = array('textarea_ext', array('id' => 'ordeobservs','name' => 'orden__ordeobservs','cols' => '100','rows' => '10')); smarty_block_textarea_ext($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea_ext($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><b>*</b></td>
  					<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'ordeobservs'), $this);?>
</td>
   				</tr>
				<tr>
					<td class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'locacodigos','blBold' => 'true'), $this);?>
</td>
					<td> 
						<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'ordenempresa__locacodigos','value' => "",'onBlur' => "if(this.value!='')autoReference('localizacion','locacodigos',Array(this),document.frmOrden.ordenempresa_locacodigos_desc);else document.frmOrden.ordenempresa_locacodigos_desc.value='';"), $this);?>

						<?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:fncopenwindows('FeCrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=ordenempresa__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmOrden.ordenempresa__locacodigos.value+'&locacodigos_desc='+document.frmOrden.ordenempresa_locacodigos_desc.value);"), $this);?>

						<?php echo smarty_function_textfield(array('name' => 'ordenempresa_locacodigos_desc','value' => ""), $this);?>
<B>*</B>
					</td>
					<td class="piedefoto"><?php echo ""; ?></td>
   				</tr>
   				<tr>
      				<td class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'ordesitiejes'), $this);?>
</td>
      				<td><?php echo smarty_function_textfield(array('id' => 'ordesitiejes','name' => 'orden__ordesitiejes','size' => '50','maxlength' => '100'), $this);?>
</td>
  					<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'ordesitiejes'), $this);?>
</td>
   				</tr>
   				<tr>
      				<td colspan="2">&nbsp;</td>
      				<td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'denunciante'), $this);?>
</td>
   				</tr>
     			<!-- Denunciante -->
    			<tr>
    				<td colspan="2">
   						<div id="denunciante"  style="visibility:visible;">
						<table border="0" align="center" width="100%">
							<tr>
								<th colspan="2"><strong><?php echo smarty_function_printlabel_pub(array('name' => 'denunciante_info'), $this);?>
</strong></th>
							</tr>
							<tr>
	      						<td class="tdlabels" align="left"><?php echo smarty_function_printlabel_pub(array('name' => 'contidentis','blBold' => 'true'), $this);?>
</td>
	      						<td>
	      							<?php echo smarty_function_dataselectdojo(array('htmlid' => 'contidentis','name' => 'ordenempresa__contidentis','sqlid' => 'contacto_ident','value' => 'contcodigon','label' => 'contindentis','forceautoreference' => 'true'), $this);?>
 
		    						<?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante','');"), $this);?>

	     						</td>
	   						</tr>
						</table>
						</div>
    				</td>
    				<td class="piedefoto"></td>
    			</tr>
    			<!-- Fin Denunciante -->
			</table>
		</td>
	</tr>
	<tr>
		<td class="piedefoto">
			<?php $_params = $this->_tag_stack[] = array('div', array('id' => 'dynamic_columns','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
				<table border="0" align="center" width="100%">
					<tr><td width='25%'>&nbsp;</td><td width='60%'>&nbsp;</td><td width='15%' class="piedefoto"></td></tr>
				</table>
   			<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
		</td>
	</tr>
	<tr>
		<td class="piedefoto">
			<table border="0" align="center" width="100%">
				<tr><td colspan="2">
						<div align="center">
		    				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCrCmdAddOrdenWeb','form_name' => 'frmOrden'), $this);?>

							<?php echo smarty_function_btn_clean(array('table_name' => 'WebUser','form_name' => 'frmOrden'), $this);?>

	   					</div>
					</td>
					<td width='15%' class="piedefoto"></td>
				</tr>
				<tr><td colspan="2" class="piedefoto"><?php echo smarty_function_register_attachment_web(array('form' => 'frmOrden'), $this);?>
</td>
					<td class="piedefoto"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeCrCmdDefaultWebUser'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'deleteattachment','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'consult'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenempresa__orgacodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenempresa__merecodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orden__ordefecregd'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenempresa__oremradicas'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenempresa__infrcodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'langcodigos'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'pto'), $this);?>


<?php echo smarty_function_hidden(array('name' => 'customer_type','id' => 'customer_type'), $this);?>

<script language="javascript">
	setDenunciante('<?php echo $_REQUEST['customer_type']; ?>');
	activeRadio('<?php echo $_REQUEST['customer_type']; ?>');
</script>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo smarty_function_putjsacceskey_pub(array(), $this);?>

<?php $_params = $this->_tag_stack[] = array('fieldset', array('legend' => 'Resultado')); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message_orden(array('id' => $this->_tpl_vars['cod_message'],'param' => $this->_tpl_vars['param'],'signal' => $this->_tpl_vars['signal'],'error_field' => $this->_tpl_vars['error_field'],'label_file' => 'fichaord'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>