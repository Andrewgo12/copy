<html>
{loadlabels table_name=Movimialmace&controls[]=CmdCancel}
{head}
      <title>Consultar Movimialmace</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmMovimialmaceConsult" method="get"}
{lst_recursos}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListMovimialmace" form_name="frmMovimialmaceConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="registro" value=""}
{hidden name="serial" value=""}
{hidden name="movimialmace__tidocodigos"}
{hidden name="movimialmace__tidocodigos_desc"}
{hidden name="movimialmace__moalnumedocs"}
{hidden name="movimialmace__bodecodigos_out"}
{hidden name="movimialmace__bodecodigos_out_desc"}
{hidden name="movimialmace__comocodigos_out"}
{hidden name="movimialmace__comocodigos_out_desc"}
{hidden name="movimialmace__bodecodigos_in"}
{hidden name="movimialmace__bodecodigos_in_desc"}
{hidden name="movimialmace__comocodigos_in"}
{hidden name="movimialmace__comocodigos_in_desc"}
{/form}
{putjsacceskey}
{/body}
</html>
