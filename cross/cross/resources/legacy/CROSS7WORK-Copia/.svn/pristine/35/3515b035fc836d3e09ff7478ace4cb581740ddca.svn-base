<html>
{loadlabels table_name=Movimialmace&controls[]=CmdAccept&controls[]=CmdAdd1&controls[]=CmdView&controls[]=CmdClean}
{head}
      <title>{printtitle}</title>

{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
{form name="frmMovimialmace" method="post"}
<table border="0" align="center" width="60%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=moalnumedocs&blBold=true}</td>
      <td>{textfield id="moalnumedocs" name="movimialmace__moalnumedocs" maxlength="30" onBlur="if(this.value)is_exist('moalnumedocs',Array('moalnumedocs'),Array(this.value),16)"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=moalnumedocs}</td>
   </tr>
   <tr>
      <td>{printlabel name=tidocodigos&blBold=true}</td>
      <td>
      	{textfield id="tidocodigos" name="movimialmace__tidocodigos" onBlur="if(this.value)autoReference('tipodocument','tidocodigos',Array(this),this.form.movimialmace__tidocodigos_desc)"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=tipodocument&sqlid=tipodocument&return_obj=movimialmace__tidocodigos&return_key=tidocodigos');"
	    }
       {textfield name="movimialmace__tidocodigos_desc"}<B>*</B>
    </td>
  	<td class="piedefoto">{printcoment name=tidocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodecodigos_out&blBold=true}</td>
      <td>
      	{textfield id="bodecodigos_out" name="movimialmace__bodecodigos_out" onBlur="if(this.value)autoReference('bodega','bodecodigos|bodecodigos1',Array(this,this.form.bodecodigos_in),this.form.movimialmace__bodecodigos_out_desc)"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=bodega&sqlid=bodega&return_obj=movimialmace__bodecodigos_out&return_key=bodecodigos');"
	    }
       {textfield name="movimialmace__bodecodigos_out_desc"}<B>*</B>
     </td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=comocodigos_out&blBold=true}</td>
      <td>
      	{textfield id="comocodigos_out" name="movimialmace__comocodigos_out" onBlur="if(this.value)autoReference('concepmovimi_out','comocodigos',Array(this),this.form.movimialmace__comocodigos_out_desc)"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=concepmovimi&sqlid=concepmovimi_out&return_obj=movimialmace__comocodigos_out&return_key=comocodigos');"
	    }
	    {textfield name="movimialmace__comocodigos_out_desc"}<B>*</B>
	 </td>
  	<td class="piedefoto">{printcoment name=comocodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=bodecodigos_in&blBold=true}</td>
      <td>
      	<!--{textfield id="bodecodigos_in" name="movimialmace__bodecodigos_in" onBlur=""}-->
      	{textfield id="bodecodigos_in" name="movimialmace__bodecodigos_in" onBlur="if(this.value)autoReference('bodega','bodecodigos|bodecodigos1',Array(this,this.form.bodecodigos_out),this.form.movimialmace__bodecodigos_in_desc)"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=bodega&sqlid=bodega&return_obj=movimialmace__bodecodigos_in&return_key=bodecodigos');"
	    }
       {textfield name="movimialmace__bodecodigos_in_desc"}<B>*</B>
     </td>
  	<td class="piedefoto">{printcoment name=bodecodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=comocodigos_in}</td>
      <td>
      	{textfield id="comocodigos_in" name="movimialmace__comocodigos_in" onBlur="if(this.value)autoReference('concepmovimi_in','comocodigos',Array(this),this.form.movimialmace__comocodigos_in_desc)"}
	    {href 
	      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
	      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=concepmovimi&sqlid=concepmovimi_in&return_obj=movimialmace__comocodigos_in&return_key=comocodigos');"
	    }
	    {textfield name="movimialmace__comocodigos_in_desc"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=comocodigos}</td>
   </tr>
   <tr>
  	<td colspan='3' class="piedefoto"><hr></td>
   </tr>
   <tr>
      <td>{printlabel name=recucodigos&blBold=true}</td>
      <td>
	  {textfield id="recucodigos" name="movimialmace__recucodigos" onBlur="if(this.value)autoReference('recurso','recucodigos',Array(this),this.form.recucodigos_desc)"}
      {href 
      		label="<img src='web/images/referencia.gif' border='0' align='middle'></img>"
      		onclick="javascript:fncopenwindows('FeStCmdLstHelp','table=recurso&sqlid=recurso&return_obj=movimialmace__recucodigos&return_key=recucodigos');"
      }
      {textfield id="recucodigos_desc" name="movimialmace__recucodigos_desc" }<B>*</B></td>
  	<td class="piedefoto">{printcoment name=recucodigos}</td>
   </tr>
   <tr>
      <td>{printlabel name=moalcantrecf&blBold=true}</td>
      <td>{textfield id="moalcantrecf" name="movimialmace__moalcantrecf" maxlength="10" typeData="double"}<B>*</B></td>
  	<td class="piedefoto">{printcoment name=moalcantrecf}</td>
   </tr>
   <tr>
  	<td colspan="3" class="piedefoto">{printcoment name=serials}</td>
   </tr>
   <!-- Pinta los campos de registro de seriales adicionales si el recurso es seriado -->
   <tr>
 	<td colspan="2" class="piedefoto">
		 <table width="100%">
			<tr>
				<td>{printlabel name=prefix}</td>
				<td>{textfield id="prefix" name="movimialmace__prefix" maxlength="10" size="8"}</td>
				<td>{printlabel name=suffix}</td>
				<td>{textfield id="suffix" name="movimialmace__suffix" maxlength="10" size="8"}</td>
			</tr>
			<tr>
				<td>{printlabel name=serial1}</td>
				<td>{textfield id="serial1" name="movimialmace__serial1" }<b>*</b></td>
				<td>{printlabel name=serial2}</td>
				<td>{textfield id="serial2" name="movimialmace__serial2" }</td>
			</tr>
		</table>
 	</td>
  	<td class="piedefoto"></td>
   </tr>
 	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_command type="button" value="Aceptar" id="CmdAccept" name="FeStCmdUpdateMovimialmace" form_name="frmMovimialmace"}
		    	{btn_command type="button" value="Adicionar" id="CmdAdd1" name="FeStCmdAddMovimialmace" form_name="frmMovimialmace"}
				{btn_command type="button" value="Ver" id="CmdView" name="FeStCmdShowListMovimialmace" form_name="frmMovimialmace"}
				{btn_clean table_name="Movimialmace_in" form_name="frmMovimialmace"}
			</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="focusObject"}
{/form}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{putfocus focusObject=$focusObject form_name="frmMovimialmace"}
<br>
{/body}
{droptmpfile table_name=Movimialmace}
{cleansession signal=$cleanSession}
</html>
