// JavaScript Document
/*
function select_switch(status)
{
	var input = document.getElementsByTagName('input');
	var max = input.length - 1;
	for( i = 0; i < max ; i++ )
	{
		input[i].checked = status;
	}
}
*/

function edit_request()
{
	var name = document.getElementById('name').value;
	
	
	var spe = document.getElementById('spe').options[document.getElementById('spe').selectedIndex].value;

	var feu = '((sourceName = "'+name+'" and (((';
	feu += 'spellId = 55342 or '; // Mirror Images
	feu += 'spellId = 91173 or '; // 379 Shard of Woe = Celerity
	feu += 'spellId = 97007 or '; // 378 Rune of Zeth = Mark of the Firelord
	feu += 'spellId = 91047 or '; // Tol Barad +1926 spell = Battle Magic
	feu += 'spellId = 92318 or '; // 372 Bell of Enraging Resonance H = Dire Magic
	feu += 'spellId = 91007 or '; // 359 Bell of Enraging Resonance N = Dire Magic
	feu += 'spellId = 89091 or '; // 359 DM : Volcano = Volcanic Destruction
	feu += 'spellId = 91019 or '; // 359 Soul Casket +1926 spell = Soul Power
	feu += 'spellId = 92320 or '; // 372 THERALION H +2178 mastery = Revelation
	feu += 'spellId = 91024 or '; // 359 THERALION N +1926 mastery = Revelation
	feu += 'spellId = 543 or '; // MAGE WARD
	feu += 'spellId = 130 or '; // SLOW FALL
	feu += 'spellId = 1953 or '; // BLINK
	feu += 'spellId = 12536 or '; // CLEARCASTING
	feu += 'spellId = 44457 or '; // Living Bomb
	feu += 'spellId = 64343 or '; // Impact
	feu += 'spellId = 48108 or '; // Hot Streak
	feu += 'spellId = 87023'; // Cauterize
	feu += ') and (fullType = SPELL_AURA_APPLIED or fullType = SPELL_AURA_REFRESH)) or ';
	feu += '(spellId != 89091 and spellId != 34913 and fullType = SPELL_DAMAGE))) or '; // HIT DAMAGES BUT NO VOLCANO DAMAGES AND NO MOLTEN ARMOR  or fullType = SPELL_PERIODIC_DAMAGE
	feu += '(targetName = "'+name+'" and (';
	feu += 'spellId = 2825 or spellId = 80353 or spellId = 90355 or spellId = 32182))) or '; // TIME WARP, HEROISM, BLOOD LUST, Ancient Hysteria
	feu += '(targetName = "'+name+'" and ((spellId = 12051 and fullType = SPELL_PERIODIC_ENERGIZE) or spellId = 5405 or spellId = 29166)) or '; // MANA GAINS : Gem, Inervate, Evocation
	feu += '(targetName = "'+name+'" and spellID = 83582)'; // Pyromaniac


	var arcane = '((sourceName = "'+name+'" and (((';
	arcane += 'spellId = 55342 or '; // Mirror Images
	arcane += 'spellId = 91173 or '; // 379 Shard of Woe = Celerity
	arcane += 'spellId = 97007 or '; // 378 Rune of Zeth = Mark of the Firelord
	arcane += 'spellId = 91047 or '; // Tol Barad +1926 spell = Battle Magic
	arcane += 'spellId = 92318 or '; // 372 Bell of Enraging Resonance H = Dire Magic
	arcane += 'spellId = 91007 or '; // 359 Bell of Enraging Resonance N = Dire Magic
	arcane += 'spellId = 89091 or '; // 359 DM : Volcano = Volcanic Destruction
	arcane += 'spellId = 91019 or '; // 359 Soul Casket +1926 spell = Soul Power
	arcane += 'spellId = 92320 or '; // 372 THERALION H +2178 mastery = Revelation
	arcane += 'spellId = 91024 or '; // 359 THERALION N +1926 mastery = Revelation
	arcane += 'spellId = 12043 or '; // PoM
	arcane += 'spellId = 543 or '; // MAGE WARD
	arcane += 'spellId = 130 or '; // SLOW FALL
	arcane += 'spellId = 1953 or '; // BLINK
	arcane += 'spellId = 12042 or '; // ARCANE POWER
	arcane += 'spellId = 12536'; // CLEARCASTING
	arcane += ') and fullType = SPELL_AURA_APPLIED) or ';
	arcane += '(spellId != 89091 and fullType = SPELL_DAMAGE))) or '; // HIT DAMAGES BUT NO VOLCANO DAMAGES
	arcane += '(targetName = "'+name+'" and (';
	arcane += 'spellId = 2825 or spellId = 80353 or spellId = 90355 or spellId = 32182))) or '; // TIME WARP, HEROISM, BLOOD LUST, Ancient Hysteria
	arcane += '(targetName = "'+name+'" and ((spellId = 12051 and fullType = SPELL_PERIODIC_ENERGIZE) or spellId = 5405 or spellId = 29166))'; // MANA GAINS : Gem, Inervate, Evocation
	// NEED TO ADD HYMNE OF HOPE

	if ( spe == 'feu') {
		document.getElementById('request').value = feu;
		document.getElementById('txtlog').setAttribute("style","");
	}
	else
	{
		document.getElementById('request').value = arcane;
		document.getElementById('txtlog').setAttribute("style","");
	}
	document.getElementById('divrequest').setAttribute("style","display: block; padding-top: 20px;");
	document.getElementById('logtrunk').setAttribute("style","display: none;");

}
