/**
*	Propiedad Intelectual de FullEngine
*	
*	Cierra una ventana emergete
*	
*	@author freina<freina@parquesoft.com>
*	@date 11-Aug-2005 11:07
*	@location Cali-Colombia
*/
function WindowClose(){
	if(parent.opener!=null){
        parent.close();
    }else{
    	window.close();
    }
}