
<?php
$head_title = 'Epizode - Créer un nouvel épisode';
ob_start();
?>
<section>
    <form action="index.php?action=writeEpisode_post&idseries=<?php echo $getid; ?>" method="post">
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
            <input type="number" id="priceEpisode" name="priceEpisode" min="0" value="0" step=".01" required> euro(s)
        </p>
        <p>
            <label for="promotionEpisode">Promotion</label><br />
            Retirer <input type="number" id="promotionEpisode" name="promotionEpisode" min="0" value="0" step=".01"> euro(s)
        </p>
        <p>
            <input type="submit" name="save" value="Enregistrer">
            <input type="submit" name="publish" value="Publier">
        </p>
    </form>
</section>
<script type="text/javascript" src="./public/js/tools.js"></script>
<script type="text/javascript" src="./public/js/script.js"></script>
<?php $body_content = ob_get_clean();
require('template.php');
?>