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
       '<h1>Gestion Vie de l\'association</h1>';


if (isset($_POST['addingAssoc'])){
	if(isset($_FILES['fileToUpload'])) $uploadOK = at_upload_jpg('../documents/association/',0,'default');
	if ($uploadOK[0] == 1) {
		header('location:association.php');
    	exit();
    }
}

if(isset($_POST['deletingAssoc']))
{
    $filename = '../documents/association/' . $_POST['name'];
    unlink($filename);

    header('location:association.php');
    exit();
}

if(isset($_POST['return']))
{
    header('location:association.php');
}


if(isset($_POST['addAssoc']) || isset($_POST['addingAssoc']))
{
	echo '<form method="POST" enctype="multipart/form-data">',
			'<table>',
				at_html_table_line('<p>Fichier à upload :</p>', at_html_form_input('file', 'fileToUpload', '')),
            	at_html_table_line(at_html_form_input('submit', 'addingAssoc', 'Ajouter'),at_html_form_input('submit', 'return', 'Annuler')),
            	($uploadOK[0] == 0) ? '' : '<tr>', $uploadOK[1] , '</tr>',
        	'</table>',
		 '</form>';
}

if(isset($_POST['deleteAssoc']))
{
	echo '<p>Êtes-vous sûr(e) de vouloir supprimer ce fichier (',$_POST['name'],')?</p>',
	 '<form method="POST">',
	 	at_html_form_input('hidden', 'name', "{$_POST['name']}"),
		'<table>',
			at_html_table_line(at_html_form_input('submit', 'return', 'Annuler'),at_html_form_input('submit', 'deletingAssoc', 'Oui, supprimer')),
		'</table>',
	'</form>';
}

if (count($_POST) == 0)
{
	header('location:association.php');
	exit();
}

echo     '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();