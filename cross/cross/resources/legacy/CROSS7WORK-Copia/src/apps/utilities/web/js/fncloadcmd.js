/**
	Se usa para cargar en el frame de trabajo los requesitos del menu
	@author: Cesar Reyes
*/
function fncLoadCmd(Cmd,app)
{
	if(Cmd == '')
		return;
	parent.mainFrame.location.href="../"+app+"/index.php?action="+Cmd;
	return;
}