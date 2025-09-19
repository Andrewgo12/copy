<html>
{head}
       <title> Menu Principal</title>
       
{/head}
<body>
<h2>Menu Principal</h2>
<hr>

{form name="frmMenu" method="get"}
 <ul>
  <li><a href="#" onClick="action.value='CmdDefaultLocalizacion';frmMenu.submit();">Localizacion</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultTipolocaliza';frmMenu.submit();">Tipolocaliza</a><br></li>
</ul>
   {hidden name="action" value=""}
{/form}
</body>
</html>