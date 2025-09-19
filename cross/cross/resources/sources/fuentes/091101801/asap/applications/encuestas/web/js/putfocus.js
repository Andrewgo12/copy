/**
*	Propiedad Intelectual de FullEngine
*	
*	Pone el foco en el primer elemento de la forma
*	
*	@author creyes <cesar.reyes@parquesoft.com>
*	@date 24-ago-2004 16:54:48
*	@location Cali-Colombia
*/
function putFocus(nameObj){
	nutamano = document.forms[0].length;
	nuCont=0;
	for(nuCont=0;nuCont<document.forms[0].length;nuCont++){
		if(nameObj) {
			alert(document.forms[0].elements[nuCont].name +" = "+nameObj);
			if(document.forms[0].elements[nuCont].name == nameObj) {
				document.forms[0].elements[nuCont].focus();
				break;
			}
		}
		if(document.forms[0].elements[nuCont].type == "text" ||
		document.forms[0].elements[nuCont].type == "select-one" ||
		document.forms[0].elements[nuCont].type == "radio" ||
			document.forms[0].elements[nuCont].type == "button" ||
		document.forms[0].elements[nuCont].type == "checkbox"){
			document.forms[0].elements[nuCont].focus();
		break;
		}
	}
}
