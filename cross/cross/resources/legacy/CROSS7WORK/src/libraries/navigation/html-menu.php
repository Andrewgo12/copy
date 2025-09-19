<?php 
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Richard Heyes <richard@phpguru.org>                          |
// |         Harald Radi <harald.radi@nme.at>                             |
// +----------------------------------------------------------------------+
//
// $Id: TreeMenu.php,v 1.4 2002/06/29 20:08:35 richard Exp $

/**
* HTML_TreeMenu Class
*
* A simple couple of PHP classes and some not so simple
* Jabbascript which produces a tree menu. In IE this menu
* is dynamic, with branches being collapsable. In IE5+ the
* status of the collapsed/open branches persists across page
* refreshes.In any other browser the tree is static. Code is
* based on work of Harald Radi.
*
* Usage.
*
* After installing the package, copy the example php script to
* your servers document root. Also place the TreeMenu.js and the
* images folder in the same place. Running the script should
* then produce the tree.
*
* @author  Richard Heyes <richard@php.net>
* @author  Harald Radi <harald.radi@nme.at>
* @access  public
* @package HTML_TreeMenu
*/

class HTML_TreeMenu {
	/**
	* Indexed array of subnodes
	* @var array
	*/
	var $items;

	/**
	* The layer ID
	* @var string
	*/
	var $layer;

	/**
	* Path to the images
	* @var string
	*/
	var $images;

	/**
	* Name of the object
	* This should not be changed without changing
	* the javascript.
	* @var string
	*/
	var $menuobj;
	
	/**
	* Conntador de los nodos
	* @var integer
	*/
	var $nuCont;

	/**
	* Constructor
	*
	* @access public
	* @param  string $layer          The name of the layer to add the HTML to.
	*                                In browsers that do not support document.all
	*                                or document.getElementById(), document.write()
	*                                is used, and thus this layer name has no effect.
	* @param  string $images         The path to the images folder.
	* @param  string $linkTarget     The target for the link. Defaults to "_self"
	* @param  string $usePersistence Whether to use clientside persistence. This option
	*                                only affects ie5+.
	*/
	function HTML_TreeMenu($layer, $images, $linkTarget = '_self', $usePersistence = false) {
		$this->menuobj = 'objTreeMenu';
		$this->layer = $layer;
		$this->images = $images;
		$this->linkTarget = "central";
		$this->usePersistence = $usePersistence;
		$this->nuCont =0;
	}

	/**
	* This function adds an item to the the tree.
	*
	* @access public
	* @param  object $menu The node to add. This object should be
	*                      a HTML_TreeNode object.
	* @return object       Returns a reference to the new node inside
	*                      the tree.
	*/
	function & addItem($menu) {
		$this->items[$this->nuCont] = $menu;
		$this->nuCont ++;
		return $this->items[($this->nuCont - 1)];
	}

	/**
	* This function prints the menu Jabbascript code. Should
	* be called *AFTER* your layer tag has been printed. In the
	* case of older browsers, eg Navigator 4, The menu HTML will
	* appear where this function is called.
	*
	* @access public
	*/
	function printMenu() {
		settype($nuCant,"integer");
		echo "\n";

		echo '<script language="javascript" type="text/javascript">'."\n\t";
		echo sprintf('%s = new TreeMenu("%s", "%s", "%s", "%s");', $this->menuobj, $this->layer, $this->images, $this->menuobj, $this->linkTarget);

		echo "\n";

		if (isset ($this->items)) {
			$nuCant = count($this->items);
			for ($i = 0; $i < $nuCant; $i ++) {
				$this->items[$i]->_printMenu($this->menuobj.".n[$i]");
			}
		}

		echo sprintf("\n\t%s.drawMenu();", $this->menuobj);
		if ($this->usePersistence) {
			echo sprintf("\n\t%s.resetBranches();", $this->menuobj);
		}
		echo "\n</script>";
	}
	function returnMenu() {
		settype($nuCant,"integer");
		$sbmenu = "\n";

		$sbmenu .= '<script language="javascript" type="text/javascript">'."\n\t";
		$sbmenu .= sprintf('%s = new TreeMenu("%s", "%s", "%s", "%s");', $this->menuobj, $this->layer, $this->images, $this->menuobj, $this->linkTarget);

		$sbmenu .= "\n";

		if (isset ($this->items)) {
			$nuCant = count($this->items);
			for ($i = 0; $i < $nuCant; $i ++) {
				$sbmenu .= $this->items[$i]->_returnMenu($this->menuobj.".n[$i]");
			}
		}

		$sbmenu .= sprintf("\n\t%s.drawMenu();", $this->menuobj);
		if ($this->usePersistence) {
			$sbmenu .= sprintf("\n\t%s.resetBranches();", $this->menuobj);
		}
		$sbmenu .= "\n</script>";
		return $sbmenu;
	}

} // HTML_TreeMenu

