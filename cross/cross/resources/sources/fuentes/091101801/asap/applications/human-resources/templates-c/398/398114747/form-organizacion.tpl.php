<?php /* Smarty version 2.6.0, created on 2015-07-22 10:23:52
         compiled from Form_Organizacion.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Organizacion.tpl', 3, false),array('block', 'body', 'Form_Organizacion.tpl', 10, false),array('block', 'form', 'Form_Organizacion.tpl', 12, false),array('block', 'fieldset', 'Form_Organizacion.tpl', 100, false),array('function', 'putstyle', 'Form_Organizacion.tpl', 6, false),array('function', 'textfield', 'Form_Organizacion.tpl', 23, false),array('function', 'select_row_table', 'Form_Organizacion.tpl', 33, false),array('function', 'select_row_father', 'Form_Organizacion.tpl', 38, false),array('function', 'calendar', 'Form_Organizacion.tpl', 43, false),array('function', 'href', 'Form_Organizacion.tpl', 70, false),array('function', 'showPhisicalDep', 'Form_Organizacion.tpl', 82, false),array('function', 'btn_command', 'Form_Organizacion.tpl', 86, false),array('function', 'btn_clean', 'Form_Organizacion.tpl', 91, false),array('function', 'hidden', 'Form_Organizacion.tpl', 97, false),array('function', 'message', 'Form_Organizacion.tpl', 101, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo ""; ?></title>

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
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmOrganizacion','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "&nbsp;" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo ""; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>orgacodigos</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'orgacodigos','name' => 'organizacion__orgacodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "orgacodigos"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>organombres</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'organombres','name' => 'organizacion__organombres','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "organombres"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>tiorcodigos</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','sqlid' => 'tipoorgani','name' => 'organizacion__tiorcodigos','table_name' => 'tipoorgani','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "tiorcodigos"; ?></td>
   </tr>
   <tr>
      <td><?php echo "orgacgpads " ?></td>
      <td><?php echo smarty_function_select_row_father(array('father' => 'orgacgpads','sqlid' => 'organizacion','id' => 'orgacgpads','name' => 'organizacion__orgacgpads','table_name' => 'organizacion','value' => 'orgacodigos','label' => 'organombres','is_null' => 'true'), $this);?>
</td>
  	  <td class="piedefoto"><?php echo "orgacgpads"; ?></td>
   </tr>
   <tr>
      <td><?php echo "orgafechcred " ?></td>
      <td><?php echo smarty_function_calendar(array('id' => 'orgafechcred','name' => 'organizacion__orgafechcred','form_name' => 'frmOrganizacion'), $this);?>
</td>
  	<td class="piedefoto"><?php echo "orgafechcred"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>esorcodigos</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'esorcodigos','name' => 'organizacion__esorcodigos','sqlid' => 'estadoorgani','table_name' => 'estadoorgani','value' => 'esorcodigos','label' => 'esornombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "esorcodigos"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>grupcodigos</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'grupcodigos','name' => 'organizacion__grupcodigos','sqlid' => 'grupo','table_name' => 'grupo','value' => 'grupcodigos','label' => 'grupnombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "grupcodigos"; ?></td>
   </tr>
   <tr>
      <td><?php echo "orgatelefo1s " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'orgatelefo1s','name' => 'organizacion__orgatelefo1s','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo "orgatelefo1s"; ?></td>
   </tr>
   <tr>
      <td><?php echo "orgatelefo2s " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'orgatelefo2s','name' => 'organizacion__orgatelefo2s','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo "orgatelefo2s"; ?></td>
   </tr>
   <tr>
      <td><?php echo "locacodigos " ?></td>
      <td> 
      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'organizacion__locacodigos','onBlur' => "if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.organizacion_locacodigos_desc)"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeHrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=organizacion__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmOrganizacion.locacodigos.value+'&locacodigos_desc='+document.frmOrganizacion.organizacion_locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'organizacion_locacodigos_desc'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo "locacodigos"; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>

	<?php echo smarty_function_showPhisicalDep(array(), $this);?>

	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeHrCmdAddOrganizacion','form_name' => 'frmOrganizacion'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeHrCmdUpdateOrganizacion','form_name' => 'frmOrganizacion','loadFields' => "organizacion__orgacodigos,organizacion__organombres,organizacion__tiorcodigos,organizacion__esorcodigos,organizacion__grupcodigos",'confirm' => '14'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Mover','id' => 'CmdMove','name' => 'FeHrCmdShowOrgHasOpenCases','form_name' => 'frmOrganizacion'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeHrCmdDeleteOrganizacion','form_name' => 'frmOrganizacion','loadFields' => "organizacion__orgacodigos,organizacion__organombres,organizacion__tiorcodigos,organizacion__esorcodigos,organizacion__grupcodigos",'confirm' => '15'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeHrCmdShowListOrganizacion','form_name' => 'frmOrganizacion'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Organizacion','form_name' => 'frmOrganizacion'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'CmdAdd\',\'\',\'\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'\',\'\');'."\n".'	jsAccessKey(\'CmdDelete\',\'\',\'\');'."\n".'	jsAccessKey(\'CmdShow\',\'\',\'\');'."\n".'	jsAccessKey(\'CmdClean\',\'\',\'\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message'],'extra' => $this->_tpl_vars['extra'],'confirm' => 'FeHrCmdMoveDependency'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>