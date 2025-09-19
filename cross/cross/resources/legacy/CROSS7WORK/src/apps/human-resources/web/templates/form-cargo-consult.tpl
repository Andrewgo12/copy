<html>
{loadlabels table_name=Cargo&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Cargo</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmCargoConsult" method="post"}
{consult_table table_name="cargo" llaves="cargcodigos" form_name="frmCargoConsult" sqlid="" command="FeHrCmdShowListCargo"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeHrCmdCancelShowListCargo" form_name="frmCargoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
