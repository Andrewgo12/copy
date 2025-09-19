<?php /* Smarty version 2.6.0, created on 2020-10-15 12:57:45
         compiled from Form_TransferDependencies.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'putstyle', 'Form_TransferDependencies.tpl', 6, false),array('function', 'textfield', 'Form_TransferDependencies.tpl', 24, false),array('function', 'href', 'Form_TransferDependencies.tpl', 25, false),array('function', 'dependencies_list', 'Form_TransferDependencies.tpl', 37, false),array('function', 'btn_command', 'Form_TransferDependencies.tpl', 47, false),array('function', 'hidden', 'Form_TransferDependencies.tpl', 53, false),array('function', 'message', 'Form_TransferDependencies.tpl', 58, false),array('block', 'body', 'Form_TransferDependencies.tpl', 9, false),array('block', 'form', 'Form_TransferDependencies.tpl', 13, false),array('block', 'fieldset', 'Form_TransferDependencies.tpl', 57, false),)), $this); ?>
<html>
<head>
      <title><?php echo "Configuraci&oacute;n de dependencias para transferecia de trabajo"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list_new.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>
</head>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTransferdependencies','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Indica las dependencias a las cuales se les puede transferir trabajo.<B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Configuraci&oacute;n de dependencias para transferecia de trabajo"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
   	  <td><?php echo "<B><u>D</u>ependencia</B> " ?></td>
  	<td> 
      	<?php echo smarty_function_textfield(array('id' => 'orgacodigos','name' => 'orgacodigos','onBlur' => "if(this.value=='')document.frmTransferdependencies.organombres.value=''; else jsGetDescription('index.php','FeGeCmdGetValues','frmTransferdependencies','orgacodigos','organombres','&sbSqlId=organizacion&sbFunction=autoReference&rcParams[orgacodigos]='+this.value,'selTipoCampos','&sbFunction=selectedValues&rcParams[orgacodigos]='+this.value)"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeGeCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=orgacodigos&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.frmTransferdependencies.orgacodigos.value+'&orgacodigos_desc='+document.frmTransferdependencies.organombres.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'organombres','id' => 'organombres'), $this);?>
<B>*</B>
     </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
	<td colspan="2" class='piedefoto'><?php echo smarty_function_dependencies_list(array(), $this);?>
</td>
	<td class="piedefoto"></td>
	</tr>   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeGeCmdAddTransferdependencies','form_name' => 'frmTransferdependencies','onClick' => "extractselect(this.form.selTipoCampos,this.form.selected_opt,this.form,this.form.action,'FeGeCmdAddTransferdependencies');"), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'selected_opt','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>