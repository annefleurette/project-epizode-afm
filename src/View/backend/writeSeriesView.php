
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<nav>
    <ul>
        <li>Ma série</li>
        <li>Mes épisodes</li>
    </ul>
</nav>
<section>
    <form action="index.php?action=writeSeries_post" method="post" enctype="multipart/form-data">
        <p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" required value=<?php if(isset($_SESSION['tempSeriestitle'])){echo $_SESSION['tempSeriestitle'];}else{echo NULL;}?>>
            <?php if(isset($_SESSION['tempSeriestitle'])){unset($_SESSION['tempSeriestitle']);}?>
        </p>
        <p>
            <label for="descriptionSeries">Description</label><br />
            <textarea id="descriptionSeries" name="descriptionSeries" minlength="1" maxlength="1200" required><?php if(isset($_SESSION['tempSummary'])){echo $_SESSION['tempSummary'];}else{echo NULL;}?></textarea>
            <?php if(isset($_SESSION['tempSummary'])){unset($_SESSION['tempSummary']);}?>
        </p>
        <p>
            <?php if(isset($_SESSION['tempCover'])){?><p><?php echo $_SESSION['tempCover'];?></p><?php }else{echo NULL;}?>
            <label for="cover">Ajouter l'affiche de votre série (1 Mo maximum, formats JPEG et PNG exclusivement)</label>
            <input type="file" id="cover" name="cover" accept=".jpg, .jpeg, .png" size="1000000">
            <?php if(isset($_SESSION['tempCover'])){unset($_SESSION['tempCover']);}?>
        </p>
        <p>
            <label for="tags">Catégories/Tags (séparer chaque tag par une virgule)</label><br />
            <input type="text" id="tags" name="tags" required value=<?php if(isset($_SESSION['tempTags'])){echo $_SESSION['tempTags'];}else{echo NULL;}?>>
            <?php if(isset($_SESSION['tempTags'])){unset($_SESSION['tempTags']);}?>
        </p>
        <p>
            <label for="rights">Droits d'auteurs</label><br />
            <select name="rights" required>
                <option <?php if($_SESSION['tempRights'] == 'reserved') { ?>selected="selected" value="reserved"<?php }; ?>>Tous droits réservés</option>
                <option <?php if($_SESSION['tempRights'] == 'public') { ?>selected="selected" value="public"<?php }; ?>>Domaine public</option>
                <option <?php if($_SESSION['tempRights'] == 'CC') { ?>selected="selected" value="CC"<?php }; ?>>Creative Commons Attribution</option>
                <option <?php if($_SESSION['tempRights'] == 'CC1') { ?>selected="selected" value="CC1"<?php }; ?>>Creative Commons Attribution - Pas de modification</option>
                <option <?php if($_SESSION['tempRights'] == 'CC2') { ?>selected="selected" value="CC2"<?php }; ?>value="CC2">Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                <option <?php if($_SESSION['tempRights'] == 'CC3') { ?>selected="selected" value="CC3"<?php }; ?>>Creative Commons Attribution - Pas d'utilisation commerciale</option>
                <option <?php if($_SESSION['tempRights'] == 'CC4') { ?>selected="selected" value="CC4"<?php }; ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                <option <?php if($$_SESSION['tempRights'] == 'CC5') { ?>selected="selected" value="CC5"<?php }; ?>>Creative Commons Attribution - Partage dans les mêmes conditions</option>
            </select>  
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>