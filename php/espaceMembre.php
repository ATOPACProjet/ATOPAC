<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

if (!isset($_SESSION['login'])) {
	header("location:connexion.php");
}

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

$bd=at_bd_connect();

at_aff_debut('PATRICK CHENCINER PEINTURE | Espace Membre', '../css/style.css', true);

at_aff_header();

$errPass = '';
$errMail = '';

if (isset($_POST['btnSubmitMail'])){
	$mail_posted = $_POST['txtMail'];
	if (strpos($mail_posted, '@') === FALSE || strpos($mail_posted, '.') === FALSE) {
        $errMail = 'L\'adresse mail n\'est pas valide';
    }
    elseif (filter_var($mail_posted, FILTER_VALIDATE_EMAIL) === false){
        $errMail = 'L\'adresse mail n\'est pas valide';
    }
    elseif (mb_strlen($mail_posted, 'UTF-8') > LMAX_MAIL){
        $errMail = 'L\'adresse mail est trop longue';
    }

    if ($errMail == '')
	{	
		$mail = mysqli_escape_string($bd,$_POST['txtMail']);
		$login = $_SESSION['login'];
		$sql = "UPDATE Membres SET mail = '$mail' WHERE login = '$login'";
		mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	}
}

if (isset($_POST['btnSubmitPass'])){
	if (mb_strlen($_POST['txtPasse'], 'UTF-8') < 6)
	{
		$errPass = '<p>Le mot de passe doit faire au moins 6 caractères</p>';
	}
	elseif($_POST['txtPasse'] == '@t0pAc'){
		$errPass = '<p>Le mot de passe doit être différent du mot de passe de base</p>';
	}
	elseif ($_POST['txtVerif']!=$_POST['txtPasse']) $errPass .= '<p>Le mot de passe entré ne correspond pas</p>';

	if ($errPass == '')
	{	
		$pass = mysqli_escape_string($bd,password_hash($_POST['txtPasse'],PASSWORD_DEFAULT));
		$login = $_SESSION['login'];
		$sql = "UPDATE Membres SET passwd = '$pass' WHERE login = '$login'";
		mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	}
}

echo '<section class="bcForm">',
            '<h1>Espace Membre</h1>',
            '<form method="POST">',
	        	'<table>',
	            	at_html_table_line('<p>Changer de mot de passe:</p>', at_html_form_input('password', 'txtPasse', '', true)),
	            	at_html_table_line('<p>Retapez le mot de passe:</p>', at_html_form_input('password', 'txtVerif', '', true)),
	            	at_html_table_line('', at_html_form_input('submit', 'btnSubmitPass', 'Valider')),
	            	'<tr>',$errPass,'</tr>',
	            '</table>',
			'</form>',
            '<form method="POST">',
	        	'<table>',
	            	at_html_table_line('<p>Changer d\'email:</p>', at_html_form_input('text', 'txtMail', '', true)),
	            	at_html_table_line('', at_html_form_input('submit', 'btnSubmitMail', 'Valider')),
	            	'<tr>',$errMail,'</tr>',
	            '</table>',
            '</form>',
        '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
