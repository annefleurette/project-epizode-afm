<?php
// Page administrateur qui permet des gérer les données
$head_title = 'Epizode - Mon espace administrateur';
ob_start();
?>
<section>
        <h1>Bonjour <?php echo $userData['pseudo']; ?> !</h1>
</section>
<nav class="menu__second menu__second-admin"> <!-- L'administrateur a une vue sur tous les membres, toutes les séries, tous les épisodes et tous les commentaires -->
    <ul>
        <li class="elementTab" data-index="1"><span>Membres</span></li>
        <li class="elementTab" data-index="2"><span>Séries</span></li>
        <li class="elementTab" data-index="3"><span>Episodes</span></li>
        <li class="elementTab" data-index="4"><span>Commentaires</span></li>
    </ul>
</nav>
<section class="elementContent" data-tab="1"> <!-- Section avec les informations sur les membres -->
    <h2>Liste des membres</h2>
    <?php
    // S'il existe au moins un membre
    if($usersData !== NULL)
    {
    ?>
        <table id="myTableMembers" class="responsive nowrap">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Abonnements</th>
                    <th>Productions</th>
                    <th>Nombre d'auteurs</th>
                    <th>Nombre de coins</th>
                    <th>Date d'inscription</th>
                    <th>Action 1</th>
                    <th>Action 2</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usersData as $memberInfo)
                {
                ?>
                <tr>
                    <td><?php echo $memberInfo['id']; ?></td>
                    <td><?php echo $memberInfo['pseudo']; ?></td>
                    <td><?php echo $memberInfo['email']; ?></td>
                    <td><?php echo $memberInfo['type']; ?></td>
                    <td><?php echo $memberInfo['numberSubscriptions']; ?></td>
                    <td><?php echo $memberInfo['numberWritings']; ?> série(s)</td>
                    <td><?php echo $memberInfo['numberAuthors']; ?></td>
                    <td><?php echo $memberInfo['coinsNumber']; ?></td>
                    <td>
                        <?php
                        $date = new DateTime($memberInfo['subscriptionDate']);
                        echo $date->format('d/m/Y');
                        ?>  
                    </td>
                    <td><a href="index.php?action=displayMember&idmember=<?php echo $memberInfo['id']; ?>" TARGET=_BLANK>Voir</a></td>
                    <?php
                    // Pour ne pas se supprimer soi-même
                    if($memberInfo['id'] != $_SESSION['idmember'])
                    {
                    ?>
                        <td class="delete"><a href="index.php?action=deleteMember&idmember=<?php echo $memberInfo['id']; ?>">Supprimer</a></td>
                    <?php
                    }else{
                        echo "<td></td>";
                    }
                    ?>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    // S'il n'y a pas encore de membre
    }else{
    ?>
        <p class="no">Epizode n'a pas encore de membre !</p>
    <?php
    }
    ?>
