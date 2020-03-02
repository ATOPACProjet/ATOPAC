<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

if (!isset($_SESSION['login'])) {
	header("location:connexion.php");
	exit();
}

if ($_SESSION['login'] != 'admin') {
	header("location:espaceMembre.php");
	exit();
}


error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Admin', '../css/style.css', true);

echo at_aff_header('admin');

$bd=at_bd_connect();
$errPass = '';

if (isset($_POST['btnSubmitPass']))
{
	if (mb_strlen($_POST['txtPasse'], 'UTF-8') < 6)
	{
		$errPass = '<p>Le mot de passe doit faire au moins 6 caractères</p>';
	}
	elseif($_POST['txtVerif']!=$_POST['txtPasse']) 
	{
		$errPass .= '<p>Le mot de passe entré ne correspond pas</p>';
	}

	$login = mysqli_escape_string($bd,$_POST['login']);
	$sql = "SELECT login FROM Membres WHERE login = '$login'";
	$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	$T= mysqli_fetch_assoc($res);
	if (count($T) != 1) $errPass .= '<p>Le login entré n\'existe pas</p>';

	if ($errPass == '')
	{
		$pass = mysqli_escape_string($bd,password_hash($_POST['txtPasse'],PASSWORD_DEFAULT));
		$sql = "UPDATE Membres SET passwd = '$pass' WHERE login = '$login'";
		mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
		header('location:admin.php');
		exit();
	}
}


if(isset($_POST['addingMember']))
{
	if ($_POST['fName'] == '')
	{
		$errPass .= '<p>Le nom ne peut pas être vide.</p>';
	}

	if ($_POST['lName'] == '')
	{
		$errPass .= '<p>Le prénom ne peut pas être vide.</p>';
	}

	if(mb_strlen($_POST['txtPasse'], 'UTF-8') < 6 && mb_strlen($_POST['txtPasse'], 'UTF-8') != 0)
	{
		$errPass .= '<p>Le mot de passe doit faire au moins 6 caractères.</p>';
	}

	if($_POST['txtVerif']!=$_POST['txtPasse']) 
	{
		$errPass .= '<p>Le mot de passe entré ne correspond pas.</p>';
	}

	$login = mysqli_escape_string($bd,at_create_login($_POST['fName'],$_POST['lName']));
	$pass = (mb_strlen($_POST['txtPasse'], 'UTF-8') >= 6)? password_hash(mysqli_escape_string($_POST['txtPasse']),PASSWORD_DEFAULT) : password_hash('@t0pAc',PASSWORD_DEFAULT);

	if(strlen($errPass) == 0)
	{
		$sql = "SELECT login FROM Membres WHERE login='$login'";
		$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
		$T= mysqli_fetch_assoc($res);
		
		if (count($T) !=0){
			$login = $login . (count($T) + 1);
		}

		$sql = "INSERT INTO `Membres`(`login`, `passwd`, `nom`, `prenom`) VALUES ('$login','$pass','{$_POST['fName']}','{$_POST['lName']}')";
		$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
		header('location:admin.php');
		exit();
	}
}

if(isset($_POST['deletingMember']))
{
	$sql = "DELETE FROM `Membres` WHERE login ='{$_POST['login']}'";
	$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	header('location:admin.php');
	exit();
}

if(isset($_POST['return']))
{
	header('location:admin.php');
	exit();
}




echo '<section class="bcForm">',
            '<h1>Gestion Membre</h1>';

//For changing password :
if(isset($_POST['changeMember']) || isset($_POST['btnSubmitPass']))
{
    echo '<form method="POST">',
        	'<table>',
        		at_html_table_line('<p>Login :</p>', at_html_form_input('text', 'login', "{$_POST['login']}", false,true)),
        		at_html_table_line('<p>Prénom :</p>', at_html_form_input('text', 'lName', "{$_POST['lName']}", false,true)),
        		at_html_table_line('<p>Nom :</p>', at_html_form_input('text', 'fName', "{$_POST['fName']}", false,true)),
            	at_html_table_line('<p>Changer son mot de passe:</p>', at_html_form_input('password', 'txtPasse', '')),
            	at_html_table_line('<p>Retapez son mot de passe:</p>', at_html_form_input('password', 'txtVerif', '')),
            	at_html_table_line(at_html_form_input('submit', 'btnSubmitPass', 'Valider'), at_html_form_input('submit', 'return', 'Annuler')),
            	'<tr>',$errPass,'</tr>',
            '</table>',
         '</form>';
}


if(isset($_POST['addMember']) || isset($_POST['addingMember']))
{
echo '<form method="POST">',
		'<table>',
			'<tr>Si le mot de passe est vide, alors le mot de passe par défaut sera pris (@t0pAc)</tr>',
			at_html_table_line('<p>Nom :</p>', at_html_form_input('text', 'lName', '')),
			at_html_table_line('<p>Prénom :</p>', at_html_form_input('text', 'fName', '')),
			at_html_table_line('<p>Mot de passe:</p>', at_html_form_input('password', 'txtPasse', '')),
        	at_html_table_line('<p>Confirmation mot de passe:</p>', at_html_form_input('password', 'txtVerif', '')),
        	at_html_table_line(at_html_form_input('submit', 'addingMember', 'Ajouter'),at_html_form_input('submit', 'return', 'Annuler')),
        	'<tr>',$errPass,'</tr>',
    	'</table>',
	'</form>';
}

if(isset($_POST['deleteMember']))
{

echo '<p>Êtes-vous sûr(e) de vouloir supprimer ',$_POST['login'],' (',$_POST['lName'],' ',$_POST['fName'],')?</p>',
	 '<form method="POST">',
	 	at_html_form_input('hidden', 'login', "{$_POST['login']}",false,true),
		'<table>',
			at_html_table_line(at_html_form_input('submit', 'return', 'Annuler'),at_html_form_input('submit', 'deletingMember', 'Oui, supprimer')),
		'</table>',
	'</form>';
}

if (count($_POST) == 0)
{
	header('location:admin.php');
	exit();
}

echo '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
