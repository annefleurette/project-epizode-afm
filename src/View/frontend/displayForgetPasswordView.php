<?php
$head_title = 'Epizode - Mot de passe oublié';
ob_start();
?>
<section>
    <h1>Mot de passe oublié</h1>
    <?php
    if(!isset($_SESSION['pseudo'])) { // On vérifie que la personne n'est pas déjà connectée 
    ?>
        <form action="index.php?action=forgetPassword_post" method="post">
            <p>
                <label for="email">Saisissez votre adresse email</label><br />
                <input type="text" id="email" name="email" required>
            </p>
            <p>
                <input type="submit" value="Envoyer">
            </p>
        </form>
    <?php
    }else{
    ?>
        <p>Vous êtes déjà connecté(e) !</p>
        <a href="index.php?action=logout">Se déconnecter</a>
    <?php
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>