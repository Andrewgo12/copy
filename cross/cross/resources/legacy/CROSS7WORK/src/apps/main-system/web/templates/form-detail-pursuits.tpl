<html>
{loadlabels table_name=Detailpursuit&controls[]=CmdShow}
{head}
      <title>{printtitle}</title>
{putstyle style=""}
{putjsfiles}

{/head}
{body onkeydown="return doKeyDown(event)" onload="putFocus();" onunload=""}
{form name="frmDeatilpursuit" enctype="multipart/form-data" method="post"}
<br>
<br>
  {view_detail_pursuit}
 {/form}
{/body}
</html>