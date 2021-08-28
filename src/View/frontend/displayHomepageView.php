
<?php
$head_title = 'Epizode';
$head_description = "Blabla";
ob_start();
?>
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
<?php
$body_content = ob_get_clean();
require('./src/View/template.php');
?>