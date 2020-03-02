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
$errGalerie = '';

echo '<section class="bcForm">',
       '<h1>Gestion Galerie</h1>',
       $errGalerie;


if (isset($_POST['addingGalerie'])){
	$sql = "SELECT COUNT(rang) FROM `Oeuvres`";
	$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	$maxRank = mysqli_fetch_assoc($res);
    $maxRank = $maxRank['COUNT(rang)'] + 1;

	if(isset($_FILES['fileToUpload'])) $uploadOK = at_upload_jpg('',$_POST['id']);
	$rank = intval(mysqli_escape_string($bd, trim($_POST['rank'])));
	if (trim($_POST['rank']) == '') 
	{
		$rank=$maxRank;
	}
	elseif ($rank == 0) 
	{
		$errGalerie .= '<p>Le rang doit être un entier supérieur à 0</p>';
	}elseif($rank > $maxRank){
		$errGalerie .= '<p>Le rang doit être inférieur à '. $maxRank .'</p>';
	}
	else
	{
		$sql = "UPDATE `Oeuvres` SET rang=rang+1 WHERE rang > $rank";
		$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
		$rank = mysqli_fetch_assoc($res) + 1;
	}
	$title = mysqli_escape_string($bd, $_POST['title']);
	$date = mysqli_escape_string($bd, $_POST['dated']);
	$tech = mysqli_escape_string($bd, $_POST['tech']);
	$height = mysqli_escape_string($bd, $_POST['height']);
	$width = mysqli_escape_string($bd, $_POST['width']);
	$collection = mysqli_escape_string($bd, $_POST['collection']);
	$credit = mysqli_escape_string($bd, $_POST['credit']);
	$comm = mysqli_escape_string($bd, $_POST['comm']);

	if ($errGalerie == '')
	{
		$sql = "INSERT INTO `Oeuvres`(`rang`, `titre`, `techniques`, `hauteur`, `largeur`, `annee`, `collection`, `credit`, `commentaire`) 
			    VALUES ($rank,'$title','$tech','$height','$width','$date','$collection','$credit','$comm')";
		mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
		header('location:galerie.php');
		exit();
	}
}

if (isset($_POST['changingGalerie'])){
    $title = mysqli_escape_string($bd, $_POST['title']);
    $date = mysqli_escape_string($bd, $_POST['dated']);
    $tech = mysqli_escape_string($bd, $_POST['tech']);
    $height = mysqli_escape_string($bd, $_POST['height']);
    $width = mysqli_escape_string($bd, $_POST['width']);
    $collection = mysqli_escape_string($bd, $_POST['collection']);
    $credit = mysqli_escape_string($bd, $_POST['credit']);
    $comm = mysqli_escape_string($bd, $_POST['comm']);

    if (!is_numeric($height) && $height != '') $errGalerie .= '<p>La hauteur doit être un nombre</p>';
    if (!is_numeric($width) && $width != '') $errGalerie .= '<p>La largeur doit être un nombre</p>';

    $sql = "SELECT COUNT(Rang) as nb FROM `Oeuvres`";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
    $maxRank = mysqli_fetch_assoc($res);
    $maxRank = $maxRank['nb'] + 1;

    $sql = "SELECT Rang FROM `Oeuvres` WHERE id = {$_POST['id']}";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
    $beforeRank = mysqli_fetch_assoc($res);
    $beforeRank = $beforeRank['Rang'];

    $rank = intval(mysqli_escape_string($bd, trim($_POST['rank'])));
    if (trim($_POST['rank']) == '')
    {
        $errGalerie .= '<p>Le rang ne peut pas être vide</p>';
    }
    elseif (!is_numeric($_POST['rank'])) {
        $errGalerie .= '<p>Le rang doit être un nombre</p>';
    }
    elseif ($rank < 1 || $rank > $maxRank) 
    {
        $errGalerie .= "<p>Le rang doit être un entier supérieur à 0 et inférieur à $maxRank</p>";
    }
    
    if(strlen($errGalerie) == 0)
    {
        if($rank > $beforeRank)
        {
            $sql = "UPDATE `Oeuvres` SET Rang=Rang+1 WHERE Rang >= $rank";
            $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
        }
        elseif ($rank < $beforeRank) {
            $sql = "UPDATE `Oeuvres` SET Rang=Rang+1 WHERE Rang >= $rank AND Rang < $beforeRank";
            $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
        }

        $sql = "UPDATE `Oeuvres` 
                SET `Titre`='$title',
                    `Rang`=$rank,
                    `Date`='$date',
                    `Technique`='$tech',
                    `Hauteur`=$height,
                    `Largeur`=$width,
                    `Collection`='$collection',
                    `Crédit_Photographique`='$credit',
                    `Remarques`='$comm' 
                WHERE id = {$_POST['id']}";
        mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
        header('location:galerie.php');
        exit();
    }
}

