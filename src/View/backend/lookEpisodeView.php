<?php
$head_title = 'Epizode - Aperçu de l\'épisode';
ob_start();
if (!empty($oneEpisodesUser))
{
?>
    <section> <!-- Section avec l'épisode en aperçu -->
        <h1><?php echo $oneSeriesUserData['title']; ?></h1>
        <p><img src="<?php echo $oneSeriesUserData['cover']; ?>" alt="Cover"/></p>
        <?php if($oneSeriesUserData['type'] === "publisher")
        {
        ?>
            <p><img src="<?php echo $oneSeriesUserData['logo']; ?>" alt="blabla"/></p>
            <p><?php echo $oneSeriesUserData['publisher']; ?></p>
            <p><?php echo $oneSeriesUserData['publisher_author']; ?></p>
        <?php
        }else{
        ?>  
            <p><img src="<?php echo $oneSeriesUserData['avatar']; ?>" alt="blabla"/></p>  
            <p><?php echo $oneSeriesUserData['member']; ?></p>
        <?php
        }
        ?>
        <p><?php echo $oneEpisodesUser['title']; ?></p>
        <p><?php echo $oneEpisodesUser['numberLikes']; ?> like(s)</p>
        <p><?php echo $oneEpisodesUser['numberComments']; ?> commentaire(s)</p>
        <p><?php echo $oneEpisodesUser['timeReading']; ?> minute(s)</p>
    </section>
    <section>
        <p><?php echo $oneEpisodesUser['content']; ?></p>
    </section>
<?php
}else{
?>
    <section>
        <h1>Erreur 404</h1>
        <p>Cette page n'existe pas !</p>
    </section>
<?php
}
$body_content = ob_get_clean();
require('template.php');
?>