<?php
$page = 'user_client';
$css = [URLROOT . '/css/commandes.css'];
//lien class active dans le header :
$activeCarte = true;
require APPROOT . '/views/inc/header.php';
?>
<main id="commandes" data-user="<?= $_SESSION['id'] ?>" data-url="<?= URLROOT; ?>">
    <section class="sectionTop container">
        <div class="centerContainer">
            <h2>Bonjour <?= $_SESSION['prenom'] ?>&nbsp;! Qu'allez-vous manger aujourd'hui&nbsp;?</h2>
        </div>
        <div id="carteContainer">
            <div id="carte">
                <?php foreach ($data['plats'] as $plat) : ?>
                    <div class="cardPlat">
                        <div class="cardHaut">
                            <img src="<?= URLROOT; ?>/images/<?= $plat->image ?>" alt="<?= $plat->nom ?>">
                            <h3 class="cardTitre"><?= $plat->nom ?></h3>
                        </div>
                        <p class="cardPrix"><?= $plat->prix ?>,00 µp</p>
                        <form>
                            <div class="inputContainer">
                                <button class="qttMoins qttBtn">-</button>
                                <input class="inputsNumber" type="number" name="qtt" id="qtt" min="1" max="10" value="1">
                                <button class="qttPlus qttBtn">+</button>
                            </div>
                            <button class="btnForm" data-id="<?= $plat->id ?>" data-nom="<?= $plat->nom ?>" data-prix="<?= $plat->prix ?>" data-img="<?= URLROOT; ?>/images/<?= $plat->image ?>">Ajouter</button>
                        </form>

                    </div>
                <?php endforeach; ?>
            </div>
            <div id="recu" class="cacheRecu">
                <h3 class="cardTitre">Mon repas :</h3>
                <div id="listePanier"></div>
                <div id="totalPanier">Total : <span id="totalSpan">0,00µp</span></div>
                <div class="centerContainer">
                    <button disabled id="validPanier" class="linkBtn">Valider</button>
                </div>
            </div>
        </div>
    </section>
    <div id="navCmd">
        <div>
            <p>Total : <span>0</span></p>
            <button disabled id="validPanierResponsive" class="linkBtn">Valider</button>
        </div>
    </div>
</main>
<?php $scripts = ['https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', URLROOT . '/js/user.js', URLROOT . '/js/commandes.js']; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>