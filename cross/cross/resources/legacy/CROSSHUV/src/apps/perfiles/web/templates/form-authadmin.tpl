<html>
{loadlabels table_name=Auth&controls[]=CmdAdd&controls[]=CmdUpdate&controls[]=CmdDelete&controls[]=CmdShow&controls[]=CmdClean}
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
      <td>{printlabel name=authusernams&blBold=true}</td>
      <td>
        {php}
            echo $_REQUEST["auth__authusernams"];
        {/php}
      </td>
  	<td class="piedefoto">{printcoment name=authusernams}</td>
   </tr>
   <tr>
      <td>{printlabel name=authuserpasss&blBold=true}</td>
      <td>{textfield id="authuserpasss" name="auth__authuserpasss" maxlength="100" type="password"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=authuserpasss}</td>
   </tr>
   <tr>
      <td>{printlabel name=authrealname&blBold=true}</td>
      <td>{textfield id="authrealname" name="auth__authrealname" maxlength="100"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=authrealname}</td>
   </tr>
   <tr>
      <td>{printlabel name=authrealape1}</td>
      <td>{textfield id="authrealape1" name="auth__authrealape1" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=authrealape1}</td>
   </tr>
   <tr>
      <td>{printlabel name=authrealape2}</td>
      <td>{textfield id="authrealape2" name="auth__authrealape2" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=authrealape2}</td>
   </tr>
   <tr>
      <td>{printlabel name=authemail}</td>
      <td>{textfield id="authemail" name="auth__authemail" maxlength="100"}</td>
  	<td class="piedefoto">{printcoment name=authemail}</td>
   </tr>
    <!--<tr>
        <td>{printlabel name=applcodigos&blBold=true}</td>
		<td>
            {select_father name="auth__applcodigos"
		        table_papa="applications" 
		        id_papa="applcodigos" 
		        label_papa="applnombres"
                sqlid="applications"
		        command_default="FePrCmdDefaultAuth"}<B>*</B> 
		</td>
        <td class="piedefoto">{printcoment name=applcodigos}</td>
    </tr>-->
    <!--<tr>
	   <td>{printlabel name=profcodigos&blBold=true}</td>
	   <td>
		{select_son name="auth__profcodigos"
	        table_hijo="profiles" 
            id_hijo="profcodigos" 
			label_hijo="profnombres"
			select_papa="auth__applcodigos"
			table_hijo="profiles"}<B>*</B></td>
        <td class="piedefoto">{printcoment name=profcodigos}</td>
    </tr>-->   
   <!--<tr>
      <td>{printlabel name=stylcodigos&blBold=true}</td>
      <td>{select_son name="auth__stylcodigos"
		     table_hijo="style" 
		     id_hijo="stylcodigos"
		     label_hijo="stylnombres"
		     select_papa="auth__applcodigos"
		     table_hijo="style"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=stylcodigos}</td>
   </tr>-->
   <tr>
      <td>{printlabel name=langcodigos&blBold=true}</td>
      <td>{select_row_table id="langcodigos" name="auth__langcodigos" table_name="language" value="langcodigos" label="langnombres" is_null="true"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=langcodigos}</td>
   </tr>
   <!--<tr>
      <td>{printlabel name=schecodigon&blBold=true}</td>
      <td>{select_row_table 
              id="schecodigon" 
              name="auth__schecodigon" 
              table_name="schema" 
              value="schecodigon" 
              label="schenombres" 
              is_null="true"
              sqlid="schema"
            }<B>*</B></td>
  	<td class="piedefoto">{printcoment name=schecodigon}</td>
   </tr>-->
   <!--<tr>
      <td>{printlabel name=authestados}</td>
      <td>{select_estado id="authestados" name="auth__authestados" table="auth"}</td>
  	<td class="piedefoto">{printcoment name=authestados}</td>
   </tr>-->
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
                {btn_command type="button" value="Modificar" id="CmdUpdate" name="FePrCmdUpdateAuth" form_name="frmAuth" loadFields="auth__authusernams,auth__authuserpasss,auth__authrealname,auth__stylcodigos,auth__langcodigos,auth__profcodigos" confirm="11"}
				{btn_command type="button" value="Consultar" id="CmdShow" name="FePrCmdShowListAuth" form_name="frmAuth"}
				{btn_clean table_name="Auth" form_name="frmAuth"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""} 
{hidden name="auth__authusernams"} 
{hidden name="auth__applcodigos"} 
{hidden name="auth__profcodigos"} 
{hidden name="auth__stylcodigos"} 
{hidden name="auth__schecodigon"} 
{hidden name="auth__authestados"} 
{hidden name="auth__schecodigon"} 
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Auth}
</html>