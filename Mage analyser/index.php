<?php
# protection
DEFINE('MA',true);
# path of the page
$path['root'] = dirname(__FILE__);

ini_set('xdebug.max_nesting_level', 0);

$submit = isset($_POST['submit']) ? $_POST['submit'] : 'non';
if($submit == 'Analyser')
	{

		$log1 = (isset($_POST['log1']) && !empty($_POST['log1'])) ? stripslashes($_POST['log1']) : 'non';
//		$log2 = (isset($_POST['log2']) && !empty($_POST['log2'])) ? stripslashes($_POST['log2']) : 'non';
		$spe = (isset($_POST['spe']) && !empty($_POST['spe'])) ? stripslashes($_POST['spe']) : 'arc';
		$hast = (isset($_POST['hast']) && !empty($_POST['hast'])) ? stripslashes($_POST['hast']) : 0;
		$nwp = 3;
		$intel = (isset($_POST['intel']) && !empty($_POST['intel'])) ? stripslashes($_POST['intel']) : 0;
		$mana_base = 0;
		$affmana = (isset($_POST['affmana']) && !empty($_POST['affmana'])) ? stripslashes($_POST['affmana']) : 'no';
		$language = (isset($_POST['lang']) && !empty($_POST['lang'])) ? stripslashes($_POST['lang']) : 'en';
$log2="";
// Standard inclusions
		require_once $path['root'].'/pChart/pData.class.php';
		require_once $path['root'].'/pChart/pChart.class.php';
		require_once $path['root'].'/includes/header.php';
		require_once $path['root'].'/pages/get/index.php';
		require_once $path['root'].'/includes/footer.php';
		exit;
	}



require_once $path['root'].'/includes/header.php';
require_once $path['root'].'/pages/send/index.php';
require_once $path['root'].'/includes/footer.php';
?>