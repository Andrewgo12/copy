<?php /* Smarty version 2.6.0, created on 2020-09-22 19:24:05
         compiled from Form_Fichas.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_Fichas.tpl', 2, false),array('function', 'appname', 'Form_Fichas.tpl', 3, false),array('function', 'frameficha', 'Form_Fichas.tpl', 6, false),)), $this); ?>
<html>
<?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title><?php echo smarty_function_appname(array(), $this);?>
</title>
      
<?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_frameficha(array(), $this);?>

</html>