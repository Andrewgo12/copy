<html>
{loadlabels table_name=Estadogrupo&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Estadogrupo</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmEstadogrupoConsult" method="post"}
{consult_table table_name="estadogrupo" llaves="esgrcodigos" form_name="frmEstadogrupoConsult" sqlid="" command="FeHrCmdShowListEstadogrupo"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
			{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeHrCmdCancelShowListEstadogrupo" form_name="frmEstadogrupoConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
