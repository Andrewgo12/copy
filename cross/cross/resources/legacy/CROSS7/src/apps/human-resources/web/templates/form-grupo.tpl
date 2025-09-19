<html>
{loadlabels table_name=Grupo&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=overlib_mini.js&files[]=Calendar.js&files[]=fncWindowOpen.js&files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<br>
{form name="frmGrupo" method="post"}
<table border="0" align="center" width="70%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=grupcodigos&blBold=true}</td>
      <td>{textfield id="grupcodigos" name="grupo__grupcodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grupcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=grupnombres&blBold=true}</td>
      <td>{textfield id="grupnombres" name="grupo__grupnombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=grupnombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=esgrcodigos&blBold=true}</td>
      <td>{select_row_table id="esgrcodigos" name="grupo__esgrcodigos" table_name="estadogrupo" value="esgrcodigos" label="esgrnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=esgrcodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeHrCmdAddGrupo" form_name="frmGrupo"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeHrCmdUpdateGrupo" form_name="frmGrupo" loadFields="grupo__grupcodigos,grupo__grupnombres,grupo__esgrcodigos" confirm="14"}
				{btn_command type="button" value="Eliminar"  id="CmdDelete" name="FeHrCmdDeleteGrupo" form_name="frmGrupo" loadFields="grupo__grupcodigos,grupo__grupnombres,grupo__esgrcodigos" confirm="15"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeHrCmdShowListGrupo" form_name="frmGrupo"}
				{btn_clean table_name="Grupo" form_name="frmGrupo"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
<br><p>
<br><p>
<center>{viewgrupodetalle table="grupodetalle"  form="frmGrupo"}</center>
{hidden name="action" value=""}
{hidden name="grupo__grupcodigon"}
{hidden name="indice" id="indice" value=""}
{hiddenactiveregistry name="grupo__grupactivos"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Grupo}
</html>