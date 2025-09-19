<?php
/**Copyright 2004 � FullEngine
Libreria de Centro de Consulta al cliente
final@author cazapata <cazapata@parquesoft.com>finalfinal
@date 03-sep-2004 11:08:26
@location Cali - Colombia 1104555600  1123736399
*/
function smarty_function_selecttipos($params, &$smarty)
{   
    $tipoGateway = Application::getDataGateway('SqlExtended');
    $rcTipos = $tipoGateway->getDataCombo('tipoorden');
    $nuReg = sizeof($rcTipos);
    if(is_array($rcTipos))
    {
        foreach($rcTipos as $key => $rcValues)
        {
        	$rcValues['tiornombres'] = htmlspecialchars($rcValues['tiornombres']);
            $rcTipos[] = "listTipos.options[$key] = new Option('{$rcValues['tiornombres']}','{$rcValues['tiorcodigos']}');";
        }
        $rcTipos[] = "listTipos.length = ".$nuReg;
        $tipos = implode("\n",$rcTipos);
    }
    else
    {
        $tipos='';
    }

    $rcUser = Application::getUserParam();
    if(!is_array($rcUser))
    {
        $rcUser['lang'] = Application::getSingleLang();
    }    
    
    include ($rcUser["lang"]."/".$rcUser["lang"].".messages.php");
    $cadena = "<script language='javascript'>
        function valDatos(){
            if(!document.frmDetalle.reporte.value || 
                !document.frmDetalle.orden__ordefecingdini.value || 
                !document.frmDetalle.orden__ordefecingdfin.value){
                    alert('".$rcmessages[0]."');
                return false
            }
            return true;
        }
        function selectTipo(list, listTipos)
    	{
    		if(list.value == 'tipo')
            	for ( var i=0; i < list.options.length; i++ )
    			{
                	if(list.options[i].selected == true && list.options[i].value == 'tipo')
    				{
                    	".$tipos."
                    	return true;
                	}
            	}
    		else
    		{
        		listTipos.options[0] = null;
        		listTipos.length = 0;
    		}
        	return true;
        }
    </script>";
    return $cadena;
}
?>