<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=schedule&controls[]=CmdClose}
{head}
<title>{printtitle}</title>


{putjsfiles files[]=entrada.js}

{putstyle style=""}


{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEntrada" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	{loadPerscodigos}
	
	<tr>
      <td>{printlabel name=usuacodigos}</td>
      <td>{select_personal id="perscodigos" name="perscodigos" cols="40" rows="5" onChange="onChange='loadPerscodigos(this.value,2);'"}</td>
  	<td class="piedefoto">{printcoment name=usuacodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
	<td colspan="3">
	{viewSchedule_day}
	</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
		
	
</table>
{hidden name="usuacodigos"}
{hidden name="action"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Schedule}


</html>
