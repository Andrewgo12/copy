/**
*   Propiedad intelectual del FullEngine.
*	
*	Carga el value selecionado a el opener.obj 
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/
function fncputvalue(nameobj,valor)
{
	var nuobj = opener.document.forms[0].elements.length;
	for(cont=0;cont<nuobj;cont++)
		if(opener.document.forms[0].elements[cont].name == nameobj)
		{
			opener.document.forms[0].elements[cont].value = valor;
			opener.document.forms[0].elements[cont].focus();
			opener.document.forms[0].elements[cont + 1].focus();
			//opener.document.forms[0].elements[cont + 2].focus();
			break;
		}
	this.close();
}
