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

	var feu = '[{"eventTypes": [6], "sourceNames": ["';
	feu += name;
	feu += '"]}, {"eventTypes": [5], "actorNames": ["';
	feu += name;
	feu += '"]}, {"actorNames": ["';
	feu += name;
	feu += '"], "spellIds": [32182]}, {"spellNames": ["Combustion"], "actorNames": ["';
	feu += name;
	feu += '"]}, {"actorNames": ["';
	feu += name;
	feu += '"], "spellIds": [2825]}, {"spellNames": ["Hot Streak"], "actorNames": ["';
	feu += name;
	feu += '"]}, {"actorNames": ["';
	feu += name;
	feu += '"], "spellNames": ["Chaleur continue"]}]';

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
		document.getElementById('txtarcane').setAttribute("style","display: none;");
		document.getElementById('txtfire').setAttribute("style","");
	}
	else
	{
		document.getElementById('request').value = arcane;
		document.getElementById('txtarcane').setAttribute("style","");
		document.getElementById('txtfire').setAttribute("style","display: none;");
	}
	document.getElementById('divrequest').setAttribute("style","display: block; padding-top: 20px;");
	document.getElementById('logtrunk').setAttribute("style","display: none;");

}
