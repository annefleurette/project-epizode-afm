<?php
// Page de gestion des informations de compte pour un membre connecté
$head_title = 'Epizode - Mon compte';
ob_start();
?>
<!-- <nav> Pour la V2
    <ul>
        <li class="seriesTab" data-index="1">Mon profil</li>
        A programmer ultérieurement pour les éditeurs <li class="seriesTab" data-index="2">Gains</li>
        A programmer ultérieurement pour les utilisateurs et les éditeurs <li class="seriesTab" data-index="2">Factures</li>
    </ul>
</nav> -->
<section id="account" class="seriesContent form"> <!-- Section qui présente les informations de compte du membre connecté -->
    <h1>Mon compte</h1>
    <form class="form-fields" action="index.php?action=updateAccount_post" method="post" enctype="multipart/form-data">
        <p>
            <label for="pseudo">Pseudo</label><br />
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $userProfile['pseudo']; ?>" disabled>
        </p>
        <p>
            <label for="email">Email</label><br />
            <input type="text" id="email" name="email" required value="<?php echo $userProfile['email']; ?>">
        </p>
        <p><button class="btn btn-grey" type="button" id="triggerButton">Modifier le mot de passe</button></p>
        <div id="hidden">
            <p>
                <label for="resetpassword">Nouveau mot de passe</label><br />
                <input type="password" id="resetpassword" name="resetpassword" min="6">
            </p>
            <p>
                <label for="resetpassword2">Confirmer le mot de passe</label><br />
                <input type="password" id="resetpassword2" name="resetpassword2" min="6">
            </p>
        </div>
        <?php
        // Si l'utilisateur est un amateur
        if($userProfile['type'] == "user")
        {
        ?>
            <p>Modifiez votre avatar</p>
                <div class="account-avatar"> 
                    <input class="avatar" type="radio" id="avatar_cat" name="avatar" value="avatar_cat" <?php if($userProfile['nameAvatar'] == "avatar_cat"){?> checked="checked" <?php } ?>>
                    <img src="./public/images/avatar_cat.png" alt="Avatar Féline">
                    <br/>
                    <label for="avatar_cat">La Féline</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_fairy" name="avatar" value="avatar_fairy" <?php if($userProfile['nameAvatar'] == "avatar_fairy"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_fairy.png" alt="Avatar Fée">
                    <br/>
                    <label for="avatar_fairy">La Fée</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_princess" name="avatar" value="avatar_princess" <?php if($userProfile['nameAvatar'] == "avatar_princess"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_princess.png" alt="Avatar Princesse">
                    <br/>
                    <label for="avatar_princess">La Princesse</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_superwoman" name="avatar" value="avatar_superwoman" <?php if($userProfile['nameAvatar'] == "avatar_superwoman"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_superwoman.png" alt="Avatar Super-Héroïne">
                    <br/>
                    <label for="avatar_superwoman">La Super-Héroïne</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_cheriff" name="avatar" value="avatar_cheriff" <?php if($userProfile['nameAvatar'] == "avatar_cheriff"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_cheriff.png" alt="Avatar Shérif">
                    <br/>
                    <label for="avatar_cheriff">Le Shérif</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_doctor" name="avatar" value="avatar_doctor" <?php if($userProfile['nameAvatar'] == "avatar_doctor"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_doctor.png" alt="Avatar Docteur">
                    <br/>
                    <label for="avatar_doctor">Le Docteur</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_sherlock" name="avatar" value="avatar_sherlock" <?php if($userProfile['nameAvatar'] == "avatar_sherlock"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_sherlock.png" alt="Avatar Détective">
                    <br/>
                    <label for="avatar_sherlock">Le Détective</label>
                </div>
                <div class="account-avatar">
                    <input class="avatar" type="radio" id="avatar_vampire" name="avatar" value="avatar_vampire" <?php if($userProfile['nameAvatar'] == "avatar_vampire"){?> checked <?php } ?>>
                    <img src="./public/images/avatar_vampire.png" alt="Avatar Vampire">
                    <br/>
                    <label for="avatar_vampire">Le Vampire</label>
                </div>
        <!-- A programmer ultérieurement pour les utilisateurs : sexe, prénom, nom, adresse, code postal, ville, pays, date de naissance -->
        <?php
        // si l'utilisateur est un éditeur
        }elseif($_SESSION['level'] == 20)
        {
        ?>
            <p>
                <p><img class="logo" src="<?php echo $userProfile['logo']; ?>" alt="<?php echo $userProfile['altlogo']; ?>"/></p>
                <label for="logo">Modifiez votre logo (Format recommandé : 100 x 100px)</label>
                <input type="file" id="logo" name="logo" accept=".jpg, .jpeg, .png" size="1000000">
            </p>
            <p>
                <label for="publisher">Votre maison d'édition</label><br />
                <input type="text" id="publisher" name="publisher" value="<?php echo $userProfile['name']; ?>" disabled>
            </p>
        <!-- A programmer ultérieurement pour les édtieurs : raison sociale, adresse, code postal, ville, pays -->
        <?php
        }
        ?>
        <p>
            <label for="description">Présentez-vous</label></br>
            <textarea id="description" name="description" minlength="1" maxlength="100"><?php if(isset($_SESSION['tempDescription'])){echo $_SESSION['tempDescription'];}elseif(isset($userProfile['description'])){ echo $userProfile['description'];} ?></textarea>
            <?php if(isset($_SESSION['tempDescriptoion'])){unset($_SESSION['tempDescription']);}?>
        </p>
        <p>
            <input class="btn btn-purple" type="submit" value="Modifier">
        </p>
    </form>
    <p class="delete center"><a class="btn btn-grey" href="deleteAccount">Supprimer mon compte</a></p>
</section>
<script type="text/javascript" src="./public/js/password.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>