<?php
// SECURITE
DEFINED('MA') or die('HACKING ATTEMPT!');


/*************************************************
**
** SPLIT DATE AND TEXT
**
*************************************************/
function split_date_text(&$string)
{

	list($date,$text) = explode(" ", $string , 2);
	$string = $text;
	return substr($date, 1, -1);

}



/*************************************************
**
** ADD TIME IN SECOND TO A DATE
**
*************************************************/
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



/*************************************************
**
** SUPPOSED TO GIVE THE SUBSTRACTION BETWEEN TWO DATE
**
*************************************************/
function sub_time($date1,$date2)
{
	$a_heure1 = explode(':',$date1);
	$a_heure2 = explode(':',$date2);
	$time_total1 = 3600 * $a_heure1[0] + 60 * $a_heure1[1] + $a_heure1[2];
	$time_total2 = 3600 * $a_heure2[0] + 60 * $a_heure2[1] + $a_heure2[2];
	$d_time = abs($time_total1 - $time_total2);
	return max(0,floor(100*($d_time))/100);
}



/*************************************************
**
** PREPARE THE LINE BEFORE PRINTING
**
*************************************************/
function prepare_ligne(&$string)
{
	global $lang;
	
	$string = preg_replace('/'.$lang['Heroism'].'/','<span class="c17">'.$lang['Heroism'].'</span>',$string);
	$string = preg_replace('/'.$lang['Time Warp'].'/','<span class="c17">'.$lang['Time Warp'].'</span>',$string);
	$string = preg_replace('/'.$lang['Bloodlust'].'/','<span class="c17">'.$lang['Bloodlust'].'</span>',$string);
	$string = preg_replace('/'.$lang['Ancient Hysteria'].'/','<span class="c17">'.$lang['Ancient Hysteria'].'</span>',$string);
	
	$string = preg_replace('/'.$lang['Mirror Image'].'/','<span class="c14">'.$lang['Mirror Image'].'</span>',$string);
	$string = preg_replace('/'.$lang['Evocation'].'/','<span class="c14">'.$lang['Evocation'].'</span>',$string);
	$string = preg_replace('/'.$lang['Replenish Mana'].'/','<span class="c14">'.$lang['Replenish Mana'].'</span>',$string);
	$string = preg_replace('/'.$lang['Ice Block'].'/','<span class="c17">'.$lang['Ice Block'].'</span>',$string);
	$string = preg_replace('/'.$lang['Blink'].'/','<span class="c14">'.$lang['Blink'].'</span>',$string);
	$string = preg_replace('/'.$lang['Clearcasting'].'/','<span class="c26">'.$lang['Clearcasting'].'</span>',$string);

	$string = preg_replace('/'.$lang['Arcane Power'].'/','<span class="c14">'.$lang['Arcane Power'].'</span>',$string);
	$string = preg_replace('/'.$lang['Presence of Mind'].'/','<span class="c14">'.$lang['Presence of Mind'].'</span>',$string);
	$string = preg_replace('/'.$lang['Arcane Barrage'].'/','<span class="c14">'.$lang['Arcane Barrage'].'</span>',$string);
	$string = preg_replace('/'.$lang['Mage Ward'].'/','<span class="c14">'.$lang['Mage Ward'].'</span>',$string);
	$string = preg_replace('/'.$lang['Slow Fall'].'/','<span class="c14">'.$lang['Slow Fall'].'</span>',$string);

	$string = preg_replace('/'.$lang['Icy Veins'].'/','<span class="c14">'.$lang['Icy Veins'].'</span>',$string);

	$string = preg_replace('/'.$lang['Flame Orb'].'/','<span class="c7">'.$lang['Flame Orb'].'</span>',$string);
	$string = preg_replace('/'.$lang['Living Bomb'].'/','<span class="c14">'.$lang['Living Bomb'].'</span>',$string);
	$string = preg_replace('/'.$lang['Hot Streak'].'/','<span class="c1">'.$lang['Hot Streak'].'</span>',$string);
	$string = preg_replace('/'.$lang['Pyroblast'].'/','<span class="c2">'.$lang['Pyroblast'].'</span>',$string);

	$string = preg_replace('/'.$lang['Celerity'].'/','<span class="c4">'.$lang['Celerity'].'</span>',$string);
	$string = preg_replace('/'.$lang['Mark of the Firelord'].'/','<span class="c4">'.$lang['Mark of the Firelord'].'</span>',$string);
	$string = preg_replace('/'.$lang['Battle Magic'].'/','<span class="c4">'.$lang['Battle Magic'].'</span>',$string);
	$string = preg_replace('/'.$lang['Dire Magic'].'/','<span class="c4">'.$lang['Dire Magic'].'</span>',$string);
	$string = preg_replace('/'.$lang['Volcanic Destruction'].'/','<span class="c4">'.$lang['Volcanic Destruction'].'</span>',$string);
	$string = preg_replace('/'.$lang['Soul Power'].'/','<span class="c4">'.$lang['Soul Power'].'</span>',$string);
	$string = preg_replace('/'.$lang['Revelation'].'/','<span class="c4">'.$lang['Revelation'].'</span>',$string);

	$string = preg_replace('/'.$lang['Polymorph'].'/','<span class="c14">'.$lang['Polymorph'].'</span>',$string);
	$string = preg_replace('/'.$lang['Innervate'].'/','<span class="c6">'.$lang['Innervate'].'</span>',$string);
	$string = preg_replace('/'.$lang['Hymn of Hope'].'/','<span class="c25">'.$lang['Hymn of Hope'].'</span>',$string);

	$string = preg_replace('/fades/','<span class="c10">fades</span>',$string);

	return $string;

}



