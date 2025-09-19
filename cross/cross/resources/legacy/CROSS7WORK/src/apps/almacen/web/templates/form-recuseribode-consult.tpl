<html>
{loadlabels table_name=Recuseribode&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Recuseribode</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmRecuseribodeConsult" method="get"}
{consult_table table_name="recuseribode" llaves="" form_name="frmRecuseribodeConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdRecuseribode" form_name="frmRecuseribodeConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListRecuseribode" form_name="frmRecuseribodeConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
