function add_record( lista, new_name, new_value ) 
{
	var dummy = new Array; 
	var i; 
	for (i=0; i<lista.length;i++) { 
 		if ((lista.options[i].text == new_name)&& (lista.options[i].value ==new_value )) 
    		return; 
 	} 
	for (i=0; i<lista.length;i++) { 
  		dummy[i] = new Array; 
  		dummy[i][0] = lista.options[i].text; 
  		dummy[i][1] = lista.options[i].value; 
 	}
 	for (i=dummy.length; i>0;i--) 
  		lista.options[i] = null; 
 	lista.length= 0;
 	for (i=0; i<dummy.length; i++) {
  		lista.options[i] = new Option(dummy[i][0],dummy[i][1]);
 	}
 	lista.options[i] = new Option(new_name, new_value);
 	lista.length = dummy.length + 1;	
}


function delete_record( lista, indice ) 
{
	var dummy = new Array;
 	var i;
 	for (i=0; i<lista.length;i++) 
  		if (i < indice) {
   			dummy[i] = new Array;
   			dummy[i][0] = lista.options[i].text;
   			dummy[i][1] = lista.options[i].value;
  	}else if (i > indice)  {
     		dummy[i-1] = new Array;
     		dummy[i-1][0] = lista.options[i].text;
     		dummy[i-1][1] = lista.options[i].value;
   	}
 	for (i=lista.length; i>0;i--)
  	lista.options[i] = null;
 	lista.length= 0;
 	for (i=0; i<dummy.length; i++) {
  		lista.options[i] = new Option(dummy[i][0],dummy[i][1]);	
 	}
 	lista.length = dummy.length;
}
function setSelected(selectedElements,nameElement,flag){
	
	nuReg = selectedElements.length;
	if(nuReg == 0){
		selectedElements[0] = nameElement;
		return selectedElements;
	}
	for(var i=0; i < nuReg; i++ ){
		if(selectedElements[i] == nameElement){
			if(flag == false)
				selectedElements.splice(i,1);
			return selectedElements;
		}
	}
	selectedElements.push(nameElement);
	return selectedElements;
}
function selectParents(list,nameElement,path,selectedElements){
	if(!selectedElements.value || selectedElements.value == ""){
		rcSelectedElements = setSelected(new Array,nameElement,false);
		flag = false;
	}else{
		rcSelectedElements = selectedElements.value.split(",");
		flag = inArray(nameElement, rcSelectedElements);
		rcSelectedElements = setSelected(rcSelectedElements,nameElement,false);
	}
	if(flag == false){ //Si no esta selecionado
		arrayOfParents = path.split("/");
		//Seleciona los papas
	 	for ( var i=0; i < list.options.length; i++ ){
	 		rcTmp = list.options[i].value.split("|");
	 		if(inArray(rcTmp[0], arrayOfParents)){
	   			list.options[i].selected = true;
	   			rcSelectedElements = setSelected(rcSelectedElements,rcTmp[0],true);
	   		}
	 	}
	 	//Selecciona los hijos
	 	for ( var i=0; i < list.options.length; i++ ){
	 		rcTmp = list.options[i].value.split("|");
	 		rcPath = rcTmp[1].split("/");
	 		if(inArray(nameElement, rcPath)){
	   			list.options[i].selected = true;
	   			rcSelectedElements = setSelected(rcSelectedElements,rcTmp[0],true);
	   		}
	 	}
 	}else{
	 	//Deselecciona los hijos
	 	for ( var i=0; i < list.options.length; i++ ){
	 		rcTmp = list.options[i].value.split("|");
	 		rcPath = rcTmp[1].split("/");
	 		
	 		if(inArray(nameElement, rcPath)){
	   			list.options[i].selected = false;
	   			if(rcTmp[0] != nameElement){
	   				if(inArray(rcTmp[0], rcSelectedElements) == true)
	   					rcSelectedElements = setSelected(rcSelectedElements,rcTmp[0],false);
	   			}
	   		}
	 	}
 	}
 	//Reseleciona los elementos 
 	for ( var i=0; i < list.options.length; i++ ){
 		rcTmp = list.options[i].value.split("|");
 		if(inArray(rcTmp[0], rcSelectedElements)){
   			list.options[i].selected = true;
   		}
 	}
 	selectedElements.value = rcSelectedElements.join(",");
}
//busca el elemento selecionado
function findSelected(list){
 	for (var i=0; i < list.options.length; i++ ){
		if(list.options[i].selected == true){
			break;
		}
 	}
 	rcObjeto = rcTmp = list.options[i].value.split("|");
 	return rcObjeto;
}
//Si el elemento existe en el array
function inArray(valor, arreglo){
 	for ( var i=0; i < arreglo.length; i++ ){
 		if(arreglo[i] == valor)
 			return true;
 	}
 	return false;
}
function selectAllOptions( list ){
 	if (list.options.length==0) { 
  	 	return false; 
 	}
 	//found.fieldsofselect.value = "";
 	for ( var i=0; i < list.options.length; i++ ){
   		list.options[ i ].selected = true;
   		if ( i==0 || i == list.options.length ){ c=""; } else { 
   			c=","; 
   		}
  	 	//found.fieldsofselect.value = found.fieldsofselect.value + c + list.options[ i ].value;
 	}
 	return true;
}

