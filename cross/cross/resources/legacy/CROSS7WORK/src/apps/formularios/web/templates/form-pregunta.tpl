<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Pregunta&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=jsPregunta.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPregunta" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   
   <tr>
      <td>{printlabel name=pregdescris&blBold=true}</td>
      <td>{textarea id="pregdescris" name="pregunta__pregdescris" cols="100" rows="3" }{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=pregdescris}</td>
   </tr>
   <tr>
      <td>{printlabel name=temacodigon&blBold=true}</td>
      <td>{select_row_table name="pregunta__temacodigon" table_name="tema" is_null="true" value="temacodigon" label="temanombres"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=temacodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=pregtipopres&blBold=true}</td>
      <td>{select_constant name="pregunta__pregtipopres" id="TIPO_PREG" labelfont="pregunta" is_null="true" onChange="setModeloRespuesta();"}
      <B>*</B></td>
  	<td class="piedefoto">{printcoment name=pregtipopres}</td>
   </tr>
   <tr>
      <td>{printlabel name=morecodigon}</td>
      <td>{select_row_table name="pregunta__morecodigon" id="morecodigon" table_name="modeloresp" is_null="true" value="morecodigon" label="morenombres"}</td>
  	<td class="piedefoto">{printcoment name=morecodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=pregactivas}</td>
      <td>{select_estado id="pregactivas" name="pregunta__pregactivas" table="pregunta"}</td>
  	<td class="piedefoto">{printcoment name=pregactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeEnCmdAddPregunta" form_name="frmPregunta"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeEnCmdUpdatePregunta" form_name="frmPregunta" loadFields="pregunta__pregcodigon,pregunta__pregdescris,pregunta__temacodigon,pregunta__pregtipopres" confirm="12"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeEnCmdDeletePregunta" form_name="frmPregunta" loadFields="pregunta__pregcodigon" confirm="13"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeEnCmdShowListPregunta" form_name="frmPregunta"}
				{btn_clean table_name="Pregunta" form_name="frmPregunta"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="pregunta__pregcodigon"}
{hidden name="action"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Pregunta}
</html>