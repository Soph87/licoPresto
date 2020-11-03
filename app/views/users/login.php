<?php
$css = [URLROOT . '/css/forms.css'];
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop">
        <h1>Identifiez-vous pour passer votre commande</h1>
        <?= flash('register_ok'); ?>
        <div class="formContainer expandForm">
            <div class="cote">
                <img src="<?= URLROOT ?>/images/miam.png" alt="licorne se léchant les babines">
            </div>
            <form action="<?= URLROOT; ?>/users/login " method="post">
                <div>
                    <div class="formGroup">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="<?= (!empty($data['email_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['email'] ?>">
                        <p class="errorDisplay"><?= $data['email_err'] ?></p>
                    </div>
                    <div class="formGroup">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="<?= (!empty($data['mdp_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['mdp'] ?>">
                        <p class="errorDisplay"><?= $data['mdp_err'] ?></p>
                    </div>
                    <div class="centerContainer">
                        <button type="submit" class="linkBtn">Je m'identifie</button>
                    </div>
                    <div class="centerContainer">
                        <p class="sousForm">Vous n'avez pas encore de compte&nbsp;? <a href="<?= URLROOT; ?>/users/register" class="lienVert">Inscrivez-vous</a></p>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>