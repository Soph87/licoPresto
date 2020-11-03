<?php
$page = 'user_client';
$css = [URLROOT . '/css/commandes.css'];
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop container">
        <div class="centerContainer recuLink">
            <a href="<?= URLROOT ?>/commandes" class="lienVert">Retour à la carte</a>
        </div>
        <div id="recu" class="recuCenter">
            <h3 class="cardTitre">Mon repas :</h3>
            <div id="listePanier"></div>
            <div id="totalPanier">Total : <span id="totalSpan">0,00µp</span></div>
            <div class="centerContainer">
                <button disabled id="validPanier" class="linkBtn">Valider</button>
            </div>
        </div>
    </section>
</main>
<?php $scripts = ['https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', URLROOT . '/js/user.js', URLROOT . '/js/commandes.js']; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>