<?php   
class FeCrGraphicManager 
{
	//Pude fusilar la clase jpgraph para que traiga el nombre y ubicación de la imagen generada
	var $sbFileName;
	
	/**
	*   Propiedad intelectual del FullEngine.
	*   
	*   Constructor de clase
	*   @param $isbtabla string Nombre de la tabla reflexiva
	*   @author mrestrepo
	*   @date 13-Jul-2006 15:30 
	*   @location Cali-Colombia
	*/
	
	function FeCrGraphicManager() {
		include_once("jpgraph.php");
	}
	
	function createExplode3DPieplot($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_pie.php");
		include_once("jpgraph_pie3d.php");

		$graph = new PieGraph(600,400,"auto");
		$graph->SetShadow();
		
		$this->cutZeroValues($rcX,$rcY);
		if($rcY==false)
			return false;
		
		$graph->title->Set($sbTitle);
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		
		$p1 = new PiePlot3D($rcY);
		$p1->SetAngle(45); 

		foreach ($rcY as $nuKey=>$nuValue)
			$p1->ExplodeSlice($nuKey);
		
		$p1->SetCenter(0.41);
		$p1->SetLegends($rcX);
		$p1->SetEdge();
		
		$graph->Add($p1);
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}
	
	function create3DPieplot($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_pie.php");
		include_once("jpgraph_pie3d.php");
		
		$graph = new PieGraph(600,400,"auto");
		$graph->SetShadow();
		
		$this->cutZeroValues($rcX,$rcY);
		if($rcY==false)
			return false;
		
		$graph->title->Set($sbTitle);
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		
		$p1 = new PiePlot3D($rcY);
		$p1->SetAngle(20);
		$p1->SetSize(0.5);
		$p1->SetCenter(0.4);
		$p1->SetLegends($rcX);
		
		$graph->Add($p1);
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}
	
	function createSimplePieplot($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_pie.php");
		
		$graph = new PieGraph(400,400,"auto");
		$graph->SetShadow();
		
		$this->cutZeroValues($rcX,$rcY);
		if($rcY==false)
			return false;

		$graph->title->Set($sbTitle);
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		
		$p1 = new PiePlot($rcY);
		$p1->SetLegends($rcX);
		
		$p1->SetCenter(0.4);
		$graph->Add($p1);
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}
	
	function createBarCenterValues($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_bar.php");
		
		// Create the graph and setup the basic parameters 
		$graph = new Graph(460,200,'auto');	
		$graph->img->SetMargin(40,30,30,40);
		$graph->SetScale("textint");
		$graph->SetShadow();
		$graph->SetFrame(false); // No border around the graph
		
		// Add some grace to the top so that the scale doesn't
		// end exactly at the max value. 
		$graph->yaxis->scale->SetGrace(100);
		$graph->yaxis->title->Set($rcAditional["y-label"]);
		$graph->yaxis->title->SetFont(FF_FONT2,FS_BOLD);
		
		// Setup X-axis labels
		$graph->xaxis->SetTickLabels($rcX);
		$graph->xaxis->SetFont(FF_FONT2);
		if(sizeof($rcX)>15)
			$graph->xaxis->SetTextTickInterval(5);
		
		// Setup graph title ands fonts
		$graph->title->Set($sbTitle);
		//$graph->title->SetFont(FF_FONT2,FS_BOLD);
		$graph->xaxis->title->Set($rcAditional["x-label"]);
		//$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);
		$graph->xaxis->SetLabelAlign('right','center','right');
                              
		// Create a bar pot
		$bplot = new BarPlot($rcY);
		$bplot->SetFillColor("orange");
		$bplot->SetWidth(0.5);
		$bplot->SetShadow();
		
		// Setup the values that are displayed on top of each bar
		$bplot->value->Show();
		
		// Must use TTF fonts if we want text at an arbitrary angle
		//$bplot->value->SetFont(FF_VERDANA,FS_BOLD);
		//$bplot->value->SetAngle(45);
		
		// Black color for positive values and darkred for negative values
		$bplot->value->SetColor("black","darkred");
		$graph->Add($bplot);
		
		// Finally stroke the graph
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}
	
