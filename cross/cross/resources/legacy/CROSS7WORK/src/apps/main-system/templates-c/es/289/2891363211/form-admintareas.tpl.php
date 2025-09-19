<?php /* Smarty version 2.6.0, created on 2021-08-19 00:43:01
         compiled from Form_AdminTareas.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_AdminTareas.tpl', 3, false),array('block', 'body', 'Form_AdminTareas.tpl', 9, false),array('block', 'form', 'Form_AdminTareas.tpl', 12, false),array('block', 'fieldset', 'Form_AdminTareas.tpl', 45, false),array('function', 'putstyle', 'Form_AdminTareas.tpl', 5, false),array('function', 'select_entes_esp', 'Form_AdminTareas.tpl', 22, false),array('function', 'btn_command', 'Form_AdminTareas.tpl', 29, false),array('function', 'viewtareas', 'Form_AdminTareas.tpl', 37, false),array('function', 'hidden', 'Form_AdminTareas.tpl', 40, false),array('function', 'message', 'Form_AdminTareas.tpl', 46, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>Permisions</title>
<?php echo smarty_function_putstyle(array(), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>
<script language="javascript" src="web/js/AutoCompletar.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "putFocus();",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>

<br>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmAdminTareas','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
  <table border="0" align="center" width="80%">
  <tr><td class="piedefoto" colspan="3"><div align="center">
	<?php echo "<fieldset class=context_help>&nbsp;&nbsp;La administraci&oacute;n de tareas permite al usuario revisar, atender o transferir el trabajo asignado a sus dependencias.<br><br>Seleccione en la lista de dependencias y presione el bot&oacute;n de consultar.</fieldset>" ?>
  </div></td></tr>
  <tr><th colspan="3">&nbsp;</th></tr>
  <tr><th colspan="3"><div align="left"><?php echo "Administraci&oacute;n de tareas"; ?></div></th></tr>
		<tr>
		      <td><?php echo "<u>D</u>ependencia " ?></td>
		      <td>
		      	<?php echo smarty_function_select_entes_esp(array('id' => 'orgacodigos','name' => 'orgacodigos','is_null' => 'true','form' => 'frmAdminTareas'), $this);?>

		      </td>
		      <td class="piedefoto"><?php echo ""; ?></td>
        </tr>
        <tr>
		<td colspan="2">
			<div align="center">
				<?php echo smarty_function_btn_command(array('type' => 'button','value' => 'Consultar','id' => 'CmdShow','name' => 'FeCrCmdDefaultAdminTareas','form_name' => 'frmAdminTareas'), $this);?>

			</div>
		</td>
		<td class="piedefoto"></td>
		</tr>
	    
	    <tr>
	    	<!-- Pinta la tabla de las tareas -->
	    	<td colspan="3"><?php echo smarty_function_viewtareas(array('form' => 'frmAdminTareas'), $this);?>
</td>
	    </tr>
  </table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'acta','value' => ""), $this);?>

<?php echo smarty_function_hidden(array('name' => 'order_by','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo "\n".'<script language="javascript">'."\n".'	jsAccessKey(\'orgacodigos\',\'D\');'."\n".'	jsAccessKey(\'CmdShow\',\'C\',\'Consultar\');'."\n".'</script>'."\n";  $_params = $this->_tag_stack[] = array('fieldset', array('legend' => 'Resultado')); smarty_block_fieldset($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
   <?php echo smarty_function_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_fieldset($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</html>