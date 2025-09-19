<?php
class PagerCheck {
	var $id; // unique id for pager (defaults to 'adodb')
	var $db; // ADODB connection object
	var $rs; // recordset generated
	var $curr_page; // current page number before Render() called, calculated in constructor
	var $rows; // number of rows per page
	var $linksPerPage = 10; // number of links per page in navigation bar
	var $showPageLinks;

	var $gridAttributes = 'width=100% border=1';

	// Localize text strings here
	var $first = '<img src="web/images/izquierdaini.gif" border="0" >';
	var $prev = '<img src="web/images/izquierda.gif" border="0" >';
	var $next = '<img src="web/images/derecha.gif" border="0" >';
	var $last = '<img src="web/images/derechafin.gif" border="0" >';
	var $moreLinks = '...';
	var $startLinks = '...';
	var $gridHeader = false;
	var $htmlSpecialChars = true;
	var $page = 'P&aacute;g';
	var $linkSelectedColor = 'red';
	var $cache = 0; #secs to cache with CachePageExecute()
	var $link = ""; //Added by Cesar Reyes PTS Cali
	var $showPagelimit = false; //if show the page limit for final user
	//Added by Cesar Reyes PTS Cali For format html
	var $sql; // added by Diego Ramirez Software House
	var $sbreq = "";
	var $rcreq = array ();
	var $table = "";
	var $view_fields = "";
	var $order_by = "";
	var $sql_order_by = "";
	var $rclabels = array ();
	var $sbhiden = ""; //add  by Diego Ramirez Software House

	function pagerGrid($rcreq, $rclabels, $id = 'adodb', $showPageLinks = false, $showPagelimit = false) {
		//global $_SERVER, $PHP_SELF, $_SESSION, $HTTP_GET_VARS, $_REQUEST;

		$curr_page = $id.'_curr_page';

		if (empty ($PHP_SELF))
			$PHP_SELF = $_SERVER['PHP_SELF'];

		$this->sbreq = "action=".$rcreq["action"]."&table=".$rcreq["table"]."&view_fields=".$rcreq["view_fields"]."&field_return="
		.$rcreq["field_return"]."&key_return=".$rcreq["key_return"]."&checkbox=".$rcreq["checkbox"]."&checkbox_value=".$rcreq["checkbox_value"];
		$this->sbhiden = "<input type=hidden name='table' value='".$rcreq["table"]."'>";
		$this->sbhiden .= "<input type=hidden name='view_fields' value='".$rcreq["view_fields"]."'>";
		$this->sbhiden .= "<input type=hidden name='field_return' value='".$rcreq["field_return"]."'>";
		$this->sbhiden .= "<input type=hidden name='key_return' value='".$rcreq["key_return"]."'>";
		$this->sbhiden .= "<input type=hidden name='".$id."_next_page' value='".$_REQUEST[$id."_next_page"]."' >";
		$this->sbhiden .= "<input type=hidden name='link'>";
		$this->sbhiden .= "<input type=hidden name='checkbox' value='".$rcreq["checkbox"]."' >";
		$this->sbhiden .= "<input type=hidden name='checkbox_value' value='".$rcreq["checkbox_value"]."' >";
		$this->sbhiden .= "<input type=hidden name='order_by' value='".$_REQUEST["order_by"]."'>";
		print $this->sbhiden;

		$this->rcreq = $rcreq;
		$this->id = $id;
		$this->db = Application :: getDataGateway("Grid");
		$this->sql = $rcreq["sql"];
		$this->showPageLinks = $showPageLinks;
		$this->link = $PHP_SELF."?".$this->sbreq;
		$this->showPagelimit = $showPagelimit;
		$next_page = $id.'_next_page';

		if (isset ($_REQUEST[$next_page])) {
			$_SESSION[$curr_page] = $_REQUEST[$next_page];
		}
		if (empty ($_SESSION[$curr_page]))
			$_SESSION[$curr_page] = 1; ## at first page

		$this->curr_page = $_SESSION[$curr_page];
		//Verifica si existe ordenamiento
		//$orderby = $rcreq["order_by"];
		$orderby = WebRequest :: getEnvValue("order_by");
		if ($orderby) {
			$this->order_by = "&order_by=".$orderby;
			$this->sql_order_by = $orderby;
		}
		if ($rcreq["order_by"])
			$this->rows = $rcreq["order_by"];
		$this->table = $rcreq["table"];
		$this->viewfields = $rcreq["view_fields"];
		$this->rclabels = $rclabels;
	}