	//BARRAS HORIZONTALES
	function createBarBgCenterValues($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_bar.php");
		
		// Set the basic parameters of the graph 
		$graph = new Graph(400,500,'auto');
		$graph->SetScale("textlin");
		$graph->Set90AndMargin(90,20,50,30);
		$graph->SetShadow();
		
		// Setup title
		$graph->title->Set($sbTitle);
		//$graph->title->SetFont(FF_VERDANA,FS_BOLD,14);
		
		// Setup X-axis
		$graph->xaxis->SetTickLabels($rcX);
		//$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->xaxis->SetLabelMargin(5);
		$graph->xaxis->SetLabelAlign('right','center');
		if(sizeof($rcX)>15)
			$graph->xaxis->SetTextTickInterval(5);
		
		$graph->yaxis->scale->SetGrace(20);
		
		// Now create a bar pot
		$bplot = new BarPlot($rcY);
		$bplot->SetFillColor("orange");
		$bplot->SetShadow();

		//You can change the width of the bars if you like
		$bplot->SetWidth(0.5);
		
		// We want to display the value of each bar at the top
		$bplot->value->Show();
		//$bplot->value->SetFont(FF_VERDANA,FS_BOLD,12);
		$bplot->value->SetAlign('left','center');
		$bplot->value->SetColor("black","darkred");
		$bplot->value->SetFormat('%d');
		
		// Add the bar to the graph
		$graph->Add($bplot);
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}

	function createBarFreqCenterValues($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_bar.php");
		include_once("jpgraph_line.php");
		
		// Create the graph. 
		$graph = new Graph(400,300);	
		$graph->SetScale("textlin");
		$graph->SetMarginColor('white');
		
		// Adjust the margin slightly so that we use the 
		// entire area (since we don't use a frame)
		$graph->SetMargin(30,1,20,5);
		$graph->SetBox(); 
		$graph->SetFrame(false);
		$graph->tabtitle->Set($sbTitle);
		//$graph->tabtitle->SetFont(FF_VERDANA,FS_BOLD,10);
		
		// Setup the X and Y grid
		$graph->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
		$graph->ygrid->SetLineStyle('dashed');
		$graph->ygrid->SetColor('gray');
		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle('dashed');
		$graph->xgrid->SetColor('gray');
		
		// Setup month as labels on the X-axis
		$graph->xaxis->SetTickLabels($rcX);
		//$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
		//$graph->xaxis->SetLabelAngle(0);
		if(sizeof($rcX)>15)
			$graph->xaxis->SetTextTickInterval(5);

		// Create a bar pot
		$bplot = new BarPlot($rcY);
		$bplot->SetWidth(0.6);
		$fcol='#440000';
		$tcol='#FF9090';
		$bplot->SetFillGradient($fcol,$tcol,GRAD_LEFT_REFLECTION);
		$bplot->SetWeight(0);
		$graph->Add($bplot);
		
		// Create filled line plot
		$lplot = new LinePlot($rcY);
		$lplot->SetFillColor('skyblue@0.5');
		$lplot->SetColor('navy@0.7');
		$lplot->SetBarCenter();
		
		$bplot->value->Show();
		//$bplot->value->SetFont(FF_VERDANA,FS_BOLD,12);
		$bplot->value->SetAlign('left','center');
		$bplot->value->SetColor("black","darkred");
		$bplot->value->SetFormat('%d');
		
		$lplot->mark->SetType(MARK_SQUARE);
		$lplot->mark->SetColor('blue@0.5');
		$lplot->mark->SetFillColor('lightblue');
		$lplot->mark->SetSize(5);
		$graph->Add($lplot);
		
		// Finally stroke the graph
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}

