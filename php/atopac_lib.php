<?php

/*********************************************************
 *        Bibliothèque de fonctions génériques
 *
 * Les régles de nommage sont les suivantes.
 * Les fonctions commencent par le préfixe fd (cf f-rédéric d-adeau)
 * ou em (cf e-ric m-erlet) pour les différencier
 * des fonctions php.
 *
 * Généralement on trouve ensuite un terme définisant le "domaine" de la fonction :
 *  _aff_   la fonction affiche du code html / texte destiné au navigateur
 *  _html_  la fonction renvoie du code html / texte
 *  _bd_    la fonction gère la base de données
 *
 *********************************************************/

// Paramètres pour accéder à la base de données
define('BS_SERVER', 'localhost');
define('BS_DB', 'ermy8377_atopac');
define('BS_USER',   'ermy8377_admin');
define('BS_PASS',   ',3a,SQm!.*oA');


//____________________________________________________________________________
/**
 *  Ouverture de la connexion à la base de données
 *
 *  @return Objet   connecteur à la base de données
 */
function at_bd_connect() {
    $conn = mysqli_connect(BS_SERVER, BS_USER, BS_PASS, BS_DB);
    if ($conn !== FALSE) {
        //mysqli_set_charset() définit le jeu de caractères par défaut à utiliser lors de l'envoi
        //de données depuis et vers le serveur de base de données.
        mysqli_set_charset($conn, 'utf8')
        or xx_bd_erreurExit('<h4>Erreur lors du chargement du jeu de caractères utf8</h4>');
        return $conn;     // ===> Sortie connexion OK
    }
    // Erreur de connexion
    // Collecte des informations facilitant le debugage
    $msg = '<h4>Erreur de connexion base MySQL</h4>'
        .'<div style="margin: 20px auto; width: 350px;">'
        .'BD_SERVER : '. BS_SERVER
        .'<br>BS_USER : '. BS_USER
        .'<br>BS_PASS : '. BS_PASS
        .'<br>BS_DB : '. BS_DB
        .'<p>Erreur MySQL numéro : '.mysqli_connect_errno()
        .'<br>'.htmlentities(mysqli_connect_error(), ENT_QUOTES, 'ISO-8859-1')
        //appel de htmlentities() pour que les éventuels accents s'affiche correctement
        .'</div>';
    at_erreur_exit($msg);
}

//____________________________________________________________________________
/**
 * Arrêt du script si erreur
 *
 * Affichage d'un message d'erreur, puis arrêt du script
 * Fonction appelée quand une erreur 'base de données' se produit :
 *      - lors de la phase de connexion au serveur MySQL
 *      - ou indirectement lorsque l'envoi d'une requête échoue
 * Cette fonction est également appelée quand une erreur liée au paramétrage de PHP se produit
 *
 * @param string    $msg    Message d'erreur à afficher
 * @param string    $titre  Titre de la page
 */
function at_erreur_exit($msg, $titre = 'Erreur base de données') {
    ob_end_clean(); // Supression de tout ce qui a pu être déja généré
    //On affecte true dans $GLOBALS['debut_genere'] dans la fonction at_aff_debut()
    if (!isset($GLOBALS['debut_genere']) || $GLOBALS['debut_genere'] !== true){
        echo    '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><title>', $titre,
        '</title>',
        '<style>table{border-collapse: collapse;}td{border: 1px solid black;padding: 4px 10px;}</style>',
        '</head><body>';
    }
    echo        $msg,
    '</body></html>';
    exit(1);
}


//____________________________________________________________________________
/**
 * Gestion d'une erreur de requête à la base de données.
 *
 * A appeler impérativement quand un appel de mysqli_query() échoue
 * Appelle la fonction at_bd_erreurExit() qui affiche un message d'erreur puis termine le script
 *
 * @param objet     $bd     Connecteur sur la bd ouverte
 * @param string    $sql    requête SQL provoquant l'erreur
 */
