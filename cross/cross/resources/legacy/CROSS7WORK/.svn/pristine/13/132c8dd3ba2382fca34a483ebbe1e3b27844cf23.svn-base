<html>
{loadlabels table_name=Contrato&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Contrato</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmContratoConsult" method="get"}
{consult_table table_name="contrato" llaves="contnics" form_name="frmContratoConsult" sqlid="contrato" command="FeCuCmdShowListContrato" date_fields="contfchainin,contfchafinn,contfchfirmn"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCuCmdCancelShowListContrato" form_name="frmContratoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