	//---------------------------
	// Display link to first page
	function Render_First($anchor = true) {
		// global $PHP_SELF;
		$form = $this->rcreq["form"];
		if ($anchor) {
			$hidden = $form.".".$this->id."_next_page.value='1'; $form.action.value='".$this->rcreq["action"]."' ";
			print "<a href=\"#\" onClick=\"javascript: $hidden ; disableButtons(); $form.submit();\">".$this->first."</a>";
		} else {
			print "$this->first &nbsp; ";
		}
	}

	//--------------------------
	// Display link to next page
	function render_next($anchor = true) {
		// global $PHP_SELF;
		$form = $this->rcreq["form"];
		if ($anchor) {
			$page = $this->rs->AbsolutePage() + 1;
			$hidden = $form.".".$this->id."_next_page.value='$page'; ".$form.".action.value='".$this->rcreq["action"]."' ";
			print "<a href=\"#\" onClick=\"javascript: $hidden ; disableButtons(); $form.submit();\">".$this->next."</a>";
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
	function render_last($anchor = true) {
		// global $PHP_SELF;
		$form = $this->rcreq["form"];
		if ($anchor) {
			$hidden = $form.".".$this->id."_next_page.value='".$this->rs->LastPageNo()."'; ".$form.".action.value='".$this->rcreq["action"]."' ";
			print "<a href=\"#\" onClick=\"javascript: $hidden ; disableButtons(); $form.submit();\">".$this->last."</a>";
		} else {
			print "$this->last &nbsp; ";
		}
	}

	//---------------------------------------------------
	// original code by "Pablo Costa" <pablo@cbsp.com.br>
	// numeros de pagina.
	function render_pagelinks() {
		// global $PHP_SELF;
		$form = $this->rcreq["form"];
		$pages = $this->rs->LastPageNo();
		$linksperpage = $this->linksPerPage ? $this->linksPerPage : $pages;
		for ($i = 1; $i <= $pages; $i += $linksperpage) {
			if ($this->rs->AbsolutePage() >= $i) {
				$start = $i;
			}
		}
		$numbers = '';
		$end = $start + $linksperpage -1;
		$link = $this->id."_next_page";
		if ($end > $pages)
			$end = $pages;

		if ($this->startLinks && $start > 1) {
			$pos = $start - 1;
			$hidden = $form.".".$this->id."_next_page.value='$pos'; ".$form.".link.value='$pos$this->order_by' ; ".$form.".action.value='".$this->rcreq["action"]."' ";
			$numbers .= " <a href=\"#\" onClick=\"javascript: $hidden ; disableButtons();".$form.".submit();\">".$this->startLinks."</a>";
		}

		for ($i = $start; $i <= $end; $i ++) {
			if ($this->rs->AbsolutePage() == $i)
				$numbers .= " <font color=$this->linkSelectedColor><b>$i</b></font>  ";
			else {
				$hidden = $form.".".$this->id."_next_page.value='$i'; ".$form.".link.value='$i$this->order_by' ; ".$form.".action.value='".$this->rcreq["action"]."' ";
				$numbers .= " <a href=\"#\" onClick=\"javascript: $hidden ; disableButtons();".$form.".submit();\">".$i."</a>";
			}
		}

		if ($this->moreLinks && $end < $pages) {
			$hidden = $form.".".$this->id."_next_page.value='$i'; ".$form.".link.value='$i$this->order_by' ; ".$form.".action.value='".$this->rcreq["action"]."' ";
			$numbers .= " <a href=\"#\" onClick=\"javascript: $hidden ; disableButtons(); ".$form.".submit();\">".$this->moreLinks."</a>";
		}

		print $numbers.' &nbsp; ';

	}

	// Link to previous page
	function render_prev($anchor = true) {
		// global $PHP_SELF;
		$form = $this->rcreq["form"];
		if ($anchor) {
			$page = $this->rs->AbsolutePage() - 1;
			$hidden = $form.".".$this->id."_next_page.value='$page".$this->order_by."'; $form.action.value='".$this->rcreq["action"]."' ";
			//$hidden = $form.".".$this->id."_next_page.value='$page'; $form.action.value='".$this->rcreq["action"]."' ";
			print "<a href=\"#\" onClick=\"javascript: $hidden ; disableButtons(); $form.submit();\">".$this->prev."</a>";
		} else {
			print "$this->prev &nbsp; ";
		}
	}
	//--------------------------------------------------------
	// Simply rendering of grid. You should override this for
	// better control over the format of the grid
	//
	// We use output buffering to keep code clean and readable.
	function RenderGrid() {
		global $gSQLBlockRows; // used by rs2html to indicate how many rows to display
		$s = $this->rs2html($this->gridAttributes, $this->gridHeader, $this->htmlSpecialChars, $this->link, true);
		return $s;
	}

	//-------------------------------------------------------
	// Navigation bar
	//
	// we use output buffering to keep the code easy to read.
	function RenderNav() {
		ob_start();
		if (!$this->rs->AtFirstPage()) {
			$this->Render_First();
			$this->Render_Prev();
		} else {
			$this->Render_First(false);
			$this->Render_Prev(false);
		}
		if ($this->showPageLinks) {
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
	function RenderPageCount() {
		$lastPage = $this->rs->LastPageNo();
		if ($lastPage == -1)
			$lastPage = 1; // check for empty rs.
		return "$this->page ".$this->curr_page."/".$lastPage;
	}

	//-----------------------------------
	// Call this class to draw everything.
	function Render() {
		global $ADODB_COUNTRECS;

		$ADODB_COUNTRECS = true;
		if ($this->sql != "")
		{
			$this->sql = str_replace("\\","",$this->sql);
			$rs = & $this->db->fncexecsql($this->sql, $this->sql_order_by, $this->curr_page,$this->rcreq["num_rows"],$this->rcreq["cache"]);
		}
		else
		{
			$rs = & $this->db->fncexecpage($this->table, $this->rcreq["view_fields"],$this->sql_order_by, $this->curr_page,$this->rcreq["num_rows"],$this->rcreq["cache"]);
		}
		$this->rs = $rs;
		if (!$rs) {
			return;
		}

		if (!$rs->EOF && (!$rs->AtFirstPage() || !$rs->AtLastPage()))
			$header = $this->RenderNav();

		$grid = $this->RenderGrid();
		$footer = $this->RenderPageCount();

		$rs->Close();
		$this->rs = false;
		$this->RenderLayout($header, $grid, $footer);
	}

	//------------------------------------------------------
	// override this to control overall layout and formating
	function RenderLayout($header, $grid, $footer) {
		settype($sbhtml,"string");
		
		$sbhtml = "<table align=\"center\" width=\"100%\">
		     	<tr><th><div align=\"left\"> ".$this->rclabels["title"]." </div></th></tr>";
		     if($header){
		     	$sbhtml .= "<tr><td class='piedefoto'><div align=\"center\">$header</div></td></tr>";
		     }
		$sbhtml .="<tr><td class='piedefoto'>$grid</td></tr><tr><td class='piedefoto'><b>$footer</b></td></tr></table>";
		 echo $sbhtml;
	}

	//Pasa a html un rs
	function rs2html() {
		// global $PHP_SELF;
		$rs = $this->rs;
		$cmd = $this->rcreq["command"];
		$form = $this->rcreq["form"];
		$s = '';
		$rows = 0;
		if (!$rs) {
			printf(ADODB_BAD_RS, 'rs2html');
			return false;
		}

		//else $docnt = true;
		$typearr = array ();
		$ncols = $rs->FieldCount();
		$hdr = "<TABLE align=\"center\" border=\"0\" width=\"100%\">
							<tr>\n";
		if($this->rcreq["checkbox"]){
			$hdr .= "<td class=\"titulofila\"><input type='checkbox' name='checkall' onClick=\"with(document.".$this->rcreq["form"]."){for(var i=0;i<elements.length;i++){if(elements[i].type == 'checkbox'){if(this.checked == true)elements[i].checked = true;else elements[i].checked = false;}}}\"></td>\n";
		}		
		for ($i = 0; $i < $ncols; $i ++) {
			$field = $rs->FetchField($i);
			if ($zheaderarray)
				$fname = $zheaderarray[$i];
			else
				$fname = htmlspecialchars($field->name);
			$typearr[$i] = $rs->MetaType($field->type, $field->max_length);
			if (strlen($fname) == 0)
				$fname = '&nbsp;';
			$sblabel = $this->rclabels[$fname]["label"];

			$hidden = " $form.order_by.value= '$fname'; ".$form.".action.value='".$this->rcreq["action"]."' ";
			$hdr .= "<td class=\"titulofila\"><a class=\"linkconsult\" href=\"#\" onClick=\"javascript: $hidden ; disableButtons(); $form.submit();\">".$sblabel."</a></td>\n";
		}
		$hdr .= "</tr>\n";

		// smart algorithm - handles ADODB_FETCH_MODE's correctly!
		$numoffset = isset ($rs->fields[0]);
		while (!$rs->EOF) {
			
			if (($rows % 2) == 0){
				$estilo = "celda";
			}else{
				$estilo = "celda2";
			}
			
			if($this->rcreq["checkbox"]){
			$s = "<TD class='$estilo'><input type=\"checkbox\" id=\"".$rs->fields[$this->rcreq["checkbox_value"]]."\" name=\"".$rs->fields[$this->rcreq["checkbox_value"]]."\" value=\"".$rs->fields[$this->rcreq["checkbox_value"]]."\"></TD>\n";
			}else{
				$s = '';
			}

			for ($i = 0; $i < $ncols; $i ++) {

				if ($i === 0)
					$v = ($numoffset) ? $rs->fields[0] : reset($rs->fields);
				else
					$v = ($numoffset) ? $rs->fields[$i] : next($rs->fields);

				$v = trim($v);
				if (strlen($v) == 0)
					$v = '&nbsp;';

				$s .= "<TD class='$estilo'>".str_replace("\n", '<br>', stripslashes($v))."</TD>\n";
			} // for
			//Si se ejecuta el onclick del registro
			if($cmd){
				$key = explode(",", $this->rcreq["key_return"]);
				foreach($key as $k => $nameField){
					$rcTmp[$k] = $rs->fields[$nameField];
				}
				$onClick = "onClick=\"javascript:".$this->rcreq["jsfunction"]."('$cmd','".implode("','",$rcTmp)."')\"";
			}
			$hdr .= "<TR  onmouseover=\"this.style.backgroundColor='#FFFF33';\"  onmouseout=\"this.style.backgroundColor=this.style.color;\"  $onClick>\n";
			$hdr .= $s;
			$hdr .= "</TR>\n";
			$rows ++;
			$rs->MoveNext();
		} // while
		$hdr .= "</TABLE>\n";
		unset ($rs1);
		return $hdr;
	}
}
?>