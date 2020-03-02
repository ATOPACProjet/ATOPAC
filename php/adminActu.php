<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

if (!isset($_SESSION['login'])) {
	header("location:connexion.php");
}

if ($_SESSION['login'] != 'admin') {
	header("location:espaceMembre.php");
}


error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Admin', '../css/style.css', true);

echo at_aff_header('admin');

$bd=at_bd_connect();

$uploadOK = [0, ''];

echo '<section class="bcForm">';

if (isset($_POST['addingActu']))
{
    if(isset($_FILES['fileToUpload']))
    {
        $uploadOK = at_upload_jpg('../images/Actualites/');
    }
    $titre = mysqli_escape_string($bd, $_POST['titre']);
    $descriptifFR = mysqli_escape_string($bd, $_POST['descriptifFR']);
    $descriptifEN = mysqli_escape_string($bd, $_POST['descriptifEN']);
    ($uploadOK[0] != 1) ? $src = '' : $src = mysqli_escape_string($bd, $uploadOK[2]);
    $sql = "INSERT INTO `Actualites`(`titre`, `descriptif_fr`, `descriptif_en`, `src`) VALUES ('{$titre}', '{$descriptifFR}', '{$descriptifEN}', '{$src}')";
    mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

    if ($uploadOK[0] == 1)
    {
        header('location:actualites.php');
    }

}

if(isset($_POST['deletingActu']))
{
    $sql = "DELETE FROM Actualites WHERE titre = '{$_POST['titre']}'";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

    if ($_POST['src'] != '')
    {
        $filename = '../images/Actualites/' . $_POST['src'];
        unlink($filename);
        header('location:actualites.php');
        exit();
    }
}

if(isset($_POST['return']))
{
    header('location:actualites.php');
}


if(isset($_POST['addActu']) || isset($_POST['addingActu']))
{
echo    '<h1 id="handlingActu">Gestion d\'actualités</h1>',
        '<form method="POST" action="" enctype="multipart/form-data" id="formActu">',
            '<textarea name="titre" cols="50" rows="5" required placeholder="Titre de l\'actualité"></textarea>',
            '<textarea name="descriptifFR" cols="50" rows="5" required placeholder="Descriptif en français"></textarea>',
            '<textarea name="descriptifEN" cols="50" rows="5" required placeholder="TDescriptif en anglais"></textarea>',
            '<table>',
                at_html_table_line('<p>Affiche :</p>', at_html_form_input('file', 'fileToUpload', '')),
                at_html_table_line(at_html_form_input('submit', 'addingActu', 'Ajouter une Actualité'),at_html_form_input('submit', 'return', 'Annuler')),
                ($uploadOK[1] == '') ? '' : '<tr>', $uploadOK[1] , '</tr>',
            '</table>',
        '</form>';
}

if(isset($_POST['deleteActu']))
{
    echo '<p>Êtes-vous sûr(e) de vouloir supprimer cette actualité (',$_POST['titre'],')?</p>',
         '<form method="POST">',
            at_html_form_input('hidden', 'titre', "{$_POST['titre']}",false,true),
            at_html_form_input('hidden', 'src', "{$_POST['src']}"),
            '<table>',
                at_html_table_line(at_html_form_input('submit', 'deletingActu', 'Oui, supprimer'),at_html_form_input('submit', 'return', 'Annuler')),
            '</table>',
        '</form>';
}

if (count($_POST) == 0)
{
    header('location:actualites.php');
    exit();
}

echo	'</section>';
at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