</section>
<section class="elementContent" data-tab="2"> <!-- Section avec les informations sur les séries -->
    <h2>Liste des séries</h2>
    <?php
    // S'il existe au moins une série
    if($getAllSeries != NULL)
    {
    ?>
        <table id="myTableSeries" class="responsive nowrap display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titre</th>
                    <th>Membre</th>
                    <th>Type</th>
                    <th>Editeur</th>
                    <th>Auteur</th>
                    <th>Statut</th>
                    <th>Coût</th>
                    <th>Tags</th>
                    <th>Droits d'auteurs</th>
                    <th>Nombre d'épisodes</th>
                    <th>Nombre d'abonnés</th>
                    <th>Date de publication</th>
                    <th>Action 1</th>
                    <th>Action 2</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($getAllSeries as $seriesInfo)
                {
                ?>
                <tr>
                    <td><?php echo $seriesInfo['id']; ?></td>
                    <td><?php echo $seriesInfo['title']; ?></td>
                    <td><?php echo $seriesInfo['member']; ?></td>
                    <td><?php echo $seriesInfo['type']; ?></td>
                    <?php
                    // Si l'auteur est un éditeur
                    if(isset($seriesInfo['publisher']))
                    {
                    ?>
                        <td><?php echo $seriesInfo['publisher']; ?></td>
                    <?php
                    // Si l'auteur est un amateur
                    }else{
                        echo "<td></td>";
                    }
                    // Si l'éditeur a enregistré un auteur
                    if(isset($seriesInfo['author']))
                    {
                    ?>
                        <td><?php echo $seriesInfo['author']; ?></td>
                    <?php
                    // S'il n'a pas enregistré d'auteur
                    }else{
                        echo "<td></td>";
                    }
                    ?>
                    <td><?php echo $seriesInfo['publishing']; ?></td>
                    <td><?php echo $seriesInfo['pricing']; ?></td>
                    <td><?php echo $seriesInfo['tags']; ?></td>
                    <!-- Affihage des droits -->
                    <?php if($seriesInfo['rights'] === "public") {
                    ?>
                        <td>Domaine public</td>
                    <?php 
                    }elseif($seriesInfo['rights'] === "CC")
                    {
                    ?>
                        <td><i class="fab fa-creative-commons"></i></td>
                    <?php 
                    }elseif($seriesInfo['rights'] === "CC1")
                    {
                    ?>
                        <td><i class="fab fa-creative-commons"></i> Pas de modification</td>
                    <?php 
                    }elseif($seriesInfo['rights'] === "CC2")
                    {
                    ?>
                        <td><i class="fab fa-creative-commons"></i> Pas d'utilisation commerciale - Pas de modification</td>
                    <?php 
                    }elseif($seriesInfo['rights'] === "CC3")
                    {
                    ?>
                        <td><i class="fab fa-creative-commons"></i> Pas d'utilisation commerciale</td>
                    <?php 
                    }elseif($seriesInfo['rights'] === "CC4")
                    {
                    ?>
                        <td><i class="fab fa-creative-commons"></i> Pas d'utilisation commerciale - Partage dans les mêmes conditions</td>
                    <?php
                    }elseif($seriesInfo['rights'] === "CC5")
                    {
                    ?>
                        <td><i class="fab fa-creative-commons"></i> Partage dans les mêmes conditions</td>
                    <?php
                    }elseif($seriesInfo['rights'] === "reserved")
                    {
                    ?>
                        <td>Droits réservés</td>
                    <?php
                    }
                    ?>
                    <td><?php echo $seriesInfo['numberEpisodes']; ?></td>
                    <td><?php echo $seriesInfo['numberSubscribers']; ?></td>
                    <td>
                        <?php
                        $date = new DateTime($seriesInfo['date']);
                        echo $date->format('d/m/Y');
                        ?>
                    </td>
                    <td><a href="displaySeries/<?php echo $seriesInfo['id']; ?>" TARGET=_BLANK>Voir</a></td>
                    <td class="delete"><a href="index.php?action=adminDeleteSeries&idseries=<?php echo $seriesInfo['id']; ?>">Supprimer</a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    // S'il n'existe pas encore de série
    }else{
    ?>
        <p class="no">Epizode n'a pas encore de série !</p>
    <?php
    }
    ?>
</section>
<section class="elementContent" data-tab="3"> <!-- Section avec les informations sur les épisodes -->
    <div>
        <!-- Les épisodes signalés -->
        <h2>Episodes signalés</h2>
        <?php
        // S'il existe au moins un signalement
        if($getAlertEpisodes != NULL)
        {
        ?>
            <table id="myTableAlertEpisodes" class="responsive display nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Série</th>
                        <th>Type</th>
                        <th>Membre</th>
                        <th>Editeur</th>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Numéro d'épisode</th>
                        <th>Coût</th>
                        <th>Nombre de likes</th>
                        <th>Date de publication</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
                        <th>Action 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($getAlertEpisodes as $alertEpisodeInfo)
                    {
                    ?>
                    <tr>
                        <td><?php echo $alertEpisodeInfo['id']; ?></td>
                        <td><?php echo $alertEpisodeInfo['series']; ?></td>
                        <td><?php echo $alertEpisodeInfo['type']; ?></td>
                        <td><?php echo $alertEpisodeInfo['pseudo']; ?></td>
                        <?php
                        // Si l'auteur est un éditeur
                        if(isset($alertEpisodeInfo['publisher']))
                        {
                        ?>
                            <td><?php echo $alertEpisodeInfo['publisher']; ?></td>
                        <?php
                        // Si l'auteur est un autre utilisateur
                        }else{
                            echo "<td></td>";
                        }
                        // Si l'éditeur a enregistré un auteur
                        if(isset($alertEpisodeInfo['author']))
                        {
                        ?>
                            <td><?php echo $alertEpisodeInfo['author']; ?></td>
                        <?php
                        // S'il n'y a pas d'auteur enregistré
                        }else{
                            echo "<td></td>";
                        }
                        ?>
                        <td><?php echo $alertEpisodeInfo['title']; ?></td>
                        <td><?php echo $alertEpisodeInfo['number']; ?></td>
                        <td><?php echo $alertEpisodeInfo['price']; ?></td>
                        <td><?php echo $alertEpisodeInfo['numberLikers']; ?></td>
                        <td>
                            <?php
                            $date = new DateTime($alertEpisodeInfo['date']);
                            echo $date->format('d/m/Y');
                            ?>
                        </td>
                        <td><a href="displayEpisode/<?php echo $alertEpisodeInfo['seriesid']; ?>/<?php echo $alertEpisodeInfo['number']; ?>/<?php echo $alertEpisodeInfo['id']; ?>" TARGET=_BLANK>Voir</a></td>
                        <td class="delete"><a href="index.php?action=adminDeleteEpisode&idepisode=<?php echo $alertEpisodeInfo['id']; ?>">Supprimer</a></td>
                        <td><a href="index.php?action=removeAlertEpisode_post&idepisode=<?php echo $alertEpisodeInfo['id']; ?>">Annuler l'alerte</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        // Si aucun épisode signalé
        }else{
        ?>
            <p class="no">Epizode n'a pas encore d'épisode signalé !</p>
        <?php
        }
        ?>
    </div>
    <div>
        <!-- Tous les épisodes -->
        <h2>Liste des épisodes</h2>
        <?php
        // S'il existe au moins un épisode
        if($getAllEpisodes != NULL)
        {
        ?>
            <table id="myTableEpisodes" class="responsive display nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Série</th>
                        <th>Type</th>
                        <th>Membre</th>
                        <th>Editeur</th>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Numéro d'épisode</th>
                        <th>Coût</th>
                        <th>Nombre de likes</th>
                        <th>Date de publication</th>
                        <th>Nombre de ventes</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($getAllEpisodes as $episodeInfo)
                    {
                    ?>
                    <tr>
                        <td><?php echo $episodeInfo['id']; ?></td>
                        <td><?php echo $episodeInfo['series']; ?></td>
                        <td><?php echo $episodeInfo['type']; ?></td>
                        <td><?php echo $episodeInfo['pseudo']; ?></td>
                        <?php
                        // Si l'auteur est un éditeur
                        if(isset($episodeInfo['publisher']))
                        {
                        ?>
                            <td><?php echo $episodeInfo['publisher']; ?></td>
                        <?php
                        // Si l'auteur n'est pas un éditeur
                        }else{
                            echo "<td></td>";
                        }
                        // Si l'éditeur a ajouté un auteur
                        if(isset($episodeInfo['author']))
                        {
                        ?>
                            <td><?php echo $episodeInfo['author']; ?></td>
                        <?php
                        // S'il n'y a pas d'auteur ajouté
                        }else{
                            echo "<td></td>";
                        }
                        ?>
                        <td><?php echo $episodeInfo['title']; ?></td>
                        <td><?php echo $episodeInfo['number']; ?></td>
                        <td><?php echo $episodeInfo['price']; ?></td>
                        <td><?php echo $episodeInfo['numberLikers']; ?></td>
                        <td>
                            <?php
                            $date = new DateTime($episodeInfo['date']);
                            echo $date->format('d/m/Y');
                            ?>
                        </td>
                        <td><?php echo $episodeInfo['salesNumber']; ?></td>
                        <td><a href="displayEpisode/<?php echo $episodeInfo['seriesid']; ?>/<?php echo $episodeInfo['number']; ?>/<?php echo $episodeInfo['id']; ?>" TARGET=_BLANK>Voir</a></td>
                        <td class="delete"><a href="index.php?action=adminDeleteEpisode&idepisode=<?php echo $episodeInfo['id']; ?>">Supprimer</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        // S'il n'y a pas encore d'épisode
        }else{
        ?>
            <p class="no">Epizode n'a pas encore d'épisode !</p>
        <?php
        }
        ?>
    </div>
</section>
<section class="elementContent" data-tab="4"> <!-- Section avec les informations sur les commentaires -->
    <div>
        <!-- Les commentaires signaléq -->
        <h2>Commentaires signalés</h2>
        <?php
        // S'il existe au moins un commentaire signalé
        if($getAlertComments != NULL)
        {
        ?>
            <table id="myTableAlertComments" class="responsive display nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Membre</th>
                        <th>Série</th>
                        <th>Numéro d'épisode</th>
                        <th>Contenu du commentaire</th>
                        <th>Date de publication</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($getAlertComments as $alertCommentInfo)
                    {
                    ?>
                    <tr>
                        <td><?php echo $alertCommentInfo['id']; ?></td>
                        <td><?php echo $alertCommentInfo['pseudo']; ?></td>
                        <td><?php echo $alertCommentInfo['series']; ?></td>
                        <td><?php echo $alertCommentInfo['episode']; ?></td>
                        <td><?php echo $alertCommentInfo['content']; ?></td>
                        <td><?php echo $alertCommentInfo['date']; ?></td>
                        <td class="delete"><a href="index.php?action=deleteComment&idcomment=<?php echo $alertCommentInfo['id']; ?>">Supprimer</a></td>
                        <td><a href="index.php?action=removeAlertComment_post&idcomment=<?php echo $alertCommentInfo['id']; ?>">Annuler l'alerte</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        // S'il n'y a pas de commentaire signalé
        }else{
        ?>
            <p class="no">Epizode n'a pas encore de commentaire signalé !</p>
        <?php
        }
        ?>
    </div>
    <div>
        <!-- Tous les commentaires -->
        <h2>Liste des commentaires</h2>
        <?php
        // S'il existe au moins un commentaire
        if($getAllComments != NULL)
        {
        ?>
            <table id="myTableComments" class="responsive display nowrap">
            <thead>
                    <tr>
                        <th>Id</th>
                        <th>Membre</th>
                        <th>Série</th>
                        <th>Numéro d'épisode</th>
                        <th>Contenu du commentaire</th>
                        <th>Date de publication</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($getAllComments as $commentInfo)
                    {
                    ?>
                    <tr>
                        <td><?php echo $commentInfo['id']; ?></td>
                        <td><?php echo $commentInfo['pseudo']; ?></td>
                        <td><?php echo $commentInfo['series']; ?></td>
                        <td><?php echo $commentInfo['episode']; ?></td>
                        <td><?php echo $commentInfo['content']; ?></td>
                        <td><?php echo $commentInfo['date']; ?></td>
                        <td class="delete"><a href="index.php?action=deleteComment&idcomment=<?php echo $commentInfo['id']; ?>">Supprimer</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        // S'il n'y a pas ce commentaire
        }else{
        ?>
            <p class="no">Epizode n'a pas encore de commentaire !</p>
        <?php
        }
        ?>
    </div>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<script type="text/javascript" src="./public/js/datatable.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>