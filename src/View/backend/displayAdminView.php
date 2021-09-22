
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<section>
        <p>Bonjour <?php echo $userData['pseudo']; ?>, content de vous revoir !</p>
</section>
<nav>
    <ul>
        <li class="seriesTab" data-index="1">Membres</li>
        <li class="seriesTab" data-index="2">Séries</li>
        <li class="seriesTab" data-index="3">Episodes</li>
        <li class="seriesTab" data-index="4">Commentaires</li>
    </ul>
</nav>
<section class="seriesContent" data-tab="1">
    <h2>Liste des membres</h2>
    <?php
    if($usersData !== NULL)
    {
    ?>
        <table id="myTableMembers" class="display">
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
                    <td><a href="index.php?action=displayMember&idmember=<?php echo $memberInfo['id']; ?>" TARGET=_BLANK>VOIR</a></td>
                    <?php
                    // Pour ne pas se supprimer soi-même
                    if($memberInfo['id'] != $_SESSION['idmember'])
                    {
                    ?>
                        <td class="delete"><a href="index.php?action=deleteMember&idmember=<?php echo $memberInfo['id']; ?>">SUPPRIMER</a></td>
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
    }else{
    ?>
        <p>Epizode n'a pas encore de membre !</p>
    <?php
    }
    ?>
</section>
<section class="seriesContent hidden" data-tab="2">
    <h2>Liste des séries</h2>
    <?php
    if($getAllSeries != NULL)
    {
    ?>
        <table id="myTableSeries" class="display">
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
                    if(isset($seriesInfo['publisher']))
                    {
                    ?>
                        <td><?php echo $seriesInfo['publisher']; ?></td>
                    <?php
                    }else{
                        echo "<td></td>";
                    }
                    if(isset($seriesInfo['author']))
                    {
                    ?>
                        <td><?php echo $seriesInfo['author']; ?></td>
                    <?php
                    }else{
                        echo "<td></td>";
                    }
                    ?>
                    <td><?php echo $seriesInfo['publishing']; ?></td>
                    <td><?php echo $seriesInfo['pricing']; ?></td>
                    <td><?php echo $seriesInfo['tags']; ?></td>
                    <td><?php echo $seriesInfo['rights']; ?></td>
                    <td><?php echo $seriesInfo['numberEpisodes']; ?></td>
                    <td><?php echo $seriesInfo['numberSubscribers']; ?></td>
                    <td>
                        <?php
                        $date = new DateTime($seriesInfo['date']);
                        echo $date->format('d/m/Y');
                        ?>
                    </td>
                    <td><a href="index.php?action=displaySeries&idseries=<?php echo $seriesInfo['id']; ?>" TARGET=_BLANK>VOIR</a></td>
                    <td class="delete"><a href="index.php?action=deleteSeries&idseries=<?php echo $seriesInfo['id']; ?>">SUPPRIMER</a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }else{
    ?>
        <p>Epizode n'a pas encore de série !</p>
    <?php
    }
    ?>
</section>
<section class="seriesContent hidden" data-tab="3">
    <div>
        <h2>Episodes signalés</h2>
        <?php
        if($getAlertEpisodes != NULL)
        {
        ?>
            <table id="myTableAlertEpisodes" class="display">
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
                        if(isset($alertEpisodeInfo['publisher']))
                        {
                        ?>
                            <td><?php echo $alertEpisodeInfo['publisher']; ?></td>
                        <?php
                        }else{
                            echo "<td></td>";
                        }
                        if(isset($alertEpisodeInfo['author']))
                        {
                        ?>
                            <td><?php echo $alertEpisodeInfo['author']; ?></td>
                        <?php
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
                        <td><a href="index.php?action=displayEpisode&idseries=<?php echo $alertEpisodeInfo['seriesid']; ?>&number=<?php echo $alertEpisodeInfo['number']; ?>&idepisode=<?php echo $alertEpisodeInfo['id']; ?>" TARGET=_BLANK>VOIR</a></td>
                        <td class="delete"><a href="index.php?action=deleteEpisode&idepisode=<?php echo $alertEpisodeInfo['id']; ?>">SUPPRIMER</a></td>
                        <td><a href="index.php?action=removeAlertEpisode_post&idepisode=<?php echo $alertEpisodeInfo['id']; ?>">ANNULER L'ALERTE</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }else{
        ?>
            <p>Epizode n'a pas encore d'épisode signalé !</p>
        <?php
        }
        ?>
    </div>
    <div>
        <h2>Liste des épisodes</h2>
        <?php
        if($getAllEpisodes != NULL)
        {
        ?>
            <table id="myTableEpisodes" class="display">
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
                        if(isset($episodeInfo['publisher']))
                        {
                        ?>
                            <td><?php echo $episodeInfo['publisher']; ?></td>
                        <?php
                        }else{
                            echo "<td></td>";
                        }
                        if(isset($episodeInfo['author']))
                        {
                        ?>
                            <td><?php echo $episodeInfo['author']; ?></td>
                        <?php
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
                        <td><a href="index.php?action=displayEpisode&idseries=<?php echo $episodeInfo['seriesid']; ?>&number=<?php echo $episodeInfo['number']; ?>&idepisode=<?php echo $episodeInfo['id']; ?>" TARGET=_BLANK>VOIR</a></td>
                        <td class="delete"><a href="index.php?action=deleteEpisode&idepisode=<?php echo $episodeInfo['id']; ?>">SUPPRIMER</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }else{
        ?>
            <p>Epizode n'a pas encore d'épisode !</p>
        <?php
        }
        ?>
    </div>
</section>
<section class="seriesContent hidden" data-tab="4">
    <div>
        <h2>Commentaires signalés</h2>
        <?php
        if($getAlertComments != NULL)
        {
        ?>
            <table id="myTableAlertComments" class="display">
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
                        <td class="delete"><a href="index.php?action=deleteComment&idcomment=<?php echo $alertCommentInfo['id']; ?>">SUPPRIMER</a></td>
                        <td><a href="index.php?action=removeAlertComment_post&idcomment=<?php echo $alertCommentInfo['id']; ?>">ANNULER L'ALERTE</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }else{
        ?>
            <p>Epizode n'a pas encore de commentaire signalé !</p>
        <?php
        }
        ?>
    </div>
    <div>
        <h2>Liste des commentaires</h2>
        <?php
        if($getAllComments != NULL)
        {
        ?>
            <table id="myTableComments" class="display">
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
                        <td class="delete"><a href="index.php?action=deleteComment&idcomment=<?php echo $commentInfo['id']; ?>">SUPPRIMER</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }else{
        ?>
            <p>Epizode n'a pas encore de commentaire !</p>
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