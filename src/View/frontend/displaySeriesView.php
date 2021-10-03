
<?php
$head_title = 'Epizode - Découvrir la série';
$head_description = "Blabla";
ob_start();
?>
<section>
    <h1><?php echo $oneSeriesPublicData['title']; ?></h1>
    <p><img src="<?php echo $oneSeriesPublicData['cover']; ?>" alt="<?php echo $oneSeriesPublicData['altcover']; ?>"/></p>
    <?php
    if($oneSeriesPublicData['type'] === "publisher")
    {
    ?>
        <p><img src="<?php echo $oneSeriesPublicData['logo']; ?>" alt="<?php echo $oneSeriesPublicData['altlogo']; ?>"/></p>
        <p><?php echo $oneSeriesPublicData['publisher']; ?></p>
        <p><?php echo $oneSeriesPublicData['publisher_author']; ?></p>
    <?php
    }else{
    ?>  
        <p><img src="<?php echo $oneSeriesPublicData['avatar']; ?>" alt="<?php echo $oneSeriesPublicData['altavatar']; ?>"/></p>  
        <p><?php echo $oneSeriesPublicData['member']; ?></p>
    <?php
    }
    ?>
    <p><?php echo $oneSeriesPublicData['numberEpisodes']; ?> épisode(s)</p>
    <p><span id="nbSubscriptions"><?php echo $seriesSubscription[0]; ?></span> abonné(s)</p>
    <p><?php echo $oneSeriesPublicData['tags']; ?></p>
    <p><?php echo $oneSeriesPublicData['pricing']; ?></p>
    <p><?php echo $oneSeriesPublicData['rights']; ?></p>
    <!-- Gestion des likes -->
    <?php
    if(isset($_SESSION['idmember']))
    {
    ?>
        <input type="hidden" id="idseries" value=<?php echo $seriesId; ?>>
        <button id="subscribe" <?php if(in_array($_SESSION['idmember'], $seriesSubscribers)){ echo 'class="hidden"'; }?>>AJOUTER A MA BIBLIOTHEQUE</button>
        <button id="unsubscribe" <?php if(!in_array($_SESSION['idmember'], $seriesSubscribers)){ echo 'class="hidden"'; }?>>RETIRER DE MA BIBLIOTHEQUE</button>
    <?php
    }else{
    ?>
        <p><a href="index.php?action=login&ref=displaySeries&idseries=<?php echo $seriesId; ?>">CONNECTEZ-VOUS</a> pour vous abonner à une série !</p>
    <?php
    }
    ?>
</section>
<section>
    <h2>Episodes de <?php echo $oneSeriesPublicData['title']; ?></h2>
        <?php
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
                            <p><?php echo $allEpisodesPublished['price']; ?> euros</p>
                            <p><?php echo $allEpisodesPublished['likesNumber']; ?> likes</p>
                            <p><a href="index.php?action=displayEpisode&idseries=<?php echo $seriesId; ?>&number=<?php echo $allEpisodesPublished['number']; ?>&idepisode=<?php echo $allEpisodesPublished['id']; ?>">LIRE</a></p>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }else{
        ?>
            <p>La série n'a pas encore d'épisode.</p>
        <?php
        }
        ?> 
</section>
<section>
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
                            <p><?php echo $allTagsSeries[$i][$j]['pricing']; ?></p>
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