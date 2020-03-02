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
$uploadOK[1] = '';

echo '<section class="bcForm" id=>',
'<h1>Ajouter une Exposition Virtuelle</h1>';

$message = '';
$messageSupprime ='';

if (isset($_POST["deleteExpo"]))
{
    deleteExpo();
    $messageSupprime .= '<p>L\'exposition à été supprimé</p>';
}
if (isset($_POST["addExpo"]))
{
    deleteExpo();
    $archiveName = $_FILES["fileZIP"]["tmp_name"];
    $path = '../images/ExpoVirtuelle';
    if ($_FILES["fileZIP"]["size"] > 0)
    {
        $zip = new ZipArchive;

        $res=$zip->open($archiveName);

        if ($res === TRUE)
        {
            $zip->extractTo($path);
            $zip->close();
            $message = '<p>Fichier $archiveName extrait avec succès dans $path</p>';
        } else {
            $message = '<p>Echec de l\'extraction du fichier $archiveName</p>';
        }
    }

    $fileName = $_FILES["fileCSV"]["tmp_name"];
    if ($_FILES["fileCSV"]["size"] > 0)
    {
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE)
        {
            $sql = "INSERT INTO `ExpoVirtuelle`(`Titre`, `Rang`, `Date`, `Technique`, `Hauteur`, `Largeur`, `Collection`, `Crédit_Photographique`, `Remarques`) 
                    VALUES ('$column[0]','$column[1]','$column[2]','$column[3]','$column[4]','$column[5]','$column[6]','$column[7]','$column[8]')";
            $result = mysqli_query($bd, $sql);
            if (! empty($result))
            {
                $message .= '<p>Les Données sont importées dans la base de données</p>';
            }
            else
            {
                $message .= '<p>Problème lors de l\'importation de données CSV</p>';
            }
        }
    }
}

echo    '<form method="POST" enctype="multipart/form-data">',
            '<table>',
                at_html_table_line('<p>Archive à upload :</p>', '<input type="file" name="fileZIP" accept=".zip">'),
                at_html_table_line('<p>Fichier CSV à upload :</p>', '<input type="file" name="fileCSV" accept=".csv">'),
                at_html_table_line(at_html_form_input('submit', 'addExpo', 'Ajouter'),at_html_form_input('submit', 'return', 'Annuler')),
                $message,
            '</table>',
        '</form>';

echo    '<h1>Supprimer une Exposition Virtuelle</h1>',
        '<form method="POST" enctype="multipart/form-data">',
            '<table>',
            at_html_table_line("", at_html_form_input('submit', 'deleteExpo', 'Supprimer')),
            $messageSupprime,
            '</table>',
        '</form>';

echo     '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();