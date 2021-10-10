<?php
// Page tableau de bord d'un utilisateur connecté
$head_title = 'Epizode - Mon tableau de bord';
ob_start();
?>
<section> <!-- Section avec les informations sur le membre connecté -->
<?php
    // Si le membre est un amateur
    if($userData['type'] == "user")
    {
        if(isset($userData['avatar']))
        {
        ?>
            <p><img src="<?php echo $userData['avatar']; ?>" alt="<?php echo $userData['altavatar']; ?>" /></p>
        <?php
        }
        ?>
        <p>Bonjour <?php echo $userData['pseudo']; ?>, content de vous revoir !</p>
        <p><?php echo $userData['description']; ?></p>
        <p><?php echo $userData['numberSubscriptions']; ?> abonnement(s)</p>
        <p><?php echo $userData['numberWritings']; ?> série(s) publiées ou en cours</p>
        <p>
        Membre depuis le 
        <?php
            $date = new DateTime($userData['subscriptionDate']);
            echo $date->format('d/m/Y');
        ?>
        </p>
    <?php
    // Si le membre est un éditeur
    }elseif($_SESSION['level'] == 20)
    {
        if(isset($userData['avatar']))
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
        <p><?php echo $userData['numberWritings']; ?> série(s) publiées ou en cours</p>
        <p>Date d'inscription : <?php echo $userData['subscriptionDate']; ?></p>
    <?php
    }
    ?>
</section>
<nav> <!-- Accès à la bibliothèque de séries ou au studio de production -->
    <ul>
        <li class="elementTab" data-index="1">Ma bibliothèque de séries</li>
        <li class="elementTab" data-index="2">Mon studio de production</li>
    </ul>
</nav>
<section class="elementContent" data-tab="1"> <!-- Section bibliothèque de séries -->
<?php
    // Si le membre a ajouté au moins une série à sa bibliothèque
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
                        <p><a href="index.php?action=displaySeries&idseries=<?php echo $subscriptionSeries['id']; ?>">LIRE</a></p>
                        <p><a href="index.php?action=removeSubscriptionLibrary&idseries=<?php echo $subscriptionSeries['id']; ?>">RETIRER DE MA BIBLIOTHEQUE</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si le membre n'a pas ajouté de série à sa bibliothèque
    }else{
    ?>
        <p><?php echo $userData['pseudo']; ?> n'a pas encore ajouté de série à sa bibliothèque !</p>
    <?php
    }
    ?>
</section>
<section class="elementContent hidden" data-tab="2"> <!-- Section studio de production de séries -->
    <p><a href="index.php?action=writeSeries">ECRIRE UNE NOUVELLE SERIE</a></p>
    <?php
    // Si le membre a au moins déjà écrit une série
    if($getAllSeriesMember !== NULL)
    {
    ?>
        <ul>
            <?php
            foreach ($getAllSeriesMember as $seriesMember)
            {

                if($seriesMember['publishing'] != "deleted" AND $seriesMember['publishing'] != "banned")
                {
                ?>
                    <li>
                        <article>
                            <p><img src="<?php echo $seriesMember['cover']; ?>" alt="<?php echo $seriesMember['altcover']; ?>"/></p>
                            <p><?php echo $seriesMember['numberEpisodes']; ?> épisode(s)</p>
                            <p><?php echo $seriesMember['numberSubscribers']; ?> abonné(s)</p>
                            <p><?php echo $seriesMember['publishing']; ?></p>
                            <p><a href="index.php?action=updateSeries&idseries=<?php echo $seriesMember['id']; ?>">CONTINUER LA SERIE</a></p>
                            <p><a class="delete" href="index.php?action=updateSeriesStatus&idseries=<?php echo $seriesMember['id']; ?>">SUPPRIMER LA SERIE</a></p>
                        </article>
                    </li>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si le membre n'a pas encore écrit de série
    }else{
    ?>
        <p><?php echo $userData['pseudo']; ?> n'a pas encore écrit de série</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>