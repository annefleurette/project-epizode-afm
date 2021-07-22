
<?php
$head_title = 'Epizode - Informations sur le membre';
ob_start();
?>
<nav>
    <ul>
        <li class="memberTab" data-index="1">Ses séries</li>
        <?php
        if($userData['type'] == "user")
        {
        ?>
        	<li class="memberTab" data-index="2">Ses lectures</li>
        <?php
        }elseif($userData['type'] == "publisher"){
        ?>
       		<li class="memberTab" data-index="2">Ses auteurs</li>
       	<?php
       	}
       	?>
    </ul>">
</nav>
<section class="seriesList" data-tab="1">
</section>
<?php
if($userData['type'] == "user")
{
?>
	<section class="readingsList" data-tab="2">
	</section>
<?php
}elseif($userData['type'] == "publisher"){
?>
	<section class="authorsList" data-tab="2">
	</section>
}
<?php
?>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>