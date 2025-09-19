/**
*   Propiedad intelectual del FullEngine.
*	
*	Abre una ventana para pintar la lista de ayuda de las tablas
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/
function fncopenlst_help(table,view_fields,field_return,jsobjget)
{
	var opciones="scrollbars=yes,left=200,top=100,width=700,height=500,resizable=YES";
	url = "index.php?action=CmdLstHelp&table="+table+"&view_fields="+view_fields+"&field_return="+field_return+"&jsobjget="+jsobjget;
	win = window.open(url,"LstHelp",opciones);
}
/**
*   Propiedad intelectual del FullEngine.
*	
*	Carga el value selecionado a el opener.obj 
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59 
*	@location Cali-Colombia
*/
function fncloadvalue(valor,nameobj)
{
	
	var nuobj = opener.document.forms[0].elements.length;
	for(cont=0;cont<nuobj;cont++)
		if(opener.document.forms[0].elements[cont].name == nameobj)
		{
			opener.document.forms[0].elements[cont].value = valor;
			opener.document.forms[0].elements[cont].focus();
			opener.document.forms[0].elements[cont + 1].focus();
			break;
		}
	this.close();
}