/*************************************************
**
** CHECK (what is that for ???)
**
*************************************************/
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
		return $heure.":".( ($minutes < 10) ? '0'.$minutes : $minutes).":".( ($secondes == 1) ? '30' : '00');
	}
	else
	{
		return ' ';
	}
}



/*************************************************
**
** MEAN BETWEEN THE LAST 5 VALUES
**
*************************************************/
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



/*************************************************
**
** GIVE THE CAST TIME OF A SPELL GIVEN THE HASTE RATING
**
*************************************************/
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



/*************************************************
**
** GIVE THE MANA MAX GIVEN THE INTELLIGENCE OF THE PLAYER
**
*************************************************/
function getmaxmana($int)
{
	return floor(15*($int+380)+MANA_BASE+2126-280);
}



/*************************************************
**
** ADD MP5 TO MANA POOL (mage armor glyphed + PA)
**
*************************************************/
function addmp5($mana)
{
	global $mana_base;
	
	return max(0,min($mana_base,$mana+869+326+$mana_base*0.036));
}



/*************************************************
**
** ADD REQUINCAGE (0,1% MANAMAX EVERY 1 SEC)
**
*************************************************/
function requincage($mana)
{
	global $mana_base;
	
	return max(0,min($mana_base,$mana+floor($mana_base*0.001)));
}



/*************************************************
**
** GET DAMAGE DONE OF A LINE
**
*************************************************/
function getdmg($string)
{
	$i=0;
	$a = explode(' ',$string);
	$max = count($a);
	while($i < $max)
	{
		if(preg_match('/.[0-9]./',$a[$i]))
		{
			if(strpos($a[$i],'*') === 0)
			{
				$dps = substr($a[$i], 1, -2);
				if($dps != '')
				{
					return $dps;
				}
			}
			else
			{
				if($a[$i] != '')
				{
					return substr($a[$i], 0, -1);
				}
			}
		}
	$i++;
	}
	return 0;
}



/*************************************************
**
** CHECK IF DAMAGES DONE ARE CRITICALS
**
*************************************************/
function iscrit($string)
{
	$i=0;
	$a = explode(' ',$string);
	$max = count($a);
	while($i < $max)
	{
		if(preg_match('/.[0-9]./',$a[$i]))
		{
			if(strpos($a[$i],'*') === 0)
			{
				return "crit";
			}
			else
			{
				return "nocrit";
			}
		}
	$i++;
	}
	return "nocrit";
}



/*************************************************
**
** GIVE 30% BASE MANA COST IF SPELL IS CRITICAL
**
*************************************************/
function masterofelements($spell,$string,&$mana)
{

	global $mana_sorts;
	
	if(iscrit($string) == 'crit')
		{
			if($spell == 'Flame Orb')
				{
					$mana['current'] = min($mana['max'],$mana['current']+round(($mana_sorts['Flame Orb']/15)*0.3,0));
				}
			else
				{
					$mana['current'] = min($mana['max'],$mana['current']+round($mana_sorts[$spell]*0.3,0));
				}
		}
}



/*************************************************
**
** INSERT DATA TO TABLE
**
*************************************************/
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



/*************************************************
**
** PRINT LINE
**
*************************************************/
function send($date,$string,$class)
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
	echo "\t"."\t".'<td style="padding-left: 15px;">'.(($analyse->a_memory['cast_time'] ==0 )? '&nbsp;' : $analyse->a_memory['cast_time'].'s').'</td>'."\n";
	if(($analyse->a_mana['delta'] == 0 && !(strpos($string,'Arcane') != 0))|| strpos($string,'fade') != 0)
	{
		echo "\t"."\t".'<td style="padding-left: 15px;">&nbsp;</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">&nbsp;</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$analyse->a_mana['current'].'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.floor(($analyse->a_mana['current']/$mana_base)*100).'%</td>'."\n";
	}
	else
	{
		echo "\t"."\t".'<td style="padding-left: 15px;">';
		echo (($analyse->a_memory['time_lost'] > 1) ? "<span class='c17'>" : "").$analyse->a_memory['time_lost'].(($analyse->a_memory['time_lost'] > 1) ? "</span>" : "");
//		echo ' -- '.$analyse->a_statistique['time_lost'];
		echo '</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$analyse->a_mana['delta'].'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.$analyse->a_mana['current'].'</td>'."\n";
		echo "\t"."\t".'<td style="padding-left: 15px;">'.floor(($analyse->a_mana['current']/$mana_base)*100).'%</td>'."\n";
	}
	echo "\t".'</tr>'."\n";
}

?>