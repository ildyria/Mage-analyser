<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

define('MANA_BASE', 17418);
define('CST_HATE', 12806);


if($T11 == 'non')
	{
		define('SET4T11', 1);
	}
else
	{
		define('SET4T11', 0.9);
	}

/*************************************************
**
** COOLDOWN TABLE
**
*************************************************/
$cd_sorts = array();

$cd_sorts['Arcane Power'] = 90;
$cd_sorts['Presence of Mind'] = 90;

$cd_sorts['Celerity'] = 60;
$cd_sorts['Mark of the Firelord'] = 60;
$cd_sorts['Battle Magic'] = 0;
$cd_sorts['Dire Magic'] = 0;
$cd_sorts['Volcanic Destruction'] = 0; 
$cd_sorts['Soul Power'] = 120;
$cd_sorts['Revelation'] = 0;

$cd_sorts['Icy Veins'] = 144;
$cd_sorts['Mirror Image'] = 180;
$cd_sorts['Replenish Mana'] = 120;
$cd_sorts['Evocation'] = 120;
$cd_sorts['Flame Orb'] = 60;
$cd_sorts['Mage Ward'] = 30;



/*************************************************
**
** MANA COST TABLE
**
*************************************************/
$mana_sorts = array();

$mana_sorts['Arcane Power'] = 0;
$mana_sorts['Blink'] = floor(0.12*MANA_BASE);
$mana_sorts['Mirror Image'] = floor(0.1*MANA_BASE);
$mana_sorts['Arcane Barrage'] = floor(0.11*MANA_BASE);
$mana_sorts['Arcane Blast'] = floor(0.05*MANA_BASE);
$mana_sorts['Arcane Missiles'] = 0;
$mana_sorts['Arcane Explosion'] = floor(0.15*MANA_BASE);
$mana_sorts['Living Bomb'] = floor(0.17*MANA_BASE);
$mana_sorts['Fireball'] = floor(0.09*MANA_BASE);
$mana_sorts['Fire Blast'] = floor(0.21*MANA_BASE);
$mana_sorts['Scorch'] = floor(0.08*MANA_BASE);
$mana_sorts['Pyroblast'] = floor(0.17*MANA_BASE);
$mana_sorts['Dragon Breath'] = floor(0.07*MANA_BASE);
$mana_sorts['Flamestrike'] = floor(0.3*MANA_BASE);
$mana_sorts['Blast Wave'] = floor(0.07*MANA_BASE);
$mana_sorts['Flame Orb'] = floor(0.06*MANA_BASE);
$mana_sorts['Mage Ward'] = floor(0.16*MANA_BASE);
$mana_sorts['Slow Fall'] = floor(0.06*MANA_BASE);
$mana_sorts['Time Warp'] = floor(0.26*MANA_BASE);




/*************************************************
**
** SPELL DURATION TABLE
**
*************************************************/
$long = array();

$long_sorts['Arcane Power'] = 15;
$long_sorts['Heroism'] = 45;

$long_sorts['Celerity'] = 10;
$long_sorts['Mark of the Firelord'] = 15;
$long_sorts['Battle Magic'] = 15;
$long_sorts['Dire Magic'] = 20;
$long_sorts['Volcanic Destruction'] = 12; 
$long_sorts['Soul Power'] = 20;
$long_sorts['Revelation'] = 20;

$long_sorts['Icy Veins'] = 20;
$long_sorts['Mirror Image'] = 30;
$long_sorts['Living Bomb'] = 12;



/*************************************************
**
** SPELL CASTING TIME TABLE
**
*************************************************/
$cast = array();

$cast['Arcane Missiles'] = .5;
$cast['Arcane Blast'] = 2;
$cast['Arcane Barrage'] = 1.5;
$cast['Arcane Explosion'] = 1.5;
$cast['Fire Blast'] = 1.5;
$cast['Fireball'] = 2.5;
$cast['Pyroblast'] = 1.5;
$cast['Pyroblast!'] = 1.5;
$cast['Ice Lance'] = 1.5;
$cast['Blink'] = 1.5;
$cast['Living Bomb'] = 1.5;
$cast['Mirror Image'] = 1.5;
$cast['Blast Wave'] = 1.5;
$cast['Flamestrike'] = 1.5;
$cast['Flame Orb'] = 1.5;
$cast['Mage Ward'] = 1.5;
$cast['Slow Fall'] = 1.5;
$cast['Time Warp'] = 1.5;


