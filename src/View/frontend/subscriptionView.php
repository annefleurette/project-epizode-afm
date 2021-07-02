<?php
$head_title = 'Epizode - Inscription';
$head_description = 'Inscription';
ob_start();
?>
<section>
    <h1>INSCRIPTION</h1>
    <?php
    if(!isset($_SESSION['pseudo'])) { //On vérifie que la personne n'est pas déjà connectée 
    ?>
        <form action="index.php?action=subscription_post" method="post">
            <p>
                <label for="pseudo">Pseudo</label><br />
                <input type="text" id="pseudo" name="pseudo" minlength = "4" maxlength="20" required value="<?php if(isset($_SESSION['tempPseudo'])){echo $_SESSION['tempPseudo'];}?>">
            </p>
            <p>
                <label for="email">Email</label><br />
                <input type="text" id="email" name="email" required value="<?php if(isset($_SESSION['tempEmail'])){echo $_SESSION['tempEmail'];}?>">
            </p>
            <p>
                <label for="password">Mot de passe</label><br />
                <input type="password" id="password" name="password" min="6" required>
            </p>
            <p>
                <label for="password2">Confirmer le mot de passe</label><br />
                <input type="password" id="password2" name="password2" min="6" required>
            </p>
            <p>
                <input type="submit" value="S'inscrire">
            </p>
        </form>
        <p>Vous avez déjà un compte, <a href="index.php?action=login">connectez-vous</a></p>
        <p>Si vous êtes un éditeur, contactez-nous directement : editeur@epizode.fr</p>
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