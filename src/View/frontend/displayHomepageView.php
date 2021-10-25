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
                            <p><img class="cover" src="<?php echo $newSeries['cover']; ?>" alt="<?php echo $newSeries['altcover']; ?>"/></p>
                            <figcaption>
                                <h1><?php echo $newSeries['title']; ?></h1>
                                <?php
                                // Si la série est écrite par un éditeur
                                if($newSeries['type'] === "publisher")
                                {
                                ?>
                                    <div class="member">
                                        <img src="<?php echo $newSeries['logo']; ?>" alt="<?php echo $newSeries['altlogo']; ?>"/>
                                        <p><?php echo $newSeries['publisher']; ?></p>
                                    </div>
                                <?php
                                // Si la série est écrite par un autre utilisateur
                                }else{
                                ?>  
                                    <div class="member">
                                        <img src="<?php echo $newSeries['avatar']; ?>" alt="<?php echo $newSeries['altavatar']; ?>"/>
                                        <p><?php echo $newSeries['author']; ?></p>  
                                    </div>
                                <?php
                                }
                                ?>
                                <p class="tags"><?php echo $newSeries['tags']; ?></p>
                                <?php
                                // Si la série est payante
                                if($newSeries['pricing'] == "paying")
                                {
                                ?>
                                    <p>Série payante</p>
                                <?php
                                // Si la série est gratuite
                                }else{
                                ?>
                                    <p>Série gratuite</p>
                                <?php
                                }
                                ?>
                                <br />
                                <div><a class="btn btn-green" href="index.php?action=displaySeries&idseries=<?php echo $newSeries['id']; ?>">Découvrir la série à lire</a></div>
                            </figcaption>
                        </figure>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>    
    <?php
    }
    ?>
</section>
<section id="presentation"> <!-- Section de présentation du concept Epizode -->
<h2>Plongez dans un monde de séries</h2>
<p>Des séries originales à lire n'importe où et à tout moment</p>
<p>Une nouvelle série à découvrir chaque semaine</p>
</section>
<section id="popularity">
<h2>Les séries les plus populaires</h2>   
    <div class="topten">
        <div class="topten-5"> <!-- Section qui comporte le top 10 des séries éditeurs -->
            <h3>Top 5 des séries éditeurs</h3>
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
                            <img class="cover cover-5" src="<?php echo $seriesTopFive['cover']; ?>" alt="<?php echo $seriesTopFive['altcover']; ?>" />
                            <div class="series-data">
                                <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesTopFive['id']; ?>"><?php echo $seriesTopFive['title']; ?></a></p>
                                <div class="member">
                                    <img src="<?php echo $seriesTopFive['logo']; ?>" alt="<?php echo $seriesTopFive['alt']; ?>" />
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $seriesTopFive['idmember']; ?>"><?php echo $seriesTopFive['publisher']; ?></a></p>
                                </div>
                                <p><?php echo $seriesTopFive['author']; ?></p>
                                <p><?php echo $seriesTopFive['numberSubscribers']; ?> abonné(s)</p>
                            </div>
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
        </div>
        <div class="topten-5"> <!-- Section qui comporte le top 10 des séries amateurs -->
            <h3>Top 5 des séries talents</h3>
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
                            <img class="cover cover-5" src="<?php echo $seriesTopFive['cover']; ?>" alt="<?php echo $seriesTopFive['altcover']; ?>" />
                            <div class="series-data">
                                <p><a href="index.php?action=displaySeries&idseries=<?php echo $seriesTopFive['id']; ?>"><?php echo $seriesTopFive['title']; ?></a></p>
                                <div class="member">
                                    <img src="<?php echo $seriesTopFive['avatar']; ?>" alt="<?php echo $seriesTopFive['alt']; ?>" />
                                    <p><a href="index.php?action=displayMember&idmember=<?php echo $seriesTopFive['idmember']; ?>"><?php echo $seriesTopFive['author']; ?></a></p>
                                </div>
                                <p><?php echo $seriesTopFive['numberSubscribers']; ?> abonné(s)</p>
                            </div>
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
        </sdiv>
    </div>
</section>
<script type="text/javascript" src="./public/js/objects/slider.js"></script>
<script type="text/javascript" src="./public/js/carousel.js"></script>
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>