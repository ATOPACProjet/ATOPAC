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

// $ftp_details['ftp_user_name'] = 'your ftp username';
// $ftp_details['ftp_user_pass'] = 'your ftp password';
// $ftp_details['ftp_root'] = '/public_html/';
// $ftp_details['ftp_server'] = 'ftp' . $_SERVER['HTTP_HOST'];
// function ftp_chmod($path, $mod, $ftp_details) {
//   extract($ftp_details);
//   $conn_id = ftp_connect($ftp_server);
//   $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// // try to chmod $path directory
//   if (ftp_site($conn_id, 'CHMOD ' . $mod . ' ' . $ftp_root . $path) !== false) {
//     $success = true;
//   }
//   else {
//     $success = false;
//   }

//   ftp_close($conn_id);
//   return $success;

// chmod('../documents/association', 0757);
// chmod('../images/Oeuvres', 0757);
// chmod('../images/Actualites', 0757);

header('location:admin.php');

ob_end_flush();