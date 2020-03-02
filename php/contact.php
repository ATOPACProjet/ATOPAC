<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Contact', '../css/style.css', true);

at_aff_header('contact');

if (isset($_POST['btnEnvoyer']))
{
    ini_set( 'display_errors', 1 );

    error_reporting( E_ALL );

    $from = $_POST['mail'];

    $to = "quarrozantonin@gmail.com";

    $subject = $_POST['object'];

    $message = $_POST['message'];

    $headers = "From:" . $from;

    $return = mail($to,$subject,$message, $headers);

    if ($return)
    {
        echo "L'email a été envoyé.";
    }
    else
    {
        echo "Marche pas";
    }

}

$section = '<section class="bcForm">' .
            '<h1>Formulaire pour nous contacter</h1>' .
            '<form method="POST" action="contact.php">' .
                '<table>' .
                    at_html_table_line('<label for="lastName" class="requiredField">Nom</label>:', at_html_form_input('text', 'lastName' ,'', true)) .
                    at_html_table_line('<label for="firstName" class="requiredField">Prénom</label>:', at_html_form_input('text', 'firstName', '', true)) .
                    at_html_table_line('<label for="postal">Code postal/Ville </label>:', at_html_form_input('text', 'postal', '')) .
                    at_html_table_line('<label for="mail" class="requiredField">Adresse mail</label>:', at_html_form_input('text', 'mail', '',true)) .
                    at_html_table_line('<label for="object" >Objet</label> :', at_html_form_input('text', 'object', '')) .
                    at_html_table_line('', '<textarea name="message" cols="50" rows="10" required placeholder="Entrez le contenu de votre message"></textarea>') .
                    at_html_table_line('', at_html_form_input('submit','btnEnvoyer','Envoyer',true)) .
                    '<tr><p>Les champs marqués par<span class="requiredField"></span>sont obligatoires</p></tr>' .
                '</table>' .
            '</form>' .


        '</section>';

echo $section;

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
