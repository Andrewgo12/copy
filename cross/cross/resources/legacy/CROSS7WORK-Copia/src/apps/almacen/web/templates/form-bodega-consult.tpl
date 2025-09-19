<html>
{loadlabels table_name=Bodega&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Bodega</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmBodegaConsult" method="get"}
{consult_table table_name="bodega" llaves="bodecodigos" form_name="frmBodegaConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdBodega" form_name="frmBodegaConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListBodega" form_name="frmBodegaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
