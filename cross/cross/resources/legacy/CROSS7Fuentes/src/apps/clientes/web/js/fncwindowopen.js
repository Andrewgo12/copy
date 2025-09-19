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
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,menubar=0,scrollbars=1,resizable=yes,width=550,height=500";
	var url ="index.php?action="+sbcomando+"&"+sbdata;
	var nuWin = aleatorio(1,9);
	var sbWin = "_new"+nuWin ;
	var win = window.open(url,sbWin,opciones);
}

function aleatorio(inferior,superior){
    numPosibilidades = superior - inferior
    aleat = Math.random() * numPosibilidades
    aleat = Math.round(aleat)
    return parseInt(inferior) + aleat
} 