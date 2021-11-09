<?php
// Page qui permet à un auteur d'afficher un aperçu de son épisode
$head_title = 'Epizode - Aperçu de l\'épisode';
ob_start();
?>
    <section id="look"> <!-- Section avec l'épisode en aperçu -->
        <h1><?php echo $oneEpisodesUser['title']; ?></h1>
        <div class="episode-data">
            <p><?php echo $oneSeriesUserData['title']; ?> : épisode <?php echo $oneEpisodesUser['number']; ?></p>
            <p><?php echo $oneEpisodesUser['timeReading']; ?> minute(s) de lecture</p>
            <p class="social-info"><i class="fas fa-heart"></i><?php echo $oneEpisodesUser['likesNumber']; ?></p>
        </div>
        <section id="look-content">
            <p class="episode-content-text"><?php echo $oneEpisodesUser['content']; ?></p>
            <p class="center"><a class="btn btn-grey" href="index.php?action=updateSeries&idseries=<?php echo $seriesId; ?>&tab=2">Retour</a></p>
        </section>
    </section>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>