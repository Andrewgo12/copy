/**
* Propiedad intelectual de FullEngine
*
* recoge los datos del los formatos
* @author creyes
* @date 19-Ago-2006 17:55
* @location Cali-Colombia
*/
function actionFormatoCarta(e){

		var content = {};
    	var editor = dojo.widget.byId("editdiv");
    	var objForm = document.getElementById('frmFormatocarta');
    	var nuMax = objForm.max_length.value;
    	
    	//Recoje los datos de la forma
    	content['action'] = objForm.action.value;
    	content['formatocarta__focacodigos'] = objForm.formatocarta__focacodigos.value;
    	content['formatocarta__focanombres'] = objForm.formatocarta__focanombres.value;
    	content['formatocarta__focaestados'] = objForm.formatocarta__focaestados.value;
        content['formatocarta__focaplantils'] = editor.getEditorContent();
        
        if(content['formatocarta__focaplantils'].length>nuMax){
        	content['formatocarta__focaplantils'] = 'Error_max_length';
        }else{
        	if(content['formatocarta__focaplantils']){
        		content['formatocarta__focaplantils'] = encodeBase64(content['formatocarta__focaplantils']);
        	}
        }
        
        var bindArgs = {
					method: 'POST',
					url: 'index.php',
					content: content,
                    load: onSucessFormatoCarta
				}
        var request = dojo.io.bind(bindArgs);
}

function onSucessFormatoCarta(type, data, evt){
	var result = eval(data);
	var msg = decodeBase64(result[1]);
	
	//Si no hubo exito
	if(result[0] != 3){
		alert(msg);
		enableButtons();
		return;
	}
	alert(msg);
	document.location='index.php?action=FeGeCmdDefaultFormatocarta';
	return;	
}

function editorContent(){
	var editor = dojo.widget.manager.getWidgetById("editdiv");
	return editor.getEditorContent();
}

/**
* Propiedad intelectual de FullEngine
*
* recoge los datos del los formatos
* @author creyes
* @date 19-Ago-2006 17:55
* @location Cali-Colombia
*/
function actionCentroComunicacionCreate(e){

		var content = {};
    	var editor = dojo.widget.manager.getWidgetById("editdiv");
    	
    	//Recoje los datos de la forma
    	content['action'] = document.frmComunicacionCreate.action.value;
    	content['comunicacion__ordenumeros'] = document.frmComunicacionCreate.comunicacion__ordenumeros.value;
    	content['comunicacion__focacodigos'] = document.frmComunicacionCreate.comunicacion__focacodigos.value;
    	content['comunicacion__comuasuntos'] = document.frmComunicacionCreate.comunicacion__comuasuntos.value;
        content['comunicacion__comutextos'] = editor.getEditorContent();
		
        var bindArgs = {
					method: 'POST',
					url: 'index.php',
					content: content,
                    load: onSucessCentroComunicacionCreate
				}
        var request = dojo.io.bind(bindArgs);
}

function onSucessCentroComunicacionCreate(type, data, evt){
	var result = eval(data);
	//Si no hubo exito
	if(result[0] != 3){
		alert(result[1]);
		enableButtons();
		return;
	}
	alert(result[1]);
	if(parent.opener!=null)
        parent.close();
	return;	
}

