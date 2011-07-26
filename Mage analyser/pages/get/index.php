<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

require_once $path['root'].'/pages/get/includes/fonctions.php';
require_once $path['root'].'/pages/get/includes/cst.php';
require_once $path['root'].'/pages/get/class/arc.php';
require_once $path['root'].'/pages/get/class/fire.php';

$table_date = array();
$table_dps = array();
$table_mana = array();
$table_temp = array(0,0,0,0,0,0,0,0,0,0,0,0);
$loglignes = array();

$class = 'aucune';
$mana_base = getmaxmana($intel);
$debut = 'plop';
$hero = 'off';

// definition de la langue du rapport
if($language == 'fr')
{
	$lang = $lang_fr;
}
else
{
	$lang = $lang_en;
}

// begin printing table
echo '<div id=\'main\'>'."\n";
echo '<div style=\'text-align: center; padding: 25px;\'><img src="Cache/test.png" alt="image ici" id="img" style="border: solid 1px #0099CC;" /></div>'."\n";
echo '<div style=\'display: block; text-align: center; border: solid 1px #0099CC; width: 400px; position:relative; margin-left:auto; margin-right:auto; background: #000000;\'>'."\n";
echo 'Intelligence : '.$intel.' +80 +300 <br />'."\n";
echo 'Mana : '.$mana_base.'<br />'."\n";
echo 'Hate : '.$hast.'<br />'."\n";
echo 'NWP : 3<br />'."\n";
echo 'Sp&eacute; : '.(($spe == 'arc') ? 'Arcane' : 'Feu').'<br />'."\n";
echo 'Buffs raid : 5% hate, 1% mana/10s, PA<br />'."\n";
echo 'Amure : Mage glyph&eacute;e<br />'."\n";
echo '</div>'."\n";
echo '<div style=\'text-align: center; padding-top: 25px;\'>Votre log fait '.strlen($log).' Octets.</div>'."\n";
echo '<table>'."\n";

echo "\t".'<tr class="c0">'."\n";
echo "\t"."\t".'<td>&nbsp;</td>'."\n";
echo "\t"."\t".'<td class="date" style="text-align: center;">time</td>'."\n";
echo "\t"."\t".'<td class="aucune" style="text-align: center;">action</td>'."\n";
echo "\t"."\t".'<td style="padding-left: 15px;">cast</td>'."\n";
echo "\t"."\t".'<td style="padding-left: 15px;">time lost</td>'."\n";
echo "\t"."\t".'<td style="padding-left: 15px;">&Delta;mana</td>'."\n";
echo "\t"."\t".'<td style="padding-left: 15px;">mana</td>'."\n";
echo "\t"."\t".'<td style="padding-left: 15px;">%mana</td>'."\n";
echo "\t".'</tr>'."\n";


// define the spect used
if($spe == 'arc')
	{
		$analyse = new analyse_arcane();
	}
else
	{
		$analyse = new analyse_fire();
	}

$loglignes = preg_split('/\n/', $log);
$i=0;
// begin log parsing
while($i < count($loglignes))
	{
		$ligne = $loglignes[$i]; // get i line
		$i++; // increment i
		$last_date = split_date_text($ligne); // get date of event
		$class = 'c0'; // class base
		
		// initialise log if 1st line
		if($debut == 'plop')
		{
			$debut = $last_date;	
			$a_heure = explode(':',$last_date);
			$time = 3600 * $a_heure[0] + 60 * $a_heure[1] + floor($a_heure[2]/30);
			$date_end = $time = 3600 * $a_heure[0] + 60 * $a_heure[1] + floor($a_heure[2]/30);
			$analyse->initialise($last_date,$mana_base);
		}
		
		// check if heroism
		if((strpos($ligne,$lang['Heroism']) != 0 || strpos($ligne,$lang['Bloodlust']) != 0 ||
			strpos($ligne,$lang['Time Warp']) != 0 || strpos($ligne,$lang['Ancient Hysteria']) != 0 ) && $hero == 'off')
			{
				$hero = 'on';
			}
		elseif(strpos($ligne,$lang['Heroism']) != 0 || strpos($ligne,$lang['Bloodlust']) != 0 ||
			strpos($ligne,$lang['Time Warp']) != 0 || strpos($ligne,$lang['Ancient Hysteria']) != 0 )
			{
				$hero = 'off';
			}

		// count number of blink
		if(strpos($ligne,$lang['Blink']) != 0)
			{
				$analyse->statistique['nb blink'] ++;
			}

		// start analyse
		$analyse->analyse($hero,$ligne,$last_date);
		
		// print line if not Arcane Missiles & not Arcane Explosion to ease the log reading
		if(!(strpos($ligne,$lang['Arcane Missiles']) != 0) && !(strpos($ligne,$lang['Arcane Explosion']) != 0))
			{
				send($last_date,prepare_ligne($ligne),$class);
			}

	};
echo '</table><br />'."\n";


// results
echo '<div style="text-align: center; padding-top: 10px; border-top: solid 1px #0099CC;" class="c0">';

$heure_debut = explode(':',$debut);
$time_debut = floor(3600 * $heure_debut[0] + 60 * $heure_debut[1] + $heure_debut[2]);
$heure_fin = explode(':',$last_date);
$time_fin = ceil(3600 * $heure_fin[0] + 60 * $heure_fin[1] + $heure_fin[2]);
$duree = $time_fin - $time_debut;
$minutes = ($duree - ($duree % 60)) / 60;
$secondes = $duree - 60 * $minutes;
echo 'Durant ce combat ('.$minutes.' min '.$secondes.' sec) il y a eut :<br />'."\n";
// print analyse
$analyse->resultat();

// graph
require_once $path['root'].'/pages/get/includes/graph.php';

// print graph 1 sec after printing the page.
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