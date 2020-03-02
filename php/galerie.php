<?php
ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER | Galerie', '../css/style.css', true);

at_aff_header('oeuvre');

$bd=at_bd_connect();

$isAdmin=(isset($_SESSION['login']) && $_SESSION['login'] == 'admin');

$sql = "SELECT * FROM Oeuvres ORDER BY Rang";
$res=mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

$section = '<section id="galleryBox">';
($isAdmin) ? $section .= '<form method="POST" action="adminGalerie.php" id="addButton">' . at_html_form_input("submit", "addGalerie", "Ajouter") . '</form>' : '';

while($T = mysqli_fetch_assoc($res))
{
    $tabInfo = [$T['Titre'], $T['Date'], $T['Technique'], $T['Hauteur'], $T['Largeur'], $T['Collection'], $T['Crédit_Photographique'], $T['Remarques']];
    $section .= '<figure><img ';
    ($T['id'] == 11) ? $section .= 'id="num11"': $section;
    ($T['Hauteur'] <= $T['Largeur']) ? $section .= 'class="imgH"' : $section .= 'class="imgV"';
    $section .= ' src="../images/Oeuvres/' . $T['id'] . '.jpg" alt="image numéro :' . $T['id'] .'">' .
                    '<figcaption>';

    if ($isAdmin)
    {
        $section .= '<form method="POST" action="adminGalerie.php"><table>' .
            at_html_form_input('hidden', 'id', "{$T['id']}") .
            at_html_form_input("submit", "changeGalerie", "Modifier") .
            at_html_form_input("submit", "deleteGalerie", "Supprimer") .
            '</table></form>';
    }
    else
    {   
        $section .= '<ul>';
        ($T['Titre'] != "") ? $section .= '<li>' . $T['Titre'] .'</li>' : $section;
        ($T['Date'] != "") ? $section .= '<li>' . $T['Date'] .'</li>' : $section;
        ($T['Technique'] != "") ? $section .= '<li>' . $T['Technique'] .'</li>' : $section;
        if ($T['Hauteur'] != 0 && $T['Largeur'] != 0)
        {
            $section .= '<li>' . $T['Hauteur'] . '*' . $T['Largeur'] . 'cm</li>';
        }
        elseif($T['Hauteur'] == 0 && $T['Largeur'] != 0)
        {
            $section .= '<li>' . $T['Largeur'] . 'cm de diamètre</li>';
        }
        ($T['Collection'] != "") ? $section .= '<li>' . $T['Collection'] .'</li>' : $section;
        ($T['Crédit_Photographique'] != "") ? $section .= '<li>' . $T['Crédit_Photographique'] .'</li>' : $section;
        ($T['Remarques'] != "") ? $section .= '<li>' . $T['Remarques'] .'</li>' : $section;

        $section .= '</ul>';
    }

    $section .='</figcaption></figure>';
    
    
}

