<html>
{loadlabels table_name=Consultsolucion&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
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
	<tr><td colspan="3"><div align="right">{newsolucion}
        {printlabel name=buscar} {textfield id="buscar" name="buscar" maxlength="30"}
        <a href="#" onClick="frmSolucion.submit();">
        <image src="web/images/consultar_002.gif" border="0" align="middle"/>
        </a>
    </div></td></tr>
	<tr>
		<td colspan="3"class="piedefoto">{consultsolucion}</td>
	</tr>
</table>
{hidden name="action" value="FeCrCmdDefaultConsultSolucion"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
</html>