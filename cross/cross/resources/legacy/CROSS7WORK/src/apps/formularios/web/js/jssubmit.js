/**
*	Propiedad Intelectual de FullEngine
*	
*	Cierra una ventana emergete
*	
*	@date 11-Aug-2005 11:07
*	@location Cali-Colombia
*/
function jsSubmit(command,name){
	document.forms[name].action.value=command;
	document.forms[name].submit();
}