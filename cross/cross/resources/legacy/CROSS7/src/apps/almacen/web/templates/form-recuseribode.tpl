<html>
{loadlabels table_name=Recuseribode&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmRecuseribode" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=resbnumedocu blBold=true}</td>
      <td>{textfield id="resbnumedocu" name="recuseribode__resbnumedocu" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=resbnumedocu}</td>
   </tr>
   <tr>
      <td>{printlabel name=recucodigos blBold=true}</td>
      <td>{select_row_table id="recucodigos" name="recuseribode__recucodigos" table_name="recurso" value="recucodigos"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=recucodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=resbserirecu blBold=true}</td>
      <td>{textfield id="resbserirecu" name="recuseribode__resbserirecu" maxlength="20"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=resbserirecu}</td>
   </tr>
   <tr>
      <td>{printlabel name=resbbodeactu blBold=true}</td>
      <td>{textfield id="resbbodeactu" name="recuseribode__resbbodeactu" maxlength="50"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=resbbodeactu}</td>
   </tr>
   <tr>
      <td>{printlabel name=resbbodeante blBold=true}</td>
      <td>{textfield id="resbbodeante" name="recuseribode__resbbodeante" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=resbbodeante}</td>
   </tr>
   <tr>
      <td>{printlabel name=resbfechmovi blBold=true}</td>
      <td>{textfield id="resbfechmovi" name="recuseribode__resbfechmovi" maxlength="4" typeData="int"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=resbfechmovi}</td>
   </tr>
   <tr>
      <td>{printlabel name=perscodigos blBold=true}</td>
      <td>{textfield id="perscodigos" name="recuseribode__perscodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=perscodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddRecuseribode" form_name="frmRecuseribode"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateRecuseribode" form_name="frmRecuseribode"}
				{btn_command type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteRecuseribode" form_name="frmRecuseribode"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListRecuseribode" form_name="frmRecuseribode"}
				{btn_clean table_name="Recuseribode" form_name="frmRecuseribode"}
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
{droptmpfile table_name=Recuseribode}

</html>
