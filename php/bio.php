<?php

ob_start(); // démarre la bufferisation
session_start(); // démarre une nouvelle session ou reprend une session existante

require_once "atopac_lib.php";

error_reporting(E_ALL); // toutes les erreurs sont capturées (utile lors de la phase de développement)

at_aff_debut("PATRICK CHENCINER PEINTURE | Bio", "../css/style.css", true);

at_aff_header('bio');

echo '<section id="bcBio">',
        '<h1>BIO</h1>
        <h2><span>&#x27A4;</span> REPÈRES BIOGRAPHIQUES :</h2>
        <ul style="display : none;">
            <li class="illustrationV">
                <figure>
                    <img src="../images/Patrick_Chenciner.jpg" alt="Photo de Patrick Chenciner"/>
                    <figcaption>Patrick Chenciner, novembre 2013.<br>Crédit photographique : M. E.</figcaption>
                </figure>
            </li>
            <li>1950 : Naissance à Berlin</li>
            <li>Enfance à Berlin, Baden-Baden et Strasbourg</li>
            <li>1968 : Installation à Besançon</li>
            <li>1968-1974 : École de Beaux-Arts de Besançon (diplôme des Beaux-Arts, section peinture, atelier Jean Ricardon)</li>
            <li>1976-1980 : Faculté des lettres et sciences humaines (sections histoire et histoire de l’art, maîtrise d’histoire de l’art)</li>
            <li>2015 : Décès à Besançon</li>
        </ul>
        <h2><span>&#x27A4;</span>️ EXPOSITIONS PERSONNELLES :</h2>
            <ul style="display : none;">
                <li class="illustrationV">
                    <figure>
                        <img src="../images/expo_MJC_Arbois-1989.jpg" alt="Affiche de l\'exposition d\'arbois en 1989"/>
                        <figcaption>1989</figcaption>
                    </figure>
                </li>
                <li>1989 : MJC Arbois</li>
                <li>1998 : FJT Les Oiseaux, Besançon</li> 
                <li>2000 : FJT Les Oiseaux, Besançon</li> 
                <li>2004 : FJT Les Oiseaux, Besançon</li> 
                <li>2006 : FJT Les Oiseaux, Besançon</li> 
                <li>2007 : FJT Les Oiseaux, Besançon</li> 
                <li>2008 : Librairie Passerelle, Dole</li> 
                <li>2010 : Espace 13-15 rue de la Préfecture, Galerie du Conseil Général du Doubs, Besançon<br>FJT Les Oiseaux, Besançon</li> 
                <li>2013 : Restaurant Le Pixel, Cité des Arts, Besançon</li> 
                <li>2014 : FJT Les Oiseaux, Besançon</li>
                <li class="illustrationT">
                    <figure>
                        <img src="../images/FJT_Les_Oiseaux-Besançon-6_2004.jpg" alt="Peinture en exposition à Besançon en 2004"/>
                        <figcaption>Exposition, FJT Les Oiseaux, Besançon, juin 2004</figcaption>
                    </figure>
                </li>
                <li class="illustrationT">
                    <figure>
                        <img src="../images/FJT_Les_Oiseaux-Besançon-2_2006.jpg" alt="Peinture en exposition à Besançon en 2006"/>
                        <figcaption>Exposition, FJT Les Oiseaux, Besançon, février 2006</figcaption>
                    </figure>
                </li>
                <li class="illustrationT">
                    <figure>
                        <img src="../images/rue_de_la_Préfecture-Besançon-2_2010.jpg" alt="Peinture en exposition à Besançon en 2010"/>
                        <figcaption>Exposition, Espace 13-15 rue de la Préfecture, Galerie du Conseil Général du Doubs, Besançon</figcaption>
                    </figure>
                </li>
            </ul>',
        '<h2><span>&#x27A4;</span>️ EXPOSITIONS COLLECTIVES :</h2>
            <ul class="allWidth" style="display : none;">
                <li><span class="bold">1973-1990-1999 et d’autres années</span>
                    <ul>
                        <li>Salon des Annonciades, Pontarlier</li>
                    </ul>
                </li>
                <li><span class="bold">1981</span>
                    <ul>
                        <li>Art mystique contemporain, Logis du Coudray, Saint-Martin-du-Bois, Maine-et-Loire</li>
                        <li>Chapelle Saint Étienne, Citadelle de Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">1982</span>
                    <ul>
                        <li>Jean-Claude Bonnet invite, Musée des Beaux-Arts, Besançon</li>
                        <li>Besançon Cluny, Écuries de Saint-Hugues, Abbaye de Cluny</li>
                        <li>Tendances de la peinture figurative contemporaine, Forum des Cholettes, Sarcelles, M.J.C. Les Hauts de Belleville, Paris, Centre culturel Pierre Bayle, Besançon, Musée de Belfort</li>
                    </ul>
                </li>
                <li><span class="bold">1985</span>
                    <ul>
                        <li>Printemps 1985 : Art contemporain, Espace Delpha, Paris</li>
                        <li>Automne 1985 : Espace Delpha, Cabinet des dessins, Paris</li>
                    </ul>
                </li>
                <li><span class="bold">1986</span>
                    <ul>
                        <li>CROMA expose, Chapelle Saint Étienne, Citadelle de Besançon</li>
                        <li>Galerie La Cimaise, Besançon</li>
                    </ul> 
                </li>
                <li><span class="bold">1987</span>
                    <ul>
                        <li>CROMA expose, Chapelle Saint Étienne, Citadelle de Besançon</li>
                        <li>Galerie La Cimaise, Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">1988</span>
                    <ul>
                        <li>Château de Sartirana, Pavie</li>
                    </ul>
                </li>
                <li><span class="bold">1989</span>
                    <ul>
                        <li>Attention ! Peinture fraîche, Parking des Sapins, Les Rousses</li>
                    </ul>
                </li>
                <li><span class="bold">1990</span>
                    <ul>
                        <li>Art en Franche-Comté 80/90, Château de Roche sur Loue, Arc et Senans</li>
                        <li>Œuvres en dépôt à la galerie Denise René, Paris</li>
                    </ul>
                </li>
                <li><span class="bold">1991</span>
                    <ul>
                        <li>1er Salon de l’Arche, Chapelle de la Visitation, Dole</li>
                    </ul>
                </li>
                <li><span class="bold">1994</span>
                    <ul>
                        <li>24 peintres de l’École des Beaux-Arts de Besançon 1954-1984, Éditions Cêtre, Hôtel Jouffroy, Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">1996</span>
                    <ul>
                        <li>Salon des Réalités Nouvelles, Espace Eiffel-Branly, Paris</li>
                        <li>Galerie Le Faisant, Strasbourg</li>
                        <li>Franche-Comté, terre d’artistes…, Micropolis, Besançon</li>
                        <li>200 artistes, Salle Lacazette, Paris</li>
                    </ul>
                </li>
                <li><span class="bold">1997</span>
                    <ul>
                        <li>Galerie G, Besançon</li>
                        <li>Art Construit-Art Concret, I.U.F.M., Besançon</li>
                        <li>Abstraction – Intégration. L’Art abstrait construit contemporain, exposition     itinérante en Essonne</li>
                    </ul>
                </li>
                <li><span class="bold">1998</span>
                    <ul>
                        <li>Ateliers ouverts, Rue de l’École, Besançon</li>
                        <li>Encore une histoire de noir et blanc, Groupe RADICAL, Grenoble</li>
                    </ul>
                </li>
                <li><span class="bold">1999</span>
                    <ul>
                        <li>6 artistes plasticiens résidant en Franche-Comté, Musée des Beaux-Arts et d’Archéologie, Besançon</li>
                        <li>Ateliers ouverts 99, Rue de l’École, Besançon</li>
                        <li>Aspects de l"art contemporain en Franche-Comté, I.U.F.M., Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">2002-2003</span>
                    <ul>
                        <li>Quand Victor Hugo Inspire Les Artistes, I.U.F.M., Besançon ; Lausanne</li>
                    </ul>
                </li>
                <li><span class="bold">2003-2005-2007-2009-2011-2013-2015</span>
                    <ul>
                        <li>Biennale des Arts plastiques en Franche-Comté, Micropolis, Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">2005</span>
                    <ul>
                        <li>Logic art, I.U.F.M., Besançon</li>
                        <li>Association d’artistes Grigri l’antigris, Galerie de l’Ancienne Poste, Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">2010</span>
                    <ul>
                        <li>MAC3, Ateliers des Grands Moulins, Dole</li>
                        <li>art abstrait construit concret géométrique, Galerie Jean Greset, Besançon</li>
                        <li>art abstrait concret, Le Gymnase - espace culturel, I.U.F.M., Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">2011</span>
                    <ul>
                        <li>MAC3, Librairie Passerelle, Dole</li>
                    </ul>
                </li>
                <li><span class="bold">2015</span>
                    <ul>
                        <li>Salon Intemporel, Galerie Jean Greset, Micropolis, Besançon</li>
                    </ul>
                </li>
                <li><span class="bold">2019</span>
                    <ul>
                        <li>Transparence. Dedans dehors, Maison Verrière, Montfaucon-La Malate, Marcel Baty architecte</li>
                    </ul>
                </li>
            </ul>',


        '<h2><span>&#x27A4;</span> BIBLIOGRAPHIE :</h2>
            <ul class="allWidth" style="display : none;">
                <li>Patrick Chenciner (illustrations) et alii, La Tradition franc-comtoise, éditions Mars et Mercure, Wettolsheim,1979.</li>
                <li>Patrick Chenciner, Deux générations de peintres à Besançon. Texte et documents, Mémoire de maîtrise d’Histoire des Arts, Université de Besançon, Faculté des Lettres et Sciences Humaines, 1980.</li>
                <li>François Devalière, Art mystique contemporain, catalogue d’exposition, Logis du Coudray, Saint-Martin-du-Bois, Maine-et-Loire, 1981.</li>
                <li>Baudin-Lecointre  Chenciner  Fumagalli  Janin  Moglia. Peintures, catalogue d’exposition, Chapelle Saint Étienne, Citadelle de Besançon, 1981.</li>
                <li>Tendances de la peinture figurative contemporaine, catalogue d’exposition, Les Hauts de Belleville, Paris, 1982, textes de Gérard Xuriguera et Francis Parent.</li>
                <li>Besançon Cluny, plaquette d’exposition, Ecuries de Saint-Hugues, Abbaye de Cluny, 1982.</li>
                <li>Gérard Xuriguera, Regard Sur la Peinture Contemporaine : la création picturale de 1945 à nos jours, éditions Arted, Paris, 1983.</li>
                <li>Brigitte Bouvier, Les Jeunes peintres et les Bisontins, Mémoire de maîtrise d’Histoire des Arts, Université de Besançon, Faculté des Lettres et Sciences Humaines, 1985.</li>
                <li>Gérard Xuriguera, Les figurations de 1960 à nos jours, éditions Mayer, Paris, 1985.</li>
                <li>Gérard Xuriguera, Le Dessin dans l"art contemporain, éditions Mayer, Paris, 1987, notice de Jean-François Girard.</li>
                <li>Carte blanche à CROMA, catalogue d’exposition, Centre d’arts contemporains, Besançon, 1987.</li>
                <li>Marina de Stasio, Geneviève Hartmann-Bonnet, Arte Oggi-Pittori, scultori francesi e italiani al Castello di Sartirana, catalogue d"exposition, Vangelista editori, Milan, 1988.</li>
                <li>Art en Franche-Comté 80/90, catalogue d’exposition, Château de Roche sur Loue, Arc et Senans.</li>
                <li>«L’Art et la manière», Vu du Doubs, magazine départemental, p. 32, automne 1990.</li>
                <li>Salon des Réalités Nouvelles, catalogue d’exposition, Paris, 1996.</li>
                <li>Chantal Duverget, Franche-Comté, terre d’artistes…, plaquette d’exposition, Micropolis, Besançon, 1996.</li>
                <li>Abstraction – Intégration. L’Art abstrait construit contemporain, catalogue d’exposition, Conseil Général de l’Essonne, sans date (1997).</li>
                <li>Encore une histoire de noir et blanc, catalogue d’exposition, Groupe RADICAL, Grenoble - St. Martin-d’Hères, 1998.</li>
                <li>6 artistes plasticiens résidant en Franche-Comté, catalogue d’exposition, Musée des Beaux-Arts et d’Archéologie, Besançon, 1999.</li>
                <li>Aspects de l\'art contemporain en Franche-Comté, catalogue d"exposition, I.U.F.M., Besançon, 1999.</li>
                <li>Quand Victor Hugo inspire les artistes, catalogue d"exposition, I.U.F.M., Besançon, 2002.</li>
                <li>Jacques Rittaud-Hutinet, Chantal Leclerc, Encyclopédie des arts en Franche-Comté, éditions La Taillanderie, Lyon, 2004.</li>
                <li>Patrick Chenciner, Maigret et Pascal Casagrande, roman parodique d’après Georges Simenon, auto-édité, début des années 2000.</li>
                <li>Annick Greffier-Richard, « Les peintures artistiques de Patrick Chenciner à la salle paroissiale. La géométrie et le rêve de l’infini », Si Andelot m’était Comté, Journal annuel réalisé par le Foyer Rural d’Andelot, Jura, 2016.</li>
                <li class="illustrationT">
                    <figure>
                        <img src="../images/exposition_Citadelle_de_Besançon-1981.jpg" alt="Catalogue d’exposition, Chapelle Saint Étienne, Citadelle de Besançon, 1981"/>
                        <figcaption>Catalogue d’exposition, Chapelle Saint Étienne, Citadelle de Besançon, 1981</figcaption>
                    </figure>
                </li>
                <li class="illustrationT">
                    <figure>
                        <img src="../images/exposition_grenoble.jpg" alt="Catalogue d’exposition, Encore une histoire en noir et blanc, Groupe RADICAL, Grenoble, 1998"/>
                        <figcaption>Catalogue d’exposition, <strong>Encore une histoire en noir et blanc</strong>, Groupe RADICAL, Grenoble, 1998</figcaption>
                    </figure>
                </li>
                <li>
                    <figure style="text-align: center">
                        <img src="../images/Jazz_en_Franche-Comté_2000.jpg" alt="Affiche Jazz en Franche-Comté 2000" width="25%"/>
                    </figure>
                </li>
                <li>Autre : Nounours Attitude, site internet humoristique créé par Patrick Chenciner : <a href="http://myriam.erouart.free.fr">ici</a></li>
            </ul>',


        '<h2><span>&#x27A4;</span>️ PARCOURS ARTISTIQUE :</h2>

            <div id="parcoursArtistique" style="display : none;">
                <h3>Dans son site internet tel qu’il existait en 2015, Patrick Chenciner divisait schématiquement son parcours artistique en cinq périodes :</h3>
                <ul>
                    <li>
                        <a href="galerie.php"><h4>Figuration - 1970-1982</h4></a>
                        <p>
                            Représentation de personnages géométriques et anatomiques, constituant le fond du travail de peinture qui a suivi. 
                            Reste aujourd’hui de ces figures certaines formes et certains mouvements.<br>
                            Les personnages deviennent de plus en plus importants, au point de couvrir toute la peinture, le fond étant un simple socle où sont posés les volumes. 
                            Les trois couleurs composant les faces du volume se simplifient ensuite pour montrer une troisième couleur qui est celle du fond. <br>
                            Ainsi, un cube comportera deux couleurs, suffisantes pour marquer le volume, et en même temps utiles pour ne pas trop souligner ce volume de manière à voir non plus un volume, mais deux surfaces.
                        </p>
                    </li>
                    <li class="illustrationH">
                    <figure>
                        <img src="../images/Oeuvres/3.jpg" alt="image n°3 de la galerie"/>
                    </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/13.jpg" alt="image n°13 de la galerie"/>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/15.jpg" alt="image n°15 de la galerie"/>
                        </figure>
                    </li>
                    <li>
                        <a href="galerie.php"><h4>Transition 1 - 1983-1986</h4></a>
                        <p>
                            Les volumes apparaissent de plus en plus, toujours liés à l’architecture anatomique dans un reste de figuration. On reconnait plus ou moins les gestes. Le fond a tendance à s’unifier.
                        </p>
                    </li>
                    <li class="illustrationH">
                    <figure>
                        <img src="../images/Oeuvres/19.jpg" alt="alt="image n°19 de la galerie""/>
                    </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/24.jpg" alt="image n°24 de la galerie"/>
                        </figure>
                    </li>
                    <li>
                        <a href="galerie.php"><h4>Volumes - 1986-1990</h4></a>
                        <p>
                            Les volumes sont la partie prépondérante des figures. On ne reconnaît plus forcément les personnages formés par les volumes, mais les poses de départ restent les mêmes. 
                            Le fond n’existe que sous forme de grands pans colorés servant à activer les volumes. Le travail est à présent préparé sous forme de petites gouaches servant d’études.
                        </p>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/26.jpg" alt="image n°26 de la galerie"/>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/36.jpg" alt="image n°36 de la galerie"/>
                        </figure>
                    </li>
                    
                    </li>
                    <li>
                        <a href="galerie.php"><h4>Transition 2 - 1990-1993</h4></a>
                        <p>
                            La transition entre une peinture faite de volumes et un travail à base de simples plans ne s’est faite que difficilement. Il semblait que la peinture perdait de sa complexité, de sa rareté. 
                            Malgré tout, le fait de se limiter aux plans, c’est-à-dire de produire une peinture à deux dimensions, était une nécessité pour un travail qui, en fin de compte, recherchait une sorte d’abstraction. 
                            Il y a donc eu de faux volumes, où par exemple le troisième côté avait la couleur du fond.
                        </p>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/46.jpg" alt="image n°46 de la galerie"/>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/54.jpg" alt="image n°54 de la galerie"/>
                        </figure>
                    </li>
                    <li>
                        <a href="galerie.php"><h4>Plans - À partir de 1993</h4></a>
                        <p>
                            La peinture est maintenant constituée de plans juxtaposés, pour un travail de composition. La perspective est absente, les plans s’entrecroisent pour former une moyenne de plans uniques, les uns étant sous et sur les autres.
                            Les volumes ne sont pas absolument absents, et peuvent ressurgir pour un besoin de composition.
                        </p>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/72.jpg" alt="image n°72 de la galerie"/>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/106.jpg" alt="image n°106 de la galerie"/>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/111.jpg" alt="image n°111 de la galerie"/>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Oeuvres/122.jpg" alt="image n°122 de la galerie"/>
                        </figure>
                    </li>
                    <p style="clear:both;"></p>
                    <li class="illustrationT">
                        <figure>
                            <img src="../images/atelier_illustration_bio_1.jpg" alt="image de l\'atelier n°1"/>
                            <figcaption>L’atelier, 7 rue de l’École, Besançon, 8 avril 2004.</figcaption>
                        </figure>
                    </li>
                    <li class="illustrationT">
                        <figure>
                            <img src="../images/atelier_illustration_bio_2.jpg" alt="image de l\'atelier n°2"/>
                            <figcaption>L’atelier, 7 rue de l’École, Besançon, 7 octobre 2006.</figcaption>
                        </figure>
                    </li>
                    <li class="illustrationT">
                        <figure>
                            <img src="../images/atelier_illustration_bio_3.jpg" alt="image de l\'atelier n°3"/>
                            <figcaption>L’atelier, 7 rue de l’École, Besançon, 30 décembre 2013.</figcaption>
                        </figure>
                    </li>
                    <li class="illustrationT">
                        <figure>
                            <img src="../images/Boîte_ondes_Martenot_Années_2000-1.jpg" alt="image pratique des arts appliqués"/>
                            <figcaption>Maquette de boîte d’ondes Martenot, années 2000</figcaption>
                        </figure>
                    </li>
                    <li class="illustrationT">
                        <figure>
                            <img src="../images/huile_sur_MDF.jpg" alt="huile sur MDF"/>
                            <figcaption>Huile sur MDF, 240 x 300 cm, c. 2008, collection particulière</figcaption>
                        </figure>
                    </li>
                    <li class="illustrationH">
                        <figure>
                            <img src="../images/Logo_Michel_Morel.jpg" alt="Logo de Michel Morel"/>
                        </figure>
                    </li>
                    
                    
                </ul>
            </div>',
        '</section>
        <script>
            let tableOfH2 = document.getElementsByTagName("h2");
            for (let currentH2 = 0; currentH2<tableOfH2.length; ++currentH2)
            {
                tableOfH2[currentH2].onclick = function(e) 
                {
                    let h2 = e.target;
                    if (e.target.tagName == "SPAN")
                    {
                        h2 = e.target.parentNode;
                    }
                    console.log(h2);
                    let tag = h2.nextElementSibling;
                    if (tag.style.display=="none")
                    {
                        tag.style.display = "block";
                        h2.firstChild.className = "flecheBas";
                    }
                    else
                    {
                        tag.style.display = "none";
                        h2.firstChild.className = "";
                    }
                }
            }
        </script>';

at_aff_fin();

// facultatif car fait automatiquement par PHP
ob_end_flush();

