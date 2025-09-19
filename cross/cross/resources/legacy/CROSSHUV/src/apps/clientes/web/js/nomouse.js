/*
Funcion		: derecho
Descripcion	: funcion para desactivar boton derecho del mouse
Autor		: freina
Fecha		: 28-Ene-2004
*/
//---------------------------------------
var message="Botón derecho desactivado!";

///////////////////////////////////
function clickIE4(){
	if (event.button==2){
		alert(message);
		return false;
	}
}

function clickNS4(e){
	if (document.layers||document.getElementById&&!document.all){
		if (e.which==2||e.which==3){
			alert(message);
			return false;
		}
	}
}

if (document.layers){
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
	document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("return false")
//---------------------------------------
/*
Funcion		: windowclose
Descripcion	: Cierra la ventana win
Autor		: freina
Fecha		: 28-Ene-2004
*/
function windowclose()
{
	if(window.win){
		win.close();
	}
}


