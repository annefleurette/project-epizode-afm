<?php
// Page qui permet de réinitialiser le mot de passe
$head_title = 'Epizode - Réinitaliser le mot de passe';
ob_start();
?>
<section class="form">
    <h1>Réinitialiser le mot de passe</h1>
    <?php
    if(!isset($_SESSION['pseudo'])) { // On vérifie que la personne n'est pas déjà connectée 
    ?>
        <form class="form-fields" action="index.php?action=resetPassword_post&token=<?php echo $gettoken; ?>" method="post">
            <p>
                <label for="password">Mot de passe</label><br />
                <input type="password" id="password" name="password" min="6" required>
            </p>
            <p>
                <label for="password2">Confirmer le mot de passe</label><br />
                <input type="password" id="password2" name="password2" min="6" required>
            </p>
            <p>
                <input class="btn btn-purple" type="submit" value="Envoyer">
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