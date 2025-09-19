<?php
/**
*   Propiedad intelectual del FullEngine.
*	
*	Pinta la lista de ayuda para cada tabla 
*	@author creyes
*	@date 06-Jul-2004 11:59 
*	@location Cali-Colombia
*/

function smarty_function_print_lsthelp($params, &$smarty) 
{
	$rcreq["action"] = WebRequest::getEnvValue("action");
	$rcreq["table"] = WebRequest::getEnvValue("table");
	$rcreq["view_fields"] = WebRequest::getEnvValue("view_fields");
	$rcreq["field_return"] = WebRequest::getEnvValue("field_return");
	$rcreq["jsobjget"] = WebRequest::getEnvValue("jsobjget");

	$gateway = Application::getDataGateway("LstHelp");
	//Obtiene los datos del usuario
	$rcuser = Application::getUserParam();
	if(!$table && !is_array($rcuser))
		return ;
	//Carga las etiquetas de la tabla en la sesion
	$table_name = strtolower($rcreq["table"]);
	include_once($rcuser["lang"].".".$table_name.".php");
	$parameters["style"] = "web/css/".$rcuser["style"];
	$pager = new Pager($gateway,$parameters["style"],$rcreq,$rclabels,'CR3',true,false);
	$pager->Render();
}

class Pager {
	var $id; 	// unique id for pager (defaults to 'adodb')
	var $db; 	// ADODB connection object
	var $rs;	// recordset generated
	var $curr_page;	// current page number before Render() called, calculated in constructor
	var $rows;		// number of rows per page
    var $linksPerPage=10; // number of links per page in navigation bar
    var $showPageLinks;

	var $gridAttributes = 'width=100% border=1';

	// Localize text strings here
	var $first = '<img src="web/images/list_help/begin.gif" border="0">';
	var $prev = '<img src="web/images/list_help/prev.gif" border="0">';
	var $next = '<img src="web/images/list_help/next.gif" border="0">';
	var $last = '<img src="web/images/list_help/end.gif" border="0">';
	var $moreLinks = '...';
	var $startLinks = '...';
	var $gridHeader = false;
	var $htmlSpecialChars = true;
	var $page = 'Pag';
	var $linkSelectedColor = 'red';
	var $cache = 0;  #secs to cache with CachePageExecute()
    var $link = ""; //Added by Cesar Reyes PTS Cali
    var $showPagelimit = false;//if show the page limit for final user
    //Added by Cesar Reyes PTS Cali For format html
    var $parameters;
    /*
    $parameters["Style"]
    */
    var $sbreq = "";
    var $rcreq = array();
    var $table = "";
    var $view_fields = "";
    var $order_by = "";
    var $sql_order_by = "";
    var $rclabels = array();
     


	//----------------------------------------------
	// constructor
	//
	// $db	adodb connection object
	// $sql	sql statement
	// $id	optional id to identify which pager,
	//		if you have multiple on 1 page.
	//		$id should be only be [a-z0-9]*
	//
	function Pager(&$db,$parameters=false,$rcreq,$rclabels,$id='adodb',$showPageLinks=false,$showPagelimit=false)
	{
		global $_SERVER,$PHP_SELF,$_SESSION,$HTTP_GET_VARS,$_REQUEST;

		$curr_page = $id.'_curr_page';
		if (empty($PHP_SELF)) 
			$PHP_SELF = $_SERVER['PHP_SELF'];
		$this->sbreq = "action=".$rcreq["action"]."&table=".$rcreq["table"]."&view_fields=".$rcreq["view_fields"]."&field_return=".$rcreq["field_return"]."&jsobjget=".$rcreq["jsobjget"];
		$this->rcreq = $rcreq;
		$this->id = $id;
		$this->db = $db;
		$this->showPageLinks = $showPageLinks;
        $this->link = $PHP_SELF."?".$this->sbreq;
        $this->parameters = $parameters;
        $this->showPagelimit = $showPagelimit;
		$next_page = $id.'_next_page';

        if (isset($HTTP_GET_VARS[$next_page])) {
			$_SESSION[$curr_page] = $HTTP_GET_VARS[$next_page];
		}
		if (empty($_SESSION[$curr_page])) 
			$_SESSION[$curr_page] = 1; ## at first page

		$this->curr_page = $_SESSION[$curr_page];
        //Verifica si existe ordenamiento
        $orderby = WebRequest::getEnvValue("order_by");
        if($orderby)
        {
        	$this->order_by = "&order_by=".$orderby;
            $this->sql_order_by = $orderby;
        }
        if(WebRequest::getEnvValue("order_by"))
        	$this->rows = WebRequest::getEnvValue("order_by");
        $this->table = WebRequest::getEnvValue("table");
        $this->viewfields = WebRequest::getEnvValue("view_fields");
        $this->rclabels = $rclabels;
	}

