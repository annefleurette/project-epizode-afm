<?php
// Page qui affiche un épisode
$head_title = $oneSeriesPublicData['title']. " / Episode :" .$episode_unitary_published['title'];
$head_description = $episode_unitary_published['meta'];
ob_start();
?>
    <section> <!-- Section avec l'épisode -->
        <h1><a href="index.php?action=displaySeries&idseries=<?php echo $seriesId; ?>"><?php echo $oneSeriesPublicData['title']; ?></a></h1>
        <p><img src="<?php echo $oneSeriesPublicData['cover']; ?>" alt="<?php echo $oneSeriesPublicData['altcover']; ?>"/></p>
        <!-- Si l'auteur est un éditeur -->
        <?php if($oneSeriesPublicData['type'] === "publisher")
        {
        ?>
            <p><img src="<?php echo $oneSeriesPublicData['logo']; ?>" alt="<?php echo $oneSeriesPublicData['altlogo']; ?>"/></p>
            <p><?php echo $oneSeriesPublicData['publisher']; ?></p>
            <p><?php echo $oneSeriesPublicData['publisher_author']; ?></p>
        <!-- Si l'auteur est un autre utilisateur -->
        <?php
        }else{
        ?>  
            <p><img src="<?php echo $oneSeriesPublicData['avatar']; ?>" alt="<?php echo $oneSeriesPublicData['altavatar']; ?>"/></p>  
            <p><?php echo $oneSeriesPublicData['member']; ?></p>
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
        // Si le membre est connecté
        if(isset($_SESSION['idmember']))
        {
        ?>
            <input type="hidden" id="idepisode" value=<?php echo $episodeId; ?>>
            <button id="like" <?php if(in_array($_SESSION['idmember'], $episodeLikers)){ echo 'class="hidden"'; }?>>J'AIME</button>
            <button id="dislike" <?php if(!in_array($_SESSION['idmember'], $episodeLikers)){ echo 'class="hidden"'; }?>>JE N'AIME PLUS</button>
        <?php
        // Si le membre n'est pas connecté
        }else{
            ?>
                <p><a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_unitary_published['number']; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>">CONNECTEZ-VOUS</a> pour liker un épisode !</p>
            <?php
        }
        ?>
        <!-- Gestion du signalement -->
        <?php
        // On ne peut signaler que quand on est connecté
        if($_SESSION != NULL)
        {
        ?>
            <input type="hidden" id="idepisodealert" value=<?php echo $episodeId; ?>>
            <button id="alertepisode">SIGNALER</button>
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
                    if($oneSeriesPublicData['type'] === "publisher")
                    {
                    ?>
                        <p>Cette série est payante. <a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">Connectez-vous</a> et achetez des coins pour accéder à la suite des épisodes !</p>
                    <?php
                    }else{
                    ?>
                        <p><a href=href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
                    <?php
                    }
                }else{
                ?>
                    <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_next; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>">Episode suivant</a></p>
                <?php 
                } 
            }  
        }elseif($episode_current >= $totalepisodes)
        {
        ?>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_before; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>">Episode précédent</a></p>
        <?php
        }else{
        ?>
            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_before; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>">Episode précédent</a></p>
            <?php
            if(!isset($_SESSION['level']) AND $episode_current > 2)
            {
            ?>
                <p><a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&idepisode=<?php echo $episodeId; ?>">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
            <?php
            }else{
                // On gère l'accès aux épisodes en fonction du niveau d'autorisation
                if(!isset($_SESSION['level']) AND $episode_current > 2)
                {
                    // On différencie le message en fonction du type de série
                    if($oneSeriesPublicData['type'] === "publisher")
                    {
                    ?>
                        <p>Cette série est payante. <a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">Connectez-vous</a> et achetez des coins pour accéder à la suite des épisodes !</p>
                    <?php
                    }else{
                    ?>
                        <p><a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
                    <?php
                    }
                }else{
                ?>
                    <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_next; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>">Episode suivant</a></p>
                <?php
                }
            }
        }
        ?>
    </section>
    <section> <!-- Section avec les commentaires -->
        <?php
        // S'il existe des commentaires
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
                            <!-- Si l'auteur est un éditeur -->
                            <?php
                            if($oneSeriesPublicData['type'] === "publisher")
                            {
                            ?>
                                <p><img src="<?php echo $oneSeriesPublicData['logo']; ?>" alt="<?php echo $oneSeriesPublicData['altlogo']; ?>"/></p>
                                <p><?php echo $oneSeriesPublicData['publisher']; ?></p>
                            <!-- Si l'auteur est un autre utilisateur -->
                            <?php
                            }else{
                            ?>  
                                <p><img src="<?php echo $oneSeriesPublicData['avatar']; ?>" alt="<?php echo $oneSeriesPublicData['altavatar']; ?>"/></p>  
                                <p><?php echo $oneSeriesPublicData['member']; ?></p>
                            <?php
                            }
                            ?>
                            <p>Le <?php 
                            $date = new DateTime($comment_data['date']);
                            echo $date->format('d/m/Y à H:i'); ?></p>
                            <p><?php echo ($comment_data['content']); ?></p>
                            <?php
                            // On en peut signaler que si on est connecté
                            if ($_SESSION != NULL)
                            {
                            ?>
                                <input type="hidden" id="idcommentalert" value=<?php echo $comment_data['id']; ?>>
                                <button id="alertcomment">SIGNALER</button>
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
        // Si aucun commentaire a été saisi
        }else{
        ?>
            <p>Pas de commentaire</p>
        <?php     
        }
        ?>
        <h2>Laisser un commentaire</h2>
        <?php
        // On ne peut commenter que si on est connecté
        if(!isset($_SESSION['pseudo']))
        {
        ?>
            <p>Vous devez être connecté(e) pour laisser un commentaire. <a href="index.php?action=subscription">S'inscrire</a> ou <a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">se connecter</a>.</p>
        <?php
        }else{
        ?>
            <form action="index.php?action=writeComment_post&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>" method="post">
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
    <script type="text/javascript" src="./public/js/alerts.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>