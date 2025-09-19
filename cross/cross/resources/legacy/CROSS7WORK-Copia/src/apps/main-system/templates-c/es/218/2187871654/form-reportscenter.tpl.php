<?php /* Smarty version 2.6.0, created on 2020-10-15 14:33:19
         compiled from Form_ReportsCenter.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_ReportsCenter.tpl', 3, false),array('block', 'body', 'Form_ReportsCenter.tpl', 9, false),array('block', 'form', 'Form_ReportsCenter.tpl', 11, false),array('block', 'div', 'Form_ReportsCenter.tpl', 43, false),array('block', 'fieldset', 'Form_ReportsCenter.tpl', 189, false),array('function', 'putstyle', 'Form_ReportsCenter.tpl', 5, false),array('function', 'hidden', 'Form_ReportsCenter.tpl', 12, false),array('function', 'href', 'Form_ReportsCenter.tpl', 36, false),array('function', 'message', 'Form_ReportsCenter.tpl', 190, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Centro de reportes"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/select_list.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsreportscenter.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendar.js" type="text/javascript"></script>
<script language="javascript" src="web/js/libCalendarPopupCode.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmReportscenter','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_hidden(array('name' => 'hidden_14'), $this);?>

   <!--  <?php echo smarty_function_hidden(array('name' => 'hidden_15'), $this);?>
 -->
   <!--  <?php echo smarty_function_hidden(array('name' => 'hidden_16'), $this);?>
-->
   <?php echo smarty_function_hidden(array('name' => 'hidden_17'), $this);?>

   <?php echo smarty_function_hidden(array('name' => 'hidden_18'), $this);?>

   <!--<?php echo smarty_function_hidden(array('name' => 'hidden_19'), $this);?>
-->
   <?php echo smarty_function_hidden(array('name' => 'hidden_20'), $this);?>

   <?php echo smarty_function_hidden(array('name' => 'hidden_21'), $this);?>

   <?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;<B>Nota: </B>Recuerde que los campos marcados con asterisco (*) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Centro de reportes"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Cantidad de casos por frecuencia (horario, diario, semanal, mensual). " ?></b></td>
      <td width='10%' align="center">
      	<?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_14', 'FeCrCmdShowHtmlFrequencyParams', '14', '14', 'hidden_14');"), $this);?>

       </td>
   </tr>
   <tr>
   <td colspan='3'class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_14','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>  
	</table>
	</td>
	</tr>
	
	<!--  <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Cantidad de casos por localizaci&oacute;n " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_15', 'FeCrCmdShowHtmlMunicipioParams', '15', '15', 'hidden_15');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_15','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
	</table>
	</td>
	</tr> -->
	
   <!--  <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
   <tr>
      <td colspan='2'><b><?php echo "Cantidad de denuncias por localizaci&oacute;n " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_16', 'FeCrCmdShowHtmlParams', '16', '16', 'hidden_16');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_16','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
	</table>
	</td>
	</tr> -->
	
	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Actividades por tarea " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_17', 'FeCrCmdShowHtmlActiviTareaParams', '17', '17', 'hidden_17');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_17','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
	</table>
	</td>
	</tr>
	
	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Cantidad de Casos por usuario. " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_18', 'FeCrCmdShowHtmlParams', '18', '18', 'hidden_18');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_18','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
	</table>
	</td>
	</tr>
	
	<!-- <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Indicador de satisfacci&oacute;n del cliente. " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_19', 'FeCrCmdShowHtmlParams', '19', '19', 'hidden_19');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_19','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
	</table>
	</td>
	</tr>-->


	<tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Hist&oacute;rico de rotaci&oacute;n de personal. " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_20', 'FeCrCmdShowLogHtmlParams', '20', '20', 'hidden_20');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_20','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
   <tr>
	<td td colspan='3'class='piedefoto'>
	<table border="0" cellSpacing="0" cellPadding="0" align="center" width="100%" class='bordertable'>
	<tr>
      <td colspan='2'><b><?php echo "Reporte de autorizaciones. " ?></b></td>
      <td width='10%' align="center">
        <?php echo smarty_function_href(array('label' => "<img src='web/images/formulario.gif' border='0' align='middle' title=''></img>",'href' => "javascript:jsShowHtml('index.php', 'div_21', 'FeCrCmdShowHtmlLlaveParams', '21', '21', 'hidden_21');"), $this);?>

       </td> 
   </tr>
   <tr>
   <td colspan='3' class='piedefoto'>
   <?php $_params = $this->_tag_stack[] = array('div', array('id' => 'div_21','align' => 'justify')); smarty_block_div($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_div($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
   </td>
   </tr>
	</table>
	</td>
	</tr>
	
</table>
<?php echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'year\',\'A\');'."\n".'	jsAccessKey(\'grafico\',\'G\');'."\n".'	jsAccessKey(\'period\',\'P\');'."\n".'	jsAccessKey(\'month\',\'M\');'."\n".'	jsAccessKey(\'frequency\',\'F\');'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'tiorcodigos\',\'T\');'."\n".'	jsAccessKey(\'llavusuauts\',\'U\');'."\n".'	jsAccessKey(\'llavususols\',\'S\');'."\n".'	jsAccessKey(\'ini_date\',\'E\');'."\n".'	jsAccessKey(\'fin_date\',\'C\');'."\n".'	jsAccessKey(\'ordefecdiginin\',\'H\');'."\n".'	jsAccessKey(\'ordefecdigfinn\',\'O\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n"; ?>
<?php $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html> 