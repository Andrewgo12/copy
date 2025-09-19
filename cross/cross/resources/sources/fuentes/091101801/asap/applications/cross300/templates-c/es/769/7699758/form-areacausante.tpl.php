<?php /* Smarty version 2.6.0, created on 2014-07-08 09:21:07
         compiled from Form_AreaCausante.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_AreaCausante.tpl', 3, false),array('block', 'body', 'Form_AreaCausante.tpl', 9, false),array('block', 'form', 'Form_AreaCausante.tpl', 11, false),array('block', 'fieldset', 'Form_AreaCausante.tpl', 100, false),array('function', 'putstyle', 'Form_AreaCausante.tpl', 5, false),array('function', 'calendar', 'Form_AreaCausante.tpl', 22, false),array('function', 'btn_button', 'Form_AreaCausante.tpl', 88, false),array('function', 'hidden', 'Form_AreaCausante.tpl', 95, false),array('function', 'selecttipos', 'Form_AreaCausante.tpl', 98, false),array('function', 'message', 'Form_AreaCausante.tpl', 101, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?> 
      <title><?php echo "Reporte de casos por dependencia infractora"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmDetalle','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Este reporte informa de la gesti&oacute;n que a la fecha se le ha realizado a los casos en los cuales se ha relacionado una dependencia infractora.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	<tr><th colspan="3"><div align="left"><?php echo "Reporte de casos por dependencia infractora"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td><?php echo "<B><u>F</u>echa registro inicial</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecingdini','name' => 'orden__ordefecingdini','is_null' => 'true','form_name' => 'frmDetalle'), $this);?>

      <b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>F<u>e</u>cha registro final</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecingdfin','name' => 'orden__ordefecingdfin','is_null' => 'true','form_name' => 'frmDetalle'), $this);?>

      <b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>

   <tr>
      <td><?php echo "Fec<u>h</u>a-hora digitaci&oacute;n inicial " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecdiginin','name' => 'orden__ordefecdiginin','is_null' => 'true','hour' => 'true','form_name' => 'frmDetalle'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "Fech<u>a</u>-hora digitaci&oacute;n final " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecdigfinn','name' => 'orden__ordefecdigfinn','is_null' => 'true','hour' => 'true','form_name' => 'frmDetalle'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>

   <tr>
      <td><?php echo "<B><u>T</u>ipo de reporte</B> " ?></td>
      <td>
          <select name="reporte" id="reporte" onChange="selectTipo(this,document.frmDetalle.tipoorden,document.frmDetalle.dependencia);">
            <option selected>---</option>
            <option value="tipos"><?php echo "TODOS LOS TIPOS DE CASO " ?></option>
            <option value="estado_time"><?php echo "SITUACI&Oacute;N DEL TIEMPO DE LOS CASOS  " ?></option>
            <option value="tipo"><?php echo "TIPO ESPECIFICO " ?></option>
            <option value="desagregado"><?php echo "PARA TODOS LOS TIPOS DE CASO Y DESAGREGADO POR DEPENDENCIA " ?></option>
          </select><b>*</b>
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "T<u>i</u>po de caso " ?></td>
      <td>
          <select name="tipoorden" id="tipoorden">
          <option selected>---</option>
          </select>
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "<u>D</u>ependencia infractora " ?></td>
      <td>
          <select name="dependencia" id="dependencia">
          <option selected>---</option>
          </select>
      </td>
  	<td class="piedefoto"><?php echo "Dependencia a desagregar"; ?></td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'consultar','onClick' => "if(valDatos())fncopenwindows('FeCrCmdDefaultRepAreaCausante','ordefecingdini='+document.frmDetalle.orden__ordefecingdini.value+'&ordefecingdfin='+document.frmDetalle.orden__ordefecingdfin.value+'&reporte='+document.frmDetalle.reporte.value+'&tipoorden='+document.frmDetalle.tipoorden.value+'&dependencia='+document.frmDetalle.dependencia.value+'&ordefecdiginin='+this.form.orden__ordefecdiginin.value+'&ordefecdigfinn='+this.form.orden__ordefecdigfinn.value);"), $this);?>

		</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'tipo','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo smarty_function_selecttipos(array('opcion' => '1'), $this);?>

<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'periodo\',\'P\');'."\n".'	jsAccessKey(\'reporte\',\'T\');'."\n".'	jsAccessKey(\'tipoorden\',\'I\');'."\n".'	jsAccessKey(\'dependencia\',\'D\');'."\n".'	jsAccessKey(\'locacodigos\',\'O\');'."\n".'	jsAccessKey(\'ordefecingdini\',\'F\');'."\n".'	jsAccessKey(\'ordefecingdfin\',\'E\');'."\n".'	jsAccessKey(\'ordefecdiginin\',\'H\');'."\n".'	jsAccessKey(\'ordefecdigfinn\',\'A\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>