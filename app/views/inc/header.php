<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://licopresto.sophie-roche.fr/" />
    <meta property="og:title" content="LicoPresto" />
    <meta property="og:description" content="LicoPresto, le foodtruck qui murmure à l'estomac des licornes !" />
    <meta property="og:image" content="<?= URLROOT; ?>/images/illu-rs.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://licopresto.sophie-roche.fr/" />
    <meta property="twitter:title" content="LicoPresto" />
    <meta property="twitter:description" content="LicoPresto, le foodtruck qui murmure à l'estomac des licornes !" />
    <meta property="twitter:image" content="<?= URLROOT; ?>/images/illu-rs.png" />

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/style.css">
    <?php if (isset($css)) : ?>
        <?php foreach ($css as $style) : ?>
            <link rel="stylesheet" href="<?= $style ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($page) && $page === 'accueil') : ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <?php endif; ?>


    <title><?= SITENAME; ?></title>
</head>

<body>
    <header id="monHeader" data-user="<?= isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>" data-url="<?= URLROOT; ?>">
        <div>
            <a href="<?= URLROOT ?>" id="logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50">
                    <path d="M33.7 30.9c-0.4 0-0.8 0.1-0.8 0.3 0 0.5 1.3 1.3 1.3 4s-2.7 4.9-6.2 4.9c-2.8 0-5.2-2.5-8.2-4.5 1.2-2.9 3.3-8.3 5.3-13.3 6-0.9 10.8-5.8 11.4-10.9 2.5-2.1 9-7.6 9.2-7.7 0.4-0.2 0.5-0.6-0.5-0.4C44.7 3.4 37.2 5.1 35 5.6c-0.9-1-2.2-1.5-3.7-1.5 -3.1 0-5.6 2.1-7.2 5.5 -0.5 1.1-1.7 4.1-3.1 7.6 -3.8-1.2-7.1-3.9-11.3-3.9 -5.4 0-9.8 4.1-9.8 9.2 0 4.6 2.7 8.6 7.3 8.6 2.1 0 5.1-1.4 5.1-3.5 0-1.1-0.9-1.9-0.9-1.5 0 0.6-0.6 1.2-1.3 1.2 -1.3 0-1.9-1.3-1.9-2.5 0-1.6 2-3.4 4.5-3.4 2.3 0 4 0.5 6.4 0.8 -1.7 4.5-3.4 8.9-4.3 11.2 -0.6-0.1-1.3-0.2-1.9-0.2 -4.5 0-7.9 2.9-7.9 7 0 3.4 2.5 6 5.1 6 1.6 0 2-0.4 2-0.5 0-0.1-0.5-0.5-0.5-1.5 0-1.2 1.3-4.4 5.5-4.4 5.1 0 9.7 7 15.8 7 4.8 0 8.5-3.4 8.5-8C41.3 34.9 38.2 30.9 33.7 30.9zM32 8.4c0.6 0 0.7 0.6 0.7 1.3 0 2-1.6 6.4-5.6 7.7 1.3-3.1 2.2-5.6 2.6-6.4C30.1 9.8 30.9 8.4 32 8.4z" />
                    <path d="M49.9 25.4l-3.3-4.3 3.3-3.9c0.2-0.2 0-0.5-0.3-0.4l-5.1 1.6 -3.7-4.8c-0.1-0.2-0.4-0.1-0.4 0.1L40 19.8l-5.2 1.6c-0.2 0.1-0.2 0.4 0 0.5l5 1.3 -0.4 6c0 0.2 0.3 0.4 0.4 0.2l4.2-5 5.7 1.5C49.9 25.9 50.1 25.6 49.9 25.4z" />
                </svg>
            </a>
            <div id="navContainer">
                <?php if (isset($page) && $page === 'accueil') : ?>
                    <nav class="navHome">
                        <a href="<?= URLROOT ?>#hero" class="linkNav" data-nav="hero">Accueil</a>
                        <a href="<?= URLROOT ?>#menu" class="linkNav" data-nav="menu">Nos plats</a>
                        <a href="<?= URLROOT ?>#carte" class="linkNav" data-nav="carte">Localisation</a>
                        <a href="<?= URLROOT ?>#livraison" class="linkNav" data-nav="livraison">Livraison</a>
                    </nav>
                    <?php if (isset($_SESSION['prenom'])) : ?>
                        <a href="<?= URLROOT ?>/commandes" class="linkBtn">Mon compte</a>
                    <?php else : ?>
                        <a href="<?= URLROOT ?>/users/login" class="linkBtn">Connexion</a>
                    <?php endif; ?>
                <?php elseif (isset($page) && $page === 'user_client') : ?>
                    <nav>
                        <a href="<?= URLROOT ?>/commandes" class="<?= (isset($activeCarte)) ? 'navActive' : ''; ?>">La carte</a>
                        <a href="<?= URLROOT ?>/users/monCompte" class="<?= (isset($activeCompte)) ? 'navActive' : ''; ?>">Mon compte</a>
                    </nav>
                    <a href="<?= URLROOT ?>/users/logout" class="linkBtnVert">Déconnexion</a>
                    <a href="<?= URLROOT ?>/commandes/afficheCmd" class="linkBtn btnPanierHeader" id="panierBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                            <path d="M90.74,34.48H89.3L81.67,18.6a11.56,11.56,0,0,0-10.84-7.4H67.26a9.72,9.72,0,0,0-9.5-7.76H42.24a9.72,9.72,0,0,0-9.5,7.76H29.16a11.42,11.42,0,0,0-10.71,7.13L10.7,34.48H9.26A7.77,7.77,0,0,0,1.5,42.24v3.88a7.76,7.76,0,0,0,4.58,7.07L15.4,88.9a11.67,11.67,0,0,0,10.94,7.66H73.66a11.77,11.77,0,0,0,11-8l9.21-35.36a7.77,7.77,0,0,0,4.58-7.07V42.24A7.77,7.77,0,0,0,90.74,34.48ZM42.24,11.2H57.76a1.94,1.94,0,1,1,0,3.88H42.24a1.94,1.94,0,0,1,0-3.88ZM25.56,21.42A3.83,3.83,0,0,1,29.16,19H34.5a9.68,9.68,0,0,0,7.74,3.88H57.76A9.68,9.68,0,0,0,65.5,19h5.33a4,4,0,0,1,3.72,2.72l6.14,12.8H19.3ZM9.26,42.24H90.74v3.88H9.26Zm68.05,44a3.9,3.9,0,0,1-3.65,2.55H26.34a3.85,3.85,0,0,1-3.54-2.21L14.28,53.88H85.72Z" />
                            <path d="M32.54,84.92A3.88,3.88,0,0,0,36.42,81V61.64a3.88,3.88,0,0,0-7.76,0V81A3.88,3.88,0,0,0,32.54,84.92Z" />
                            <path d="M51.94,84.92A3.88,3.88,0,0,0,55.82,81V61.64a3.88,3.88,0,0,0-7.76,0V81A3.88,3.88,0,0,0,51.94,84.92Z" />
                            <path d="M71.34,84.92A3.88,3.88,0,0,0,75.22,81V61.64a3.88,3.88,0,1,0-7.76,0V81A3.88,3.88,0,0,0,71.34,84.92Z" />
                        </svg>
                        <span id="panierLength">0</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>