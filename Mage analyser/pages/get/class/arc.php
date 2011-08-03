<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

class analyse_arcane {

	var $a_memory = array(
		'Pyromaniac' => 'non',
		'missiles_last_date' => 0,
		'missiles_ligne' => 0,
		'missiles_dmgs' => '(',
		'missiles_dmg' => 0,
		'missiles_nb' => 5,
		'explosion_last_date' => 0,
		'explosion_ligne' => 0,
		'explosion_dmgs' => '(',
		'explosion_dmg' => 0,
		'explosion_crit' => 'non',
		'explosion_end_date' => 0,
		
		'cast_time' => 0,
		'time_lost' => 0,
		'last_date_dmg' => 0,
		);
	var $a_timer = array(
		'mp5' => 'non',
		'requinc' => 'non'
	);
	var $a_arcaneblast = array(
		'timer' => '[00:00:00.000]',
		'nb_debuff' => 0,
		'ended' => 'non'
	);
	var $a_mana = array(
		'max' => 0,
		'current' => 0,
		'delta' => 0
	);
	var $clearcasting = false;
	var $a_statistique = array(
		'time_lost'=>0,
		'missiles perdus'=>0,
		'deflag en trop' => 0,
		'nb missiles' => 0,
		'nb deflag' => 0,
		'nb barrage' => 0,
		'nb fire blast' => 0,
		'nb blink' => 0
		);
	var $a_cd = array(
		'Arcane Power' => 'non',
		'Presence of Mind' => 'non',

		'Celerity' => 'non',
		'Mark of the Firelord' => 'non',
		'Battle Magic' => 'non',
		'Dire Magic' => 'non',
		'Volcanic Destruction' => 'non',
		'Soul Power' => 'non',
		'Revelation' => 'non',

		'Icy Veins' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Evocation' => 'non',
		'Mage Ward' => 'non',
		'Flame Orb' => 'non'
		);
	var $a_buff = array(
		'Arcane Power' => 'non',
		'Presence of Mind' => 'non',

		'Celerity' => 'non',
		'Mark of the Firelord' => 'non',
		'Battle Magic' => 'non',
		'Dire Magic' => 'non',
		'Volcanic Destruction' => 'non',
		'Soul Power' => 'non',
		'Revelation' => 'non',

		'Icy Veins' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Flame Orb' => 'non',
		'Mage Ward' => 'non',
		'Evocation' => 'non'
		);

/*************************************************
**
** INITIALISE
**
*************************************************/
	function initialise($last_date,$manabase) {

		$this->a_memory['last_date_dmg'] = $last_date;
		$this->a_timer['requinc'] = $last_date;
		$this->a_timer['mp5'] = $last_date;
		$this->a_arcaneblast['debuff'] = $last_date;
		$this->a_mana['max'] = $manabase;
		$this->a_mana['current'] = $manabase;
		$this->a_mana['delta'] = 0;		
	}



/*************************************************
**
** ANALYSE
**
*************************************************/
	function analyse($hero,&$ligne,$last_date) {
	
		global $lang;
		
		// INITIALISING VALUES
		$this->a_arcaneblast['ended'] = 'non';
		$this->a_memory['time_lost'] = 0;
		$this->a_mana['delta'] = 0;
		
		$this->a_mana['max'] = manamaxvar($this->a_mana['max'],$ligne);

		// MANA GAIN
		while ($this->a_timer['requinc'] < $last_date) {
			$this->a_mana['current'] = requincage($this->a_mana['current'],$this->a_mana['max']);
			$this->a_timer['requinc'] = add_sec_to_date($this->a_timer['requinc'],1);
//			send($last_date,'REQUINC : '.($this->a_mana['max']*0.001).' || NEXT : '.$this->a_timer['requinc'],'c2');
		}

		while ($this->a_timer['mp5'] < $last_date) {
			$this->a_mana['current'] = addmp5($this->a_mana['current'],$this->a_mana['max']);
			$this->a_timer['mp5'] = add_sec_to_date($this->a_timer['mp5'],5);
//			send($last_date,'ARMOR + MP5 : '.(869+326+$this->a_mana['max']*0.036).' || NEXT : '.$this->a_timer['mp5'],'c6');
		}

		// CHECKS
		$this->check_arcanedebuff($last_date);
		$this->check_clearcasting($ligne);
		$this->check_cd($ligne,$last_date,'Arcane Power');
		$this->check_cd($ligne,$last_date,'Presence of Mind');

		$this->check_cd($ligne,$last_date,'Celerity');
		$this->check_cd($ligne,$last_date,'Mark of the Firelord');
		$this->check_cd($ligne,$last_date,'Battle Magic');
		$this->check_cd($ligne,$last_date,'Dire Magic');
		$this->check_cd($ligne,$last_date,'Volcanic Destruction'); 
		$this->check_cd($ligne,$last_date,'Soul Power');
		$this->check_cd($ligne,$last_date,'Revelation');

		$this->check_cd($ligne,$last_date,'Mirror Image');
		$this->check_cd($ligne,$last_date,'Replenish Mana');
		$this->check_cd($ligne,$last_date,'Flame Orb');
		$this->check_cd($ligne,$last_date,'Evocation');
		$this->check_cd($ligne,$last_date,'Mage Ward');

		$this->f_addmana($ligne,$last_date);
		
		if(strpos($ligne,$lang['Arcane Barrage']) != 0) // if arcane barrage
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_arcanebarrage($ligne,$last_date);
			}
		elseif(strpos($ligne,$lang['Arcane Missiles']) != 0) // if arcane missile
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissiles($ligne,$last_date);
			}
		elseif(strpos($ligne,$lang['Arcane Explosion']) != 0) // if arcane explosion
			{
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_arcaneexplosion($ligne,$last_date);
			}
		elseif(strpos($ligne,$lang['Arcane Blast']) != 0) // if arcane blast
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_arcaneblast($ligne,$last_date);
			}
		elseif(strpos($ligne,$lang['Flame Orb']) != 0) // if flameorb
			{
				$this->f_flameorb($ligne,$last_date);
			}
		elseif( strpos($ligne,$lang['Evocation']) != 0)
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Mirror Image']) != 0)
			{
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_timelost($last_date,'Mirror Image');
				$this->get_mana('Mirror Image',$last_date);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Fire Blast']) != 0)
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_timelost($last_date,'Fire Blast');
				$this->get_mana('Fire Blast',$last_date);
				$this->a_statistique['nb fire blast'] += 1;
				insertdata($last_date,$ligne,$this->a_mana['current'],$this->a_memory['cast_time']);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Blink']) != 0)
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_timelost($last_date,'Blink');
				$this->get_mana('Blink',$last_date);
				$this->a_statistique['nb blink'] += 1;
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Mage Ward']) != 0)
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_timelost($last_date,'Mage Ward');
				$this->get_mana('Mage Ward',$last_date);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Slow Fall']) != 0)
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_timelost($last_date,'Slow Fall');
				$this->get_mana('Slow Fall',$last_date);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Time Warp']) != 0 && !(strpos($ligne,'fades') != 0)) // le soucis, c'est que si c'est un autre mage qui le lance... :/
			{
				$this->f_arcaneexplosionsend($ligne,$last_date);
				$this->f_arcanemissilesend($ligne,$last_date);
				$this->f_timelost($last_date,'Time Warp');
				$this->get_mana('Time Warp',$last_date);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
			
		else
			{
			}
	}




/*************************************************
**
** CHECK CLEARCASTING
**
*************************************************/
	function check_clearcasting($ligne)
	{
		global $lang;
		if(	strpos($ligne,$lang['Clearcasting']) != 0)
		{
			$this->clearcasting = true;
		}
	}



/*************************************************
**
** CHECK IF ARCANE DEBUFF IS STILL ACTIVE
**
*************************************************/
	function check_arcanedebuff($last_date)
	{
		if($this->a_arcaneblast['timer'] < $last_date)
		{
			$this->a_arcaneblast['ended'] = 'oui';
		}
	}




/*************************************************
**
** CALCULATE SPELL MANA COST AND MANAGING MANA 
**
*************************************************/
	function get_mana($spell,$last_date)
	{
		
		global $mana_sorts,$cd_sorts;

		if(($spell == 'Arcane Barrage' || $spell == 'Arcane Blast' || $spell == 'Arcane Explosion') && $this->clearcasting)
		{
			$this->clearcasting = false;
			$this->a_mana['delta'] = 0;
		}
		elseif($spell == 'Arcane Blast')
		{
			$this->a_mana['current'] -= floor($mana_sorts['Arcane Blast'] * (1 + 1.5*($this->a_arcaneblast['nb_debuff'])));
			$this->a_mana['delta'] = -floor($mana_sorts['Arcane Blast'] * (1 + 1.5*($this->a_arcaneblast['nb_debuff'])));
		}
		elseif($spell == 'Flame Orb')
		{
			// that is to avoid flame orb cost being removed on each tic.
			if($this->a_cd['Flame Orb'] == add_sec_to_date($last_date,$cd_sorts['Flame Orb']))
			{
			$this->a_mana['current'] -= $mana_sorts['Flame Orb'];
			$this->a_mana['delta'] = -$mana_sorts['Flame Orb'];
			}
		}
		else
		{
			$this->a_mana['current'] -= $mana_sorts[$spell];
			$this->a_mana['delta'] = -$mana_sorts[$spell];
		}
		
		$this->a_mana['current'] = max(0,$this->a_mana['current']);
	}



/*************************************************
**
**  ADD MANA 
**
*************************************************/
	function f_addmana($ligne,$last_date)
	{
		// adding mana if mana gem or evocation		
		if(	strpos($ligne,'mana') != 0 )
		{
			$text = explode(" ", $ligne);
			$this->a_mana['current'] += $text[2];
			$this->a_mana['delta'] = '+'.$text[2];
			$this->a_mana['current'] = max(0,min($this->a_mana['current'],$this->a_mana['max']));
		}
	}




/*************************************************
**
** CHECK IF CD IS USED OR OFF CD OR BECOMING AVAILABLE
**
*************************************************/
	function check_cd($ligne,$last_date,$spell)
	{
	
		global $lang,$cd_sorts,$long_sorts;
	
		if(strpos($ligne,$lang[$spell]) != 0)
			{
	
				if(	$spell != 'Presence of Mind' &&
					$spell != 'Flame Orb' &&
					$spell != 'Mage Ward' &&
					$spell != 'Evocation'
					)
					{
						$this->a_buff[$spell] = add_sec_to_date($last_date,$long_sorts[$spell]);
					}
				if(!(strpos($ligne,'fades') != 0) && $this->a_cd[$spell] == 'non' && $cd_sorts[$spell] != 0)
					{
						$this->a_cd[$spell] = add_sec_to_date($last_date,$cd_sorts[$spell]);
					}
			}
	
		if($last_date > $this->a_cd[$spell])
			{
				$lttltxt = $lang[$spell]." available";
				prepare_ligne($lttltxt);
  				send($this->a_cd[$spell],$lttltxt,"c25");
				$this->a_cd[$spell] = 'non';
				unset($lttltxt);
			}
		
		if($last_date > $this->a_buff[$spell])
			{
				$lttltxt = $lang[$spell]." fades";
				prepare_ligne($lttltxt);
  				send($this->a_buff[$spell],$lttltxt,"c25");
				$this->a_buff[$spell] = 'non';
				$this->a_mana['max'] = manamaxvar($this->a_mana['max'],$lttltxt);
				unset($lttltxt);
			}
	
	}



/*************************************************
**
**  CHECK IF TIME HAVE BEEN LOST BETWEEN CASTS
**
*************************************************/
	function f_timelost($last_date,$spell)
	{
		global $cast;
		
		$this->a_memory['cast_time'] = getcasttime($cast[$spell]);
		$delay = 0;
		if($spell == 'Flame Orb' or $spell == 'Arcane Barrage') $delay = 1;
		$this->a_memory['time_lost'] = floor((max(0,sub_time($last_date,$this->a_memory['last_date_dmg'])-$this->a_memory['cast_time']-$delay))*1000)/1000;
		$this->a_statistique['time_lost'] += $this->a_memory['time_lost'];

	}



/*************************************************
**
** ARCANE BLAST
**
*************************************************/
	function f_arcaneblast(&$ligne,$last_date)
	{

		global $cast,$lang;

		if($this->a_arcaneblast['ended'] == 'oui')
			{
				$this->a_memory['cast_time'] = max(1,SET4T11*getcasttime($cast['Arcane Blast']-0.1*$this->a_arcaneblast['nb_debuff']));
				if(add_sec_to_date($last_date,-$this->a_memory['cast_time']) < $this->a_arcaneblast['timer'])
				{
					$this->get_mana('Arcane Blast',$last_date);
					insertdata($last_date,$ligne,$this->a_mana['current'],$this->a_memory['cast_time']);
					masterofelements('Arcane Blast',$ligne,$this->a_mana);
					$ligne = preg_replace('/'.$lang['Arcane Blast'].'/',$lang['Arcane Blast'].' ('.$this->a_arcaneblast['nb_debuff'].')',$ligne);
				}
				else
				{
					$this->a_arcaneblast['nb_debuff'] = 0;
					$this->a_memory['cast_time'] = max(1,SET4T11*getcasttime($cast['Arcane Blast']));
					$this->get_mana('Arcane Blast',$last_date);
					insertdata($last_date,$ligne,$this->a_mana['current'],$this->a_memory['cast_time']);
					masterofelements('Arcane Blast',$ligne,$this->a_mana);
					$ligne = preg_replace('/'.$lang['Arcane Blast'].'/',$lang['Arcane Blast'].' ('.$this->a_arcaneblast['nb_debuff'].')',$ligne);
				}
			}
		else
			{
				$this->a_memory['cast_time'] = max(1,SET4T11*getcasttime($cast['Arcane Blast']-0.1*$this->a_arcaneblast['nb_debuff']));
				$this->get_mana('Arcane Blast',$last_date);
				insertdata($last_date,$ligne,$this->a_mana['current'],$this->a_memory['cast_time']);
				masterofelements('Arcane Blast',$ligne,$this->a_mana);
				$ligne = preg_replace('/'.$lang['Arcane Blast'].'/',$lang['Arcane Blast'].' ('.$this->a_arcaneblast['nb_debuff'].')',$ligne);
			}


		$this->a_memory['time_lost'] = floor((max(0,sub_time($last_date,$this->a_memory['last_date_dmg'])-$this->a_memory['cast_time']))*1000)/1000;
		$this->a_statistique['time_lost'] += $this->a_memory['time_lost'];


		$this->a_memory['last_date_dmg'] = $last_date;
		$this->a_arcaneblast['nb_debuff'] = min(4,$this->a_arcaneblast['nb_debuff']+1);
		$this->a_arcaneblast['timer'] = add_sec_to_date($last_date,6);
		$this->a_statistique['nb deflag'] ++;
		
	}



/*************************************************
**
** ARCANE BARRAGE
**
*************************************************/
	function f_arcanebarrage($ligne,$last_date)
	{

		global $cast;
		
		$this->a_statistique['nb barrage'] ++;

		$this->a_arcaneblast['nb_debuff'] = 0;
		$this->a_arcaneblast['timer'] = $last_date;

		$this->get_mana('Arcane Barrage',$last_date);
		$this->f_timelost($last_date,'Arcane Barrage');
//		$this->a_memory['cast_time'] = getcasttime($cast['Arcane Barrage']);
		masterofelements('Arcane Barrage',$ligne,$this->a_mana);
		insertdata($last_date,$ligne,$this->a_mana['current'],$this->a_memory['cast_time']);

		$this->a_memory['last_date_dmg'] = $last_date;

	}



/*************************************************
**
** ARCANE MISSILES
**
*************************************************/
	function f_arcanemissiles($ligne,$last_date)
	{
		if($this->a_memory['missiles_nb'] == 0) $this->f_arcanemissilesend($ligne,$last_date);

		$this->a_arcaneblast['nb_debuff'] = 0;
		$this->a_arcaneblast['timer'] = $last_date;

		if($this->a_memory['missiles_nb'] == 5) $this->a_memory['missiles_last_date'] = $last_date;
		$this->a_memory['missiles_nb'] --;
		$this->a_memory['missiles_ligne'] = $ligne;
		$last_dmg = getdmg($ligne);
		$this->a_memory['missiles_dmg'] += $last_dmg; //full dmg
		$this->a_memory['missiles_dmgs'] .= (($this->a_memory['missiles_dmgs']=='(') ? '' : ', ' ).$last_dmg; //prepare missile dmg

		$this->a_statistique['nb missiles'] ++;
	}


	
/*************************************************
**
** ARCANE MISSILES END
**
*************************************************/
	function f_arcanemissilesend($ligne,$last_date)
	{
	
		global $cast;

		if($this->a_memory['missiles_nb'] != 5 )
			{
				$a = explode(' ',$this->a_memory['missiles_ligne']);
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
				$ligne_txt .= ' '.$this->a_memory['missiles_dmg'].' '.$this->a_memory['missiles_dmgs'].')';
				$this->a_statistique['missiles perdus'] += $this->a_memory['missiles_nb'];
				$this->a_memory['cast_time'] = getcasttime((5-$this->a_memory['missiles_nb'])*$cast['Arcane Missiles']);
				
				insertdata($this->a_memory['missiles_last_date'],$ligne_txt,$this->a_mana['current'],$this->a_memory['cast_time']);
				send($this->a_memory['missiles_last_date'],$ligne_txt,'c0');
				
				if($this->a_memory['missiles_nb'] != 0)
				{

					$this->a_mana['delta'] = 0;
					$this->a_memory['cast_time'] = 0;
					send($this->a_memory['missiles_last_date'],"/!\ Vous avez perdu ".$this->a_memory['missiles_nb']." projectile".(($this->a_memory['missiles_nb'] != 1) ? "s" : "" ).". /!\\","c5");
				}
				$this->a_memory['last_date_dmg'] = $this->a_memory['missiles_last_date'];
			}

		$this->a_memory['missiles_nb'] = 5;
		$this->a_memory['missiles_last_date'] = 0;
		$this->a_memory['missiles_ligne'] = 0;
		$this->a_memory['missiles_dmgs'] = '(';
		$this->a_memory['missiles_dmg'] = 0;
	}
	
	


	
	
/*************************************************
**
** ARCANE EXPLOSION
**
*************************************************/
	function f_arcaneexplosion($ligne,$last_date)
	{
		if($this->a_memory['explosion_end_date'] > $last_date)
		{
			$this->a_memory['explosion_ligne'] = $ligne;
			$last_dmg = getdmg($ligne);
			$crit = iscrit($ligne);
			$this->a_memory['explosion_dmg'] += $last_dmg;
			if($crit == 'crit')
				{
					$this->a_memory['explosion_crit'] = 'oui';
					$last_dmg = "*".$last_dmg."*";
				}
			$this->a_memory['explosion_dmgs'] .= (($this->a_memory['explosion_dmgs']=='(') ? '' : ', ' ).$last_dmg;
		}
		else
		{
			$this->f_arcaneexplosionsend($ligne,$last_date);
			$this->a_memory['explosion_last_date'] = $last_date;
			$this->a_memory['explosion_end_date'] = add_sec_to_date($last_date,0.9);
			$this->a_memory['explosion_ligne'] = $ligne;
			$last_dmg = getdmg($ligne);
			$crit = iscrit($ligne);
			$this->a_memory['explosion_dmg'] += $last_dmg;
			if($crit == 'crit')
				{
					$this->a_memory['explosion_crit'] = 'oui';
					$last_dmg = "*".$last_dmg."*";
				}
			$this->a_memory['explosion_dmgs'] .= (($this->a_memory['explosion_dmgs']=='(') ? '' : ', ' ).$last_dmg;
		}		
	}
	
	
/*************************************************
**
** ARCANE EXPLOSION END
**
*************************************************/
	function f_arcaneexplosionsend($ligne,$last_date)
	{

	global $mana_sorts;
	
		if($this->a_memory['explosion_last_date'] != 0 )
			{
				$a = explode(' ',$this->a_memory['explosion_ligne']);
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
				if($this->a_memory['explosion_crit'] == 'oui')
				{
					$this->a_mana['current'] = min($this->a_mana['max'],$this->a_mana['current']+round($mana_sorts['Arcane Explosion']*0.3,0));
				}
				$ligne_txt .= ' '.$this->a_memory['explosion_dmg'].' '.$this->a_memory['explosion_dmgs'].')';
				$this->f_timelost($this->a_memory['explosion_last_date'],'Arcane Explosion');
				$this->get_mana('Arcane Explosion',$last_date);
				insertdata($this->a_memory['explosion_last_date'],$ligne_txt,$this->a_mana['current'],$this->a_memory['cast_time']);
				send($this->a_memory['explosion_last_date'],$ligne_txt,'c0');
				$this->a_memory['last_date_dmg'] = $this->a_memory['explosion_last_date'];
			}

		$this->a_memory['explosion_end_date'] = 0;
		$this->a_memory['explosion_last_date'] = 0;
		$this->a_memory['explosion_ligne'] = 0;
		$this->a_memory['explosion_dmgs'] = '(';
		$this->a_memory['explosion_dmg'] = 0;
		$this->a_memory['explosion_crit'] = 'non';
	}
	
	


	
	
/*************************************************
**
** FLAME ORB
**
*************************************************/
	function f_flameorb($ligne,$last_date)
	{

		global $cd_sorts;
		
		// that is to avoid flame orb cost being removed on each tic.
		if($this->a_cd['Flame Orb'] == add_sec_to_date($last_date,$cd_sorts['Flame Orb']))
		{
			$this->f_arcaneexplosionsend($ligne,$last_date);
			$this->f_arcanemissilesend($ligne,$last_date);
			$this->get_mana('Flame Orb',$last_date);
			$this->f_timelost($last_date,'Flame Orb');
			$this->a_memory['last_date_dmg'] = $last_date;
		}

		masterofelements('Flame Orb',$ligne,$this->a_mana);
		insertdata($last_date,$ligne,$this->a_mana['current'],0.1);

	}



	
/*************************************************
**
** PRINT PARSING RESULTS
**
*************************************************/
    function resultat($long) {
		$minutes = (floor($this->a_statistique['time_lost']) - (floor($this->a_statistique['time_lost']) % 60)) / 60;
		$secondes = $this->a_statistique['time_lost'] - 60 * $minutes;
		if($minutes != 0)
			{
				echo '- '.$minutes.' minutes et '.round($secondes,1).' secondes de perdues ('.round($this->a_statistique['time_lost']/$long*100,0).'%).<br />'."\n";
			}
		else
			{
				echo '- '.$this->a_statistique['time_lost'].' secondes de perdues ('.round($this->a_statistique['time_lost']/$long*100,0).'%).<br />'."\n";
			}
		echo '- '.$this->a_statistique['nb missiles'].' missiles.<br />'."\n";
		echo '- '.$this->a_statistique['nb deflag'].' déflag.<br />'."\n";
		echo '- '.$this->a_statistique['nb blink'].' blink.<br />'."\n";
		echo '- '.$this->a_statistique['nb barrage'].' barrage.<br />'."\n";
		echo '- '.$this->a_statistique['nb fire blast'].' Trait de feu.<br />'."\n";

		}

}

?>