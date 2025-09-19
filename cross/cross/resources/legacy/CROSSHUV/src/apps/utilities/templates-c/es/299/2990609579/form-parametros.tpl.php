<?php /* Smarty version 2.6.0, created on 2020-09-25 14:36:27
         compiled from Form_Parametros.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Parametros.tpl', 3, false),array('block', 'body', 'Form_Parametros.tpl', 10, false),array('block', 'form', 'Form_Parametros.tpl', 12, false),array('block', 'fieldset', 'Form_Parametros.tpl', 42, false),array('function', 'putstyle', 'Form_Parametros.tpl', 6, false),array('function', 'viewPestanas', 'Form_Parametros.tpl', 23, false),array('function', 'viewParams', 'Form_Parametros.tpl', 27, false),array('function', 'btn_commandParams', 'Form_Parametros.tpl', 32, false),array('function', 'hidden', 'Form_Parametros.tpl', 39, false),array('function', 'message', 'Form_Parametros.tpl', 43, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Administraci&oacute;n de par&aacute;metros"; ?></title>

<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmParams','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Estos son los par&aacute;metros del sistema.<br>Seleccione el contexto y proceda a hacer sus cambios.<br>Para guardar sus cambios presione MODIFICAR.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Administraci&oacute;n de par&aacute;metros"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

	<tr>
      <td colspan="2"><?php echo "<B><u>C</u>ontexto</B> " ?></td>
      <td><B><?php echo smarty_function_viewPestanas(array(), $this);?>
</B></td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
	<?php echo smarty_function_viewParams(array('controls' => 'CmdUpdate'), $this);?>

	
	<tr>
		<td colspan="3">
			<div align="center">
				<?php echo smarty_function_btn_commandParams(array('type' => 'button','value' => 'Modificar','onClick' => "validarNulosMultiples()",'id' => 'CmdUpdate','name' => 'FeGeCmdUpdateParametros','form_name' => 'frmParams'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'schema\',\'C\');'."\n".'	jsAccessKey(\'emprtelefos\',\'T\');'."\n".'	jsAccessKey(\'SUFIJO_ORDENUMEROS\',\'S\');'."\n".'	jsAccessKey(\'hora_ini\',\'H\');'."\n".'	jsAccessKey(\'hora_fin\',\'O\');'."\n".'	jsAccessKey(\'email_server\',\'D\');'."\n".'	jsAccessKey(\'dump_program\',\'R\');'."\n".'	jsAccessKey(\'SPLASH_IMG\',\'I\');'."\n".'	jsAccessKey(\'user\',\'U\');'."\n".'	jsAccessKey(\'dep_detalle\',\'E\');'."\n".'	jsAccessKey(\'MAXLENGTH_ORDENUMEROS\',\'A\');'."\n".'	jsAccessKey(\'type_close\',\'P\');'."\n".'	jsAccessKey(\'DEFAUL_CUSTOMER\',\'N\');'."\n".'	jsAccessKey(\'ORG_INACT\',\'L\');'."\n".'	jsAccessKey(\'EST_GRUP_INA\',\'G\');'."\n".'	jsAccessKey(\'acceso_total\',\'D\');'."\n".'	jsAccessKey(\'emprnits\',\'N\');'."\n".'	jsAccessKey(\'emprnombres\',\'B\');'."\n".'	jsAccessKey(\'emprdireccs\',\'D\');'."\n".'	jsAccessKey(\'emprfaxs\',\'F\');'."\n".'	jsAccessKey(\'emprnombreps\',\'N\');'."\n".'	jsAccessKey(\'emprlogos\',\'L\');'."\n".'	jsAccessKey(\'empremail\',\'E\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'merecodigos\',\'M\');'."\n".'	jsAccessKey(\'ticlcodigos\',\'T\');'."\n".'	jsAccessKey(\'esclcodigos\',\'E\');'."\n".'	jsAccessKey(\'locacodigos\',\'Z\');'."\n".'	jsAccessKey(\'tiidcodigos\',\'T\');'."\n".'	jsAccessKey(\'clienombres\',\'N\');'."\n".'	jsAccessKey(\'TYPES_CASE_PURSUIT\',\'S\');'."\n".'	jsAccessKey(\'TYPES_CASE_DENUNCIA\',\'Q\');'."\n".'	jsAccessKey(\'DENUNCIA_TC\',\'D\');'."\n".'	jsAccessKey(\'TRACKING_ALLOWED_STATES\',\'E\');'."\n".'	jsAccessKey(\'CLOSE_COMMITMENT_STATES\',\'E\');'."\n".'	jsAccessKey(\'NO_CLOSE_COMMITMENT_STATES\',\'E\');'."\n".'	jsAccessKey(\'TAREA_SEGUIMIENTO\',\'T\');'."\n".'	jsAccessKey(\'ASAPPOINTS_DEFAULT\',\'D\');'."\n".'	jsAccessKey(\'CANT_DIAS_ING\',\'C\');'."\n".'	jsAccessKey(\'RESP_ABIERTA\',\'R\');'."\n".'	jsAccessKey(\'OBJ_PREG_ABIERTA\',\'J\');'."\n".'	jsAccessKey(\'OBJ_PREG_CERRADA\',\'O\');'."\n".'	jsAccessKey(\'SMS_WS_PATH\',\'W\');'."\n".'	jsAccessKey(\'DEFAULT_STATUS\',\'E\');'."\n".'	jsAccessKey(\'COD_LOCALIZ_CALI\',\'C\');'."\n".'	jsAccessKey(\'USER_DOCUNET\',\'U\');'."\n".'	jsAccessKey(\'DOCUNET_PATH\',\'R\');'."\n".'	jsAccessKey(\'TAREA_CC\',\'Y\');'."\n".'	jsAccessKey(\'ORG_INACT_DEFAULT\',\'E\');'."\n".'	jsAccessKey(\'TIP_DEP_FISICA\',\'T\');'."\n".'	jsAccessKey(\'SERV_ORG\',\'S\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>