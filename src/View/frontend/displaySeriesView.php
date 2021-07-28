
<?php
$head_title = 'Epizode - Découvrir la série';
$head_description = "Blabla";
ob_start();
?>
<section>
    <h1><?php echo $oneSeriesUserData['title']; ?></h1>
    <p><img src="<?php echo $oneSeriesUserData['cover']; ?>" alt="<?php echo $oneSeriesUserData['altcover']; ?>"/></p>
    <?php
    if($oneSeriesUserData['type'] === "publisher")
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
    <p><?php echo $oneSeriesUserData['numberEpisodes']; ?> épisode(s)</p>
    <p><span id="nbSubscriptions"><?php echo $seriesSubscription[0]; ?></span> abonné(s)</p>
    <p><?php echo $oneSeriesUserData['tags']; ?></p>
    <p><?php echo $oneSeriesUserData['pricing']; ?></p>
    <p><?php echo $oneSeriesUserData['publishing']; ?></p>
    <p><?php echo $oneSeriesUserData['rights']; ?></p>
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
        <p><a href="index.php?action=login">CONNECTEZ-VOUS</a> pour vous abonner à une série !</p>
    <?php
    }
    ?>
</section>
<section>
    <h2>Episodes de <?php echo $oneSeriesUserData['title']; ?></h2>
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
    <h2>Recommandations <?php echo $oneSeriesUserData['tags']; ?></h2>
    <ul>
        <?php
        for ($i = 0; $i < $nbtags; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                if (isset($allTagsSeries[$i][$j]['title']))
                {   
                ?>
                    <li>
                        <article>
                            <p><?php echo $allTagsSeries[$i][$j]['title']; ?></p>
                            <p><img src="<?php echo $allTagsSeries[$i][$j]['cover']; ?>" alt="<?php echo $oneSeriesUserData['altcover']; ?>"/></p>
                            <p><img src="<?php echo $allTagsSeries[$i][$j]['avatar']; ?>" alt="<?php echo $oneSeriesUserData['altavatar']; ?>"/></p>  
                            <p><?php echo $allTagsSeries[$i][$j]['member']; ?></p>
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