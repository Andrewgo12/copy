<html>
{loadlabels table_name=Configarchiv&controls[]=CmdAdd&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmConfigarchiv" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=cogacodigos&blBold=true}</td>
      <td>{textfield id="cogacodigos" name="configarchiv__cogacodigos" maxlength="30"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cogacodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=coganombres&blBold=true}</td>
      <td>{textfield id="coganombres" name="configarchiv__coganombres" maxlength="200"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=coganombres}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogaobservas&blBold=true}</td>
      <td>{textarea id="cogaobservas" name="configarchiv__cogaobservas" cols="40" rows="5" }{/textarea}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cogaobservas}</td>
   </tr>
   <tr>
      <td>{printlabel name=tiarcodigos&blBold=true}</td>
      <td>{select_row_table id="tiarcodigos" name="configarchiv__tiarcodigos" table_name="tipoarchivo" label="tiarnombres" value="tiarcodigos" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=tiarcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogamarmaess}</td>
      <td>{textfield id="cogamarmaess" name="configarchiv__cogamarmaess" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=cogamarmaess}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogamardetas}</td>
      <td>{textfield id="cogamardetas" name="configarchiv__cogamardetas" maxlength="30"}</td>
  	<td class="piedefoto">{printcoment name=cogamardetas}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogaposmaess}</td>
      <td>{textfield id="cogaposmaess" name="configarchiv__cogaposmaess" maxlength="4" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=cogaposmaess}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogaposdetas}</td>
      <td>{textfield id="cogaposdetas" name="configarchiv__cogaposdetas" maxlength="4" typeData="int"}</td>
  	<td class="piedefoto">{printcoment name=cogaposdetas}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogasepainis}</td>
      <td>{select_state id="cogasepainis" name="configarchiv__cogasepainis" option="2" is_null="true"}</td>
  	<td class="piedefoto">{printcoment name=cogasepainis}</td>
   </tr>
   <tr>
      <td>{printlabel name=cogasepafins&blBold=true}</td>
      <td>{select_state id="cogasepafins" name="configarchiv__cogasepafins" option="2" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=cogasepafins}</td>
   </tr>
   <tr>
      <td>{printlabel name=coarencabezs&blBold=true}</td>
      <td>{select_state id="coarencabezs" name="configarchiv__coarencabezs" option="1" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=coarencabezs}</td>
   </tr>
   <tr>
      <td>{printlabel name=coarextencis}</td>
      <td>{textfield id="coarextencis" name="configarchiv__coarextencis" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=coarextencis}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
		    	{btn_command type="button" value="Adicionar" id="CmdAdd" name="FeGeCmdAddConfigarchiv" form_name="frmConfigarchiv"}
				{btn_delete type="button" value="Eliminar" id="CmdDelete"  table="configarchiv" name="FeGeCmdDeleteConfigarchiv" form_name="frmConfigarchiv"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FeGeCmdShowListConfigarchiv" form_name="frmConfigarchiv"}
				{btn_clean table_name="Configarchiv" form_name="frmConfigarchiv"}
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
{droptmpfile table_name=Configarchiv}
</html>