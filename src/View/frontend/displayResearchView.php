<?php
// Page qui affiche les résultats d'une recherche par mot clé
$head_title = 'Epizode - Recherche de mots clés';
include('./src/Utils/colorkeyword.php');
ob_start();
?>
<h1 <?php if(strlen($postkeyword) >= 30 AND strlen($postkeyword) <= 70){ echo "class=medium-title";}elseif(strlen($postkeyword) > 70){ echo "class=big-title";}?>>Résultats de la recherche : <?php echo $postkeyword; ?></h1>
<nav> <!-- Les résultats s'affichent dans les séries, les auteurs et les épisodes -->
    <ul class="menu__second">
        <li class="elementTab" data-index="1">Séries</li>
        <li class="elementTab" data-index="2">Membres</li>
        <li class="elementTab" data-index="3">Episodes</li>
    </ul>
</nav>
<section id="research-series" class="elementContent figure-bloc" data-tab="1"> <!-- Section qui affiche la liste résultats parmi les séries -->
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
                    <figure>
                        <p><img class="cover" src="<?php echo $seriesResults['cover']; ?>" alt="<?php echo $seriesResults['altcover']; ?>"/></p>
                        <figcaption>
                            <!-- Dans mon contenu je surligne quand le mot clé est présent -->
                            <h2><?php echo highlightKeyword($postkeyword, $seriesResults['title']); ?></h2>
                            <?php
                            // Si le membre est un éditeur
                            if($seriesResults['type'] === "publisher")
                            {
                            ?>
                                <div class="member">
                                    <img src="<?php echo $seriesResults['logo']; ?>" alt="<?php echo $seriesResults['altlogo']; ?>"/>
                                    <p><?php echo highlightKeyword($postkeyword, $seriesResults['publisher']); ?></p>
                                </div>
                            <?php
                            // Si le membre est un amateur
                            }elseif($seriesResults['type'] === "user"){
                            ?>  
                                <div class="member">
                                    <img src="<?php echo $seriesResults['avatar']; ?>" alt="<?php echo $seriesResults['altavatar']; ?>"/>
                                    <p><?php echo highlightKeyword($postkeyword, $seriesResults['member']); ?></p>
                                </div>
                            <?php
                            }
                            if($seriesResults['type'] === "publisher")
                            {
                            ?>
                                <p>Auteur : <?php echo highlightKeyword($postkeyword,$seriesResults['author']); ?></p>
                            <?php
                            }
                            ?>
                            <p class="tags"><?php echo highlightKeyword($postkeyword,$seriesResults['tags']); ?></p>
                            <?php
                            // Si le membre est un éditeur
                            if($seriesResults['type'] === "publisher")
                            {
                            ?>
                                <p>Série payante</p>
                            <?php
                            // Si le membre est un amateur
                            }elseif($seriesResults['type'] === "user"){
                            ?>
                                <p>Série gratuite</p>
                            <?php
                            }
                            ?>
                            <br />
                            <p><a class="btn btn-purple" href="index.php?action=displaySeries&idseries=<?php echo $seriesResults['id']; ?>">Découvrir la série à lire</a></p>
                        </figcaption>
                    </figure>
                    <div class="research-summary">
                        <h3>Synopsis</h3>
                        <p><?php echo highlightKeyword($postkeyword, $seriesResults['summary']); ?></p>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    <?php
    // Si les résultats de recherche sont nuls
    }else{
    ?>
        <p class="no">Aucune série ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<section id="research-members" class="elementContent" data-tab="2" hidden> <!-- Section qui affiche les résultats de recherche parmi les auteurs -->
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
                            <div class="member">
                                <img src="<?php echo $authorsResults['logo']; ?>" alt="<?php echo $authorsResults['altlogo']; ?>"/>
                                <p><?php echo highlightKeyword($postkeyword, $authorsResults['publisher']); ?></p>
                            </div>
                        <?php
                        // Si le membre est un amateur
                        }elseif($authorsResults['type'] === "user"){
                        ?>  
                            <div>
                                <img src="<?php echo $authorsResults['avatar']; ?>" alt="<?php echo $authorsResults['altavatar']; ?>"/> 
                                <p><?php echo highlightKeyword($postkeyword, $authorsResults['member']); ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <p class="research-series__data"><?php echo $authorsResults['numberWritings']; ?> série(s) écrite(s)</p>
                        <br />
                        <p class="research-series__data"><a class="btn btn-purple" href="index.php?action=displayMember&idmember=<?php echo $authorsResults['id']; ?>">Découvrir le membre</a></p>
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
        <p class="no">Aucun auteur ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<section id="research-episodes" class="elementContent" data-tab="3" hidden> <!-- Section qui affiche les résultats de recherche parmi les épisodes -->
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
                        <h2 class="research-series__data"><?php echo $episodesResults['title']; ?> - Episode n°<?php echo $episodesResults['number']; ?></h2>
                        <?php
                        // Si le membre est un éditeur
                        if($episodesResults['type'] === "publisher")
                        {
                        ?>
                            <div class="member">
                                <img src="<?php echo $episodesResults['logo']; ?>" alt="<?php echo $seriesResults['altlogo']; ?>"/>
                                <p><?php echo highlightKeyword($postkeyword, $episodesResults['publisher']); ?></p>
                            </div>
                        <?php
                        // Si le membre est un amateur
                        }elseif($episodesResults['type'] === "user"){
                        ?> 
                            <div class="member">
                                <img src="<?php echo $episodesResults['avatar']; ?>" alt="<?php echo $episodesResults['altavatar']; ?>"/> 
                                <p><?php echo highlightKeyword($postkeyword, $episodesResults['member']); ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <p class="research-series__data">Titre : <?php echo highlightKeyword($postkeyword, $episodesResults['titleEpisode']); ?></p>
                        <?php $poskeyword = strpos(strtolower($episodesResults['content']), strtolower($postkeyword));
                        $numbercharacter = strlen($episodesResults['content']);
                        // Au sein du contenu de l'épisode, on isole la section qui comporte les mots clés saisis
                        if ($poskeyword < 150){
                        ?>
                            <p class="research-series__data">Extrait : <?php echo highlightKeyword($postkeyword, substr($episodesResults['content'], 0, 200)); ?> [...]</p>
                        <?php
                        }elseif($poskeyword < $numbercharacter AND $poskeyword > $numbercharacter - 200)
                        {
                        ?>
                            <p class="research-series__data">Extrait : <?php echo highlightKeyword($postkeyword, substr($episodesResults['content'], -200, 200)); ?> [...]</p>
                        <?php    
                        }else{
                        ?>
                            <p class="research-series__data">Extrait : <?php echo highlightKeyword($postkeyword, substr($episodesResults['content'], $poskeyword - 50, 200)); ?> [...]</p>
                        <?php    
                        }
                        // Si le membre est un éditeur
                            if($episodesResults['type'] === "publisher")
                            {
                            ?>
                                <p class="research-series__data">Série payante</p>
                            <?php
                            // Si le membre est un amateur
                            }elseif($episodesResults['type'] === "user"){
                            ?>
                                <p class="research-series__data">Série gratuite</p>
                            <?php
                            }
                            ?>
                        <br />
                        <p class="research-series__data"><a class="btn btn-purple" href="index.php?action=displayEpisode&idepisode=<?php echo $episodesResults['id']; ?>">Découvrir l'épisode à lire</a></p>
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
        <p class="no">Aucun épisode ne correspond à la recherche</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>