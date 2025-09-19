<html>
{loadlabels table_name=Solucion&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}

      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmSolucion" enctype="multipart/form-data" method="post"}
<table border="0" align="center" width="70%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

   <tr>
      <td class="celda">{printlabel name=ordenumeros&blBold=true}</td>
      <td class="celda">{textfield id="ordenumeros" name="ordenempresa__ordenumeros" class="campos" maxlength="30"}<b>*</b></td>
 	   <td class="piedefoto">{printcoment name=ordenumeros}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=resumen&blBold=true}</td>
      <td class="celda">{textarea id="resumen" name="solucion__resumen" class="campos" cols="50" rows="5" }{/textarea}<b>*</b></td>
 	   <td class="piedefoto">{printcoment name=resumen}</td>
   </tr>
   
   <tr>
		<td class="piedefoto" colspan="3">&nbsp;</td>
	</tr>
   
   <tr><td colspan="2" class="piedefoto">{register_attachment_sol form="frmSolucion"}</td>
   <td valign="bottom" class="piedefoto">{printcoment name=archivo}</td></tr>
   <!-- <tr>
      <td class="celda">{printlabel name=archivo}</td>
      <td class="celda">{textfield type="file" id="archivo" name="solucion_archivo" class="campos" size="50" }</td>
 	   <td class="piedefoto">{printcoment name=archivo}</td>
   </tr>
   <tr>
      <td class="celda">{printlabel name=filename}</td>
      <td class="celda">
            {php}
                if($_REQUEST['archivo']){
                    echo "<a href='#' onclick=\"fncopenwindows('FeCrCmdDefaultDownloadFile','archcodigon=".$_REQUEST['archcodigon']."');\" title='{$rcLabels['descargar']['label']}'>".$_REQUEST['archivo']."</a><br>";
                    echo "<input type='hidden' name='archivo' value='".$_REQUEST['archivo']."' />";
                    echo "<input type='hidden' name='archcodigon' value='".$_REQUEST['archcodigon']."' />";
                }
            {/php}
       </td>
 	   <td class="piedefoto">{printcoment name=filename}</td>
   </tr>-->
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
    	<td colspan="2">
    		<div align="center">
	    		{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddSolucion" form_name="frmSolucion"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateSolucion" form_name="frmSolucion" loadFields="ordenempresa__ordenumeros,solucion__resumen" confirm="33"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCrCmdDeleteSolucion" form_name="frmSolucion" loadFields="ordenempresa__ordenumeros" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListSolucion" form_name="frmSolucion"}
				{btn_command type="button" value="Limpiar" id="CmdClean"  name="FeCrCmdClearSolucion" form_name="frmSolucion"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="deleteattachment" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
</html>