	function createCenterLines($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_line.php");
		
		$graph = new Graph(300,250,"auto");
		$graph->img->SetMargin(40,40,40,80);	
		$graph->img->SetAntiAliasing();
		$graph->SetScale("textlin");
		$graph->SetShadow();
		$graph->title->Set($sbTitle);
		//$graph->title->SetFont(FF_VERDANA,FS_NORMAL,14);
		
		//$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,9);
		$graph->xaxis->SetTickLabels($rcX);
		//$graph->xaxis->SetLabelAngle(45);
		if(sizeof($rcX)>15)
			$graph->xaxis->SetTextTickInterval(5);
		
		$p1 = new LinePlot($rcY);
		$p1->mark->SetType(MARK_FILLEDCIRCLE);
		$p1->mark->SetFillColor("red");
		$p1->mark->SetWidth(2);
		$p1->SetColor("blue");
		$p1->SetCenter();
		$graph->Add($p1);
		
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}

	function createLinesIcon($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_line.php");
		include_once("jpgraph_iconplot.php");
		
		// Setup the graph
		$graph = new Graph(400,250);
		$graph->SetMargin(40,40,20,30);	
		$graph->SetScale("textlin");
		
		$graph->title->Set($sbTitle);
		//$graph->title->SetFont(FF_VERDANA,FS_NORMAL,12);
		$graph->xaxis->SetPos('min');
		$graph->xaxis->SetTickLabels($rcX);
		if(sizeof($rcX)>15)
			$graph->xaxis->SetTextTickInterval(5);
		
		$p1 = new LinePlot($rcY);
		$p1->SetColor("blue");
		$p1->SetFillGradient('yellow@0.4','red@0.4');
		
		$graph->Add($p1);
		
		/*
		$icon = new IconPlot('logo_full.png',0.2,0.3,1,30);
		$icon->SetAnchor('center','center');
		$graph->Add($icon);*/
		
		// Output line
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}

	function createSimpleSLines($rcY,$rcX,$sbTitle,$rcAditional=false)
	{
		include_once("jpgraph_line.php");
		
		// Setup the graph
		$graph = new Graph(300,200);
		$graph->SetMarginColor('white');
		$graph->SetScale("textlin");
		$graph->SetFrame(false);
		$graph->SetMargin(30,50,30,30);
		
		$graph->tabtitle->Set($sbTitle);
		//$graph->tabtitle->SetFont(FF_VERDANA,FS_BOLD,13);
		$graph->yaxis->HideZeroLabel();
		$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
		$graph->xgrid->Show();
		$graph->xaxis->SetTickLabels($rcX);
		if(sizeof($rcX)>15)
			$graph->xaxis->SetTextTickInterval(5);
		
		// Create the first line
		$p1 = new LinePlot($rcY);
		$p1->SetColor("navy");
		$p1->SetLegend($rcAditional['y-label']);
		$graph->Add($p1);
		
		/*
		// Create the second line
		$p2 = new LinePlot($datay2);
		$p2->SetColor("red");
		$p2->SetLegend('Line 2');
		$graph->Add($p2);
		
		// Create the third line
		$p3 = new LinePlot($datay3);
		$p3->SetColor("orange");
		$p3->SetLegend('Line 3');
		$graph->Add($p3);
		*/
		
		$graph->legend->SetShadow('gray@0.4',5);
		$graph->legend->SetPos(0.1,0.1,'right','top');
		
		// Output line
		$graph->Stroke();
		$this->sbFileName = $graph->cache->sbFileNameImage;
		return true;
	}
	
	function cutZeroValues(&$rcX,&$rcY)
	{
		settype($rcNX,"array");
		settype($rcNY,"array");
		settype($blChange,"boolean");
		
		if(!is_array($rcY)) {
			$rcY = false;
			return;
		}
		if(array_sum($rcY)==0)
		{
			$rcY = false;
			return;
		}
		
		foreach ($rcY as $nuKey=>$nuValue)
		{
			if ($nuValue!=0 && $nuValue!="0")
			{
				$rcNX[] = $rcX[$nuKey];
				$rcNY[] = $nuValue;
				$blChange = true;
			}
		}
		if($blChange===true)
		{
			$rcX = $rcNX;
			$rcY = $rcNY;
		}
	}
}
?>