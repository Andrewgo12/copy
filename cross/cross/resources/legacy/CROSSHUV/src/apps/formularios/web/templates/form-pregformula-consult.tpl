<html>
{loadlabels table_name=Pregformula&controls[]=CmdAccept&controls[]=CmdCancel}
{head}
      <title>Consultar Pregformula</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmPregformulaConsult" method="post"}
{consult_table table_name="pregformula" llaves="pregcodigon,formcodigon" form_name="frmPregformulaConsult"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
    			{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeEnCmdShowByIdPregformula" form_name="frmPregformulaConsult"}
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListPregformula" form_name="frmPregformulaConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}

</html>
