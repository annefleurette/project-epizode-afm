
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<nav>
    <ul>
        <li class="seriesTab">Ma série</li>
        <li class="seriesTab">Mes épisodes</li>
    </ul>
</nav>
<section class="seriesContent">
    <form action="index.php?action=updateSeries_post&id=<?php echo $getid; ?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" value="<?php echo $oneSeriesUserData['title']; ?>" required>
        </p>
        <p>
            <label for="descriptionSeries">Description</label><br />
            <textarea id="descriptionSeries" name="descriptionSeries" minlength="1" maxlength="1200" required><?php echo $oneSeriesUserData['summary']; ?></textarea>
        </p>
        <p>
            <p><img src="<?php echo $seriesCover; ?>" /></p>
            <label for="cover">Modifier l'affiche de votre série (1 Mo maximum, formats JPEG et PNG exclusivement)</label>
            <input type="file" id="cover" name="cover" accept=".jpg, .jpeg, .png" size="1000000">
        </p>
        <p>
            <label for="tags">Catégories/Tags (séparer chaque tag par une virgule)</label><br />
            <input type="text" id="tags" name="tags" value = "<?php echo $alltags; ?>" required>
        </p>
        <p>
            <label for="rights">Droits d'auteurs</label><br />
            <select name="rights" required>
                <option <?php if($oneSeriesUserData['rights'] == 'reserved') { ?>selected="selected" <?php }; ?>value="reserved">Tous droits réservés</option>
                <option <?php if($oneSeriesUserData['rights'] == 'public') { ?>selected="selected" <?php }; ?>value="public">Domaine public</option>
                <option <?php if($oneSeriesUserData['rights'] == 'CC') { ?>selected="selected" <?php }; ?>value="CC">Creative Commons Attribution</option>
                <option <?php if($oneSeriesUserData['rights'] == 'CC1') { ?>selected="selected" <?php }; ?>value="CC1">Creative Commons Attribution - Pas de modification</option>
                <option <?php if($oneSeriesUserData['rights'] == 'CC2') { ?>selected="selected" <?php }; ?>value="CC2">Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                <option <?php if($oneSeriesUserData['rights'] == 'CC3') { ?>selected="selected" <?php }; ?>value="CC3">Creative Commons Attribution - Pas d'utilisation commerciale</option>
                <option <?php if($oneSeriesUserData['rights'] == 'CC4') { ?>selected="selected" <?php }; ?>value="CC4">Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                <option <?php if($oneSeriesUserData['rights'] == 'CC5') { ?>selected="selected" <?php }; ?>value="CC5">Creative Commons Attribution - Partage dans les mêmes conditions</option>
            </select>  
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
</section>
<section class="seriesContent">
    <p><a href="index.php?action=writeEpisode&idseries=<?php echo $getid; ?>">ECRIRE UN NOUVEL EPISODE</a></p>
    <?php
    if($oneSeriesUserData['numberEpisodes']!== "0")
    {
    ?>
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
    <?php
    }else{
    ?>
        <p>La série n'a pas encore d'épisode ! </p>
    <?php
    }
    ?>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>