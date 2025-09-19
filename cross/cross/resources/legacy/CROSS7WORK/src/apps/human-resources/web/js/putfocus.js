/**
*	Propiedad Intelectual de FullEngine
*	
*	Pone el foco en el primer elemento de la forma
*	
*	@author creyes <cesar.reyes@parquesoft.com>
*	@date 24-ago-2004 16:54:48
*	@location Cali-Colombia
*/
function putFocus(){
	var nutamano = document.forms[0].length;
	var nuCont=0;
	var sbName='';
	//se pregunta si existe el objeto  focusposition
	if(document.forms[0].focusposition){
		if(document.forms[0].focusposition.value !=''){
			sbName = document.forms[0].focusposition.value;
		}
	} 
	for(nuCont=0;nuCont<document.forms[0].length;nuCont++){
		if((document.forms[0].elements[nuCont].type == "text" ||
		document.forms[0].elements[nuCont].type == "select-one" ||
		document.forms[0].elements[nuCont].type == "radio" ||
		document.forms[0].elements[nuCont].type == "checkbox" ||
		document.forms[0].elements[nuCont].type == "file")
		&& document.forms[0].elements[nuCont].disabled==false){
			if(document.forms[0].elements[nuCont].type == "text"){
				if(document.forms[0].elements[nuCont].readOnly==false){
					if(sbName){
						if(document.forms[0].elements[nuCont].name==sbName){
							document.forms[0].elements[nuCont].focus();
							break;
						}
					}else{
						document.forms[0].elements[nuCont].focus();
						break;
					}
				}
			}else{
				if(sbName){
					if(document.forms[0].elements[nuCont].name==sbName){
						document.forms[0].elements[nuCont].focus();
						break;
					}
				}else{
					document.forms[0].elements[nuCont].focus();
					break;
				}
			}
		}
	}
}