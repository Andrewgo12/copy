<?php /* Smarty version 2.6.0, created on 2014-07-15 15:22:36
         compiled from Form_Personal.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Personal.tpl', 3, false),array('block', 'body', 'Form_Personal.tpl', 10, false),array('block', 'form', 'Form_Personal.tpl', 12, false),array('block', 'fieldset', 'Form_Personal.tpl', 127, false),array('function', 'putstyle', 'Form_Personal.tpl', 6, false),array('function', 'textfield', 'Form_Personal.tpl', 23, false),array('function', 'select_user', 'Form_Personal.tpl', 48, false),array('function', 'select_row_table', 'Form_Personal.tpl', 53, false),array('function', 'href', 'Form_Personal.tpl', 75, false),array('function', 'select_estado', 'Form_Personal.tpl', 104, false),array('function', 'btn_command', 'Form_Personal.tpl', 114, false),array('function', 'btn_clean', 'Form_Personal.tpl', 118, false),array('function', 'hidden', 'Form_Personal.tpl', 124, false),array('function', 'message', 'Form_Personal.tpl', 128, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Personas"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPersonal','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;<b>NOTA: </b>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Personas"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'perscodigos','name' => 'personal__perscodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>I</u>dentificaci&oacute;n</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persidentifs','name' => 'personal__persidentifs','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre(s)</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persnombres','name' => 'personal__persnombres','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>rimer apellido " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persapell1s','name' => 'personal__persapell1s','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>S</u>egundo apellido " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persapell2s','name' => 'personal__persapell2s','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "N<u>o</u>mbre de usuario " ?></td>
      <td><?php echo smarty_function_select_user(array('id' => 'persusrnams','name' => 'personal__persusrnams','value' => 'persusrnams','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Ca<u>r</u>go</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'cargcodigos','name' => 'personal__cargcodigos','table_name' => 'cargo','value' => 'cargcodigos','label' => 'cargnombres','is_null' => 'true','sqlid' => 'cargo'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Pro<u>f</u>esi&oacute;n " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persprofecs','name' => 'personal__persprofecs','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>el&eacute;fono 1 " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'perstelefo1','name' => 'personal__perstelefo1','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Tel&eacute;fono <u>2</u> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'perstelefo2','name' => 'personal__perstelefo2','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Locali<u>z</u>aci&oacute;n " ?></td>
      <td> 
      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'personal__locacodigos','onBlur' => "if(this.value)autoReference('localizacion','locacodigos',Array(this),this.form.personal_locacodigos_desc)"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeHrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=personal__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmPersonal.locacodigos.value+'&locacodigos_desc='+document.frmPersonal.personal_locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'personal_locacodigos_desc'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>D</u>irecci&oacute;n " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persdireccis','name' => 'personal__persdireccis','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>C</u>orreo electr&oacute;nico " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'persemails','name' => 'personal__persemails','maxlength' => '150'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>C</u>ontacto " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'perscontacts','name' => 'personal__perscontacts','maxlength' => '100'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>el. Contacto " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'perstelcont','name' => 'personal__perstelcont','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>E</u>stado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'persestadoc','name' => 'personal__persestadoc','table' => 'personal'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeHrCmdAddPersonal','form_name' => 'frmPersonal'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeHrCmdUpdatePersonal','form_name' => 'frmPersonal','loadFields' => "personal__perscodigos,personal__persidentifs,personal__persnombres,personal__cargcodigos",'confirm' => '14'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeHrCmdDeletePersonal','form_name' => 'frmPersonal','loadFields' => "personal__perscodigos,personal__persidentifs,personal__persnombres,personal__cargcodigos",'confirm' => '15'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeHrCmdShowListPersonal','form_name' => 'frmPersonal'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Personal','form_name' => 'frmPersonal'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'perscodigos\',\'D\');'."\n".'	jsAccessKey(\'persidentifs\',\'I\');'."\n".'	jsAccessKey(\'persnombres\',\'N\');'."\n".'	jsAccessKey(\'persapell1s\',\'P\');'."\n".'	jsAccessKey(\'persapell2s\',\'S\');'."\n".'	jsAccessKey(\'persusrnams\',\'O\');'."\n".'	jsAccessKey(\'cargcodigos\',\'R\');'."\n".'	jsAccessKey(\'persprofecs\',\'F\');'."\n".'	jsAccessKey(\'perstelefo1\',\'T\');'."\n".'	jsAccessKey(\'perstelefo2\',\'2\');'."\n".'	jsAccessKey(\'locacodigos\',\'Z\');'."\n".'	jsAccessKey(\'persdireccis\',\'D\');'."\n".'	jsAccessKey(\'persemails\',\'C\');'."\n".'	jsAccessKey(\'perscontacts\',\'C\');'."\n".'	jsAccessKey(\'perstelcont\',\'T\');'."\n".'	jsAccessKey(\'persestadoc\',\'E\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>