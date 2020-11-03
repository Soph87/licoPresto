<?php
$page = 'user_client';
$css = [URLROOT . '/css/compte.css', URLROOT . '/css/forms.css'];
//lien class active dans le header :
$activeCompte = true;
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop container">
        <div class="formContainer">
            <form id="updateInfos" action="<?= URLROOT; ?>/users/compteModif" method="post">
                <div>
                    <div class="formHeader">
                        <h3>Modifier mes informations de compte</h3>
                    </div>
                    <div class="formRow">
                        <div class="formGroup">
                            <label for="prenom">Prénom</label>
                            <input type="texte" name="prenom" id="prenom" value="<?= !empty($data['prenom']) ? $data['prenom'] : "" ?>">
                            <p class="errorDisplay"><?= $data['prenom_err'] ?></p>
                        </div>
                        <div class="formGroup">
                            <label for="nom">Nom</label>
                            <input type="texte" name="nom" id="nom" value="<?= !empty($data['nom']) ? $data['nom'] : "" ?>">
                            <p class="errorDisplay"><?= $data['nom_err'] ?></p>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="adresse">Email</label>
                        <input type="email" name="email" id="email" value="<?= !empty($data['email']) ? $data['email'] : "" ?>">
                        <p class="errorDisplay"><?= $data['email_err'] ?></p>
                    </div>
                    <div class="formGroup">
                        <label for="adresse">Adresse</label>
                        <input type="texte" name="adresse" id="adresse" value="<?= !empty($data['adresse']) ? $data['adresse'] : "" ?>">
                        <p class="errorDisplay"></p>
                    </div>
                    <div class="formRow">
                        <div class="formGroup">
                            <label for="cp">Code postal</label>
                            <input type="texte" name="cp" id="cp" value="<?= !empty($data['cp']) ? $data['cp'] : "" ?>">
                            <p class="errorDisplay"></p>
                        </div>
                        <div class="formGroup">
                            <label for="ville">Ville</label>
                            <input type="texte" name="ville" id="ville" value="<?= !empty($data['ville']) ? $data['ville'] : "" ?>">
                            <p class="errorDisplay"></p>
                        </div>
                    </div>
                    <div class="centerContainer">
                        <button type="submit" class="linkBtn" id="valideAdresse">Enregistrer</button>
                        <a href="<?= URLROOT; ?>/users/monCompte" class="linkBtnVert">Annuler</a>
                    </div>
                    <?php if (isset($data['erreur'])) : ?>
                        <div class="centerContainer">
                            <p id="error"><?= $data['erreur'] ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
</main>
<?php $scripts = [URLROOT . '/js/user.js']; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>