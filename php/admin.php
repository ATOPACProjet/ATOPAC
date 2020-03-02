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

	$login = mysqli_escape_string($bd,$_POST['txtLogin']);
	$sql = "SELECT login FROM Membres WHERE login = '$login'";
	$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	$T= mysqli_fetch_assoc($res);
	if (count($T) != 1) $errPass .= '<p>Le login entré n\'existe pas</p>';

	if ($errPass == '')
	{
		$pass = mysqli_escape_string($bd,password_hash($_POST['txtPasse'],PASSWORD_DEFAULT));
		$sql = "UPDATE Membres SET passwd = '$pass' WHERE login = '$login'";
		mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	}
}


if(isset($_POST['addMember']))
{
	if($_POST['txtVerif']!=$_POST['txtPasse'] && mb_strlen($_POST['txtPasse'], 'UTF-8') >= 6) 
	{
		$errPass .= '<p>Le mot de passe entré ne correspond pas.</p>';
	}

	if ($_POST['lName'])
	{
		$errPass .= '<p>Le prénom ne peut pas être vide.</p>';
	}

	if ($_POST['fName'])
	{
		$errPass .= '<p>Le nom ne peut pas être vide.</p>';
	}

	$login = mysqli_escape_string($bd,at_create_login($_POST['lName'],$_POST['fName']));
	$pass = (mb_strlen($_POST['txtPasse'], 'UTF-8') >= 6)? password_hash(mysqli_escape_string($_POST['txtPasse']),PASSWORD_DEFAULT) : password_hash('@t0pacZ',PASSWORD_DEFAULT);
	if(strlen($errPass))
	{
		$sql = "INSERT INTO `Membres`(`login`, `passwd`, `nom`, `prenom`) VALUES ('$login','$pass','{$_POST['lName']}','{$_POST['fName']}')";
		$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
	}
}

if(isset($_POST['deleteMember']))
{
	$sql = "DELETE FROM `Membres` WHERE login ='{$_POST['login']}'";
	$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
}


$radioButtons = at_html_form_input('radio','search','login',true) . '<label for="login">Par Login</label>';
$radioButtons .= at_html_form_input('radio','search','nom'). '<label for="nom">Par Nom</label>';
$radioButtons .= at_html_form_input('radio','search','prenom'). '<label for="prenom">Par Prénom</label>';

echo '<section class="bcForm" >',
        '<h1>Pour ajouter une exposition virtuelle, cliquez <a href="adminExpoVirtuelle.php" style="text-decoration: underline; color: red;">ici</a></h1>',
        '<h1>Gestion Membre</h1>',
        //For add a member
        '<form method="POST" action="adminMember.php">',
                at_html_form_input('submit', 'addMember', 'Ajouter'),
        '</form>',
        //For search a member
        '<form method="POST" class="formRecherche">',
                '<table>',
                    $radioButtons,
                    at_html_table_line(at_html_form_input('text','pattern',''),at_html_form_input('submit', 'searchMember', 'Rechercher')),
                '</table>',
        '</form>';

//List of members :

echo 		'<ul id="listMember">',
				'<li><table><tr><td>Login</td><td>Prénom</td><td>Nom</td></tr></table></li>';
$sql = "SELECT * FROM `Membres`";

if(isset($_POST['searchMember']))
{
	(!isset($_POST['search']))? $who = '' : $who = $_POST['search'];
	if ($_POST['pattern'] != '')
	{
		$sql = "SELECT * FROM `Membres` WHERE $who LIKE '%{$_POST['pattern']}%'";
	}
}

$res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

$buttons = at_html_form_input('submit', 'changeMember', 'Modifier');
$buttons .= at_html_form_input('submit', 'deleteMember', 'Supprimer');

while($T = mysqli_fetch_assoc($res)){
	if ($T['login'] != 'admin')
	{
		echo '<li><form method="POST" class="currentMember" action="adminMember.php">',
				at_html_form_input('text', 'login', "{$T['login']}",false,true),
				at_html_form_input('text', 'lName', "{$T['nom']}",false,true),
				at_html_form_input('text', 'fName', "{$T['prenom']}",false,true),
				$buttons,
			'</form></li>';
	}
}

echo 		'</ul>',
			//'<h1><a href="droit.php">Test maj des droit dans les dossiers<a></h1>',
		'</section>';
at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
