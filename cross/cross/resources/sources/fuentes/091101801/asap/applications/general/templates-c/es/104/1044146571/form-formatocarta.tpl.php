<?php /* Smarty version 2.6.0, created on 2014-07-16 16:52:12
         compiled from Form_Formatocarta.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Formatocarta.tpl', 3, false),array('block', 'body', 'Form_Formatocarta.tpl', 25, false),array('block', 'form', 'Form_Formatocarta.tpl', 27, false),array('block', 'fieldset', 'Form_Formatocarta.tpl', 100, false),array('function', 'putstyle', 'Form_Formatocarta.tpl', 22, false),array('function', 'textfield', 'Form_Formatocarta.tpl', 38, false),array('function', 'select_estado', 'Form_Formatocarta.tpl', 48, false),array('function', 'select_tags', 'Form_Formatocarta.tpl', 62, false),array('function', 'text_editor', 'Form_Formatocarta.tpl', 69, false),array('function', 'btn_dojo', 'Form_Formatocarta.tpl', 85, false),array('function', 'btn_command', 'Form_Formatocarta.tpl', 87, false),array('function', 'hidden', 'Form_Formatocarta.tpl', 95, false),array('function', 'max_length', 'Form_Formatocarta.tpl', 97, false),array('function', 'message', 'Form_Formatocarta.tpl', 101, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Formatos de carta"; ?></title>
<?php echo '
<script type="text/javascript">
		var djConfig = {
			isDebug: true,
			dojoRichTextFrameUrl: "../../../src/widget/templates/richtextframe.html" //for xdomain
		};
	</script>
'; ?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccionesNCC.js" type="text/javascript"></script>
<script language="javascript" src="web/js/../../../../lib/dojo/dojo.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<script language="JavaScript" type="text/javascript">
	dojo.require("dojo.event.*");
	dojo.require("dojo.widget.Editor2");
    dojo.require("dojo.io.*");
	dojo.hostenv.writeIncludes();
</script>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>


<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onLoad' => "setEditorContent();")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmFormatocarta','method' => 'post','dojoType' => 'Form','id' => 'frmFormatocarta')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Aqui se crean las diferentes plantillas que pueden utilizar las comunicaciones.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Formatos de carta"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B>C&oacute;<u>d</u>igo</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'focacodigos','name' => 'formatocarta__focacodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'focanombres','name' => 'formatocarta__focanombres','maxlength' => '100','size' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "E<u>s</u>tado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'focaestados','name' => 'formatocarta__focaestados','table' => 'formatocarta'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td colspan="2"><?php echo "<B><u>P</u>lantilla</B> " ?><B>*</B></td>
  	  <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2" class="editor">
		<div class="editor">
		<table>
			<tr>
			<td>
			<div> 
				<?php echo smarty_function_select_tags(array('id' => 'tags','name' => 'formatocartaf__tags','onchange' => "jsPutTagCT()",'option' => '4','is_null' => 'true','id_tag' => 'COMMUNICATION_TAGS','widgetId' => 'editdiv','dojoObject' => 'true'), $this);?>
      
			</div>
			</td>
			</tr>
			<tr>
			<td>
			<div>
				<?php echo smarty_function_text_editor(array('border' => 'true','id' => 'focaplantils','name' => 'formatocarta__focaplantils','widgetId' => 'editdiv','toolbarTemplatePath' => "../../applications/general/web/templates/Form_EditorToolbarCross.tpl"), $this);?>

			</div>
			</td>
			</tr>
		</table>	
		</div>
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
				<?php echo smarty_function_btn_dojo(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeGeCmdAddFormatocarta','connect' => 'actionFormatoCarta','signal' => 'onclick'), $this);?>

				<?php echo smarty_function_btn_dojo(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdateFormatocarta','connect' => 'actionFormatoCarta','signal' => 'onclick','confirm' => '46'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeGeCmdDeleteFormatocarta','form_name' => 'frmFormatocarta','confirm' => '47'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','onClick' => "this.form.focaplantils.value=dojo.widget.manager.getWidgetById('editdiv');",'name' => 'FeGeCmdShowListFormatocarta','form_name' => 'frmFormatocarta'), $this);?>

				<?php echo smarty_function_btn_dojo(array('type' => 'button','value' => 'Limpiar','id' => 'CmdClean','name' => 'FeGeCmdDefaultFormatocarta','connect' => 'jsclearForm','signal' => 'onclick'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'focaplantils','value' => ""), $this);?>

<?php echo smarty_function_max_length(array(), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'focacodigos\',\'D\');'."\n".'	jsAccessKey(\'focanombres\',\'N\');'."\n".'	jsAccessKey(\'focaplantils\',\'P\');'."\n".'	jsAccessKey(\'focaestados\',\'S\');'."\n".'	jsAccessKey(\'tags\',\'T\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>