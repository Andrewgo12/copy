<html>
{loadlabels table_name=Equivalencias&controls[]=CmdAccept&controls[]=CmdCancel}
<head>
      <title>Consultar Equivalencias</title>
{putstyle style=""}
{putjsfiles}
</head>
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmEquivalenciasConsult" method="post"}
{consult_table 
table_name="equivalencias" 
llaves="equicodigon" 
fields="equicodigon" 
form_name="frmEquivalenciasConsult" 
sqlid="equivalencias" 
command="FeGeCmdShowListEquivalencias"
date_fields="equifechacrn"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeGeCmdCancelShowListEquivalencias" form_name="frmEquivalenciasConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>