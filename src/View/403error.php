<?php
$head_title = 'Epizode - Erreur 403';
$head_description = 'Page d\'erreur 403 d\'Epizode';
ob_start();
?>
<section>
    <h1>Erreur 403</h1>
    <p>Accès à la page web refusé !</p>
</section>
<?php $body_content = ob_get_clean();
require('template.php');
?>