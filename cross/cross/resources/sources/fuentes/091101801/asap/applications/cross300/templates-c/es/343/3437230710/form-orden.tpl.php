<?php /* Smarty version 2.6.0, created on 2016-08-26 07:14:26
         compiled from Form_Orden.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Orden.tpl', 3, false),array('block', 'body', 'Form_Orden.tpl', 9, false),array('block', 'form', 'Form_Orden.tpl', 11, false),array('block', 'textarea_ext', 'Form_Orden.tpl', 80, false),array('block', 'div', 'Form_Orden.tpl', 200, false),array('block', 'fieldset', 'Form_Orden.tpl', 239, false),array('function', 'putstyle', 'Form_Orden.tpl', 5, false),array('function', 'textfield_ordenumeros', 'Form_Orden.tpl', 23, false),array('function', 'select_row_table', 'Form_Orden.tpl', 29, false),array('function', 'select_son', 'Form_Orden.tpl', 42, false),array('function', 'date_set_proc', 'Form_Orden.tpl', 70, false),array('function', 'select_row_mediorecepcion', 'Form_Orden.tpl', 75, false),array('function', 'select_entes_esp', 'Form_Orden.tpl', 86, false),array('function', 'textfield', 'Form_Orden.tpl', 98, false),array('function', 'href', 'Form_Orden.tpl', 99, false),array('function', 'dataselectdojo', 'Form_Orden.tpl', 135, false),array('function', 'btn_button', 'Form_Orden.tpl', 212, false),array('function', 'btn_command', 'Form_Orden.tpl', 213, false),array('function', 'btn_clean', 'Form_Orden.tpl', 215, false),array('function', 'register_attachment', 'Form_Orden.tpl', 219, false),array('function', 'hidden', 'Form_Orden.tpl', 224, false),array('function', 'message_orden', 'Form_Orden.tpl', 240, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Orden</title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
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
<script language="javascript" src="web/js/jsOrden.js" type="text/javascript"></script>
<script language="javascript" src="web/js/SelectControl.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();drawDynamicColumns('dynamic_columns');",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmOrden','enctype' => "multipart/form-data",'method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La pantalla de casos permite crear o modificar casos, la dependencia es necesaria para la modificaci&oacute;n del caso.<br>La modificaci&oacute;n de un caso no permite cambiarle datos al tipo de caso, clasificaci&oacute;n, la dependencia o la fecha de registro y no se permite para casos finalizados.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
<tr>
	<td class="piedefoto">
		<table border="0" align="center" width="100%">
	<tr><th colspan="3"><div align="left"><?php echo "Casos"; ?></div></th></tr>
   <tr>
      <td width='25%'><?php echo "<u>N</u>&uacute;mero " ?></td>
      <td width='60%'><?php echo smarty_function_textfield_ordenumeros(array('id' => 'ordenumeros','name' => 'orden__ordenumeros','maxlength' => '30'), $this);?>
</td>
  	<td class="piedefoto" width='15%'><?php echo "Ingrese s&oacute;lo para consulta."; ?></td>
   </tr>

   <tr>
      <td><?php echo "<B>Tip<u>o</u> de Caso</B> " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','name' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','onchange' => "if(this.value!='')LoadSelect('tipoorden_evento','tiorcodigos',Array(this),document.frmOrden.ordenempresa__evencodigos,'ordenempresa__evencodigos,ordenempresa__causcodigos'); 
      if(this.value!='')LoadDescTipoorden(this.value);
      drawDynamicColumns('dynamic_columns');"), $this);?>
<b>*</b>
      <br>
      <div id="tiordescrips"></div>
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<B>Cla<u>s</u>ificaci&oacute;n</B> " ?></td>
   	  	<td>
   	  	<?php echo smarty_function_select_son(array('name' => 'ordenempresa__evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'ordenempresa__tiorcodigos','sqlid' => 'tipoorden_evento','onchange' => "if(this.value)LoadSelect('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,document.frmOrden.ordenempresa__tiorcodigos),document.frmOrden.ordenempresa__causcodigos,'ordenempresa__causcodigos');
		     drawDynamicColumns('dynamic_columns');"), $this);?>
<b>*</b>
   	  	</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Su<u>b</u>Clasificaci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_select_son(array('name' => 'ordenempresa__causcodigos','table_hijo' => 'causa','id_hijo' => 'causcodigos','label_hijo' => 'causnombres','foreign_name' => "",'select_papa' => "ordenempresa__tiorcodigos,ordenempresa__evencodigos",'sqlid' => 'tipoorden_evento_causa','onchange' => "drawDynamicColumns('dynamic_columns');"), $this);?>
  
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>R<u>e</u>gistro</B> " ?></td>
      <td><?php echo smarty_function_date_set_proc(array('name' => 'orden__ordefecregd','id' => 'ordefecregd','form_name' => 'frmOrden'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD hh:mm:ss"; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<B><u>M</u>edio de recepci&oacute;n</B> " ?></td>
   	  <td><?php echo smarty_function_select_row_mediorecepcion(array('id' => 'merecodigos','name' => 'ordenempresa__merecodigos','value' => 'merecodigos','label' => 'merenombres','is_null' => 'true'), $this);?>
<b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B><u>D</u>escripci&oacute;n</B> " ?></td>
      <td><?php $_params = $this->_tag_stack[] = array('textarea_ext', array('id' => 'ordeobservs','name' => 'orden__ordeobservs','cols' => '100','rows' => '10')); smarty_block_textarea_ext($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea_ext($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><b>*</b></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>D</u>ependencia " ?></td>
      <td>
        <?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'ordenempresa__orgacodigos','form' => 'frmOrden','is_null' => true), $this);?>

      </td>  
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>P</u>rioridad " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'priocodigos','name' => 'ordenempresa__priocodigos','sqlid' => 'prioridad','table_name' => 'priocodigos','value' => 'priocodigos','label' => 'prionombres','is_null' => 'true'), $this);?>
</td>
  	  <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
		      <td><?php echo "<B>A<u>r</u>ea causante</B> " ?></td>
		      <td>
		      	<?php echo smarty_function_textfield(array('id' => 'ordesitiejes','name' => 'orden__ordesitiejes','onBlur' => "if(this.value)autoReference('dep_fisica','orgacodigos',Array(this),this.form.orden_ordesitiejes_desc)"), $this);?>

			    <?php echo smarty_function_href(array('label' => "<img src='web/images/menu.gif' border='0' align='middle'></img>",'onclick' => "javascript:fncopenwindows('FeCrCmdTreeHelp','table=organizacion&sqlid=dep_fisica&return_obj=orden__ordesitiejes&return_key=orgacodigos&father=orgacgpads&son=orgacodigos&label=organombres&param=geografia&value='+document.frmOrden.orden__ordesitiejes.value+'&visibility=ancestry:1');"), $this);?>

		      <?php echo smarty_function_textfield(array('name' => 'orden_ordesitiejes_desc'), $this);?>
<B>*</B>
		      </td>
		  	<td class="piedefoto"><?php echo ""; ?></td>
		   </tr>
		   <tr>
		      <td colspan="2"><br></td>
		      <td class="piedefoto"><?php echo ""; ?></td>
		   </tr>
		   <tr>
		      <td colspan="2">
		      	<?php echo "Es actualmente un paciente  del hospital? " ?>&nbsp;
		      	<?php echo "Si " ?>&nbsp;<input type="radio" id="radio_paciente" name="answer" value="1" onClick="setDenunciante('1')">&nbsp;
		      	<?php echo "No " ?>&nbsp;<input type="radio" id="radio_denunciante" name="answer" value="2" onClick="setDenunciante('2')">&nbsp;
		      	<?php echo "o es an&oacute;nimo " ?>&nbsp;<input type="radio" id="radio_anonimo" name="answer" value="0" onClick="setDenunciante('0')">
		      </td>
		      <td class="piedefoto"></td>
		   </tr>
			<tr>
		      <td colspan="2">&nbsp;</td>
		      <td class="piedefoto"></td>
		    </tr>
		    <!-- Paciente -->
		    <tr>
		    <td colspan="2">
		    
			<div id="paciente" style="visibility:hidden; display:none ">
				<table border="0" align="center" width="100%">
					<tr>
						<td colspan="2"><strong><?php echo "Datos del paciente " ?></strong></td>
					</tr>
					<tr>
						<td><?php echo "<B><u>P</u>aciente</B> " ?></td>
						<td> 
							<?php echo smarty_function_dataselectdojo(array('htmlid' => 'paciindentis','name' => 'ordenempresa__paciindentis','sqlid' => 'paciente_ref','value' => 'paciindentis','label' => 'pacinombres','forceautoreference' => 'true'), $this);?>
 
						    <?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindows('../customers/index.php?action=FeCuCmdDefaultPaciente','');"), $this);?>

						</td>
					</tr>
					<tr>
						<td><?php echo "<B><u>S</u>eguridad social</B> " ?></td>
						<td>
						<?php echo smarty_function_select_row_table(array('name' => 'ordenempresa__sesocodigos','id' => 'sesocodigos','label' => 'sesonombres','sqlid' => 'segurisocial','is_null' => 'true','value' => 'sesocodigos'), $this);?>
<B>*</B>
						</td>
					</tr>
					<tr>
						<td><?php echo "<B><u>C</u>ondici&oacute;n del usuario</B> " ?></td>
						<td>
						<?php echo smarty_function_select_row_table(array('name' => 'ordenempresa__couscodigos','id' => 'couscodigos','label' => 'cousnombres','sqlid' => 'condiusuario','is_null' => 'true','value' => 'couscodigos'), $this);?>
<B>*</B>
						</td>
					</tr>
					<tr>
						<td><?php echo "<B><u>E</u>mp. aseguradora de salud</B> " ?></td>
						<td>
						<?php echo smarty_function_select_row_table(array('name' => 'ordenempresa__ipsecodigos','id' => 'ipsecodigos','label' => 'ipsenombres','sqlid' => 'ips','is_null' => 'true','value' => 'ipsecodigos'), $this);?>
<B>*</B>
						</td>
					</tr>
					<tr>
				      <td><?php echo "Ac<u>u</u>diente/reclamante " ?></td>
				      <td>
				      	<?php echo smarty_function_dataselectdojo(array('htmlid' => 'contidentis_p','name' => 'ordenempresa__contidentis_p','sqlid' => 'contacto_ref','value' => 'contcodigon','label' => 'contnombre','forceautoreference' => 'true'), $this);?>
 
					    <?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante','');"), $this);?>

				     </td>
				   </tr>
				</table>
			</div>
		    </td>
		    <td class="piedefoto"></td>
		    </tr>
		    <!-- Fin paciente -->
		     <!-- Denunciante -->
		    <tr>
		    <td colspan="2">
		   
			<div id="denunciante"  style="visibility:hidden; display:none ">
				<table border="0" align="center" width="100%">
					<tr>
						<td colspan="2"><strong><?php echo "Datos del reclamante " ?></strong></td>
					</tr>
				<tr>
			      <td><?php echo "<B>Reclaman<u>t</u>e</B> " ?></td>
			      <td>
			      	<?php echo smarty_function_dataselectdojo(array('htmlid' => 'contidentis','name' => 'ordenempresa__contidentis','sqlid' => 'contacto_ref','value' => 'contcodigon','label' => 'contnombre','forceautoreference' => 'true'), $this);?>
<B>*</B> 
				    <?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante','');"), $this);?>

			     </td>
			   </tr>
				</table>
			</div>
		    </td>
		    <td class="piedefoto"></td>
		    </tr>
		    <!-- Fin Denunciante -->
   <tr>
<td colspan="2" class="piedefoto">
		<?php $_params = $this->_tag_stack[] = array('div', array('id' => 'dynamic_columns','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   		<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
	</td>
	<td class="piedefoto"></td>
</tr>
</table>
	</td>
</tr>
<tr>
	<td class="piedefoto">
		<table border="0" align="center" width="100%">
		<tr><td colspan="2"><div align="center">
		    	<?php echo smarty_function_btn_button(array('value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCrCmdAddOrden','onClick' => "jsAddOrden();"), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeCrCmdUpdateOrden','form_name' => 'frmOrden','loadFields' => "orden__ordenumeros,ordenempresa__tiorcodigos,ordenempresa__evencodigos,orden__ordefecregd,orden__ordeobservs,orden__ordesitiejes,ordenempresa__merecodigos",'confirm' => '33'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdShowListOrden','form_name' => 'frmOrden'), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Orden','form_name' => 'frmOrden'), $this);?>

			</div></td><td width='15%' class="piedefoto"></td></tr>

		<tr><td colspan="3" class="piedefoto">&nbsp;</td></tr>
		<tr><td colspan="2" class="piedefoto"><?php echo smarty_function_register_attachment(array('form' => 'frmOrden'), $this);?>
</td><td valign="bottom" class="piedefoto"><?php echo "M&Aacute;XIMO 2 MB"; ?></td></tr>
		</table>
	</td>
</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => "",'id' => 'action'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'focusposition'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'deleteattachment','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'consult','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenumeros_load'), $this);?>
 
<?php echo smarty_function_hidden(array('name' => 'loadMerecodigos','value' => ""), $this);?>
 
<?php echo smarty_function_hidden(array('name' => 'orden__llave','id' => 'llave','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'ordenempresa__oremradicas'), $this);?>

<?php echo smarty_function_hidden(array('name' => 'customer_type','id' => 'customer_type'), $this);?>

<script language="javascript">
	setDenunciante('<?php echo $_REQUEST['customer_type']; ?>');
	activeRadio('<?php echo $_REQUEST['customer_type']; ?>');
</script>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'N\');'."\n".'	jsAccessKey(\'ordesitiejes\',\'R\');'."\n".'	jsAccessKey(\'ordeobservs\',\'D\');'."\n".'	jsAccessKey(\'ordefecregd\',\'E\');'."\n".'	jsAccessKey(\'ordefecvend\',\'I\');'."\n".'	jsAccessKey(\'contidentis_p\',\'U\');'."\n".'	jsAccessKey(\'contidentis\',\'T\');'."\n".'	jsAccessKey(\'priocodigos\',\'P\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'O\');'."\n".'	jsAccessKey(\'evencodigos\',\'S\');'."\n".'	jsAccessKey(\'causcodigos\',\'B\');'."\n".'	jsAccessKey(\'locacodigos\',\'Z\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'merecodigos\',\'M\');'."\n".'	jsAccessKey(\'denunciante\',\'R\');'."\n".'	jsAccessKey(\'proccodigos\',\'P\');'."\n".'	jsAccessKey(\'ordefecingd\',\'G\');'."\n".'	jsAccessKey(\'oremnumsegs\',\'N\');'."\n".'	jsAccessKey(\'infrcodigos\',\'A\');'."\n".'	jsAccessKey(\'paciente\',\'P\');'."\n".'	jsAccessKey(\'sesocodigos\',\'S\');'."\n".'	jsAccessKey(\'couscodigos\',\'C\');'."\n".'	jsAccessKey(\'ipscodigos\',\'E\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array('legend' => 'Resultado')); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message_orden(array('id' => $this->_tpl_vars['cod_message'],'param' => $this->_tpl_vars['param'],'signal' => $this->_tpl_vars['signal'],'error_field' => $this->_tpl_vars['error_field'],'label_file' => 'fichaord'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>