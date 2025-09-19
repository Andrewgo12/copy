<html>
{loadlabels table_name=Estadotarea&controls[]=CmdCancel}
{head}
      <title>Consultar Estadotarea</title>
	  {putstyle}
	  {putjsfiles}
	  
{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}


{form name="frmEstadotareaConsult" method="post"}
{consult_table table_name="estadotarea" llaves="tarecodigos,esaccodigos" form_name="frmEstadotareaConsult" sqlid="estadotarea" command="FeWFCmdShowListEstadotarea"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeWFCmdCancelShowListEstadotarea" form_name="frmEstadotareaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
