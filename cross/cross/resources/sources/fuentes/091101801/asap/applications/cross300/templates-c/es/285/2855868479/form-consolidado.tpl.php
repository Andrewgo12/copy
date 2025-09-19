<?php /* Smarty version 2.6.0, created on 2016-08-26 13:43:19
         compiled from Form_Consolidado.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Consolidado.tpl', 3, false),array('block', 'body', 'Form_Consolidado.tpl', 10, false),array('block', 'form', 'Form_Consolidado.tpl', 12, false),array('block', 'fieldset', 'Form_Consolidado.tpl', 84, false),array('function', 'putstyle', 'Form_Consolidado.tpl', 6, false),array('function', 'calendar', 'Form_Consolidado.tpl', 23, false),array('function', 'select_entes_esp', 'Form_Consolidado.tpl', 52, false),array('function', 'btn_button', 'Form_Consolidado.tpl', 62, false),array('function', 'hidden', 'Form_Consolidado.tpl', 81, false),array('function', 'message', 'Form_Consolidado.tpl', 85, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Consolidado"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmConsolidado','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;El Consolidado informa de la gesti&oacute;n que a la fecha se le ha realizado a los Casos.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Consolidado"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B><u>F</u>echa registro inicial</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecingdini','name' => 'orden__ordefecingdini','is_null' => 'true','form_name' => 'frmConsolidado'), $this);?>

      <b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>F<u>e</u>cha registro final</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecingdfin','name' => 'orden__ordefecingdfin','is_null' => 'true','form_name' => 'frmConsolidado'), $this);?>

      <b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>

   <tr>
      <td><?php echo "Fec<u>h</u>a-hora digitaci&oacute;n inicial " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecdiginin','name' => 'orden__ordefecdiginin','is_null' => 'true','hour' => 'true','form_name' => 'frmConsolidado'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "Fech<u>a</u>-hora digitaci&oacute;n final " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecdigfinn','name' => 'orden__ordefecdigfinn','is_null' => 'true','hour' => 'true','form_name' => 'frmConsolidado'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>

   <tr>
      <td><?php echo "<u>D</u>ependencia " ?></td>
	  <td><?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'organizacion__orgacodigos','form' => 'frmConsolidado'), $this);?>
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
				<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'consultar','onClick' => "if(valDatos())fncopenwindows('FeCrCmdDefaultRepConsolidado','ordefecingdini='+this.form.orden__ordefecingdini.value+'&ordefecingdfin='+this.form.orden__ordefecingdfin.value+'&orgacodigos='+this.form.organizacion__orgacodigos.value+'&ordefecdiginin='+this.form.orden__ordefecdiginin.value+'&ordefecdigfinn='+this.form.orden__ordefecdigfinn.value);"), $this);?>

		</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo '
<script language=\'javascript\'>
    function valDatos(){
        if(!document.frmConsolidado.orden__ordefecingdini.value || 
            !document.frmConsolidado.orden__ordefecingdfin.value){
            location=\'index.php?action=FeCrCmdDefaultConsolidado&cod_message=0\';
            return false
        }
        return true;
    }
</script>
'; ?>

<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'periodo\',\'P\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'ordefecingdini\',\'F\');'."\n".'	jsAccessKey(\'ordefecingdfin\',\'E\');'."\n".'	jsAccessKey(\'ordefecdiginin\',\'H\');'."\n".'	jsAccessKey(\'ordefecdigfinn\',\'A\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>