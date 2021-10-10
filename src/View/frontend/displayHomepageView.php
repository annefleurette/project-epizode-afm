
<?php
$head_title = 'Epizode';
$head_description = "Lisez et écrivez, où et quand vous voulez, des séries originales pour tous les goûts ! Rejoignez vite la communauté Epizode !";
ob_start();
?>
<section id="slider">
<?php
    if($seriesLastSix !== NULL)
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
                                if($newSeries['type'] === "publisher")
                                {
                                ?>
                                    <p><img src="<?php echo $newSeries['logo']; ?>" alt="<?php echo $newSeries['altlogo']; ?>"/></p>
                                    <p><?php echo $newSeries['publisher']; ?></p>
                                    <p><?php echo $newSeries['author']; ?></p>
                                <?php
                                }else{
                                ?>  
                                    <p><img src="<?php echo $newSeries['avatar']; ?>" alt="<?php echo $newSeries['altavatar']; ?>"/></p>  
                                    <p><?php echo $newSeries['author']; ?></p>
                                <?php
                                }
                                ?>
                                <p><?php echo $newSeries['tags']; ?></p>
                                <p><?php echo $newSeries['pricing']; ?></p>
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
</section>
<section>
<h2>Plongez dans un monde de séries</h2>
<p>Des séries originales à lire n'importe où et à tout moment</p>
<p>Une nouvelle série à découvrir chaque semaine</p>
</section>
<section>
    <h2>Top 10 des séries éditeurs</h2>
    <ul>
    <?php
        foreach ($seriesTopTenPublishers as $seriesTopTen)
        {
        ?>
            <li>
                <article>
                    <p><?php echo $seriesTopTen['title']; ?></p>
                    <p><img src="<?php echo $seriesTopTen['logo']; ?>" alt="<?php echo $seriesTopTen['alt']; ?>" /></p>
                    <p><?php echo $seriesTopTen['author']; ?></p>
                    <p><?php echo $seriesTopTen['numberSubscribers']; ?> abonné(s)</p>
                </article>
            </li>
        <?php
        }
        ?>
</section>
<section>
    <h2>Top 10 des séries talents</h2>
    <ul>
    <?php
        foreach ($seriesTopTenUsers as $seriesTopTen)
        {
        ?>
            <li>
                <article>
                    <p><?php echo $seriesTopTen['title']; ?></p>
                    <p><img src="<?php echo $seriesTopTen['avatar']; ?>" alt="<?php echo $seriesTopTen['alt']; ?>" /></p>
                    <p><?php echo $seriesTopTen['author']; ?></p>
                    <p><?php echo $seriesTopTen['numberSubscribers']; ?> abonné(s)</p>
                </article>
            </li>
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