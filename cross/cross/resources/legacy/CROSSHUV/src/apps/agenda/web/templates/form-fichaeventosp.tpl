<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Fichaevento&controls[]=CmdClose}
{head}
<title>{printtitle}</title>

     

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmFichaevento" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	{viewFichaEventoSP}
   
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Cerrar" id="CmdClose" onClick="window.close();" form_name="frmFichaevento"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action"}
{hidden name="entrcodigon"}
{/form}
{putjsacceskey}
<br>
{/body}
{droptmpfile table_name=Fichaevento}


</html>