function at_bd_erreur($bd, $sql) {
    $errNum = mysqli_errno($bd);
    $errTxt = mysqli_error($bd);

    // Collecte des informations facilitant le debugage
    $msg =  '<h4>Erreur de requête</h4>'
        ."<pre><b>Erreur mysql :</b> $errNum"
        ."<br> $errTxt"
        ."<br><br><b>Requête :</b><br> $sql"
        .'<br><br><b>Pile des appels de fonction</b></pre>';

    // Récupération de la pile des appels de fonction
    $msg .= '<table>'
        .'<tr><td>Fonction</td><td>Appelée ligne</td>'
        .'<td>Fichier</td></tr>';

    $appels = debug_backtrace();
    for ($i = 0, $iMax = count($appels); $i < $iMax; $i++) {
        $msg .= '<tr style="text-align: center;"><td>'
            .$appels[$i]['function'].'</td><td>'
            .$appels[$i]['line'].'</td><td>'
            .$appels[$i]['file'].'</td></tr>';
    }

    $msg .= '</table>';

    at_erreur_exit($msg);   // => ARRET DU SCRIPT
}





/**
 *  Fonction affichant le début du code HTML d'une page.
 *
 *  @param  String  $titre          Titre de la page
 *  @param  String  $css            Chemin relatif vers la feuille de style CSS
 *  @param  boolean $css_externe    true quand la page HTML est liée avec une feuille de styles externe,
 *                                  false quand la page HTML contient une feuille de styles interne (ie. un élément style)
 */
function at_aff_debut($titre, $css = '', $css_externe = true) {
    $link = ($titre=='PATRICK CHENCINER PEINTURE | Accueil')? '' : '../';
    $css = ($css == '') ? '' : ($css_externe ? "<link rel='stylesheet' type='text/css' href='$css'>" : "<style>$css</style>");
    echo
    '<!DOCTYPE html>',
    '<html lang="fr">',
    '<head>',
    '<title>', $titre, '</title>',
    '<meta charset="UTF-8">',
    $css,
    '<link rel="shortcut icon" href="',$link,'images/favicon.ico" type="image/x-icon">',
    '</head>',
    '<body>';
    // On vide le buffer, c'est à dire qu'on envoie ce début de page
    // au navigateur. Ainsi le navigateur va pouvoir commencer son
    // traitement et par exemple demander au serveur l'envoi de la
    // feuille de styles (ou de fichier javascript) pendant que notre
    // script PHP continue son traitement "en parallèle"
    ob_flush();
    // Cette dernière instruction peut poser des problèmes quand la fonction at_aff_debut() est appelée
    // avant la fonction at_erreur_exit(). Si on ne prend pas de précaution, on envoie 2 débuts de page
    // au navigateur.
    // La variable globale suivante permet d'éviter l'envoi de 2 débuts de page au navigateur
    $GLOBALS['debut_genere'] = true;
}


/**
 *  Fonction affichant la fin du code HTML d'une page.
 */
function at_aff_fin() {
    echo '</body></html>';
}




/**
 *  Protection des sorties (code HTML généré à destination du client).
 *
 *  Fonction à appeler pour toutes les chaines provenant de :
 *      - de saisies de l'utilisateur (formulaires)
 *      - de la bdD
 *  Permet de se protéger contre les attaques XSS (Cross site scripting)
 *  Convertit tous les caractères éligibles en entités HTML, notamment :
 *      - les caractères ayant une signification spéciales en HTML (<, >, ...)
 *      - les caractères accentués
 *
 *  @param  string  $text   la chaine à protéger
 *  @return string  la chaîne protégée
 */
