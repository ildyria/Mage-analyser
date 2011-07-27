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

	var arcane1 = '((sourceName = "'+name+'" and (((spellId = 55342 or spellId = 67684 or spellId = 71579 or spellId = 12042 or spellId = 12536)  and fullType = SPELL_AURA_APPLIED) or(spellId != 89091 and fullType = SPELL_DAMAGE)))or(targetName = "'+name+'" and (spellId = 2825 or spellId = 32182))) or (targetName = "'+name+'" and ((spellId = 12051 and fullType = SPELL_PERIODIC_ENERGIZE) or spellId = 5405 or spellId = 29166))';
//	var arcane2 = 'targetName = "'+name+'" and (spellId = 6117 or spellId = 57669 or spellId = 12051 or spellId = 29166 or fullType = SPELL_ENERGIZE)';

	if ( spe == 'feu') {
		document.getElementById('request').value = feu;
		document.getElementById('txtarcane').setAttribute("style","display: none;");
		document.getElementById('txtfire').setAttribute("style","");
	}
	else
	{
		document.getElementById('request').value = arcane1;
		document.getElementById('txtarcane').setAttribute("style","");
		document.getElementById('txtfire').setAttribute("style","display: none;");
	}
	document.getElementById('divrequest').setAttribute("style","display: block; padding-top: 20px;");
	document.getElementById('logtrunk').setAttribute("style","display: none;");

}
