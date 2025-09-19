<html>
{loadlabels table_name=Equivalencias&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=prototype/dist/prototype.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js&files[]=jsLoadSelect.js&files[]=jsEquiv.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmEquivalencias" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=equicodigon}</td>
      <td>{textfield id="equicodigon" name="equivalencias__equicodigon" maxlength="5"}</td>
  	<td class="piedefoto">{printcoment name=equicodigon}</td>
   </tr>
   <tr>
      <td>{printlabel name=equitablcros&blBold=true}</td>
      <td>{select_state id="equitablcros" name="equivalencias__equitablcros" option="8" is_null="true" onchange="jsLoadField(1);"}</td>
  	<td class="piedefoto">{printcoment name=equitablcros}</td>
   </tr>
   <tr>
      <td>{printlabel name=equicampcros&blBold=true}</td>
      <td>{div id="div_equicampcros" align="left" style="visibility:visible;"}{printvalue label="equivalencias__equicampcros" blBold=false blFont=true}{/div}{hidden id="equicampcros" name="equivalencias__equicampcros"}</td>
  	<td class="piedefoto">{printcoment name=equicampcros}</td>
   </tr>
   <tr>
      <td>{printlabel name=equivalcros&blBold=true}</td>
      <td>{textfield id="equivalcros" name="equivalencias__equivalcros" maxlength="15"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=equivalcros}</td>
   </tr>
   <tr>
      <td>{printlabel name=equinomcros&blBold=true}</td>
      <td>{textfield id="equinomcros" name="equivalencias__equinomcros" maxlength="250"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=equinomcros}</td>
   </tr>
   
    <tr>
   	  <td>{printlabel name=equiareacros&blBold=true}</td>
      <td>
        {select_entes_esp id="equiareacros" name="equivalencias__equiareacros" form="frmEquivalencias" is_null=true}<b>*</b>
      </td>  
  	<td class="piedefoto">{printcoment name=equiareacros}</td>
   </tr>
   <tr>
      <td>{printlabel name=equitabldocs&blBold=true}</td>
      <td>{select_state id="equitabldocs" name="equivalencias__equitabldocs" option="9" is_null="true" onchange="jsLoadField(2);"}</td>
  	<td class="piedefoto">{printcoment name=equitabldocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=equicampdocs&blBold=true}</td>
      <td>{div id="div_equicampdocs" align="left" style="visibility:visible;"}{printvalue label="equivalencias__equicampdocs" blBold=false blFont=true}{/div}{hidden id="equicampdocs" name="equivalencias__equicampdocs"}</td>
  	<td class="piedefoto">{printcoment name=equicampdocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=equivaldocs&blBold=true}</td>
      <td>{textfield id="equivaldocs" name="equivalencias__equivaldocs" maxlength="5"}<b>*</b></td>
  	<td class="piedefoto">{printcoment name=equivaldocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=equinomdocs&blBold=true}</td>
      <td>{textfield id="equinomdocs" name="equivalencias__equinomdocs" maxlength="250"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=equinomdocs}</td>
   </tr>
   
   <tr>
      <td>{printlabel name=equiareadocs&blBold=true}</td>
      <td>{textfield id="equiareadocs" name="equivalencias__equiareadocs" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=equiareadocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=equiseridocs&blBold=true}</td>
      <td>{textfield id="equiseridocs" name="equivalencias__equiseridocs" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=equiseridocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=equiestados&blBold=true}</td>
      <td>{select_estado table="equivalencias" id="equiestados" name="equivalencias__equiestados" option="2" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=equiestados}</td>
   </tr>

	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddEquivalencias" form_name="frmEquivalencias"}
		    	{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateEquivalencias" form_name="frmEquivalencias"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete"  table="equivalencias" name="FeGeCmdDeleteEquivalencias" form_name="frmEquivalencias"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeGeCmdShowListEquivalencias" form_name="frmEquivalencias"}
				{btn_clean table_name="Equivalencias" form_name="frmEquivalencias"}
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
{droptmpfile table_name=Equivalencias}
</html>