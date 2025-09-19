<html>
{loadlabels table_name=Treehelp&controls[]}
{head}
      <title>{printtitle}</title>

{putstyle style="estilotreehelp.css"}
{putjsfiles files[]=sniffer.js&files[]=TreeMenu.js&files[]=jsTreeHelp.js}

{/head}
{body class="menugen" onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmTreeHelp" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td class="piedefoto">&nbsp;</td>
      {hidden name="message"}
      <td>{consult_treehelp_esp
				form="frmTreeHelp"
				submit="FeGeCmdTreeHelpEsp"
				cache="false"
			  }
	 </td>
  	<td class="piedefoto">&nbsp;</td>
   </tr>
</table>
{hidden name="action"}
{hidden name="table"}
{hidden name="sqlid"}
{hidden name="return_obj"}
{hidden name="return_key"}
{hidden name="father"}
{hidden name="son"}
{hidden name="label"}
{hidden name="param"}
{hidden name="valor" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message close=$close}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Treehelp}
</html>