function at_protect_sortie($str) {
    $str = trim($str);
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

//_______________________________________________________________
/**
 * Transformation d'un date amj en clair.
 *
 * Aucune vérification n'est faite sur la validité de la date car
 * on considère que c'est bien une date valide sous la forme aaaammjj
 *
 * @param integer    $amj        La date sous la forme aaaammjj
 *
 * @return string    La date sous la forme jj mois aaaa (1 janvier 2000)
 */
function at_amj_clair($amj) {
    $jj = substr($amj, -2);
    $mm = (int)substr($amj, 4, 2);

    return $jj.' '.at_get_mois($mm).' '.substr($amj, 0, 4);
}

//_______________________________________________________________
/**
 * Transformation d'une heure HH:MM:SS en clair.
 *
 *
 * @param string $heure      L'heure sous la forme HH:MM:SS
 *
 * @return string    L'heure sous la forme HHhMMmn (9h21mn)
 */
function at_heure_clair($heure) {
    $h = (int)substr($heure, 0, 2);
    $m = substr($heure, 3, 2);
    if (! at_est_entier($m)){
        $m = '00';
    }
    return "{$h}h{$m}mn";
}


//_______________________________________________________________
/**
 * Renvoie le code HTML d'un élément a
 *
 * supporte un seul couple 'nom=valeur' dans la queryString
 *
 *
 * @param string     $url            url du lien
 * @param string     $supportLien    support du lien
 * @param string     $querytringNom  nom du couple 'nom=valeur'
 * @param string     $queryStringVal valeur du couple 'nom=valeur'
 * @param string     $title          info bulle
 *
 * @return string    Le code HTML du lien
 */
function at_html_a($url, $supportLien, $queryStringNom = FALSE, $queryStringVal = FALSE, $title=''){
    $title = ($title != '') ? "title='$title'" : '';
    $queryString ="?{$queryStringNom}={$queryStringVal}";

    return "<a href='{$url}{$queryString}' {$title}>{$supportLien}</a>";
}

//_______________________________________________________________
/**
 * Teste si une valeur est une valeur entière
 *
 * @param   mixed       $x  valeur à tester
 * @return  boolean     TRUE si entier, FALSE sinon
 */
function at_est_entier($x) {
    return is_numeric($x) && ($x == (int) $x);
}


/**
 * Renvoie le nom d'un mois.
 *
 * @param integer   $numero     Numéro du mois (entre 1 et 12)
 *
 * @return string   Nom du mois correspondant
 */
function at_get_mois($numero) {
    $numero = (int) $numero;
    ($numero < 1 || $numero > 12) && $numero = 0;

    $mois = array('erreur', 'janvier', 'février', 'mars',
        'avril', 'mai', 'juin', 'juillet', 'août',
        'septembre', 'octobre', 'novembre', 'décembre');

    return $mois[$numero];
}

//_______________________________________________________________
//
//      FONCTIONS UTILISEES DANS LES FORMULAIRES
//_______________________________________________________________

/**
 * Génére le code d'une ligne de formulaire :
 *
 * @param string     $gauche     Contenu de la colonne de gauche
 * @param string     $droite     Contenu de la colonne de droite
 *
 * @return string    Code HTML représentant une ligne de tableau
 */
function at_html_table_line($left, $right) {
    return "<tr><td>{$left}</td><td>{$right}</td></tr>";
}

//_______________________________________________________________
/**
 * Génére le code d'une zone input de formulaire (type input) :
 *
 * @param String     $type   Type de l'input ('text', 'hidden', ...).
 * @param string     $name   Nom de la zone (attribut name).
 * @param String     $required  Valeur par défaut (attribut value).
 * @param integer    $readonly   Taille du champ (attribut size).
 *
 * @return string Code HTML de la zone de formulaire
 */
function at_html_form_input($type, $name, $value, $required=false, $readonly=false, $class="") {
    $value =  at_protect_sortie($value);
    $ifRequired = ($required) ? 'required' : '';
    $ifRequired = ($ifRequired == 'required' && $type == 'radio') ? 'checked' : '';
    $ifReadOnly = ($readonly) ? ' readonly' : '';
    return "<input type='{$type}' name='{$name}' class='{$class}' value='{$value}' {$ifRequired}{$ifReadOnly}>";
}

/**
 * Génére le code d'une actualités :
 * @param string $title
 * @param string $src
 * @param string $decriptifFR
 * @param string $decriptifEN
 * @return string
 */

function at_html_actualite($title='', $decriptifFR='', $decriptifEN='', $src='', $form) {
    $article = '<article>';
    if ($title != '') $article .= '<h1>'.$title.'</h1>';
    $article .= '<div>';
    if ($src != '') $article .= '<img src="../images/Actualites/'.$src.'">';
    if ($decriptifFR != '')
    {
        $article .= '<div><p class="descriptifFR">'.$decriptifFR.'</p>';
        if ($decriptifEN != '') $article .= '<p class="descriptifEN">'.$decriptifEN.'</p>';
        $article .= '</div>';
    }
    $article .='</div><p class="clearer"></p>' . $form . '</article>';
    return $article;

}

/**
 * Function to print header in HTML
 *
 * @param string $name Name of the current page
 */
function at_aff_header($name = ''){
    $link = strcmp($name,'home') != 0 ? '' : 'php/';

    $firstCo = ($name != 'firstCo')? isset($_SESSION['firstTime']) : false;
    if (isset($_POST['deconnexion']) || $firstCo)
    {
        at_session_exit();
    }

    $language = '<form  method="POST">';

    if(isset($_POST['eng']))
    {
        $language .= '<input type="submit" name="fr" value="&#x1F1EB;&#x1F1F7;"/>';
    }
    else {
        $language .= '<input type="submit" name="eng" value="&#x1F1EC;&#x1F1E7;"/>';
    }

    $language .= '</form>';

    $button = '<span id="bust">&#x1F464;</span><ul style="display: none;">';
    if (isset($_SESSION['login']))
    {
        $button .= '<li><form  method="POST">'.'<input type="submit" name="deconnexion" id="btnDeconnexion" value="Se déconnecter" >'.'</form></li>';
        $button .= '<li><a href="'.$link.'espaceMembre.php" id="btnGestionM">Gestion de son compte</a></li>';
    }
    else
    {
        $button .= '<a href="'.$link.'connexion.php" id="btnConnexion"">Connexion adhérent</a>';
    }
    $button .= '</ul>';


    $whichPage = '<li ' . (strcmp($name,'home')==0? 'class="ongletCourant afficher">Accueil' : 'class="afficher"><a href="../index.php">Accueil</a>') . '</li>';
    $whichPage .= '<li ' . (strcmp($name,'bio')==0? 'class="ongletCourant afficher">Bio' : 'class="afficher"><a href="'.$link.'bio.php">Bio</a>') . '</li>';
    $whichPage .= '<li ' . (strcmp($name,'oeuvre')==0? 'class="ongletCourant afficher">Œuvres' : 'class="afficher"><a href="'.$link.'galerie.php">Œuvres</a>') . '</li>';
    $whichPage .= '<li ' . (strcmp($name,'association')==0? 'class="ongletCourant afficher">Association' : 'class="afficher"><a href="'.$link.'association.php">Association</a>') . '</li>';
    $whichPage .= '<li ' . (strcmp($name,'actualites')==0? 'class="ongletCourant afficher">Actualites' : 'class="afficher"><a href="'.$link.'actualites.php">Actualites</a>') . '</li>';
    $whichPage .= '<li ' . (strcmp($name,'contact')==0? 'class="ongletCourant afficher">Contact' : 'class="afficher"><a href="'.$link.'contact.php">Contact</a>') . '</li>';
    if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') $whichPage .= '<li ' . (strcmp($name,'admin')==0? 'class="ongletCourant afficher">Admin' : 'class="afficher"><a href="'.$link.'admin.php">Admin</a>') . '</li>';

    $titleLink = (strcmp($name,'home') == 0)? '<h1><strong>PATRICK CHENCINER</strong><span id="espace">PEINTURE</h1>' : '<h1><a href="../index.php"><strong>PATRICK CHENCINER</strong><span id="espace"></span>PEINTURE</a></h1>';

    echo    '<header>',
                '<div id="entete" >',
                $language,
                /*à enlever avant le lancement*/'<div id="development"><span id="warningSign">&#9888;</span><span>Site en cours de réalisation</span></div>',
                $button,
                '</div>',
                $titleLink,
                '<p class="afficher">☰</p>',
                '<ul class="cacher">',
                    $whichPage,
                '</ul>',
            '</header>',

            '<script>
                  document.querySelector("header>div>span").onclick = function()
                  {
                      let menu = document.querySelector("header>div>span~ul");
                      if (menu.style.display == "block")
                      {
                           menu.style.display = "none";     
                      }
                      else
                      {
                           menu.style.display = "block"
                      }
                  }

                document.querySelector("header>p").onclick = function()
                {
                    let menu = document.querySelector("header>p~ul");
                    if (menu.className == "afficher")
                    {
                        menu.className = "cacher";
                    }
                    else
                    {
                        menu.className = "afficher";
                    }
                }
            </script>';
}

//_______________________________________________________________
/**
 * Ends a session and redirects to the registration.php page
 *
 * It uses:
 * - the session_destroy() function that destroys the existing session
 * - the session_unset() function that clears all session variables
 * It also removes the session cookie
 * 
 */
function at_session_exit() {
    $serverLink = "/projet-site-atopac/";

    session_destroy();
    session_unset();
    $cookieParams = session_get_cookie_params();
    setcookie(session_name(), 
            '', 
            time() - 86400,
            $cookieParams['path'], 
            $cookieParams['domain'],
            $cookieParams['secure'],
            $cookieParams['httponly']
        );
    $link = substr($_SERVER['REQUEST_URI'],strlen($serverLink));
    
    if ($link == "index.php") 
    {
        $link = '../' . $link;
    }else{
        $link = substr($link,4);
    }

    header("location:$link");
    exit();
}

//_______________________________________________________________
/**
* Checks if user is authenticated
*
* If the user is not authenticated, the at_session_exit() function ends the session
* and redirects the user to the.php login page.
* This function is called at the beginning of each page accessible only to authenticated users
*
* @global array $_SESSION Table containing session variables
*/
function at_verify_authentification(){
    if (!isset($_SESSION['login'])) {
        at_session_exit();
    }
}


function at_crypt_passwd($bd, $txtPasse) {
    return mysqli_real_escape_string($bd, password_hash($txtPasse, PASSWORD_DEFAULT));
}

function at_create_login($fname,$sname){
    $fname = trim(str_replace("","-",$fname));
    $sname = trim(str_replace("-","",$sname));
    $login = substr($fname,0,1) ;
    $login .= (mb_strlen($sname, 'UTF-8') < 7)? $sname : substr($sname,0,7); 
    return strtolower($login);
}


function at_upload_jpg($target_dir,$id=1,$type='jpg')
{
    if ($id == 0) 
    {
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
    }
    else
    {
        $target_file = '../images/Oeuvre/' . $id . '.jpg';
    }
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if ($_FILES['fileToUpload']['tmp_name'] == '')
    { // Check if there is a file
        return [0, 'Il n\'y a pas de fichier.'];
    }

    if (file_exists($target_file))
    { // Check if file already exists
        return [0, 'Désolé, le fichier existe déjà'];
    }

    if($fileType != 'jpg' && $type != 'default')
    { // Allow jpg format
        return [0, "Désolé, seul l'extension .$type est autorisée"];
    }

    if($fileType == 'jpg' && getimagesize($_FILES['fileToUpload']['tmp_name']) == false)
    { // Check if image file is a actual image or fake image
        return [0, 'Le fichier n\'est pas une image.'];
    }

    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
    { // if everything is ok, try to upload file
        chmod($target_file,0777);
        return [1, 'le fichier '. basename( $_FILES['fileToUpload']['name']). ' a bien été uploader.', basename($_FILES['fileToUpload']['name'])];
    }
    else
    {
        return [0, 'Désolé, une erreur c\'est produite lors de l\'upload du fichier.'];
    }
}


function get_file_in_directory($path)
{
    $elements = array(); //Déclare le tableau qui contiendra tous les éléments de nos dossiers

    $dir = opendir($path); //ouvre le dossier

    while (($element_directory = readdir($dir)) !== FALSE){ //Pour chaque élément du dossier...
        $elements[] = $element_directory;
    }

    return $elements;
}

function at_CurrentVirtualExpo()
{
    $bd = at_bd_connect();
    $sql = "SELECT * FROM `ExpoVirtuelle`";
    $res=mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
    if (mysqli_fetch_assoc($res)) return true;
    return false;
}

function deleteExpo()
{
    $allImage = get_file_in_directory("../images/ExpoVirtuelle");
    unset($allImage[count($allImage) - 1]);
    unset($allImage[0]);
    foreach ($allImage as $item)
    {
        unlink("../images/ExpoVirtuelle/" . $item);
    }
    $bd = at_bd_connect();
    $sql = "DELETE FROM `ExpoVirtuelle`";
    $res = mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);
}

?>
