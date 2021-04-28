<?php
$head_title = 'Epizode - Lecture de l\'épisode';
ob_start();
if (!empty($episode_unitary_published))
{
?>
    <section> <!-- Section avec l'épisode en aperçu -->
        <h1><?php echo $oneSeriesUserData['title']; ?></h1>
        <p><img src="<?php echo $oneSeriesUserData['cover']; ?>" alt="<?php echo $oneSeriesUserData['altcover']; ?>"/></p>
        <?php if($oneSeriesUserData['type'] === "publisher")
        {
        ?>
            <p><img src="<?php echo $oneSeriesUserData['logo']; ?>" alt="<?php echo $oneSeriesUserData['altlogo']; ?>"/></p>
            <p><?php echo $oneSeriesUserData['publisher']; ?></p>
            <p><?php echo $oneSeriesUserData['publisher_author']; ?></p>
        <?php
        }else{
        ?>  
            <p><img src="<?php echo $oneSeriesUserData['avatar']; ?>" alt="<?php echo $oneSeriesUserData['altavatar']; ?>"/></p>  
            <p><?php echo $oneSeriesUserData['member']; ?></p>
        <?php
        }
        ?>
        <p><?php echo $episode_unitary_published['title']; ?></p>
        <p><?php echo $episode_unitary_published['numberLikes']; ?> like(s)</p>
        <p><?php echo $episode_unitary_published['numberComments']; ?> commentaire(s)</p>
        <p><?php echo $episode_unitary_published['timeReading']; ?> minute(s)</p>
        <p><?php echo $episode_unitary_published['price']; ?> euro(s)</p>
    </section>
    <section> <!-- Section avec le contenu de l'épisode -->
        <p><?php echo $episode_unitary_published['content']; ?></p>
        <?php
            if($episodeLike == 1)
            {
            ?>    
                <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&id=<?php echo $episode_unitary_published['id']; ?>&like=-1">ANNULER LE LIKE</a></p>
            <?php
            }elseif($episodeLike == -1 OR $episodeLike == 0)
            {
            ?>
                <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&id=<?php echo $episode_unitary_published['id']; ?>&like=1">LIKER</a></p>
            <?php    
            }
            ?>
        <p><a href="index.php?action=alertEpisode_post&id = <?php echo $episode_unitary_published['id']; ?>">SIGNALER</a><p>
        <?php // Affichage des boutons épisodes précédents/suivants
        if($episode_current <= 1)
        {
            if($totalepisodes == 1)
            {
            ?>
                <p>Un seul épisode publié pour le moment !</p>
            <?php  
            }else{
            ?>
                <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_next; ?>&id=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode suivant</a></p>
            <?php 
            }   
        }elseif($episode_current >= $totalepisodes)
        {
        ?>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_before; ?>&id=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode précédent</a></p>
        <?php
        }else{
        ?>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_before; ?>&id=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode précédent</a></p>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_next; ?>&id=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode suivant</a></p>
        <?php 
        }
        ?>
    </section>
    <section> <!-- Section avec les commentaires -->
        <?php
        if($totalcomments > 0)
        {
        ?>
            <ul> <!-- On affiche les commentaires -->
                <?php
                foreach ($episodeCommentsList as $comment_data)
                {
                ?>
                    <li>
                        <article>
                            <p>
                            <?php
                            if($oneSeriesUserData['type'] === "publisher")
                            {
                            ?>
                                <p><img src="<?php echo $oneSeriesUserData['logo']; ?>" alt="<?php echo $oneSeriesUserData['altlogo']; ?>"/></p>
                                <p><?php echo $oneSeriesUserData['publisher']; ?></p>
                            <?php
                            }else{
                            ?>  
                                <p><img src="<?php echo $oneSeriesUserData['avatar']; ?>" alt="<?php echo $oneSeriesUserData['altavatar']; ?>"/></p>  
                                <p><?php echo $oneSeriesUserData['member']; ?></p>
                            <?php
                            }
                            ?>
                            <p>Le <?php echo $comment_data['date']; ?></p>
                            <p><?php echo ($comment_data['content']); ?></p>
                            <form action="index.php?action=alertComment_post&id=<?php echo $comment_data["id"]; ?>" method="post">
                                <input type="submit" value="Signaler">
                            </form>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }else{
        ?>
            <p>Pas de commentaire</p>
        <?php     
        }
        ?>
        <h2>Laisser un commentaire</h2>
        <?php
        if(!isset($_SESSION['pseudo']))
        {
        ?>
            <p>Vous devez être connecté(e) pour laisser un commentaire. <a href="index.php?action=subscription">S'inscrire</a> ou <a href="index.php?action=login">se connecter</a>.</p>
        <?php
        }else{
        ?>
            <form action="index.php?action=writeComment_post&id=<?php echo $comment_data["id"]; ?>" method="post">
                <p>
                    <label for="comment">Saisissez votre commentaire</label><br />
                    <textarea id="comment" name="comment" minlength = "4" required></textarea>
                </p>
                <p>
                    <input type="submit" value="Envoyer">
                </p>
            </form>
        <?php
        }
        ?>
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