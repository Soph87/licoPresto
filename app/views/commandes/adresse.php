<?php
$page = 'user_client';
$css = [URLROOT . '/css/forms.css', URLROOT . '/css/adresse.css'];
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop container">
        <div id="recapContainer" class="formContainer">
            <div class="card">
                <div class="formHeader">
                    <h3>Récapitulatif de votre commande</h3>
                </div>
                <ul id="recap">
                    <li>Panier bien vide...</li>
                </ul>
                <div id="total">
                    <p><span>TOTAL : </span><span id="totalSpanListe">00µp</span></p>
                </div>
            </div>
        </div>
        <div id="adresseContainer" class="formContainer">
            <form>
                <div>
                    <div class="formHeader">
                        <h3>Adresse de livraison</h3>
                    </div>
                    <div class="formGroup">
                        <label for="adresse">Adresse</label>
                        <input type="texte" name="adresse" id="adresse">
                        <p class="errorDisplay"></p>
                    </div>
                    <div class="formRow">
                        <div class="formGroup">
                            <label for="cp">Code postal</label>
                            <input type="texte" name="cp" id="cp">
                            <p class="errorDisplay"></p>
                        </div>
                        <div class="formGroup">
                            <label for="ville">Ville</label>
                            <input type="texte" name="ville" id="ville">
                            <p class="errorDisplay"></p>
                        </div>
                    </div>
                    <div class="formGroupCheck">
                        <input type="checkbox" name="enregistrer" id="enregistrer">
                        <label for="enregistrer">Enregistrer cette adresse comme mon adresse de livraison par défaut</label>
                    </div>
                    <div class="centerContainer">
                        <button type="submit" class="linkBtn" id="valideAdresse" disabled>Je valide cette adresse</button>
                    </div>
                    <div class="centerContainer">
                        <p id="error"></p>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php $scripts = ['https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', URLROOT . '/js/user.js', URLROOT . '/js/adresse.js']; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>