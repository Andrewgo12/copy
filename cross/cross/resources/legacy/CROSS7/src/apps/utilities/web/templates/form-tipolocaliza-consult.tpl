<html>
{loadlabels table_name=Tipolocaliza&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Tipolocaliza</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmTipolocalizaConsult" method="post"}
{consult_table table_name="tipolocaliza" llaves="tilocodigos" form_name="frmTipolocalizaConsult" sqlid="" command="FeGeCmdShowListTipolocaliza"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeGeCmdCancelShowListTipolocaliza" form_name="frmTipolocalizaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
