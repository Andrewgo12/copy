<?php /* Smarty version 2.6.0, created on 2017-04-25 16:39:44
         compiled from Form_TreeHelp.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'head', 'Form_TreeHelp.tpl', 2, false),array('function', 'tree_frame', 'Form_TreeHelp.tpl', 8, false),)), $this); ?>
<html>
   <?php $_params = $this->_tag_stack[] = array('head', array()); smarty_block_head($_params[1], null, $this, $_block_repeat=true); unset($_params);while ($_block_repeat) { ob_start(); ?>
      <title>
         Cross
     </title>
     
   <?php $this->_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_head($this->_tag_stack[count($this->_tag_stack)-1][1], $this->_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  echo smarty_function_tree_frame(array('frame_principal' => "../general/index.php?action=FeGeCmdTreeHelp"), $this);?>

</html>