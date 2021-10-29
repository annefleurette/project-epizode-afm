<?php
// Page qui présente une série
$head_title = $oneSeriesPublicData['title'];
$head_description = $oneSeriesPublicData['meta'];
ob_start();
?>
<section id="series" class="figure-bloc section-internal"> <!-- Section avec les informations sur la série -->
    <figure>
        <p><img src="<?php echo $oneSeriesPublicData['cover']; ?>" alt="<?php echo $oneSeriesPublicData['altcover']; ?>"/></p>
        <figcaption>
            <h1><?php echo $oneSeriesPublicData['title']; ?></h1>
            <div class="member">
                <?php
                // Si la série est écrite par un éditeur
                if($oneSeriesPublicData['type'] === "publisher")
                {
                ?>
                    <p class="figure-bloc-member"><img src="<?php echo $oneSeriesPublicData['logo']; ?>" alt="<?php echo $oneSeriesPublicData['altlogo']; ?>"/></p>
                    <p><a href="index.php?action=displayMember&idmember=<?php echo $oneSeriesPublicData['idmember']; ?>"><?php echo $oneSeriesPublicData['publisher']; ?></a></p>
                <?php
                // Si la série est écrite par un autre utilisateur
                }else{
                ?>  
                    <p class="figure-bloc-member"><img src="<?php echo $oneSeriesPublicData['avatar']; ?>" alt="<?php echo $oneSeriesPublicData['altavatar']; ?>"/></p>  
                    <p><a href="index.php?action=displayMember&idmember=<?php echo $oneSeriesPublicData['idmember']; ?>"><?php echo $oneSeriesPublicData['member']; ?></a></p>
                <?php
                }
                ?>
            </div>
            <?php
            if($oneSeriesPublicData['type'] === "publisher")
            {
            ?>
                <p>Auteur : <?php echo $oneSeriesPublicData['publisher_author']; ?></p>
            <?php
            }
            ?>
            <p class="tags"><?php echo $oneSeriesPublicData['tags']; ?></p>
            <?php
            // Si la série est payante
            if($oneSeriesPublicData['pricing'] == "paying")
            {
            ?>
                <p>Série payante</p>
            <?php
            // Si la série est gratuite
            }else{
            ?>
                <p>Série gratuite</p>
            <?php
            }
            ?>
            <p class="popularity-mesure"><span id="nbSubscriptions"><?php echo $seriesSubscription[0]; ?></span> abonné(s)</p>
            <!-- Gestion des ajouts à la bibliothèque -->
            <?php
            // On ne peut ajouter à la bibliothèque que si on est connecté
            if(isset($_SESSION['idmember']))
            {
            ?>
                <input type="hidden" id="idseries" value=<?php echo $seriesId; ?>>
                <button id="subscribe"<?php if(in_array($_SESSION['idmember'], $seriesSubscribers)){ echo 'class="hidden"'; }?>>Ajouter à ma bibliothèque</button>
                <button id="unsubscribe" <?php if(!in_array($_SESSION['idmember'], $seriesSubscribers)){ echo 'class="hidden"'; }?>>Retirer de ma bibliothèque</button>
            <?php
            // Si on est pas connecté
            }else{
            ?>
                <p>Pour vous abonner à cette série, <a href="index.php?action=login&ref=displaySeries&idseries=<?php echo $seriesId; ?>">connectez-vous !</a></p>
            <?php
            }
            ?>
        </figcaption>
    </figure>
    <div>
        <h2 class="under-series">Synopsis</h2>
        <p><?php echo $oneSeriesPublicData['summary']; ?></p>
        <p><?php echo $oneSeriesPublicData['numberEpisodes']; ?> épisode(s)</p>
                    <!-- Affihage des droits -->
                    <?php if($oneSeriesPublicData['rights'] === "public") {
        ?>
            <p>Domaine public</p>
        <?php 
        }elseif($oneSeriesPublicData['rights'] === "CC")
        {
        ?>
            <p><i class="fab fa-creative-commons"></i></p>
        <?php 
        }elseif($oneSeriesPublicData['rights'] === "CC1")
        {
        ?>
            <p><i class="fab fa-creative-commons"></i> Pas de modification</p>
        <?php 
        }elseif($oneSeriesPublicData['rights'] === "CC2")
        {
        ?>
            <p><i class="fab fa-creative-commons"></i> Pas d'utilisation commerciale - Pas de modification</p>
        <?php 
        }elseif($oneSeriesPublicData['rights'] === "CC3")
        {
        ?>
            <p><i class="fab fa-creative-commons"></i> Pas d'utilisation commerciale</p>
        <?php 
        }elseif($oneSeriesPublicData['rights'] === "CC4")
        {
        ?>
            <p><i class="fab fa-creative-commons"></i> Pas d'utilisation commerciale - Partage dans les mêmes conditions</p>
        <?php
        }elseif($oneSeriesPublicData['rights'] === "CC5")
        {
        ?>
            <p><i class="fab fa-creative-commons"></i> Partage dans les mêmes conditions</p>
        <?php
        }elseif($oneSeriesPublicData['rights'] === "reserved")
        {
        ?>
            <p>Droits réservés</p>
        <?php
        }
        ?>
    </div>
