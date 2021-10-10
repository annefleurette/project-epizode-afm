<?php
// Page qui permet de créer une nouvelle série
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<section> <!-- Section qui permet de créer la série -->
    <form action="index.php?action=writeSeries_post" method="post" enctype="multipart/form-data">
        <p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="titleSeries" minlength="1" maxlength="100" required value="<?php if(isset($_SESSION['tempSeriestitle'])){echo $_SESSION['tempSeriestitle'];}else{echo NULL;}?>">
            <?php if(isset($_SESSION['tempSeriestitle'])){unset($_SESSION['tempSeriestitle']);}?>
        </p>
        <?php
        // Si l'auteur est un éditeur
        if($_SESSION['level'] == 20)
        {
        ?>
            <p>
                <label for="author">Nom de l'auteur</label><br />
                <input type="text" id="author" name="author" minlength="1" maxlength="100" required value="<?php if(isset($_SESSION['tempAuthorname'])){echo $_SESSION['tempAuthorname'];}else{echo NULL;}?>">
                <?php if(isset($_SESSION['tempAuthorname'])){unset($_SESSION['tempAuthorname']);}?>
            </p>
            <p>
                <label for="descriptionAuthor">Présentation de l'auteur</label><br />
                <input type="text" id="descriptionAuthor" name="descriptionAuthor" minlength="1" maxlength="10000" required value="<?php if(isset($_SESSION['tempAuthordescription'])){echo $_SESSION['tempAuthordescription'];}else{echo NULL;}?>">
                <?php if(isset($_SESSION['tempAuthordescription'])){unset($_SESSION['tempAuthordescription']);}?>
            </p>
        <?php
        }
        ?>
        <p>
            <label for="descriptionSeries">Résumé de la série</label><br />
            <textarea id="descriptionSeries" name="descriptionSeries" minlength="1" maxlength="1200" required><?php if(isset($_SESSION['tempSummary'])){echo $_SESSION['tempSummary'];}else{echo NULL;}?></textarea>
            <?php if(isset($_SESSION['tempSummary'])){unset($_SESSION['tempSummary']);}?>
        </p>
        <p>
            <label for="cover">Ajouter l'affiche de votre série (1 Mo maximum, formats JPEG et PNG exclusivement)</label>
            <input type="file" id="cover" name="cover" accept=".jpg, .jpeg, .png" size="1000000">
        </p>
        <p>
            <label for="tags">Catégories/Tags (séparer chaque tag par une virgule)</label><br />
            <input type="text" id="tags" name="tags" required value="<?php if(isset($_SESSION['tempTags'])){echo $_SESSION['tempTags'];}else{echo NULL;}?>">
            <?php if(isset($_SESSION['tempTags'])){unset($_SESSION['tempTags']);}?>
        </p>
        <p>
            <label for="rights">Droits d'auteurs</label><br />
            <select name="rights" required>
                <option value="reserved" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Tous droits réservés")) { ?>selected="selected"<?php }; ?>>Tous droits réservés</option>
                <option value="public" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Domaine public")) { ?>selected="selected"<?php }; ?>>Domaine public</option>
                <option value="CC" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Creative Commons Attribution")) { ?>selected="selected"<?php }; ?>>Creative Commons Attribution</option>
                <option value="CC1" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Creative Commons Attribution - Pas de modification")) { ?>selected="selected"<?php }; ?>>Creative Commons Attribution - Pas de modification</option>
                <option value="CC2" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification")) { ?>selected="selected"<?php }; ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Pas de modification</option>
                <option value="CC3" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Creative Commons Attribution - Pas d'utilisation commerciale")) { ?>selected="selected"<?php }; ?>>Creative Commons Attribution - Pas d'utilisation commerciale</option>
                <option value="CC4" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions")) { ?>selected="selected"<?php }; ?>>Creative Commons Attribution - Pas d'utilisation commerciale - Partage dans les mêmes conditions</option>
                <option value="CC5" <?php if(isset($_SESSION['tempRights']) AND ($_SESSION['tempRights'] == "Creative Commons Attribution - Partage dans les mêmes conditions")) { ?>selected="selected"<?php }; ?>>Creative Commons Attribution - Partage dans les mêmes conditions</option>
            </select>  
            <?php if(isset($_SESSION['tempRights'])){unset($_SESSION['tempRights']);}?>
        </p>
        <p>
            <label for="metaSeries">Metadescription de la série (maximum 160 caractères)</label><br />
            <textarea id="metaSeries" name="metaSeries" minlength="1" maxlength="160"><?php if(isset($_SESSION['tempMetaSeries'])){echo $_SESSION['tempMetaSeries'];}else{echo NULL;}?></textarea>
            <?php if(isset($_SESSION['tempMetaSeries'])){unset($_SESSION['tempMetaSeries']);}?>
        </p>
        <p>
            <input type="submit" name="save" value="Valider">
        </p>
    </form>
    <p><a href="index.php?action=dashboard">ANNULER</a>
</section>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>