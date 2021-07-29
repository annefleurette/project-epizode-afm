
<?php
$head_title = 'Epizode - Informations sur le membre';
ob_start();
?>
<nav>
    <ul>
        <li class="memberTab" data-index="1">Ses séries</li>
        <?php
        if($userData['type'] == "user")
        {
        ?>
        	<li class="memberTab" data-index="2">Ses lectures</li>
        <?php
        }elseif($userData['type'] == "publisher"){
        ?>
       		<li class="memberTab" data-index="2">Ses auteurs</li>
       	<?php
       	}
       	?>
    </ul>
</nav>
<!-- On affiche les séries écrites par le membre -->
<section class="seriesList" data-tab="1">
<?php
    if($getAllSeriesMember != NULL)
    {
    ?>    
        <ul>
            <?php
            foreach ($getAllSeriesMember as $allSeriesMember)
            {
            ?>
                <li>
                    <article>
                        <p><?php echo $allSeriesMember['title']; ?></p>
                        <p><img src="<?php echo $allSeriesMember['cover']; ?>" alt="<?php echo $allSeriesMember['altcover']; ?>"/></p>
                        <p><?php echo $allSeriesMember['numberEpisodes']; ?> épisode(s)</p>
                        <p><?php echo $allSeriesMember['numberSubscribers']; ?> abonné(s)</p>
                        <p><?php echo $allSeriesMember['tags']; ?></p>
                        <p><?php echo $allSeriesMember['publishing']; ?></p>
                        <?php
                        if($allSeriesMember['type'] === "publisher")
                        {
                        ?>
                            <p><?php echo $allSeriesMember['pricing']; ?></p>
                            <p><img src="<?php echo $allSeriesMember['logo']; ?>" alt="<?php echo $allSeriesMember['altlogo']; ?>"/></p>
                            <p><?php echo $allSeriesMember['publisher']; ?></p>
                            <p><?php echo $allSeriesMember['publisher_author']; ?></p>
                        <?php
                        }else{
                        ?>  
                            <p><img src="<?php echo $allSeriesMember['avatar']; ?>" alt="<?php echo $allSeriesMember['altavatar']; ?>"/></p>  
                            <p><?php echo $allSeriesMember['member']; ?></p>
                         <?php
                        }
                        ?>
                        <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesId; ?> ?>">DECOUVRIR LA SERIE</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    }else{
    ?>
        <p>Il n'y a pas encore de série publiée</p>
    <?php
    }
    ?>
</section>
<?php
if($userData['type'] == "user")
{
?>
    <!-- On affiche les séries auxquelles le membre est abonné -->
	<section class="readingsList" data-tab="2">
        <?php
        if($getAllSubscriptionSeries != NULL)
        {
        ?>    
            <ul>
                <?php
                foreach ($getAllSubscriptionSeries as $allSubscriptionSeries)
                {
                ?>
                    <li>
                        <article>
                            <p><?php echo $allSubscriptionSeries['title']; ?></p>
                            <p><img src="<?php echo $allSubscriptionSeries['cover']; ?>" alt="<?php echo $allSubscriptionSeries['altcover']; ?>"/></p>
                            <p><?php echo $allSubscriptionSeries['numberEpisodes']; ?> épisode(s)</p>
                            <p><?php echo $allSubscriptionSeries['numberSubscribers']; ?> abonné(s)</p>
                            <p><?php echo $allSubscriptionSeries['tags']; ?></p>
                            <p><?php echo $allSubscriptionSeries['publishing']; ?></p>
                            <?php
                            if($allSubscriptionSeries['type'] === "publisher")
                            {
                            ?>
                                <p><?php echo $allSubscriptionSeries['pricing']; ?></p>
                                <p><img src="<?php echo $allSubscriptionSeries['logo']; ?>" alt="<?php echo $allSubscriptionSeries['altlogo']; ?>"/></p>
                                <p><?php echo $allSubscriptionSeries['publisher']; ?></p>
                                <p><?php echo $allSubscriptionSeries['publisher_author']; ?></p>
                            <?php
                            }else{
                            ?>  
                                <p><img src="<?php echo $allSubscriptionSeries['avatar']; ?>" alt="<?php echo $allSubscriptionSeries['altavatar']; ?>"/></p>  
                                <p><?php echo $allSubscriptionSeries['member']; ?></p>
                            <?php
                            }
                            ?>
                            <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesId; ?> ?>">DECOUVRIR LA SERIE</a></p>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }else{
        ?>
            <p>Il n'y a pas encore de série publiée</p>
        <?php
        }
        ?>
	</section>
<?php
}elseif($userData['type'] == "publisher"){
?>
	<section class="authorsList" data-tab="2">
	</section>
<?php    
}
?>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>