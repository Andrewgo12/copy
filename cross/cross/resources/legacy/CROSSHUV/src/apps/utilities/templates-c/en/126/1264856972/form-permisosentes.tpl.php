<?php /* Smarty version 2.6.0, created on 2020-12-02 16:16:10
         compiled from Form_PermisosEntes.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_PermisosEntes.tpl', 3, false),array('block', 'body', 'Form_PermisosEntes.tpl', 10, false),array('block', 'form', 'Form_PermisosEntes.tpl', 14, false),array('block', 'fieldset', 'Form_PermisosEntes.tpl', 67, false),array('function', 'putstyle', 'Form_PermisosEntes.tpl', 6, false),array('function', 'select_row_table_service', 'Form_PermisosEntes.tpl', 25, false),array('function', 'select_multiple', 'Form_PermisosEntes.tpl', 39, false),array('function', 'btn_command', 'Form_PermisosEntes.tpl', 51, false),array('function', 'btn_clean', 'Form_PermisosEntes.tpl', 53, false),array('function', 'hidden', 'Form_PermisosEntes.tpl', 59, false),array('function', 'message', 'Form_PermisosEntes.tpl', 68, false),)), $this); ?>
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
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/sort.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPermisosentes','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "&nbsp;" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo ""; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>schecodigon</B> " ?></td>
      <td><?php echo smarty_function_select_row_table_service(array('service' => 'Profiles','method' => 'getSessionSchema','table_name' => 'schema','name' => 'schecodigon','field' => 'schecodigon','label' => 'schenombres','id' => 'schecodigon','is_null' => false,'onchange' => "LoadSelect('userschema','schecodigon',Array(this),this.form.authusernams);selectnone(this.form.orgacodigos);"), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "schecodigon"; ?></td>
   </tr>
   
   <tr>
      <td><?php echo "<B>authusernams</B> " ?></td>
      <td><select name='authusernams' id='authusernams' onchange="LoadSelectEntes(this.form.schecodigon.value,'authusernams',Array(this),this.form.orgacodigos)"><option value="" selected>---</option></SELECT><B>*</B></td>
  	<td class="piedefoto"><?php echo "authusernams"; ?></td>
   </tr>
   
  <tr>
      <td><?php echo "<B>orgacodigos</B> " ?></td>
      <td><?php echo smarty_function_select_multiple(array('service' => 'Human_resources','table_name' => 'organizacion','field' => 'orgacodigos','label' => 'organombres','id' => 'orgacodigos','name' => 'orgacodigos'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo "orgacodigos"; ?></td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdatePermisosEntes','form_name' => 'frmPermisosentes','loadFields' => "schecodigon,authusernams,orgacodigos",'confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeGeCmdDeletePermisosEntes','form_name' => 'frmPermisosentes','loadFields' => "schecodigon,authusernams",'confirm' => '47'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'PermisosEntes','form_name' => 'frmPermisosentes'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'username'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<script>
LoadSelect('userschema','schecodigon',Array(document.frmPermisosentes.schecodigon),document.frmPermisosentes.authusernams);
</script>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'CmdUpdate\',\'U\',\'Update\');'."\n".'	jsAccessKey(\'CmdDelete\',\'D\',\'Delete\');'."\n".'	jsAccessKey(\'CmdClean\',\'C\',\'Clean\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>