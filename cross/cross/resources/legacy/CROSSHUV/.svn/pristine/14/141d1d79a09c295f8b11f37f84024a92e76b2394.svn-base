/**
* Propiedad intelectual de FullEngine
*
* Inserta una etiqueta en el texto
* @author freina
* @date 21-Oct-2004 17:55
* @location Cali-Colombia
*/
function jsPutTagCE(sbIdTag,sbId) {
	
	var objtmps='';
	var objtmpp='';
	var sbvalue='';
	var nucont=0;
	var nucant=0;
	var newPos = 0;
	
	objtmps = document.getElementById(sbIdTag);
	objtmpp = document.getElementById(sbId);
	
	nucant = objtmps.options.length;
    for (nucont = 0; nucont < nucant; nucont++){
    	if (objtmps.options[nucont].selected){
    		sbvalue=objtmps.options[nucont].value;
    		break;
    	}
    }
	if(sbvalue){
		sbvalue = " <"+sbvalue+">";
	}
	
	if(!sbvalue){
			return true;
	}
	
	//IE support
	if (document.selection) {
		objtmpp.focus();
		sel = document.selection.createRange();
		sel.text = sbvalue;
	}
	//MOZILLA/NETSCAPE support
	else{
		if (objtmpp.selectionStart || objtmpp.selectionStart == '0') {
			var startPos = objtmpp.selectionStart;
			var endPos = objtmpp.selectionEnd;
			objtmpp.value = objtmpp.value.substring(0, startPos) + sbvalue + objtmpp.value.substring(endPos, objtmpp.value.length);
			newPos = endPos + sbvalue.length;
		} else {
			objtmpp.value += sbvalue;
			newPos = objtmpp.value.length;
		}
		objtmpp.focus();
		objtmpp.setSelectionRange(newPos, newPos);
	}
}
/**
* Propiedad intelectual de FullEngine
*
* Envia los e-mail
* @author freina
* @date 11-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsSendCE(Command)
{
	var sbresult=false;
	var Objecttmp='';
	var nucont=0;
 	var nucant=0;
 	nucant = parent.listframe.document.frmEmailList.length; 	
 	sbresult=jsSelectCE();
 	
 	if(sbresult && Command){
 		/*for(nucont=0;nucont<nucant;nucont++){
 			Objecttmp = parent.listframe.document.getElementById(parent.listframe.document.frmEmailList.elements[nucont].id);
 			if(Objecttmp){
 				if(Objecttmp.type=='hidden' && Objecttmp.name != 'selectcheck'){
 					Objecttmp.value='';
 				}
 			}
 		}*/
 		parent.listframe.document.frmEmailList.action.value = Command;
		parent.listframe.document.frmEmailList.submit();
 	}
}
/**
* Propiedad intelectual de FullEngine
*
* Genera los e-mail
* @author freina
* @date 11-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsGenerateCE(Command)
{
        var Objecttmpc='';
        var Objecttmpl='';
        var nucontc=0;
        var nucantc=0;
        var nucontl=0;
        var nucantl=0;
        
        nucantc = parent.consultframe.document.frmEmailConsult.length;
        nucantl = parent.listframe.document.frmEmailList.length;
        
        for(nucontc=0;nucontc<nucantc;nucontc++){
        	for(nucontl=0;nucontl<nucantl;nucontl++){
        		 if((parent.consultframe.document.frmEmailConsult.elements[nucontc].name ==  parent.listframe.document.frmEmailList.elements[nucontl].name) 
        		 && parent.consultframe.document.frmEmailConsult.elements[nucontc].name != "action"){
        		 	parent.listframe.document.frmEmailList.elements[nucontl].value = parent.consultframe.document.frmEmailConsult.elements[nucontc].value;
        		 }	
        	}
        }
	   	disableButtons();
   	   	parent.listframe.document.frmEmailList.action.value = Command;
	  	parent.listframe.document.frmEmailList.submit();
}
/**
* Propiedad intelectual de FullEngine
*
* crear los e-mail
* @author freina
* @date 11-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsCreateCE(Command)
{
		var sbordenumeros='';
		var sbfoemcodigos='';
		
		sbordenumeros = parent.consultframe.document.frmEmailConsult.email__ordenumeros.value;
		sbfoemcodigos = parent.consultframe.document.frmEmailConsult.email__foemcodigos.value;
		
		if(sbordenumeros){
			var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,menubar=0,scrollbars=1,width=750,height=540";
			url ="index.php?action="+Command+"&ordenumeros="+sbordenumeros+"&foemcodigos="+sbfoemcodigos;
			win = window.open(url,"new",opciones);
		}
}
/**
* Propiedad intelectual de FullEngine
*
* elimina los e-mail
* @author freina
* @date 11-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsDeleteCE(Command)
{
	var sbresult=false;
	var Objecttmp='';
	var nucont=0;
 	var nucant=0;
 	nucant = parent.listframe.document.frmEmailList.length; 	
 	sbresult=jsSelectCE();
 	
 	if(sbresult && Command){
 		/*for(nucont=0;nucont<nucant;nucont++){
 			Objecttmp = parent.listframe.document.getElementById(parent.listframe.document.frmEmailList.elements[nucont].id);
 			if(Objecttmp){
 				if(Objecttmp.type=='hidden' && Objecttmp.name != 'selectcheck'){
 					Objecttmp.value='';
 				}
 			}
 		}*/
 		parent.listframe.document.frmEmailList.action.value = Command;
		parent.listframe.document.frmEmailList.submit();
 	}
}
/**
* Propiedad intelectual de FullEngine
*
* Refresca los e-mail de acuerdo a una consulta
* @author freina
* @date 11-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsRefreshCE(Commandc,Commandl)
{
        var Objecttmpc='';
        var nucontc=0;
        var nucantc=0;
        var nucontl=0;
        var nucantl=0;
        
        nucantc = document.frmEmailConsult.length;
        nucantl = parent.listframe.document.frmEmailList.length;
        
        for(nucontc=0;nucontc<nucantc;nucontc++){
        	if(document.frmEmailConsult.elements[nucontc].type=="text"
        	|| document.frmEmailConsult.elements[nucontc].type=="select-one"){
        		Objecttmpc = document.getElementById(document.frmEmailConsult.elements[nucontc].id);
        		if(Objecttmpc){
        			for(nucontl=0;nucontl<nucantl;nucontl++){
        		 		if((Objecttmpc.name == parent.listframe.document.frmEmailList.elements[nucontl].name) && Objecttmpc.name != "action"){
        		 			parent.listframe.document.frmEmailList.elements[nucontl].value = Objecttmpc.value;
        		 		}
        			}
        		}
        	}
        }
   	disableButtons();
   	parent.listframe.document.frmEmailList.action.value = Commandl;
	parent.listframe.document.frmEmailList.submit();
   document.frmEmailConsult.action.value = Commandc;
	document.frmEmailConsult.submit();
}
/**
* Propiedad intelectual de FullEngine
*
* previsualiza los e-mail
* @author freina
* @date 12-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsPreviewCE(Command,Emaicodigos)
{
 if(Command && Emaicodigos){
			parent.previewframe.document.frmEmailPreview.action.value = Command;
			parent.previewframe.document.frmEmailPreview.email__emaicodigos.value = Emaicodigos;
			parent.previewframe.document.frmEmailPreview.submit();
	}
}
/**
* Propiedad intelectual de FullEngine
*
* selecciona los e-mail
* @author freina
* @date 13-Oct-2004 07:28
* @location Cali-Colombia
*/
function jsSelectCE()
{
	var sbcadena='';
	var nucont=0;
 	var nucant=0;
 	nucant = parent.listframe.document.frmEmailList.length;
 
 	for(nucont=0;nucont<nucant;nucont++){
 		if(parent.listframe.document.frmEmailList.elements[nucont].type=='checkbox' 
 		&& parent.listframe.document.frmEmailList.elements[nucont].checked == true 
 		&& parent.listframe.document.frmEmailList.elements[nucont].name != 'checkall'){
 			if(!sbcadena){
 				sbcadena=parent.listframe.document.frmEmailList.elements[nucont].value;
	 		}else{
 				sbcadena+=','+parent.listframe.document.frmEmailList.elements[nucont].value;
 			}
 		}
 	}
 	if(sbcadena){
 		 parent.listframe.document.frmEmailList.selectcheck.value = sbcadena;
 		 return true;
 	}
 	return false;
}