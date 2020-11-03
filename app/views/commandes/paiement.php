<?php
$page = 'user_client';
$css = [URLROOT . '/css/forms.css', URLROOT . '/css/paiement.css'];
require APPROOT . '/views/inc/header.php';
?>
<main>
    <section class="sectionTop container">
        <div class="formContainer">
            <form id="payment-form">
                <div>
                    <div class="formHeader">
                        <h3>Paiement de votre commande</h3>
                    </div>
                    <div class="stripeContainer">
                        <div class="formGroup">
                            <label for="card-element">Informations de carte bleue</label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>
                            <div id="card-errors" class="errorDisplay" role="alert"></div>
                        </div>
                        <div class="centerContainer">
                            <button type="submit" class="submit linkBtn" value="Payer" id="submitBtnPayer"></button>
                        </div>
                        <div class="centerContainer">
                            <p id="error"></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="formContainer">
            <div class="card">
                <div class="formHeader">
                    <h3>Notice d'utilisation</h3>
                </div>
                <p>Ce site étant bien évidemment un site factice, vous pouvez tester le paiement en utilisant le numéro de carte suivant : <span class="cardTest">4000 0025 0000 0003</span>Vous pouvez entrer la date d'expiration et le code de sécurité que vous souhaitez.</p>
            </div>
        </div>
    </section>
</main>
<?php $scripts = ['https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', URLROOT . '/js/user.js', URLROOT . '/js/paiement.js']; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>