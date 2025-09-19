<?php /* Smarty version 2.6.0, created on 2017-06-16 22:04:27
         compiled from Form_Menu.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Menu.tpl', 2, false),array('block', 'form', 'Form_Menu.tpl', 10, false),array('function', 'hidden', 'Form_Menu.tpl', 14, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
       <title> Menu Principal</title>
       
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>
<body>
<h2>Menu Principal</h2>
<hr>

<?php $_params = $this->_tag_stack[] = array('form', array('name' => 'frmMenu','method' => 'get')); smarty_block_form($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
 <ul>
  <li><a href="#" onClick="action.value='CmdDefaultEstadoproces';frmMenu.submit();">Estadoproces</a><br></li>
</ul>
   <?php echo smarty_function_hidden(array('name' => 'action','value' => ""), $this);?>

<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

</body>
</html>