<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Actualites', '../css/style.css', true);

at_aff_header('actualites');

$isAdmin = false;
$section = '<section id="actualites">';
if (at_CurrentVirtualExpo())
{
    $section .= '<h1>Une Exposition Virtuelle est disponible sur notre site, vous la tourverez <a href="expoVirtuelle.php" style="text-decoration: underline; color: red;">ici</a></h1>';
}

if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin')
{
    $isAdmin = true;
    $section .= '<form method="POST" action="adminActu.php" id="addButton">' . at_html_form_input("submit", "addActu", "Ajouter") . '</form>';
}

$nbNewsPrint = 5;

$bd = at_bd_connect();

if(isset($_POST['moreNews']))
{
    $nbNewsPrint = $_POST['nbNewsPrint'] + 5;
}

if(isset($_POST['lessNews']))
{
    $nbNewsPrint = $_POST['nbNewsPrint'] - 5;
    if ($nbNewsPrint < 5) $nbNewsPrint = 5;
}

$sql = "SELECT * FROM Actualites ORDER BY titre DESC LIMIT {$nbNewsPrint}";
$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

while($T = mysqli_fetch_assoc($res))
{
    $form = '';
    if ($isAdmin)
    {
        $form .= '<form method="POST" action="adminActu.php"><table>' .
            at_html_form_input('hidden', 'titre', "{$T['titre']}") .
            at_html_form_input('hidden', 'src', "{$T['src']}") .
            at_html_form_input("submit", "deleteActu", "Supprimer") .
            '</table></form>';
    }
    $section .= at_html_actualite($T['titre'], $T['descriptif_fr'], $T['descriptif_en'], $T['src'], $form);
}

$sql = "SELECT COUNT(*) AS nbNews FROM Actualites";
$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

$T = mysqli_fetch_assoc($res);
if ($nbNewsPrint < $T['nbNews'])
{
    $section .= '<form method="POST" action=""><table>' .
                    at_html_form_input('hidden', 'nbNewsPrint', "{$nbNewsPrint}") .
                    at_html_form_input("submit", "moreNews", "Afficher plus") .
                '</table></form>';
}

if ($nbNewsPrint > 5)
{
    $section .= '<form method="POST" action=""><table>' .
        at_html_form_input('hidden', 'nbNewsPrint', "{$nbNewsPrint}") .
        at_html_form_input("submit", "lessNews", "Afficher moins") .
        '</table></form>';
}

if ($section == '<section id="actualites">')
{
    $section .= '<p>Pas d\'actualités pour l\'instant</p>';
}
$section .= '</section>';

echo $section;

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
