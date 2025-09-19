<?php /* Smarty version 2.6.0, created on 2020-09-30 17:20:39
         compiled from Form_Login.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Login.tpl', 4, false),array('block', 'form', 'Form_Login.tpl', 40, false),array('function', 'putstyle', 'Form_Login.tpl', 7, false),array('function', 'textfield', 'Form_Login.tpl', 44, false),array('function', 'btn_button', 'Form_Login.tpl', 55, false),array('function', 'new_message', 'Form_Login.tpl', 75, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title>CROSS</title>

<?php echo smarty_function_putstyle(array('style' => "login.css"), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/headControlLogin.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body onkeydown="return doKeyDown(event)" onLoad="putFocus();MM_preloadImages()">
<br />
<br />
<br />
<table align="center" border="0" id="Table_01" width="798" height="530" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="5"><img src="web/images/login.01_01.png" width="798" height="113" alt=""></td>
	</tr>
	<tr> 
		<td rowspan="3"><div id="new" style="height: 170px; width: 399px;">
		                   <b><h3>
						      SISTEMA DE GESTIÓN DEL PROCESO DE ATENCIÓN AL CLIENTE: 
							  <br><p><ul><li>PQR's (PETICIONES, QUEJAS, RECLAMOS, SUGERENCIAS, ELOGIOS)</li>
							  <li>HELPDESK (TICKETS DE SOPORTE).</li></ul>
						   </h3></b>
		                </div></td>
		<td rowspan="3"><img src="web/images/login.01_03.png" width="3" height="294" alt=""></td>
		<td colspan="3">
			<div id="logoempresa" style="height: 127px; width: 396px; text-align:center;">
				<!-- El logo de la empresa cliente -->
				<img src="web/images/logo_empresa.png" alt="">
			</div>
		</td>
	</tr>
	<tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
	<tr>
		<td colspan="3">
		<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmLogin','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
			<table width="80%"  border="0" align="center" cellpadding="1" cellspacing="1">
          		<tr>
					<td><div align="right"><?php echo "<u>U</u>suario " ?> :</div></td>
					<td><?php echo smarty_function_textfield(array('name' => 'username','id' => 'username'), $this);?>
</td>
				</tr>
          		<tr>
            		<td><div align="right"><?php echo "<u>C</u>lave " ?> :</div></td>
            		<td><?php echo smarty_function_textfield(array('type' => 'password','name' => 'password','id' => 'password'), $this);?>
</td>
          		</tr>
          		<tr>
            		<td colspan="2">&nbsp;</td>
          		</tr>
          		<tr>
            		<td colspan="2"><div align="center">
						<?php echo smarty_function_btn_button(array('type' => 'button','value' => 'Ingresar','id' => 'CmdLoguin','onClick' => "javascript:document.frmLogin.action.value='FePrCmdLogin';document.frmLogin.submit();"), $this);?>

						</div>
            		</td>
          		</tr>
        	</table>
        	<input type="hidden" name="action">
		<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>		
	</td>
	</tr>
	<tr>
		<td colspan="3"><div style="height: 68px; width: 396px;"></div></td>
	</tr>
	<tr>
		<td colspan="5"><img src="web/images/login.01_13_slp.png" width="798" height="93" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="web/images/login.01_14.png" width="798" height="30" alt=""></td>
	</tr>
</table>
<?php echo smarty_function_new_message(array('id' => $this->_tpl_vars['cod_message']), $this);?>

</body>
</html>