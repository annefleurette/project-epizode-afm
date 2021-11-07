<?php
// Page qui lance la vérification de l'adresse email pour ensuite réinitialiser le mot de passe
$head_title = 'Epizode - Mot de passe oublié';
ob_start();
?>
<section class="form">
    <h1>Mot de passe oublié</h1>
    <form class="form-fields" action="index.php?action=forgetPassword_post" method="post">
        <p>
            <label for="email">Saisissez votre adresse email</label><br />
            <input type="text" id="email" name="email" required>
        </p>
        <p>
            <input class="btn btn-purple" type="submit" value="Envoyer">
        </p>
    </form>
</section>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>