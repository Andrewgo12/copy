<?php
/**
 * @copyright Copyright 2007 Parquesoft
 * Paquete de clases para la construccion de objetos HTML
 */ 

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del objetos html select
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */ 
class htmlSelect{
	
	var $id;
	var $name;
	var $options = array();
	var $firstNull = true;
	var $labelFirstNull = '';
	var $selected;
	var $multiple;
	var $onchange;
	var $onblur;
	var $onfocus;
	var $autoreference = false;
	var $valueField;
	var $labelField;
	var $sqlid;
	var $requiredmsg; 
	var $required;
	var $helptxt; 
	var $_html = array();
	
	function generate(){
		if(!$this->id)
			return null;
		
		if($this->multiple)
			$this->firstNull = false;
			
		$multiple = $this->multiple?'multiple="true"':null;
		$size = $this->multiple?'size="'.$this->multiple.'"':null;
				
		//Define los eventos
		$onchange = $this->onchange?'onchange="'.$this->onchange.'"':null;
		$onblur = $this->onblur?'onblur="'.$this->onblur.'"':null;
		$onfocus = $this->onfocus?'onfocus="'.$this->onfocus.'"':null;
		$required = $this->required?'required="'.$this->required.'"':null;
		
		$class = $this->required?'class="requiredInput"':null;
		$requiredmsg = $this->requiredmsg?'requiredmsg="'.$this->requiredmsg.'"':null;
		
		if($this->autoreference){
			$idTxt = 'search_'.$this->id;
			$htmlInput = new htmlInput;
			$htmlInput->id = $idTxt;
			$htmlInput->class = 'inputsmall';
			//si se desea que el campo sea nulo
			if(!$this->is_null){
				$htmlInput->value = $this->selected? $this->selected : '';	
			}
			$this->_html[] = $htmlInput->generate();
			
			$this->_html[] = '<script type="text/javascript">' .
						'var combo_'.$this->id.' = document.getElementById(\''.$idTxt.'\');
						 combo_'.$this->id.'.onblur = function (){
												gw("'.$idTxt.'", "'.$this->id.'", "'.$this->sqlid.'", "'.$this->valueField.'", "'.$this->labelField.'", "'.$this->adicParamName.'");
											};
						' .
					'</script>';			
		}
		$this->_html[] = '<select name="'.$this->name.'" id="'.$this->id.'" '.$required.' '.$requiredmsg.' '.$class.' '.$multiple.' '.$size.' '.$onchange.' '.$onblur.' '.$onblur.'>';
		
		//Genera las opciones
		$this->_options();

		$this->_html[] = '</select>';
 		//Pinta la ayuda del campo
 		$img = new htmlImage;
		$img->src = 'help.png';
		$img->alt = $this->helptxt;
		$this->_html[] = $img->generate();
		
		return implode("\n", $this->_html);
	}
	