/*************************************************
**
** LOCALISATION TABLE (ENGLISH)
**
*************************************************/
$lang_en = array();

$lang_en['Innervate'] = 'Innervate';
$lang_en['Hymn of Hope'] = 'Hymn of Hope';
$lang_en['Clearcasting'] = 'Clearcasting';
$lang_en['Arcane Power'] = 'Arcane Power';
$lang_en['Presence of Mind'] = 'Presence of Mind';

$lang_en['Celerity'] = 'Celerity';
$lang_en['Mark of the Firelord'] = 'Mark of the Firelord';
$lang_en['Battle Magic'] = 'Battle Magic';
$lang_en['Dire Magic'] = 'Dire Magic';
$lang_en['Volcanic Destruction'] = 'Volcanic Destruction'; 
$lang_en['Soul Power'] = 'Soul Power';
$lang_en['Revelation'] = 'Revelation';

$lang_en['Icy Veins'] = 'Icy Veins';
$lang_en['Mirror Image'] = 'Mirror Image';
$lang_en['Replenish Mana'] = 'Replenish Mana';
$lang_en['Evocation'] = 'Evocation';
$lang_en['Blink'] = 'Blink';
$lang_en['Ice Block'] = 'Ice Block';
$lang_en['Arcane Barrage'] = 'Arcane Barrage';
$lang_en['Arcane Blast'] = 'Arcane Blast';
$lang_en['Arcane Missiles'] = 'Arcane Missiles';
$lang_en['Arcane Explosion'] = 'Arcane Explosion';
$lang_en['Hot Streak'] = 'Hot Streak';
$lang_en['Living Bomb'] = 'Living Bomb';
$lang_en['Fireball'] = 'Fireball';
$lang_en['Pyroblast'] = 'Pyroblast';
$lang_en['Pyroblast!'] = 'Pyroblast!';
$lang_en['Polymorph'] = 'Polymorph';
$lang_en['Fire Blast'] = 'Fire Blast';
$lang_en['Scorch'] = 'Scorch';
$lang_en['Dragon Breath'] = 'Dragon Breath';
$lang_en['Flamestrike'] = 'Flamestrike';
$lang_en['Blast Wave'] = 'Blast Wave';
$lang_en['Mage Armor'] = 'Mage Armor';
$lang_en['Flame Orb'] = 'Flame Orb';
$lang_en['Heroism'] = 'Heroism';
$lang_en['Bloodlust'] = 'Bloodlust';
$lang_en['Time Warp'] = 'Time Warp';
$lang_en['Ancient Hysteria'] = 'Ancient Hysteria';
$lang_en['Mage Ward'] = 'Mage Ward';
$lang_en['Slow Fall'] = 'Slow Fall';

//--------------------------------------------------
$lang_en['Innervation'] = 'Innervate';
$lang_en['Hymne � l\'espoir'] = 'Hymn of Hope';
$lang_en['Id�es claires'] = 'Clearcasting';
$lang_en['Pouvoir des Arcanes'] = 'Arcane Power';
$lang_en['Pr�sence spirituelle'] = 'Presence of Mind';

$lang_en['V�locit�'] = 'Celerity';
$lang_en['Marque du seigneur de Feu'] = 'Mark of the Firelord';
$lang_en['Magie du combat'] = 'Battle Magic';
$lang_en['Magie redoutable'] = 'Dire Magic';
$lang_en['Destruction volcanique'] = 'Volcanic Destruction'; 
$lang_en["Puissance de l'�me"] = 'Soul Power';
$lang_en['R�v�lation'] = 'Revelation';