	//---------------------------
	// Display link to first page
	function Render_First($anchor=true)
	{
		global $PHP_SELF;
		if ($anchor) {
			echo "<a href=\"$PHP_SELF?".$this->sbreq."&".$this->id."_next_page=1".$this->order_by."\">".$this->first."</a>&nbsp; ";
		} else {
			print "$this->first &nbsp; ";
		}
	}

	//--------------------------
	// Display link to next page
	function render_next($anchor=true)
	{
		global $PHP_SELF;
		if ($anchor) {
        	$page = $this->rs->AbsolutePage() + 1;
			echo "<a href=\"$PHP_SELF?".$this->sbreq."&".$this->id."_next_page=$page".$this->order_by."\">".$this->next."</a> &nbsp;";
		} else {
			print "$this->next &nbsp; ";
		}
	}

	//------------------
	// Link to last page
	//
	// for better performance with large recordsets, you can set
	// $this->db->pageExecuteCountRows = false, which disables
	// last page counting.
	function render_last($anchor=true)
	{
		global $PHP_SELF;

		if ($anchor) {
			echo "<a href=\"$PHP_SELF?".$this->sbreq."&".$this->id."_next_page=".$this->rs->LastPageNo().$this->order_by."\">".$this->last."</a> &nbsp;";
		} else {
			print "$this->last &nbsp; ";
		}
	}

	//---------------------------------------------------
	// original code by "Pablo Costa" <pablo@cbsp.com.br>
        function render_pagelinks()
        {
        	global $PHP_SELF;
            $pages        = $this->rs->LastPageNo();
            $linksperpage = $this->linksPerPage ? $this->linksPerPage : $pages;
            for($i=1; $i <= $pages; $i+=$linksperpage)
            {
                if($this->rs->AbsolutePage() >= $i)
                {
                    $start = $i;
                }
            }
			$numbers = '';
            $end = $start+$linksperpage-1;
			$link = $this->id . "_next_page";
            if($end > $pages) $end = $pages;


			if ($this->startLinks && $start > 1) {
				$pos = $start - 1;
				$numbers .= "<a href=$PHP_SELF?".$this->sbreq."&$link=$pos$this->order_by>$this->startLinks</a>  ";
            }

			for($i=$start; $i <= $end; $i++) {
                if ($this->rs->AbsolutePage() == $i)
                    $numbers .= "<font color=$this->linkSelectedColor><b>$i</b></font>  ";
                else
                     $numbers .= "<a href=$PHP_SELF?".$this->sbreq."&$link=$i$this->order_by>$i</a>  ";

            }
			if ($this->moreLinks && $end < $pages)
				$numbers .= "<a href=$PHP_SELF?".$this->sbreq."&$link=$i$this->order_by>$this->moreLinks</a>  ";
            print $numbers . ' &nbsp; ';
        }
	// Link to previous page
	function render_prev($anchor=true)
	{
		global $PHP_SELF;
		if ($anchor) {
        	$page = $this->rs->AbsolutePage() - 1;
			echo "<a href=$PHP_SELF?".$this->sbreq."&".$this->id."_next_page=$page".$this->order_by.">".$this->prev."</a> &nbsp;";

		} else {
			print "$this->prev &nbsp; ";
		}
	}
	//--------------------------------------------------------
	// Simply rendering of grid. You should override this for
	// better control over the format of the grid
	//
	// We use output buffering to keep code clean and readable.
	function RenderGrid()
	{
		global $gSQLBlockRows; // used by rs2html to indicate how many rows to display
		$s = $this->rs2html($this->gridAttributes,$this->gridHeader,$this->htmlSpecialChars,$this->link,true);
		return $s;
	}

	//-------------------------------------------------------
	// Navigation bar
	//
	// we use output buffering to keep the code easy to read.
	function RenderNav()
	{
		ob_start();
		if (!$this->rs->AtFirstPage()) {
			$this->Render_First();
			$this->Render_Prev();
		} else {
			$this->Render_First(false);
			$this->Render_Prev(false);
		}
        if ($this->showPageLinks){
            $this->Render_PageLinks();
        }
		if (!$this->rs->AtLastPage()) {
			$this->Render_Next();
			$this->Render_Last();
		} else {
			$this->Render_Next(false);
			$this->Render_Last(false);
		}
		$s = ob_get_contents();
		ob_end_clean();
		return $s;
	}

