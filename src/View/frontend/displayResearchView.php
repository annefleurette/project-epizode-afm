
<?php
$head_title = 'Epizode - Recherche de mots clés';
$head_description = "Résultats de recherche parmi les séries, les auteurs et les épisodes d'Epizode";
include('./src/Utils/colorkeyword.php');
ob_start();
?>
<h1> Résultats de la recherche : "<?php echo $postkeyword; ?>"
<nav>
    <ul>
        <li class="seriesTab" data-index="1">Séries</li>
        <li class="seriesTab" data-index="2">Auteurs</li>
        <li class="seriesTab" data-index="3">Episodes</li>
    </ul>
</nav>
<section class="seriesContent" data-tab="1">
    <h2>Séries</h2>
    <?php
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
                        if($seriesResults['type'] === "publisher")
                        {
                        ?>
                            <p><?php echo $seriesResults['pricing']; ?></p>
                            <p><img src="<?php echo $seriesResults['logo']; ?>" alt="<?php echo $seriesResults['altlogo']; ?>"/></p>
                            <p><?php echo highlightKeyword($postkeyword, $seriesResults['publisher']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $seriesResults['member']); ?></p>
                            <p><?php echo $seriesResults['author']; ?></p>
                        <?php
                        }else{
                        ?>  
                            <p><img src="<?php echo $seriesResults['avatar']; ?>" alt="<?php echo $seriesResults['altavatar']; ?>"/></p>  
                            <p><?php echo highlightKeyword($postkeyword, $seriesResults['member']); ?></p>
                            <?php
                        }
                        ?>
                        <p><a href="index.php?action=displaySeriesView&idseries=<?php echo $seriesResults['id']; ?>">DECOUVRIR LA SERIE</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    }else{
    ?>
        <p>Aucune série ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<section class="seriesContent" data-tab="2" hidden>
    <h2>Auteurs</h2>
    <?php
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
                        if($authorsResults['type'] === "publisher")
                        {
                        ?>
                            <p><img src="<?php echo $authorsResults['logo']; ?>" alt="<?php echo $authorsResults['altlogo']; ?>"/></p>
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['member']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['publisher']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['author']); ?></p>
                        <?php
                        }else{
                        ?>  
                            <p><img src="<?php echo $authorsResults['avatar']; ?>" alt="<?php echo $authorsResults['altavatar']; ?>"/></p>  
                            <p><?php echo highlightKeyword($postkeyword, $authorsResults['member']); ?></p>
                            <?php
                        }
                        ?>
                        <p><?php echo $authorsResults['numberWritings']; ?> séries écrites</p>
                        <p><a href="index.php?action=displayMemberView&idmember=<?php echo $authorsResults['id']; ?>">DECOUVRIR L'AUTEUR</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    }else{
    ?>
        <p>Aucun auteur ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<section class="seriesContent" data-tab="3" hidden>
    <h2>Episodes</h2>
    <?php
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
                        if($episodesResults['type'] === "publisher")
                        {
                        ?>
                            <p><?php echo $episodesResults['pricing']; ?></p>
                            <p><img src="<?php echo $episodesResults['logo']; ?>" alt="<?php echo $seriesResults['altlogo']; ?>"/></p>
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['publisher']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['member']); ?></p>
                            <p><?php echo highlightKeyword($postkeyword, $episodesResults['author']); ?></p>
                        <?php
                        }else{
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
                        <p><a href="index.php?action=displayEpisodeView&idepisode=<?php echo $episodesResults['id']; ?>">DECOUVRIR L'EPISODE</a></p>
                    </article>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
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