<?php /* Smarty version 2.6.0, created on 2015-12-26 05:50:16
         compiled from Form_Menu.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Menu.tpl', 2, false),array('block', 'form', 'Form_Menu.tpl', 10, false),array('function', 'hidden', 'Form_Menu.tpl', 21, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
       <title> Menu Principal</title>
       
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body>
<h2>Menu Principal</h2>
<hr>

<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmMenu','method' => 'post')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
 <ul>
  <li><a href="#" onClick="action.value='CmdDefaultEjetematico';frmMenu.submit();">Ejetematico</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultFormulario';frmMenu.submit();">Formulario</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultModeloresp';frmMenu.submit();">Modeloresp</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultPregformula';frmMenu.submit();">Pregformula</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultPregunta';frmMenu.submit();">Pregunta</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultRespuesta';frmMenu.submit();">Respuesta</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultRespuestausu';frmMenu.submit();">Respuestausu</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultTema';frmMenu.submit();">Tema</a><br></li>
</ul>
   <?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</body>
</html>