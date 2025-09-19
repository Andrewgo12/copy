<html>
{loadlabels table_name=Solucion&controls[]=CmdCancel}
{head}
      <title>Consultar Soluciones</title>
	  {putstyle style=""}
	  {putjsfiles}
	  
{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}


{form name="frmSolucionConsult" method="post"}
{consult_table_solucion 
    table_name="solucion" 
    llaves="ordenumeros" 
    form_name="frmSolucionConsult" 
    sqlid="solucion" 
    command="FeCrCmdShowListSolucion"
    date_fields="archfechan"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeCrCmdCancelShowListSolucion" form_name="frmSolucionConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
