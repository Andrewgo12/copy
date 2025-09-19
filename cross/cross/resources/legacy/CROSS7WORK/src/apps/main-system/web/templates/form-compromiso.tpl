<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Compromiso&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmCompromiso" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=compdescris}</td>
      <td>{textarea id="compdescris" name="compromiso__compdescris" rows=10 cols=50 maxlength="255"}{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=compdescris}</td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeCrCmdAddCompromiso" form_name="frmCompromiso"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeCrCmdUpdateCompromiso" form_name="frmCompromiso"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeCrCmdDeleteCompromiso" form_name="frmCompromiso"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdShowListCompromiso" form_name="frmCompromiso"}
				{btn_clean table_name="Compromiso" form_name="frmCompromiso"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="compromiso__compcodigos"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Compromiso}


</html>
