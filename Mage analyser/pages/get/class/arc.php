<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

class analyse_arcane {

	var $nb_missiles = 5;
	var $missiles_mem = array(
		'last_date' => 0,
		'ligne' => 0,
		'dmgs' => '(',
		'dmg' => 0
		);
	var $nb_blast = 1;
	var $timer_debuff = '[00:00:00.000]';
	var $nb_debuff = 0;
	var $mana = 0;
	var $d_mana = 0;
	var $time_lost = 0;
	var $last_date_dmg = 0;
	var $clearcasting = false;
	var $statistique = array(
		'time_lost'=>0,
		'missiles perdus'=>0,
		'deflag en trop' => 0,
		'nb missiles' => 0,
		'nb deflag' => 0,
		'nb barrage' => 0
		);
	var $cd = array(
		'Arcane Power' => 'non',
		'Presence of Mind' => 'non',
		'Hospitality' => 'non',
		'Scale of Fates' => 'non',
		'Icy Veins' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Flame Orb' => 'non',
		'Evocation' => 'non',
		'mp5' => 'non',
		'requincage' => 'non'
		);
	var $buff = array(
		'Arcane Power' => 'non',
		'Presence of Mind' => 'non',
		'Hospitality' => 'non',
		'Scale of Fates' => 'non',
		'Icy Veins' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Evocation' => 'non'
		);

	function analyse($hero,&$ligne,$last_date) {
	
		global $lang, $cast, $cast_time;
		if($this->last_date_dmg == 0) $this->last_date_dmg = $last_date;
		$this->time_lost = 0;
		$this->d_mana = 0;
		$this->check_clearcasting($ligne);
		$this->check_cd($ligne,$last_date,'Arcane Power');
		$this->check_cd($ligne,$last_date,'Scale of Fates');
		$this->check_cd($ligne,$last_date,'Presence of Mind');
		$this->check_cd($ligne,$last_date,'Hospitality');
		$this->check_cd($ligne,$last_date,'Icy Veins');
		$this->check_cd($ligne,$last_date,'Mirror Image');
		$this->check_cd($ligne,$last_date,'Replenish Mana');
		$this->check_cd($ligne,$last_date,'Evocation');
		$this->check_cd($ligne,$last_date,'Flame Orb');

		if(strpos($ligne,$lang['Arcane Barrage']) != 0)
			{
				$this->statistique['nb barrage'] ++;
			}
		elseif(strpos($ligne,$lang['Arcane Missiles']) != 0)
			{
				if($this->nb_missiles == 5) $this->missiles_mem['last_date'] = $last_date;
				$this->missiles($ligne,$last_date);
				$this->missiles_mem['ligne'] = $ligne;
				$last_dmg = getdmg($ligne);
				$this->missiles_mem['dmg'] += $last_dmg;
				$this->missiles_mem['dmgs'] .= (($this->missiles_mem['dmgs']=='(') ? '' : ',' ).$last_dmg;
			}
		elseif(strpos($ligne,$lang['Arcane Blast']) != 0)
			{

				$this->statistique['nb deflag'] ++;
				if($this->timer_debuff < $last_date )
					{
						$this->blast = 0;
						$this->nb_blast = 1;
						$this->nb_debuff = 0;
					}

				if($this->nb_missiles != 5 )
					{
						$a = explode(' ',$this->missiles_mem['ligne']);
						$ligne_txt = $a[0];
						$i=1;
						$max = count($a);
						while($i < $max)
						{
							if(preg_match('/.[0-9]./',$a[$i]))
							{
								$i += $max;
							}
							else
							{
								$ligne_txt .= ' '.$a[$i];
							}
						$i++;
						}
						$ligne_txt .= ' '.$this->missiles_mem['dmg'].' '.$this->missiles_mem['dmgs'].')';
						$this->statistique['missiles perdus'] += $this->nb_missiles;
						$cast_time = getcasttime((5-$this->nb_missiles)*$cast['Arcane Missiles']);
						insertdata($this->missiles_mem['last_date'],$ligne_txt,$this->mana,$cast_time);
 						send($this->missiles_mem['last_date'],$ligne_txt,'c0',0,$cast_time);
 						if($this->nb_missiles != 0)
						{
							send($this->missiles_mem['last_date'],"/!\ Vous avez perdu ".$this->nb_missiles." projectile".(($this->nb_missiles != 1) ? "s" : "" ).". /!\\","c5",0,0);
						}
					}
				$this->nb_missiles = 5;
				$this->missiles_mem = array('last_date' => 0,'ligne' => 0,'dmgs' => '(','dmg' => 0);
			}

		$this->get_mana($ligne,$last_date);
		if( strpos($ligne,$lang['Arcane Barrage']) != 0)
		{
			$cast_time=getcasttime($cast['Arcane Barrage']);
			$this->time_lost = max(0,sub_time($last_date,$this->last_date_dmg)-$cast_time);
			insertdata($last_date,$ligne,$this->mana,$cast_time);
			$this->last_date_dmg = $last_date;
		}
		elseif( strpos($ligne,$lang['Arcane Blast']) != 0)
		{
			$cast_time=getcasttime($cast['Arcane Blast']-0.1*$this->nb_debuff);
			$this->time_lost = max(0,sub_time($last_date,$this->last_date_dmg)-$cast_time);
			insertdata($last_date,$ligne,$this->mana,$cast_time);
			$this->last_date_dmg = $last_date;
		}
		elseif( strpos($ligne,$lang['Arcane Missiles']) != 0)
		{
			$cast_time=getcasttime($cast['Arcane Missiles']);
			$this->time_lost = max(0,sub_time($last_date,$this->last_date_dmg)-$cast_time);
			insertdata($last_date,$ligne,$this->mana,$cast_time);
			$this->last_date_dmg = $last_date;
		}
		elseif( strpos($ligne,$lang['Fire Blast']) != 0)
		{
			$cast_time=getcasttime($cast['Fire Blast']);
			$this->time_lost = max(0,sub_time($last_date,$this->last_date_dmg)-$cast_time);
			insertdata($last_date,$ligne,$this->mana,$cast_time);
			$this->last_date_dmg = $last_date;
		}
		elseif( strpos($ligne,$lang['Evocation'].' fades') != 0)
		{
			$this->last_date_dmg = $last_date;
		}
		elseif( strpos($ligne,$lang['Mirror Image']) != 0)
		{
			$cast_time=getcasttime($cast['Mirror Image']);
			$this->last_date_dmg = add_sec_to_date($last_date,$cast_time);
		}

		$ligne = preg_replace('/'.$lang['Arcane Blast'].'/',$lang['Arcane Blast'].' ('.$this->nb_debuff.')',$ligne);
		$this->debuff_arcane($ligne,$last_date);
		$this->statistique['time_lost'] += $this->time_lost;
	}

