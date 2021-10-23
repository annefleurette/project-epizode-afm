<?php
// Page qui permet de créer un nouvel épiqode
$head_title = 'Epizode - Créer un nouvel épisode';
ob_start();
?>
<section> <!-- Section de création de l'épisode -->
    <form action="index.php?action=writeEpisode_post&idseries=<?php echo $seriesId; ?>" method="post">
    <!-- On pré-rempli le formulaire avec les données temporaires si on a déjà essayé de modifier et qu'un erreur est apparue, pour ne pas avoir à tout resaisir -->
        <p>
            <label for="numberEpisode">Numéro de l'épisode</label><br />
            <input type="number" id="number" name="numberEpisode" min="1" required value="<?php if(isset($_SESSION['tempNumber'])){echo $_SESSION['tempNumber'];}else{echo NULL;}?>">
            <?php if(isset($_SESSION['tempNumber'])){unset($_SESSION['tempNumber']);}?>
        </p>
        <p>
            <label for="titleEpisode">Titre</label><br />
            <input type="text" id="titleEpisode" name="titleEpisode" minlength="1" maxlength="1200" required value="<?php if(isset($_SESSION['tempTitle'])){echo $_SESSION['tempTitle'];}else{echo NULL;}?>">
            <?php if(isset($_SESSION['tempTitle'])){unset($_SESSION['tempTitle']);}?>
        </p>
        <p>
            <label for="contentEpisode">Contenu de l'épisode</label><br />
            <textarea id="contentEpisode" name="contentEpisode"><?php if(isset($_SESSION['tempContent'])){echo $_SESSION['tempContent'];}else{echo NULL;}?></textarea>
            <?php if(isset($_SESSION['tempContent'])){unset($_SESSION['tempContent']);}?>
            <p id="signsEpisode"></p>
            <input type="hidden" id="nbCharacters" name="nbCharacters" value="0" />
        </p>
        <p>
            <label for="metaEpisode">Metadescription de l'épisode (maximum 160 caractères)</label><br />
            <textarea id="metaEpisode" name="metaEpisode" minlength="1" maxlength="160"><?php if(isset($_SESSION['tempMetaEpisode'])){echo $_SESSION['tempMetaEpisode'];}else{echo NULL;}?></textarea>
            <?php if(isset($_SESSION['tempMetaEpisode'])){unset($_SESSION['tempMetaEpisode']);}?>
        </p>
        <?php
        // Si l'auteur est un éditeur
        if($_SESSION['level'] == 20)
        {
        ?>
            <p>
                <label for="priceEpisode">Prix de l'épisode</label><br />
                <input type="number" id="priceEpisode" name="priceEpisode" min="0" step=".01" required value="<?php if(isset($_SESSION['tempPrice'])){echo $_SESSION['tempPrice'];}else{echo "0";}?>"> coin(s)
                <?php if(isset($_SESSION['tempPrice'])){unset($_SESSION['tempPrice']);}?>
            </p>
            <p>
                <label for="promotionEpisode">Promotion</label><br />
                Retirer <input type="number" id="promotionEpisode" name="promotionEpisode" min="0" step=".01" value="<?php if(isset($_SESSION['tempPromotion'])){echo $_SESSION['tempPromotion'];}else{echo "0";}?>"> coin(s)
                <?php if(isset($_SESSION['tempPromotion'])){unset($_SESSION['tempPromotion']);}?>
            </p>
        <?php
        }
        ?>
        <p id="trigger">
            <input type="submit" name="save" value="Enregistrer">
            <input id="triggerElt" type="button" name="button" value="Publier">
        </p>
        <p id="hidden">
            <label for="dateEpisode">Date de publication</label>
            <input id ="dateEpisode" type="datetime-local" name="dateEpisode" value="<?php echo date('Y-m-dTH:i', strtotime('+2 hours')); ?>" pattern="[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])">
            <input type="submit" name="publish" value="Publier">
        </p>
        <p>
            <a href="index.php?action=updateSeries&idseries=<?php echo $seriesId; ?>">Annuler</a>
        </p>
    </form>
</section>
<script type="text/javascript" src="./public/js/signcounter.js"></script>
<script type="text/javascript" src="./public/js/trigger.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>