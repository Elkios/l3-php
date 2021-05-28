<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * 1.
 * Calculer de la moyenne
*/

echo "--- [ Question 1 ] --- <br><br>";

$note_maths = 15;
$note_francais = 12;
$note_histoire_geo = 9;
$moyenne = ($note_maths + $note_francais + $note_histoire_geo) / 3;
echo "La moyenne est de " .$moyenne. " / 20. <br>";


/**
 * 2.
 * Calculer le prix ttc
 */

echo "<br>--- [ Question 2 ] --- <br><br>";

$prix_ht = 50;
$tva = 20;
$prix_ttc = $prix_ht + ($prix_ht * ($tva / 100));
echo "Le prix TTC du produit est de " . $prix_ttc . " €.<br>";


/**
 * 3.
 * Déclarer une variable $test qui contient la valeur 42. En utilisant la fonction var_dump(),
 * faire en sorte que le type de la variable $test soit string et que la valeur soit bien de 42.
*/

echo "<br>--- [ Question 3 ] --- <br><br>";

$test = "42";
var_dump($test);


/**
 * 4.
 * Déclarer une variable $sexe qui contient une chaîne de caractères.
 * Créer une condition qui affiche un message différent en fonction de la valeur de la variable.
 */

echo "<br>--- [ Question 4 ] --- <br><br>";

$sexe = "F";
echo "Il s'agit " . ($sexe == "H" ? "d'une homme" : "d'une femme") . " !<br>";


/**
 * 5.
 * Déclarer une variable $heure qui contient la valeur de type integer de votre choix comprise entre 0 et 24.
 * Créer une condition qui affiche un message si l'heure est le matin, l'après-midi ou la nuit.
 */

echo "<br>--- [ Question 5 ] --- <br><br>";

$heure = 12;
if($heure >= 6 && $heure < 12) echo "l'heure est le matin<br>";
else if($heure >= 12 && $heure < 19) echo "l'heure est l'après-midi<br>";
else echo "l'heure est la nuit<br>";


/**
 * 6.
 * En utilisant la boucle for, afficher la table de multiplication du chiffre 5.
 */

echo "<br>--- [ Question 6 ] --- <br><br>";

for ($i = 0; $i <= 10; $i++) {
    echo "5 x " . $i . " = " . $i * 5 . "<br>";
}


/**
 * 7.
 * Déclarer une variable avec le nom de votre choix et avec la valeur 0.
 * Tant que cette variable n'atteint pas 20, il faut :
 *     . l'afficher ;
 *     . incrémenter sa valeur de 2 ;
 * Si la valeur de la variable est égale à 10, la mettre en valeur avec la balise HTML appropriée.
 */

echo "<br>--- [ Question 7 ] --- <br><br>";

$x = 0;
while ($x != 20) {
    echo $x == 10 ? " <strong>" . $x . "</strong>" : " " . $x . " ";
    $x+=2;
}

/**
 * 8.
 * Déclarer une variable de type array qui stocke les informations suivantes :
 *
 *   . France : Paris
 *   . Allemagne : Berlin
 *   . Italie : Rome
 *
 * Afficher les valeurs de tous les éléments du tableau en utilisant la boucle foreach.
 */

echo "<br><br>--- [ Question 8 ] --- <br><br>";

$pays_capitale = array(
    'France' => "Paris",
    'Allemagne' => "Berlin",
    'Italie' => "Rome"
);
echo "<strong>Pays -> Capitale</strong><br>";
foreach ($pays_capitale as $pays => $capitale) {
    echo $pays . " -> " . $capitale . "<br>";
}




/**
 * 9.
 * En utilisant le tableau ci-dessous, afficher seulement les pays qui ont une population supérieure ou égale à 20 millions d'habitants.
 *
 */
echo "<br>--- [ Question 9 ] --- <br><br>";

$pays_population = array(
    'France' => 67595000,
    'Suede' => 9998000,
    'Suisse' => 8417000,
    'Kosovo' => 1820631,
    'Malte' => 434403,
    'Mexique' => 122273500,
    'Allemagne' => 82800000,
);

echo "<strong>Pays avec une population >= 20M d'habitants</strong><br>";

foreach ($pays_population as $pays => $pop) {
    if($pop >= 20000000) echo $pays . " -> " . $pop . " habitants<br>";
}

/**
 * 10.
 * En utilisant le tableau ci-dessous afficher la prase suivante pour chaque pays:
 *  #PAYS# : il y a #NOMBRE_HABITANT# d'habitants
 *
 * utiliser les functions de tableau exemple : array_map()
 */

echo "<br>--- [ Question 10 ] --- <br><br>";

$pays_population = array(
    'France' => 67595000,
    'Suede' => 9998000,
    'Suisse' => 8417000,
    'Kosovo' => 1820631,
    'Malte' => 434403,
    'Mexique' => 122273500,
    'Allemagne' => 82800000,
);

$map =  array_map(function ($pays, $pop) {
    return $pays . " : il y a " . $pop . " d'habitants<br>";
}, array_keys($pays_population), $pays_population);

foreach ($map as $value) echo $value;

/**
 * 11.
 * En utilisant le tableau de keys ci-dessous, reordonner le pour le ranger par taille de longueur de chaine de caractere
 *
 */

echo "<br>--- [ Question 11 ] --- <br><br>";

$keys = array(
    "aze",
    "poi45p",
    "p8333335p",
    "x24p"
);

function cmp($a, $b) {
    if (strlen($a) == strlen($b)) return 0;
    return (strlen($a) < strlen($b)) ? -1 : 1;
}
usort($keys, "cmp");
var_dump($keys);

/* résultat une fois ordonné :
array(4) {
    [0]=>
    string(3) "aze"
    [1]=>
    string(4) "x24p"
    [2]=>
    string(6) "poi45p"
    [3]=>
    string(9) "p8333335p"
}*/