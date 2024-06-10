<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Ajoutez les liens vers Bootstrap CSS et jQuery -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>
        /* Personnalisation du style */
body {
    background-color: white; 
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Hauteur minimale pour occuper tout l'écran */
    margin: 0; /* Supprime les marges par défaut du body */
    padding: 0; /* Supprime les paddings par défaut du body */
}

header {
    display: grid;
    grid-template-columns: auto 1fr;
    align-items: center; /* Centre verticalement les éléments */
    padding: 10px 50px;
}

#logo-img {
    max-width: 120px; 
    height: auto; 
    margin-right: 40px;
}

.nav-item {
    width: 105%;
    background-color: #549637; /* Fond vert de la barre de navigation */  
}

.navbar-nav {
    display: flex;
    list-style: none;
    padding-left: 0; /* Supprime le padding par défaut de la liste */
    margin: 0; /* Supprime la marge par défaut de la liste */
    flex: 1;
    justify-content: center;
    
}

#exeption {
    margin-left: 280px;
}

.nav-item {
    margin-right: 20px; /* Marge entre les éléments de la barre de navigation */
    border-radius: 80px;
}

.nav-link {
    font-weight: bold; /* Met le texte en gras */
    text-decoration: none; /* Supprime la décoration de texte (soulignement) */
}

.nav-link:hover {
    text-decoration: underline; /* Ajoute une décoration de texte au survol */ 
}

.navbar-collapse {
    padding-top: 5px; /* Ajuste la position de la barre de navigation vers le haut */
}

#commandez {
    padding-top: 20px;
}

.main-content {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px; /* Espace entre le texte et l'image */
    align-items: center;
    margin: 30px 50px; /* Espace autour du contenu principal */
    padding-top: 40px;
}

.main-content img {
    max-width: 90%;
    height: auto;
    border: 2px solid #549637;
    border-radius: 10px; /* Coins arrondis */
}

.text {
    text-align: left;
    font-size: 30px;
    border: none;
    border-radius: 10px; /* Coins arrondis */
    overflow: hidden; /* Cacher le contenu débordant */
    margin-left: 30px;
}

.square-container2 {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 50px; /* Espace entre le texte et l'image */
    align-items: start;
    margin: 30px 50px; /* Espace autour du contenu principal */
    padding-top: 40px;
}

.square-container2 img {
    max-width: 90%;
    height: auto;
    border: 2px solid #549637;
    border-radius: 10px; /* Coins arrondis */
}

.liste {
    margin: 10px 0 0 0;
    padding: 0;
    font-size: 30px;
}

.liste li {
    margin-bottom: 0px;
    margin-left: 50px;
}

.price {
    height: auto;
    max-width: 400px;
    margin-top: 50px;
}

.plateaux {
    margin-top: 100px;
    background-color: #549637;
    height: 470px;
    text-align: center;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: auto auto;
    gap: 20px;
    padding: 20px;
}

.price {
    width: 330px; /* Largeur du carré */
    height: 250px; /* Hauteur du carré */
    border: none;
    border-radius: 10px; /* Coins arrondis */
    overflow: hidden; /* Cacher le contenu débordant */
    background-color: #fff;
}

.prix {
    width: 200px; /* Largeur du carré */
    height: 40px; /* Hauteur du carré */
    border: none;
    border-radius: 20px; /* Coins arrondis */
    overflow: hidden; /* Cacher le contenu débordant */
    background-color: #fff;
    text-align: center;
    font-size: 25px;
    justify-self: center;
    align-self: start;
    margin-right: 60px;
}

#prix1 { grid-column: 1; grid-row: 2; }
#prix2 { grid-column: 2; grid-row: 2; }
#prix3 { grid-column: 3; grid-row: 2; }

.fruit {
    height: auto;
    max-width: 350px;
}

.carousel-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 150px;
}
.carousel {
    display: flex;
    overflow: hidden;
    width: 60%;
}
.carousel-track {
    display: flex;
    transition: transform 0.5s ease;
}
.carousel img {
    width: calc(100% / 3);
}
.carousel-button {
    width: 50px;
    height: 50px;
    background-color: #549637;
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 10px;
}

.container-main {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 150px;
}

