<?php /* Smarty version 2.6.0, created on 2014-12-05 08:30:23
         compiled from Form_HeadRepoTiemposEjec.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_HeadRepoTiemposEjec.tpl', 3, false),array('function', 'putstyle', 'Form_HeadRepoTiemposEjec.tpl', 6, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title><?php echo ""; ?></title>
<meta http-equiv="Content-Type" content="text/html;" content="text/html; charset=ISO-8859-1">
<?php echo smarty_function_putstyle(array('style' => ""), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onkeydown="return doKeyDown(event);" onunload="window.close();">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
    <!-- El Nombre de la empresa-->
    	<td class="piedefoto">&nbsp;</td>
    	<td class="piedefoto">
    		<div align="right">
    		<a href="javascript:parent.mainFrame.focus();parent.mainFrame.print()"><img src="web/images/imprimir.gif" border="0"></a>
    		</div>
    	</td>
    </tr>
</table>
</body>
</html>