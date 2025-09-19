<html>
{loadlabels table_name=Comunicaciontools&controls[]=CmdNew&controls[]=CmdAdd&controls[]=CmdDelete&controls[]=CmdDownload}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=jsAccionesCT.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmComunicacionTools" method="post"}
<table border="0" align="center" cellspacing="1" cellpadding="3" width="100%">
	<tr>
		<th class="titulofila" colspan="8"><div align="left">{printtitle}</div></th>
    </tr>
   	<tr>
		<td class="celda">
            {putimage id="CmdNew" name="comunicacion__nuevo" form_name ="frmComunicacionTools" jsfunction="jsCreateCT" command="FeGeCmdCentroComunicacionCreate" icon="web/images/crear.gif"}
            {printlabel name=new}
        </td>
		<td class="celda">
            {putimage id="CmdGenerate" name="comunicacion__generar" form_name ="frmComunicacionTools" jsfunction="jsGenerateCT" command="FeGeCmdCentroComunicacionGenerate" icon="web/images/generar_pdf.gif"}
            {printlabel name=generate}
        </td>
        <td class="celda">
            {putimage id="CmdDownload" name="comunicacion__descargar" form_name ="frmComunicacionTools" jsfunction="jsDownloadCT" command="FeGeCmdCentroComunicacionDownload" icon="web/images/descargar_archivo.gif"}
            {printlabel name=download}
        </td>
		<td class="celda">
            {putimage id="CmdDelete" name="comunicacion__eliminar" form_name ="frmComunicacionTools" jsfunction="jsDeleteCT" command="FeGeCmdCentroComunicacionDelete" icon="web/images/eliminar.gif"}
            {printlabel name=delete}
        </td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden_message value="66"}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Comunicaciontools}
</html>