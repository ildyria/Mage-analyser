<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

class analyse_fire {

	var $a_memory = array(
		'cast_time' => 0,
		'time_lost' => 0,
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
		'Combustion' => 'non',
		'Hospitality' => 'non',
		'Scale of Fates' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Evocation' => 'non',
		'Flame Orb' => 'non'
		);
	var $a_buff = array(
		'Combustion' => 'non',
		'Hospitality' => 'non',
		'Scale of Fates' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Flame Orb' => 'non',
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

		// MANA GAIN
		while ($this->a_timer['requinc'] < $last_date) {
			$this->a_mana['current'] = requincage($this->a_mana['current']);
			$this->a_timer['requinc'] = add_sec_to_date($this->a_timer['requinc'],1);
		}

		while ($this->a_timer['mp5'] < $last_date) {
			$this->a_mana['current'] = addmp5($this->a_mana['current']);
			$this->a_timer['mp5'] = add_sec_to_date($this->a_timer['mp5'],5);
		}

		// INITIALISING VALUES
		$this->a_memory['time_lost'] = 0;
		$this->a_mana['delta'] = 0;
		
		// CHECKS
		$this->check_clearcasting($ligne);
		$this->check_cd($ligne,$last_date,'Combustion');
		$this->check_cd($ligne,$last_date,'Mirror Image');
		$this->check_cd($ligne,$last_date,'Replenish Mana');
		$this->check_cd($ligne,$last_date,'Flame Orb');
		$this->check_cd($ligne,$last_date,'Evocation');

		if(strpos($ligne,$lang['Fireball']) != 0)
			{
				$this->statistique['nb bdf'] ++;
			}
		if(strpos($ligne,$lang['Pyroblast']) != 0)
			{
				$this->statistique['nb pyro'] ++;
			}
		if(strpos($ligne,$lang['Hot Streak']) != 0)
			{
				if(!(strpos($ligne,'fades') != 0)) $this->statistique['nb proc pyro'] ++;
			}
		if(strpos($ligne,$lang['Living Bomb']) != 0)
			{
				$this->statistique['nb lb'] ++;
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
	
				if(	$spell != 'Combustion' &&
					$spell != 'Replenish Mana' &&
					$spell != 'Flame Orb' &&
					$spell != 'Evocation'
					)
					{
						$this->a_buff[$spell] = add_sec_to_date($last_date,$long_sorts[$spell]);
					}
				if(!(strpos($ligne,'fades') != 0) && $this->a_cd[$spell] == 'non')
					{
						$this->a_cd[$spell] = add_sec_to_date($last_date,$cd_sorts[$spell]);
						send($last_date,"/!\ BEGIN cd ".$lang[$spell].", time out at : ".$this->a_cd[$spell]." /!\\","c5");
					}
			}
	
		if($last_date > $this->a_cd[$spell])
			{
  				send($this->a_cd[$spell],$lang[$spell]." available","c25");
				$this->a_cd[$spell] = 'non';
			}
		
		if($last_date > $this->a_buff[$spell])
			{
  				send($this->a_buff[$spell],$lang[$spell]." fades","c10");
				$this->a_buff[$spell] = 'non';
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
		

	// resultat
    function resultat() {
		global $duree;
		
		echo '- '.$this->statistique['nb blink'].' blink.<br />'."\n";
		echo '- '.$this->statistique['nb bdf'].' boules de feu.<br />'."\n";
		echo '- '.$this->statistique['nb pyro'].' Explosion pyrotechnique pour '.$this->statistique['nb proc pyro'].' proc de Chaleur continue soit '.($this->statistique['nb proc pyro']-$this->statistique['nb pyro']).' manqu&eacute;es.<br />'."\n";
		echo '- '.$this->statistique['nb lb'].' bombes vivantes ('.floor($duree/12).' maximum en monocible).<br />'."\n";
		}

}

?>