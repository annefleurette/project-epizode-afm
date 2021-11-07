<?php
// Page de connexion à l'espace membre
$head_title = 'Epizode - Connexion';
$head_descripion = 'Connexion à l\'espace membre d\'Epizode';
ob_start();
?>
<section class="form">
    <h1>Connexion</h1>
    <form class="form-fields" action="index.php?action=login_post" method="post">
        <p>
            <label for="email">Identifiant email</label><br />
            <input type="text" id="email" name="email" required value="<?php if(isset($_SESSION['tempEmail'])){echo $_SESSION['tempEmail'];}?>">
        </p>
        <p>
            <label for="password">Mot de passe</label><br />
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <input class="btn btn-purple" type="submit" value="Se connecter">
        </p>
        <p>
            <input id="form-fields-remember" type="checkbox" id="remember" name="remember">
            <label for="remember">Se souvenir de moi</label>
        </p>
    </form>
    <div class="form-connected">
        <p><a href ="index.php?action=subscription">Créer un compte</a></p>
        <p><a href ="index.php?action=forgetPassword">Mot de passe oublié ?</a></p>
    </div>
</section>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>