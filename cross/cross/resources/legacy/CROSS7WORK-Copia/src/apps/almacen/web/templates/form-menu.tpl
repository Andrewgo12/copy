<html>
{head}
       <title> Menu Principal</title>
       
{/head}
<body>
<h2>Menu Principal</h2>
<hr>

{form name="frmMenu" method="get"}
 <ul>
  <li><a href="#" onClick="action.value='CmdDefaultBodega';frmMenu.submit();">Bodega</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultConcepmovimi';frmMenu.submit();">Concepmovimi</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultGruporecurso';frmMenu.submit();">Gruporecurso</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultMovimialmace';frmMenu.submit();">Movimialmace</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultProveedor';frmMenu.submit();">Proveedor</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultProveerecurs';frmMenu.submit();">Proveerecurs</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultRecurso';frmMenu.submit();">Recurso</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultRecuseribode';frmMenu.submit();">Recuseribode</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultTipobodega';frmMenu.submit();">Tipobodega</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultTipodocument';frmMenu.submit();">Tipodocument</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultTiporecurso';frmMenu.submit();">Tiporecurso</a><br></li>
  <li><a href="#" onClick="action.value='CmdDefaultUnidadmedida';frmMenu.submit();">Unidadmedida</a><br></li>
</ul>
   {hidden name="action" value=""}
{/form}

</body>
</html>
