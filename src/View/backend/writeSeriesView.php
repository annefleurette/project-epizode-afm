
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>

<nav>
    <ul>
        <li>Ma série</li>
        <li>Mes épisodes</li>
    </ul>
</nav>

<section>
    <form action="writeSeries_post" method="post" enctype="multipart/form-data">
        <?php
        if($_SESSION['type'] === "publisher") {
        ?>
        <p>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" minlength="2" maxlength="50" required>
        </p>
        <p>
            <label for="descriptionAuthor">Description de l'auteur</label><br />
            <textarea id="descriptionAuthor" name="descriptionAuthor" minlength="1" maxlength="1200" required></textarea>
        </p>
        <?php
        }
        ?>
        <p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" required>
        </p>
        <p>
            <label for="descriptionSeries">Description</label><br />
            <textarea id="descriptionSeries" name="descriptionSeries" minlength="1" maxlength="1200" required></textarea>
        </p>
        <p>
            <label for="cover">Ajouter un visuel (1 Mo maximum, formats JPEG et PNG exclusivement)</label>
            <input type="file" id="cover" name="cover" accept=".jpg, .jpeg, .png" size="1000000" required>
        </p>
        <p>
            <label for="tags">Catégories/Tags (séparer chaque tag par une virgule)</label><br />
            <input type="text" id="tags" name="tags" required>
        </p>
        <p>
            <label for="rights">Droits d'auteurs</label><br />
            <select name="rights" required>
                <option value="reserved">Tous droits réservés</option>
                <option value="public">Domaine public</option>
                <option value="CC1">Creative Commons Attribution</option>
                <option value="CC2">Creative Commons Attribution - Pas de modification</option>
                <option value="CC3">Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                <option value="CC4">Creative Commons Attribution - Pas d'utilisation commerciale</option>
                <option value="CC5">Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                <option value="CC6">Creative Commons Attribution - Partage dans les mêmes conditions</option>
            </select>  
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>