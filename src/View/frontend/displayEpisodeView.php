<?php
$head_title = 'Epizode - Lecture de l\'épisode';
$head_description = 'Blabla';
ob_start();
?>
    <section> <!-- Section avec l'épisode en aperçu -->
        <h1><a href="index.php?action=displaySeries&idseries=<?php echo $seriesId; ?>"><?php echo $oneSeriesUserData['title']; ?></a></h1>
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
        <p><span id="nbLikes"><?php echo $episodeLikes[0]; ?></span> like(s)</p>
        <p><?php echo $episode_unitary_published['numberComments']; ?> commentaire(s)</p>
        <p><?php echo $episode_unitary_published['timeReading']; ?> minute(s)</p>
        <p><?php echo $episode_unitary_published['price']; ?> euro(s)</p>
        <!-- Gestion des likes -->
        <?php
        if($_SESSION != NULL)
        {
        ?>
            <input type="hidden" id="idepisode" value=<?php echo $episodeId; ?>>
            <?php
            // Je peux liker si je n'ai pas déjà liké l'épisode
            if(!in_array($_SESSION['idmember'], $episodeLikers))
            {
            ?>
                <button id="like">J'AIME</button>
            <?php
            }else{
            ?>
                <button id="dislike">JE N'AIME PLUS</button>
            <?php
            }
        }else{
            ?>
                <p><a href="index.php?action=login">CONNECTEZ-VOUS</a> pour liker un épisode !</p>
            <?php
        }
        ?>
        <!-- Gestion du signalement -->
        <?php
        // On ne peut signaler que quand on est connecté
        if($_SESSION != NULL)
        {
        ?>
            <p><a href="index.php?action=alertEpisode_post&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>&like=<?php echo $episodeLikesNumber; ?>">SIGNALER</a><p>
        <?php
        }
        ?>
    </section>
    <section> <!-- Section avec le contenu de l'épisode -->
        <p><?php echo $episode_unitary_published['content']; ?></p>
        <?php // Affichage des boutons épisodes précédents/suivants
        if($episode_current <= 1)
        {
            if($totalepisodes == 1)
            {
            ?>
                <p>Un seul épisode publié pour le moment !</p>
            <?php  
            }else{
                // On gère l'accès aux épisodes en fonction du niveau d'autorisation
                if(!isset($_SESSION['level']) AND $episode_current > 2)
                {
                    // On différencie le message en fonction du type de série
                    if($oneSeriesUserData['type'] === "publisher")
                    {
                    ?>
                        <p>Cette série est payante. <a href="index.php?action=login">Connectez-vous</a> et achetez des coins pour accéder à la suite des épisodes !</p>
                    <?php
                    }else{
                    ?>
                        <p><a href="index.php?action=login">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
                    <?php
                    }
                }else{
                ?>
                    <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_next; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode suivant</a></p>
                <?php 
                } 
            }  
        }elseif($episode_current >= $totalepisodes)
        {
        ?>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_before; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode précédent</a></p>
        <?php
        }else{
        ?>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_before; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode précédent</a></p>
            <?php
            if(!isset($_SESSION['level']) AND $episode_current > 2)
            {
            ?>
                <p><a href="index.php?action=login">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
            <?php
            }else{
                // On gère l'accès aux épisodes en fonction du niveau d'autorisation
                if(!isset($_SESSION['level']) AND $episode_current > 2)
                {
                    // On différencie le message en fonction du type de série
                    if($oneSeriesUserData['type'] === "publisher")
                    {
                    ?>
                        <p>Cette série est payante. <a href="index.php?action=login">Connectez-vous</a> et achetez des coins pour accéder à la suite des épisodes !</p>
                    <?php
                    }else{
                    ?>
                        <p><a href="index.php?action=login">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
                    <?php
                    }
                }else{
                ?>
                    <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_next; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>&like=0">Episode suivant</a></p>
                <?php
                }
            }
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
                            <p>Le <?php 
                            $date = new DateTime($comment_data['date']);
                            echo $date->format('d/m/Y à H:i'); ?></p>
                            <p><?php echo ($comment_data['content']); ?></p>
                            <?php
                            if ($_SESSION != NULL)
                            {
                            ?>
                                <form action="index.php?action=alertComment_post&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>&like=<?php echo $episodeLikesNumber; ?>&idcomment=<?php echo $comment_data["id"]; ?>" method="post">
                                    <input type="submit" value="Signaler">
                                </form>
                            <?php
                            }
                            ?>
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
            <form action="index.php?action=writeComment_post&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>&like=<?php echo $episodeLikesNumber; ?>" method="post">
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
    <script type="text/javascript" src="./public/js/likes.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>