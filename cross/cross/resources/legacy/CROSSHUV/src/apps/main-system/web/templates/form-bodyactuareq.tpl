<html>
{loadlabels table_name=Actuareq&controls[]}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles files[]=AutoCompletar.js&files[]=prototype/dist/prototype.js&files[]=encode.js}

{/head}
{body onkeydown="return doKeyDown(event)" onload="" onunload=""}
{form name="frmActuareq" method="post"}
  <table border="0" align="center" width="100%">
        <tr>
    	<!-- El Nombre de la empresa-->
    	<td class="piedefoto">{infocompany}</td>
        </tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
        <tr>
    	<td class="piedefoto">&nbsp;</td>
        </tr>
	    <tr>
	    	<td class="piedefoto"><div align="center">
	    		{actuareq}
	    	</div></td>
	    </tr>
  </table>
{/form}
{/body}
{droptmpfile table_name=FichaOrd}
</html>