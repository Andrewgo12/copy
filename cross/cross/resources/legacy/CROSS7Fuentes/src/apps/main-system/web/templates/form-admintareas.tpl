<html>
{loadlabels table_name=admintareas&controls[]=CmdShow}
{head}
      <title>Permisions</title>
{putstyle}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}

<br>
{form name="frmAdminTareas" method="post"}
  <table border="0" align="center" width="80%">
  <tr><td class="piedefoto" colspan="3"><div align="center">
	{help_context}
  </div></td></tr>
  <tr><th colspan="3">&nbsp;</th></tr>
  <tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
		<tr>
		      <td>{printlabel name=orgacodigos}</td>
		      <td>
		      	{select_entes_esp id="orgacodigos" name="orgacodigos" is_null="true" form="frmAdminTareas"}
		      </td>
		      <td class="piedefoto">{printcoment name=orgacodigos}</td>
        </tr>
        <tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeCrCmdDefaultAdminTareas" form_name="frmAdminTareas"}
			</div>
		</td>
		<td class="piedefoto"></td>
		</tr>
	    
	    <tr>
	    	<!-- Pinta la tabla de las tareas -->
	    	<td colspan="3">{viewtareas form="frmAdminTareas"}</td>
	    </tr>
  </table>
{hidden name="action" value=""}
{hidden name="acta" value=""}
{hidden name="order_by" value=""}
{/form}
{putjsacceskey}
{fieldset legend="Resultado"}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=Permisions}

</html>
