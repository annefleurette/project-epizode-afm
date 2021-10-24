<?php
// Homepage du site internet
$head_title = 'Epizode';
$head_description = "Lisez et écrivez, où et quand vous voulez, des séries originales pour tous les goûts ! Rejoignez vite la communauté Epizode !";
ob_start();
?>
<section id="slider"> <!-- Carrousel des six dernières séries publiées sur Epizode (3 éditeurs, 3 amateurs) -->
<?php
    // S'il y a bien au moins une série publiée
    if(!empty($seriesLastSix))
    {
    ?>
        <div id="slider-images">
            <ul>
                <?php
                foreach ($seriesLastSix as $newSeries)
                {
                ?>
                    <li class="slide">
                        <figure>
                            <p><img src="<?php echo $newSeries['cover']; ?>" alt="<?php echo $newSeries['altcover']; ?>"/></p>
                            <figcaption>
                                <h1><?php echo $newSeries['title']; ?></h1>
                                <?php
                                // Si la série est écrite par un éditeur
                                if($newSeries['type'] === "publisher")
                                {
                                ?>
                                    <p><img src="<?php echo $newSeries['logo']; ?>" alt="<?php echo $newSeries['altlogo']; ?>"/></p>
                                    <p><?php echo $newSeries['publisher']; ?></p>
                                    <p><?php echo $newSeries['author']; ?></p>
                                <?php
                                // Si la série est écrite par un autre utilisateur
                                }else{
                                ?>  
                                    <p><img src="<?php echo $newSeries['avatar']; ?>" alt="<?php echo $newSeries['altavatar']; ?>"/></p>  
                                    <p><?php echo $newSeries['author']; ?></p>
                                <?php
                                }
                                ?>
                                <p><?php echo $newSeries['tags']; ?></p>
                                <?php
                                // Si la série est payante
                                if($newSeries['pricing'] == "paying")
                                {
                                ?>
                                    <p><i class="fas fa-coins"></i></p>
                                <?php
                                // Si la série est gratuite
                                }else{
                                ?>
                                    <p>Série gratuite</p>
                                <?php
                                }
                                ?>
                                <p><a href="index.php?action=displaySeries&idseries=<?php echo $newSeries['id']; ?>">Découvrir la série</a></p>
                            </figcaption>
                        </figure>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div>
            <div>
                <span id="chevron_left" class="chevron"><i class="fas fa-chevron-left"></i></span> 
                <span id="chevron_right" class="chevron"><i class="fas fa-chevron-right"></i></span>
            </div>
            <div class="player">
                <span id="play"><i class="fas fa-play"></i></span>
                <span id="pause"><i class="fas fa-pause"></i></span>
            </div>
        </div>      
    <?php
    }
    ?>
</section>
<section> <!-- Section de présentation du concept Epizode -->
<h2>Plongez dans un monde de séries</h2>
<p>Des séries originales à lire n'importe où et à tout moment</p>
<p>Une nouvelle série à découvrir chaque semaine</p>
</section>
<section> <!-- Section qui comporte le top 10 des séries éditeurs -->
    <h2>Top 5 des séries éditeurs</h2>
    <?php if(!empty($seriesTopFivePublishers))
    {
    ?>
    <ul>
    <?php
        foreach ($seriesTopFivePublishers as $seriesTopFive)
        {
        ?>
            <li>
                <article>
                    <p><img src="<?php echo $seriesTopFive['cover']; ?>" alt="<?php echo $seriesTopFive['altcover']; ?>" /></p>
                    <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesTopFive['id']; ?>"><?php echo $seriesTopFive['title']; ?></a></p>
                    <p><img src="<?php echo $seriesTopFive['logo']; ?>" alt="<?php echo $seriesTopFive['alt']; ?>" /></p>
                    <p><a href="index.php?action=displayMember&idmember=<?php echo $seriesTopFive['idmember']; ?>"><?php echo $seriesTopFive['publisher']; ?></a></p>
                    <p><?php echo $seriesTopFive['author']; ?></p>
                    <p><?php echo $seriesTopFive['numberSubscribers']; ?> abonné(s)</p>
                </article>
            </li>
        <?php
        }
        ?>
    </ul>
    <?php
    }else{
    ?>
    <p>Pas encore de série publiée</p>
    <?php
    }
    ?>
</section>
<section> <!-- Section qui comporte le top 10 des séries amateurs -->
    <h2>Top 5 des séries talents</h2>
    <?php if(!empty($seriesTopFiveUsers))
    {
    ?>
    <ul>
    <?php
        foreach ($seriesTopFiveUsers as $seriesTopFive)
        {
        ?>
            <li>
                <article>
                    <p><img src="<?php echo $seriesTopFive['cover']; ?>" alt="<?php echo $seriesTopFive['altcover']; ?>" /></p>
                    <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesTopFive['id']; ?>"><?php echo $seriesTopFive['title']; ?></a></p>
                    <p><img src="<?php echo $seriesTopFive['avatar']; ?>" alt="<?php echo $seriesTopFive['alt']; ?>" /></p>
                    <p><a href="index.php?action=displayMember&idmember=<?php echo $seriesTopFive['idmember']; ?>"><?php echo $seriesTopFive['author']; ?></a></p>
                    <p><?php echo $seriesTopFive['numberSubscribers']; ?> abonné(s)</p>
                </article>
            </li>
        <?php
        }
        ?>
    </ul>
    <?php
    }else{
    ?>
    <p>Pas encore de série publiée</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/objects/slider.js"></script>
<script type="text/javascript" src="./public/js/carousel.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>