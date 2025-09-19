function jsShowOpenAnswers(pregcodigon,reprcodigon,nuIndex){
	var opciones="top=40,left=100,toolbar=0,status=0,location=0,directories=0,resizable=yes,menubar=0,scrollbars=1,width=550,height=500";
	if(pregcodigon && reprcodigon && nuIndex){
		url ='index.php?action=FeEnCmdShowOpenAnswers&pregcodigon='+pregcodigon+'&reprcodigon='+reprcodigon+'&nuIndex='+nuIndex;
		win = window.open(url,"Respuestas",opciones);
	}	
	return true;
}