<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

// sépare le texte de l'heure
function split_date_text(&$string)
{

	list($date,$text) = explode(" ", $string , 2);
	$string = $text;
	return substr($date, 1, -1);

}

// Concat en triant deux tableaux (on prie pour que ça fonctionne...)
function concat_table($a1,&$i1,$m1,$a2,&$i2,$m2,&$s)
{
	if($i1 == $m1)
	{
		while($i2 < $m2)
		{
			$s[] = $a2[$i2];
			$i2++;
		}
	}
	elseif($i2 == $m2)
	{
		while($i1 < $m1)
		{
			$s[] = $a1[$i1];
			$i1++;
		}
	}
	else
	{
		$ligne_a1 = $a1[$i1];
		$ligne_a2 = $a2[$i2];
		$t1 = split_date_text($ligne_a1);
		$t2 = split_date_text($ligne_a2);
		if($t1 > $t2)
		{
			$s[] = '['.$t2.']'.' '.$ligne_a2;
			$i2 ++;
			concat_table($a1,$i1,$m1,$a2,$i2,$m2,$s);
		}
		else
		{
			$s[] = '['.$t1.']'.' '.$ligne_a1;
			$i1++;
			concat_table($a1,$i1,$m1,$a2,$i2,$m2,$s);
		}
	}
}


// ajoute un temps à une heure
function add_sec_to_date($date,$sec)
{
	$time_total;
	$time=0;
	$heure;
	$minutes;
	$secondes;
	$milisec;
	$a_heure = explode(':',$date);
	$time_total = 3600 * $a_heure[0] + 60 * $a_heure[1] + $a_heure[2];
	$time_total += $sec;
	$time = floor($time_total);
	$milisec = round(1000*($time_total - $time));
	$heure = ($time - ($time % 3600)) / 3600;
	$minutes = $time - 3600 * $heure;
	$minutes = ($minutes - ($minutes % 60)) / 60;
	$secondes = $time - 3600 * $heure - 60 * $minutes;
	if($milisec < 10)
		{
			$milisec = '00'.$milisec;
		}
	elseif($milisec < 100)
		{
			$milisec = '0'.$milisec;
		}
	
	return $heure.":".( ($minutes < 10) ? '0'.$minutes : $minutes).":".( ($secondes < 10) ? '0'.$secondes : $secondes).".".$milisec;
}

// ajoute un temps à une heure
function sub_time($date1,$date2)
{
	$a_heure1 = explode(':',$date1);
	$a_heure2 = explode(':',$date2);
	$time_total1 = 3600 * $a_heure1[0] + 60 * $a_heure1[1] + $a_heure1[2];
	$time_total2 = 3600 * $a_heure2[0] + 60 * $a_heure2[1] + $a_heure2[2];
	$d_time = $time_total1 - $time_total2;
	return max(0,floor(100*($d_time))/100);
}

// prépare la ligne avant qu'elle ne sorte.
function prepare_ligne(&$string)
{
	global $lang;
	
	$string = preg_replace('/'.$lang['Heroism'].'/','<span class="c17">'.$lang['Heroism'].'</span>',$string);
	$string = preg_replace('/'.$lang['Arcane Power'].'/','<span class="c14">'.$lang['Arcane Power'].'</span>',$string);
	$string = preg_replace('/'.$lang['Hospitality'].'/','<span class="c14">'.$lang['Hospitality'].'</span>',$string);
	$string = preg_replace('/'.$lang['Scale of Fates'].'/','<span class="c14">'.$lang['Scale of Fates'].'</span>',$string);
	$string = preg_replace('/'.$lang['Icy Veins'].'/','<span class="c14">'.$lang['Icy Veins'].'</span>',$string);
	$string = preg_replace('/'.$lang['Presence of Mind'].'/','<span class="c14">'.$lang['Presence of Mind'].'</span>',$string);
	$string = preg_replace('/'.$lang['Mirror Image'].'/','<span class="c14">'.$lang['Mirror Image'].'</span>',$string);
	$string = preg_replace('/'.$lang['Evocation'].'/','<span class="c14">'.$lang['Evocation'].'</span>',$string);
	$string = preg_replace('/'.$lang['Replenish Mana'].'/','<span class="c14">'.$lang['Replenish Mana'].'</span>',$string);
	$string = preg_replace('/'.$lang['Living Bomb'].'/','<span class="c14">'.$lang['Living Bomb'].'</span>',$string);
	$string = preg_replace('/'.$lang['Elusive Power'].'/','<span class="c14">'.$lang['Elusive Power'].'</span>',$string);
	$string = preg_replace('/'.$lang['Ice Block'].'/','<span class="c17">'.$lang['Ice Block'].'</span>',$string);
	$string = preg_replace('/'.$lang['Blink'].'/','<span class="c14">'.$lang['Blink'].'</span>',$string);
	$string = preg_replace('/'.$lang['Polymorph'].'/','<span class="c14">'.$lang['Polymorph'].'</span>',$string);
	$string = preg_replace('/'.$lang['Arcane Barrage'].'/','<span class="c14">'.$lang['Arcane Barrage'].'</span>',$string);
	$string = preg_replace('/'.$lang['Hot Streak'].'/','<span class="c1">'.$lang['Hot Streak'].'</span>',$string);
	$string = preg_replace('/'.$lang['Pyroblast'].'/','<span class="c2">'.$lang['Pyroblast'].'</span>',$string);
	$string = preg_replace('/'.$lang['Clearcasting'].'/','<span class="c26">'.$lang['Clearcasting'].'</span>',$string);
	$string = preg_replace('/'.$lang['Innervate'].'/','<span class="c6">'.$lang['Innervate'].'</span>',$string);
	$string = preg_replace('/'.$lang['Hymn of Hope'].'/','<span class="c25">'.$lang['Hymn of Hope'].'</span>',$string);
	$string = preg_replace('/fades/','<span class="c10">fades</span>',$string);

	return $string;

}

