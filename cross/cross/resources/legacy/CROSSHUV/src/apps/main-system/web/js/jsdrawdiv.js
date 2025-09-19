/**
* Propiedad intelectual de FullEngine
*
* Muestra o esconde un div 
* @author freina
* @date 20-May-2005 20:20
* @location Cali-Colombia
*/
function jsDrawdiv(Id)
{
	var sbBrowser='';
	sbBrowser=jsBrowser();
 	if(Id){
 		if(sbBrowser =='IE'){
 		 	document.getElementById(Id).style.visibility='visible';
			document.getElementById(Id).style.display='inline';
 		}else{
 			document.getElementById(Id).style.visibility='visible';
			document.getElementById(Id).style.display='inline';
 		}
 	}
 	return true;
}

/**
* Propiedad intelectual de FullEngine
*
* Esconde un div
* @author freina
* @date 20-May-2005 20:20
* @location Cali-Colombia
*/
function jsErasediv(Id)
{
	var sbBrowser=''; 
	sbBrowser=jsBrowser();
 	if(Id)
 	{
 		if(sbBrowser =='IE')
 		{
 			document.getElementById(Id).style.visibility='hidden';
			document.getElementById(Id).style.display='none';
 		 }
 		 else
 		 {
 		 	document.getElementById(Id).style.visibility='hidden';
			document.getElementById(Id).style.display='none';
 		}		
 	}
 	return true;
}

/**
* Propiedad intelectual de FullEngine
*
* determina el navegador
* @author freina
* @date 20-May-2005 20:20
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

function showCompromisos(objCheck)
{
	if(objCheck.checked==true)
		jsDrawdiv("compromisos");
	else
		jsErasediv("compromisos");
}