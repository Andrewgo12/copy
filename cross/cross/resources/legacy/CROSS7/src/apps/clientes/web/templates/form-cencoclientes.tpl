<html>
{loadlabels table_name=Centroconsulta&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>Clientes</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=actions.js}

{/head}
{body onkeydown="" onload="putFocus()" onunload=""}
<br>
{form name="frmCencoclientes" method="post"}
<table border="0" align="center" width="70%">
	<tr><td colspan="5" class="piedefoto" align="center">{help_context}</td></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   <tr>
      <td>{printlabel name=clieidentifs}</td>
      <td>
          {textfield id="clieidentifs" name="cliente__clieidentifs"}
          {btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdDefaultCencoclientes" form_name="frmCencoclientes" onClick="flag.value=1;" }
        </td>
      <td class="piedefoto">{printcoment name=clieidentifs}</td>
   </tr>
   <tr>
      <td>{printlabel name=contnics}</td>
      <td>
        {textfield id="contnics" name="contrato__contnics" maxlength="30"}
        {btn_command type="button" value="Consultar" id="CmdShow" name="FeCuCmdDefaultCencoclientes" form_name="frmCencoclientes" onClick="flag.value=2;"}
    </td>
  	<td class="piedefoto">{printcoment name=contnics}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td class="piedefoto" colspan="2">
            {viewfichacliente}
            {viewfichacontrato}
        </td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="flag" value=""}
{/form}
{putjsacceskey}
{fieldset legend="Resultado"}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Cencoclientes}
</html>