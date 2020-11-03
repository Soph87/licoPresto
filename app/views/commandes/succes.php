<?php
$page = 'user_client';
$css = [URLROOT . '/css/forms.css', URLROOT . '/css/paiement.css'];
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop container">
        <div class="formContainer">
            <div class="card">
                <div class="formHeader">
                    <h3>Paiement validé&nbsp;!</h3>
                </div>
                <p>Le paiement de votre commande a été validé, votre repas est en route&nbsp;! Pensez à ouvrir vos volets pour que notre livreur pégase puisse vous livrer directement à votre fenêtre.</p>
                <div class="centerContainer">
                    <a href="<?= URLROOT ?>/commandes" class="linkBtn">Retour à la carte</a>
                </div>
            </div>
        </div>
        <div class="bgVert">
            <img src="<?= URLROOT ?>/images/valide-paiement.png" alt="livreur pégase" class="pegase">
        </div>
    </section>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>