<html> 
{loadlabels table_name=Permisions&controls[]=CmdAdd}
{head}
      <title>Permisions</title>
{putstyle style=""}
{putjsfiles files[]=select_list.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmPermisions" method="post"}
  <table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	&nbsp;
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
	<tr>
      <td>{printlabel name=schecodigon&blBold=true}</td>
      <td>{select_father name="schecodigon"
		                table_papa="schecodigon" 
		                id_papa="schecodigon" 
		                label_papa="schenombres"
                         sqlid="schema"
		                command_default="FePrCmdDefaultPermisions"}<B>*</B>
     </td>
  	<td class="piedefoto">{printcoment name=schecodigon}</td>
   </tr>
          <tr>
		      <td>{printlabel name=applcodigos&blBold=true}</td>
		      <td colspan="2">{select_father name="applcodigos"
		                table_papa="applications" 
		                id_papa="applcodigos" 
		                label_papa="applnombres"
                         sqlid="applications"
		                command_default="FePrCmdDefaultPermisions"}<B>*</B>
		      </td>
          </tr>
          <tr>
		      <td>{printlabel name=profcodigos&blBold=true}</td>
		      <td colspan="2">{select_son name="profcodigos"
		     table_hijo="profiles" 
		     id_hijo="profcodigos" 
		     label_hijo="profnombres"
		     select_papa="applcodigos"
		     table_hijo="profiles"
		     sqlid="profiles"
		     command_default="FePrCmdDefaultPermisions"}<B>*</B>      
		      </td>
          </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3" class='piedefoto'>{listas_cargadas table_name="permisions"}</td>
    </tr>
    <tr> 
      <td colspan="3" ><div align="center">
      {btn_selList type="button" value="Adicionar" id="CmdAdd" name="FePrCmdAddPermisions" form_name="frmPermisions" onClick="extractselect(this.form.selTipoCampos,this.form.selected_opt,this.form,this.form.action,'FePrCmdAddPermisions')"} 
        </div></td>
    </tr>
  </table>
{hidden name="selected_opt" value=""}
{hidden name="action" value=""}
{/form}
{putjsacceskey}
{fieldset legend="Resultado"}
   {message id=$cod_message}
{/fieldset}
<br>
{/body}
{droptmpfile table_name=Permisions}

</html>
