<?php
class FePrXmlProfileManager {

	var $xmlDocument;
	var $dom;
	function FePrXmlProfileManager() {
		return true;
	}
	/*** @Copyright 2004  FullEngine
	 *
	 * Genera el archivo xml del perfil
	 * @param string $profcodigos
	 * @param array $rcPerfiles
	 * @return boolean
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 21-dic-2004 16:43:19
	 * @location Cali - Colombia
	 */
	function xmlFile($profcodigos, $rcPerfiles){

		settype($rcValue,"array");

		if (!is_array($rcPerfiles))
		return false;
		$this->dom = new DOMDocument('1.0');
		$this->dom->formatOutput = true;

		//Crea el elemento principal
		$root = $this->dom->createElement("profile");
		$title = $this->dom->createElement("title");
		$title->appendChild($this->dom->createTextNode("profile"));
		$root->appendChild($title);

		//Crea todos los objetos
		foreach ($rcPerfiles as $key => $sbTmp) {
			$rcTmp = explode("|", $sbTmp);
			if(!(strpos($rcTmp[3],"___")===false)){
				$rcValue = explode("___",$rcTmp[3]);
				$rcTmp[3] = $rcValue[0];
				$rcTmp[4] = $rcValue[1];
			}
			$rcXmlObject[$rcTmp[0]] = array ("element" => $this->getElement($rcTmp), "parent" => $rcTmp[2]);
		}
		//Toma los objetos y los asocia a su padre
		if(is_array($rcXmlObject)){
			foreach ($rcXmlObject as $key => $rcTmp) {
				if ($rcTmp["parent"])
				$rcXmlObject[$rcTmp["parent"]]["element"]->appendChild($rcTmp["element"]);
				else
				$root->appendChild($rcTmp["element"]);
			}
		}
		//Arma el documento
		$this->dom->appendChild($root);
		$this->xmlDocument = $this->dom->saveXML();
		unset($rcXmlObject);
		unset($this->dom);
		unset($root);
		unset($rcPerfiles);
		return $this->fileXml($profcodigos);
	}
	/*** @Copyright 2004  FullEngine
	 *
	 * crea un elemento del xml
	 * @param object $dom
	 * @return object $element
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 21-dic-2004 16:55:50
	 * @location Cali - Colombia
	 */
	function getElement($rcData) {
		$element = $this->dom->createElement("action");
		$name = $this->dom->createElement("name");
		$type = $this->dom->createElement("type");
		if(isset($rcData[4]) && $rcData[4]){
			$icon = $this->dom->createElement("icon");
		}
		$name->appendChild($this->dom->createTextNode($rcData[0]));
		$type->appendChild($this->dom->createTextNode($rcData[3]));
		if(isset($rcData[4]) && $rcData[4]){
			$icon->appendChild($this->dom->createTextNode($rcData[4]));
		}
		$element->appendChild($name);
		$element->appendChild($type);
		if(isset($rcData[4]) && $rcData[4]){
			$element->appendChild($icon);
		}
		return $element;
	}
	/*** @Copyright 2004  FullEngine
	 *
	 * Crea el archivo con el documento xml del perfil
	 * @param string $profcodigos
	 * @return boolean
	 * @author creyes <cesar.reyes@parquesoft.com>
	 * @date 22-dic-2004 9:39:03
	 * @location Cali - Colombia
	 */
	function fileXml($profcodigos)
	{
		if (!$this->xmlDocument)
		return false;
			
		//Path del modulo
		$sbpath = Application :: getBaseDirectory();

		//Path del Xml
		$sbpathXml = "$sbpath/config/profiles/$profcodigos.xml";
		$file = fopen($sbpathXml, "w");
		fwrite($file, $this->xmlDocument);
		fclose($file);
		return true;
	}
	function unsetXmlProfile($profcodigos)
	{
		//Path del modulo
		$sbpath = Application :: getBaseDirectory()."/config/profiles/$profcodigos.xml";
		if(is_file($sbpath))
		unlink($sbpath);
		return true;
	}
}
?>