var DELIMITER = ';';
var deleteList = new Array;
var counterArray=0;

function transferTo( lstOrigen, lstDestino ){
 var idServicio, textServicio;
 if (lstOrigen.options.selectedIndex == -1) {
  return;
 }
 for (var i = 0; i < lstOrigen.options.length; i++) {
  if (lstOrigen.options[i].selected) {
  	//Valida que no exista en la lista destino
  	if(isExist(lstDestino,lstOrigen.options[i].value) == false){
   		idServicio   = lstOrigen.options[i].value;
    	textServicio = lstOrigen.options[i].text;
    	arrayOfStrings = idServicio.split(";");
    	add_record( lstDestino, textServicio, idServicio ); 
    }
  }
 }
}
/**Elimina una opcion*/
function deleteOption(lstOrigen){
	if (lstOrigen.options.selectedIndex == -1) {
		return;
	}
	 for (var i = 0; i < lstOrigen.options.length; i++) {
	 	if (lstOrigen.options[i].selected)
			add_to_deleteList (lstOrigen,i);
	}
	delete_list(lstOrigen);
}
/*Verifica si un elemento existe en la lista*/
function isExist(lstOrigen,valor){
	for (var i = 0; i < lstOrigen.options.length; i++) {
		if(lstOrigen.options[i].value == valor)
			return true;
	}
	return false;
}
function add_to_deleteList (lstOrigen,i) {
  deleteList[counterArray]=lstOrigen.options[i].value;
  counterArray=counterArray+1;
}
function delete_list(lstOrigen) {
  for (var counter=0; counter<counterArray; counter++) {
    for (var counter2=0; counter2<lstOrigen.options.length; counter2++) {
      if (deleteList[counter]==lstOrigen.options[counter2].value) {
        delete_record( lstOrigen,counter2);
      }
    }
  }
  counterArray=0;
  deleteList= new Array;
}
function transferAll(lstOrigen, lstDestino ){
  while (lstOrigen.options.length > 0) {
    lstOrigen.options.selectedIndex = 0;
    transferTo( lstOrigen, lstDestino );
  }
}

function extractselect(lstDestino,objDestino,objForm,objAction,action){
	var nuReg = lstDestino.options.length;
	var rcOpt = new Array();
	var cont = 0;
	for(nuCont=0;nuCont<nuReg;nuCont++){
		if (lstDestino.options[nuCont].selected){
			rcOpt[cont] = lstDestino.options[nuCont].value;
			cont++;
		}
	}
	objDestino.value = rcOpt.join(',');
	objAction.value = action;
	objForm.submit();
	return true;
}