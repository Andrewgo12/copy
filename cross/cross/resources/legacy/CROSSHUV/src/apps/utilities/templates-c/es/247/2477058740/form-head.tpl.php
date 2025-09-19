<?php /* Smarty version 2.6.0, created on 2020-09-24 15:55:03
         compiled from Form_Head.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Head.tpl', 4, false),array('block', 'form', 'Form_Head.tpl', 13, false),array('function', 'putstyle', 'Form_Head.tpl', 8, false),array('function', 'geturlhelp', 'Form_Head.tpl', 21, false),array('function', 'data_personal', 'Form_Head.tpl', 24, false),array('function', 'set_schema', 'Form_Head.tpl', 28, false),array('function', 'logo_emp', 'Form_Head.tpl', 29, false),array('function', 'hidden', 'Form_Head.tpl', 32, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<title></title>


<?php echo smarty_function_putstyle(array('style' => "head.css"), $this);?>

<?php echo '<script language="javascript" src="web/js/jsrsClient.js" type="text/javascript"></script>
<script language="javascript" src="web/js/jsAccessKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/putFocus.js" type="text/javascript"></script>
<script language="javascript" src="web/js/noMouse.js" type="text/javascript"></script>
<script language="javascript" src="web/js/optionKey.js" type="text/javascript"></script>
<script language="javascript" src="web/js/disableButtons.js" type="text/javascript"></script>
<script language="javascript" src="web/js/cmdExit.js" type="text/javascript"></script>
<script language="javascript" src="web/js/headControl.js" type="text/javascript"></script>
<script language="javascript" src="web/js/prototype/dist/prototype.js" type="text/javascript"></script>
<script language="javascript" src="web/js/fncWindowOpen.js" type="text/javascript"></script>' ?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body>
<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmHead','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="web/images/inicio.barrasuperior_01.png" width="716" height="70">
    	<div id="tools" class="toolsStart">
    		&nbsp;&nbsp;&nbsp;
    		<a href="javascript:controlLeftFrame()"><img src="web/images/IconosCross.arbol.png" width="25" height="25" border="0" title="<?php echo "Ver / Ocultar &aacute;rbol " ?>"></a>&nbsp;
    		<a href="mailto:soporte_fullengine@hotmail.com"><img src="web/images/IconosCross.mensajes.png" width="25" height="25" border="0" title="<?php echo "Contacto " ?>"></a>&nbsp;
    		<a href="#" onClick="<?php echo smarty_function_geturlhelp(array(), $this);?>
"><img src="web/images/IconosCross.manual.png" width="25" height="25" border="0" title="<?php echo "Ayuda " ?>"></a>&nbsp;
    		<a href="#" onClick="jsShowAbout();"><img src="web/images/IconosCross.preguntas.png" width="25" height="25" border="0" title="<?php echo "Acerca de " ?>"></a>&nbsp;
    		<a href="javascript:cmdExit()"><img src="web/images/IconosCross.error.png" width="25" height="25" border="0" title="<?php echo "Salir " ?>"></a>&nbsp;    		
    		<?php echo smarty_function_data_personal(array(), $this);?>

    	<div>
    </td>
    <td  width="300" background="web/images/inicio.barrasuperior_02.png" height="70" >&nbsp;</td>
    <td class="single1" background="web/images/inicio.barrasuperior_02.png" width="487" align="left" valign="bottom" height="70"><?php echo smarty_function_set_schema(array(), $this);?>
</td>
    <?php echo smarty_function_logo_emp(array(), $this);?>

  </tr>
</table>
<?php echo smarty_function_hidden(array('name' => 'action','value' => 'FeGeCmdDefaultHead'), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
</body>
</html>