<?php

// Dataset definition 
$DataSet = new pData;

$DataSet->AddPoint($table_dps,"Serie1");
$DataSet->AddPoint($table_mana,"Serie2");
$DataSet->AddPoint($table_date,"Serie3");
$DataSet->AddSerie("Serie1");
$DataSet->SetAbsciseLabelSerie("Serie3");
$DataSet->SetSerieName("DPS","Serie1");
$DataSet->SetSerieName("Mana","Serie2");

// Initialise the graph
$Test = new pChart(1080,460);
$Test->drawGraphAreaGradient(90,90,90,90,TARGET_BACKGROUND);

// Prepare the graph area
$Test->setFontProperties("Fonts/tahoma.ttf",10);
$Test->setGraphArea(80,40,1000,360);

// Initialise graph area
$Test->setFontProperties("Fonts/tahoma.ttf",10);

// Draw the DPS graph
$DataSet->SetYAxisName("DPS");
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,213,217,221,TRUE,100,0);
$Test->drawGraphAreaGradient(40,40,40,-50);
//$Test->drawGrid(4,TRUE,230,230,230,10);
$Test->setShadowProperties(3,3,0,0,0,30,4);
$Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->clearShadow();
$Test->drawFilledCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription(),.1,30);
// $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

// Clear the scale
$Test->clearScale();

// Draw the 2nd graph
$DataSet->RemoveSerie("Serie1");
$DataSet->AddSerie("Serie2");
$DataSet->SetYAxisName("Mana");
$Test->setFixedScale(0,100);
$Test->drawRightScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,213,217,221,TRUE,100,0);
//$Test->drawGrid(4,TRUE,230,230,230,10);
$Test->setShadowProperties(3,3,0,0,0,30,4);
$Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->clearShadow();
$Test->drawFilledCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription(),.1,30);
// $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

// Write the legend (box less)
$Test->setFontProperties("Fonts/tahoma.ttf",8);
$Test->drawLegend(900,50,$DataSet->GetDataDescription(),0,0,0,0,0,0,255,255,255,FALSE);

// Write the title
$Test->setFontProperties("Fonts/MankSans.ttf",18);
$Test->setShadowProperties(1,1,0,0,0);
$Test->drawTitle(0,0,"Mana et DPS",255,255,255,1080,30,TRUE);
$Test->clearShadow();

// Render the picture
$imgid = md5(time());
$Test->Render("Cache/test".$imgid.".png");

?>