.bienfaits-container {
    display: flex;
    flex-direction: row-reverse; /* Pour placer l'image à droite */
    align-items: flex-start; /* Aligne le contenu au début verticalement */
    margin: 30px 50px; /* Ajuste l'espace autour du contenu */
    gap: 20px; /* Espace entre l'image et le texte */
     margin-top: 50px;
}

.bienfaits {
    flex: 1;
    font-size: 19px;
    background-color: #549637;
    color: white;
    padding: 20px; /* Ajoute du padding pour un meilleur espacement interne */
    border-radius: 10px; /* Coins arrondis */
}

#liste_fruits {
    max-width: 50%; /* Ajuste la largeur de l'image */
    height: 720px;
    border: none;
    border-radius: 10px; /* Coins arrondis */
}

h1 {
    color: #549637;
    text-align: center;
}

footer {
    margin-top: 80px;
    background: #549637;
}

#insta {
    max-width: 50px; 
    height: auto; 
    padding-left: 5px;
}

#phone {
    max-width: 50px; 
    height: auto; 
}

#mon_insta, #mon_phone {
    color: white;
}

    </style>
</head>
<body>
   
<header>
    <img src="{{ asset('images/mon-logo.png') }}" alt="logo" id="logo-img">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><b>Accueil</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#plateaux"><b>Boutique</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#blog"><b>Blog</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><b>A propos</b></a>
                </li>
                <li class="nav-item" id="exeption">
                    <a class="nav-link text-white" href="#contact"><b>Contact</b></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div>
    <article>
        <div>
            <img src="{{ asset('images/commandez.jpg') }}" alt="commande" class="img-fluid mx-auto d-block" id="commandez">
        </div>
        <div class="main-content">
            <div class="text">
                <p>Plongez dans un monde d'exotisme <br> avec nos plateaux de fruits exotiques frais : <br>
                Une symphonie de saveurs tropicales <br> pour éveiller vos papilles !</p>
                <p>Des fruits frais et savoureux <br> à chaque bouchée </p>
            </div>
            <div>
                <img src="{{ asset('images/assiettedefruitsfrais-removebg-preview.png') }}" alt="Image carré" class="img-fluid">
            </div>
        </div>
    </article>

    <div class="square-container2">
        <img src="{{ asset('images/assiettedefruitsfrais-removebg-preview.png') }}" alt="Image carré" id="plateau1" class="img-fluid mx-auto d-block">
        <div>
            <ul class="liste">
                <li>Pommes</li>
                <li>Oranges</li>
                <li>Kiwi</li>
                <li>Raisins</li>
                <li>Fraises</li>
                <li>Prunes</li>
                <li>Framboises</li>
                <li>Figues</li>
            </ul>
        </div>
    </div>

    <div class="plateaux" id="plateaux">
        <img class="price" src="{{ asset('images/plateau1-removebg-preview.png') }}" alt="1" id="plateaux1" class="img-fluid mx-auto d-block">
        <img class="price" src="{{ asset('images/plateau1-removebg-preview.png') }}" alt="2" id="plateaux2" class="img-fluid mx-auto d-block">
        <img class="price" src="{{ asset('images/plateau1-removebg-preview.png') }}" alt="3" id="plateaux3" class="img-fluid mx-auto d-block">

        <p class="prix" id="prix1"> 15 OOO CFA</p>
        <p class="prix" id="prix2"> 20 OOO CFA</p>
        <p class="prix" id="prix3"> 25 OOO CFA</p>
    </div>

    <div class="container mt-5">
    <div class="carousel-container">
        <button class="carousel-button" onclick="previous()">&#9204;</button>
        <div class="carousel">
            <div class="carousel-track" id="carousel-track">
            <img src="{{ asset('images\kiwi.jpeg') }}" alt="kiwi" id="kiwi" class="fruit">
            <img src="{{ asset('images\fraise.jpeg') }}" alt="fraise" id="fraise" class="fruit">
            <img src="{{ asset('images\fruit-de-la-passion.png') }}" alt="fruit-de-la-passion" id="fruit-de-la-passion" class="fruit">
            <img src="{{ asset('images\pitaya.jpg') }}" alt="pitaya" id="pitaya" class="fruit">
            <img src="{{ asset('images\ananas.jpg') }}" alt="ananas" id="ananas" class="fruit">
            <img src="{{ asset('images\framboises.jpg') }}" alt="framboise" id="framboise" class="fruit">
            <img src="{{ asset('images\banane.jpg') }}" alt="banane" id="banane" class="fruit">
            <img src="{{ asset('images\Figue.png') }}" alt="figue" id="figue" class="fruit">
            <img src="{{ asset('images\myrtille.jpeg') }}" alt="myrtille" id="myrtille" class="fruit">
            <img src="{{ asset('images\orange.jpg') }}" alt="orange" id="orange" class="fruit">
            <img src="{{ asset('images\pasteque.jpg') }}" alt="pasteque" id="pasteque" class="fruit">
            <img src="{{ asset('images\Peche.jpg') }}" alt="peche" id="peche" class="fruit">
            <img src="{{ asset('images\cerises.jpg') }}" alt="cerise" id="cerise" class="fruit">
            <img src="{{ asset('images\pommes.jpg') }}" alt="pomme" id="pomme" class="fruit">
            <img src="{{ asset('images\raisin.jpg') }}" alt="raisin" id="raisin" class="fruit">
            <img src="{{ asset('images\prune.jpeg') }}" alt="prune" id="prune" class="fruit">
            </div>
        </div>
        <button class="carousel-button" onclick="next()">&#9205;</button>
    </div>
