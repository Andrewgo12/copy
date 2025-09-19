<html>
{loadlabels table_name=Areacausante&controls[]=CmdShow&controls[]=CmdClean}
{head} 
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=fncWindowOpen.js&files[]=libCalendar.js&files[]=libCalendarPopupCode.js&files[]=AutoCompletar.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
<br>
{form name="frmDetalle" method="post"}
<table border="0" align="center" width="80%">
  	<tr><td class="piedefoto" colspan="3"><div align="center">
		{help_context}
  	</div></td></tr>
	<tr><th colspan="3"><div align="left">{printtitle}</div></th></tr>
	<tr><th colspan="3"><div align="left">&nbsp;</div></th></tr>
	
   <tr>
      <td>{printlabel name=ordefecingdini&blBold=true}</td>
      <td>
      {calendar id="ordefecingdini" name="orden__ordefecingdini" is_null="true" form_name ="frmDetalle" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdini}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecingdfin&blBold=true}</td>
      <td>
      {calendar id="ordefecingdfin" name="orden__ordefecingdfin" is_null="true" form_name ="frmDetalle" }
      <b>*</b></td>
  	<td class="piedefoto">{printcoment name=ordefecingdfin}</td>
   </tr>

   <tr>
      <td>{printlabel name=ordefecdiginin}</td>
      <td>
      {calendar id="ordefecdiginin" name="orden__ordefecdiginin" is_null="true" hour="true" form_name ="frmDetalle" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecdiginin}</td>
   </tr>
   <tr>
      <td>{printlabel name=ordefecdigfinn}</td>
      <td>
      {calendar id="ordefecdigfinn" name="orden__ordefecdigfinn" is_null="true" hour="true" form_name ="frmDetalle" }
      </td>
  	<td class="piedefoto">{printcoment name=ordefecdigfinn}</td>
   </tr>

   <tr>
      <td>{printlabel name=reporte&blBold=true}</td>
      <td>
          <select name="reporte" id="reporte" onChange="selectTipo(this,document.frmDetalle.tipoorden,document.frmDetalle.dependencia);">
            <option selected>---</option>
            <option value="tipos">{printlabel name=tipos}</option>
            <option value="estado_time">{printlabel name=estado_time}</option>
            <option value="tipo">{printlabel name=tipo}</option>
            <option value="desagregado">{printlabel name=desagregado}</option>
          </select><b>*</b>
      </td>
  	<td class="piedefoto">{printcoment name=reporte}</td>
   </tr>
   <tr>
      <td>{printlabel name=tipoorden}</td>
      <td>
          <select name="tipoorden" id="tipoorden">
          <option selected>---</option>
          </select>
      </td>
  	<td class="piedefoto">{printcoment name=reporte}</td>
   </tr>
   <tr>
      <td>{printlabel name=dependencia}</td>
      <td>
          <select name="dependencia" id="dependencia">
          <option selected>---</option>
          </select>
      </td>
  	<td class="piedefoto">{printcoment name=dependencia}</td>
   </tr>
   
	<tr>
		<td colspan="2">&nbsp;</td>
		<td class="piedefoto"></td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				{btn_button value="Consultar" id="CmdShow"	name="consultar"
					onClick="if(valDatos())fncopenwindows('FeCrCmdDefaultRepAreaCausante','ordefecingdini='+document.frmDetalle.orden__ordefecingdini.value+'&ordefecingdfin='+document.frmDetalle.orden__ordefecingdfin.value+'&reporte='+document.frmDetalle.reporte.value+'&tipoorden='+document.frmDetalle.tipoorden.value+'&dependencia='+document.frmDetalle.dependencia.value+'&ordefecdiginin='+this.form.orden__ordefecdiginin.value+'&ordefecdigfinn='+this.form.orden__ordefecdigfinn.value);"
                }
		</div>
		</td>
		<td class="piedefoto"></td>
	</tr>
</table>
{hidden name="action" value=""}
{hidden name="tipo" value=""}
{/form}
{selecttipos opcion="1"}
{putjsacceskey}
{fieldset}
   {message id=$cod_message}
{/fieldset}
{/body}
{droptmpfile table_name=Detalle}
</html>