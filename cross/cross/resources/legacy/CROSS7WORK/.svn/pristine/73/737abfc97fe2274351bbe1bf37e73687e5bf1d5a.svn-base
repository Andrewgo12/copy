<html>
{loadlabels table_name=Proveedor&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Proveedor</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmProveedorConsult" method="get"}
{consult_table table_name="proveedor" llaves="provcodigos" form_name="frmProveedorConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdProveedor" form_name="frmProveedorConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListProveedor" form_name="frmProveedorConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
