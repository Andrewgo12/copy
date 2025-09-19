<?php /* Smarty version 2.6.0, created on 2020-12-02 16:15:20
         compiled from Form_Auth.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Auth.tpl', 3, false),array('block', 'body', 'Form_Auth.tpl', 10, false),array('block', 'form', 'Form_Auth.tpl', 12, false),array('block', 'fieldset', 'Form_Auth.tpl', 133, false),array('function', 'putstyle', 'Form_Auth.tpl', 6, false),array('function', 'printtext', 'Form_Auth.tpl', 27, false),array('function', 'set_application', 'Form_Auth.tpl', 52, false),array('function', 'select_son', 'Form_Auth.tpl', 53, false),array('function', 'select_dataservices', 'Form_Auth.tpl', 65, false),array('function', 'btn_command', 'Form_Auth.tpl', 75, false),array('function', 'btn_clean', 'Form_Auth.tpl', 76, false),array('function', 'textfield', 'Form_Auth.tpl', 94, false),array('function', 'btn_clean_pass', 'Form_Auth.tpl', 115, false),array('function', 'hidden', 'Form_Auth.tpl', 125, false),array('function', 'message', 'Form_Auth.tpl', 134, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Users"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmAuth','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Password must have at least 4 characters, and can only be composed of the following characters [A-Z][a-z][0-9] dot (.) and score (-).<br><b>NOTE: </b>Remember fields marked with an asterisk (*) are mandatory.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Users"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
		<td colspan="2"><?php echo "User Basic Information"; ?></td>
		<td class="piedefoto"></td>
	</tr>
   <tr>
      <td><?php echo "Username " ?></td>
      <td><?php echo smarty_function_printtext(array('name' => 'auth__authusernams'), $this);?>
</td>
  	<td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "First Name " ?></td>
      <td><?php echo smarty_function_printtext(array('name' => 'auth__authrealname'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Last Name 1 " ?></td>
      <td><?php echo smarty_function_printtext(array('name' => 'auth__authrealape1'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Last Name 2 " ?></td>
      <td><?php echo smarty_function_printtext(array('name' => 'auth__authrealape2'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Email " ?></td>
      <td><?php echo smarty_function_printtext(array('name' => 'auth__authemail'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>S</u>tyle</B> " ?></td>
      <td><?php echo smarty_function_set_application(array('name' => 'auth__applcodigos'), $this);?>

      	  <?php echo smarty_function_select_son(array('name' => 'auth__stylcodigos','table_hijo' => 'style','id_hijo' => 'stylcodigos','label_hijo' => 'stylnombres','select_papa' => 'auth__applcodigos','sqlid' => 'style'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>La<u>n</u>guage</B> " ?></td>
      <td>
      <?php echo smarty_function_select_dataservices(array('id' => 'langcodigos','service' => 'Profiles','method' => 'getAllLanguage','name' => 'auth__langcodigos','value' => 'langcodigos','label' => 'langnombres','is_null' => 'true'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdateAuth','form_name' => 'frmAuth','loadFields' => "auth__stylcodigos,auth__langcodigos",'confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Auth','form_name' => 'frmAuth'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td class="piedefoto" colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo "Update Password"; ?></td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td><?php echo "<B>Lo<u>g</u>in Current Password</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authuserpassold','name' => 'auth__authuserpass_old','maxlength' => '100','type' => 'password'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>L<u>o</u>gin New Password</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authuserpass','name' => 'auth__authuserpass','maxlength' => '100','type' => 'password'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"></td>
   </tr>
      <tr>
      <td><?php echo "<B>Con<u>f</u>irm New Password</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authuserpass','name' => 'auth__authuserpass_confirm','maxlength' => '100','type' => 'password'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdatepass','name' => 'FeGeCmdUpdatePassAuth','form_name' => 'frmAuth','loadFields' => "auth__authuserpass_old,auth__authuserpass,auth__authuserpass_confirm",'confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_clean_pass(array('table_name' => 'Auth','form_name' => 'frmAuth'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>
 
<?php echo smarty_function_hidden(array('name' => 'auth__authusernams'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'auth__authrealname'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'auth__authrealape1'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'auth__authrealape2'), $this);?>
 
<?php echo smarty_function_hidden(array('name' => 'auth__authemail'), $this);?>
 
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'authuserpass\',\'O\');'."\n".'	jsAccessKey(\'applcodigos\',\'A\');'."\n".'	jsAccessKey(\'stylcodigos\',\'S\');'."\n".'	jsAccessKey(\'langcodigos\',\'N\');'."\n".'	jsAccessKey(\'authuserpassold\',\'G\');'."\n".'	jsAccessKey(\'authuserpassconfirm\',\'F\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'U\',\'Update\');'."\n".'	jsAccessKey(\'CmdClean\',\'C\',\'Clean\');'."\n".'	jsAccessKey(\'CmdUpdatepass\',\'P\',\'uPdate\');'."\n".'	jsAccessKey(\'CmdCleanpass\',\'L\',\'cLean\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>