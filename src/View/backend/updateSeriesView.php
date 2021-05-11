
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<nav>
    <ul>
        <li class="seriesTab" data-index="1">Ma série</li>
        <li class="seriesTab" data-index="2">Mes épisodes</li>
    </ul>
</nav>
<section class="seriesContent" data-tab="1">
    <form action="index.php?action=updateSeries_post&id=<?php echo $getid; ?>" method="post" enctype="multipart/form-data">
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
                <!-- Je regarde si j'ai une variable de session temporaire -->
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Tous droits réservés")) { ?>selected="selected" value="reserved"<?php }else{if($oneSeriesUserData['rights'] === "reserved") { ?>selected="selected" value="reserved"<?php }}; ?>>Tous droits réservés</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Domaine public")) { ?>selected="selected" value="public"<?php }else{if($oneSeriesUserData['rights'] === "public") { ?>selected="selected" value="public"<?php }}; ?>>Domaine public</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Creative Commons Attribution")) { ?>selected="selected" value="CC"<?php }else{if($oneSeriesUserData['rights'] === "CC") { ?>selected="selected" value="CC"<?php }}; ?>>Creative Commons Attribution</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Creative Commons Attribution - Pas de modification")) { ?>selected="selected"<?php }else{if($oneSeriesUserData['rights'] === "CC1") { ?>selected="selected"<?php }}; ?> value="CC1">Creative Commons Attribution - Pas de modification</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification")) { ?>selected="selected" value="CC2"<?php }else{if($oneSeriesUserData['rights'] === "CC2") { ?>selected="selected" value="CC2"<?php }}; ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Creative Commons Attribution - Pas d'utilisation commerciale")) { ?>selected="selected" value="CC3"<?php }else{if($oneSeriesUserData['rights'] === "CC3") { ?>selected="selected" value="CC3"<?php }}; ?>>Creative Commons Attribution - Pas d'utilisation commerciale</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions")) { ?>selected="selected" value="CC4"<?php }else{if($oneSeriesUserData['rights'] === "CC4") { ?>selected="selected" value="CC4"<?php }}; ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                <option <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] === "Creative Commons Attribution - Partage dans les mêmes conditions")) { ?>selected="selected" value="CC5"<?php }else{if($oneSeriesUserData['rights'] === "CC5") { ?>selected="selected" value="CC5"<?php }}; ?>>Creative Commons Attribution - Partage dans les mêmes conditions</option>
            </select>  
            <?php if(isset($_SESSION['tempRights'])){unset($_SESSION['tempRights']);}?>
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
</section>
<section class="seriesContent hidden" data-tab="2">
    <p><a href="index.php?action=writeEpisode&idseries=<?php echo $getid; ?>">ECRIRE UN NOUVEL EPISODE</a></p>
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
                        <p>Dernière modification : <?php echo $episodedata['lastUpdate']; ?></p>
                        <p><?php echo $episodedata['likesNumber']; ?> like(s)</p>
                        <p><?php echo $episodedata['price']; ?> euro(s)</p>
                        <p><a href ="index.php?action=lookEpisode&idseries=<?php echo $getid; ?>&id=<?php echo $episodedata['id']; ?>">APERCU</a></p>
                        <p><a href = #>MODIFIER</a></p>
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
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php $body_content = ob_get_clean();
require('template.php');
?>