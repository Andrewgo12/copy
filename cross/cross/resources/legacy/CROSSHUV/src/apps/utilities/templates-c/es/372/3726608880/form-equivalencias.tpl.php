<?php /* Smarty version 2.6.0, created on 2020-09-25 14:38:39
         compiled from Form_Equivalencias.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Equivalencias.tpl', 3, false),array('block', 'body', 'Form_Equivalencias.tpl', 10, false),array('block', 'form', 'Form_Equivalencias.tpl', 12, false),array('block', 'div', 'Form_Equivalencias.tpl', 33, false),array('block', 'fieldset', 'Form_Equivalencias.tpl', 111, false),array('function', 'putstyle', 'Form_Equivalencias.tpl', 6, false),array('function', 'textfield', 'Form_Equivalencias.tpl', 23, false),array('function', 'select_state', 'Form_Equivalencias.tpl', 28, false),array('function', 'printvalue', 'Form_Equivalencias.tpl', 33, false),array('function', 'hidden', 'Form_Equivalencias.tpl', 33, false),array('function', 'select_entes_esp', 'Form_Equivalencias.tpl', 50, false),array('function', 'select_estado', 'Form_Equivalencias.tpl', 87, false),array('function', 'btn_command', 'Form_Equivalencias.tpl', 98, false),array('function', 'btn_delete', 'Form_Equivalencias.tpl', 100, false),array('function', 'btn_clean', 'Form_Equivalencias.tpl', 102, false),array('function', 'message', 'Form_Equivalencias.tpl', 112, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Equivalencias CROSS/DOCUNET"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsEquiv.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEquivalencias','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La administraci&oacute;n de equivalencias permite crear o inactivar equivalencias entre los datos de CROSS y DOCUNET. Tambi&eacute;n permite eliminar siempre y cuando la equivalencia no se haya utilizado en ning&uacute;n caso de CROSS hacia DOCUNET.<BR>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Equivalencias CROSS/DOCUNET"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "C&oacute;<u>d</u>igo " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equicodigon','name' => 'equivalencias__equicodigon','maxlength' => '5'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>N</u>ombre de la tabla en CROSS</B> " ?></td>
      <td><?php echo smarty_function_select_state(array('id' => 'equitablcros','name' => 'equivalencias__equitablcros','option' => '8','is_null' => 'true','onchange' => "jsLoadField(1);"), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>N<u>o</u>mbre del campo en CROSS</B> " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_equicampcros','align' => 'left','style' => "visibility:visible;")); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  echo smarty_function_printvalue(array('label' => 'equivalencias__equicampcros','blBold' => false,'blFont' => true), $this); $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_hidden(array('id' => 'equicampcros','name' => 'equivalencias__equicampcros'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Valo<u>r</u> num&eacute;rico en CROSS</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equivalcros','name' => 'equivalencias__equivalcros','maxlength' => '15'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Valor en CRO<u>s</u>S</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equinomcros','name' => 'equivalencias__equinomcros','maxlength' => '250'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
    <tr>
   	  <td><?php echo "<B>&Aacute;<u>r</u>ea en CROSS</B> " ?></td>
      <td>
        <?php echo smarty_function_select_entes_esp(array('id' => 'equiareacros','name' => 'equivalencias__equiareacros','form' => 'frmEquivalencias','is_null' => true), $this);?>
<b>*</b>
      </td>  
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Nom<u>b</u>re de la tabla en DOCUNET</B> " ?></td>
      <td><?php echo smarty_function_select_state(array('id' => 'equitabldocs','name' => 'equivalencias__equitabldocs','option' => '9','is_null' => 'true','onchange' => "jsLoadField(2);"), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Nombre del cam<u>p</u>o en DOCUNET</B> " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_equicampdocs','align' => 'left','style' => "visibility:visible;")); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  echo smarty_function_printvalue(array('label' => 'equivalencias__equicampdocs','blBold' => false,'blFont' => true), $this); $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_hidden(array('id' => 'equicampdocs','name' => 'equivalencias__equicampdocs'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Valor c&oacute;d<u>i</u>go en DOCUNET</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equivaldocs','name' => 'equivalencias__equivaldocs','maxlength' => '5'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Valor en DOC<u>u</u>NET</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equinomdocs','name' => 'equivalencias__equinomdocs','maxlength' => '250'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
      <td><?php echo "<B>&Aacute;<u>r</u>ea en DOCUNET</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equiareadocs','name' => 'equivalencias__equiareadocs','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>V<u>a</u>lor serie real en DOCUNET</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'equiseridocs','name' => 'equivalencias__equiseridocs','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Es<u>t</u>ado de la equivalencia</B> " ?></td>
      <td><?php echo smarty_function_select_estado(array('table' => 'equivalencias','id' => 'equiestados','name' => 'equivalencias__equiestados','option' => '2','is_null' => 'true'), $this);?>
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
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeGeCmdAddEquivalencias','form_name' => 'frmEquivalencias'), $this);?>

		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeGeCmdUpdateEquivalencias','form_name' => 'frmEquivalencias'), $this);?>

				<?php echo smarty_function_btn_delete(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','table' => 'equivalencias','name' => 'FeGeCmdDeleteEquivalencias','form_name' => 'frmEquivalencias'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeGeCmdShowListEquivalencias','form_name' => 'frmEquivalencias'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Equivalencias','form_name' => 'frmEquivalencias'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'equicodigon\',\'D\');'."\n".'	jsAccessKey(\'equitablcros\',\'N\');'."\n".'	jsAccessKey(\'equicampcros\',\'O\');'."\n".'	jsAccessKey(\'equivalcros\',\'R\');'."\n".'	jsAccessKey(\'equinomcros\',\'S\');'."\n".'	jsAccessKey(\'equitabldocs\',\'B\');'."\n".'	jsAccessKey(\'equicampdocs\',\'P\');'."\n".'	jsAccessKey(\'equivaldocs\',\'I\');'."\n".'	jsAccessKey(\'equinomdocs\',\'U\');'."\n".'	jsAccessKey(\'equifechacrn\',\'F\');'."\n".'	jsAccessKey(\'equiestados\',\'T\');'."\n".'	jsAccessKey(\'equiareacros\',\'R\');'."\n".'	jsAccessKey(\'equiareadocs\',\'R\');'."\n".'	jsAccessKey(\'equiseridocs\',\'A\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>