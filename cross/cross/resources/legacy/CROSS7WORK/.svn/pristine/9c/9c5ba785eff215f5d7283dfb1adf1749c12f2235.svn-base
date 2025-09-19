/**
*
* @propiedad intekectual de FullEngine
* 
*/
function AddRuta(proccodigos,rutacodigon,rutaesactas,rutatarsigs,rutainitars,rutacantien,rutacantien_h,reglas,errores,debug)
{
	var i;
	var rcReglcodigos = new Array();
	var cont = 0;
	var sbReglcodigos = ''; 

	proceso = proccodigos;
	msgErrors = errores;
	
	if(!rutacodigon || !rutaesactas){
		alert(errores[0]);
		return;
	}

	//Busca las reglas selecionadas
	for(i=0;i<reglas.length;i++){
		if(reglas.options[i].selected == true){
			rcReglcodigos[cont] = reglas.options[i].value;
			cont ++;
		}
	}
	if(rcReglcodigos.length)
		sbReglcodigos = rcReglcodigos.join(',');
	
    //Envia a ejecutar en el RS
    jsrsExecute("rs/jsrs.php", this.resultado, "ProcesoManager::addRuta", Array(proccodigos,rutacodigon,rutaesactas,rutatarsigs,rutainitars,rutacantien,rutacantien_h,sbReglcodigos),debug);
 	return ;
 }
 
function UpdateRuta(rutacodigon,proccodigos,tarecodigos,rutaesactas,rutatarsigs,rutainitars,rutacantien,rutacantien_h,reglas,errores,formulario,debug)
{
	var i;
	var rcReglcodigos = new Array();
	var cont = 0;
	var sbReglcodigos = ''; 

	proceso = proccodigos;
	msgErrors = errores;
	formName = formulario;
	if(!rutacodigon || !rutaesactas){
		alert(errores[0]);
		return;
	}
	//Busca las reglas selecionadas
	for(i=0;i<reglas.length;i++){
		if(reglas.options[i].selected == true){
			rcReglcodigos[cont] = reglas.options[i].value;
			cont ++;
		}
	}
	if(rcReglcodigos.length)
		sbReglcodigos = rcReglcodigos.join(',');
	
    //Envia a ejecutar en el RS
    jsrsExecute("rs/jsrs.php", this.updateResult, "ProcesoManager::updateRuta", Array(rutacodigon,proccodigos,tarecodigos,rutaesactas,rutatarsigs,rutainitars,rutacantien,rutacantien_h,sbReglcodigos),debug);
 	return ;
 }

function DeleteRuta(proccodigos,rutacodigon,errores,debug)
{
	proceso = proccodigos;
	msgErrors = errores;
    //Envia a ejecutar en el RS
    jsrsExecute("rs/jsrs.php", this.resultado, "ProcesoManager::deleteRuta", Array(rutacodigon),debug);
 	return ;
 }

function resultado(sbValue){
	alert(msgErrors[sbValue]);
	if(sbValue == '3' || sbValue == 3)
		document.location='../index.php?action=FeWFCmdShowByIdProceso&proccodigos='+proceso;
	return;
}