if(isset($_POST['deletingGalerie']))
{
    $sql = "SELECT Rang FROM `Oeuvres` WHERE id = {$_POST['id']}";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
    $beforeRank = mysqli_fetch_assoc($res);
    $beforeRank = $beforeRank['Rang'];

    $sql = "UPDATE `Oeuvres` SET Rang=Rang-1 WHERE Rang > $beforeRank";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

    $sql = "DELETE FROM `Oeuvres` WHERE id ='{$_POST['id']}'";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

    $filename = '../images/Oeuvres/' . $_POST['id'] . '.jpg';
    unlink($filename);

    header('location:galerie.php');
    exit();
}

if(isset($_POST['return']))
{
    header('location:galerie.php');
}


if(isset($_POST['addGalerie']) || isset($_POST['addingGalerie']))
{
	echo '<form method="POST" enctype="multipart/form-data">',
			'<table>',
				at_html_table_line('<p>Image :</p>', at_html_form_input('file', 'fileToUpload', '')),
				at_html_table_line('<p>Rang :</p>', at_html_form_input('text', 'rank', '')),
				at_html_table_line('<p>Titre :</p>', at_html_form_input('text', 'title', '')),
				at_html_table_line('<p>Date :</p>', at_html_form_input('text', 'dated', '')),
				at_html_table_line('<p>Technique :</p>', at_html_form_input('text', 'tech', '')),
            	at_html_table_line('<p>Hauteur:</p>', at_html_form_input('text', 'height', '')),
            	at_html_table_line('<p>Largeur:</p>', at_html_form_input('text', 'width', '')),
            	at_html_table_line('<p>Collection:</p>', at_html_form_input('text', 'collection', '')),
            	at_html_table_line('<p>Crédit photographique:</p>', at_html_form_input('text', 'credit', '')),
            	at_html_table_line('<p>Commentaire:</p>', at_html_form_input('text', 'comm', '')),
            	at_html_table_line(at_html_form_input('submit', 'addingGalerie', 'Ajouter'),at_html_form_input('submit', 'return', 'Annuler')),
        	'</table>',
		 '</form>';
}

if (isset($_POST['changeGalerie']) || isset($_POST['changingGalerie']))
{
    $sql = "SELECT * FROM `Oeuvres` WHERE id = {$_POST['id']}";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
    $T = mysqli_fetch_assoc($res);
    echo '<form method="POST" id = "changeForm">',
           '<table>',
               at_html_form_input('hidden', 'id', "{$_POST['id']}"),
               at_html_table_line('<p>Titre :</p>', at_html_form_input('text', 'title', $T['Titre'])),
               at_html_table_line('<p>Position :</p>', at_html_form_input('text', 'rank', $T['Rang'])),
               at_html_table_line('<p>Date :</p>', at_html_form_input('text', 'dated', $T['Date'])),
               at_html_table_line('<p>Technique :</p>', at_html_form_input('text', 'tech', $T['Technique'])),
               at_html_table_line('<p>Hauteur:</p>', at_html_form_input('text', 'height', $T['Hauteur'])),
               at_html_table_line('<p>Largeur:</p>', at_html_form_input('text', 'width', $T['Largeur'])),
               at_html_table_line('<p>Collection:</p>', at_html_form_input('text', 'collection', $T['Collection'])),
               at_html_table_line('<p>Crédit photographique:</p>', at_html_form_input('text', 'credit', $T['Crédit_Photographique'])),
               at_html_table_line('<p>Commentaire:</p>', at_html_form_input('text', 'comm', $T['Remarques'])),
 			   at_html_table_line(at_html_form_input('submit', 'changingGalerie', 'Modifier'),at_html_form_input('submit', 'return', 'Annuler')),
            '</table>',
        '</form>';
}

if(isset($_POST['deleteGalerie']))
{
	echo '<p>Êtes-vous sûr(e) de vouloir supprimer cette Oeuvre?</p>',
	 '<form method="POST">',
	 	at_html_form_input('hidden', 'id', "{$_POST['id']}"),
		'<table>',
			at_html_table_line(at_html_form_input('submit', 'return', 'Annuler'),at_html_form_input('submit', 'deletingGalerie', 'Oui, supprimer')),
		'</table>',
	'</form>';
}

if (count($_POST) == 0)
{
	header('location:galerie.php');
	exit();
}

echo     '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();