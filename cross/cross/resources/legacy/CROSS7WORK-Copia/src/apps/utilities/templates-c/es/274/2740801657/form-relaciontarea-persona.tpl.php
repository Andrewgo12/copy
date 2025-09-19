<?php /* Smarty version 2.6.0, created on 2020-10-15 12:58:01
         compiled from Form_RelacionTarea_Persona.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_RelacionTarea_Persona.tpl', 3, false),array('block', 'body', 'Form_RelacionTarea_Persona.tpl', 9, false),array('block', 'form', 'Form_RelacionTarea_Persona.tpl', 10, false),array('block', 'div', 'Form_RelacionTarea_Persona.tpl', 63, false),array('block', 'fieldset', 'Form_RelacionTarea_Persona.tpl', 74, false),array('function', 'putstyle', 'Form_RelacionTarea_Persona.tpl', 5, false),array('function', 'select_row_table_service', 'Form_RelacionTarea_Persona.tpl', 26, false),array('function', 'select_entes_esp', 'Form_RelacionTarea_Persona.tpl', 37, false),array('function', 'href', 'Form_RelacionTarea_Persona.tpl', 38, false),array('function', 'btn_button', 'Form_RelacionTarea_Persona.tpl', 51, false),array('function', 'btn_clean', 'Form_RelacionTarea_Persona.tpl', 53, false),array('function', 'hidden', 'Form_RelacionTarea_Persona.tpl', 71, false),array('function', 'message', 'Form_RelacionTarea_Persona.tpl', 75, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Personal por tarea"; ?></title>
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
<script language="javascript" src="web/js/relacionTP.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmTareaPersona','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="4"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La interfaz de personal por tarea permite relacionar las personas que ser&aacute;n consideradas para ser asignadas a ejecutar una tarea en un proceso determinado. Esta configuraci&oacute;n es usada por el componente de asignaci&oacute;n por carga.
				   <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="4"><div align="left"><?php echo "Personal por tarea"; ?></div></th></tr>
	<tr><th colspan="4"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>P</u>roceso</B> " ?></td>
      <td colspan="2"><?php echo smarty_function_select_row_table_service(array('id' => 'proccodigos','name' => 'relatarepers__proccodigos','table_name' => 'proceso','value' => 'proccodigos','label' => 'procnombres','is_null' => 'true','service' => 'Workflow','onchange' => "jsLoadTarea();"), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>T</u>area</B> " ?></td>
      <td colspan="2"><select id="tarecodigos" name="relatarepers__tarecodigos" onchange="jsDrawRelacion();"><option value="">---</option></select><B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
  	</tr>
  	<tr>
   	  <td><?php echo "<B><u>D</u>ependencia</B> " ?></td>
      <td colspan="2">
        <?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'relatarepers__orgacodigos','form' => 'frmTareaPersona','is_null' => true), $this);?>
<B>*</B>
        <?php echo smarty_function_href(array('label' => "<img src='web/images/positivo_002.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:jsAddEnte();"), $this);?>

      </td> 
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="3">
			<div align="center">
				<?php echo smarty_function_btn_button(array('value' => 'Aceptar','id' => 'CmdAccept','name' => 'FeGeCmdSaveRelacion','onClick' => "jsSaveRelacion();"), $this);?>

				<?php echo smarty_function_btn_button(array('value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeGeCmdDeleteRelacion','onClick' => "jsDeleteRelacion();"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'RelacionTarea_Persona','form_name' => 'frmTareaPersona'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="3"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_configuracion','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'proccodigos\',\'P\');'."\n".'	jsAccessKey(\'tarecodigos\',\'T\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'title1\',\'R\');'."\n".'	jsAccessKey(\'title2\',\'N\');'."\n".'	jsAccessKey(\'organombres\',\'S\');'."\n".'	jsAccessKey(\'accion\',\'C\');'."\n".'	jsAccessKey(\'pregunta\',\'I\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'	jsAccessKey(\'CmdAccept\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>