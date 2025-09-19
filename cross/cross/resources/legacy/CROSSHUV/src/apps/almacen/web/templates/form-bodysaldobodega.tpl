<html>
{loadlabels table_name=Saldobodega&controls[]}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="" onload="" onunload=""}
{form name="frmSaldobodega" method="post"}
  <table border="0" align="center" width="100%">
	    <tr>
	    	<!-- Pinta la ficha de tarea -->
	    	<td class="piedefoto"><div align="center">
	    		{repo_saldobodega}
	    	</div></td>
	    </tr>
  </table>
{/form}
{/body}
{droptmpfile table_name=transfertareas}
</html>