</section>
<section id="series-episodes" class="section-internal"> <!-- Section avec la liste des épisodes publiés de la série -->
    <h2>Episodes de la série <?php echo $oneSeriesPublicData['title']; ?></h2>
        <?php
        // Si la série comporte des épisodes
        if($nbepisodes_published > 0)
        {
        ?>    
            <ul>
                <?php
                foreach ($episodesPublishedList as $allEpisodesPublished)
                {
                ?>
                    <li>
                        <article class="series-episodes-articles">
                            <p><strong>Episode n°<?php echo $allEpisodesPublished['number']; ?> : <?php echo $allEpisodesPublished['title']; ?></strong></p>
                            <?php
                            if($allEpisodesPublished['price'] != 0)
                            {
                            ?>
                                <p>Prix : <?php echo $allEpisodesPublished['price']; ?> euros</p>
                            <?php
                            }else{
                            ?>
                                <p>Episode gratuit</p>
                            <?php
                            }
                            ?>
                            <p class="like-info"><i class="fas fa-heart"></i><?php echo $allEpisodesPublished['likesNumber']; ?></p>
                            <p><a class="btn btn-purple" href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $allEpisodesPublished['number']; ?>&idepisode=<?php echo $allEpisodesPublished['id']; ?>">Lire l'épisode</a></p>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        // Si la série n'a pas encore d'épisode
        }else{
        ?>
            <p>La série n'a pas encore d'épisode !</p>
        <?php
        }
        ?> 
</section>
<section id="series-recommandations" class=" figure-bloc section-internal"> <!-- Section qui présente des séries similaires en termes de tags -->
    <h2>Recommandations <?php echo $oneSeriesPublicData['tags']; ?></h2>
    <ul>
        <?php
        for ($i = 0; $i < $nbtags; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                if (isset($allTagsSeries[$i][$j]['title']) AND $allTagsSeries[$i][$j]['id'] != $seriesId)
                {   
                ?>
                    <li>
                        <figure>
                            <p><img src="<?php echo $allTagsSeries[$i][$j]['cover']; ?>" alt="<?php echo $oneSeriesPublicData['altcover']; ?>"/></p>
                            <figcaption>
                                <h3><?php echo $allTagsSeries[$i][$j]['title']; ?></h3>
                                <div class="member">
                                <?php
                                // Si la série est écrite par un éditeur
                                if($allTagsSeries[$i][$j]['type'] === "publisher")
                                {
                                ?>
                                    <p class="figure-bloc-member"><img src="<?php echo $allTagsSeries[$i][$j]['logo']; ?>" alt="<?php echo $allTagsSeries[$i][$j]['altlogo']; ?>"/></p>
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $allTagsSeries[$i][$j]['idmember']; ?>"><?php echo $allTagsSeries[$i][$j]['publisher']; ?></a></p>
                                <?php
                                // Si la série est écrite par un autre utilisateur
                                }elseif($allTagsSeries[$i][$j]['type'] === "user")
                                {
                                ?>  
                                    <p class="figure-bloc-member"><img src="<?php echo $allTagsSeries[$i][$j]['avatar']; ?>" alt="<?php echo $allTagsSeries[$i][$j]['altavatar']; ?>"/></p>  
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $allTagsSeries[$i][$j]['idmember']; ?>"><?php echo $allTagsSeries[$i][$j]['member']; ?></a></p>
                                <?php
                                }
                                ?>
                                </div>
                                <p><?php echo $allTagsSeries[$i][$j]['numberEpisodes']; ?> épisode(s)</p>
                                <p><?php echo $allTagsSeries[$i][$j]['numberSubscribers']; ?> abonné(s)</p>
                                <p class="tags"><?php echo $allTagsSeries[$i][$j]['tags']; ?></p>
                                <?php
                                // Si la série est payante
                                if($allTagsSeries[$i][$j]['pricing'] == "paying")
                                {
                                ?>
                                    <p>Série payante</p>
                                <?php
                                // Si la série est gratuite
                                }else{
                                ?>
                                    <p>Série gratuite</p>
                                <?php
                                }
                                ?>
                                <br />
                                <div><a class="btn btn-purple" href="index.php?action=displaySeries&idseries=<?php echo $allTagsSeries[$i][$j]['id']; ?>">Découvrir la série à lire</a></div>
                            </figcaption>
                        </figure>
                    </li>
                <?php
                }
            }
        }   
        ?>
    </ul>
</section>
<script type="text/javascript" src="./public/js/subscriptions.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>