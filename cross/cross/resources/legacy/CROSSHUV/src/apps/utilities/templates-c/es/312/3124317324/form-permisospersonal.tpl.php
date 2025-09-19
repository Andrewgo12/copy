<?php /* Smarty version 2.6.0, created on 2020-09-25 14:32:34
         compiled from Form_PermisosPersonal.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_PermisosPersonal.tpl', 3, false),array('block', 'body', 'Form_PermisosPersonal.tpl', 10, false),array('block', 'form', 'Form_PermisosPersonal.tpl', 14, false),array('block', 'fieldset', 'Form_PermisosPersonal.tpl', 85, false),array('function', 'putstyle', 'Form_PermisosPersonal.tpl', 6, false),array('function', 'select_row_table_service', 'Form_PermisosPersonal.tpl', 25, false),array('function', 'textfield', 'Form_PermisosPersonal.tpl', 40, false),array('function', 'select_row_table_service_personal', 'Form_PermisosPersonal.tpl', 57, false),array('function', 'btn_command', 'Form_PermisosPersonal.tpl', 69, false),array('function', 'btn_clean', 'Form_PermisosPersonal.tpl', 71, false),array('function', 'hidden', 'Form_PermisosPersonal.tpl', 77, false),array('function', 'message', 'Form_PermisosPersonal.tpl', 86, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Configuraci&oacute;n de permisos por agenda"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/sort.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmPermisospersonal','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Indica los permisos de un usuario del sistema para ver y modificar la agenda de los dem&aacute;s funcionarios.<br>Seleccione el contexto, luego seleccione el usuario, seleccione los funcionarios o personal sobre los cuales desea darle permisos y presione MODIFICAR. <br>Tambi&eacute;n puede seleccionar un usuario y presionar ELIMINAR para borrar sus permisos.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Configuraci&oacute;n de permisos por agenda"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B><u>C</u>ontexto</B> " ?></td>
      <td><?php echo smarty_function_select_row_table_service(array('service' => 'Profiles','method' => 'getSessionSchema','table_name' => 'schema','name' => 'schecodigon','field' => 'schecodigon','label' => 'schenombres','id' => 'schecodigon','is_null' => true,'onchange' => "LoadSelect('userschema','schecodigon',Array(this),this.form.authusernams);selectnone(this.form.perscodigos);"), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
  	
   <tr>
      <td><?php echo "<B><u>U</u>suario</B> " ?></td>
      <td><select name='authusernams' id='authusernams' onchange="LoadSelectPersonal(this.form.schecodigon.value,'authusernams',Array(this),this.form.perscodigos)"><option value="" selected>---</option></SELECT><B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <!--
   <tr>
      <td><?php echo "<B><u>U</u>suario</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'authusernamsdesc','name' => 'authusernamsdesc','size' => '10','onKeyUp' => "HideAndSeek(this.value,'authusernamslist','authusernams','frmPermisospersonal','__SEP1__','__SEP2__');"), $this);?>

      <?php echo smarty_function_select_row_table_service(array('service' => 'Profiles','method' => 'getAuth','table_name' => 'auth','name' => 'authusernams','field' => 'indice','label' => 'nombre','id' => 'authusernams','is_null' => true,'filter' => 'authusernamslist','sbSep1' => '__SEP1__','sbSep2' => '__SEP2__','onchange' => "LoadSelect('personal','perscodigos',Array(this),this.form.perscodigos);selectnone(this.form.perscodigos);"), $this);?>

      		<script>
      			var rcObject = document.frmPermisospersonal.authusernams.options;
      			var nuSizeObject = document.frmPermisospersonal.authusernams.options.length;
      			var sbLista = document.forms['frmPermisospersonal'].elements['authusernamslist'].value;
				var rcLista = sbLista.split('__SEP2__');
				var nuSize = rcLista.length;
      		</script>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   -->
   
  <tr>
      <td><?php echo "<B><u>F</u>uncionarios (personal)</B> " ?></td>
      <td><?php echo smarty_function_select_row_table_service_personal(array('multiple' => 1,'service' => 'Human_resources','method' => 'getActiveEmployee','table_name' => 'personal','name' => 'perscodigos','field' => 'indice','label' => 'nombre','id' => 'perscodigos','is_null' => true,'size' => '20'), $this);?>
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
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdatePermisosPersonal','form_name' => 'frmPermisospersonal','loadFields' => "schecodigon,authusernams,perscodigos",'confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeGeCmdDeletePermisosPersonal','form_name' => 'frmPermisospersonal','loadFields' => "schecodigon,authusernams",'confirm' => '47'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'PermisosPersonal','form_name' => 'frmPermisospersonal'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'username'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<script>
LoadSelect('userschema','schecodigon',Array(document.frmPermisospersonal.schecodigon),document.frmPermisospersonal.authusernams);
</script>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'schecodigon\',\'C\');'."\n".'	jsAccessKey(\'authusernams\',\'U\');'."\n".'	jsAccessKey(\'perscodigos\',\'F\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>