<?php
// Page tableau de bord d'un utilisateur connecté
$head_title = 'Epizode - Mon tableau de bord';
ob_start();
?>
<section id="member-info"> <!-- Section avec les informations sur le membre connecté -->
<?php
    // Si le membre est un amateur
    if($_SESSION['level'] == 10)
    {
        if(isset($userData['avatar']))
        {
        ?>
            <p><img src="<?php echo $userData['avatar']; ?>" alt="<?php echo $userData['altavatar']; ?>" /></p>
        <?php
        }
        ?>
        <h1>Bonjour <?php echo $userData['pseudo']; ?> !</h1>
        <p class="member-info__counts"><?php echo $userData['numberSubscriptions']; ?> abonnement(s)</p>
        <p class="member-info__counts"><?php echo $userData['numberWritings']; ?> série(s) publiée(s) ou en cours</p>
        <p><em>
        Membre depuis le 
        <?php
            $date = new DateTime($userData['subscriptionDate']);
            echo $date->format('d/m/Y');
        ?>
        </em></p>
    <?php
    // Si le membre est un éditeur
    }elseif($_SESSION['level'] == 20)
    {
        if(isset($userData['logo']))
        {
        ?>
            <p><img src="<?php echo $userData['logo']; ?>" alt="<?php echo $userData['altlogo']; ?>"/></p>
        <?php
        }
        ?>
        <p>Bonjour <?php echo $userData['pseudo']; ?>, content de vous revoir !</p>
        <p><?php echo $userData['description']; ?></p>
        <p><?php echo $userData['numberSubscriptions']; ?> abonnement(s)</p>
        <p><?php echo $userData['numberAuthors']; ?> auteur(s)</p>
        <p><?php echo $userData['numberWritings']; ?> série(s) publiée(s) ou en cours</p>
        <p>Date d'inscription : <?php echo $userData['subscriptionDate']; ?></p>
    <?php
    }
    ?>
</section>
<nav class="menu__second"> <!-- Accès à la bibliothèque de séries ou au studio de production -->
    <ul>
        <li class="elementTab" data-index="1">Ma bibliothèque de séries</li>
        <li class="elementTab" data-index="2">Mon studio de production</li>
    </ul>
</nav>
<section id="member-library" class="elementContent figure-bloc" data-tab="1"> <!-- Section bibliothèque de séries -->
<?php
    // Si le membre a ajouté au moins une série à sa bibliothèque
    if(!empty($getAllSubscriptionSeries))
    {
    ?>
        <ul>
            <?php
            foreach ($getAllSubscriptionSeries as $subscriptionSeries)
            {
            ?>
                <li>
                    <figure>
                        <img src="<?php echo $subscriptionSeries['cover']; ?>" alt="<?php echo $subscriptionSeries['altcover']; ?>"/>
                        <figcaption>
                            <h3><?php echo $subscriptionSeries['title']; ?></h3>
                            <?php
                            // Si la série est écrite par un éditeur
                            if($subscriptionSeries['type'] === "publisher")
                            {
                            ?>
                                <div class="member">
                                        <p class="figure-bloc-member"><img src="<?php echo $subscriptionSeries['logo']; ?>" alt="<?php echo $subscriptionSeries['altlogo']; ?>"/></p>
                                        <p><a href="index.php?action=displayMember&idmember=<?php echo $subscriptionSeries['idmember']; ?>"><?php echo $subscriptionSeries['publisher']; ?></a></p>
                                </div>
                            <?php
                            // Si la série est écrite par un autre utilisateur
                            }elseif($subscriptionSeries['type'] === "user")
                            {
                            ?>  
                                <div class="member">
                                    <p class="figure-bloc-member"><img src="<?php echo $subscriptionSeries['avatar']; ?>" alt="<?php echo $subscriptionSeries['altavatar']; ?>"/></p>  
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $subscriptionSeries['idmember']; ?>"><?php echo $subscriptionSeries['member']; ?></a></p>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($subscriptionSeries['type'] === "publisher")
                            {
                            ?>
                                <p>Auteur : <?php echo $subscriptionSeries['author_publisher']; ?></p>
                            <?php
                            }
                            ?>
                            <p><?php echo $subscriptionSeries['numberEpisodes']; ?> épisode(s)</p>
                            <p class="tags"><?php echo $subscriptionSeries['tags']; ?></p>
                            <br />
                            <p><a class="btn btn-purple" href="index.php?action=displaySeries&idseries=<?php echo $subscriptionSeries['id']; ?>">Lire la série</a></p>
                            <p><a class="btn btn-grey" href="index.php?action=removeSubscriptionLibrary&idseries=<?php echo $subscriptionSeries['id']; ?>">Retirer la série de ma bibliothèque</a></p>
                        </figcaption>
                    </figure>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si le membre n'a pas ajouté de série à sa bibliothèque
    }else{
    ?>
        <p><?php echo $userData['pseudo']; ?>, vous n'avez pas encore ajouté de série à votre bibliothèque !</p>
    <?php
    }
    ?>
</section>
<section class="elementContent figure-bloc hidden" data-tab="2"> <!-- Section studio de production de séries -->
    <p class="newseries"><a class="btn btn-violet" href="index.php?action=writeSeries">+ J'écris une nouvelle série !</a></p>
    <?php
    // Si le membre a au moins déjà écrit une série
    if(!empty($getAllSeriesMember))
    {
    ?>
        <ul>
            <?php
            foreach ($getAllSeriesMember as $seriesMember)
            {
            ?>
                <li>
                    <figure>
                        <img src="<?php echo $seriesMember['cover']; ?>" alt="<?php echo $seriesMember['altcover']; ?>"/>
                        <figcaption>
                            <h3><a href="index.php?action=displaySeries&idseries=<?php echo $seriesMember['id']; ?>"><?php echo $seriesMember['title']; ?></a></h3>
                            <p><?php echo $seriesMember['numberEpisodes']; ?> épisode(s)</p>
                            <p><?php echo $seriesMember['numberSubscribers']; ?> abonné(s)</p>
                            <?php
                            // Si la série est publiée
                            if($seriesMember['publishing'] == "published")
                            {
                            ?>
                                <p>Série publiée</p>
                            <?php    
                            // Si la série est en cours
                            }elseif($seriesMember['publishing'] == "inprogress")
                            {
                            ?>
                                <p>Série en cours<p>
                            <?php
                            }
                            ?>
                            <p><a class="btn btn-purple" href="index.php?action=updateSeries&idseries=<?php echo $seriesMember['id']; ?>">Continuer l'écriture de la série</a></p>
                            <p><a class="delete btn btn-grey" href="index.php?action=userDeleteSeries&idseries=<?php echo $seriesMember['id']; ?>">Supprimer la série</a></p>
                        </figcaption>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si le membre n'a pas encore écrit de série
    }else{
    ?>
        <p><?php echo $userData['pseudo']; ?>, vous n'avez pas encore écrit de série !</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>