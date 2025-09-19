<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* Smarty plug-in
* Visualiza las Hoja de vida de un producto
* @return array
* @author creyes <cesar.reyes@parquesoft.com>
* @date 11-may-2005 16:24:41
* @location Cali-Colombia
*/

function smarty_function_viewfichaproducto($params, &$smarty){
	extract($_REQUEST);

	if(!$prodcodigos || !$contnics)
        return null;
	
	//Obtiene la compuerta extendida
	$gateway = Application :: getDataGateway("SqlExtended");
	//Busco los productos del contrato
	$rcDataProducto =  $gateway->getFichaProducto($prodcodigos,$contnics);
    if(!is_array($rcDataProducto))
        return null;
    
	//Para cargar el lenguaje
	$rcuser = Application :: getUserParam();
	include ($rcuser["lang"]."/".$rcuser["lang"].".fichaproducto.php");
    //Ajusta los datos para visualizar 
    $rcDataProducto = $rcDataProducto[0];
    $rcHead["prodcodigos"] = $rcDataProducto["prodcodigos"];
    $rcHead["prodnombres"] = $rcDataProducto["prodnombres"];
    $rcHead["marcnombres"] = $rcDataProducto["marcnombres"];
    $rcHead["modenombres"] = $rcDataProducto["modenombres"];
    $rcHead["coprserials"] = $rcDataProducto["coprserials"];
    $rcHead["valor"] = (int) $rcDataProducto["coprcantidan"] * $rcDataProducto["coprvalunidn"];
    $rcDesc["proddescrips"] = nl2br(htmlentities ( $rcDataProducto["proddescrips"], ENT_QUOTES, 'ISO-8859-15'));

    $dateService = Application :: loadServices("DateController");
    
    $rcWarranty["contfchfirmn"] = $dateService->fncformatofechahora($rcDataProducto["contfchfirmn"]);
    $rcWarranty["copovigencn"] = $rcDataProducto["copovigencn"]." ".$rclabels["meses"]["label"];
    //Calcula la fecha de vencimiento de la garantía
    $rcDataProducto["copovigencn"] = (int) $rcDataProducto["copovigencn"];
    $rcDataProducto["contfchfirmn"] = (int) $rcDataProducto["contfchfirmn"];
    $rcWarranty["vencimiento"] = $dateService->addMonts($rcDataProducto["contfchfirmn"], $rcDataProducto["copovigencn"]);
    $rcWarranty["vencimiento"] = $dateService->fncformatofechahora($rcWarranty["vencimiento"]);
    
    $rcWarranty["copodefinis"] = $rcDataProducto["copodefinis"];
    $rcWarranty["copoclausus"] = nl2br(htmlentities ( $rcDataProducto["copoclausus"], ENT_QUOTES, 'ISO-8859-15'));
    $rcWarranty["coporestris"] = nl2br(htmlentities ( $rcDataProducto["coporestris"], ENT_QUOTES, 'ISO-8859-15'));

	//Carga la imagen del producto
    $sbPicture = "<div align=\"center\"><iframe id=\"$id\" name=\"$name\" src=\"index.php?action=FeCuCmdDefaultProductoImage&prodcodigos={$rcDataProducto['prodcodigos']}\" frameborder=\"0\" framespacing=\"0\" scrolling=\"auto\" border=\"0\" style=\"width:216; height:250;\">
					Sorry, your browser doens't support iframe. Please upgrade your browsers.
				</iframe></div>";
    
	//Carga el servicio de HTML para elaborar las fichas y los listados
	$htmlService = Application :: loadServices("Html");
    $rcParams["cols"] = 1;

	$rcHtml[] = "<table align='center' width='80%'>";
    $rcHtml[] = "<tr><td class='piedefoto'>$sbPicture</td>";
    $rcHtml[] = "<td class='piedefoto'>";
	$rcHtml[] = $htmlService->genCard($rcHead, $rclabels, $rcParams);
	$rcHtml[] = "</td></tr>";
    $rcHtml[] = "<tr><td colspan='2'>";
    $rcHtml[] = $htmlService->genCard($rcDesc, $rclabels, $rcParams);
    $rcHtml[] = "</td></tr><tr><td colspan='2'class='piedefoto'>&nbsp;</td></tr>";
    //Pinta los datos de la garantía
    $rcHtml[] = "<tr><th colspan='2'><div align='left'>".$rclabels["warranty"]["label"]."</div></th></tr>";
    $rcHtml[] = "<tr><td colspan='2' class='piedefoto'>";
    $rcHtml[] = $htmlService->genCard($rcWarranty, $rclabels, $rcParams); 
    $rcHtml[] = "</td></tr>";
    //Consulta los datos de las ordenes
    $rcOrdenes = $gateway->getOrdenByProdCont($prodcodigos,$contnics);
    $rcParams["size_table"] = "100%";
    $rcParams["align"] = "right";
    if(is_array($rcOrdenes)){
        $rcHtml[] = "<tr><th colspan='2'><div align='left'><br>".$rclabels["orden"]["label"]."</div></th></tr>";
        foreach($rcOrdenes as $rcOrden){
            $rcParams["cols"] = 2;
            $rcOrden["ordefecregd"] = $dateService->fncformatofechahora($rcOrden["ordefecregd"]);
            $rcOrden["ordefecfinad"] = $dateService->fncformatofechahora($rcOrden["ordefecfinad"]);
            $rcHtml[] = "<tr><td colspan='2' class='piedefoto'>";
            $rcHtml[] = $htmlService->genCard($rcOrden, $rclabels, $rcParams);
            $rcHtml[] = "</td></tr>";
            /*
            //Consulta la información de las actas
            $rcActas = $gateway->getActasByOrden($rcOrden["ordenumeros"]);
            if(is_array($rcActas)){
                $rcParams["cols"] = 5;
                $rcHtml[] = "<tr><th colspan='2'><div align='center'>".$rclabels["actas"]["label"]." ".$rcOrden["ordenumeros"]."</div></th></tr>";
                foreach($rcActas as $rcActa){
                    $rcActa["actafechingn"] = $dateService->fncformatofechahora($rcActa["actafechingn"]);
                    $rcHtml[] = "<tr><td colspan='2' class='piedefoto'>";
                    $rcHtml[] = "<table border='0' align='right' width='90%'><tr><td  class='piedefoto'>";
                    $rcHtml[] = $htmlService->genCard($rcActa, $rclabels, $rcParams);
                    $rcHtml[] = "</td></tr></table>";
                    $rcHtml[] = "</td></tr>";
                    //Consulta la información de las atenciones
                    $rcAtenciones = $gateway->getAtencionesByActa($rcActa["actacodigos"]);
                    if(is_array($rcAtenciones)){
                        $rcHtml[] = "<tr><th colspan='2'><div align='center'>".$rclabels["atenciones"]["label"]." ".$rcActa["actacodigos"]."</div></th></tr>";
                        $rcParams["cols"] = 4;
                        foreach($rcAtenciones as $rcAtencion){
                            $acemnumeros = $rcAtencion["acemnumeros"];
                            unset($rcAtencion["acemnumeros"]);
                            $rcAtencion["acemfecaten"] = $dateService->fncformatofechahora($rcAtencion["acemfecaten"]);
                            $rcHtml[] = "<tr><td colspan='2' class='piedefoto'>";
                            $rcHtml[] = "<table border='0' align='right' width='80%'><tr><td  class='piedefoto'>";
                            $rcHtml[] = $htmlService->genCard($rcAtencion, $rclabels, $rcParams);
                            $rcHtml[] = "</td></tr></table>";
                            $rcHtml[] = "</td></tr>";
                            //Consulta las actividades de una atencion
                            $rcActividades = $gateway->getActiviactaByAcem($acemnumeros);
                            if(is_array($rcActividades)){
                                $rcHtml[] = "<tr><td colspan='2' class='piedefoto'>";
                                $rcHtml[] = "<table border='0' align='right' width='70%'>";
                                $rcHtml[] = "<tr><th colspan='2'><div align='left'>".$rclabels["actividades"]["label"]."</div></th></tr>";
                                $rcHtml[] = "<tr>
                                                <td class='titulofila'>".$rclabels["acticodigos"]["label"]."</td>
                                                <td class='titulofila'>".$rclabels["actinombres"]["label"]."</td>
                                            </tr>";
                                foreach($rcActividades as $rcTmpValues){
                                    $rcHtml[] = "<tr>
                                                    <td class=''>".$rcTmpValues["acticodigos"]."</td>
                                                    <td class=''>".$rcTmpValues["actinombres"]."</td>
                                                </tr>";
                                }
                                $rcHtml[] = "</table>";	
                                $rcHtml[] = "</td></tr>";
                            }
                        }
                    }
                    
                }
            }*/
            $rcHtml[] = "<tr><td colspan='2' class='piedefoto'><hr></td></tr>";
        }
    }
    $rcHtml[] = "</table>";

    return implode("\n",$rcHtml);
}
?>