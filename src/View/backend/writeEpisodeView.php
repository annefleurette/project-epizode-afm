
<?php
$head_title = 'Epizode - Créer un nouvel épisode';
ob_start();
?>
<section>
    <form action="index.php?action=writeEpisode_post" method="post">
        <p>
            <label for="numberEpisode">Numéro de l'épisode</label><br />
            <input type="number" id="number" name="numberEpisode" min="1" required>
        </p>
        <p>
            <label for="titleEpisode">Titre</label><br />
            <input type="text" id="titleEpisode" name="titleEpisode" minlength="1" maxlength="1200" required></input>
        </p>
        <p>
            <label for="contentEpisode">Contenu de l'épisode</label><br />
            <textarea id="contentEpisode" name="contentEpisode"></textarea>
            <p id="signsEpisode"></p>
        </p>
        <p>
            <label for="priceEpisode">Prix de l'épisode</label><br />
            <textarea id="priceEpisode" name="priceEpisode" min="1"></textarea>
        </p>
        <p>
            <input type="submit" name="save" value="Enregistrer">
            <input type="submit" name="publish" value="Publier">
        </p>
    </form>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>