function updateResult(sbValue){
	var nuForms = document.forms.length;
	var cont=0;
	var elementos = new Array();
	var i;
	alert(msgErrors[sbValue]);
	
	if(sbValue == '3' || sbValue == 3){
		for(cont;cont<nuForms;cont++){
			if(document.forms[cont].name == formName){
				elementos = document.forms[cont].elements;
				break;
			}
		}
		for(cont=0;cont<elementos.length;cont++){
			elementos[cont].className='';
			if(elementos[cont].type == "select-multiple"){
				for(i=0;i<elementos[cont].length;i++){
					if(elementos[cont].options[i].selected == true)
						if(!elementos[cont].options[i].value){
							elementos[cont].options[i].selected = false;
						}
				}
			}
		}
	}
	return;
}
/**
* Propiedad intelectual de FullEngine
*
* Valida que solo se ingresen numeros.
* @author freina
* @date @date 28-Sep-2009 13:51
* @location Cali-Colombia
*/
function isInteger(event){
	var sbBrouser='';
	sbBrowser = jsBrowser();
	
	if(sbBrowser=='NS'){
		if (!((event.charCode>=48) && (event.charCode<=57) 
			|| (event.charCode == 0) || (event.charCode == 8))){
				AnnulEventNE(event);
		}
	}else{
		if(sbBrowser=='IE'){
			if (!((event.keyCode>=48) && (event.keyCode<=57))){
				AnnulEventIE(event);
			}
		}else{
			if(sbBrowser=='MOZ'){
				if (!((event.charCode>=48) && (event.charCode<=57) 
					|| (event.charCode == 0) || (event.charCode == 8))){
						AnnulEventMOZ(event);				
				}
			}
		}
	}
}
/**
* Propiedad intelectual de FullEngine
*
* Muestra o esconde un div 
* @author freina
* * @date @date 28-Sep-2009 13:51
* @location Cali-Colombia
*/
function jsDrawdiv(sbId)
{
	var sbBrowser='';
	sbBrowser=jsBrowser();
 	contenedor = document.getElementById(sbId);
 	if(sbBrowser =='IE'){
 		 contenedor.style.visibility='visible';
		contenedor.style.display='inline';
 	}else{
 		contenedor.style.visibility='visible';
		contenedor.style.display='inline';
 	}
 	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* Esconde un div
* @author freina
* @date @date 28-Sep-2009 13:51
* @location Cali-Colombia
*/
function jsErasediv(sbId){
	var sbBrowser=''; 
	sbBrowser=jsBrowser();
 	contenedor = document.getElementById(sbId);
 	if(sbBrowser =='IE'){
 		contenedor.style.visibility='hidden';
		contenedor.style.display='none';
 	}
 	else{
 		contenedor.style.visibility='hidden';
		contenedor.style.display='none';
 	}
 	return true;
}
/**
* Propiedad intelectual de FullEngine
*
* habilita deshabilita el text de porcentaje
* @author freina
* @date @date 28-Sep-2009 13:35
* @location Cali-Colombia
*/
function jsViewPercent($sbNameform,sbDivId,$sbSignal){
	var nuForms = document.forms.length;
	var nuCont=0;
	var rcElements = new Array();
	for(nuCont;nuCont<nuForms;nuCont++){
		if(document.forms[nuCont].name == $sbNameform){
			break;
		}
	}
	
	if((document.forms[nuCont].rutatarsigs.value && !document.forms[nuCont].rutainitars.value) 
		|| (document.forms[nuCont].rutainitars.value==$sbSignal && !document.forms[nuCont].rutatarsigs.value)){
		if(document.forms[nuCont].visible.value==0){
			jsDrawdiv(sbDivId);
			document.forms[nuCont].visible.value=1;
		}
	}else{
		jsErasediv(sbDivId);
		document.forms[nuCont].rutacantien.value="";
		document.forms[nuCont].rutacantien_h.value="";
		document.forms[nuCont].visible.value=0;
	}
}
function loadrutatarsigs(padre, hijo, valor){
	var i;
	var cont=0;
	hijo.options[0] = null;
	hijo.length = 0;
	for(i=0;i<padre.length;i++){
		if(padre.options[i].value != valor){
			hijo.options[cont] = new Option(padre.options[i].text,padre.options[i].value);
			cont++;
		}
	}
}
function changeStyle(formName){
	var nuForms = document.forms.length;
	var cont=0;
	var elementos = new Array();
	for(cont;cont<nuForms;cont++){
		if(document.forms[cont].name == formName){
			elementos = document.forms[cont].elements;
			break;
		}
	}
	for(cont=0;cont<elementos.length;cont++){
		elementos[cont].className='resaltar';
	}
}