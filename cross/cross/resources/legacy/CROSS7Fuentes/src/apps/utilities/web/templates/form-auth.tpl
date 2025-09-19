<html>
{loadlabels table_name=Auth&controls[]=CmdUpdate&controls[]=CmdClean&controls[]=CmdUpdatepass&controls[]=CmdCleanpass}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmAuth" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
		<td colspan="2">{printcoment name=authusernams}</td>
		<td class="piedefoto"></td>
	</tr>
   <tr>
      <td>{printlabel name=authusernams}</td>
      <td>{printtext name="auth__authusernams"}</td>
  	<td class="piedefoto"></td>
   </tr>
   <tr>
      <td>{printlabel name=authrealname}</td>
      <td>{printtext name="auth__authrealname"}</td>
  	<td class="piedefoto">{printcoment name=authrealname}</td>
   </tr>
   <tr>
      <td>{printlabel name=authrealape1}</td>
      <td>{printtext name="auth__authrealape1"}</td>
  	<td class="piedefoto">{printcoment name=authrealape1}</td>
   </tr>
   <tr>
      <td>{printlabel name=authrealape2}</td>
      <td>{printtext name="auth__authrealape2"}</td>
  	<td class="piedefoto">{printcoment name=authrealape2}</td>
   </tr>
   <tr>
      <td>{printlabel name=authemail}</td>
      <td>{printtext name="auth__authemail"}</td>
  	<td class="piedefoto">{printcoment name=authemail}</td>
   </tr>
   <tr>
      <td>{printlabel name=stylcodigos&blBold=true}</td>
      <td>{set_application name="auth__applcodigos"}
      	  {select_son name="auth__stylcodigos"
		     table_hijo="style" 
		     id_hijo="stylcodigos"
		     label_hijo="stylnombres"
		     select_papa="auth__applcodigos"
		     table_hijo="style"
		     sqlid="style"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=stylcodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=langcodigos&blBold=true}</td>
      <td>
      {select_dataservices id="langcodigos" service="Profiles" method="getAllLanguage" name="auth__langcodigos" value="langcodigos" label="langnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=langcodigos}</td>
   </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdate" name="FeGeCmdUpdateAuth" form_name="frmAuth" loadFields="auth__stylcodigos,auth__langcodigos" confirm="46"}
				{btn_clean table_name="Auth" form_name="frmAuth"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td class="piedefoto" colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">{printcoment name=authuserpass}</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
      <td>{printlabel name=authuserpassold&blBold=true}</td>
      <td>{textfield id="authuserpassold" name="auth__authuserpass_old" maxlength="100" type="password"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=authuserpassold}</td>
   </tr>
   <tr>
      <td>{printlabel name=authuserpass&blBold=true}</td>
      <td>{textfield id="authuserpass" name="auth__authuserpass" maxlength="100" type="password"}<B>*</B></td>
  	<td class="piedefoto"></td>
   </tr>
      <tr>
      <td>{printlabel name=authuserpassconfirm&blBold=true}</td>
      <td>{textfield id="authuserpass" name="auth__authuserpass_confirm" maxlength="100" type="password"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=authuserpassconfirm}</td>
   </tr>
   <tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Modificar" id="CmdUpdatepass" name="FeGeCmdUpdatePassAuth" form_name="frmAuth" loadFields="auth__authuserpass_old,auth__authuserpass,auth__authuserpass_confirm" confirm="46"}
				{btn_clean_pass table_name="Auth" form_name="frmAuth"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""} 
{hidden name="auth__authusernams"}
{hidden name="auth__authrealname"}
{hidden name="auth__authrealape1"}
{hidden name="auth__authrealape2"} 
{hidden name="auth__authemail"} 
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Auth}

</html>