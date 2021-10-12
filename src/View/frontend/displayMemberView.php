<?php
// Page qui présente la fiche d'un membre
$head_title = 'Epizode - Informations sur le membre';
ob_start();
?>
<section>
<?php
    // Si le membre est un amateur
    if($userPublicData['type'] == "user")
    {
    ?>
        <p><img src="<?php echo $userPublicData['avatar']; ?>" alt="<?php echo $userPublicData['altavatar']; ?>"/></p>
        <p><?php echo $userPublicData['pseudo']; ?></p>
        <?php
        if(isset($userPublicData['description']))
        {
        ?>
            <p><?php echo $userPublicData['description']; ?></p>
        <?php
        }else{
        ?>
            <p>Pas de description</p>
        <?php    
        }
        ?>
        <p><?php echo $userPublicData['numberSubscriptions']; ?> abonnement(s)</p>
        <p><?php echo $userPublicData['numberWritings']; ?> série(s) publiée(s)</p>
    <?php
    // Si le membre est un éditeur
    }elseif($userPublicData['type'] == "publisher"){
    ?>
        <p><img src="<?php echo $userPublicData['logo']; ?>" alt="<?php echo $userPublicData['altlogo']; ?>"/></p>
        <p><?php echo $userPublicData['name']; ?></p>
        <p><?php echo $userPublicData['pseudo']; ?></p>
        <p><?php echo $userPublicData['description']; ?></p>
        <p><?php echo $userPublicData['numberAuthors']; ?> auteurs</p>
        <p><?php echo $userPublicData['numberWritings']; ?> séries publiées</p>
    <?php
    }
    ?>
</section>
<nav> <!-- Navigation entre les grandes catégories d'informations du membre -->
    <ul>
        <li class="elementTab" data-index="1">Ses séries</li>
        <?php
        if($userPublicData['type'] == "user")
        {
        ?>
        	<li class="elementTab" data-index="2">Ses lectures</li>
        <?php
        }elseif($userPublicData['type'] == "publisher"){
        ?>
       		<li class="elementTab" data-index="2">Ses auteurs</li>
       	<?php
       	}
       	?>
    </ul>
</nav>
<section class="elementContent" data-tab="1"> <!-- Section qui affiche les séries écrites par le membre -->
<?php
    // Si les séries existent
    if($getAllPublicSeriesMember != NULL)
    {
    ?>    
        <ul>
            <?php
            foreach ($getAllPublicSeriesMember as $allSeriesMember)
            {
                if($allSeriesMember['publishing'] == "published")
                {
                ?>
                    <li>
                        <article>
                            <p><a href="index.php?action=displaySeries&idseries=<?php echo $allSeriesMember['id']; ?>"><?php echo $allSeriesMember['title']; ?></a></p>
                            <p><img src="<?php echo $allSeriesMember['cover']; ?>" alt="<?php echo $allSeriesMember['altcover']; ?>"/></p>
                            <p><?php echo $allSeriesMember['numberEpisodes']; ?> épisode(s)</p>
                            <p><?php echo $allSeriesMember['numberSubscribers']; ?> abonné(s)</p>
                            <p><?php echo $allSeriesMember['tags']; ?></p>
                            <?php
                            if($allSeriesMember['type'] === "publisher")
                            {
                            ?>
                                <p><?php echo $allSeriesMember['pricing']; ?></p>
                                <p><?php echo $allSeriesMember['author_publisher']; ?></p>
                            <?php
                            }
                            ?>
                        </article>
                    </li>
                <?php
                }
            }
            ?>
        </ul>
    <?php
    // Si aucune série encore écrite
    }else{
    ?>
        <p>Il n'y a pas encore de série publiée !</p>
    <?php
    }
    ?>
</section>
<?php
// Si l'utilisateur est un amateur
if($userPublicData['type'] == "user")
{
?>
	<section class="elementContent" hidden data-tab="2"> <!-- Section qui affiche les séries auxquelles le membre est abonné -->
        <?php
        // Si le membre est abonné à au moins une série
        if($getAllSubscriptionSeries != NULL)
        {
        ?>    
            <ul>
                <?php
                foreach ($getAllSubscriptionSeries as $allSubscriptionSeries)
                {
                    if($allSubscriptionSeries['publishing'] == "published")
                    {
                    ?>
                        <li>
                            <article>
                                <p><a href="index.php?action=displaySeries&idseries=<?php echo $allSubscriptionSeries['id']; ?>"><?php echo $allSubscriptionSeries['title']; ?></a></p>
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
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $allSubscriptionSeries['idmember']; ?>"><?php echo $allSubscriptionSeries['publisher']; ?></a></p>
                                    <p><?php echo $allSubscriptionSeries['author_publisher']; ?></p>
                                <?php
                                }else{
                                ?>  
                                    <p><img src="<?php echo $allSubscriptionSeries['avatar']; ?>" alt="<?php echo $allSubscriptionSeries['altavatar']; ?>"/></p>  
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $allSubscriptionSeries['idmember']; ?>"><?php echo $allSubscriptionSeries['member']; ?></a></p>
                                <?php
                                }
                                ?>
                            </article>
                        </li>
                    <?php
                    }
                }
                ?>
            </ul>
        <?php
        // Si le membre n'est pas encore abonné à une série
        }else{
        ?>
            <p><?php echo $userPublicData['pseudo']; ?> n'est pas encore abonné(e) à une série !</p>
        <?php
        }
        ?>
	</section>
<?php
// Si l'utilisateur est un éditeur
}elseif($userPublicData['type'] == "publisher"){
?>
	<section class="elementContent" hidden data-tab="2"> <!-- Section qui affiche la liste des auteurs de l'éditeur -->
        <?php
            // Si la liste d'auteurs n'est pas nulle
            if($authorsList != NULL)
            {
            ?>    
                <ul>
                    <?php
                    foreach ($authorsList as $authorPresentation)
                    {
                    ?>
                        <li>
                            <article>
                                <p><?php echo $authorPresentation['author']; ?></p>
                                <p><?php echo $authorPresentation['description']; ?></p>
                            </article>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            // Si l'éditeur n'a pas encore d'auteur
            }else{
            ?>
                <p>Cet éditeur n'a pas encore d'auteur !</p>
            <?php
            }
            ?>
	</section>
<?php    
}
?>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>