<html>
{loadlabels table_name=Formulario&controls[]=CmdCancel}
{head}
      <title>Consultar Formulario</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}

<br>
{form name="frmFormularioConsult" method="post"}
{consult_table table_name="formulario" llaves="formcodigon" form_name="frmFormularioConsult" command="FeEnCmdShowListFormulario" date_fields="formfeccrean"}
<br>
<table border="0" align="center" width="90%">
	<tr>
    	<td class="piedefoto">
    		<div align="center">
				{btn_command type="button" value="Cancelar" id="CmdCancel" name="FeEnCmdCancelShowListFormulario" form_name="frmFormularioConsult"}
			</div>
		</td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{/body}
</html>