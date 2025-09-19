<html>
{loadlabels table_name=Ipsservicio&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmIpsservicio" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ipsecodigos&blBold=true}</td>
      <td>{textfield id="ipsecodigos" name="ipsservicio__ipsecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ipsecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=ipsenombres&blBold=true}</td>
      <td>{textfield id="ipsenombres" name="ipsservicio__ipsenombres" maxlength="150"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=ipsenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=ipsedescrips}</td>
      <td>{textarea id="ipsedescrips" name="ipsservicio__ipsedescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=ipsedescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=ipseactivos}</td>
      <td>{select_estado id="ipseactivos" name="ipsservicio__ipseactivos" table="ipsservicio"}</td>
  	<td class="piedefoto">{printcoment name=ipseactivos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCuCmdAddIpsservicio" form_name="frmIpsservicio"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCuCmdUpdateIpsservicio" form_name="frmIpsservicio" loadFields="ipsservicio__ipsecodigos,ipsservicio__ipsenombres" confirm="33"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeCuCmdDeleteIpsservicio" form_name="frmIpsservicio" loadFields="ipsservicio__ipsecodigos,ipsservicio__ipsenombres" confirm="34"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdShowListIpsservicio" form_name="frmIpsservicio"}
				{btn_clean table_name="Ipsservicio" form_name="frmIpsservicio"}
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
{droptmpfile table_name=Ipsservicio}
</html>