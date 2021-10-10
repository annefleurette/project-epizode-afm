<?php
// Page d'erreur 404
$head_title = 'Epizode - Erreur 404';
$head_description = 'Page d\'erreur 404 d\'Epizode';
ob_start();
?>
<section>
    <h1>Erreur 404</h1>
    <p>Cette page n'existe pas !</p>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>