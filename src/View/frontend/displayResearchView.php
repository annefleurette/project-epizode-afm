<?php
// Page qui affiche les résultats d'une recherche par mot clé
$head_title = 'Epizode - Recherche de mots clés';
include('./src/Utils/colorkeyword.php');
ob_start();
?>
<h1> Résultats de la recherche : "<?php echo $postkeyword; ?>"
<nav> <!-- Les résultats s'affichent dans les séries, les auteurs et les épisodes -->
    <ul>
        <li class="elementTab" data-index="1">Séries</li>
        <li class="elementTab" data-index="2">Auteurs</li>
        <li class="elementTab" data-index="3">Episodes</li>
    </ul>
</nav>
<section class="elementContent" data-tab="1"> <!-- Section qui affiche la liste résultats parmi les séries -->
    <h2>Séries</h2>
    <?php
    // Si les résultats de recherche ne sont pas nuls
    if($researchSeriesResults != NULL)
    {
    ?>    
        <ul>
            <?php
            foreach ($researchSeriesResults as $seriesResults)
            {
            ?>
                <li>
                    <article>
                        <!-- Dans mon contenu je surligne quand le mot clé est présent -->
                        <p><?php echo highlightKeyword($postkeyword, $seriesResults['title']); ?></p>
                        <p><img src="<?php echo $seriesResults['cover']; ?>" alt="<?php echo $seriesResults['altcover']; ?>"/></p>
                        <p><?php echo $seriesResults['numberEpisodes']; ?> épisode(s)</p>
                        <p><?php echo $seriesResults['numberSubscribers']; ?> abonné(s)</p>
                        <p><?php echo $seriesResults['summary']; ?> abonné(s)</p>
                        <p><?php echo $seriesResults['tags']; ?></p>
                        <?php
                        // Si le membre est un éditeur
                        if($seriesResults['type'] === "publisher")
                        {
                        ?>
                            <p><p><i class="fas fa-coins"></i></p></p>
                            <p><img src="<?php echo $seriesResults['logo']; ?>" alt="<?php echo $seriesResults['altlogo']; ?>"/></p>
                            <p><?php echo highlightKeyword($postkeyword, $seriesResults['publisher']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $seriesResults['member']); ?></p>
                            <p><?php echo $seriesResults['author']; ?></p>
                        <?php
                        // Si le membre est un amateur
                        }elseif($seriesResults['type'] === "user"){
                        ?>  
                            <p><img src="<?php echo $seriesResults['avatar']; ?>" alt="<?php echo $seriesResults['altavatar']; ?>"/></p>  
                            <p><?php echo highlightKeyword($postkeyword, $seriesResults['member']); ?></p>
                            <?php
                        }
                        ?>
                        <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesResults['id']; ?>">DECOUVRIR LA SERIE</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si les résultats de recherche sont nuls
    }else{
    ?>
        <p>Aucune série ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<section class="elementContent" data-tab="2" hidden> <!-- Section qui affiche les résultats de recherche parmi les auteurs -->
    <h2>Auteurs</h2>
    <?php
    // Si les résultats de recherche ne sont pas nuls
    if($researchAuthorsResults != NULL)
    {
    ?>    
        <ul>
            <?php
            foreach ($researchAuthorsResults as $authorsResults)
            {
            ?>
                <li>
                    <article>
                        <!-- Dans mon contenu je surligne quand le mot clé est présent -->
                        <?php
                        // Si le membre est un éditeur
                        if($authorsResults['type'] === "publisher")
                        {
                        ?>
                            <p><img src="<?php echo $authorsResults['logo']; ?>" alt="<?php echo $authorsResults['altlogo']; ?>"/></p>
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['member']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['publisher']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['author']); ?></p>
                        <?php
                        // Si le membre est un amateur
                        }elseif($authorsResults['type'] === "user"){
                        ?>  
                            <p><img src="<?php echo $authorsResults['avatar']; ?>" alt="<?php echo $authorsResults['altavatar']; ?>"/></p>  
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['member']); ?></p>
                            <?php
                        }
                        ?>
                        <p><?php echo $authorsResults['numberWritings']; ?> séries écrites</p>
                        <p><a href="index.php?action=displayMember&idmember=<?php echo $authorsResults['id']; ?>">DECOUVRIR L'AUTEUR</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si les résultats de recherche sont nuls
    }else{
    ?>
        <p>Aucun auteur ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<section class="elementContent" data-tab="3" hidden> <!-- Section qui affiche les résultats de recherche parmi les épisodes -->
    <h2>Episodes</h2>
    <?php
    // Si les résultats de recherche ne sont pas nuls
    if($researchEpisodesResults != NULL)
    {
    ?>    
        <ul>
            <?php
            foreach ($researchEpisodesResults as $episodesResults)
            {
            ?>
                <li>
                    <article>
                        <!-- Dans mon contenu je surligne quand le mot clé est présent -->
                        <p><?php echo $episodesResults['title']; ?></p>
                        <?php
                        // Si le membre est un éditeur
                        if($episodesResults['type'] === "publisher")
                        {
                        ?>
                            <p><p><i class="fas fa-coins"></i></p></p>
                            <p><img src="<?php echo $episodesResults['logo']; ?>" alt="<?php echo $seriesResults['altlogo']; ?>"/></p>
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['publisher']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['member']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['author']); ?></p>
                        <?php
                        // Si le membre est un amateur
                        }elseif($episodesResults['type'] === "user"){
                        ?>  
                            <p><img src="<?php echo $episodesResults['avatar']; ?>" alt="<?php echo $episodesResults['altavatar']; ?>"/></p>  
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['member']); ?></p>
                            <?php
                        }
                        ?>
                        <p>Episode n°<?php echo $episodesResults['number']; ?></p>
                        <p>Titre : <?php echo highlightKeyword($postkeyword, $episodesResults['titleEpisode']); ?></p>
                        <?php $poskeyword = strpos(strtolower($episodesResults['content']), strtolower($postkeyword));
                        $numbercharacter = strlen($episodesResults['content']);
                        // Au sein du contenu de l'épisode, on isole la section qui comporte les mots clés saisis
                        if ($poskeyword < 150){
                        ?>
                            <p><?php echo highlightKeyword($postkeyword, substr($episodesResults['content'], 0, 200)); ?> [...]</p>
                        <?php
                        }elseif($poskeyword < $numbercharacter AND $poskeyword > $numbercharacter - 200)
                        {
                        ?>
                            <p><?php echo highlightKeyword($postkeyword, substr($episodesResults['content'], -200, 200)); ?> [...]</p>
                        <?php    
                        }else{
                        ?>
                            <p><?php echo highlightKeyword($postkeyword, substr($episodesResults['content'], $poskeyword - 50, 200)); ?> [...]</p>
                        <?php    
                        }
                        ?>
                        <p><a href="index.php?action=displayEpisode&idepisode=<?php echo $episodesResults['id']; ?>">DECOUVRIR L'EPISODE</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si les résltats de recherche son nuls
    }else{
    ?>
        <p>Aucun épisode ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>