/**
*	Propiedad Intelectual de FullEngine
*	
*	Abre una ventana emergente 
*	
*	@author cazapata <cazapata@parquesoft.com>
*	@date 09-sept-2004 16:00:48
*	@location Cali-Colombia
*/
var sbmodule = "";
function fncopenwindows(sbcomando,sbdata)
{
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	if(sbdata != '')
		url ="index.php?action="+sbcomando+"&"+sbdata;
	else
		url ="index.php?action="+sbcomando;
	if(sbmodule.length>0)
		url = "../"+sbmodule+"/"+url;
	win = window.open(url,"ficha",opciones);
}
/**
*	Propiedad Intelectual de FullEngine
*	
*	Abre una ventana emergente 
*	
*	@author freina<freina@parquesoft.com>
*	@date 11-Aug-2005 17:48
*	@location Cali-Colombia
*/
function OpenWindows(sbdata){
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	if(sbdata != ''){
		url = sbdata;
		win = window.open(url,"",opciones);
	}
	return true;
}
/**
*	Propiedad Intelectual de FullEngine
*	
*	Abre una ventana emergente 
*	
*	@author cazapata <cazapata@parquesoft.com>
*	@date 05-Sep-2005 16:28
*	@location Cali-Colombia
*/
function fncopenwindow(sbcomando,sbdata)
{
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	if(sbdata != '')
		url ="index.php?action="+sbcomando+"&"+sbdata;
	else
		url ="index.php?action="+sbcomando;
	win = window.open(url,"",opciones);
}
/**
*	Propiedad Intelectual de FullEngine
*	
*	Abre una ventana emergente 
*	
*	@author freina<freina@parquesoft.com>
*	@date 24-Aug-2012 15:45
*	@location Cali-Colombia
*/
function OpenWindowsSol(sbdata){
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=800,height=600";
	if(sbdata != ''){
		url = sbdata;
		win = window.open(url,"",opciones);
	}
	return true;
}