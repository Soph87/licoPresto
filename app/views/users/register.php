<?php
$css = [URLROOT . '/css/forms.css'];
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop">
        <h1>Pour que vous puissiez passer commande, il nous faut d'abord quelques informations</h1>
        <div class="formContainer expandForm">
            <div class="cote">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <path d="M40.55,42.66C34.18,49.32,26.87,59.29,26.87,77.4a1.5,1.5,0,0,0,3,0c0-17,6.86-26.41,12.85-32.67a1.5,1.5,0,1,0-2.17-2.07Z" />
                    <path d="M76.81,50.06c-.33-.47-.64-.94-1-1.4-.08-4.35-1.25-8.13-5.28-11.39,3.57-4,8.44-9.81,8.44-12.07a3.09,3.09,0,0,0-1.49-3c-2.37-1.3-6.22,1-12.82,5.27-1.6,1-3.23,2.06-4.82,3-1.53-3.31-4-7.64-6.7-7.64-3.06,0-4.82,5.12-5.65,8.54a26.6,26.6,0,0,0-6.73-1C36.73,30.43,29.24,31.81,27,37a1.51,1.51,0,0,0,.27,1.62l2.32,2.51c-3.66,1.08-10,3.82-11.41,10.11a1.52,1.52,0,0,0,.7,1.63l2.48,1.47A17.5,17.5,0,0,0,16.07,67a1.51,1.51,0,0,0,1.5,1.48h2.62l-1.71,2.93A1.51,1.51,0,0,0,19,73.49a1.6,1.6,0,0,0,.76.2,1.5,1.5,0,0,0,1.29-.75l3-5.19A1.49,1.49,0,0,0,22.8,65.5H19.12a14.78,14.78,0,0,1,5.64-10.2A1.49,1.49,0,0,0,25.4,54a1.51,1.51,0,0,0-.74-1.24l-3.25-1.93c2.24-5.92,11.15-7.38,11.24-7.39a1.5,1.5,0,0,0,.88-2.5L30.2,37.35c2-2.85,7.29-3.92,10.61-3.92a25.22,25.22,0,0,1,7.33,1.29,1.5,1.5,0,0,0,2-1.12c.74-3.67,2.25-7.43,3-7.73,1,.21,3.36,4.08,5,8.13a1.49,1.49,0,0,0,.93.87C71.8,39,72.86,44,72.86,49.12a1.56,1.56,0,0,0,.25.84l1.22,1.79c1.89,2.76,4.24,6.21,4.24,7.87,0,5-3.58,5-4.76,5-2,0-4.21-1.85-6.49-3.81-2.77-2.38-5.91-5.07-9.8-5.11h-.07c-5.79,0-8.2-4.28-8.2-6.58a1.5,1.5,0,0,0-3,0c0,3.73,3.36,8.79,9.69,9.49C56.09,66.24,59.5,75.25,60.6,78A1.49,1.49,0,0,0,62,78.9a1.64,1.64,0,0,0,.56-.11,1.51,1.51,0,0,0,.83-2C62.64,75,59.21,66.18,59,58.93c2.25.6,4.36,2.39,6.42,4.15,2.59,2.23,5.28,4.54,8.44,4.54,4.86,0,7.76-3,7.76-8C81.57,57,79.25,53.64,76.81,50.06ZM66.32,30c3.3-2.11,8.2-5.3,9.68-5.16a1.47,1.47,0,0,1,0,.28c-.21,1.25-4.14,6.18-7.94,10.41A36.72,36.72,0,0,0,62,32.74C63.45,31.86,64.9,30.93,66.32,30Z" />
                    <path d="M50,7.24A42.76,42.76,0,1,0,92.76,50,42.81,42.81,0,0,0,50,7.24Zm0,82.52A39.76,39.76,0,1,1,89.76,50,39.81,39.81,0,0,1,50,89.76Z" />
                </svg>
            </div>
            <form action="<?= URLROOT; ?>/users/register " method="post">
                <div>
                    <div class="formRow">
                        <div class="formGroup">
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="<?= (!empty($data['prenom_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['prenom'] ?>">
                            <p class="errorDisplay"><?= $data['prenom_err'] ?></p>
                        </div>
                        <div class="formGroup">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" class="<?= (!empty($data['nom_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['nom'] ?>">
                            <p class="errorDisplay"><?= $data['nom_err'] ?></p>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="<?= (!empty($data['email_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['email'] ?>">
                        <p class="errorDisplay"><?= $data['email_err'] ?></p>
                    </div>
                    <div class="formRow">
                        <div class="formGroup">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" name="mdp" id="mdp" class="<?= (!empty($data['mdp_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['mdp'] ?>">
                            <p class="errorDisplay"><?= $data['mdp_err'] ?></p>
                        </div>
                        <div class="formGroup">
                            <label for="verif_mdp">Confirmation mot de passe</label>
                            <input type="password" name="verif_mdp" id="verif_mdp" class="<?= (!empty($data['verif_mdp_err'])) ? "is_invalid" : ""; ?>" value="<?= $data['verif_mdp'] ?>">
                            <p class="errorDisplay"><?= $data['verif_mdp_err'] ?></p>
                        </div>
                    </div>
                    <div class="centerContainer">
                        <button type="submit" class="linkBtn">Je m'inscris</button>
                    </div>
                    <?php if (isset($data['erreur'])) : ?>
                        <div class="centerContainer">
                            <p id="error"><?= $data['erreur'] ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="centerContainer">
                        <p class="sousForm">Vous avez déjà un compte&nbsp;? <a href="<?= URLROOT; ?>/users/login" class="lienVert">Identifiez-vous</a></p>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>