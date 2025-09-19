<html>
{loadlabels table_name=params&controls[]=CmdUpdate}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=select_list.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmParams" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>

	<tr>
      <td colspan="2">{printlabel name=schema&blBold=true}</td>
      <td><B>{viewPestanas}</B></td>
  	<td class="piedefoto">{printcoment name=schema}</td>
   </tr>
   
	{viewParams controls="CmdUpdate"}
	
	<tr>
		<td colspan="3">
			<div align="center">
				{btn_commandParams type="button" value="Modificar" onClick="validarNulosMultiples()" id="CmdUpdate" name="FeGeCmdUpdateParametros" form_name="frmParams"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Params}
</html>