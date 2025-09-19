/**
*   Propiedad intelectual del FullEngine.
*	
*	Recarga la forma
*       @param sbValue valor con el cual se recargara la forma
*	@author freina
*	@date 04-Ago-2005 15:40 
*	@location Cali-Colombia
*/
function LoadValue(sbValue){

        if(sbValue){
            document.frmTreeHelp.valor.value = sbValue;
            document.frmTreeHelp.submit();
        }else{
        	document.frmTreeHelp.valor.value = '';
            document.frmTreeHelp.submit();
        }
}
/**
*   Propiedad intelectual del FullEngine.
*	
*	Carga el value selecionado a el opener.obj 
*	@param array  
*	@author creyes
*	@date 17-Jun-2004 11:59
*	@Update 05-Feb-2007 17:32 
*	@location Cali-Colombia
*/
function PutValue(nameobj,valor){

	var rcObj = new Array();
	var nuForm = 0;
	var nuCant = 0;
	var nuCont = 0;
	
	if(nameobj.indexOf(',')!=-1){
		rcObj = nameobj.split(',');
		nameobj = rcObj[1];
		
		nuCant = parent.opener.document.forms.length;
		for(nuCont=0;nuCont<nuCant;nuCont++){
			if(parent.opener.document.forms[nuCont].name==rcObj[0]){
				nuForm=nuCont;
				break;
			}
		}
	}
			
	nuCant = parent.opener.document.forms[nuForm].elements.length;
	for(nuCont=0;nuCont<nuCant;nuCont++)
	{
		if(parent.opener.document.forms[nuForm].elements[nuCont])
			if(parent.opener.document.forms[nuForm].elements[nuCont].name)
			{
				var rcName = parent.opener.document.forms[nuForm].elements[nuCont].name.split("__");
				if(parent.opener.document.forms[nuForm].elements[nuCont].name == nameobj || rcName[1] == nameobj)
				{
					parent.opener.document.forms[nuForm].elements[nuCont].value = valor;
					parent.opener.document.forms[nuForm].elements[nuCont].focus();
					parent.opener.document.forms[nuForm].elements[nuCont].blur();
					parent.opener.document.forms[nuForm].elements[nuCont].focus();
					break;
				}
			}
	}
	parent.close();
}