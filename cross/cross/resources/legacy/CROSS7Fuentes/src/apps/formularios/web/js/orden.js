/* orden.js compiled from X 4.0 with XC 0.28b. Distributed under GNU LGPL. For copyrights, license, documentation and more visit Cross-Browser.com */
var xOp7Up,xOp6Dn,xIE4Up,xIE4,xIE5,xNN4,xUA=navigator.userAgent.toLowerCase();
if(window.opera)
{
	var i=xUA.indexOf('opera');
	if(i!=-1)
	{
		var v=parseInt(xUA.charAt(i+6));
		xOp7Up=v>=7;xOp6Dn=v<7;
	}
}else if(navigator.vendor!='KDE' && document.all && xUA.indexOf('msie')!=-1)
{
	xIE4Up=parseFloat(navigator.appVersion)>=4;
	xIE4=xUA.indexOf('msie 4')!=-1;
	xIE5=xUA.indexOf('msie 5')!=-1;
}else if(document.layers)
{
	xNN4=true;
}

xMac=xUA.indexOf('mac')!=-1;

function xGetElementById(e){
	if(typeof(e)!='string') 
		return e;
	
	if(document.getElementById) 
		e=document.getElementById(e);
	else if(document.all) 
		e=document.all[e];
	else e=null;
		return e;
}
function xInnerHtml(e,h){
	if(!(e=xGetElementById(e)) || !xStr(e.innerHTML)) 
		return null;
	
	var s = e.innerHTML;
	
	if (xStr(h)) {
		e.innerHTML = h;
	}
	return s;
}
function xStr(s)
{
	for(var i=0; i<arguments.length; ++i)
	{
		if(typeof(arguments[i])!='string') 
			return false;
	}
	return true;
}

function imprime_listado(elementos,name){
	texto="<table width='100%' border=0>";
	var elem = new Array();
	elem = elementos.split("|");
		
	for (i=0;i<elem.length;i++){
		
		if(i%2 == 0)
			estilo = "celda";
		else
			estilo = "celda2";
		//HACEMOS SPLIT DEL ELEMENTO i
		pregunta = elem[i].split("_");
		texto += "<tr>";
		texto += "<td class='"+estilo+"' width='10'><input type='text' name='preg_"+pregunta[0]+"_"+pregunta[1]+"' size='3' value='"+(i+1)+"' readonly></td>";
		texto += "<td class='"+estilo+"'>" + pregunta[2] + "</td>";
		if (i!=0){
			texto += "<td class='"+estilo+"' width='10'><a onclick='arriba(" +i+",\""+name+"\",\""+elementos+"\")'><img src='web/images/arriba.gif' border=0></a></td>";
		}else{
			texto += "<td class='"+estilo+"' width='10'>&nbsp</td>";
		}
		if (i!=elem.length-1){
			texto += "<td class='"+estilo+"' width='10'><a onclick='abajo(" +i+",\""+name+"\",\""+elementos+"\")'><img src='web/images/abajo.gif' border=0></a></td>";
		}else{
			texto += "<td class='"+estilo+"' width='10'>&nbsp</td>";
		}
		texto += "</tr>";
	}
	texto += "</table>";
	xInnerHtml(name,texto);
}

function arriba(i,name,elementos){
	elem = elementos.split("|");
	temporal = elem[i];
	elem[i]=elem[i-1];
	elem[i-1]=temporal;
	elementoss = elem.join("|");
	imprime_listado(elementoss,name)
}

function abajo(i,name,elementos){
	elem = elementos.split("|");
	temporal = elem[i];
	elem[i]=elem[i+1];
	elem[i+1]=temporal;
	elementoss = elem.join("|");
	imprime_listado(elementoss,name)
}