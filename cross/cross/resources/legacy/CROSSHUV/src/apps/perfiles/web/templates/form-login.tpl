{loadlabels table_name=Auth&controls[]=CmdAdd}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
{head}
<title>CROSS</title>

{putstyle style="login.css"}
{putjsfiles files[]=headControlLogin.js}

{/head}
<body onkeydown="return doKeyDown(event)" onLoad="putFocus();MM_preloadImages()">
<br />
<br />
<br />
<table align="center" border="0" id="Table_01" width="798" height="530" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="5"><img src="web/images/login.01_01.png" width="798" height="113" alt=""></td>
	</tr>
	<tr> 
		<td rowspan="3"><div id="new" style="height: 294px; width: 399px;"></div></td>
		<td rowspan="3"><img src="web/images/login.01_03.png" width="3" height="294" alt=""></td>
		<td colspan="3">
			<div id="logoempresa" style="height: 127px; width: 396px; text-align:center;">
				<!-- El logo de la empresa cliente -->
				<img src="web/images/logo_empresa.png" alt="">
			</div>
		</td>
	</tr>
	<tr>
    	<td colspan="3">&nbsp;</td>
    </tr>
	<tr>
		<td colspan="3">
		{form name="frmLogin" method="post"}
			<table width="80%"  border="0" align="center" cellpadding="1" cellspacing="1">
          		<tr>
					<td><div align="right">{printlabel name=username} :</div></td>
					<td>{textfield name="username" id="username"}</td>
				</tr>
          		<tr>
            		<td><div align="right">{printlabel name=authuserpasss} :</div></td>
            		<td>{textfield type="password" name="password" id="password"}</td>
          		</tr>
          		<tr>
            		<td colspan="2">&nbsp;</td>
          		</tr>
          		<tr>
            		<td colspan="2"><div align="center">
						{btn_button  type="button" value="Ingresar" id="CmdLoguin" onClick="javascript:document.frmLogin.action.value='FePrCmdLogin';document.frmLogin.submit();"}
						</div>
            		</td>
          		</tr>
        	</table>
        	<input type="hidden" name="action">
		{/form}		
	</td>
	</tr>
	<tr>
		<td colspan="3"><div style="height: 68px; width: 396px;"></div></td>
	</tr>
	<tr>
		<td colspan="5"><img src="web/images/login.01_13_slp.png" width="798" height="93" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="web/images/login.01_14.png" width="798" height="30" alt=""></td>
	</tr>
</table>
{new_message id=$cod_message}
</body>
</html>