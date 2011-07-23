<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

require_once $path['root'].'/pages/get/includes/fonctions.php';
require_once $path['root'].'/pages/get/includes/cst.php';
if($spe == 'arc')
	{
		require_once $path['root'].'/pages/get/class/arc.php';
	}
else
	{
		require_once $path['root'].'/pages/get/class/fire.php';
	}

$table_date = array();
$table_dps = array();
$table_mana = array();
$table_temp = array(0,0,0,0,0,0,0,0,0,0,0,0);

if($language == 'fr')
{
	$lang = $lang_fr;
}
else
{
	$lang = $lang_en;
}

$loglignes = array();
$log1lignes = array();
$log2lignes = array();

$loglignes = preg_split('/\n/', $log1);
//$log2lignes = preg_split('/\n/', $log2);
$i1 = 0;
$i2 = 0;
//concat_table($log1lignes,$i1,count($log1lignes),$log2lignes,$i2,count($log2lignes),$loglignes);

$i=0;
$speech = '';
$class = ($speech == 'oui') ? 'aucune' : 'nowrap';
$mana_base = getmaxmana($intel);
echo '<div id=\'main\'>'."\n";
echo '<div style=\'text-align: center; padding: 25px;\'><img src="Cache/test.png" alt="image ici" id="img" style="border: solid 1px #0099CC;" /></div>'."\n";
echo '<div style=\'display: block; text-align: center; border: solid 1px #0099CC; width: 200px; position:relative; margin-left:auto; margin-right:auto; background: #000000;\'>'."\n";
echo 'Intelligence : '.$intel.'<br />'."\n";
echo 'Mana : '.$mana_base.'<br />'."\n";
echo 'Hate : '.$hast.'<br />'."\n";
echo 'NWP : 3<br />'."\n";
echo 'Spé : '.(($spe == 'arc') ? 'Arcane' : 'Feu').'<br />'."\n";
echo '</div>'."\n";
echo '<div style=\'text-align: center; padding-top: 25px;\'>Votre log fait '.(strlen($log1) + strlen($log2)).' Octets.</div>'."\n";
echo '<table>'."\n";

$debut = 'plop';
$hero = 'off';
if($spe == 'arc')
	{
		$analyse = new analyse_arcane();
		$analyse->mana = $mana_base;
	}
else
	{
		$analyse = new analyse_fire();
	}

while($i < count($loglignes))
	{
		$cast_time = 0;
		$ligne = $loglignes[$i];
		$i++;
		$last_date = split_date_text($ligne);
		$class = 'c0';
		
		if($debut == 'plop') $debut = $last_date;
		
		if(strpos($ligne,$lang['Heroism']) != 0 && $hero == 'off')
			{
				$hero = 'on';
			}
		elseif(strpos($ligne,$lang['Heroism']) != 0)
			{
				$hero = 'off';
			}
		if(strpos($ligne,$lang['Blink']) != 0)
			{
				$analyse->statistique['nb blink'] ++;
			}
		$analyse->analyse($hero,$ligne,$last_date);
		if(($affmana == 'yes' or !((strpos($ligne,'gains') != 0) && (strpos($ligne,'mana') != 0))) and !(strpos($ligne,$lang['Arcane Missiles']) != 0)) send($last_date,prepare_ligne($ligne),$class,$analyse->d_mana,$cast_time);
	};
echo '</table><br />'."\n";
echo '<div style="text-align: center; padding-top: 10px; border-top: solid 1px #0099CC;" class="c0">';

$heure_debut = explode(':',$debut);
$time_debut = floor(3600 * $heure_debut[0] + 60 * $heure_debut[1] + $heure_debut[2]);
$heure_fin = explode(':',$last_date);
$time_fin = ceil(3600 * $heure_fin[0] + 60 * $heure_fin[1] + $heure_fin[2]);
$duree = $time_fin - $time_debut;
$minutes = ($duree - ($duree % 60)) / 60;
$secondes = $duree - 60 * $minutes;
echo 'Durant ce combat ('.$minutes.' min '.$secondes.' sec) il y a eut :<br />'."\n";
$analyse->resultat();

require_once $path['root'].'/pages/get/includes/graph.php';

echo "<script type='text/javascript'>
function testtimeout(){
setTimeout('printer()',1000);
}

function printer(){
img = document.getElementById('img');
img.src='Cache/test".$imgid.".png';
}

testtimeout();
</script>
</div>";
?>