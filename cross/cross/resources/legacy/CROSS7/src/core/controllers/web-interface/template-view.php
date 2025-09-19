<?php

require_once "WebRequest.class.php";
require_once "Smarty.class.php";

class TemplateView {

    var $template;
    var $compile_dir = "templates_c";

    function TemplateView($template) {
        $this->template = $template;
    }
    
    function show() {
		
        // get a template engine object
        $obj =& TemplateView::getTemplateEngine();

        //Set file permissions
        $obj->_file_perms = 0777;
        $obj->_dir_perms = 0777;
        
        // assign the variables to the template engine
        $obj->assign(WebRequest::getParameterList());
        
        // set the plugins directories
        // must use Smarty > 2.6.0
        $obj->plugins_dir = array (
            Application::getPluginsDirectory(),
            ASAP::getPluginsDirectory(),
            'plugins'
            );
  
        // load the template
        $obj->template_dir = Application::getTemplatesDirectory();
        
        //Obtiene los parametros del usuario
		$rcUser = Application::getUserParam();
		
		if(!is_array($rcUser)){
			//Si no existe usuario en sesion 
			$rcUser["lang"] = Application::getSingleLang();
		}

		$obj->compile_dir = $this->compile_dir."/".$rcUser["lang"];
		if(!is_dir($obj->compile_dir))
			mkdir($obj->compile_dir);
        $obj->display($this->template);
    }

    function &getTemplateEngine(){

        // there is a previously created engine object ??
        $obj =& ASAP::getStaticProperty('Template', 'engine');

        // create the smarty object
        if (!isset($obj) || !is_object($obj)) {
            $obj = new Smarty();
        }
        
        return $obj;
    }

}
?>