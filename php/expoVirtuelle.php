<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once 'atopac_lib.php';

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut('PATRICK CHENCINER | Expo Virtuelle', '../css/style.css', true);

at_aff_header('Expo Virtuelle');

$bd=at_bd_connect();

$sql = "SELECT * FROM ExpoVirtuelle ORDER BY Rang";
$res=mysqli_query($bd,$sql) or at_bd_erreur($bd,$sql);

$section = '<section id="galleryBox">';

while($T = mysqli_fetch_assoc($res)) {
    $section .= '<figure><img ';
    ($T['Hauteur'] <= $T['Largeur']) ? $section .= 'class="imgH"' : $section .= 'class="imgV"';
    $section .= ' src="../images/ExpoVirtuelle/' . $T['Rang'] . '.jpg" alt="image numéro :' . $T['Rang'] . '">' .
        '<figcaption>';
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

    $section .='</figcaption></figure>';
}

$script = '<script>
                    let figure = document.getElementsByTagName("figure");
                    for (let currentFigure = 0; currentFigure<figure.length; ++currentFigure)
                    {
                        figure[currentFigure].onclick = imgZoomed;
                    }
                    
                    function imgZoomed(e) 
                    {
                        let fig = e.target;
                        if (e.type != "click")
                        {
                            fig = e;
                        }
                        if (fig.tagName != "FIGURE")
                        {
                          fig = e.target.parentNode;
                        }
                        
                        let y = document.documentElement.scrollTop;
                        window.scrollTo(0,0);
                        document.documentElement.style.overflow = "hidden";
                        
                        
                        fig.childNodes[0].style.display = "block";
                        fig.classList="imgZoomed";
                        
                        btnMaker("span", "\u274c", "btnClose", fig);
                        
                        if (fig.nextElementSibling)     btnMaker("span", "\u2192", "btnNext", fig);
                        if (fig.previousElementSibling)     btnMaker("span", "\u2190", "btnPrev", fig);
                        
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

echo $section, $script;

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();

