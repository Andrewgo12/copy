<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Opcionrepues&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
<title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmOpcionrepues" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
   
   <tr>
      <td>{printlabel name=opredescrisp&blBold=true}</td>
      <td>{textarea id="opredescrisp" name="opcionrepues__opredescrisp" cols="100" rows="3" }{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=opredescrisp}</td>
   </tr>
   <tr>
      <td>{printlabel name=morecodigon}</td>
      <td>{select_row_table name="opcionrepues__morecodigon" id="morecodigon" table_name="modeloresp" is_null="true" value="morecodigon" label="morenombres"}</td>
  	<td class="piedefoto">{printcoment name=morecodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=opreactivas}</td>
      <td>{select_estado id="pregactivas" name="opcionrepues__opreactivas" table="opcionrepues"}</td>
  	<td class="piedefoto">{printcoment name=opreactivas}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeEnCmdAddOpcionrepues" form_name="frmOpcionrepues"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeEnCmdUpdateOpcionrepues" form_name="frmOpcionrepues" loadFields="opcionrepues__oprecodigon,opcionrepues__opredescrisp" confirm="12"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeEnCmdDeleteOpcionrepues" form_name="frmOpcionrepues" loadFields="opcionrepues__oprecodigon" confirm="13"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeEnCmdShowListOpcionrepues" form_name="frmOpcionrepues"}
				{btn_clean table_name="Opcionrepues" form_name="frmOpcionrepues"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="opcionrepues__oprecodigon"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Opcionrepues}
</html>