	// calcul des débuff d'arcane
	function check_clearcasting($ligne)
	{
		global $lang;
		if(	strpos($ligne,$lang['Clearcasting']) != 0)
		{
			$this->clearcasting = true;
		}
	}

	// calcul des débuff d'arcane
	function get_mana($ligne,$last_date)
	{
		
		global $lang,$hero,$mana_sorts,$mana_base;
		if(	strpos($ligne,'mana') != 0 )//&& !(strpos($ligne,$lang['Replenish Mana']) != 0))
		{
			$text = explode(" ", $ligne);
				$this->mana += $text[2];
				$this->d_mana = '+'.$text[2];
				$this->mana = max(0,min($this->mana,$mana_base));
		}
		if(	strpos($ligne,$lang['Mage Armor']) != 0 )
		{
				$this->mana += floor($mana_base*0.05);
				$this->d_mana .= ' +'.floor($mana_base*0.05);
				$this->mana = max(0,min($this->mana,$mana_base));
		}

		foreach ($mana_sorts as $k => $v) {
			if(	strpos($ligne,$lang[$k]) != 0)
			{
				if(($k == 'Arcane Barrage' || $k == 'Arcane Blast' || $k == 'Fireball') && $this->clearcasting)
				{
					$this->clearcasting = false;
					$this->d_mana = 0;
				}
				elseif($k == 'Arcane Blast')
				{
					$this->mana -= floor($v * (1 + 1.50*($this->nb_debuff)));
					$this->d_mana = -floor($v * (1 + 1.5*($this->nb_debuff)));
				}
				else
				{
					$this->mana -= $v;
					$this->d_mana = -$v;
				}
			}
		}
	}
		
	// fonction pour verifier les cd
	function check_cd($ligne,$last_date,$spell)
	{
	
		global $hero,$lang,$cd_sorts,$long_sorts;
	
		if(strpos($ligne,$lang[$spell]) != 0)
			{
	
				if(	$spell != 'Presence of Mind' &&
					$spell != 'Replenish Mana' &&
					$spell != 'Evocation'
					)
					{
						$this->buff[$spell] = add_sec_to_date($last_date,$long_sorts[$spell]);
					}
				if(!(strpos($ligne,'mana') != 0) && !(strpos($ligne,'fades') != 0))
				{
					$this->cd[$spell] = add_sec_to_date($last_date,$cd_sorts[$spell]);
//					send('-----------',"/!\ BEGIN CD ".$spell.", time out at : ".$this->cd[$spell]." /!\\","c5",0);
				}
			}
	
		if($last_date > $this->cd[$spell])
			{
  				send($this->cd[$spell],$spell." avialable","c25",0,0);
				$this->cd[$spell] = 'non';
			}
		
		if($last_date > $this->buff[$spell])
			{
  				send($this->buff[$spell],$spell." fades","c10",0,0);
				$this->buff[$spell] = 'non';
			}
	
	}

	// calcul des débuff d'arcane
	function debuff_arcane($ligne,$last_date)
	{
		
		global $lang;
		if(	strpos($ligne,$lang['Arcane Missiles']) != 0 ||
			strpos($ligne,$lang['Arcane Barrage']) != 0)
			{
				$this->nb_debuff = 0;
				$this->timer_debuff = $last_date;
			}
		elseif(strpos($ligne,$lang['Arcane Blast']) != 0)
			{
				$this->nb_debuff = min(4, $this->nb_debuff + 1);
				$this->nb_blast ++;
				$this->timer_debuff = add_sec_to_date($last_date,6);
			}
	}

	// vérifier les projo
	function missiles($ligne,$last_date)
	{
		global $hero;
		
		$this->nb_missiles--;
		$this->statistique['nb missiles'] ++;
		$this->nb_blast = 0;
		$this->nb_debuff = 0;
	}
	
	// resultat
    function resultat() {
		echo '- '.$this->statistique['time_lost'].' secondes de perdues.<br />'."\n";
		echo '- '.$this->statistique['nb missiles'].' missiles.<br />'."\n";
		echo '- '.$this->statistique['nb deflag'].' déflag.<br />'."\n";
//		echo '- '.$this->statistique['nb blink'].' blink.<br />'."\n";
		echo '- '.$this->statistique['nb barrage'].' barrage.<br />'."\n";
		}

}

?>