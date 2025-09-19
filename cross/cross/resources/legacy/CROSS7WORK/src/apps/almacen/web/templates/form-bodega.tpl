<html>
{loadlabels table_name=Bodega&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=overlib_mini.js&files[]=Calendar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<br>
{form name="frmBodega" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=bodecodigos&blBold=true}</td>
      <td>{textfield id="bodecodigos" name="bodega__bodecodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=tibocodigos&blBold=true}</td>
      <td>{select_row_table id="tibocodigos" name="bodega__tibocodigos" table_name="tipobodega" value="tibocodigos" label="tibonombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tibocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodenombres&blBold=true}</td>
      <td>{textfield id="bodenombres" name="bodega__bodenombres" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=bodenombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=orgacodigos&blBold=true}</td>
      <td>{select_dataservices service="Human_resources" method="getActiveEntesOrg"  id="orgacodigos" name="bodega__orgacodigos" value="orgacodigos" label="organombres" is_null="true"}<B>*</B>
      </td>
  	<td class="piedefoto">{printcoment name=orgacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodefechcred&blBold=true}</td>
      <td>{calendar id="bodefechcred" name="bodega__bodefechcred" form_name ="frmBodega" icon="web/images/calendar.gif"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=bodefechcred}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodedescrips}</td>
      <td>{textarea id="bodedescrips" name="bodega__bodedescrips" cols="40" rows="5" }{/textarea}</td>
  	<td class="piedefoto">{printcoment name=bodedescrips}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodeestados}</td>
      <td>{select_estado id="bodeestados" name="bodega__bodeestados" table="bodega"}</td>
  	<td class="piedefoto">{printcoment name=bodeestados}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeStCmdAddBodega" form_name="frmBodega"}
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeStCmdUpdateBodega" form_name="frmBodega"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete" name="FeStCmdDeleteBodega" form_name="frmBodega" table="bodega"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeStCmdShowListBodega" form_name="frmBodega"}
				{btn_clean table_name="Bodega" form_name="frmBodega"}
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
{droptmpfile table_name=Bodega}

</html>
