/*
Function           :       doKeyDown
Description        :       Utiliza las teclas F#
Author             :       Carlos Zapata
Date               :       30-may-2002
Last Update        :       30-may-2002
Last Update        :       15-Jan-2007
Author             :       freina
*/
function doKeyDown(e)
{
	var myKeyCode  = e.keyCode;
	var sbBrowser='';
	var sbType='';
	var sbreadOnly='';
	sbBrowser=jsBrowser();
	
	//Para las teclas Function(F1,F2.....F12) 
	if(myKeyCode >= 112 && myKeyCode <= 123){
		if(sbBrowser=='IE'){
			AnnulEventIE(e);
		}else{
			if(sbBrowser=='NS'){
				AnnulEventNE(e);
			}else{
				if(sbBrowser=='MOZ'){
					AnnulEventMOZ(e);
				}
			}
		}
		return false;
	}
	
	if(sbBrowser=='IE'){
		sbType = e.srcElement.type;
		sbreadOnly = e.srcElement.readOnly;
	}else{
		if(sbBrowser=='NS' || sbBrowser=='MOZ'){
			sbType = e.target.type;
			sbreadOnly = e.target.readOnly;
		}
	}
	
	//Para el backspace
	if(myKeyCode == 8 && sbType != "text" && sbType != "textarea" && sbType != "password"){
		if(sbBrowser=='IE'){
			AnnulEventIE(e);
		}
		else{
			if(sbBrowser=='NS'){
				AnnulEventNE(e);
			}else{
				if(sbBrowser=='MOZ'){
					AnnulEventMOZ(e);
				}
			}
		}
		return false;
	}else if(sbType == "text"){
	
		if (sbreadOnly == true){
			if(sbBrowser=='IE'){
			AnnulEventIE(e);
			}
			else{
				if(sbBrowser=='NS'){
					AnnulEventNE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
			}
			return false;			
		}
	}
	
	if(sbBrowser=='IE'|| sbBrowser=='MOZ'){
			
		if(e.ctrlKey){
		
			if(e.keyCode==8 && !sbType) {
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
		
			if (e.keyCode==78 || e.keyCode==104 || e.keyCode==85){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			//Para ctrl l
			if(e.keyCode==76){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			 //Para ctrl a
			if(e.keyCode==65){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			 //Para ctrl h
			if(e.keyCode==72){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			 //Para ctrl o
			if(e.keyCode==79){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			 //Para ctrl i
			if(e.keyCode==73){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			 //Para ctrl r
			if(e.keyCode==82){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}
			 //Para ctrl q
			/*if(e.keyCode==81){
				if(sbBrowser=='IE'){
					AnnulEventIE(e);
				}else{
					if(sbBrowser=='MOZ'){
						AnnulEventMOZ(e);
					}
				}
				return false;
			}*/
			if(e.keyCode==83 && sbBrowser=='MOZ'){
				AnnulEventMOZ(e);
			}
		}
	}else{
		if(sbBrowser=='NS'){
			if(e.CONTROL_MASK){
		
				if(e.keyCode==8 && !sbType) {
					return false;
				}
			
				if (e.keyCode==78 || e.keyCode==104 || e.keyCode==85){
					return false;
				}
				//Para ctrl l
				if(e.keyCode==76){
					return false;
				}
				//Para ctrl a
				if(e.keyCode==65){
					return false;
				}
				//Para ctrl h
				if(e.keyCode==72){
					return false;
				}
			 	//Para ctrl o
				if(e.keyCode==79){
					AnnulEventNE(e);
					return false;
				}
			 	//Para ctrl i
				if(e.keyCode==73){
					return false;
				}
			 	//Para ctrl r
				if(e.keyCode==82){
					return false;
				}
				//Para ctrl q
				/*if(e.keyCode==81){
					return false;
				}*/
			}
		}
	}
}
/*
Function           :       AnnulEventIE
Description        :       Anula el evento en Explorer
Author             :       freina
Date               :       11-11-2004
*/
function AnnulEventIE(e){
	e.keyCode = 0;
	e.returnValue = false;
	e.cancelBubble = true;
}
/*
Function              :       AnnulEventNE
Description          :       Anula el evento en Nestcape
Author                 :       freina
Date                    :       11-11-2004
*/
function AnnulEventNE(e){
	e.keyCode = 505;
	e.preventDefault();
	e.stopPropagation();
}
/*
Function           :       AnnulEventMOZ
Description        :       Anula el evento en Firefox
Author             :       freina
Date        	   :       15-Jan-2007
*/
function AnnulEventMOZ(e){
	e.preventDefault();
	e.stopPropagation();
}
/*
Function              :       fncEnterkey
Description          :       Returns the next field
Author                 :       Carlos Zapata
Date                    :       21-may-2002
Last Update        :       21-may-2002
*/
function fnEnterkey(form,field)
{
	var next=0, found=false;
	var f=form;
	
	if(event.keyCode!=13) return;
	
	for(var i=0;i<f.length;i++){
		if(field.name==f.item(i).name){
			next=i+1;
			found=true
			break;
		}
	}
	
	//Infinite loop
	while(found)  {
		if( f.item(next).disabled==false 
		&&  (f.item(next).type=="text" 
		|| f.item(next).type=="select-one")){
			f.item(next).focus();
			break;
		}else{
			if(next<f.length-1)
			next=next+1;
			else
			break;
		}
	}
}

function abrirPdf(path)
{
	var newwindow='';
	//newwindow = window.open('web/plugins/download.php?path='+path,'nueva_vantana','');
	newwindow = window.open(path,'nueva_vantana','');
}
/**
* Propiedad intelectual de FullEngine
*
* determina el navegador
* @author freina
* @date 15-Jan-2007 11:46
* @location Cali-Colombia
*/
function jsBrowser(){
  if (document.layers) return "NS";
  if (document.all) {
		// But is it really IE?
		// convert all characters to lowercase to simplify testing
		var agt=navigator.userAgent.toLowerCase();
		var is_opera = (agt.indexOf("opera") != -1);
		var is_konq = (agt.indexOf("konqueror") != -1);
		if(is_opera) {
			return "OPR";
		} else {
			if(is_konq) {
				return "KONQ";
			} else {
				// Really is IE
				return "IE";
			}
		}
  }
  if (document.getElementById) return "MOZ";
  return "OTHER";
}