
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
<section class="writeSeries">
    <form action="index.php?action=updateSeries_post" method="post" enctype="multipart/form-data">
        <p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" value="<?php echo $oneSeriesUserData['title']; ?>" required>
        </p>
        <p>
            <label for="descriptionSeries">Description</label><br />
            <textarea id="descriptionSeries" name="descriptionSeries" minlength="1" maxlength="1200" required><?php echo $oneSeriesUserData['summary']; ?></textarea>
        </p>
        <p>
            <label for="cover">Ajouter un visuel (1 Mo maximum, formats JPEG et PNG exclusivement)</label>
            <input type="file" id="cover" name="cover" accept=".jpg, .jpeg, .png" size="1000000" required>
        </p>
        <p>
            <label for="tags">Catégories/Tags (séparer chaque tag par une virgule)</label><br />
            <input type="text" id="tags" name="tags" value = "<?php echo $alltags; ?>" required>
        </p>
        <?php
        echo"<pre>";
        var_dump($alltags);
        echo"<pre>";
        ?>
        <p>
            <label for="rights">Droits d'auteurs</label><br />
            <select name="rights" value ="<?php echo $oneSeriesUserData['authors_right']; ?>" required>
                <option value="reserved">Tous droits réservés</option>
                <option value="public">Domaine public</option>
                <option value="CC">Creative Commons Attribution</option>
                <option value="CC1">Creative Commons Attribution - Pas de modification</option>
                <option value="CC2">Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                <option value="CC3">Creative Commons Attribution - Pas d'utilisation commerciale</option>
                <option value="CC4">Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                <option value="CC5">Creative Commons Attribution - Partage dans les mêmes conditions</option>
            </select>  
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
</section>
<?php
if (isset($seriesId))
{
?>
    <section class="writeEpisodes">
        <p><a href="index.php?action=writeEpisode">ECRIRE UN NOUVEL EPISODE</a></p>
            <ul>
                <?php
                foreach ($oneSeriesUserData as $episodedata)
                {
                ?>
                    <li>
                        <article>
                            <p>Episode n°<?php echo $episodedata['number']; ?></p>
                            <p><?php echo $episodedata['title']; ?></p>
                            <p><?php echo $episodedata['publishing_status']; ?></p>
                            <p>Dernière modification : <?php echo $episodedata['date']; ?></p>
                            <p><?php echo $episodedata['likes_number']; ?></p>
                            <p><a href = #>APERCU</a></p>
                            <p><a href = #>MODIFIER</a></p>
                            <p><a href = #>SUPPRIMER</a></p>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
    </section>
<?php
}
?>
<?php $body_content = ob_get_clean();
require('template.php');
?>