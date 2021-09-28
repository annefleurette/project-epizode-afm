<?php
$head_title = 'Epizode - Mon compte';
ob_start();
?>
<nav>
    <ul>
        <li class="seriesTab" data-index="1">Mon profil</li>
        <li class="seriesTab" data-index="2">Notifications</li>
        <!-- A programmer ultérieurement pour les éditeurs <li class="seriesTab" data-index="3">Gains</li> -->
        <!-- A programmer ultérieurement pour les utilisateurs et les éditeurs <li class="seriesTab" data-index="3">Factures</li> -->
    </ul>
</nav>
<section class="seriesContent" data-tab="1">
    <h2>Mes informations</h2>
    <form action="index.php?action=updateAccount_post" method="post" enctype="multipart/form-data">
        <p>
            <label for="pseudo">Pseudo</label><br />
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $userProfile['pseudo']; ?>" disabled>
        </p>
        <p>
            <label for="email">Email</label><br />
            <input type="text" id="email" name="email" required value="<?php echo $userProfile['email']; ?>">
        </p>
        <p><button type="button" id="triggerButton">MODIFIER LE MOT DE PASSE</button></p>
        <div id="hidden">
            <p>
                <label for="resetpassword">Nouveau mot de passe</label><br />
                <input type="password" id="resetpassword" name="resetpassword" min="6" required>
            </p>
            <p>
                <label for="resetpassword2">Confirmer le mot de passe</label><br />
                <input type="password" id="resetpassword2" name="resetpassword2" min="6" required>
            </p>
        </div>
        <?php
        if($userProfile['type'] == "user")
        {
        ?>
            <p>Modifiez votre avatar</p>
                <div>
                    <input type="radio" id="avatar1" name="avatar" value="avatar1">
                    <img src="./public/images/avatar_cheriff.png" alt="Avatar Shérif">
                    <label for="avatar1">Le Shérif</label>
                </div>
                <div>
                    <input type="radio" id="avatar2" name="avatar" value="avatar2">
                    <img src="./public/images/avatar_doctor.png" alt="Avatar Docteur">
                    <label for="avatar2">Le Docteur</label>
                </div>
                <div>
                    <input type="radio" id="avatar3" name="avatar" value="avatar3">
                    <img src="./public/images/avatar_sherlock.png" alt="Avatar Détective">
                    <label for="avatar3">Le Détective</label>
                </div>
                <div>
                    <input type="radio" id="avatar4" name="avatar" value="avatar4">
                    <img src="./public/images/avatar_vampire.png" alt="Avatar Vampire">
                    <label for="avatar4">Le Vampire</label>
                </div>
                <div>
                    <input type="radio" id="avatar5" name="avatar" value="avatar5">
                    <img src="./public/images/avatar_fairy.png" alt="Avatar Fée">
                    <label for="avatar5">La Fée</label>
                </div>
                <div>
                    <input type="radio" id="avatar6" name="avatar" value="avatar6" checked>
                    <img src="./public/images/avatar_cat.png" alt="Avatar Féline">
                    <label for="avatar6">La Féline</label>
                </div>
                <div>
                    <input type="radio" id="avatar7" name="avatar" value="avatar7">
                    <img src="./public/images/avatar_princess.png" alt="Avatar Princess">
                    <label for="avatar7">La Princesse</label>
                </div>
                <div>
                    <input type="radio" id="avatar8" name="avatar" value="avatar8">
                    <img src="./public/images/avatar_superwoman.png" alt="Avatar Super-Héroïne">
                    <label for="avatar8">La Super-Héroïne</label>
                </div>
        <!-- A programmer ultérieurement pour les utilisateurs : sexe, prénom, nom, adresse, code postal, ville, pays, date de naissance -->
        <?php
        }elseif($userProfile['type'] == "publisher")
        {
        ?>
            <p>
                <p><img src="<?php echo $userProfile['logo']; ?>" alt="<?php echo $userProfile['altlogo']; ?>"/></p>
                <label for="logo">Modifiez votre logo</label>
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
            <textarea id="description" name="description" minlength="1" maxlength="100"><?php if(isset($userProfile['description'])){ echo $userProfile['description']; } ?></textarea>
        </p>
        <p>
            <input type="submit" value="Modifier">
        </p>
    </form>
    <p class="delete"><a href="index.php?action=deleteAccount">Supprimer mon compte</a></p>
</section>
<section class="seriesContent hidden" data-tab="2">
    <h2>Mes notifications</h2>   
    <form action="index.php?action=updateNotification_post" method="post" enctype="multipart/form-data"> 
        <p>
            <p>J'accepte de recevoir des notifications email d'Epizode</p>
                <div>
                    <input type="radio" id="oui" name="oui" value="oui"
                    checked>
                    <label for="oui">Oui</label>
                </div>
                <div>
                    <input type="radio" id="non" name="non" value="non">
                    <label for="non">Non</label>
                </div>
        </p>
        <p>
            <input type="submit" value="Modifier">
        </p>
    </form>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/password.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>