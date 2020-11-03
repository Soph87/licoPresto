<?php
$page = 'user_client';
$css = [URLROOT . '/css/compte.css', URLROOT . '/css/forms.css'];
//lien class active dans le header :
$activeCompte = true;
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop container">
        <div class="formContainer afficheInfos">
            <div class="card">
                <div class="formHeader">
                    <h3>Mes infos</h3>
                </div>
                <p class="infos"><?= $data['form']['prenom'] ?> <?= $data['form']['nom'] ?></p>
                <h4>Mon adresse de livraison préférée</h4>
                <?php if ($data['form']['adresse']) : ?>
                    <p class="infos adresse">
                        <span><?= $data['form']['adresse'] ?></span>
                        <span><?= $data['form']['cp'] ?> <?= $data['form']['ville'] ?></span>
                    </p>
                <?php else : ?>
                    <p class="infos">Vous n'avez pas encore enregistré d'adresse de livraison par défaut</p>
                <?php endif; ?>
                <h4>Mon email</h4>
                <p class="infos"><?= $data['form']['email'] ?></p>
                <div class="centerContainer">
                    <a href="<?= URLROOT; ?>/users/compteModif" class="linkBtnVert">Modifier</a>
                </div>
            </div>
        </div>
        <div class="formContainer afficheCmd">
            <div class="card">
                <div class="formHeader">
                    <h3>Mes commandes passées</h3>
                </div>
                <?php if (empty($data['cmds'])) : ?>
                    <p>Vous n'avez pas encore effectué de commande</p>
                <?php endif; ?>
                <?php foreach ($data['cmds'] as $cmd) : ?>
                    <div class="cmdContainer">
                        <h4>Commande du <?= date('d/m/Y', strtotime($cmd->date)) ?> à <?= date('H:i', strtotime($cmd->date)) ?></h4>
                        <ul>
                            <?php foreach ($cmd->lignes as $ligne) : ?>
                                <li><?= $ligne->nom ?> - <?= $ligne->prix_unite ?>,00µp x <?= $ligne->quantite ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <p class="total"><span>TOTAL : </span><span><?= $cmd->prix_total ?>,00µp</span></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php $scripts = [URLROOT . '/js/user.js']; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>