<?php /* Smarty version 2.6.0, created on 2020-10-10 09:11:39
         compiled from Form_Indoprequre.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'putstyle', 'Form_Indoprequre.tpl', 5, false),array('function', 'calendar', 'Form_Indoprequre.tpl', 26, false),array('function', 'select_row_table', 'Form_Indoprequre.tpl', 55, false),array('function', 'select_son', 'Form_Indoprequre.tpl', 66, false),array('function', 'btn_button', 'Form_Indoprequre.tpl', 98, false),array('function', 'btn_clean', 'Form_Indoprequre.tpl', 99, false),array('function', 'hidden', 'Form_Indoprequre.tpl', 117, false),array('function', 'message', 'Form_Indoprequre.tpl', 121, false),array('block', 'body', 'Form_Indoprequre.tpl', 8, false),array('block', 'form', 'Form_Indoprequre.tpl', 9, false),array('block', 'div', 'Form_Indoprequre.tpl', 109, false),array('block', 'fieldset', 'Form_Indoprequre.tpl', 120, false),)), $this); ?>
<html>
<head>
      <title><?php echo "Indicador de oportunidad de respuesta a quejas y reclamos "; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsLoadSelect.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsIndoprequre.js" type="text/javascript"></script>
<script language="javascript" src="web/js/encode.js" type="text/javascript"></script>' ?>
</head>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmIndoprequre','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;Los indicadores de gesti&oacute;n proporcionan informaci&oacute;n reactiva - sobre el rendimiento pasado e informaci&oacute;n proactiva - anticipando el comportamiento futuro de las variables. Su medici&oacute;n es una funci&oacute;n fundamental para conocer el grado de cumplimiento de los objetivos de la corporaci&oacute;n.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Indicador de oportunidad de respuesta a quejas y reclamos "; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td><?php echo "<B>F<u>e</u>cha registro inicial</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecregdb','name' => 'ordefecregdb','is_null' => 'true','form_name' => 'frmIndoprequre'), $this);?>

      <b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "<B>Fec<u>h</u>a registro final</B> " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecregde','name' => 'ordefecregde','is_null' => 'true','form_name' => 'frmIndoprequre'), $this);?>

      <b>*</b></td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>

   <tr>
      <td><?php echo "Fecha d<u>i</u>gitaci&oacute;n inicial " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecingdb','name' => 'ordefecingdb','is_null' => 'true','form_name' => 'frmIndoprequre'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   <tr>
      <td><?php echo "Fecha di<u>g</u>itaci&oacute;n final " ?></td>
      <td>
      <?php echo smarty_function_calendar(array('id' => 'ordefecingde','name' => 'ordefecingde','is_null' => 'true','form_name' => 'frmIndoprequre'), $this);?>

      </td>
  	<td class="piedefoto"><?php echo "AAAA/MM/DD"; ?></td>
   </tr>
   
   <tr>
      <td><?php echo "<u>T</u>ipo de Caso " ?></td>
      <td><?php echo smarty_function_select_row_table(array('id' => 'tiorcodigos','name' => 'tiorcodigos','sqlid' => 'tipoorden','table_name' => 'tipoorden','value' => 'tiorcodigos','label' => 'tiornombres','is_null' => 'true','onchange' => "if(this.value!='')LoadSelect('tipoorden_evento','tiorcodigos',Array(this),document.frmIndoprequre.evencodigos,'evencodigos,causcodigos');"), $this);?>

      <br>
      <div id="tiordescrips"></div>
      </td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
   	  <td><?php echo "<u>C</u>lasificaci&oacute;n " ?></td>
   	  	<td>
   	  	<?php echo smarty_function_select_son(array('name' => 'evencodigos','table_hijo' => 'evento','id_hijo' => 'evencodigos','label_hijo' => 'evennombres','foreign_name' => "",'select_papa' => 'tiorcodigos','sqlid' => 'tipoorden_evento','onchange' => "if(this.value)LoadSelect('tipoorden_evento_causa','evencodigos|tiorcodigos',Array(this,document.frmIndoprequre.tiorcodigos),document.frmIndoprequre.causcodigos,'causcodigos');"), $this);?>

   	  	</td>
  	<td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td><?php echo "Su<u>b</u>Clasificaci&oacute;n " ?></td>
      <td>
      <?php echo smarty_function_select_son(array('name' => 'causcodigos','table_hijo' => 'causa','id_hijo' => 'causcodigos','label_hijo' => 'causnombres','foreign_name' => "",'select_papa' => "tiorcodigos,evencodigos",'sqlid' => 'tipoorden_evento_causa'), $this);?>
  
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
				<?php echo smarty_function_btn_button(array('value' => 'Consultar','id' => 'CmdShow','name' => 'FeEnCmdShowIndoprequre','onClick' => "jsShowIndoprequre();"), $this);?>

				<?php echo smarty_function_btn_clean(array('table_name' => 'Indoprequre','form_name' => 'frmIndoprequre'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
	<tr>
      <td colspan="2"><?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_indoprequre','align' => 'center')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?></td>
      <td class="piedefoto"></td>
   </tr>
   <tr>
      <td colspan="2">&nbsp;</td>
      <td class="piedefoto"></td>
   </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'indtitle\',\'F\');'."\n".'	jsAccessKey(\'casotitle\',\'D\');'."\n".'	jsAccessKey(\'ordefecregdb\',\'E\');'."\n".'	jsAccessKey(\'ordefecregde\',\'H\');'."\n".'	jsAccessKey(\'ordefecingdb\',\'I\');'."\n".'	jsAccessKey(\'ordefecingde\',\'G\');'."\n".'	jsAccessKey(\'orgacodigos\',\'P\');'."\n".'	jsAccessKey(\'cantcasos\',\'N\');'."\n".'	jsAccessKey(\'canttcasos\',\'T\');'."\n".'	jsAccessKey(\'day\',\'D\');'."\n".'	jsAccessKey(\'hour\',\'H\');'."\n".'	jsAccessKey(\'min\',\'M\');'."\n".'	jsAccessKey(\'seg\',\'S\');'."\n".'	jsAccessKey(\'formulal\',\'R\');'."\n".'	jsAccessKey(\'formula\',\'U\');'."\n".'	jsAccessKey(\'cantidad\',\'C\');'."\n".'	jsAccessKey(\'porcentaje\',\'O\');'."\n".'	jsAccessKey(\'total\',\'T\');'."\n".'	jsAccessKey(\'caso\',\'C\');'."\n".'	jsAccessKey(\'resultado\',\'P\');'."\n".'	jsAccessKey(\'parametros\',\'P\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'evencodigos\',\'C\');'."\n".'	jsAccessKey(\'causcodigos\',\'B\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'	jsAccessKey(\'CmdAccept\',\'C\',\'aCeptar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>