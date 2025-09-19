<?php /* Smarty version 2.6.0, created on 2020-09-22 20:01:47
         compiled from Form_Permisions.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Permisions.tpl', 3, false),array('block', 'body', 'Form_Permisions.tpl', 9, false),array('block', 'form', 'Form_Permisions.tpl', 11, false),array('block', 'fieldset', 'Form_Permisions.tpl', 69, false),array('function', 'putstyle', 'Form_Permisions.tpl', 5, false),array('function', 'select_father', 'Form_Permisions.tpl', 22, false),array('function', 'select_son', 'Form_Permisions.tpl', 43, false),array('function', 'listas_cargadas', 'Form_Permisions.tpl', 57, false),array('function', 'btn_selList', 'Form_Permisions.tpl', 61, false),array('function', 'hidden', 'Form_Permisions.tpl', 65, false),array('function', 'message', 'Form_Permisions.tpl', 70, false),)), $this); ?>
<html> 
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Permisions</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPermisions','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
  <table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Los permisos son la cantidad de acciones que puede ejecutar un perfil<br><b>NOTA: </b>Recuerde que los campos con asterisco (*) son obligatorios.<br>Al seleccionar o deseleccionar permisos, presione ACEPTAR para guardar los cambios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Permisos"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
      <td><?php echo "<B><u>C</u>ontexto</B> " ?></td>
      <td><?php echo smarty_function_select_father(array('name' => 'schecodigon','table_papa' => 'schecodigon','id_papa' => 'schecodigon','label_papa' => 'schenombres','sqlid' => 'schema','command_default' => 'FePrCmdDefaultPermisions'), $this);?>
<B>*</B>
     </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
          <tr>
		      <td><?php echo "<B>Ap<u>l</u>icaci&oacute;n</B> " ?></td>
		      <td colspan="2"><?php echo smarty_function_select_father(array('name' => 'applcodigos','table_papa' => 'applications','id_papa' => 'applcodigos','label_papa' => 'applnombres','sqlid' => 'applications','command_default' => 'FePrCmdDefaultPermisions'), $this);?>
<B>*</B>
		      </td>
          </tr>
          <tr>
		      <td><?php echo "<B><u>P</u>erfil</B> " ?></td>
		      <td colspan="2"><?php echo smarty_function_select_son(array('name' => 'profcodigos','table_hijo' => 'profiles','id_hijo' => 'profcodigos','label_hijo' => 'profnombres','select_papa' => 'applcodigos','sqlid' => 'profiles','command_default' => 'FePrCmdDefaultPermisions'), $this);?>
<B>*</B>      
		      </td>
          </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3" class='piedefoto'><?php echo smarty_function_listas_cargadas(array('table_name' => 'permisions'), $this);?>
</td>
    </tr>
    <tr> 
      <td colspan="3" ><div align="center">
      <?php echo smarty_function_btn_selList(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FePrCmdAddPermisions','form_name' => 'frmPermisions','onClick' => "extractselect(this.form.selTipoCampos,this.form.selected_opt,this.form,this.form.action,'FePrCmdAddPermisions')"), $this);?>
 
        </div></td>
    </tr>
  </table>
<?php echo smarty_function_hidden(array('name' => 'selected_opt','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'profcodigos\',\'P\');'."\n".'	jsAccessKey(\'schecodigon\',\'C\');'."\n".'	jsAccessKey(\'applcodigos\',\'L\');'."\n".'	jsAccessKey(\'commnombres\',\'O\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array('legend' => 'Resultado')); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>