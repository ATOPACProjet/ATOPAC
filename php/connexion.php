<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

if (isset($_SESSION['login'])) 
{
    if ($_SESSION['login'] == 'admin')
    {
        header('location:admin.php');
        exit();
    }

    header('location:espaceMembre.php');
    exit();
}

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Connexion', '../css/style.css', true);

at_aff_header();

$bd=at_bd_connect();
$log='';

if(isset($_POST['btnSubmit']))
{
    $log=mysqli_escape_string($bd,$_POST['login']);
    //On regarde si un pseudo correspond
    $sql = "SELECT passwd ,login FROM Membres WHERE login ='$log'";
    $res=mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
    $pass= at_protect_sortie($_POST['passwd']);
    
    $T=mysqli_fetch_assoc($res);
    echo (password_verify($pass,$T['passwd']));
    if(!password_verify($pass,$T['passwd']))
    {
        $err= 'Mauvais login ou mot de passe !';
    }
    else
    {
        $_SESSION['login']=$T['login'];
        if ($_SESSION['login'] == 'admin')
        {
            header('location:admin.php');
            exit();
        }
        if($pass == '@t0pAc')
        {
            $_SESSION['firstTime']=true;
            header('location:firstConnexion.php');
            exit();
        }
        header('location:association.php');
        exit();
    }
}

echo '<section class="bcForm">',
       '<h1>Se connecter</h1>',
       '<form method="POST" action="connexion.php">',
            '<table>',
                at_html_table_line('<label for="login">Login : </label>',at_html_form_input('text','login','',true)),
                at_html_table_line('<label for="passwd">Mot de Passe : </label>',at_html_form_input('password','passwd','',true)),
                at_html_table_line('',at_html_form_input('submit','btnSubmit','Se connecter')),
            '<table>',
        '</form>';

if(isset($err))
{
    echo '<p>',$err,'</p>';
}

echo    '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();

