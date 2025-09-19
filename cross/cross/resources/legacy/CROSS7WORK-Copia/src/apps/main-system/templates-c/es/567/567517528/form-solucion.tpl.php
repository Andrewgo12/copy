<?php /* Smarty version 2.6.0, created on 2020-10-15 14:31:06
         compiled from Form_Solucion.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Solucion.tpl', 3, false),array('block', 'body', 'Form_Solucion.tpl', 10, false),array('block', 'form', 'Form_Solucion.tpl', 12, false),array('block', 'textarea', 'Form_Solucion.tpl', 28, false),array('block', 'fieldset', 'Form_Solucion.tpl', 78, false),array('function', 'putstyle', 'Form_Solucion.tpl', 6, false),array('function', 'textfield', 'Form_Solucion.tpl', 23, false),array('function', 'register_attachment_sol', 'Form_Solucion.tpl', 36, false),array('function', 'btn_command', 'Form_Solucion.tpl', 64, false),array('function', 'hidden', 'Form_Solucion.tpl', 74, false),array('function', 'message', 'Form_Solucion.tpl', 79, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

      <title><?php echo "Administraci&oacute;n de soluciones"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmSolucion','enctype' => "multipart/form-data",'method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table border="0" align="center" width="70%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		<?php echo "<fieldset class=context_help>&nbsp;&nbsp;En la administraci&oacute;n de soluciones es posible agregar, actualizar o eliminar soluciones hechas a los casos finalizados.<br><B>Nota: </B>Recuerde que los campos marcados con asterisco ( * ) son obligatorios.</fieldset>" ?>
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left"><?php echo "Administraci&oacute;n de soluciones"; ?></div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td class="celda"><?php echo "<B>Ca<u>s</u>o</B> " ?></td>
      <td class="celda"><?php echo smarty_function_textfield(array('id' => 'ordenumeros','name' => 'ordenempresa__ordenumeros','class' => 'campos','maxlength' => '30'), $this);?>
<b>*</b></td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   <tr>
      <td class="celda"><?php echo "<B><u>R</u>esumen</B> " ?></td>
      <td class="celda"><?php $_params = $this->_tag_stack[] = array('textarea', array('id' => 'resumen','name' => 'solucion__resumen','class' => 'campos','cols' => '50','rows' => '5')); smarty_block_textarea($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_textarea($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?><b>*</b></td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>
   
   <tr>
		<td class="piedefoto" colspan="3">&nbsp;</td>
	</tr>
   
   <tr><td colspan="2" class="piedefoto"><?php echo smarty_function_register_attachment_sol(array('form' => 'frmSolucion'), $this);?>
</td>
   <td valign="bottom" class="piedefoto"><?php echo "Max 2MB"; ?></td></tr>
   <!-- <tr>
      <td class="celda"><?php echo "Car<u>g</u>ar archivo " ?></td>
      <td class="celda"><?php echo smarty_function_textfield(array('type' => 'file','id' => 'archivo','name' => 'solucion_archivo','class' => 'campos','size' => '50'), $this);?>
</td>
 	   <td class="piedefoto"><?php echo "Max 2MB"; ?></td>
   </tr>
   <tr>
      <td class="celda"><?php echo "Nombre archivo " ?></td>
      <td class="celda">
            <?php 
                if($_REQUEST['archivo']){
                    echo "<a href='#' onclick=\"fncopenwindows('FeCrCmdDefaultDownloadFile','archcodigon=".$_REQUEST['archcodigon']."');\" title='{$rcLabels['descargar']['label']}'>".$_REQUEST['archivo']."</a><br>";
                    echo "<input type='hidden' name='archivo' value='".$_REQUEST['archivo']."' />";
                    echo "<input type='hidden' name='archcodigon' value='".$_REQUEST['archcodigon']."' />";
                }
             ?>
       </td>
 	   <td class="piedefoto"><?php echo ""; ?></td>
   </tr>-->
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
    	<td colspan="2">
    		<div align="center">
	    		<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Adicionar','id' => 'CmdAdd','name' => 'FeCrCmdAddSolucion','form_name' => 'frmSolucion'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Modificar','id' => 'CmdUpdate','name' => 'FeCrCmdUpdateSolucion','form_name' => 'frmSolucion','loadFields' => "ordenempresa__ordenumeros,solucion__resumen",'confirm' => '33'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Eliminar','id' => 'CmdDelete','name' => 'FeCrCmdDeleteSolucion','form_name' => 'frmSolucion','loadFields' => 'ordenempresa__ordenumeros','confirm' => '34'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdShowListSolucion','form_name' => 'frmSolucion'), $this);?>

				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Limpiar','id' => 'CmdClean','name' => 'FeCrCmdClearSolucion','form_name' => 'frmSolucion'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'deleteattachment','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'ordenumeros\',\'S\');'."\n".'	jsAccessKey(\'resumen\',\'R\');'."\n".'	jsAccessKey(\'archivo\',\'G\');'."\n".'	jsAccessKey(\'CmdAdd\',\'A\',\'Aceptar\');'."\n".'	jsAccessKey(\'CmdUpdate\',\'M\',\'Modificar\');'."\n".'	jsAccessKey(\'CmdDelete\',\'E\',\'Eliminar\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'	jsAccessKey(\'CmdClean\',\'L\',\'Limpiar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array()); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<br>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>