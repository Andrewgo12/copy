<html>
{loadlabels table_name=Comunicacion&controls[]}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmComunicacionPreview" method="post"}
<table border="0" align="center" width="100%">
  	<tr><td class="piedefoto"><div align="center">
  	</div></td></tr>
   <tr>
      <td class="celda2"><PRE>{text_comunicacion}</PRE></td>
   </tr>
</table>
{hidden name="action" value=""}
{hidden id="comucodigos" name="comunicacion__comucodigos" value=""}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Comunicacion}
</html>