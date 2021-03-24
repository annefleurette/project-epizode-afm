
<?php
$head_title = 'Epizode - Découvrir la série';
$head_description = "Blabla";
ob_start();
?>
<section>
    <h1><?php echo $oneSeriesUserData['title']; ?></h1>
    <p><img src="<?php echo $oneSeriesUserData['cover']; ?>" alt="Blabla"/></p>
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
    <p><?php echo $oneSeriesUserData['numberEpisodes']; ?> épisodes</p>
    <p><?php echo $oneSeriesUserData['numberSubscribers']; ?> abonnés</p>
    <p><?php echo $oneSeriesUserData['tags']; ?></p>
    <p><?php echo $oneSeriesUserData['pricing']; ?></p>
    <p><?php echo $oneSeriesUserData['publishing']; ?></p>
    <p><?php echo $oneSeriesUserData['rights']; ?></p>
    <p><a href=#>S'ABONNER</a></p>
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
                            <p><a href = #>LIRE</a></p>
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
        foreach ($seriesCommonTags as $seriesTags)
        {
        ?>
            <li>
                <article>
                    <p><?php echo $seriesTags['title']; ?></p>
                    <p><img src="<?php echo $seriesTags['cover']; ?>" alt="Blabla"/></p>
                    <p><img src="<?php echo $seriesTags['avatar']; ?>" alt="blabla"/></p>  
                    <p><?php echo $seriesTags['member']; ?></p>
                    <p><?php echo $seriesTags['numberEpisodes']; ?> épisodes</p>
                    <p><?php echo $seriesTags['numberSubscribers']; ?> abonnés</p>
                    <p><?php echo $seriesTags['tags']; ?></p>
                    <p><?php echo $seriesTags['pricing']; ?></p>
                </article>
            </li>
        <?php
        }
        ?>
    </ul>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>