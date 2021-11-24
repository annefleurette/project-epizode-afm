<?php
// Page qui présente la fiche d'un membre
$head_title = 'Epizode - Informations sur le membre';
ob_start();
?>
<section id="member-info">
    <?php
    // Si le membre est un amateur
    if($userPublicData['type'] == "user")
    {
    ?>
        <p><img src="<?php echo $userPublicData['avatar']; ?>" alt="<?php echo $userPublicData['altavatar']; ?>"/></p>
        <h1 <?php if(strlen($userPublicData['pseudo']) >= 30 AND strlen($userPublicData['pseudo']) <= 70){ echo "class=medium-title";}elseif(strlen($userPublicData['pseudo']) > 70){ echo "class=big-title";}?>><?php echo $userPublicData['pseudo']; ?></h1>
        <?php
        if(isset($userPublicData['description']))
        {
        ?>
            <p><?php echo $userPublicData['description']; ?></p>
        <?php
        }else{
        ?>
            <p class="no">Pas de description</p>
        <?php    
        }
        ?>
        <p class="member-info__counts"><?php echo $userPublicData['numberSubscriptions']; ?> abonnement(s)</p>
        <p class="member-info__counts"><?php echo $userPublicData['numberWritings']; ?> série(s) publiée(s)</p>
    <?php
    // Si le membre est un éditeur
    }elseif($userPublicData['type'] == "publisher"){
    ?>
        <p><img class="logo" src="<?php echo $userPublicData['logo']; ?>" alt="<?php echo $userPublicData['altlogo']; ?>"/></p>
        <h1 <?php if(strlen($userPublicData['name']) >= 30 AND strlen($userPublicData['name']) <= 70){ echo "class=medium-title";}elseif(strlen($userPublicData['name']) > 70){ echo "class=big-title";}?>><?php echo $userPublicData['name']; ?></h1>
        <?php
        if(isset($userPublicData['description']))
        {
        ?>
            <p><?php echo $userPublicData['description']; ?></p>
        <?php
        }else{
        ?>
            <p class="no">Pas de description</p>
        <?php    
        }
        ?>
        <p class="member-info__counts"><?php echo $userPublicData['numberAuthors']; ?> auteur(s)</p>
        <p class="member-info__counts"><?php echo $userPublicData['numberWritings']; ?> série(s) publiée(s)</p>
    <?php
    }
    ?>
</section>
<nav> <!-- Navigation entre les grandes catégories d'informations du membre -->
    <ul class="menu__second">
        <li class="elementTab" data-index="1"><p><span>Ses séries</span></p></li>
        <?php
        if($userPublicData['type'] == "user")
        {
        ?>
        	<li class="elementTab" data-index="2"><p><span>Ses lectures</span></p></li>
        <?php
        }elseif($userPublicData['type'] == "publisher"){
        ?>
       		<li class="elementTab" data-index="2"><p><span>Ses auteurs</span></p></li>
       	<?php
       	}
       	?>
    </ul>
