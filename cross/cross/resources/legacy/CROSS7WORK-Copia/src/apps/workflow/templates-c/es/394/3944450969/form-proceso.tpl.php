<?php /* Smarty version 2.6.0, created on 2020-09-22 23:45:14
         compiled from Form_Proceso.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Proceso.tpl', 3, false),array('block', 'body', 'Form_Proceso.tpl', 10, false),array('block', 'form', 'Form_Proceso.tpl', 12, false),array('block', 'textarea', 'Form_Proceso.tpl', 38, false),array('block', 'fieldset', 'Form_Proceso.tpl', 140, false),array('function', 'putstyle', 'Form_Proceso.tpl', 6, false),array('function', 'textfield', 'Form_Proceso.tpl', 23, false),array('function', 'select_dataservices', 'Form_Proceso.tpl', 33, false),array('function', 'hidden', 'Form_Proceso.tpl', 43, false),array('function', 'select_row_table', 'Form_Proceso.tpl', 48, false),array('function', 'calendar', 'Form_Proceso.tpl', 58, false),array('function', 'proctiempon', 'Form_Proceso.tpl', 64, false),array('function', 'select_estado', 'Form_Proceso.tpl', 70, false),array('function', 'select_son', 'Form_Proceso.tpl', 93, false),array('function', 'btn_command', 'Form_Proceso.tpl', 120, false),array('function', 'btn_clean', 'Form_Proceso.tpl', 124, false),array('function', 'viewrutas', 'Form_Proceso.tpl', 135, false),array('function', 'message', 'Form_Proceso.tpl', 141, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Proceso"; ?></title>
      
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsManageRutas.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmProceso','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Los procesos son conjuntos de tareas que se realizan para solucionar un caso.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Proceso"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <!--<tr>
      <td><?php echo "C&oacute;<u>d</u>igo " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'proccodigos','name' => 'proceso__proccodigos','maxlength' => '30'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <tr>
      <td><?php echo "<B><u>N</u>ombre</B> " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'procnombres','name' => 'proceso__procnombres','maxlength' => '100'), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>De<u>p</u>endencia</B> " ?></td>
      <td><?php echo smarty_function_select_dataservices(array('id' => 'orgacodigos','name' => 'proceso__orgacodigos','value' => 'orgacodigos','label' => 'organombres','is_null' => 'true','service' => 'Human_resources','method' => 'getActiveEntesOrg'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "De<u>s</u>cripci&oacute;n " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'procdescris','name' => 'proceso__procdescris','cols' => '40','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <!--<tr>
      <td><?php echo "<u>R</u>esponsable " ?></td>
      <td><?php echo smarty_function_hidden(array('name' => 'proceso__perscodigos'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <!--<tr>
      <td><?php echo "Es<u>t</u>ado inicial " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'procestinis','name' => 'proceso__procestinis','table_name' => 'estadoproces','label' => 'esprnombres','value' => 'esprcodigos','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Estad<u>o</u> final " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'procestfins','name' => 'proceso__procestfins','table_name' => 'estadoproces','label' => 'esprnombres','value' => 'esprcodigos','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <!--<tr>
      <td><?php echo "<u>F</u>echa de creaci&oacute;n " ?></td>
      <td><?php echo smarty_function_calendar(array('id' => 'procfeccren','name' => 'proceso__procfeccren','form_name' => 'frmProceso'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   <tr>
      <td><?php echo "<B>D<u>u</u>raci&oacute;n</B> " ?></td>
      <td>
          <?php echo smarty_function_proctiempon(array(), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "D:H"; ?><b>*</b></td>
   </tr>
   <tr>
      <td><?php echo "<u>E</u>stado " ?></td>
      <td><?php echo smarty_function_select_estado(array('id' => 'procactivas','name' => 'proceso__procactivas','table' => 'proceso'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	
	<tr>
		<th colspan="3"><div align='left'><?php echo "Configuraci&oacute;n del proceso " ?></div></th>
	</tr>
 
   <tr>
      <td><?php echo "<B>T<u>i</u>po de Caso</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','name' => 'tiorcodigos','sqlid' => 'tipoorden','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','onchange' => "if(this.value)LoadSelect('tipoorden_evento','tiorcodigos',Array(this),this.form.evencodigos,'evencodigos,causcodigos');"), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>C</u>lasificaci&oacute;n " ?></td>
   	  	<td>
   	  	<?php echo smarty_function_select_son(array('name' => 'evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'tiorcodigos','sqlid' => 'tipoorden_evento','onchange' => "if(this.value)LoadSelect('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,this.form.tiorcodigos),this.form.causcodigos);"), $this);?>

   	  	</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr> 
   <tr>
      <td><?php echo "Su<u>b</u>clasificaci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_select_son(array('name' => 'causcodigos','table_hijo' => 'causa','id_hijo' => 'causcodigos','label_hijo' => 'causnombres','foreign_name' => "",'select_papa' => "tiorcodigos,evencodigos",'sqlid' => 'tipoorden_evento_causa'), $this);?>
  
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeWFCmdAddProceso','form_name' => 'frmProceso'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeWFCmdUpdateProceso','form_name' => 'frmProceso','loadFields' => "proceso__procnombres,proceso__orgacodigos",'confirm' => '9'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeWFCmdDeleteProceso','form_name' => 'frmProceso','loadFields' => "proceso__procnombres,proceso__orgacodigos",'confirm' => '10'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeWFCmdShowListProceso','form_name' => 'frmProceso'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Proceso','form_name' => 'frmProceso'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'proceso__proccodigos'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<table border="0" align="center" width="80%">
	<tr>
		<td colspan="3" class="piedefoto"><?php echo smarty_function_viewrutas(array(), $this);?>
</td>
	</tr>
</table>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'proccodigos\',\'D\');'."\n".'	jsAccessKey(\'procnombres\',\'N\');'."\n".'	jsAccessKey(\'procdescris\',\'S\');'."\n".'	jsAccessKey(\'perscodigos\',\'R\');'."\n".'	jsAccessKey(\'procestinis\',\'T\');'."\n".'	jsAccessKey(\'procestfins\',\'O\');'."\n".'	jsAccessKey(\'procfeccren\',\'F\');'."\n".'	jsAccessKey(\'orgacodigos\',\'P\');'."\n".'	jsAccessKey(\'proctiempon\',\'U\');'."\n".'	jsAccessKey(\'procactivas\',\'E\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'I\');'."\n".'	jsAccessKey(\'evencodigos\',\'C\');'."\n".'	jsAccessKey(\'causcodigos\',\'B\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo '
		<script>
			if(document.frmNewRuta)
				document.frmNewRuta.tarecodigos.focus();
		</script>
'; ?>

</html>