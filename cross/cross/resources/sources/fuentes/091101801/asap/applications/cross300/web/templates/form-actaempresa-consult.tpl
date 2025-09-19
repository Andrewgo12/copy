<html>
{loadlabels table_name=Actaempresa&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Actaempresa</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmActaempresaConsult" method="get"}
{consult_table table_name="actaempresa" llaves="actacodigos,acemnumeros" form_name="frmActaempresaConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeCrCmdShowByIdActaempresa" form_name="frmActaempresaConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListActaempresa" form_name="frmActaempresaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
