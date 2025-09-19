<?php /* Smarty version 2.6.0, created on 2016-10-13 00:27:29
         compiled from Form_BodyReqeps.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'putstyle', 'Form_BodyReqeps.tpl', 5, false),array('function', 'infocompany', 'Form_BodyReqeps.tpl', 13, false),array('function', 'reqeps', 'Form_BodyReqeps.tpl', 24, false),array('block', 'body', 'Form_BodyReqeps.tpl', 8, false),array('block', 'form', 'Form_BodyReqeps.tpl', 9, false),)), $this); ?>
<html>
<head>
      <title><?php echo "Reporte de casos por empresa aseguradora de salud"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>
</head>
<?php $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "return doKeyDown(event)",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmReqeps','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
  <table border="0" align="center" width="100%">
        <tr>
    	<!-- El Nombre de la empresa-->
    	<td class="piedefoto"><?php echo smarty_function_infocompany(array(), $this);?>
</td>
        </tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
        <tr><th><div align="center"><?php echo "Reporte de casos por empresa aseguradora de salud"; ?></div></th></tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
	    <tr>
	    	<td class="piedefoto"><div align="center">
	    		<?php echo smarty_function_reqeps(array(), $this);?>

	    	</div></td>
	    </tr>
  </table>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>