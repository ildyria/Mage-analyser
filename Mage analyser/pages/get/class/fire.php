<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

class analyse_fire {

	var $timer_debuff_brulure = '[00:00:00.000]';
	var $timer_debuff_lb = array();
	var $statistique = array(
		'nb brulure' => 0,
		'nb bdf' => 0,
		'nb pyro' => 0,
		'nb lb' => 0,
		'nb blink' => 0,
		'nb tdf' => 0,
		'nb proc pyro' => 0
		);
	var $cd = array(
		'Hospitality' => 'non',
		'Elusive Power' => 'non',
		'Scale of Fates' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Evocation' => 'non'
		);
	var $buff = array(
		'Hospitality' => 'non',
		'Elusive Power' => 'non',
		'Scale of Fates' => 'non',
		'Mirror Image' => 'non',
		'Replenish Mana' => 'non',
		'Evocation' => 'non'
		);

	function analyse($hero,&$ligne,$last_date) {
	
		global $lang;
		
		$this->check_cd($ligne,$last_date,'Hospitality');
		$this->check_cd($ligne,$last_date,'Elusive Power');
		$this->check_cd($ligne,$last_date,'Scale of Fates');
		$this->check_cd($ligne,$last_date,'Mirror Image');
		$this->check_cd($ligne,$last_date,'Replenish Mana');
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
		
	// fonction pour verifier les cd
	function check_cd($ligne,$last_date,$spell)
	{
	
		global $hero,$lang,$cd_sorts,$long_sorts;
	
		if(strpos($ligne,$lang[$spell]) != 0)
			{
	
				if(	$spell != 'Replenish Mana' && $spell != 'Evocation' )
					{
						$this->buff[$spell] = add_sec_to_date($last_date,$long_sorts[$spell]);
					}
				$this->cd[$spell] = add_sec_to_date($last_date,$cd_sorts[$spell]);
			}
	
		if($last_date > $this->cd[$spell])
			{
				send($this->cd[$spell],$spell." avialable","c25",$hero);
				$this->cd[$spell] = 'non';
			}
		
		if($last_date > $this->buff[$spell])
			{
				send($this->buff[$spell],$spell." fades","c10",$hero);
				$this->buff[$spell] = 'non';
			}
	
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