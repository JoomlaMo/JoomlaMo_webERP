<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.tooltip');
global $Reference;
require(JPATH_COMPONENT . DS . "pdfb" . DS . "pdfb.php"); // Must include this

class PDF extends PDFB
{
  function Header()
  {
    // Add your code here to generate
    // Headers on every page
  }

  function Footer()
  {
    // Add your code here to generate
    // Footers on every page
  }
}
// Create a PDF Page object
$pdf = new PDF("p", "pt", "letter");
$pdf->AddPage();
$pdf->SetMargins(0,0,0,0);
$pdf->SetFont('Arial','',8);
//Move to 8 cm to the right
// $pdf->Cell(80);
$NextLine=0;
$collumn = 1;
$LineHeight=37;
$CellWidth=155;
$LabelCount=0;
$YStart = 30;
$XStart = 15;
$x=$XStart;
$y=$YStart;
$ColumnsWide = 4;
for ($i=0, $n=count( $this->items ); $i < $n; $i++){
	$row = &$this->items[$i];
	$partnumber 		= $row->partnumber;
	$description 		= $row->description;
	$quantityordered	= $row->quantityordered;
	for($k=0;$k<$quantityordered;$k++){
		$pdf->BarCode($partnumber, "C128B",$x,$y,650,80);
		$pdf->SetXY($x,$y-5);
		$pdf->SetFontSize(8);
		$pdf->Write(5,$description);
		$LabelCount=$LabelCount+1;
		$collumn=$collumn+1;
		If($LabelCount == 80){	
			$ColumnsWide = 3;		
			$NextLine=0;
			$collumn=1;
			$y=$YStart;
			$x=$XStart;
			$LabelCount = 0;
			$pdf->AddPage();
		}else{
			If($collumn > 4){				
				$y=$y+$LineHeight;
				$x=$XStart;			
				$NextLine=1;
				$collumn=1;				
			}else{				
				$x=$x+$CellWidth;
				$NextLine=0;
			}
		}
	}	
	
}
$pdf->Output();
exit;
?>