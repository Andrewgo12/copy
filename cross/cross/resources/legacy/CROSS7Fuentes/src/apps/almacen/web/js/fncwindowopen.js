/**
*	Propiedad Intelectual de FullEngine
*	
*	Abre una ventana emergente 
*	
*	@author cazapata <cazapata@parquesoft.com>
*	@date 09-sept-2004 16:00:48
*	@location Cali-Colombia
*/
function fncopenwindows(sbcomando,sbdata)
{
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	if(sbdata != '')
		url ="index.php?action="+sbcomando+"&"+sbdata;
		else
			url ="index.php?action="+sbcomando;
	win = window.open(url,"ficha",opciones);
}