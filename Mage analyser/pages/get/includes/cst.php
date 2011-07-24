<?php

DEFINED('MA') or die('HACKING ATTEMPT!');

define('MANA_BASE', 17418);
define('CST_HATE', 12806);



/*************************************************
**
** COOLDOWN TABLE
**
*************************************************/
$cd_sorts = array();

$cd_sorts['Arcane Power'] = 90;
$cd_sorts['Presence of Mind'] = 90;
$cd_sorts['Hospitality'] = 120;
$cd_sorts['Elusive Power'] = 120;
$cd_sorts['Scale of Fates'] = 120;
$cd_sorts['Icy Veins'] = 144;
$cd_sorts['Mirror Image'] = 180;
$cd_sorts['Replenish Mana'] = 120;
$cd_sorts['Evocation'] = 120;
$cd_sorts['Flame Orb'] = 60;



/*************************************************
**
** MANA COST TABLE
**
*************************************************/
$mana_sorts = array();

$mana_sorts['Arcane Power'] = 0;
$mana_sorts['Mirror Image'] = floor(0.1*MANA_BASE);
$mana_sorts['Arcane Barrage'] = floor(0.11*MANA_BASE);
$mana_sorts['Arcane Blast'] = floor(0.05*MANA_BASE);
$mana_sorts['Arcane Missiles'] = 0;
$mana_sorts['Arcane Explosion'] = 0;//floor(0.15*MANA_BASE);
$mana_sorts['Living Bomb'] = floor(0.17*MANA_BASE);
$mana_sorts['Fireball'] = floor(0.09*MANA_BASE);
$mana_sorts['Fire Blast'] = floor(0.21*MANA_BASE);
$mana_sorts['Scorch'] = floor(0.08*MANA_BASE);
$mana_sorts['Pyroblast'] = floor(0.17*MANA_BASE);
$mana_sorts['Dragon Breath'] = floor(0.07*MANA_BASE);
$mana_sorts['Flamestrike'] = floor(0.3*MANA_BASE);
$mana_sorts['Blast Wave'] = floor(0.07*MANA_BASE);
$mana_sorts['Flame Orb'] = floor(0.06*MANA_BASE);



/*************************************************
**
** SPELL DURATION TABLE
**
*************************************************/
$long = array();

$long_sorts['Arcane Power'] = 15;
$long_sorts['Heroism'] = 45;
$long_sorts['Hospitality'] = 20;
$long_sorts['Elusive Power'] = 20;
$long_sorts['Scale of Fates'] = 20;
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
$cast['Fire Blast'] = 1.5;
$cast['Fireball'] = 2.5;
$cast['Pyroblast'] = 1.5;
$cast['Pyroblast!'] = 1.5;
$cast['Ice Lance'] = 1.5;
$cast['Living Bomb'] = 1.5;
$cast['Mirror Image'] = 1.5;
$cast['Blast Wave'] = 1.5;
$cast['Flamestrike'] = 1.5;
$cast['Flame Orb'] = 1.5;



/*************************************************
**
** LOCALISATION TABLE (ENGLISH)
**
*************************************************/
$lang_en = array();

