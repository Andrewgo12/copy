<?php /* Smarty version 2.6.0, created on 2020-10-10 09:08:06
         compiled from Form_ListadoOrden.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_ListadoOrden.tpl', 3, false),array('block', 'body', 'Form_ListadoOrden.tpl', 9, false),array('block', 'form', 'Form_ListadoOrden.tpl', 11, false),array('block', 'fieldset', 'Form_ListadoOrden.tpl', 214, false),array('function', 'putstyle', 'Form_ListadoOrden.tpl', 5, false),array('function', 'checkbox', 'Form_ListadoOrden.tpl', 22, false),array('function', 'select_dataservices', 'Form_ListadoOrden.tpl', 23, false),array('function', 'calendar', 'Form_ListadoOrden.tpl', 30, false),array('function', 'dataselectdojo', 'Form_ListadoOrden.tpl', 66, false),array('function', 'select_row_table', 'Form_ListadoOrden.tpl', 74, false),array('function', 'select_son', 'Form_ListadoOrden.tpl', 81, false),array('function', 'select_entes_esp', 'Form_ListadoOrden.tpl', 109, false),array('function', 'textfield', 'Form_ListadoOrden.tpl', 125, false),array('function', 'href', 'Form_ListadoOrden.tpl', 126, false),array('function', 'select_estadostareaSinActa', 'Form_ListadoOrden.tpl', 144, false),array('function', 'btn_command', 'Form_ListadoOrden.tpl', 190, false),array('function', 'btn_clean', 'Form_ListadoOrden.tpl', 192, false),array('function', 'listadoorden', 'Form_ListadoOrden.tpl', 202, false),array('function', 'hidden', 'Form_ListadoOrden.tpl', 206, false),array('function', 'message', 'Form_ListadoOrden.tpl', 215, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Listado de Casos"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsdrawDynamicColumns.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsDrawdiv.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/SelectControl.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmListadoOrden','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;El listado de Casos toma los datos digitados para hacer la consulta.
				  <br>Active la caja de verificaci&oacute;n anterior a cada campo para incluir el campo en el resultado de la consulta.
				  (Sino selecciona ning&uacute;n campo, el sistema los muestra todos)
				  <br>Active la caja de verificaci&oacute;n posterior a la dependencia para consultar todas las dependencias asociadas.
				  <br>Para Consultar el vencimiento con la cantidad de d&iacute;as debe tambien consultar con la fecha de registro.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Listado de Casos"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td width='25%'><?php echo "<u>U</u>suario de registro " ?></td>
      <td width='60%'>
      <?php echo smarty_function_checkbox(array('name' => 'check1','value' => 'orden__usuacodigos'), $this);?>

      <?php echo smarty_function_select_dataservices(array('id' => 'usuacodigos','name' => 'orden__usuacodigos','service' => 'Human_resources','method' => 'getAllActiveAuthPersonal','table_name' => 'personal','value' => 'persusrnams','label' => 'persusrnams','is_null' => 'true'), $this);?>
</td>
  	<td width='15%' class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "In<u>g</u>reso " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check2','value' => 'orden__ordefecingd'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecingd1','name' => 'orden__ordefecingd1','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecingd2','name' => 'orden__ordefecingd2','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>R</u>egistro " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check3','checked' => true,'value' => 'orden__ordefecregd'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecregd1','name' => 'orden__ordefecregd1','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecregd2','name' => 'orden__ordefecregd2','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "V<u>e</u>ncimiento " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check4','checked' => true,'value' => 'orden__ordefecvend'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecvend1','name' => 'orden__ordefecvend1','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecvend2','name' => 'orden__ordefecvend2','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>F</u>inalizaci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check5','checked' => true,'value' => 'orden__ordefecfinad'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecfinad1','name' => 'orden__ordefecfinad1','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      <?php echo smarty_function_calendar(array('id' => 'ordefecfinad2','name' => 'orden__ordefecfinad2','is_null' => 'true','form_name' => 'frmListadoOrden'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "Solicitante/recla<u>m</u>ante " ?></td>
      <td>
      	<?php echo smarty_function_checkbox(array('name' => 'check6','checked' => true,'value' => 'view_solicitante__contcodigon'), $this);?>

      	<?php echo smarty_function_dataselectdojo(array('htmlid' => 'view_solicitante__contcodigon','name' => 'view_solicitante__contcodigon','sqlid' => 'contacto_ref_c','value' => 'contcodigon','label' => 'contnombre','forceautoreference' => 'true'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>ipo de Caso " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check7','checked' => true,'value' => 'ordenempresa__tiorcodigos'), $this);?>

      <?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','name' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','command_default' => 'FeCrCmdDefaultListadoOrden'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>C</u>lasificaci&oacute;n " ?></td>
   	  <td>
   	  	<?php echo smarty_function_checkbox(array('name' => 'check8','value' => 'ordenempresa__evencodigos'), $this);?>

		<?php echo smarty_function_select_son(array('name' => 'ordenempresa__evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden_evento','command_default' => 'FeCrCmdDefaultListadoOrden'), $this);?>

  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Su<u>b</u>clasificaci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check9','value' => 'ordenempresa__causcodigos'), $this);?>

		<?php echo smarty_function_select_son(array('name' => 'ordenempresa__causcodigos','table_hijo' => 'causa','id_hijo' => 'causcodigos','label_hijo' => 'causnombres','foreign_name' => "",'select_papa' => "ordenempresa__tiorcodigos,ordenempresa__evencodigos",'sqlid' => 'tipoorden_evento_causa'), $this);?>
     
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>D</u>ependencia " ?></td>
      <td>
      	<?php echo smarty_function_checkbox(array('name' => 'check10','checked' => true,'value' => 'acta__orgacodigos'), $this);?>

          <?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'acta__orgacodigos','form' => 'frmListadoOrden'), $this);?>

          <?php echo smarty_function_checkbox(array('name' => 'children','value' => 'OK'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>M</u>edio recepci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check11','value' => 'ordenempresa__merecodigos'), $this);?>

      <?php echo smarty_function_select_row_table(array('id' => 'merecodigos','name' => 'ordenempresa__merecodigos','sqlid' => 'mediorecepcion','table_name' => 'mediorecepcion','value' => 'merecodigos','label' => 'merenombres','is_null' => 'true'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "Locali<u>z</u>aci&oacute;n " ?></td>
   	  <td>
   	  	<?php echo smarty_function_checkbox(array('name' => 'check12','value' => 'ordenempresa__locacodigos'), $this);?>

      	<?php echo smarty_function_textfield(array('id' => 'locacodigos','name' => 'ordenempresa__locacodigos','onBlur' => "if(this.value=='')document.frmListadoOrden.ordenempresa_locacodigos_desc.value=''; else autoReference('localizacion','locacodigos',Array(this),document.frmListadoOrden.ordenempresa_locacodigos_desc);"), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeCrCmdTreeHelp','table=localizacion&sqlid=localizacion&return_obj=ordenempresa__locacodigos&return_key=locacodigos&father=locacodpadrs&son=locacodigos&label=locanombres&param=geografia&value='+document.frmListadoOrden.locacodigos.value+'&locacodigos_desc='+document.frmListadoOrden.ordenempresa_locacodigos_desc.value);"), $this);?>

        <?php echo smarty_function_textfield(array('name' => 'ordenempresa_locacodigos_desc'), $this);?>
      
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>T</u>area " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check13','checked' => true,'value' => 'acta__tarecodigos'), $this);?>

      <?php echo smarty_function_select_dataservices(array('name' => 'acta__tarecodigos','is_null' => 'true','value' => 'tarecodigos','label' => 'tarenombres','id' => 'tarecodigos','service' => 'Workflow','method' => 'getAllTarea'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>E</u>stado de tarea " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check14','checked' => true,'value' => 'acta__actaestacts'), $this);?>

      <?php echo smarty_function_select_estadostareaSinActa(array('name' => 'acta__actaestacts','is_null' => 'true','value' => 'esaccodigos','label' => 'esacnombres','id' => 'actaestacts'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>rioridad " ?></td>
      <td>
      <?php echo smarty_function_checkbox(array('name' => 'check16','value' => 'ordenempresa__priocodigos'), $this);?>

      <?php echo smarty_function_select_row_table(array('id' => 'priocodigos','name' => 'ordenempresa__priocodigos','sqlid' => 'prioridad','table_name' => 'prioridad','value' => 'priocodigos','label' => 'prionombres','is_null' => 'true','command' => 'FeCrCmdDefaultListadoOrden'), $this);?>
</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>C</u>liente " ?></td>
      <td>
      	<?php echo smarty_function_checkbox(array('name' => 'check19','value' => 'view_solicitante__cliecodigos'), $this);?>

      	<?php echo smarty_function_dataselectdojo(array('htmlid' => 'cliecodigos','name' => 'view_solicitante__cliecodigos','sqlid' => 'cliente_ref','value' => 'cliecodigos','label' => 'clienombres','forceautoreference' => 'true'), $this);?>

     </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>O</u>bservaciones " ?></td>
      <?php echo '
      <td><input type=\'checkbox\' name=\'ordeobservs\' checked=true></td>
      '; ?>

  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Excluir tarea de control <u>y</u> cierre " ?></td>
      <?php echo '
      <td><input type=\'checkbox\' name=\'tareacc\' value=1></td>
      '; ?>

  	<td class="piedefoto"><?php echo "Active esta caja de chequeo para excluir la tarea  de control de cierre de la b&uacute;squeda."; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>S</u>eleccionar/Deseleccionar todos " ?></td>
      <?php echo '
      <td><input type=\'checkbox\' name=\'all\' onClick="with(document.frmListadoOrden){for(var i=0;i<elements.length;i++){if(elements[i].disabled==false){if(elements[i].type == \'checkbox\'){if(this.checked == true)elements[i].checked = true;else elements[i].checked = false;}}}}"></td>
      '; ?>

  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','onClick' => "consult__flag.value = 1;total.value = '';",'id' => 'CmdShow','name' => 'FeCrCmdDefaultListadoOrden','form_name' => 'frmListadoOrden'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Imprimir','onClick' => "consult__flag.value = 2;",'id' => 'CmdPrint','name' => 'FeCrCmdDefaultListadoOrden','form_name' => 'frmListadoOrden'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'ListadoOrden','form_name' => 'frmListadoOrden'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2" class="piedefoto">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2" class="piedefoto"><?php echo smarty_function_listadoorden(array(), $this);?>
</td>
		<td class="piedefoto">&nbsp;</td>
	</tr>
</table><br><br>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'consult__flag','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'total','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orden__ordenumeros','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'orderby','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'page','value' => '1'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'N\');'."\n".'	jsAccessKey(\'proccodigos\',\'P\');'."\n".'	jsAccessKey(\'ordesitiejes\',\'D\');'."\n".'	jsAccessKey(\'usuacodigos\',\'U\');'."\n".'	jsAccessKey(\'ordeobservs\',\'O\');'."\n".'	jsAccessKey(\'ordefecingd\',\'G\');'."\n".'	jsAccessKey(\'ordefecregd\',\'R\');'."\n".'	jsAccessKey(\'ordefecvend\',\'E\');'."\n".'	jsAccessKey(\'ordefecfinad\',\'F\');'."\n".'	jsAccessKey(\'ordefecentn\',\'T\');'."\n".'	jsAccessKey(\'infrcodigos\',\'S\');'."\n".'	jsAccessKey(\'infrnombres\',\'A\');'."\n".'	jsAccessKey(\'contidentis\',\'M\');'."\n".'	jsAccessKey(\'contnombre\',\'S\');'."\n".'	jsAccessKey(\'priocodigos\',\'P\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'tiornombres\',\'T\');'."\n".'	jsAccessKey(\'evencodigos\',\'C\');'."\n".'	jsAccessKey(\'causcodigos\',\'B\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'merecodigos\',\'M\');'."\n".'	jsAccessKey(\'locacodigos\',\'Z\');'."\n".'	jsAccessKey(\'oremanexos\',\'X\');'."\n".'	jsAccessKey(\'oremradicas\',\'R\');'."\n".'	jsAccessKey(\'ordenamiento\',\'O\');'."\n".'	jsAccessKey(\'action\',\'A\');'."\n".'	jsAccessKey(\'actaestacts\',\'E\');'."\n".'	jsAccessKey(\'esacnombres\',\'E\');'."\n".'	jsAccessKey(\'seltodos\',\'S\');'."\n".'	jsAccessKey(\'tarecodigos\',\'T\');'."\n".'	jsAccessKey(\'tarenombres\',\'T\');'."\n".'	jsAccessKey(\'clieidentifs\',\'C\');'."\n".'	jsAccessKey(\'cliecodigos\',\'C\');'."\n".'	jsAccessKey(\'ticlcodigos\',\'T\');'."\n".'	jsAccessKey(\'tareacc\',\'Y\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdPrint\',\'I\',\'Imprimir\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>