/**
* Propiedad intelectual de FullEngine
*
* Inserta una etiqueta en el texto
* @author freina
* @date 21-Oct-2004 17:55
* @location Cali-Colombia
*/
function jsPutTagCT() {
	
	var objtmps='';
	var objtmpp='';
	var sbvalue='';
	var nucont=0;
	var nucant=0;
	var newPos = 0;
	
	objtmps = document.getElementById("tags");
	objtmpp = document.getElementById("focaplantils");
	
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
* Refresca las comunicaciones de acuerdo a una consulta
* @author freina
* @date 23-Oct-2004 09:10
* @location Cali-Colombia
*/
function jsRefreshCT(Commandc,Commandl)
{
        var Objecttmpc='';
        var nucontc=0;
        var nucantc=0;
        var nucontl=0;
        var nucantl=0;
        
        nucantc = document.frmComunicacionConsult.length;
        nucantl = parent.listframe.document.frmComunicacionList.length;
        
        for(nucontc=0;nucontc<nucantc;nucontc++){
        	if(document.frmComunicacionConsult.elements[nucontc].type=="text"
        	|| document.frmComunicacionConsult.elements[nucontc].type=="select-one"){
        		Objecttmpc = document.getElementById(document.frmComunicacionConsult.elements[nucontc].id);
        		if(Objecttmpc){
        			for(nucontl=0;nucontl<nucantl;nucontl++){
        		 		if((Objecttmpc.name == parent.listframe.document.frmComunicacionList.elements[nucontl].name) && Objecttmpc.name != "action"){
        		 			parent.listframe.document.frmComunicacionList.elements[nucontl].value = Objecttmpc.value;
        		 		}
        			}
        		}
        	}
        }
   	disableButtons();
   	parent.listframe.document.frmComunicacionList.action.value = Commandl;
	parent.listframe.document.frmComunicacionList.submit();
    document.frmComunicacionConsult.action.value = Commandc;
	document.frmComunicacionConsult.submit();
}
/**
* Propiedad intelectual de FullEngine
*
* previsualiza las comunicaciones
* @author freina
* @date 23-Oct-2004 08:39
* @location Cali-Colombia
*/
function jsPreviewCT(Command,Comucodigos)
{
 	if(Command){
			parent.previewframe.document.frmComunicacionPreview.action.value = Command;
			parent.previewframe.document.frmComunicacionPreview.comunicacion__comucodigos.value = Comucodigos;
			parent.previewframe.document.frmComunicacionPreview.submit();
	}
}
/**
* Propiedad intelectual de FullEngine
*
* elimina las comunicaciones
* @author freina
* @date 25-Oct-2004 09:33
* @location Cali-Colombia
*/
function jsDeleteCT(Command)
{
	var sbresult=false;
 	var objNew= new Object;
 	sbresult=jsSelectCT();
 	
 	if(sbresult && Command){
 		jsPreviewCT('FeGeCmdCentroComunicacionPreview');	
 		parent.listframe.document.frmComunicacionList.action.value = Command;
		parent.listframe.document.frmComunicacionList.submit();
 	}
}
/**
* Propiedad intelectual de FullEngine
*
* Genera las comunicaciones
* @author freina
* @date 25-Oct-2004 17:07
* @location Cali-Colombia
*/
function jsGenerateCT(Command)
{
	var sbresult=false;
	var Objecttmp='';
	var nucont=0;
 	var nucant=0;
 	var sbdata='';
 	nucant = parent.listframe.document.frmComunicacionList.length; 	
 	sbresult=jsSelectCT();
 	
 	if(sbresult && Command){
 		parent.listframe.document.frmComunicacionList.action.value = Command;
		parent.listframe.document.frmComunicacionList.submit();
 	}
}
/**
* Propiedad intelectual de FullEngine
*
* selecciona las comunicaciones
* @author freina
* @date 25-Oct-2004 09:31
* @location Cali-Colombia
*/
function jsSelectCT()
{
	var sbcadena='';
	var nucont=0;
 	var nucant=0;
 	nucant = parent.listframe.document.frmComunicacionList.length;
 
 	for(nucont=0;nucont<nucant;nucont++){
 		if(parent.listframe.document.frmComunicacionList.elements[nucont].type=='checkbox' 
 		&& parent.listframe.document.frmComunicacionList.elements[nucont].checked == true 
 		&& parent.listframe.document.frmComunicacionList.elements[nucont].name != 'checkall'){
 			if(!sbcadena){
 				sbcadena=parent.listframe.document.frmComunicacionList.elements[nucont].value;
	 		}else{
 				sbcadena+=','+parent.listframe.document.frmComunicacionList.elements[nucont].value;
 			}
 		}
 	}
 	if(sbcadena){
 		 parent.listframe.document.frmComunicacionList.selectcheck.value = sbcadena;
 		 return true;
 	}
 	return false;
}
/**
* Propiedad intelectual de FullEngine
*
* crear una nueva comunicacion
* @author freina
* @date 27-Oct-2004 14:38
* @location Cali-Colombia
*/
function jsCreateCT(Command)
{
		var sbordenumeros='';
		var sbfocacodigos='';
		
		sbordenumeros = parent.consultframe.document.frmComunicacionConsult.comunicacion__ordenumeros.value;
		sbfocacodigos = parent.consultframe.document.frmComunicacionConsult.comunicacion__focacodigos.value;
		
		if(sbfocacodigos){
			var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,menubar=0,scrollbars=1,width=750,height=540";
			url ="index.php?action="+Command+"&comunicacion__ordenumeros="+sbordenumeros+"&comunicacion__focacodigos="+sbfocacodigos+"&comunicacion__ordenumerosh="+sbordenumeros;
			win = window.open(url,"new",opciones);
		}else{
			var sbMessage='';
			sbMessage = parent.toolframe.document.frmComunicacionTools.message_66.value;
			alert(sbMessage);
		}
       	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* descarga las comunicaciones
* @author freina
* @date 21-Jun-2005 13:12
* @location Cali-Colombia
*/
function jsDownloadCT(Command){
 	
 	if(Command){
 		var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
		url ="index.php?action="+Command;
		win = window.open(url,"Pdf",opciones);
 	}
 	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* cierra la forma de descarga de las comunicaciones
* @author freina
* @date 21-Jun-2005 13:59
* @location Cali-Colombia
*/
function jsCloseCT(){
	window.close();
}
/**
* Propiedad intelectual de FullEngine
*
* descarga las comunicaciones
* @author freina
* @date 21-Jun-2005 13:12
* @location Cali-Colombia
*/
function jsDownloadFileCT(Path){
 	
 	if(Path){
 		var url='';
 		var opciones="top=40,left=200,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
		url =Path;
		win = window.open(url,"",opciones);
 	}
 	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* carga el editor
* @author freina<freina@parquesoft.com>
* @date 01-Jun-2007 17:16
* @location Cali-Colombia
*/
function setEditorContent(){
	var contentGet = {};
	var objForm = document.getElementById('frmFormatocarta');
    	
    //Recoje los datos de la forma
    if(objForm.formatocarta__focacodigos.value){
    	contentGet['action'] = 'FeGeCmdGetFormatocarta';
    	contentGet['formatocarta__focacodigos'] = objForm.formatocarta__focacodigos.value;
    }else{
    	contentGet['action'] = 'FeGeCmdPutHead';
    }
    var bindArgs = {
		method: 'POST',
		url: 'index.php',
		content: contentGet,
        load: onSucessSetFormatoCarta
	}
    var request = dojo.io.bind(bindArgs);
}
function onSucessSetFormatoCarta(type, data, evt){
	if(data){
		data = decodeBase64(data);
		var editor = dojo.widget.byId("editdiv");
		editor.replaceEditorContent(data);
	}
	return true;	
}
/**
* Propiedad intelectual de FullEngine
*
* Limpia la forma
* @author freina<freina@parquesoft.com>
* @date 04-Jun-2007 17:02
* @location Cali-Colombia
*/
function jsclearForm()
{
	document.location='index.php?action=FeGeCmdDefaultFormatocarta&clean_table=1';
	return;	
}
//================================
/**
* Propiedad intelectual de FullEngine
*
* carga el editor
* @author freina<freina@parquesoft.com>
* @date 01-Jun-2007 17:16
* @location Cali-Colombia
*/
function setEditorContentValue(e){
	var contentGet = {};
	var objForm = document.getElementById('frmComunicacionCreate');
    	
    //Recoje los datos de la forma
    if(!objForm.comunicacion__focacodigos.value){
    	return false;
    }
    contentGet['action'] = 'FeGeCmdCreatetext';
    contentGet['ordenumeros'] = objForm.comunicacion__ordenumeros.value;
    contentGet['focacodigos'] = objForm.comunicacion__focacodigos.value;
        
    var bindArgs = {
		method: 'POST',
		url: 'index.php',
		content: contentGet,
        load: onSucessSetCommunicationtext
	}
    var request = dojo.io.bind(bindArgs);
}
function onSucessSetCommunicationtext(type, data, evt){

	if(data){
		data = decodeBase64(data);
		var editor = dojo.widget.byId("editdiv");
		editor.replaceEditorContent(data);
	}
	return true;	
}
/**
* Propiedad intelectual de FullEngine
*
* Limpia la forma
* @author freina<freina@parquesoft.com>
* @date 06-Jun-2007 17:34
* @location Cali-Colombia
*/
function jsclearCommunicationForm(){

	var objForm = dojo.byId('frmComunicacionCreate');
	var editor = dojo.widget.byId("editdiv");
	
	objForm.comunicacion__ordenumeros.value='';
	objForm.comunicacion__ordenumerosh.value='';
	objForm.comunicacion__focacodigos.value='';
	objForm.comunicacion__comuasuntos.value='';
	
	editor.replaceEditorContent('<p></p>');
	document.location='index.php?action=FeGeCmdCentroComunicacionCreate';
	return;	
}
/**
* Propiedad intelectual de FullEngine
*
* recoge los datos del los formatos
* @author creyes
* @date 19-Ago-2006 17:55
* @location Cali-Colombia
*/
function actionCommunication(e){

		var content = {};
    	var editor = dojo.widget.byId("editdiv");
    	var objForm = document.getElementById('frmComunicacionCreate');
    	var nuMax = objForm.max_length.value;
    	
    	//Recoje los datos de la forma
    	content['action'] = objForm.action.value;
    	content['comunicacion__ordenumeros'] = objForm.comunicacion__ordenumeros.value;
    	content['comunicacion__comuasuntos'] = objForm.comunicacion__comuasuntos.value;
    	content['comunicacion__focacodigos'] = objForm.comunicacion__focacodigos.value;
        content['comunicacion__comutextos'] = editor.getEditorContent();
        
        if(content['comunicacion__comutextos'].length>nuMax){
        	content['comunicacion__comutextos'] = 'Error_max_length';
        }else{
        	if(content['comunicacion__comutextos']){
        		content['comunicacion__comutextos'] = encodeBase64(content['comunicacion__comutextos']);
        	}
        }
        
        var bindArgs = {
					method: 'POST',
					url: 'index.php',
					content: content,
                    load: onSucessCommunication
				}
        var request = dojo.io.bind(bindArgs);
}
function onSucessCommunication(type, data, evt){
	var result = eval(data);
	var msg = decodeBase64(result[1]);
	
	//Si no hubo exito
	if(result[0] != 3){
		alert(msg);
		enableButtons();
		return;
	}
	alert(msg);
	document.location='index.php?action=FeGeCmdCentroComunicacionCreate';
	return;	
}