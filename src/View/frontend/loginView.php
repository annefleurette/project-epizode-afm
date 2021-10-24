<?php
// Page de connexion à l'espace membre
$head_title = 'Epizode - Connexion';
$head_descripion = 'Connexion à l\'espace membre d\'Epizode';
ob_start();
?>
<section>
    <h1>Connexion</h1>
    <?php
    if(!isset($_SESSION['pseudo'])) { // On vérifie que la personne n'est pas déjà connectée
    ?>
        <form action="index.php?action=login_post" method="post">
            <p>
                <label for="email">Identifiant email</label><br />
                <input type="text" id="email" name="email" required value="<?php if(isset($_SESSION['tempEmail'])){echo $_SESSION['tempEmail'];}?>">
            </p>
            <p>
                <label for="password">Mot de passe</label><br />
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <input class="cta btn" type="submit" value="Se connecter">
            </p>
            <p>
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </p>
        </form>
        <p><a href ="index.php?action=subscription">Créer un compte</a></p>
        <p><a href ="index.php?action=forgetPassword">Mot de passe oublié ?</a></p>
    <?php
    // Si la personne est déjà connectée
    }else{
    ?>
        <p>Vous êtes déjà inscrit(e) et connecté(e) !</p>
        <a href="index.php?action=logout">Se déconnecter</a>
    <?php
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>