</nav>
<section class="elementContent figure-bloc section-internal" data-tab="1"> <!-- Section qui affiche les séries écrites par le membre -->
<?php
    // Si les séries existent
    if($getAllPublicSeriesMember != NULL)
    {
    ?>    
        <ul>
            <?php
            foreach ($getAllPublicSeriesMember as $allSeriesMember)
            {
                // Si la série est bien publiée
                if($allSeriesMember['publishing'] == "published")
                {
                ?>
                    <li>
                        <figure>
                            <p><img class="cover" src="<?php echo $allSeriesMember['cover']; ?>" alt="<?php echo $allSeriesMember['altcover']; ?>"/></p>
                            <figcaption>
                                <h3><?php echo $allSeriesMember['title']; ?></h3>
                                <?php
                                if($allSeriesMember['type'] === "publisher")
                                {
                                ?>
                                    <p><?php echo $allSeriesMember['author_publisher']; ?></p>
                                <?php
                                }
                                ?>
                                <p><?php echo $allSeriesMember['numberEpisodes']; ?> épisode(s)</p>
                                <p><?php echo $allSeriesMember['numberSubscribers']; ?> abonné(s)</p>
                                <p class="tags"><?php echo $allSeriesMember['tags']; ?></p>
                                <?php
                                if($allSeriesMember['type'] === "publisher")
                                {
                                ?>
                                    <p>Série payante</p>
                                <?php
                                }
                                ?>
                                <br />
                                <div><a class="btn btn-purple" href="displaySeries/<?php echo $allSeriesMember['id']; ?>">Découvrir la série à lire</a></div>
                            </figcaption>
                        </figure>
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
        <p class="no">Il n'y a pas encore de série publiée !</p>
    <?php
    }
    ?>
</section>
<?php
// Si l'utilisateur est un amateur
if($userPublicData['type'] == "user")
{
?>
	<section class="elementContent figure-bloc section-internal" hidden data-tab="2"> <!-- Section qui affiche les séries auxquelles le membre est abonné -->
        <?php
        // Si le membre est abonné à au moins une série
        if($getAllSubscriptionSeries != NULL)
        {
        ?>    
            <ul>
                <?php
                foreach ($getAllSubscriptionSeries as $allSubscriptionSeries)
                {
                    // Si la série est bien publiée
                    if($allSubscriptionSeries['publishing'] == "published")
                    {
                    ?>
                        <li>
                            <figure>
                                <p><img class="cover" src="<?php echo $allSubscriptionSeries['cover']; ?>" alt="<?php echo $allSubscriptionSeries['altcover']; ?>"/></p>
                                <figcaption>
                                    <h3><?php echo $allSubscriptionSeries['title']; ?></h3>
                                    <?php
                                    // Si la série est écrite par un éditeur
                                    if($allSubscriptionSeries['type'] === "publisher")
                                    {
                                    ?>
                                        <div class="member">
                                            <img src="<?php echo $allSubscriptionSeries['logo']; ?>" alt="<?php echo $allSubscriptionSeries['altlogo']; ?>"/>
                                            <p><a href="index.php?action=displayMember&idmember=<?php echo $allSubscriptionSeries['idmember']; ?>"><?php echo $allSubscriptionSeries['publisher']; ?></a></p>
                                        </div>
                                    <?php
                                    // Si la série est écrite par un autre utilisateur
                                    }else{
                                    ?>
                                        <div class="member">
                                            <img src="<?php echo $allSubscriptionSeries['avatar']; ?>" alt="<?php echo $allSubscriptionSeries['altavatar']; ?>"/>
                                            <p><a href="index.php?action=displayMember&idmember=<?php echo $allSubscriptionSeries['idmember']; ?>"><?php echo $allSubscriptionSeries['member']; ?></a></p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <p><?php echo $allSubscriptionSeries['numberEpisodes']; ?> épisode(s)</p>
                                    <p><?php echo $allSubscriptionSeries['numberSubscribers']; ?> abonné(s)</p>
                                    <p class="tags"><?php echo $allSubscriptionSeries['tags']; ?></p>
                                    <?php
                                    // Si la série est écrite par un éditeur
                                    if($allSubscriptionSeries['type'] === "publisher")
                                    {
                                    ?>
                                        <p>Série payante</p>  
                                    <?php
                                    // Si la série est écrite par un autre utilisateur
                                    }else{
                                    ?>
                                        <p>Série gratuite</p>
                                    <?php
                                    }
                                    ?>
                                    <br/>
                                    <div><a class="btn btn-purple" href="displaySeries/<?php echo $allSubscriptionSeries['id']; ?>">Découvrir la série à lire</a></div>
                                </figcaption>
                            </figure>
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
            <p class="no"><?php echo $userPublicData['pseudo']; ?> n'est pas encore abonné(e) à une série !</p>
        <?php
        }
        ?>
	</section>
<?php
// Si l'utilisateur est un éditeur
}elseif($userPublicData['type'] == "publisher"){
?>
	<section class="elementContent member-info__authors" hidden data-tab="2"> <!-- Section qui affiche la liste des auteurs de l'éditeur -->
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
                                <h3><?php echo $authorPresentation['author']; ?></h3>
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
                <p class="no">Cet éditeur n'a pas encore d'auteur !</p>
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