$lang_en['Veines glaciales'] = 'Icy Veins';
$lang_en['Image miroir'] = 'Mirror Image';
$lang_en['R�cup�ration du mana'] = 'Replenish Mana';
$lang_en['Bombe vivante'] = 'Living Bomb';
$lang_en['Boule de feu'] = 'Fireball';
$lang_en['Transfert'] = 'Blink';
$lang_en['Bloc de glace'] = 'Ice Block';
$lang_en['Barrage des Arcanes'] = 'Arcane Barrage';
$lang_en['D�flagration des Arcanes'] = 'Arcane Blast';
$lang_en['Projectiles des Arcanes'] = 'Arcane Missiles';
$lang_en['Explosion des Arcanes'] = 'Arcane Explosion';
$lang_en['Chaleur continue'] = 'Hot Streak';
$lang_en['Explosion pyrotechnique'] = 'Pyroblast';
$lang_en['Explosion pyrotechnique!'] = 'Pyroblast!';
$lang_en['M�tamorphose'] = 'Polymorph';
$lang_en['Ecaille des destin�es'] = 'Scale of Fates';
$lang_en['Trait de feu'] = 'Fire Blast';
$lang_en['Br�lure'] = 'Scorch';
$lang_en['Souffle du dragon'] = 'Dragon Breath';
$lang_en['Choc de flammes'] = 'Flamestrike';
$lang_en['Vague explosive'] = 'Blast Wave';
$lang_en['Armure du mage'] = 'Mage Armor';
$lang_en['Orbe enflamm�'] = 'Flame Orb';
$lang_en['H�ro�sme'] = 'Heroism';
$lang_en['Furie sanguinaire'] = 'Bloodlust';
$lang_en['Distorsion temporelle'] = 'Time Warp';
$lang_en['Hyst�rie ancienne'] = 'Ancient Hysteria';
$lang_en['Gardien du mage'] = 'Mage Ward';
$lang_en['Chute lente'] = 'Slow Fall';



/*************************************************
**
** LOCALISATION TABLE (FRENCH)
**
*************************************************/
$lang_fr = array();

$lang_fr['Innervate'] = 'Innervation';
$lang_fr['Hymn of Hope'] = 'Hymne � l\'espoir';
$lang_fr['Clearcasting'] = 'Id�es claires';
$lang_fr['Arcane Power'] = 'Pouvoir des Arcanes';
$lang_fr['Presence of Mind'] = 'Pr�sence spirituelle';

$lang_fr['Celerity'] = 'V�locit�';
$lang_fr['Mark of the Firelord'] = 'Marque du seigneur de Feu';
$lang_fr['Battle Magic'] = 'Magie du combat';
$lang_fr['Dire Magic'] = 'Magie redoutable';
$lang_fr['Volcanic Destruction'] = 'Destruction volcanique'; 
$lang_fr['Soul Power'] = "Puissance de l'�me";
$lang_fr['Revelation'] = 'R�v�lation';

$lang_fr['Icy Veins'] = 'Veines glaciales';
$lang_fr['Mirror Image'] = 'Image miroir';
$lang_fr['Replenish Mana'] = 'R�cup�ration du mana';
$lang_fr['Evocation'] = 'Evocation';
$lang_fr['Living Bomb'] = 'Bombe vivante';
$lang_fr['Blink'] = 'Transfert';
$lang_fr['Ice Block'] = 'Bloc de glace';
$lang_fr['Arcane Barrage'] = 'Barrage des Arcanes';
$lang_fr['Arcane Blast'] = 'D�flagration des Arcanes';
$lang_fr['Arcane Missiles'] = 'Projectiles des Arcanes';
$lang_fr['Arcane Explosion'] = 'Explosion des Arcanes';
$lang_fr['Fireball'] = 'Boule de feu';
$lang_fr['Hot Streak'] = 'Chaleur continue';
$lang_fr['Pyroblast'] = 'Explosion pyrotechnique';
$lang_fr['Pyroblast!'] = 'Explosion pyrotechnique!';
$lang_fr['Polymorph'] = 'M�tamorphose';
$lang_fr['Scale of Fates'] = 'Ecaille des destin�es';
$lang_fr['Fire Blast'] = 'Trait de feu';
$lang_fr['Scorch'] = 'Br�lure';
$lang_fr['Dragon Breath'] = 'Souffle du dragon';
$lang_fr['Flamestrike'] = 'Choc de flammes';
$lang_fr['Blast Wave'] = 'Vague explosive';
$lang_fr['Mage Armor'] = 'Armure du mage';
$lang_fr['Flame Orb'] = 'Orbe enflamm�';
$lang_fr['Heroism'] = 'H�ro�sme';
$lang_fr['Bloodlust'] = 'Furie sanguinaire';
$lang_fr['Time Warp'] = 'Distorsion temporelle';
$lang_fr['Ancient Hysteria'] = 'Hyst�rie ancienne';
$lang_fr['Mage Ward'] = 'Gardien du mage';
$lang_fr['Slow Fall'] = 'Chute lente';


?>