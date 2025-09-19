<html>
{loadlabels table_name=Email&controls[]}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEmailPreview" method="post"}
<table border="0" align="center" width="100%">
  	<tr><td class="piedefoto"><div align="center">
		{head_email}
  	</div></td></tr>
	&nbsp;
   <tr>
      <td class="piedefoto"><table border="0" align="center" width="100%">{text_email}</table></td>
   </tr>
</table>
{hidden name="action" value=""}
{hidden id="emaicodigos" name="email__emaicodigos" value=""}
{/form}
{putjsacceskey}
{/body}
{droptmpfile table_name=Email}
</html>