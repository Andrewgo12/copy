/**
*	Propiedad Intelectual de FullEngine
*	
*	Busca todos los objetos tipo button,reset y submit de una forma y los 
*	deshabilita
*	
*	@author creyes <cesar.reyes@parquesoft.com>
*	@date 08-sep-2004 12:02:48
*	@location Cali-Colombia
*/

 function disableButtons(){
 	var nuForms = document.forms.length;
	var nuElements = 0;
	var nuContF = 0;
	var nuContE = 0;
	//Recorre los formularios
	for(nuContF;nuContF<nuForms;nuContF++){
		nuElements = document.forms[nuContF].length;
		for(nuContE;nuContE<nuElements;nuContE++){
			if(document.forms[nuContF].elements[nuContE].type == "button" ||
				document.forms[nuContF].elements[nuContE].type == "reset" ||
				document.forms[nuContF].elements[nuContE].type == "submit"){
				document.forms[nuContF].elements[nuContE].disabled = true;
			}
		}
	}
	return ;
 }

/**
*	Propiedad Intelectual de FullEngine
*	
*	Busca todos los objetos tipo button,reset y submit de una forma y los 
*	habilita
*	
*	@author creyes <cesar.reyes@parquesoft.com>
*	@date 1-September-2005 13:56:33
*	@location Cali-Colombia
*/

 function enableButtons(){
 	var nuForms = document.forms.length;
	var nuElements = 0;
	var nuContF = 0;
	var nuContE = 0;
	//Recorre los formularios
	for(nuContF;nuContF<nuForms;nuContF++){
		nuElements = document.forms[nuContF].length;
		for(nuContE;nuContE<nuElements;nuContE++){
			if(document.forms[nuContF].elements[nuContE].type == "button" ||
				document.forms[nuContF].elements[nuContE].type == "reset" ||
				document.forms[nuContF].elements[nuContE].type == "submit"){
                if(document.forms[nuContF].elements[nuContE].disabled == true)
                    document.forms[nuContF].elements[nuContE].disabled = false;
			}
		}
	}
	return ;
 }