	//-------------------
	// This is the footer
	function RenderPageCount()
	{
		$lastPage = $this->rs->LastPageNo();
		if ($lastPage == -1) 
			$lastPage = 1; // check for empty rs.
		return "$this->page ".$this->curr_page."/".$lastPage;
	}

	//-----------------------------------
	// Call this class to draw everything.
	function Render()
	{
   		global $ADODB_COUNTRECS;

		$ADODB_COUNTRECS = true;
		$rs = &$this->db->fncexecpage($this->table,$this->viewfields,$this->sql_order_by,$this->curr_page);
		$this->rs = $rs;
		if (!$rs) {
			return;
		}

		if (!$rs->EOF && (!$rs->AtFirstPage() || !$rs->AtLastPage()))
			$header = $this->RenderNav();
		else
			$header = "&nbsp;";

		$grid = $this->RenderGrid();
		$footer = $this->RenderPageCount();
		$rs->Close();
		$this->rs = false;
		$this->RenderLayout($header,$grid,$footer);
	}

	//------------------------------------------------------
	// override this to control overall layout and formating
	function RenderLayout($header,$grid,$footer)
	{
		echo "<table align=\"center\">
        		<tr>
                	<td>
                    	<div align=\"center\">
                        	".$this->rclabels["title"]."
                        </div>
                    </td>
                </tr>
        		<tr>
                	<td>
                    	<div align=\"center\">
                        	$header
                        </div>
                    </td>
                </tr>
                <tr>
                	<td >
                    	$grid
                    </td>
                </tr>
                <tr>
                	<td >
                    	$footer
                    </td>
                </tr>
             </table>";
	}
	//Pasa a html un rs
	function rs2html()
	{
		global $PHP_SELF;
		$rs = $this->rs;
		$s ='';
		$rows=0;
		if (!$rs) {
			printf(ADODB_BAD_RS,'rs2html');
			return false;
		}
	
		//else $docnt = true;
		$typearr = array();
		$ncols = $rs->FieldCount();
		$hdr = "<TABLE align=\"center\" border=\"1\" cellspacing=\"0\" cellspadding=\"0\">
					<tr>\n";
		for ($i=0; $i < $ncols; $i++) {
			$field = $rs->FetchField($i);
			if ($zheaderarray) 
				$fname = $zheaderarray[$i];
			else 
				$fname = htmlspecialchars($field->name);
			$typearr[$i] = $rs->MetaType($field->type,$field->max_length);
	 
			if (strlen($fname)==0) 
				$fname = '&nbsp;';
			$sblabel = $this->rclabels[$fname];
			$hdr .= "<th><a href=\"$PHP_SELF?".$this->sbreq."&order_by=".$fname."\">$sblabel</a></TH>\n";
		}
		$hdr .= "</tr>\n";
	
		// smart algorithm - handles ADODB_FETCH_MODE's correctly!
		$numoffset = isset($rs->fields[0]);
		while (!$rs->EOF) {
	
			$s = '';
			for ($i=0; $i < $ncols; $i++) {
				if ($i===0) 
					$v = ($numoffset) ? $rs->fields[0] : reset($rs->fields);
				else 
					$v = ($numoffset) ? $rs->fields[$i] : next($rs->fields);
					
				$value = $rs->fields[$this->rcreq["field_return"]];
				$v = trim($v);
				if (strlen($v) == 0) 
					$v = '&nbsp;';
					else
						$v = htmlentities ($v);
				$s .= "<TD>". str_replace("\n",'<br>',stripslashes($v)) ."</TD>\n";
			} // for
			$hdr .= "<TR 
						onmouseover=\"this.style.backgroundColor='#ffff72';\"  
						onmouseout=\"this.style.backgroundColor=this.style.color;\"
						onclick=\"fncloadvalue('$value','".$this->rcreq["jsobjget"]."')\"
					>\n";
			$hdr .= $s;
			$hdr .=  "</TR>\n";
			$rows ++;
			$rs->MoveNext();
		} // while
		$hdr .= "</TABLE>\n";
		unset($rs1);
		return $hdr;
	}
}
?>