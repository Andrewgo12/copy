<?php /* Smarty version 2.6.0, created on 2020-11-18 13:48:56
         compiled from Form_FichaOrdenWeb.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadlabels_pub', 'Form_FichaOrdenWeb.tpl', 2, false),array('function', 'printtitle_pub', 'Form_FichaOrdenWeb.tpl', 4, false),array('function', 'putstylepub', 'Form_FichaOrdenWeb.tpl', 5, false),array('function', 'help_context_pub', 'Form_FichaOrdenWeb.tpl', 13, false),array('function', 'printlabel_pub', 'Form_FichaOrdenWeb.tpl', 18, false),array('function', 'textfield', 'Form_FichaOrdenWeb.tpl', 19, false),array('function', 'printcoment_pub', 'Form_FichaOrdenWeb.tpl', 20, false),array('function', 'btn_button', 'Form_FichaOrdenWeb.tpl', 29, false),array('function', 'btn_viewinnova', 'Form_FichaOrdenWeb.tpl', 31, false),array('function', 'hidden', 'Form_FichaOrdenWeb.tpl', 37, false),array('function', 'putjsacceskey_pub', 'Form_FichaOrdenWeb.tpl', 39, false),array('function', 'message', 'Form_FichaOrdenWeb.tpl', 41, false),array('block', 'head', 'Form_FichaOrdenWeb.tpl', 3, false),array('block', 'body', 'Form_FichaOrdenWeb.tpl', 9, false),array('block', 'form', 'Form_FichaOrdenWeb.tpl', 11, false),array('block', 'fieldset', 'Form_FichaOrdenWeb.tpl', 40, false),)), $this); ?>
<html>
<?php echo smarty_function_loadlabels_pub(array('table_name' => 'FichaOrd','controls' => "CmdShow,CmdShowInnova"), $this);?>

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
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmFichaOrd','enctype' => "multipart/form-data",'method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
	<tr><td colspan="3" class="piedefoto" align="center"><?php echo smarty_function_help_context_pub(array(), $this);?>
</td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left"><?php echo smarty_function_printtitle_pub(array(), $this);?>
</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr>
      <td class="tdlabels"><?php echo smarty_function_printlabel_pub(array('name' => 'ordenumeros','blBold' => 'true'), $this);?>
</td>
      <td><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'orden__ordenumeros','is_null' => 'true'), $this);?>
<B>*</B></td>
      <td class="piedefoto"><?php echo smarty_function_printcoment_pub(array('name' => 'ordenumeros'), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_button(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdDefaultFichaOrdWeb','form_name' => 'frmFichaOrd','onClick' => "if(!this.form.orden__ordenumeros.value)location='index.php?action=FeCrCmdDefaultFichaOrd&cod_message=0'; if(this.form.orden__ordenumeros.value)fncopenwindows('FeCrCmdDefaultFichas','topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrdWeb&ordenumerosFO='+this.form.orden__ordenumeros.value+'&vars=ordenumerosFO');if(this.form.orden__ordenumeros.value)this.form.action.value='FeCrCmdDefaultFichaOrdWeb';"), $this);?>
				
				<?php echo smarty_function_btn_viewinnova(array('type' => 'button','value' => 'Consultar','id' => 'CmdShowInnova','name' => 'FeCrCmdDefaultDocsInnova','form_name' => 'frmFichaOrd'), $this);?>
				
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeCrCmdDefaultFichaOrdWeb'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'langcodigos'), $this);?>

<?php echo smarty_function_putjsacceskey_pub(array(), $this);?>

<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>