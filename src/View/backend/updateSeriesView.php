
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
if(!empty($seriesId))
{
    ?>
    <nav>
        <ul>
            <li class="seriesTab" data-index="1">Ma série</li>
            <li class="seriesTab" data-index="2">Mes épisodes</li>
        </ul>
    </nav>
    <section class="seriesContent" data-tab="1">
        <form action="index.php?action=updateSeries_post&idseries=<?php echo $seriesId; ?>" method="post" enctype="multipart/form-data">
            <p>
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" value="<?php if(isset($_SESSION['tempSeriestitle'])){echo $_SESSION['tempSeriestitle'];}else{echo $oneSeriesUserData['title'];}?>" required>
                <?php if(isset($_SESSION['tempSeriestitle'])){unset($_SESSION['tempSeriestitle']);}?>
            </p>
            <p>
                <label for="descriptionSeries">Description</label><br />
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
                <input type="submit" name="save" value="Valider">
            </p>
        </form>
    </section>
    <section class="seriesContent hidden" data-tab="2">
        <p><a href="index.php?action=writeEpisode&idseries=<?php echo $seriesId; ?>">ECRIRE UN NOUVEL EPISODE</a></p>
        <?php
        if($oneSeriesUserData['numberEpisodes']!== "0")
        {
        ?>
            <ul>
                <?php
                foreach ($episodesList as $episodedata)
                {
                ?>
                    <li>
                        <article>
                            <p>Episode n°<?php echo $episodedata['number']; ?></p>
                            <p><?php echo $episodedata['title']; ?></p>
                            <p>Statut : <?php echo $episodedata['publishing']; ?></p>
                            <?php
                            if($episodedata['publishing'] === "published")
                            {
                            ?>
                                <?php if(isset($episodedata['publicationDate']))
                                {
                                ?>
                                    <p>Publié le : <?php echo $episodedata['publicationDate']; ?></p>
                                <?php
                                }
                                ?>
                                <p>Dernière modification le : <?php echo $episodedata['lastUpdate']; ?></p>
                            <?php
                            }elseif ($episodedata['publishing'] === "inprogress")
                            {
                            ?>
                                <p>Dernière modification : <?php echo $episodedata['lastUpdate']; ?></p>
                            <?php
                            }
                            ?>
                            <p><?php echo $episodedata['likesNumber']; ?> like(s)</p>
                            <p><?php echo $episodedata['price']; ?> euro(s)</p>
                            <p><a href ="index.php?action=lookEpisode&idseries=<?php echo $seriesId; ?>&idepisode=<?php echo $episodedata['id']; ?>">APERCU</a></p>
                            <p><a href ="index.php?action=updateEpisode&idseries=<?php echo $seriesId; ?>&idepisode=<?php echo $episodedata['id']; ?>">MODIFIER</a></p>
                            <p><a href = #>SUPPRIMER</a></p>
                        </article>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }else{
        ?>
            <p>La série n'a pas encore d'épisode ! </p>
        <?php
        }
        ?>
    </section>
<?php
}else{
?>
    <section>
        <h1>Erreur 404</h1>
        <p>Cette page n'existe pas !</p>
    </section>
<?php
}
?>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php $body_content = ob_get_clean();
require('template.php');
?>