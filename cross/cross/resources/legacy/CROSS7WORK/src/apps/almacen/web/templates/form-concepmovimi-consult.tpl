<html>
{loadlabels table_name=Concepmovimi&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Concepmovimi</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}

<br>
{form name="frmConcepmovimiConsult" method="get"}
{consult_table table_name="concepmovimi" llaves="comocodigos" form_name="frmConcepmovimiConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdShowByIdConcepmovimi" form_name="frmConcepmovimiConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeStCmdCancelShowListConcepmovimi" form_name="frmConcepmovimiConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