$scriptUser = '<script>
                    let figure = document.getElementsByTagName("figure");
                    for (let currentFigure = 0; currentFigure<figure.length; ++currentFigure)
                    {
                        figure[currentFigure].onclick = imgZoomed;
                    }

                    var fig, y;
                    var startX = 0;
                    var distance = 100;
                    var ifButton;

                    function startTouch(e)
                    {
                        let touches = e.changedTouches[0];
                        startX = touches.pageX;
                        fig.ontouchstart = null;
                        ifButton = e.target.id;
                    }

                    function  mvmtTouch(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        fig.ontouchmove = null;
                    }

                    function  endTouch(e)
                    {
                        let touches = e.changedTouches[0];
                        let between = touches.pageX - startX;
                        fig.ontouchend = null;

                        if (e.target.id == ifButton && ifButton == "btnPrev")   
                        {
                            prevSlide(fig, y);
                            return;
                        }
                        if (e.target.id == ifButton && ifButton == "btnNext"){
                            nextSlide(fig, y);
                            return;
                        }   

                        if(between == 0 || (between < distance && between >= 0) || (between > -distance && between <= 0) )
                        {
                            closeSlideShow(fig, y);
                            return;
                        } 

                        if(between > 0 && ( (between >= distance && between > 0) || (between <= -distance && between < 0) )) {
                            if (fig.previousElementSibling) prevSlide(fig, y);
                            return;
                        } else {
                            if (fig.nextElementSibling) nextSlide(fig, y);
                            return;
                        }

                        
                    }

                    function imgZoomed(e) 
                    {
                        fig = e.target;
                        startX = 0;

                        if (e.type != "click")
                        {
                            fig = e;
                        }
                        if (fig.tagName != "FIGURE")
                        {
                          fig = e.target.parentNode;
                        }
                        
                        y = document.documentElement.scrollTop;
                        window.scrollTo(0,0);
                        document.documentElement.style.overflow = "hidden";
                        
                        
                        fig.childNodes[0].style.display = "block";
                        fig.classList="imgZoomed";
                        
                        btnMaker("span", "\u274c", "btnClose", fig);

                        if (fig.nextElementSibling)     btnMaker("span", "\u2192", "btnNext", fig);
                        if (fig.previousElementSibling)     btnMaker("span", "\u2190", "btnPrev", fig);
                        
                        if (screen.width <= 1024)
                        {
                            fig.ontouchstart = startTouch;
                            fig.ontouchmove = mvmtTouch;
                            fig.ontouchend = endTouch;
                        }
                        else
                        {
                            fig.onclick = function(e)
                            {
                                if (e.target.tagName != "IMG")  closeSlideShow(fig, y);
                                if (e.target.id == "btnPrev")   imgZoomed(fig.previousElementSibling);
                                if (e.target.id == "btnNext")   imgZoomed(fig.nextElementSibling);
                            }
                            
                            document.onkeydown = function(event)
                            {
                                if (fig.previousElementSibling)
                                {
                                    if (event.keyCode === 37)   prevSlide(fig, y);
                                }
                            
                                if (fig.nextElementSibling)
                                {
                                    if (event.keyCode === 39)   nextSlide(fig, y);
                                }
                                if (event.keyCode === 27)   closeSlideShow(fig, y);
                            }
                        }
                    }
                    
                    function removeImgZoomed(figZoomed, y) 
                    {
                        window.scrollTo(0,y);
                        document.documentElement.style.overflow = "scroll";
                        figZoomed.classList = "";
                        document.getElementById("btnClose").remove();
                        if (figZoomed.nextElementSibling) document.getElementById("btnNext").remove();
                        if (figZoomed.previousElementSibling) document.getElementById("btnPrev").remove();
                    }
                    
                    function btnMaker(elem, textContent, id, parent)
                    {
                        let btn = document.createElement(elem);
                        btn.innerText = textContent;
                        btn.id = id;
                        parent.appendChild(btn);
                    }
                    
                    function closeSlideShow(fig, y) 
                    {
                        removeImgZoomed(fig, y);
                        fig.onclick = imgZoomed;
                    }
                    
                    function prevSlide(fig, y)
                    {
                        removeImgZoomed(fig, y);
                        fig.onclick = imgZoomed;
                        imgZoomed(fig.previousElementSibling);
                    }
                    
                    function nextSlide(fig, y) 
                    {
                        removeImgZoomed(fig, y);
                        fig.onclick = imgZoomed;
                        imgZoomed(fig.nextElementSibling);
                    }
                    
                    
                </script>';


$scriptAdmin = '<script>
                    let figure = document.getElementsByTagName("figure");
                    for (let currentFigure = 0; currentFigure<figure.length; ++currentFigure)
                    {
                        figure[currentFigure].onmouseover = imgOver;
                        
                    }
                    
                    function imgOver(e) 
                    {
                        let fig = e.target;
                        while (fig.tagName != "FIGURE")
                        {
                          fig = fig.parentNode;
                        }
                        let buttons = fig.childNodes[1];
                        buttons.style.display = "block";

                        this.onmouseout = function(){
                            buttons.style.display = "none";
                        }

                    }

                    
                    
                </script>';

$script = ($isAdmin)? $scriptAdmin : $scriptUser;

echo $section, $script;

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();

