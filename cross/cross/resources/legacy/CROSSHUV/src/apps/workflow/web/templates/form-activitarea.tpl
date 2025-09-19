<html>
{loadlabels table_name=Activitarea&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmActivitarea" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=tarecodigos&blBold=true}</td>
      <td>{select_row_table id="tarecodigos" name="activitarea__tarecodigos" sqlid="tarea" table_name="tarea" value="tarecodigos" label="tarenombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tarecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=acticodigos&blBold=true}</td>
      <td>{select_row_table id="acticodigos" name="activitarea__acticodigos" sqlid="actividad" table_name="actividad" value="acticodigos" label="actinombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=acticodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=actavalorn}</td>
      <td>{textfield id="actavalorn" name="activitarea__actavalorn" maxlength="12" typeData="double"}</td>
  	<td class="piedefoto">{printcoment name=actavalorn}</td>
   </tr>
   <tr>
   
      <td>{printlabel name=actaobligats}</td>
      <td>{select_state id="actaobligats" name="activitarea__actaobligats" option="1" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=actaobligats}</td>
   </tr>
   <tr>
      <td>{printlabel name=actaordenn}</td>
      <td>{textfield id="actaordenn" name="activitarea__actaordenn" maxlength="4" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=actaordenn}</td>
   </tr>
   <tr>
      <td>{printlabel name=actaporcetan}</td>
      <td>{textfield id="actaporcetan" name="activitarea__actaporcetan" maxlength="5" typeData="double"}</td>
  	<td class="piedefoto">{printcoment name=actaporcetan}</td>
   </tr>
   <tr>
      <td>{printlabel name=actaactivas}</td>
      <td>{select_estado id="actaactivas" name="activitarea__actaactivas" table="activitarea"}</td>
  	<td class="piedefoto">{printcoment name=actaactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeWFCmdAddActivitarea" form_name="frmActivitarea"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeWFCmdUpdateActivitarea" form_name="frmActivitarea" loadFields="activitarea__tarecodigos,activitarea__acticodigos" confirm="9"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeWFCmdDeleteActivitarea" form_name="frmActivitarea" loadFields="activitarea__tarecodigos,activitarea__acticodigos" confirm="10"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeWFCmdShowListActivitarea" form_name="frmActivitarea"}
				{btn_clean table_name="Activitarea" form_name="frmActivitarea"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Activitarea}
</html>