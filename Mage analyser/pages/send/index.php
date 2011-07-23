<?php

DEFINED('MA') or die ('HACKING ATTEMPT');

echo '<div id=\'main\'>'."\n";
echo '<form action="index.php" method="post">'."\n";
echo '<table>'."\n";
echo "\t".'<tr>'."\n";
echo "\t"."\t".'<td>'."\n";
echo "\t"."\t"."\t".'<textarea name="log1" cols="70" rows="35" onfocus="if (this.value==\'Copiez/collez votre log d&eacute;g&acirc;ts ici.\') {this.value=\'\'}" onblur="if (this.value==\'\') {this.value=\'Copiez/collez votre log d&eacute;g&acirc;ts ici.\'}">Copiez/collez votre log d&eacute;g&acirc;ts ici.</textarea><br />'."\n";
echo "\t"."\t".'</td>'."\n";
echo "\t"."\t".'<td>'."\n";
echo "\t"."\t"."\t".'<textarea name="log2" cols="70" rows="35" onfocus="if (this.value==\'Copiez/collez votre log mana ici.\') {this.value=\'\'}" onblur="if (this.value==\'\') {this.value=\'Copiez/collez votre log mana ici.\'}">Copiez/collez votre log mana ici.</textarea><br />'."\n";
echo "\t"."\t".'</td>'."\n";
echo "\t"."\t".'<td class="c0" style="font-weight: bold; padding-left: 10px;">'."\n";
echo "\t"."\t"."\t".'<div style="text-align: justify">Bonjour et bienvenue sur Mage Analyser!</div>'."\n";
echo "\t"."\t"."\t".'<div style="font-size: 14px; text-decoration: underline; text-align: center; padding-top:25px; padding-bottom:5px;">Options</div>'."\n";
echo "\t"."\t"."\t"; //.'Nom du joueur : '
echo '<input type=\'text\' size=\'50\' name=\'name\' id=\'name\' value=\'Entrez votre nom de personnage ici.\' onfocus="if (this.value==\'Entrez votre nom de personnage ici.\') {this.value=\'\'}" /> <span class="c1">*</span><br /><br />'."\n";
echo "\t"."\t"."\t".'Score de hate <span class="c17">*</span> : <input type=\'text\' size=\'4\' name=\'hast\' value=\'0\' onfocus="if (this.value==\'0\') {this.value=\'\'}" /><br />'."\n";
echo "\t"."\t"."\t".'Intel : <span class="c17">*</span> : <input type=\'text\' size=\'4\' name=\'intel\' value=\'0\' onfocus="if (this.value==\'0\') {this.value=\'\'}" /><br />'."\n";
echo "\t"."\t"."\t".'Afficher les gains de mana : <select name="affmana"><option value="no">Non</option><option value="yes">Oui</option></select><br />'."\n";
echo "\t"."\t"."\t".'Langue du rapport <span class="c17">*</span> : <select name="lang"><option value="en">Anglais</option><option value="fr">Fran&ccedil;ais</option></select><br />'."\n";
echo "\t"."\t"."\t".'Sp&eacute; <span class="c17">*</span> <span class="c1">*</span> : <select name="spe" id="spe"><option value="arc">Arcane</option>';
//echo '<option value="feu">Feu</option>';
echo '</select> (analyse feu désactiv&eacute;e pour le moment)<br /><br />'."\n";
echo "\t"."\t"."\t".'<input type="button" value="Requete World of Log" onclick="edit_request()" /><br />'."\n";
echo "\t"."\t"."\t".'<div id="divrequest" style="display:none;">'."\n";
echo "\t"."\t"."\t"."\t".'Requetes World of Log :<br />'."\n";
echo "\t"."\t"."\t"."\t".'<input type=\'text\' size=\'50\' name=\'request\' value=\'\' id=\'request\' /><br />'."\n";
echo "\t"."\t"."\t"."\t".'<span id="txtfire">En feu, copiez collez la requete dans <i>Log Browser</i></span><br />'."\n";
echo "\t"."\t"."\t"."\t".'<input type=\'text\' size=\'50\' name=\'request2\' value=\'\' id=\'request2\' /><br />'."\n";
echo "\t"."\t"."\t"."\t".'<span id="txtarcane">En arcane, copiez collez la requete dans <i>Expression Editor</i></span><br />'."\n";
echo "\t"."\t"."\t".'</div>'."\n";
echo "\t"."\t"."\t".'<div style="padding-top: 50px;">'."\n";
echo "\t"."\t"."\t".'<span class="c17">*</span>&nbsp;: indispensable pour l\'analyse.<br />'."\n";
echo "\t"."\t"."\t".'<span class="c1">*</span>&nbsp;: indispensable pour cr&eacute;er la requ&ecirc;te WoL.'."\n";
echo "\t"."\t"."\t".'</div>'."\n";
echo "\t"."\t"."\t".'<div style="padding-top: 50px;" id="logtrunk">'."\n";
echo "\t"."\t"."\t".'Log de Trunkot sur Saurcroc : <br />'."\n";
echo "\t"."\t"."\t".'<a href="dmg.txt">log de d&eacute;g&acirc;ts</a><br />'."\n";
echo "\t"."\t"."\t".'<a href="mana.txt">log de mana</a><br />'."\n";
echo "\t"."\t"."\t".'Langue : fran&ccedil;ais, spé : arcane, mana : 40000, hate : 895<br />'."\n"; 
echo "\t"."\t"."\t".'</div>'."\n";
echo "\t"."\t".'</td>'."\n";
echo "\t".'</tr>'."\n";
echo "\t".'<tr>'."\n";
echo "\t"."\t".'<td style="text-align: center; padding-top: 20px;" colspan="3">'."\n";
echo "\t"."\t"."\t".'<input type="submit" name="submit" value="Analyser" style="background-color: #000000; color: #0099CC; border: solid 3px #0099CC; font-size:18px; font-weight: bold; padding:10px; marging:15px;" />'."\n";
echo "\t"."\t".'</td>'."\n";
echo "\t".'</tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";

?> 