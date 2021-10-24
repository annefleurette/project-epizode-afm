<?php
// Page qui présente une série
$head_title = $oneSeriesPublicData['title'];
$head_description = $oneSeriesPublicData['meta'];
ob_start();
?>
<section> <!-- Section avec les informations sur la série -->
    <h1><?php echo $oneSeriesPublicData['title']; ?></h1>
    <p><img src="<?php echo $oneSeriesPublicData['cover']; ?>" alt="<?php echo $oneSeriesPublicData['altcover']; ?>"/></p>
    <?php
    // Si la série est écrite par un éditeur
    if($oneSeriesPublicData['type'] === "publisher")
    {
    ?>
        <p><img src="<?php echo $oneSeriesPublicData['logo']; ?>" alt="<?php echo $oneSeriesPublicData['altlogo']; ?>"/></p>
        <p><a href="index.php?action=displayMember&idmember=<?php echo $oneSeriesPublicData['idmember']; ?>"><?php echo $oneSeriesPublicData['publisher']; ?></a></p>
        <p><?php echo $oneSeriesPublicData['publisher_author']; ?></p>
    <?php
    // Si la série est écrite par un autre utilisateur
    }else{
    ?>  
        <p><img src="<?php echo $oneSeriesPublicData['avatar']; ?>" alt="<?php echo $oneSeriesPublicData['altavatar']; ?>"/></p>  
        <p><a href="index.php?action=displayMember&idmember=<?php echo $oneSeriesPublicData['idmember']; ?>"><?php echo $oneSeriesPublicData['member']; ?></a></p>
    <?php
    }
    ?>
    <p><?php echo $oneSeriesPublicData['numberEpisodes']; ?> épisode(s)</p>
    <p><span id="nbSubscriptions"><?php echo $seriesSubscription[0]; ?></span> abonné(s)</p>
    <p><?php echo $oneSeriesPublicData['tags']; ?></p>
    <?php
    // Si la série est payante
    if($oneSeriesPublicData['pricing'] == "paying")
    {
    ?>
        <p><i class="fas fa-coins"></i></p>
    <?php
    // Si la série est gratuite
    }else{
    ?>
        <p>Série gratuite</p>
    <?php
    }
    ?>
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
    <p><?php echo $oneSeriesPublicData['summary']; ?></p>
    <!-- Gestion des ajouts à la bibliothèque -->
    <?php
    // On ne peut ajouter à la bibliothèque que si on est connecté
    if(isset($_SESSION['idmember']))
    {
    ?>
        <input type="hidden" id="idseries" value=<?php echo $seriesId; ?>>
        <button class=".cta .btn" id="subscribe"<?php if(in_array($_SESSION['idmember'], $seriesSubscribers)){ echo 'class="hidden"'; }?>>Ajouter à ma bibliothèque</button>
        <button class=".cta .btn" id="unsubscribe" <?php if(!in_array($_SESSION['idmember'], $seriesSubscribers)){ echo 'class="hidden"'; }?>>Retirer de ma bibliothèque</button>
    <?php
    // Si on est pas connecté
    }else{
    ?>
        <p>Pour vous abonner à une série, <a href="index.php?action=login&ref=displaySeries&idseries=<?php echo $seriesId; ?>">CONNECTEZ-VOUS !</a></p>
    <?php
    }
    ?>
</section>
<section> <!-- Section avec la liste des épisodes publiés de la série -->
    <h2>Episodes de <?php echo $oneSeriesPublicData['title']; ?></h2>
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
                        <article>
                            <p>Episode n°<?php echo $allEpisodesPublished['number']; ?></p>
                            <p><?php echo $allEpisodesPublished['title']; ?></p>
                            <?php
                            if($allEpisodesPublished['price'] != 0)
                            {
                            ?>
                                <p><i class="fas fa-coins"></i><?php echo $allEpisodesPublished['price']; ?></p>
                            <?php
                            }else{
                            ?>
                                <p>Episode gratuit</p>
                            <?php
                            }
                            ?>
                            <p><i class="fas fa-heart"></i><?php echo $allEpisodesPublished['likesNumber']; ?></p>
                            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $allEpisodesPublished['number']; ?>&idepisode=<?php echo $allEpisodesPublished['id']; ?>">LIRE</a></p>
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
<section> <!-- Section qui présente des séries similaires en termes de tags -->
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
                        <article>
                            <p><a href="index.php?action=displaySeries&idseries=<?php echo $allTagsSeries[$i][$j]['id']; ?>"><?php echo $allTagsSeries[$i][$j]['title']; ?></a></p>
                            <p><img src="<?php echo $allTagsSeries[$i][$j]['cover']; ?>" alt="<?php echo $oneSeriesPublicData['altcover']; ?>"/></p>
                            <p><img src="<?php echo $allTagsSeries[$i][$j]['avatar']; ?>" alt="<?php echo $oneSeriesPublicData['altavatar']; ?>"/></p>  
                            <p><a href="index.php?action=displayMember&idmember=<?php echo $allTagsSeries[$i][$j]['idmember']; ?>"><?php echo $allTagsSeries[$i][$j]['member']; ?></a></p>
                            <p><?php echo $allTagsSeries[$i][$j]['numberEpisodes']; ?> épisode(s)</p>
                            <p><?php echo $allTagsSeries[$i][$j]['numberSubscribers']; ?> abonné(s)</p>
                            <p><?php echo $allTagsSeries[$i][$j]['tags']; ?></p>
                            <?php
                            // Si la série est payante
                            if($allTagsSeries[$i][$j]['pricing'] == "paying")
                            {
                            ?>
                                <p><i class="fas fa-coins"></i></p>
                            <?php
                            // Si la série est gratuite
                            }else{
                            ?>
                                <p>Série gratuite</p>
                            <?php
                            }
                            ?>
                        </article>
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