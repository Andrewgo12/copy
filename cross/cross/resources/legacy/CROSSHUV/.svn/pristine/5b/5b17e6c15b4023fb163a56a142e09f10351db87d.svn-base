<html>
{loadlabels table_name=Emailtools&controls[]=CmdSend&controls[]=CmdNew&controls[]=CmdAdd&controls[]=CmdDelete}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsAccionesCE.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmEmailTools" method="post"}
<table border="0" align="center" cellspacing="1" cellpadding="3" width="100%">
	<tr>
		<th class="titulofila" colspan="4"><div align="left">{printtitle}</div></th>
    </tr>
   	<tr>
   	<tr>
		<td>
            {putimage id="CmdNew" name="email__nuevo" form_name ="frmEmailTools" jsfunction="jsCreateCE" command="FeGeCmdCentroEmailCreate" icon="web/images/crear.gif"}
            {printlabel name=new}
        </td>
		<td>
            {putimage id="CmdSend" name="email__enviar" form_name ="frmEmailTools" jsfunction="jsSendCE" command="FeGeCmdCentroEmailSend" icon="web/images/mapmail.gif"}
            {printlabel name=send}
        </td>
		<td>
            {putimage id="CmdGenerate" name="email__generar" form_name ="frmEmailTools" jsfunction="jsGenerateCE" command="FeGeCmdCentroEmailGenerate" icon="web/images/indata.gif"}
            {printlabel name=generate}
        </td>
		<td class="celda">
            {putimage id="CmdDelete" name="email__eliminar" form_name ="frmEmailTools" jsfunction="jsDeleteCE" command="FeGeCmdCentroEmailDelete" icon="web/images/eliminar.gif"}
            {printlabel name=delete}
        </td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Emailtools}
</html>