$lang_en['Innervate'] = 'Innervate';
$lang_en['Hymn of Hope'] = 'Hymn of Hope';
$lang_en['Clearcasting'] = 'Clearcasting';
$lang_en['Heroism'] = 'Heroism';
$lang_en['Arcane Power'] = 'Arcane Power';
$lang_en['Presence of Mind'] = 'Presence of Mind';
$lang_en['Hospitality'] = 'Hospitality';
$lang_en['Scale of Fates'] = 'Scale of Fates';
$lang_en['Elusive Power'] = 'Elusive Power';
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
$lang_en['Orbe enflammé'] = 'Flame Orb';
//--------------------------------------------------
$lang_en['Innervation'] = 'Innervate';
$lang_en['Hymne à l\'espoir'] = 'Hymn of Hope';
$lang_en['Idées claires'] = 'Clearcasting';
$lang_en['Héroïsme'] = 'Heroism';
$lang_en['Pouvoir des Arcanes'] = 'Arcane Power';
$lang_en['Présence spirituelle'] = 'Presence of Mind';
$lang_en['Hospitalité'] = 'Hospitality';
$lang_en['Puissance insaisissable'] = 'Elusive Power';
$lang_en['Veines glaciales'] = 'Icy Veins';
$lang_en['Image miroir'] = 'Mirror Image';
$lang_en['Récupération du mana'] = 'Replenish Mana';
$lang_en['Bombe vivante'] = 'Living Bomb';
$lang_en['Boule de feu'] = 'Fireball';
$lang_en['Transfert'] = 'Blink';
$lang_en['Bloc de glace'] = 'Ice Block';
$lang_en['Barrage des Arcanes'] = 'Arcane Barrage';
$lang_en['Déflagration des Arcanes'] = 'Arcane Blast';
$lang_en['Projectiles des Arcanes'] = 'Arcane Missiles';
$lang_en['Explosion des Arcanes'] = 'Arcane Explosion';
$lang_en['Chaleur continue'] = 'Hot Streak';
$lang_en['Explosion pyrotechnique'] = 'Pyroblast';
$lang_en['Explosion pyrotechnique!'] = 'Pyroblast!';
$lang_en['Métamorphose'] = 'Polymorph';
$lang_en['Ecaille des destinées'] = 'Scale of Fates';
$lang_en['Trait de feu'] = 'Fire Blast';
$lang_en['Brûlure'] = 'Scorch';
$lang_en['Souffle du dragon'] = 'Dragon Breath';
$lang_en['Choc de flammes'] = 'Flamestrike';
$lang_en['Vague explosive'] = 'Blast Wave';
$lang_en['Armure du mage'] = 'Mage Armor';
$lang_en['Orbe enflammé'] = 'Flame Orb';



/*************************************************
**
** LOCALISATION TABLE (FRENCH)
**
*************************************************/
$lang_fr = array();

$lang_fr['Innervate'] = 'Innervation';
$lang_fr['Hymn of Hope'] = 'Hymne à l\'espoir';
$lang_fr['Clearcasting'] = 'Idées claires';
$lang_fr['Heroism'] = 'Héroïsme';
$lang_fr['Arcane Power'] = 'Pouvoir des Arcanes';
$lang_fr['Presence of Mind'] = 'Présence spirituelle';
$lang_fr['Hospitality'] = 'Hospitalité';
$lang_fr['Elusive Power'] = 'Puissance insaisissable';
$lang_fr['Icy Veins'] = 'Veines glaciales';
$lang_fr['Mirror Image'] = 'Image miroir';
$lang_fr['Replenish Mana'] = 'Récupération du mana';
$lang_fr['Evocation'] = 'Evocation';
$lang_fr['Living Bomb'] = 'Bombe vivante';
$lang_fr['Blink'] = 'Transfert';
$lang_fr['Ice Block'] = 'Bloc de glace';
$lang_fr['Arcane Barrage'] = 'Barrage des Arcanes';
$lang_fr['Arcane Blast'] = 'Déflagration des Arcanes';
$lang_fr['Arcane Missiles'] = 'Projectiles des Arcanes';
$lang_fr['Arcane Explosion'] = 'Explosion des Arcanes';
$lang_fr['Fireball'] = 'Boule de feu';
$lang_fr['Hot Streak'] = 'Chaleur continue';
$lang_fr['Pyroblast'] = 'Explosion pyrotechnique';
$lang_fr['Pyroblast!'] = 'Explosion pyrotechnique!';
$lang_fr['Polymorph'] = 'Métamorphose';
$lang_fr['Scale of Fates'] = 'Ecaille des destinées';
$lang_fr['Fire Blast'] = 'Trait de feu';
$lang_fr['Scorch'] = 'Brûlure';
$lang_fr['Dragon Breath'] = 'Souffle du dragon';
$lang_fr['Flamestrike'] = 'Choc de flammes';
$lang_fr['Blast Wave'] = 'Vague explosive';
$lang_fr['Mage Armor'] = 'Armure du mage';
$lang_fr['Flame Orb'] = 'Orbe enflammé';

?>