<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

class analyse_fire {

	var $a_memory = array(
		'cast_time' => 0,
		'time_lost' => 0,
		'Pyromaniac' => 'non',
		'last_date_dmg' => 0
		);
	var $a_timer = array(
		'mp5' => 'non',
		'requinc' => 'non',
		'scorch' => 'non',
		'LB' => 'non'
	);
	var $a_mana = array(
		'max' => 0,
		'current' => 0,
		'delta' => 0
	);
	var $clearcasting = false;
	var $a_statistique = array(
		'nb brulure' => 0,
		'nb bdf' => 0,
		'nb pyro' => 0,
		'nb lb' => 0,
		'nb blink' => 0,
		'nb tdf' => 0,
		'nb proc pyro' => 0,
		'time_lost'=>0,
		);
	var $a_cd = array(
		'Celerity' => 'non',
		'Mark of the Firelord' => 'non',
		'Battle Magic' => 'non',
		'Dire Magic' => 'non',
		'Volcanic Destruction' => 'non',
		'Soul Power' => 'non',
		'Revelation' => 'non',

		'Hospitality' => 'non',
		'Scale of Fates' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Evocation' => 'non',
		'Combustion' => 'non',
		'Mage Ward' => 'non',
		'Flame Orb' => 'non'
		);
	var $a_buff = array(
		'Celerity' => 'non',
		'Mark of the Firelord' => 'non',
		'Battle Magic' => 'non',
		'Dire Magic' => 'non',
		'Volcanic Destruction' => 'non',
		'Soul Power' => 'non',
		'Revelation' => 'non',

		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Mage Ward' => 'non',
		'Flame Orb' => 'non',
		'Combustion' => 'non',
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

		$this->a_mana['max'] = manamaxvar($this->a_mana['max'],$ligne);

		// MANA GAIN
		while ($this->a_timer['requinc'] < $last_date) {
			$this->a_mana['current'] = requincage($this->a_mana['current'],$this->a_mana['max']);
			$this->a_timer['requinc'] = add_sec_to_date($this->a_timer['requinc'],1);
		}

		while ($this->a_timer['mp5'] < $last_date) {
			$this->a_mana['current'] = addmp5($this->a_mana['current'],$this->a_mana['max']);
			$this->a_timer['mp5'] = add_sec_to_date($this->a_timer['mp5'],5);
		}

		// INITIALISING VALUES
		$this->a_memory['time_lost'] = 0;
		$this->a_mana['delta'] = 0;
		
		// CHECKS
		$this->check_clearcasting($ligne);
		$this->check_cd($ligne,$last_date,'Combustion');

		$this->check_cd($ligne,$last_date,'Celerity');
		$this->check_cd($ligne,$last_date,'Mark of the Firelord');
		$this->check_cd($ligne,$last_date,'Battle Magic');
		$this->check_cd($ligne,$last_date,'Dire Magic');
		$this->check_cd($ligne,$last_date,'Volcanic Destruction'); 
		$this->check_cd($ligne,$last_date,'Soul Power');
		$this->check_cd($ligne,$last_date,'Revelation');

		$this->check_cd($ligne,$last_date,'Combustion');
		$this->check_cd($ligne,$last_date,'Mirror Image');
		$this->check_cd($ligne,$last_date,'Replenish Mana');
		$this->check_cd($ligne,$last_date,'Flame Orb');
		$this->check_cd($ligne,$last_date,'Evocation');
		$this->check_cd($ligne,$last_date,'Mage Ward');

		$this->f_addmana($ligne,$last_date);
		
		if(strpos($ligne,$lang['Fireball']) != 0)
			{
				$this->a_statistique['nb bdf'] ++;
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif(strpos($ligne,$lang['Pyroblast']) != 0)
			{
				$this->a_statistique['nb pyro'] ++;
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif(strpos($ligne,$lang['Hot Streak']) != 0)
			{
				if(!(strpos($ligne,'fades') != 0)) $this->a_statistique['nb proc pyro'] ++;
			}
		elseif(strpos($ligne,$lang['Living Bomb']) != 0)
			{
				$this->a_statistique['nb lb'] ++;
			}
		elseif( strpos($ligne,$lang['Time Warp']) != 0 && !(strpos($ligne,'fades') != 0)) // le soucis, c'est que si c'est un autre mage qui le lance... :/
			{
//				$this->f_timelost($last_date,'Time Warp');
				$this->get_mana('Time Warp',$last_date);
				$this->a_memory['last_date_dmg'] = $last_date;
			}
		elseif( strpos($ligne,$lang['Pyromaniac']) != 0 && !(strpos($ligne,'fades') != 0))
			{
				$this->a_memory['Pyromaniac'] = 'on';
			}
		elseif( strpos($ligne,$lang['Pyromaniac']) != 0)
			{
				$this->a_memory['Pyromaniac'] = 'non';
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
** CALCULATE SPELL MANA COST AND MANAGING MANA 
**
*************************************************/
	function get_mana($spell,$last_date)
	{
		
		global $mana_sorts,$cd_sorts;

		if($spell == 'Flame Orb')
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
	
				if(	$spell != 'Flame Orb' &&
					$spell != 'Mage Ward' &&
					$spell != 'Evocation' &&
					$spell != 'Combustion'
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
		$this->a_memory['time_lost'] = max(0,sub_time($last_date,$this->a_memory['last_date_dmg'])-$this->a_memory['cast_time']);
		$this->a_statistique['time_lost'] += $this->a_memory['time_lost'];

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
		echo '- '.$this->a_statistique['nb blink'].' blink.<br />'."\n";
		echo '- '.$this->a_statistique['nb bdf'].' boules de feu.<br />'."\n";
		echo '- '.$this->a_statistique['nb pyro'].' Explosion pyrotechnique pour '.$this->a_statistique['nb proc pyro'].' proc de Chaleur continue soit '.($this->a_statistique['nb proc pyro']-$this->a_statistique['nb pyro']).' manqu&eacute;es.<br />'."\n";
		echo '- '.$this->a_statistique['nb lb'].' bombes vivantes ('.floor($long/12).' maximum en monocible).<br />'."\n";
		}

}

?>