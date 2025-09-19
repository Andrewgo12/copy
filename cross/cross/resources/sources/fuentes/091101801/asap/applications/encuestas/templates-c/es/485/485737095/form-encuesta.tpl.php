<?php /* Smarty version 2.6.0, created on 2014-07-17 16:55:00
         compiled from Form_Encuesta.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Encuesta.tpl', 3, false),array('block', 'body', 'Form_Encuesta.tpl', 9, false),array('block', 'form', 'Form_Encuesta.tpl', 10, false),array('block', 'div', 'Form_Encuesta.tpl', 70, false),array('block', 'fieldset', 'Form_Encuesta.tpl', 94, false),array('function', 'putstyle', 'Form_Encuesta.tpl', 5, false),array('function', 'select_row_table', 'Form_Encuesta.tpl', 26, false),array('function', 'dataselectdojo', 'Form_Encuesta.tpl', 32, false),array('function', 'href', 'Form_Encuesta.tpl', 33, false),array('function', 'select_row_servorg', 'Form_Encuesta.tpl', 52, false),array('function', 'textfield', 'Form_Encuesta.tpl', 58, false),array('function', 'btn_button', 'Form_Encuesta.tpl', 80, false),array('function', 'btn_clean', 'Form_Encuesta.tpl', 81, false),array('function', 'hidden', 'Form_Encuesta.tpl', 91, false),array('function', 'message', 'Form_Encuesta.tpl', 95, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Encuesta"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsError.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encuesta.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/SelectControl.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmEncuesta','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Si usted no est&aacute; registrado, debe registrarse diligenciando este formulario, si lo est&aacute; por favor digite s&oacute;lamente su identificaci&oacute;n y el sistema completar&aacute; sus datos, luego por favor continue con la evaluaci&oacute;n de la encuesta.
				   <br><B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Encuesta"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td width='25%'><?php echo "<B><u>F</u>ormulario</B> " ?></td>
      <td width='60%'><?php echo smarty_function_select_row_table(array('id' => 'formcodigon','sqlid' => 'formulario','name' => 'formulario__formcodigon','table_name' => 'formulario','value' => 'formcodigon','label' => 'formnombres','is_null' => 'true','onchange' => "jsShowFormulario();"), $this);?>
<B>*</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>S</u>olicitante/Denunciante " ?></td>
      <td>
      	<?php echo smarty_function_dataselectdojo(array('htmlid' => 'contidentis','name' => 'formulario__contidentis','sqlid' => 'contacto_ref','value' => 'contcodigon','label' => 'contnombre','forceautoreference' => 'true'), $this);?>

	    <?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindowsSol('../customers/index.php?action=FeCuCmdDefaultSolicitante');"), $this);?>

     </td>
  	<td class="piedefoto"><?php echo "Persona que presenta la solicitud o reporta la infracci&oacute;n ambiental."; ?></td>
   </tr>
   <tr>
	<td><?php echo "<B><u>P</u>aciente</B> " ?></td>
	<td> 
		<?php echo smarty_function_dataselectdojo(array('htmlid' => 'paciindentis','name' => 'formulario__paciindentis','sqlid' => 'paciente_ref','value' => 'paciindentis','label' => 'pacinombres','forceautoreference' => 'true'), $this);?>
 
	    <?php echo smarty_function_href(array('label' => "<img src='web/images/crear.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:OpenWindows('../customers/index.php?action=FeCuCmdDefaultPaciente','');"), $this);?>

	    <B>*</B>
	</td>
   </tr>
   <tr>
   	  <td><?php echo "<B>S<u>e</u>rvicios</B> " ?></td>
      <td>
        <?php echo smarty_function_select_row_servorg(array('id' => 'orgacodigos','value' => 'orgacodigos','label' => 'organombres','name' => 'formulario__orgacodigos','is_null' => true), $this);?>
<B>*</B>
      </td>  
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "N&uacute;mero de Caso " ?></td>
      <td><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'formulario__ordenumeros','maxlength' => '30'), $this);?>

      <?php echo smarty_function_href(array('label' => "<img src='web/images/zoomprev.gif' border='0' align='absmiddle'></img>",'onclick' => "javascript:var sbOrdenumeros=document.frmEncuesta.formulario__ordenumeros.value;if(sbOrdenumeros)OpenWindows('../cross300/index.php?action=FeCrCmdDefaultFichas&topFrame=FeCrCmdDefaultHeadRepoTiemposEjec&mainFrame=FeCrCmdDefaultBodyFichaOrd&ordenumerosFO='+sbOrdenumeros+'&vars=ordenumerosFO');"), $this);?>

      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>   
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_encuesta','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_button(array('value' => 'Aceptar','id' => 'CmdAccept','name' => 'FeEnCmdSaveConfig','onClick' => "jsSaveEncuesta();"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Encuesta','form_name' => 'frmEncuesta'), $this);?>

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

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'formcodigon\',\'F\');'."\n".'	jsAccessKey(\'accion\',\'C\');'."\n".'	jsAccessKey(\'contidentis\',\'S\');'."\n".'	jsAccessKey(\'orgacodigos\',\'E\');'."\n".'	jsAccessKey(\'paciente\',\'P\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'	jsAccessKey(\'CmdAccept\',\'A\',\'Aceptar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>