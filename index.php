<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'php/atopac_lib.php';

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Accueil', 'css/style.css', true);

echo at_aff_header('home');

$OeuvresAccueil = [random_int(1, 17), random_int(18, 25), random_int(26, 40), random_int(41, 58), random_int(59, 127)]; //Tableau qui choisit aléatoirement cinq œuvres, une dans chaque période.

$section = '<div id="slideshow">' .
                '<ul id="sContent">' .
                    '<li><img src="images/Oeuvres/' . $OeuvresAccueil[0] . '.jpg" alt="Peinture numéro : ' . $OeuvresAccueil[0] . '" /></li>' .
                    '<li><img src="images/Oeuvres/' . $OeuvresAccueil[1] . '.jpg" alt="Peinture numéro : ' . $OeuvresAccueil[1] . '" /></li>' .
                    '<li><img src="images/Oeuvres/' . $OeuvresAccueil[2] . '.jpg" alt="Peinture numéro : ' . $OeuvresAccueil[2] . '" /></li>' .
                    '<li><img src="images/Oeuvres/' . $OeuvresAccueil[3] . '.jpg" alt="Peinture numéro : ' . $OeuvresAccueil[3] . '" /></li>' .
                    '<li><img src="images/Oeuvres/' . $OeuvresAccueil[4] . '.jpg" alt="Peinture numéro : ' . $OeuvresAccueil[4] . '" /></li>' .
                '</ul>' .
            '</div>';

echo $section;

if (at_CurrentVirtualExpo())
{
    echo '<footer><h1>Une Exposition Virtuelle est disponible sur notre site, vous la tourverez <a href="php/expoVirtuelle.php">ici</a></h1></footer>';
}

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
