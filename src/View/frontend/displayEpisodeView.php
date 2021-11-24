<?php
// Page qui affiche un épisode
$head_title = $oneSeriesPublicData['title']. " / Episode : " .$episode_unitary_published['title'];
$head_description = $episode_unitary_published['meta'];
ob_start();
?>
<section id="episode"> <!-- Section avec l'épisode -->
        <h1 <?php if(strlen($episode_unitary_published['title']) >= 30 AND strlen($episode_unitary_published['title']) <= 70){ echo "class=medium-title";}elseif(strlen($episode_unitary_published['title']) > 70){ echo "class=big-title";}?>><?php echo $episode_unitary_published['title']; ?></h1>
        <div class="episode-data">
            <p><a href="displaySeries/idseries=<?php echo $seriesId; ?>"><?php echo $oneSeriesPublicData['title']; ?></a> : épisode <?php echo $episode_unitary_published['number']; ?></p>
            <p><?php echo $episode_unitary_published['timeReading']; ?> minute(s) de lecture</p>
            <div class="episode-data-social">
                <p class="social-info"><i class="fas fa-heart"></i><span id="nbLikes"><?php echo $episodeLikes[0]; ?></span></p>
                <p class="social-info"><i class="fas fa-comment"></i><?php echo $episode_unitary_published['numberComments']; ?></p>
            </div>
            <!-- Gestion des likes -->
            <?php
            // Si le membre est connecté
            if(isset($_SESSION['idmember']))
            {
            ?>
                <input type="hidden" id="idepisode" value=<?php echo $episodeId; ?>>
                <button id="like" class="btn btn-purple <?php if(in_array($_SESSION['idmember'], $episodeLikers)){ echo "hidden"; }?>">J'aime</button>
                <button id="dislike" class="btn btn-purple <?php if(!in_array($_SESSION['idmember'], $episodeLikers)){ echo "hidden" ; }?>">Je n'aime plus</button>
            <?php
            // Si le membre n'est pas connecté
            }else{
                ?>
                    <p>Pour liker un épisode, <a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episode_unitary_published['number']; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>">connectez-vous !</a></p>
                <?php
            }
            ?>
        </div>
</section>
<section id="episode-content"> <!-- Section avec le contenu de l'épisode -->
    <p class="episode-content-text"><?php echo $episode_unitary_published['content']; ?></p>
    <!-- Gestion du signalement -->
    <?php
    // On ne peut signaler que quand on est connecté
    if($_SESSION != NULL)
    {
    ?>
        <input type="hidden" id="idepisodealert" value=<?php echo $episodeId; ?>>
        <p class="btn__alert"><button id="alertepisode" class="btn btn-grey">Signaler</button></p>
    <?php
    }
    ?>
    <?php // Affichage des boutons épisodes précédents/suivants
    if($episode_current <= 1)
    {
        if($totalepisodes == 1)
        {
        ?>
            <p class="no">Un seul épisode publié pour le moment !</p>
        <?php  
        }else{
        ?>
            <p class="button-next"><a class="btn btn-purple" href="displayEpisode/<?php echo $seriesId; ?>/<?php echo $episode_next; ?>/<?php echo $episode_unitary_published['id']; ?>">Episode suivant</a></p>
        <?php
        }
    }elseif($episode_current >= $totalepisodes)
    {
    ?>
        <p class="button-prev"><a class="btn btn-purple" href="displayEpisode/<?php echo $seriesId; ?>/<?php echo $episode_before; ?>/<?php echo $episode_unitary_published['id']; ?>">Episode précédent</a></p>
    <?php
    }else{
    ?>
        <div class="button-prevnext">
            <p class="button-prev"><a class="btn btn-purple" href="displayEpisode/<?php echo $seriesId; ?>/<?php echo $episode_before; ?>/<?php echo $episode_unitary_published['id']; ?>">Episode précédent</a></p>
            <?php
            if(!isset($_SESSION['level']) AND $episode_current > 2) // On accède à la suite des épisodes que si on est connecté. Dans un temps 2 il faudra aussi payer pour les séries éditeurs
            {
            ?>
                <p class="info-center"><a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">Connectez-vous</a> pour accéder à la suite des épisodes !</p>
            <?php
            }else{
            ?>
                <p class="button-next"><a class="btn btn-purple" href="displayEpisode/<?php echo $seriesId; ?>/<?php echo $episode_next; ?>/<?php echo $episode_unitary_published['id']; ?>">Episode suivant</a></p>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
</section>
<section id="episode-comments"> <!-- Section avec les commentaires -->
    <h2>Commentaires</h2>   
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
                <li class="comment-content-text">
                    <article>
                        <!-- Si l'auteur est un éditeur -->
                        <?php
                        if($comment_data['type'] === "publisher")
                        {
                        ?>
                            <div class="member">
                                <p><img src="<?php echo $comment_data['logo']; ?>" alt="<?php echo $comment_data['altlogo']; ?>"/></p>
                                <p><a href="index.php?action=displayMember&idmember=<?php echo $comment_data['idmember']; ?>"><?php echo $comment_data['name']; ?></a></p>
                            </div>
                        <!-- Si l'auteur est un autre utilisateur -->
                        <?php
                        }else{
                        ?> 
                            <div class="member"> 
                                <p><img src="<?php echo $comment_data['avatar']; ?>" alt="<?php echo $comment_data['altavatar']; ?>"/></p>  
                                <p><a href="index.php?action=displayMember&idmember=idmember=<?php echo $comment_data['idmember']; ?>"><?php echo $comment_data['pseudo']; ?></a></p>
                            </div>
                        <?php
                        }
                        ?>
                        <p class="episode-comments-date"><i>le <?php 
                        $date = new DateTime($comment_data['date']);
                        echo $date->format('d/m/Y à H:i'); ?></i></p>
                        <p><?php echo ($comment_data['content']); ?></p>
                        <?php
                        // On en peut signaler que si on est connecté
                        if ($_SESSION != NULL)
                        {
                        ?>
                            <input type="hidden" class="idcommentalert" value=<?php echo $comment_data['id']; ?>>
                            <p class="btn__alert"><button class="alertcomment btn btn-grey">Signaler</button></p>
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
        <p>Vous devez être connecté(e) pour laisser un commentaire. <a href="subscription">S'inscrire</a> ou <a href="index.php?action=login&ref=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episodeId; ?>">se connecter</a>.</p>
    <?php
    }else{
    ?>
        <form action="index.php?action=writeComment_post&idseries=<?php echo $seriesId; ?>&number=<?php echo $episodeNumber; ?>&idepisode=<?php echo $episode_unitary_published['id']; ?>" method="post">
            <p>
                <label for="comment">Saisissez votre commentaire</label><br />
                <textarea id="comment" name="comment" minlength = "4" required></textarea>
            </p>
            <p>
                <input class="btn btn-purple" type="submit" value="Envoyer">
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