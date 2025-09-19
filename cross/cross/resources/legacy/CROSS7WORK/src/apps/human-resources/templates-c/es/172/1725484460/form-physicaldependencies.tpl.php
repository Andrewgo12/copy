<?php /* Smarty version 2.6.0, created on 2020-10-15 14:36:37
         compiled from Form_PhysicalDependencies.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_PhysicalDependencies.tpl', 3, false),array('block', 'body', 'Form_PhysicalDependencies.tpl', 10, false),array('block', 'form', 'Form_PhysicalDependencies.tpl', 14, false),array('block', 'fieldset', 'Form_PhysicalDependencies.tpl', 58, false),array('function', 'putstyle', 'Form_PhysicalDependencies.tpl', 6, false),array('function', 'textfield', 'Form_PhysicalDependencies.tpl', 25, false),array('function', 'href', 'Form_PhysicalDependencies.tpl', 26, false),array('function', 'dependencies_list', 'Form_PhysicalDependencies.tpl', 38, false),array('function', 'btn_command', 'Form_PhysicalDependencies.tpl', 48, false),array('function', 'hidden', 'Form_PhysicalDependencies.tpl', 54, false),array('function', 'message', 'Form_PhysicalDependencies.tpl', 59, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Configuraci&oacute;n de dependencias f&iacute;sicas"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPhysicaldependencies','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Indica que dependencias conforman una dependencia f&iacute;sica.<B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Configuraci&oacute;n de dependencias f&iacute;sicas"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
   	  <td><?php echo "<B><u>D</u>ependencia</B> " ?></td>
  	<td> 
      	<?php echo smarty_function_textfield(array('id' => 'orgacodigos','name' => 'orgacodigos','onBlur' => "if(this.value=='')document.frmPhysicaldependencies.organombres.value=''; else jsGetDescription('index.php','FeHrCmdGetValues','frmPhysicaldependencies','orgacodigos','organombres','&sbSqlId=organizacion&sbFunction=autoReference&rcParams[orgacodigos]='+this.value,'selTipoCampos','&sbFunction=selectedValues&rcParams[orgacodigos]='+this.value)"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeHrCmdTreeHelp','table=organizacion&sqlid=organizacion&return_obj=orgacodigos&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&value='+document.frmPhysicaldependencies.orgacodigos.value+'&orgacodigos_desc='+document.frmPhysicaldependencies.organombres.value);"), $this);?>

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
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeHrCmdAddPhysicaldependencies','form_name' => 'frmPhysicaldependencies','onClick' => "extractselect(this.form.selTipoCampos,this.form.selected_opt,this.form,this.form.action,'FeHrCmdAddPhysicaldependencies');"), $this);?>

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