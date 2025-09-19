<html>
{loadlabels table_name=Activipares&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsLoadSelect.js&files[]=sort.js}

{/head}
{body 
onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}

<br>
{form name="frmPermisosentes" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
  <tr>
      <td>{printlabel name=acticodigos&blBold=true}</td>
      <td>{select_row_table_service service="Workflow" table_name="actividad" 
      		field="acticodigos" label="actinombres" id="acticodigos" name="acticodigos" is_null="true" onchange="disableNextObject(this.value,document.frmPermisosentes.acticodigos2);"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=acticodigos}</td>
  </tr>		
  <tr>
      <td>{printlabel name=acticodigos2&blBold=true}</td>
      <td>{select_multiple service="Workflow" table_name="actividad" 
      		field="acticodigos" label="actinombres" id="acticodigos2" name="acticodigos2"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=acticodigos2}</td>
  </tr>	
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateActiviPares" form_name="frmPermisosentes" loadFields="acticodigos,acticodigos2" confirm="46"}
				{btn_command type="button"  value="Eliminar" id="CmdDelete" name="FeGeCmdDeleteActiviPares" form_name="frmPermisosentes" loadFields="acticodigos" confirm="47"}
				{btn_clean table_name="ActiviPares" form_name="frmPermisosentes"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="username"}
{/form}

{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Permisosentes}
</html>
