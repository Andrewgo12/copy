<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
{loadlabels table_name=Head&controls[]=CmdAdd}
{head}
<title></title>


{putstyle style="head.css"}
{putjsfiles files[]=cmdExit.js&files[]=headControl.js&files[]=prototype/dist/prototype.js&files[]=fncWindowOpen.js}

{/head}
<body>
{form name="frmHead" method="post"}
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="web/images/inicio.barrasuperior_01.png" width="716" height="70">
    	<div id="tools" class="toolsStart">
    		&nbsp;&nbsp;&nbsp;
    		<a href="javascript:controlLeftFrame()"><img src="web/images/IconosCross.arbol.png" width="25" height="25" border="0" title="{printlabel name=arbol}"></a>&nbsp;
    		<a href="mailto:soporte_fullengine@hotmail.com"><img src="web/images/IconosCross.mensajes.png" width="25" height="25" border="0" title="{printlabel name=contacto}"></a>&nbsp;
    		<a href="#" onClick="{geturlhelp}"><img src="web/images/IconosCross.manual.png" width="25" height="25" border="0" title="{printlabel name=ayuda}"></a>&nbsp;
    		<a href="#" onClick="jsShowAbout();"><img src="web/images/IconosCross.preguntas.png" width="25" height="25" border="0" title="{printlabel name=acerca}"></a>&nbsp;
    		<a href="javascript:cmdExit()"><img src="web/images/IconosCross.error.png" width="25" height="25" border="0" title="{printlabel name=salir}"></a>&nbsp;    		
    		{data_personal}
    	<div>
    </td>
    <td  width="300" background="web/images/inicio.barrasuperior_02.png" height="70" >&nbsp;</td>
    <td class="single1" background="web/images/inicio.barrasuperior_02.png" width="487" align="left" valign="bottom" height="70">{set_schema}</td>
    {logo_emp}
  </tr>
</table>
{hidden name="action" value="FeGeCmdDefaultHead"}
{/form}
</body>
{droptmpfile table_name=Head}
</html>