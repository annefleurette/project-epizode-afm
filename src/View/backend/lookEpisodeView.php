<?php
// Page qui permet à un auteur d'afficher un aperçu de son épisode
$head_title = 'Epizode - Aperçu de l\'épisode';
ob_start();
?>
    <section> <!-- Retour en arrière -->
        <p>
            <a href="index.php?action=updateSeries&idseries=<?php echo $seriesId; ?>">Retour</a>
        </p>
    </section>
    <section> <!-- Section avec l'épisode en aperçu -->
        <h1><?php echo $oneSeriesUserData['title']; ?></h1>
        <p><img src="<?php echo $oneSeriesUserData['cover']; ?>" alt="<?php echo $oneSeriesUserData['altcover']; ?>"/></p>
        <!-- Si l'auteur est un éditeur -->
        <?php if($_SESSION['level'] == 20)
        {
        ?>
            <p><img src="<?php echo $oneSeriesUserData['logo']; ?>" alt="<?php echo $oneSeriesUserData['altlogo']; ?>"/></p>
            <p><?php echo $oneSeriesUserData['publisher']; ?></p>
            <p><?php echo $oneSeriesUserData['publisher_author']; ?></p>
        <?php
        // Si l'auteur est un autre utilisateur
        }else{
        ?>  
            <p><img src="<?php echo $oneSeriesUserData['avatar']; ?>" alt="<?php echo $oneSeriesUserData['altavatar']; ?>"/></p>  
            <p><?php echo $oneSeriesUserData['member']; ?></p>
        <?php
        }
        ?>
        <p><?php echo $oneEpisodesUser['title']; ?></p>
        <p><?php echo $oneEpisodesUser['likesNumber']; ?> like(s)</p>
        <p><?php echo $oneEpisodesUser['numberComments']; ?> commentaire(s)</p>
        <p><?php echo $oneEpisodesUser['timeReading']; ?> minute(s)</p>
    </section>
    <section>
        <p><?php echo $oneEpisodesUser['content']; ?></p>
    </section>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>