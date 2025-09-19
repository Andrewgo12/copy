<html>
{loadlabels table_name=Estadoorgani&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Estadoorgani</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmEstadoorganiConsult" method="post"}
{consult_table table_name="estadoorgani" llaves="esorcodigos" form_name="frmEstadoorganiConsult" sqlid="" command="FeHrCmdShowListEstadoorgani"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeHrCmdCancelShowListEstadoorgani" form_name="frmEstadoorganiConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
