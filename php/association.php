<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER PEINTURE | Association', '../css/style.css', true);

at_aff_header('association');

$isConnected = '';

if (isset($_SESSION['login'])) 
{ 
    $isConnected = '<div class="bcForm"><h1>Vie de l\'association</h1>';
    
    $path = '../documents/association';
    $allFile = get_file_in_directory($path);
    unset($allFile[count($allFile)-1]);
    unset($allFile[0]);
    var_dump($allFile);

    if ($_SESSION['login'] == 'admin'){
        $isConnected .= '<form method="POST" action="adminAssociation.php" id="addButton">' . at_html_form_input("submit", "addAssoc", "Ajouter") . '</form>';

        foreach($allFile as $nameFile)
        {
            $link = $path . '/' . $nameFile;
            $isConnected .= '<form method="POST" action="adminAssociation.php" id="addButton">' . 
                                '<table>'.
                                    at_html_form_input("hidden", "name", "{$nameFile}") .
                                    at_html_table_line("<a href ='$link'>$nameFile</a>",at_html_form_input("submit", "deleteAssoc", "Supprimer")) . 
                                '</table>' .
                             '</form>';
        }
    }else{
        foreach($allFile as $nameFile)
        {
            $link = $path . '/' . $nameFile;
            $isConnected .= '<ul>'.
                                "<li><a href ='$link'>$nameFile</a></li>";
        }
        $isConnected .= '</ul>';
                            
    }

    $isConnected .= '</div>';
}

echo    '<section id="association">',
            '<img src="../images/LogATOPAC.jpg" alt="logo de l\'association ATOPAC">',
            '<p>',
                'ATOPAC (acronyme de « Aux Tours de l\'œuvre de Patrick Chenciner ») est une association loi de 1901 créée en 2018 dont l\'objet est de sauvegarder, ',
                'entretenir et transmettre la mémoire de l\'artiste Patrick Chenciner, de faire que son oeuvre reste présente, qu\'elle ne tombe pas dans l\'oubli et dans l\'anonymat.<br>',
                'Selon ses statuts (consultable <a href="../documents/public/Statuts_ATOPAC.doc">ici</a>), l\'association se donne pour but essentiel de favoriser les actions concourant au rassemblement, à la gestion, à la connaissance,',
                'à la promotion et à la diffusion de son œuvre, en lien avec son esprit et ce qu\'il a accompli.<br> ',
                'L\'association se propose de fédérer des projets autour de cette œuvre et d\'organiser des événements à la rencontre des publics.',
                'L\'association a notamment entrepris un répertoire le plus large possible de l\'œuvre de Patrick Chenciner, d\'en faire une sorte de catalogue complet qui, à terme, ',
                'pourrait idéalement prendre la forme d\'un catalogue raisonné. La finalité de ce projet est d\'apporter une base solide à la connaissance et à l\'étude de cette œuvre.',
                '<br>Merci d\'envoyer toute information sur Patrick Chenciner <a href="contact.php">ici</a>. ',
                'Cette adresse peut également être utilisée pour des demandes de renseignements et des demandes d\'adhésion à l\'association.',
            '</p>',
            ' <figure>',
                '<img src="../images/atelier_illustration_association.jpg" alt="Photo de Patrick Chenciner dans son atelier"/>',
                '<figcaption>Patrick Chenciner dans son atelier, 7 rue de l’École, Besançon, en avril 2004.</figcaption>',
            '</figure>',
            $isConnected,
        '</section>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();
