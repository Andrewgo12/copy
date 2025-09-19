<?php /* Smarty version 2.6.0, created on 2020-09-26 18:00:14
         compiled from Form_Solicitante.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadlabels_pub', 'Form_Solicitante.tpl', 2, false),array('function', 'printtitle_pub', 'Form_Solicitante.tpl', 4, false),array('function', 'putstyle', 'Form_Solicitante.tpl', 5, false),array('function', 'help_context_pub', 'Form_Solicitante.tpl', 14, false),array('function', 'printlabel_pub', 'Form_Solicitante.tpl', 23, false),array('function', 'radio', 'Form_Solicitante.tpl', 24, false),array('function', 'btn_button', 'Form_Solicitante.tpl', 52, false),array('function', 'btn_clean', 'Form_Solicitante.tpl', 53, false),array('function', 'hidden', 'Form_Solicitante.tpl', 59, false),array('function', 'putjsacceskey_pub', 'Form_Solicitante.tpl', 64, false),array('function', 'message', 'Form_Solicitante.tpl', 66, false),array('block', 'head', 'Form_Solicitante.tpl', 3, false),array('block', 'body', 'Form_Solicitante.tpl', 9, false),array('block', 'form', 'Form_Solicitante.tpl', 11, false),array('block', 'fieldset', 'Form_Solicitante.tpl', 65, false),)), $this); ?>
<html>
<?php echo smarty_function_loadlabels_pub(array('table_name' => 'Solicitante','controls' => "CmdAdd,CmdClean"), $this);?>

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
<script language="javascript" src="web/js/jsSolicitante.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();jsDrawTypeSol('1');",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmSolicitante','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo smarty_function_help_context_pub(array(), $this);?>

  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo smarty_function_printtitle_pub(array(), $this);?>
</div></th></tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2"><?php echo smarty_function_printlabel_pub(array('name' => 'typepn','blBold' => 'true'), $this);?>

      	  <?php echo smarty_function_radio(array('id' => 'typesol1','name' => 'typesol','checked' => 'true','onClick' => "jsDrawTypeSol('1');"), $this);?>

      	  <?php echo smarty_function_printlabel_pub(array('name' => 'typepj','blBold' => 'true'), $this);?>

      	  <?php echo smarty_function_radio(array('id' => 'typesol2','name' => 'typesol','onClick' => "jsDrawTypeSol('2');"), $this);?>
  
      </td>
  	<td class="piedefoto">&nbsp;</td>
   </tr>
   <tr>
		<td colspan="2" class="piedefoto">
		<!-- tabla en donde iran los divs -->
		<table border="0" align="center" width="100%">
			<tr>
				<td>
					<div id="div_sol">
						&nbsp;
					<div>
				</td>
			</tr>
		</table>
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
				<?php echo smarty_function_btn_button(array('value' => 'Adicionar','id' => 'CmdAdd','name' => 'CmdAdd','onClick' => "jsAddSolicitante();"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Solicitante','form_name' => 'frmSolicitante'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('id' => 'contcodigon','name' => 'contacto__contcodigon'), $this);?>

<?php echo smarty_function_hidden(array('id' => 'cliecodigos','name' => 'cliente__cliecodigos'), $this);?>

<?php echo smarty_function_hidden(array('id' => 'signal','name' => 'signal'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo smarty_function_putjsacceskey_pub(array(), $this);?>

<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>