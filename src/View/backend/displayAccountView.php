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
            <input type="text" id="pseudo" name="pseudo" value="A aller chercher">
        </p>
        <p>
            <label for="email">Email</label><br />
            <input type="text" id="email" name="email" required value="A aller chercher">
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
            <label for="avatar">Sélectionner votre avatar</label>
            <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png" size="1000000">
        </p>
        <p>
            <label for="avatar">Sélectionner votre logo + nom</label>
            <input type="file" id="avatar" name="avatar" accept=".jpg, .jpeg, .png" size="1000000">
        </p>
        <p>
            <textarea id="description" name="description" minlength="1"></textarea>
        </p>
        <p>
            <input type="submit" value="Modifier">
        </p>
        <!-- A programmer ultérieurement pour les édtieurs : raison sociale, adresse, code postal, ville, pays -->
        <!-- A programmer ultérieurement pour les utilisateurs : sexe, prénom, nom, adresse, code postal, ville, pays, date de naissance -->
    </form>
    <p>Supprimer mon compte</p>
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
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>