</div>


    <script>
            let currentIndex = 0;
    const track = document.getElementById('carousel-track');
    const images = document.querySelectorAll('.carousel img');
    const totalImages = images.length;
    const visibleImages = 3; // Nombre d'images visibles à la fois

    function updateCarousel() {
        const offset = currentIndex * -(100 / visibleImages);
        track.style.transform = `translateX(${offset}%)`;
    }

    function next() {
        if (currentIndex < totalImages - visibleImages) {
            currentIndex++;
            updateCarousel();
        }
    }

    function previous() {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    }

</script>

<div class="container-main">
    <h1 id="blog">Bienfaits des fruits</h1>
    <div class="bienfaits-container">
        <img src="{{ asset('images/liste_de_fruits.jpg') }}" alt="liste_fruits" id="liste_fruits">
        <div class="bienfaits">
            <p class="bienfait">
                <br>Bien sélectionnés et consommés aux bons moments, les fruits contribuent au maintien de l'énergie, 
                de la vigilance et de l'efficacité au travail. Gorgés d'eau, de vitamines, d'oligo-éléments ou encore 
                de fibres, ils apportent à l'organisme des éléments indispensables à son bon fonctionnement. <br>
                Leurs apports soutiennent la concentration, agissent sur la fatigue musculaire, la vision, le stress 
                et la fatigue.
            </p>
            <p class="bienfait">
                Vous êtes peut-être parfois sujet à l'hypoglycémie, il s'agit d'un manque d'apport de sucre dans le sang
                et principalement dans le cerveau : avez-vous pensé qu'une délicieuse pomme croquée en milieu de matinée 
                pourrait vous éviter un épisode de ce type tout en vous rassasiant et en vous apportant des vitamines
                jusqu'au déjeuner ?
            </p>
            <p class="bienfait">
                Les fruits agissent aussi bénéfiquement sur votre organisme grâce à leurs apports en antioxydants, 
                en fibres… Leur consommation permet de limiter les risques de cancers et les maladies cardio-vasculaires. 
                Ils sont recommandés par le PNNS (Plan National Nutrition Santé), avec les légumes il faudrait en 
                consommer au minimum cinq par jour.
            </p>
        </div>
    </div>
</div>

    

    <footer id="contact">
        <p>
        <br> <img src="{{ asset('images\instagram.png') }}" alt="insta" id="insta">
         <a href="https://www.instagram.com/matachougueye?igsh=ZHFidTV3eG8xeTll" id="mon_insta">: &nbsp; https://www.instagram.com/matachougueye?igsh=ZHFidTV3eG8xeTll</a>
        </p>
        <p>
        <img src="{{ asset('images\phone.png') }}" alt="phone" id="phone">
        <span id="mon_phone">: &nbsp; +221 771915757</span>
        </p>
    </footer>

</body>
</html>
