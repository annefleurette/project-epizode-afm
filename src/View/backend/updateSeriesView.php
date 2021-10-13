<?php
// Page qui permet de mettre à jour une série
$head_title = 'Epizode - Mettre à jour la série';
ob_start();
?>
<nav> <!-- Navigation entre les données de la série et les données des épisodes -->
    <ul>
        <li class="elementTab" data-index="1">Ma série</li>
        <li class="elementTab" data-index="2">Mes épisodes</li>
    </ul>
</nav>
<section class="elementContent" data-tab="1"> <!-- Section qui affiche les informations de la série -->
    <form action="index.php?action=updateSeries_post&idseries=<?php echo $seriesId; ?>" method="post" enctype="multipart/form-data">
    <!-- On pré-rempli le formulaire avec les données issues de la base de données ou les données temporaires si on a déjà essayé de modifier et qu'un erreur est apparue, pour ne pas avoir à tout resaisir -->
        <p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" value="<?php if(isset($_SESSION['tempSeriestitle'])){echo $_SESSION['tempSeriestitle'];}else{echo $oneSeriesUserData['title'];}?>" required>
            <?php if(isset($_SESSION['tempSeriestitle'])){unset($_SESSION['tempSeriestitle']);}?>
        </p>
        <?php
        // Si l'auteur est un éditeur
        if($_SESSION['level'] == 20)
        {
        ?>
            <p>
                <label for="author">Nom de l'auteur</label><br />
                <input type="text" id="author" name="author" minlength="1" maxlength="100" required value="<?php if(isset($_SESSION['tempAuthorname'])){echo $_SESSION['tempAuthorname'];}else{echo $oneSeriesUserData['publisher_author'];}?>">
                <?php if(isset($_SESSION['tempAuthorname'])){unset($_SESSION['tempAuthorname']);}?>
            </p>
            <p>
                <label for="descriptionAuthor">Présentation de l'auteur</label><br />
                <input type="text" id="descriptionAuthor" name="descriptionAuthor" minlength="1" maxlength="10000" required value="<?php if(isset($_SESSION['tempAuthordescription'])){echo $_SESSION['tempAuthordescription'];}else{echo $oneSeriesUserData['publisher_author_description'];}?>">
                <?php if(isset($_SESSION['tempAuthordescription'])){unset($_SESSION['tempAuthordescription']);}?>
            </p>
        <?php
        }
        ?>
        <p>
            <label for="descriptionSeries">Résumé de la série</label><br />
            <textarea id="descriptionSeries" name="descriptionSeries" minlength="1" maxlength="1200" required><?php if(isset($_SESSION['tempSummary'])){echo $_SESSION['tempSummary'];}else{echo $oneSeriesUserData['summary'];}?></textarea>
            <?php if(isset($_SESSION['tempSummary'])){unset($_SESSION['tempSummary']);}?>
        </p>
        <p>
            <p><img src="<?php echo $seriesCover; ?>" alt="<?php echo $oneSeriesUserData['altcover']; ?>"/></p>
            <label for="cover">Modifier l'affiche de votre série (1 Mo maximum, formats JPEG et PNG exclusivement)</label>
            <input type="file" id="cover" name="cover" accept=".jpg, .jpeg, .png" size="1000000">
        </p>
        <p>
            <label for="tags">Catégories/Tags (séparer chaque tag par une virgule)</label><br />
            <input type="text" id="tags" name="tags" value ="<?php if(isset($_SESSION['tempTags'])){echo $_SESSION['tempTags'];}else{echo $alltags;}?>" required>
            <?php if(isset($_SESSION['tempTags'])){unset($_SESSION['tempTags']);}?>
        </p>
        <p>
            <label for="rights">Droits d'auteurs</label><br />
            <select name="rights" required>
                <?php 
                if(isset($_SESSION['tempRights']))
                {
                ?>
                    <option value="reserved" <?php if($_SESSION['tempRights'] === "reserved") { ?>selected="selected" <?php } ?>>Tous droits réservés</option>
                    <option value="public" <?php if($_SESSION['tempRights'] === "public") { ?>selected="selected" <?php } ?>>Domaine public</option>
                    <option value="CC" <?php if($_SESSION['tempRights'] === "CC") { ?>selected="selected" <?php } ?>>Creative Commons Attribution</option>
                    <option value="CC1" <?php if($_SESSION['tempRights'] === "CC1") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas de modification</option>
                    <option value="CC2" <?php if($_SESSION['tempRights'] === "CC2") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                    <option value="CC3" <?php if($_SESSION['tempRights'] === "CC3") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas d'utilisation commerciale</option>
                    <option value="CC4" <?php if($_SESSION['tempRights'] === "CC4") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                    <option value="CC5" <?php if($_SESSION['tempRights'] === "CC5") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Partage dans les mêmes conditions</option>
                    <?php if(isset($_SESSION['tempRights'])){unset($_SESSION['tempRights']);}?>
                <?php
                }else{
                ?>
                    <option value="reserved" <?php if($oneSeriesUserData['rights'] === "reserved") { ?>selected="selected"<?php } ?>>Tous droits réservés</option>
                    <option value="public" <?php if($oneSeriesUserData['rights'] === "public") { ?>selected="selected"<?php } ?>>Domaine public</option>
                    <option value="CC" <?php if($oneSeriesUserData['rights'] === "CC") { ?>selected="selected" <?php } ?>>Creative Commons Attribution</option>
                    <option value="CC1" <?php if($oneSeriesUserData['rights'] === "CC1") { ?>selected="selected"<?php } ?>>Creative Commons Attribution - Pas de modification</option>
                    <option value="CC2" <?php if($oneSeriesUserData['rights'] === "CC2") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                    <option value="CC3" <?php if($oneSeriesUserData['rights'] === "CC3") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas d'utilisation commerciale</option>
                    <option value="CC4" <?php if($oneSeriesUserData['rights'] === "CC4") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                    <option value="CC5" <?php if($oneSeriesUserData['rights'] === "CC5") { ?>selected="selected" <?php } ?>>Creative Commons Attribution - Partage dans les mêmes conditions</option>
                <?php
                }
                ?>
            </select>  
        </p>
        <p>
            <label for="metaSeries">Metadescription de la série (maximum 160 caractères)</label><br />
            <textarea id="metaSeries" name="metaSeries" minlength="1" maxlength="160"><?php if(isset($_SESSION['tempMetaSeries'])){echo $_SESSION['tempMetaSeries'];}else{echo $oneSeriesUserData['meta'];}?></textarea>
            <?php if(isset($_SESSION['tempMetaSeries'])){unset($_SESSION['tempMetaSeries']);}?>
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
</section>
<section class="elementContent hidden" data-tab="2"> <!-- Section qui affiche les données sur les épisodes de la série -->
    <p><a href="index.php?action=writeEpisode&idseries=<?php echo $seriesId; ?>">ECRIRE UN NOUVEL EPISODE</a></p>
    <?php
    // S'il existe au moins un épisode
    if($oneSeriesUserData['numberEpisodes']!== "0")
    {
    ?>
        <ul>
            <?php
            foreach ($episodesList as $episodedata)
            {
                // On enlève les épisodes dont le statut est passé en supprimé
                if($episodedata['publishing'] !== "deleted")
                {
                ?>
                    <li>
                        <article>
                            <p>Episode n°<?php echo $episodedata['number']; ?></p>
                            <p><?php echo $episodedata['title']; ?></p>
                            <p>Statut :
                            <?php
                            // Si la série est publiée
                            if($episodedata['publishing'] == "published")
                            {
                            ?>
                                Episode publié
                            <?php    
                            // Si la série est en cours
                            }elseif($episodedata['publishing'] == "inprogress")
                            {
                            ?>
                                Episode en cours
                            <?php
                            }
                            // Si l'épisode a été publié
                            if($episodedata['publishing'] === "published")
                            {
                                if(isset($episodedata['publicationDate']))
                                {
                                ?>
                                    <p>Publié le :
                                    <?php 
                                    $date = new DateTime($episodedata['publicationDate']);
                                    echo $date->format('d/m/Y à H:i'); ?>
                                    </p>
                                <?php
                                }
                                ?>
                                <p>Dernière modification le :
                                <?php
                                $date = new DateTime($episodedata['lastUpdate']);
                                echo $date->format('d/m/Y à H:i'); ?>
                                </p>
                            <?php
                            // Si l'épisode est en mode brouillon
                            }elseif ($episodedata['publishing'] === "inprogress")
                            {
                            ?>
                                <p>Dernière modification le :
                                <?php
                                $date = new DateTime($episodedata['lastUpdate']);
                                echo $date->format('d/m/Y à H:i'); ?>
                                </p>
                            <?php
                            }
                            ?>
                            <p><i class="fas fa-heart"></i><?php echo $episodedata['likesNumber']; ?></p>
                            <p><i class="fas fa-coins"></i><?php echo $episodedata['price']; ?></p>
                            <p><a href ="index.php?action=lookEpisode&idseries=<?php echo $seriesId; ?>&idepisode=<?php echo $episodedata['id']; ?>">APERCU</a></p>
                            <p><a href ="index.php?action=updateEpisode&idseries=<?php echo $seriesId; ?>&idepisode=<?php echo $episodedata['id']; ?>">MODIFIER</a></p>
                            <?php if((($episodedata['number'] == $nbepisodes) AND ($episodedata['publishing'] === "published")) OR ($episodedata['publishing'] === "inprogress"))
                            {
                            ?>    
                                <p><a class="delete" href="index.php?action=updateEpisodeStatus&idseries=<?php echo $seriesId; ?>&idepisode=<?php echo $episodedata['id']; ?>">SUPPRIMER</a></p>
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
    // Si la série n'a pas encore d'épisode
    }else{
    ?>
        <p>La série n'a pas encore d'épisode ! </p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>