	function _options(){
		if($this->firstNull)
			$this->_html[] = '<option value="">'.$this->labelFirstNull.'</option>';
		if(!is_array($this->options))
			return true;
		
		if(!is_array($this->selected))
			$this->selected = explode(",", $this->selected);
		
		foreach($this->options as $option){
			//Asume que la primera columna es el valor y la segunda el label
			$keys = array_keys($option);
			$value = $option[$keys[0]];
			$label = $option[$keys[1]];			
			if(in_array($value, $this->selected))
				$selected = 'selected="selected"';
			$this->_html[] = '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
			$selected = null;
		}
		return true;
	}
	
}//End class

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del objetos html para el llamado de archivos javascript
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlJsFiles{
	var $fileName;
	function generate(){
		if(!$this->fileName)
			return null;
		return '<script language="javascript" src="'.$this->fileName.'" type="text/javascript"></script>';
	}
	
	function generateCssFile(){
		if(!$this->fileName)
			return null;
		return '<link href="' . $this->fileName . '" rel="stylesheet" type="text/css">';	
	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para el llamado de archivos css
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlCssFiles{
	var $fileName;
	function generate(){
		if(!$this->fileName)
			return null;
		return '<link href="'.$this->fileName.'" rel="stylesheet" type="text/css" />';
	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del tag <html> del documento html bajo la version xhtml v1.1 w3c
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlHtmlDocument{
	var $charset; //UTF-8, Para compatibilidad con "Latin 1" use (i.e. US-ACSII, ISO-8859-1, ISO-8859-15 o  Windows 1252)
	var $lang; //es us ... etc	
	var $content; //Contenido
	
	function generate(){
		
		$this->lang = strtolower(substr($this->lang, 0, 2));
		$this->_html[] = '<?xml version="1.0" encoding="'.$this->charset.'"?>';
		$this->_html[] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
		$this->_html[] = '<html version="xhtml 1.1" ' .
								'xml:lang="'.$this->lang.'" ' .
								'xmlns="http://www.w3.org/1999/xhtml" ' .
								'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
								'xsi:schemaLocation="http://www.w3.org/MarkUp/SCHEMA/xhtml11.xsd" ' .
								'lang="'.$this->lang.'">';
		$this->_html[] = '	'.$this->content;
		$this->_html[] = '</html>';
		return implode("\n", $this->_html);
	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del head del documento html
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlHeadDocument{
	var $charset; //UTF-8, Para compatibilidad con "Latin 1" use (i.e. US-ACSII, ISO-8859-1, ISO-8859-1 o  Windows 1252)
	var $content; //Contenido
	
	function generate(){
		$this->_html[] = '<head>';
		$this->_html[] = '	<meta http-equiv="Content-Type" content="text/html; charset='.$this->charset.'" />';
		$this->_html[] = '	'.$this->content;
		$this->_html[] = '</head>';
		return implode("\n", $this->_html);
	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del tag <html> del documento html
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
 class htmlHref{
 	var $href;
 	var $id;
 	var $onclick;
 	var $title;
 	var $content;
 	
 	function generate(){
		
		if(!$this->id || !$this->title || !$this->content)
			return null;
			
		$href = isset($this->href)?'href="'.$this->href.'"':'href="#"';
		$onclick = isset($this->onclick)?'onclick="'.$this->onclick.'"':null;
		
		$this->title = htmlentities($this->title);
		
		$this->_html[] = '<a id="'.$this->id .'" '.$href.' '.$onclick.' title="'.$this->title.'" alt="'.$this->title.'">';
		$this->_html[] = $this->content;
		$this->_html[] = "</a>\n";
	 	return implode($this->_html);	
 	}
 }

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del tag <image> del documento html
 * Asume que las imagenes estan el web/images
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
 class htmlImage{
 	var $src;
 	var $id;
 	var $border;
 	var $width;
 	var $height;
 	var $onclick;
 	var $align;
 	var $alt;
 	
 	function generate(){
		
		if(!$this->src || !$this->alt)
			return null;
			
		$id = isset($this->id)?'id="'.$this->id.'"':null;
		$border= isset($this->border)?'border="'.$this->border.'"':'border="0"';
		$width = isset($this->width)?'width="'.$this->width.'"':null;
		$height = isset($this->height)?'onclick="'.$this->height.'"':null;
		$onclick = isset($this->onclick)?'onclick="'.$this->onclick.'"':null;
		$align = isset($this->align)?'align="'.$this->align.'"':'align="absmiddle"';
		
		//$this->alt = htmlentities($this->alt);
		
		return '<img src="web/images/'.$this->src.'" '.$id.' '.$border.' '.$onclick.' '.$width.' '.$height.' '.$align.' title="'.$this->alt.'" alt="'.$this->alt.'" />';
 	}
 }
 
/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de un input tipos text, hidden, password, file
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlInput{
	var $type = 'text'; //Tipo del objeto text, hidden, password, file
	var $name; // Nombre del objeto html
	var $id; // Id del objeto html, si se omite se asume como id el mismo name (opcional)
	var $size; // Tama�o visual (opcional)
	var $maxlength; // Maxima cantidad de caracteres permitidos (opcional)
	var $disabled;// Indica si esta deshabilitado (opcional)
	var $readonly; //Indica si es de solo lectura
	var $value; // Valor inicial (opcional)
	var $onblur; // Cadena js que se ejecutara en este evento (opcional)
	var $onchange ; // Cadena js que se ejecutara en este evento (opcional)
	var $onclick; // Cadena js que se ejecutara en este evento (opcional)
	var $tabindex; //{int} Indica el order del campo al TAB del usuario (opcional aunque muy importante)
	var $required; //Indica si es requerido
	var $invalidmsg; //Mensaje que se muestra cuando el valor del campo no pasa la validacion regexp
	var $requiredmsg; //Mensaje que se muestra cuando el campo es requerido
	var $regexp; //Expresion regular que determina el formato del campo
	var $helptxt; //Texto para el tooltip de ayuda del campo
		
 	function generate(){
 		
 		$type = $this->type;
 		
 		//genera las cadenas html de cada atributo
 		$this->renderAttr();

 		//Genera el imput
 		$this->_html[] = '<input';
 		$this->renderInput();
 		$this->_html[] = '/>';
 		
 		//Pinta la ayuda del campo
 		if($type != 'hidden'){
	 		$img = new htmlImage;
			$img->src = 'help.png';
			$img->alt = $this->helptxt;
			$this->_html[] = $img->generate();
 		}
 		
		return implode(' ', $this->_html); 		
 	}
 	
 	function renderInput(){
 		
 		$vars = get_object_vars($this);
 		foreach($vars as $name => $value){
 			if($name != '_html' && $value)
 				$this->_html[] = $value;
 		}
		return true; 		
 	}
 	function renderAttr(){
 
  		//Si es requerido
 		if($this->required == 'true')
 			$this->class = 'requiredInput';
 		
 		$vars = get_object_vars($this);
 		foreach($vars as $name => $value){
 			if($name != '_html' && $name != 'helptxt')
 				$this->$name = $value?$name.'="'.$value.'"':null;
 		}
 		return true;	
 	}
}


/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de un input type="text" para fechas
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlInputCalendar extends htmlInput{
	var $altImgCal; //Cadena para el alt de la imagen del calendario
	
	function generate(){

		$this->readonly = 'true';
		$this->type = "text";

 		//Pinta la ayuda del campo
 		$imgH = new htmlImage;
		$imgH->src = 'help.png';
		$imgH->alt = $this->helptxt;
		
 		$img = new htmlImage;
		$img->src = 'icon_minicalendar.gif';
		$img->alt = $this->altImgCal;
		$img->onclick = "makeCalendar('".$this->id."')";
		$div = '<div id="dhtmlxCal_'.$this->id.'" style="position:absolute;"></div>';
		
 		//genera las cadenas html de cada atributo
 		$this->renderAttr();
 		//Genera el imput
 		$this->_html[] = '<input';
 		$this->renderInput();
 		$this->_html[] = '/>';
 		$this->_html[] = $img->generate();
 		$this->_html[] = $imgH->generate();
 		$this->_html[] = $div;
		
		return implode(' ', $this->_html);		
	}
	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de un textarea
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmltextarea{
	var $name;
	var $id;
	var $rows;
	var $cols;
	var $wrap;	
	var $onchange;
	var $onfocus;
	var $onblur;
	var $style;
	var $content;
	var $required;
	var $invalidmsg; //Mensaje para cuando el formato en regexp no es valido
	var $requiredmsg; //Mensaje para cuando el es requierido
	var $regexp;
	var $helptxt;
	var $_html;
	
	function generate(){
				
		//Verifica el id
		$this->id = $this->id?$this->id:$this->name;
		
		$attr[] = 'name="'.$this->name.'"';
		$attr[] = 'id="'.$this->id.'"';
		$attr[] = $this->rows?'rows="'.$this->rows.'"':'rows="5"';
		$attr[] = $this->cols?'cols="'.$this->cols.'"':'cols="20"';
		$attr[] = $this->wrap?'wrap="'.$this->wrap.'"':'wrap="ON"';		
		$attr[] = $this->onchange?'onchange="'.$this->onchange.'"':null;
		$attr[] = $this->onfocus?'onfocus="'.$this->onfocus.'"':null;
		$attr[] = $this->onblur?'onblur="'.$this->onblur.'"':null;
		$attr[] = $this->style?'style="'.$this->style.'"':null;
		$attr[] = $this->onchange?'onchange="'.$this->onchange.'"':null;
		$attr[] = $this->required?'required="true" class="requiredInput"':null;
		$attr[] = $this->requiredmsg?'requiredmsg="'.$this->requiredmsg.'"':null;
		$attr[] = $this->regexp?'regexp="'.$this->regexp.'"':null;
		$attr[] = $this->invalidmsg?'invalidmsg="'.$this->invalidmsg.'"':null;
		
		$attributes = implode(' ', $attr);
		$this->_html[] = '<textarea '.$attributes.'>';
		$this->_html[] = $this->content;
		$this->_html[] = '</textarea>';

 		//Pinta la ayuda del campo
 		$img = new htmlImage;
		$img->src = 'help.png';
		$img->alt = $this->helptxt;
		$this->_html[] = $img->generate();
		
		return implode($this->_html);
	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de la configuracion de dojo
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmldojoconfig{
	var $libPath;
	var $isDebug = 'false';
	var $content;
	var $locale;
	var $theme;
	
	function generate(){
		$this->_html[] = '<style type="text/css">';
		$this->_html[] = '	@import "'.$this->libPath.'/dojo/dijit/themes/'.$this->theme.'/'.$this->theme.'.css";';
		//$this->_html[] = '	@import "'.$this->libPath.'/dojo/dojo/resources/dojo.css"';
		$this->_html[] = '</style>';
		$this->_html[] = '<script type="text/javascript" src="'.$this->libPath.'/dojo/dojo/dojo.js"';
		$this->_html[] = 'djConfig="parseOnLoad: true, isDebug: '.$this->isDebug.', usePlainJson: true, locale: \''.$this->locale.'\'">';
		$this->_html[] = '</script>';
		$this->_html[] = '<script type="text/javascript">';
		$this->_html[] = $this->content;
		$this->_html[] = '</script>';
		return implode("\n", $this->_html);
	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion del tag <body>
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlbody{
	//Standard Attributes: id, class, title, style, dir, lang
	var $id;
	var $class;
	var $style;
	var $title;
	var $dir;
	var $lang;
	//Event Attributes: onload, onunload, onclick, ondblclick, onmousedown, onmouseup, 
						//onmouseover, onmousemove, onmouseout, onkeypress, onkeydown, onkeyup
	var $onload;
	var $onunload;
	var $onclick;
	var $ondblclick;
	var $onmousedown;
	var $onmouseup;
	var $onmouseover;
	var $onmousemove;
	var $onmouseout;
	var $onkeypress;
	var $onkeydown;
	var $onkeyup;

	var $content;
	var $_html;
	
	function generate(){
		
		$this->_html[] = '<body';
		$this->_renderAttr();
		$this->_html[] = '>';
		$this->_html[] = "\n".$this->content."\n";
		$this->_html[] = '</body>';
		return implode(' ', $this->_html);
	}

 	function _renderAttr(){
 		$vars = get_object_vars($this);
 		foreach($vars as $name => $value){
 			if($name != '_html' && $value && $name != 'content')
 				$this->_html[] = $name.'="'.$value.'"';
 		}
 		return true;	
 	}
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de boton
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlbutton{
	var $content;
	var $_html;
	
	function generate(){
		
		$this->_html[] = '<button';
		$this->_renderAttr();
		$this->_html[] = '>';
		$this->_html[] = "\n".$this->content."\n";
		$this->_html[] = '</button>';
		return implode(' ', $this->_html);
	}

 	function _renderAttr(){
 		$vars = get_object_vars($this);
 		foreach($vars as $name => $value){
 			if($name != '_html' && $value && $name != 'content')
 				$this->_html[] = $name.'="'.$value.'"';
 		}
 		return true;	
 	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de la configuracion para el calendario xhtmlCalendar
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlcalendarconfig{
	var $libPath;
	var $jsPath;
	var $locale;
	var $langConf;
	function generate(){
	      
		$this->_html[] = '<script>';
		$this->_html[] = 'window.dhx_globalImgPath="'.$this->libPath.'/dhtmlxSuite/dhtmlxCalendar/codebase/imgs/";';
		$this->_html[] = 'var locale = "'.$this->locale.'";';
		$this->_html[] = 'var dhtmlxCalendarLangModules = new Array();';
		$this->_html[] = 'dhtmlxCalendarLangModules[\''.$this->locale.'\'] = '.$this->langConf.';';
		$this->_html[] = '</script>';
		$this->_html[] = '<link rel="STYLESHEET" type="text/css" href="'.$this->libPath.'/dhtmlxSuite/dhtmlxCalendar/codebase/dhtmlxcalendar.css">';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxCalendar/codebase/dhtmlxcommon.js"></script>';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxCalendar/codebase/dhtmlxcalendar.js"></script>';
		$htmlJsFiles = new htmlJsFiles;
		$htmlJsFiles->fileName = $this->jsPath.'/CalendarControl.js';
		$this->_html[] = $htmlJsFiles->generate();
		return implode("\n", $this->_html);
	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del objetos html form
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlform{
	var $id;
	var $name;
	var $action;
	var $method;
	var $enctype;
	var $target;
	var $content;
	
	function generate(){
		
		$this->_html[] = '<form';
		$this->_renderAttr();
		$this->_html[] = '>';
		$this->_html[] = "\n".$this->content."\n";
		$this->_html[] = '</form>';
		return implode(' ', $this->_html);
	}

 	function _renderAttr(){
 		$vars = get_object_vars($this);
 		foreach($vars as $name => $value){
 			if($name != '_html' && $value && $name != 'content')
 				$this->_html[] = $name.'="'.$value.'"';
 		}
 		return true;	
 	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion del objetos html table
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmltable{
	var $width;
	var $border = 0;
	var $align = 'center';
	var $cellpadding = 1;
	var $cellspacing = 1;
	var $class;
	var $content;
	
	function generate(){
		
		$this->_html[] = '<table';
		$this->_renderAttr();
		$this->_html[] = '>';
		$this->_html[] = "\n".$this->content."\n";
		$this->_html[] = '</table>';
		return implode(' ', $this->_html);
	}

 	function _renderAttr(){
 		$vars = get_object_vars($this);
 		foreach($vars as $name => $value){
 			if($name != '_html' && $value && $name != 'content')
 				$this->_html[] = $name.'="'.$value.'"';
 		}
 		return true;	
 	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * 
 * Clase para construccion un mensaje html en pantalla
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
 class htmlmsg{
 	var $msg;
 	var $icon;
 	var $iconalt;
 	
 	function generate(){
 		
 		$htmltable = new htmltable;
 		$htmltable->width = "80%";
 		$htmltable->align = "center";
 		
 		$content[] = '<tr>';
 		$content[] = '<td width="8%">';
 		//Pinta el icono
 		$img = new htmlImage;
		$img->src = $this->icon;
		$img->alt = $this->iconalt;
		$content[] = $img->generate();
 		$content[] = '</td>';
 		
 		$content[] = '<td width="92%">';
 		$content[] = $this->msg;
 		$content[] = '</td>';
 		$content[] = '</tr>';
 		
 		$htmltable->content = implode("\n", $content);
 		return $htmltable->generate();
 	}
 }

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de la configuracion para las ventanas dhtmlxwindows
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlwindowconfig{
	var $libPath;
	var $jsPath;
	var $maxwindows;
	var $msgmaxwindow;
	var $windowstyle;
	function generate(){
	      
		$this->_html[] = '<script type="text/javascript">';
		$this->_html[] = 'var maxwindows = '.$this->maxwindows.';';
		$this->_html[] = 'var msgmaxwindows = "'.$this->msgmaxwindow.'";';
		$this->_html[] = 'var windowstyle = "'.$this->windowstyle.'";';
		$this->_html[] = '</script>';
		$this->_html[] = '<link rel="STYLESHEET" type="text/css" href="'.$this->libPath.'/dhtmlxSuite/dhtmlxWindows/codebase/dhtmlxwindows.css">';
		$this->_html[] = '<link rel="STYLESHEET" type="text/css" href="'.$this->libPath.'/dhtmlxSuite/dhtmlxWindows/codebase/skins/dhtmlxwindows_'.$this->windowstyle.'.css">';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxWindows/codebase/dhtmlxcommon.js"></script>';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxWindows/codebase/dhtmlxwindows.js"></script>';
		$htmlJsFiles = new htmlJsFiles;
		$htmlJsFiles->fileName = $this->jsPath.'/WindowControl.js';
		$this->_html[] = $htmlJsFiles->generate();
		return implode("\n", $this->_html);
	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion un objeto de arbol
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlTree{
	var $name;
	var $id;
	var $sqlid;
	var $idfield;
	var $lblfield;
	var $parentfield;
	var $idstart;
	var $required;
	var $requiredmsg;
	var $invalidmsg;
	var $size;
	var $altImgTree;
	
	function generate(){
		//Textfield a mostrar
		$idLabel = $this->id."_label";
		$txtLbl = new htmlInput;
		$txtLbl->name = '__'.$this->name;
		$txtLbl->id = $idLabel;
		$txtLbl->type = 'text';
		$txtLbl->size = $this->size;
		$txtLbl->required = $this->required;
		$txtLbl->requiredmsg = $this->requiredmsg;
		$txtLbl->invalidmsg = $this->invalidmsg;
		$txtLbl->readonly = 'false';
		
		//hidden
		$txtId = new htmlInput;
		$txtId->name = $this->name;
		$txtId->id = $this->id;
		$txtId->type = 'hidden';
		$txtId->required = $this->required;
		$txtLbl->requiredmsg = $this->requiredmsg;
		$txtLbl->invalidmsg = $this->invalidmsg;
		
 		//Pinta la ayuda del campo
 		$imgH = new htmlImage;
		$imgH->src = 'help.png';
		$imgH->alt = $this->helptxt;
		
 		$img = new htmlImage;
		$img->src = 'icon_minitree.gif';
		$img->alt = $this->altImgTree;
		$img->onclick = "makeTree('".$this->id."', '".$this->sqlid."', '".$this->idfield."', '".$this->lblfield."', '".$this->parentfield."', '".$this->idstart."')";
		$div = '<div id="dhtmlxTree_'.$this->id.'" class="treeboxinput"></div><script type="text/javascript">showHide(\'dhtmlxTree_'.$this->id.'\');</script>';
		
 		$this->_html[] = $txtLbl->generate();
 		$this->_html[] = $txtId->generate();
 		$this->_html[] = $img->generate();
 		$this->_html[] = $imgH->generate();
 		$this->_html[] = $div;
		return implode("\n", $this->_html);
		
	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de la configuracion para el arbol xhtmlTree
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmltreeconfig{
	var $libPath;
	var $jsPath;
	function generate(){
	      
		$this->_html[] = '<link rel="STYLESHEET" type="text/css" href="'.$this->libPath.'/dhtmlxSuite/dhtmlxTree/codebase/dhtmlxtree.css">';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxTree/codebase/dhtmlxcommon.js"></script>';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxTree/codebase/dhtmlxtree.js"></script>';
		$htmlJsFiles = new htmlJsFiles;
		$htmlJsFiles->fileName = $this->jsPath.'/TreeControl.js';
		$this->_html[] = $htmlJsFiles->generate();
		return implode("\n", $this->_html);
	}	
}

/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion de la configuracion para la grilla
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlxgridconfig{
	var $libPath;
	var $jsPath;
	function generate(){
	      
		$this->_html[] = '<link rel="STYLESHEET" type="text/css" href="'.$this->libPath.'/dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgrid.css">';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>';
		$this->_html[] = '<script  src="'.$this->libPath.'/dhtmlxSuite/dhtmlxGrid/codebase/excells/dhtmlxgrid_excell_link.js"></script>';
		return implode("\n", $this->_html);
	}	
}


/**
 * @copyright Copyright 2007 Parquesoft
 * Clase para construccion un objeto de arbol para el select entes
 * 
 * @author Cesar Reyes<careyes@parquesoft.com>
 * @version 1.0
 * @package html
 */
class htmlTreeSelectentes{
	var $name;
	var $id;
	var $required;
	var $requiredmsg;
	var $invalidmsg;
	var $altImgTree;
	var $perscodigos;
	
	function generate(){
		//Textfield a mostrar
		$idLabel = $this->id."_label";
		$txtLbl = new htmlInput;
		$txtLbl->name = '__'.$this->name;
		$txtLbl->id = $idLabel;
		$txtLbl->type = 'text';
		$txtLbl->size = $this->size;
		$txtLbl->required = $this->required;
		$txtLbl->requiredmsg = $this->requiredmsg;
		$txtLbl->invalidmsg = $this->invalidmsg;
		$txtLbl->readonly = 'true';
		
		//hidden
		$txtId = new htmlInput;
		$txtId->name = $this->name;
		$txtId->id = $this->id;
		$txtId->type = 'hidden';
		$txtId->required = $this->required;
		$txtLbl->requiredmsg = $this->requiredmsg;
		$txtLbl->invalidmsg = $this->invalidmsg;
		
 		//Pinta la ayuda del campo
 		$imgH = new htmlImage;
		$imgH->src = 'help.png';
		$imgH->alt = $this->helptxt;
		
 		$img = new htmlImage;
		$img->src = 'icon_minitree.gif';
		$img->alt = $this->altImgTree;
		$img->onclick = "makeTreeSelectentes('".$this->id."', '".$this->perscodigos."')";
		$div = '<div id="dhtmlxTree_'.$this->id.'" style="background-color:#f5f5f5;display:none; width:250; height:218; border :1px solid Silver; overflow:auto; position:absolute;"></div>';
		
 		$this->_html[] = $txtLbl->generate();
 		$this->_html[] = $txtId->generate();
 		$this->_html[] = $img->generate();
 		$this->_html[] = $imgH->generate();
 		$this->_html[] = $div;
		return implode("\n", $this->_html);
		
	}	
}

class htmlcard {
	
	//Borde de la tabla
	var $border;
	//columnas de la ficha
	var $cols;
	//Tamanho en % del td de la etiqueta
	var $size_label;
	//Tamanho en % de la tabla
	var $size_table;
	//Tamanho en % de la celda con la data
	var $size_data;
	//Tamanho en % de la celda con los :
	var $size_puntos;
	//Si quiere tener sus dos puntos
	var $puntos;
	//datos
	var $rcDatos;
	//labels
	var $rcLabels;
	
	/**
	* @copyright Copyright 2008 &copy; FullEngine
	*
	*  Toma un vector unidimensional con indices asociativos y retorna la cadena con el
	*  Html de una ficha  
	* @author freina <freina@parquesoft.com>
	* @date 17-sep-2008 14:24
	* @version 1.0
 	* @package html
	*/
	function generate() {

		settype($rcHtml, "array");
		settype($rcCard, "array");
		settype($rcReg, "array");
		settype($sbPorColum, "string");
		settype($sbPorFin, "string");
		settype($sbPorcenaje, "string");
		settype($sbHtml, "string");
		settype($sbKey, "string");
		settype($sbValue, "string");
		settype($nuColumns, "integer");
		settype($nuTamCol, "float");
		settype($nuTamColFin, "float");
		settype($nuCont, "integer");

		//se determinan los porcentajes de la celdas
		$nuColumns = (int) $this->cols;
		if (fmod($nuColumns, 2) == 0) {
			$nuTamCol = 100 / $nuColumns;
			$sbPorColum = (string) $nuTamCol;
			$sbPorColum = $sbPorColum."%";
			$sbPorFin = $sbPorColum;
		} else {
			$nuTamCol = 100 / $nuColumns;
			$nuTamCol = floor($nuTamCol);
			$nuTamColFin = 100 - ($nuTamCol * $nuColumns);
			$sbPorColum = (string) $nuTamCol;
			$sbPorColum = $sbPorColum."%";
			$sbPorFin = (string) $nuTamColFin;
			$sbPorFin = $sbPorFin."%";
		}

		if (!is_array($this->rcDatos) || !$this->rcDatos){
			return $sbHtml;
		}
			
		if (!$this->cols){
			$this->cols = 1;
		}
			
		if (!$this->border){
			$this->border = 0;
		}
			
		if (!$this->size_table){
			$this->size_table = "";
		}
			
		if (!$this->size_label){
			$this->size_label = "";
		}
			
		if (!$this->size_data){
			$this->size_data = "";
		}
			
		if (!$this->puntos){
			$this->puntos = ":";
		}
			
		if (!$this->align){
			$this->align = "center";
		}
			
		if (!$this->size_datos) {
			$this->size_datos = "";
		}
		
		//Divide la matriz en las columnas
		$rcCard = array_chunk($this->rcDatos, $nuColumns, true);
		$rcHtml[] = "<table border='".$this->border."' width='".$this->size_table."' align='".$this->align."'>";
		foreach ($rcCard as $rcReg) {
			$nuCont = 0;
			$rcHtml[] = "<tr>";
			foreach ($rcReg as $sbKey => $sbValue) {

				if ($nuCont == $nuColumns) {
					$sbPorcenaje = $sbPorColum;
				} else {
					$sbPorcenaje = $sbPorFin;
				}

				if ($this->rcLabels[$sbKey]) {
					
					if($sbValue==null || $sbValue==""){
						$sbValue = "&nbsp;";
					}
					$rcHtml[] = "<td valign=top width='".$sbPorcenaje."' style=\"border : 1px solid #999; height: 100%;\">";
					$rcHtml[] = "	<table width='".$this->size_data."' border=0>";
					$rcHtml[] = "		<tr>";
					$rcHtml[] = "			<td width='".$this->size_label."' valign=top><strong>".$this->rcLabels[$sbKey]."</strong></td>";
					$rcHtml[] = "           <td width='".$this->size_puntos."' valign=top>".$this->puntos."</td>";
					$rcHtml[] = "			<td width='".$this->size_datos."'>".$sbValue."</td>";
					$rcHtml[] = "		</tr>";
					$rcHtml[] = "	</table>";
					$rcHtml[] = "</td>";
				}
				$nuCont ++;
			}
			$rcHtml[] = "</tr>";
		}
		$rcHtml[] = "</table>";
		$sbHtml = implode("", $rcHtml);
		return $sbHtml;
	}
}

?>