<?php /* Smarty version 2.6.0, created on 2020-11-18 14:53:37
         compiled from Form_BodyFichaOrdWeb.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_BodyFichaOrdWeb.tpl', 3, false),array('block', 'body', 'Form_BodyFichaOrdWeb.tpl', 9, false),array('block', 'form', 'Form_BodyFichaOrdWeb.tpl', 10, false),array('function', 'putstyle', 'Form_BodyFichaOrdWeb.tpl', 5, false),array('function', 'infocompany', 'Form_BodyFichaOrdWeb.tpl', 14, false),array('function', 'viewfichaordweb', 'Form_BodyFichaOrdWeb.tpl', 24, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo "Ficha de Caso"; ?></title>
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $_params = $this->_tag_stack[] = array('body', array('onkeydown' => "",'onload' => "",'onunload' => "")); smarty_block_body($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start();  $_params = $this->_tag_stack[] = array('form', array('name' => 'frmFichaOrd','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
  <table border="0" align="center" width="100%">
        <tr>
    	<!-- El Nombre de la empresa-->
    	<td class="piedefoto"><?php echo smarty_function_infocompany(array(), $this);?>
</td>
        </tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
	    <tr>
	    	<td class="piedefoto"><div align="center">
	    		<?php echo smarty_function_viewfichaordweb(array(), $this);?>

	    	</div></td>
	    </tr>
  </table>
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_body($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</html>