/**
* HTML_TreeNode class
* 
* This class is supplementary to the above and provides a way to
* add nodes to the tree. A node can have other nodes added to it. 
*
* @author  Richard Heyes <richard@php.net>
* @author  Harald Radi <harald.radi@nme.at>
* @access  public
* @package HTML_TreeMenu
*/
class HTML_TreeNode {
	/**
	* The text for this node.
	* @var string
	*/
	var $text;

	/**
	* The link for this node.
	* @var string
	*/
	var $link;

	/**
	* The icon for this node.
	* @var string
	*/
	var $icon;

	/**
	* Indexed array of subnodes
	* @var array
	*/
	var $items;

	/**
	* Whether this node is expanded or not
	* @var bool
	*/
	var $expanded;
	
	/**
	* Conntador de los nodos
	* @var integer
	*/
	var $nuCont;
	

	/**
	* Constructor
	*
	* @access public
	* @param  string $text      The description text for this node
	* @param  string $link      The link for the text
	* @param  string $icon      Optional icon to appear to the left of the text
	* @param  bool   $expanded  Whether this node is expanded or not (IE only)
	* @param  bool   $isDynamic Whether this node is dynamic or not (no affect on non-supportive browsers)
	* @param string $isbJs String with the Javascript
	*/
	function HTML_TreeNode($text = null, $link = null, $icon = null, $expanded = false, $isDynamic = true,$isbJs=null) {
		$this->text = (string) $text;
		$this->link = (string) $link;
		$this->icon = (string) $icon;
		$this->expanded = $expanded;
		$this->isDynamic = $isDynamic;
		$this->nuCont=0;
		$this->js = $isbJs;
	}

	/**
	* Adds a new subnode to this node.
	*
	* @access public
	* @param  object $node The new node
	*/
	function & addItem($node) {
		$this->items[$this->nuCont] = $node;
		$this->nuCont ++;
		return $this->items[($this->nuCont - 1)];
	}

	/**
	* Prints jabbascript for this particular node.
	*
	* @access private
	* @param  string $prefix The jabbascript object to assign this node to.
	*/
	function _printMenu($prefix) {
		settype($nuCant,"integer");
		echo sprintf("\t%s = new TreeNode('%s', %s, %s, %s, %s, %s);\n", $prefix, $this->text, !empty ($this->icon) ? "'".$this->icon."'" : 'null', !empty ($this->link) ? "'".$this->link."'" : 'null', $this->expanded ? 'true' : 'false', $this->isDynamic ? 'true' : 'false',!empty ($this->js) ? "'".$this->js."'" : 'null');

		if (!empty ($this->items)) {
			$nuCant = count($this->items);
			for ($i = 0; $i < $nuCant; $i ++) {
				$this->items[$i]->_printMenu($prefix.".n[$i]");
			}
		}
	}
	function _returnMenu($prefix) {
		settype($nuCant,"integer");
		sprintf("\t%s = new TreeNode('%s', %s, %s, %s, %s, %s);\n", $prefix, $this->text, !empty ($this->icon) ? "'".$this->icon."'" : 'null', !empty ($this->link) ? "'".$this->link."'" : 'null', $this->expanded ? 'true' : 'false', $this->isDynamic ? 'true' : 'false',!empty ($this->js) ? "'".$this->js."'" : 'null');

		if (!empty ($this->items)) {
			$nuCant = count($this->items);
			for ($i = 0; $i < $nuCant; $i ++) {
				$this->items[$i]->_returnMenu($prefix.".n[$i]");
			}
		}
	}

}
?>