// vérification des heures
function checkinsertdate($date)
{
	global $date_end;
	$a_heure = explode(':',$date);
	$time = 3600 * $a_heure[0] + 60 * $a_heure[1] + floor($a_heure[2]/30);
	if($time > $date_end)
	{
		$date_end = $time;
		$heure = ($time - ($time % 3600)) / 3600;
		$minutes = $time - 3600 * $heure;
		$minutes = ($minutes - ($minutes % 60)) / 60;
		$secondes = $time - 3600 * $heure - 60 * $minutes;
		return $heure.":".( ($minutes < 10) ? '0'.$minutes : $minutes).":".( ($secondes == 1) ? '30' : 0);
	}
	else
	{
		return ' ';
	}
}

// moyenne des dmg
function mean5($dmg)
{
	global $table_temp;
//	$val = round(($dmg+$table_temp[0]+$table_temp[1]+$table_temp[2]+$table_temp[3]+$table_temp[4]+$table_temp[5]+$table_temp[6]+$table_temp[7]+$table_temp[8])/9,0);
	$val = round(($dmg+$table_temp[0]+$table_temp[1]+$table_temp[2]+$table_temp[3]+$table_temp[4])/5,0);
	$table_temp[8] = $table_temp[7];
	$table_temp[7] = $table_temp[6];
	$table_temp[6] = $table_temp[5];
	$table_temp[5] = $table_temp[4];
	$table_temp[4] = $table_temp[3];
	$table_temp[3] = $table_temp[2];
	$table_temp[2] = $table_temp[1];
	$table_temp[1] = $table_temp[0];
	$table_temp[0] = $dmg;
	return $val;
}


// moyenne des dmg
function getcasttime($basetime)
{
	global $hero, $hast;
	if ($hero == 'on')
		{
			return round(max(1,$basetime/((1+$hast/CST_HATE)*1.03*1.05*1.3)),3);
		}
	else
		{
			return round(max(1,$basetime/((1+$hast/CST_HATE)*1.03*1.05)),3);
		}
}

// donne le total mana en fonction de l'intel
function getmaxmana($int)
{
	return floor(15*$int+MANA_BASE+2126-280);
}


// ajoute le mp5 (pas affiché dans les rapports mana...
function addmp5($mana,$max_mana)
{
	return $mana+869+326+$max_mana*0.036;
}

// ajoute le mp5 (pas affiché dans les rapports mana...
function requincage($mana,$max_mana)
{
	return $mana+floor($max_mana*0.01);
}

// on récupère les dégats d'une ligne
function getdmg($string)
{
	$i=0;
	$a = explode(' ',$string);
	$max = count($a);
	while($i < $max)
	{
		if(preg_match('/.[0-9]./',$a[$i]))// && !(strpos($a[$i],')') != 0))
		{
			if(strpos($a[$i],'*') === 0)
			{
				$dps = substr($a[$i], 1, -1);
				if($dps != '')
				{
					return $dps;
				}
			}
			else
			{
				if($a[$i] != '')
				{
					return $a[$i];
				}
			}
		}
	$i++;
	}
	return 0;
}

// insertion des données dans les tableaux
function insertdata($date,$string,$mana=1,$casttime=1)
{
	global $mana_base,$table_date,$table_dps,$table_mana;
	$dps = getdmg($string);
	if($dps != 'none')
	{
		$table_date[]=checkinsertdate($date);
		$table_dps[]=mean5($dps/$casttime);
		$table_mana[]=floor(($mana/$mana_base)*100);
	}
}

// ecrit la ligne
function send($date,$string,$class,$d_mana,$cast)
{
	global $mana_base,$lang,$analyse,$hero;

	echo "\t".'<tr class="c0">'."\n";
	echo "\t"."\t".'<td>';
	if ($hero == 'on')
		{
			echo '<img src="images/heroism.jpg" alt="heroism" title="heroism" style="height: 12px;" />';
		}
	else
		{
			echo '&nbsp;';
		}
	echo '</td>'."\n";
	echo "\t"."\t".'<td class="date">['.$date.']</td>'."\n";
	echo "\t"."\t".'<td class="'.$class.'">'.$string.'</td>'."\n";
	echo "\t"."\t".'<td style="padding-left: 15px;">'.(($cast ==0 )? '&nbsp;' : $cast.'s').'</td>'."\n";
	if($d_mana == 0 && !(strpos($string,$lang['Arcane Missiles']) != 0))
	{
		echo "\t"."\t".'<td style="padding-left: 15px;">&nbsp;</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">&nbsp;</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$analyse->mana.'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.floor(($analyse->mana/$mana_base)*100).'%</td>'."\n";
	}
	else
	{
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$analyse->time_lost.'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$d_mana.'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$analyse->mana.'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.floor(($analyse->mana/$mana_base)*100).'%</td>'."\n";
	}
	echo "\t".'</tr>'."\n";
}

?>