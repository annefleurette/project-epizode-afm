
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<section>
<?php
    if($userData['type'] == "user")
    {
    ?>
        <p><img src="<?php echo $userData['avatar']; ?>" alt="<?php echo $userData['altavatar']; ?>"/></p>
        <p><?php echo $userData['pseudo']; ?></p>
        <p><?php echo $userData['description']; ?></p>
        <p><?php echo $userData['numberSubscriptions']; ?> abonnement(s)</p>
        <p><?php echo $userData['numberWritings']; ?> série(s) dans le studio de production</p>
        <p>
        Membre depuis le 
        <?php
            $date = new DateTime($userData['subscriptionDate']);
            echo $date->format('d/m/Y');
        ?>
        </p>
    <?php
    }elseif($userData['type'] == "publisher"){
    ?>
        <p><img src="<?php echo $userData['logo']; ?>" alt="<?php echo $userData['altlogo']; ?>"/></p>
        <p><?php echo $userData['pseudo']; ?></p>
        <p><?php echo $userData['description']; ?></p>
        <p><?php echo $userData['numberSubscriptions']; ?> abonnement(s)</p>
        <p><?php echo $userData['numberAuthors']; ?> auteur(s)</p>
        <p><?php echo $userData['numberWritings']; ?> série(s)</p>
        <p>Date d'inscription : <?php echo $userData['subscriptionDate']; ?></p>
    <?php
    }
    ?>
</section>
<nav>
    <ul>
        <li class="seriesTab" data-index="1">Ma bibliothèque de séries</li>
        <li class="seriesTab" data-index="2">Mon studio de production</li>
    </ul>
</nav>
<section class="seriesContent" data-tab="1">
<?php
    if($getAllSubscriptionSeries !== NULL)
    {
    ?>
        <ul>
            <?php
            foreach ($getAllSubscriptionSeries as $subscriptionSeries)
            {
            ?>
                <li>
                    <article>
                        <p><img src="<?php echo $subscriptionSeries['cover']; ?>" alt="<?php echo $subscriptionSeries['altcover']; ?>"/></p>
                        <input type="hidden" id="idseries" value=<?php echo $subscriptionSeries['id']; ?>>
                        <p><a href="index.php?action=displaySeries&idseries=<?php echo $subscriptionSeries['id']; ?>">LIRE</a></p>
                        <button id="unsubscribe">RETIRER DE MA BIBLIOTHEQUE</button>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    }else{
    ?>
        <p><?php echo $userData['pseudo']; ?> n'est pas encore abonné à une série !</p>
    <?php
    }
    ?>
</section>
<section class="seriesContent hidden" data-tab="2">
    <p><a href="index.php?action=writeSeries">ECRIRE UNE NOUVELLE SERIE</a></p>
    <?php
    if($getAllSeriesMember !== NULL)
    {
    ?>
        <ul>
            <?php
            foreach ($getAllSeriesMember as $seriesMember)
            {
            ?>
                <li>
                    <article>
                        <?php
                        if($seriesMember['publishing'] != "deleted")
                        {
                        ?>
                            <p><img src="<?php echo $seriesMember['cover']; ?>" alt="<?php echo $seriesMember['altcover']; ?>"/></p>
                            <p><?php echo $seriesMember['numberEpisodes']; ?> épisode(s)</p>
                            <p><?php echo $seriesMember['numberSubscribers']; ?> abonné(s)</p>
                            <p><?php echo $seriesMember['publishing']; ?></p>
                            <input type="hidden" id="idseries" value=<?php echo $seriesMember['id']; ?>>
                                <p><a href="index.php?action=updateSeries&idseries=<?php echo $seriesMember['id']; ?>">CONTINUER LA SERIE</a></p>
                                <button id="delete">SUPPRIMER LA SERIE</button>
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
    }else{
    ?>
        <p><?php echo $userData['pseudo']; ?> n'a pas encore écrit de série</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/subscriptions.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>