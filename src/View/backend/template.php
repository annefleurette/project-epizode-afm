<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <!-- <base href="http://www.epizode.fr/"> -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./public/css/style.css" />
        <link rel="shortcut icon" type="image/png" href="./public/images/logo.png"/>
        <title><?php echo $head_title; ?></title>
        <meta name="robots" content="noindex">
    </head>
    <body>
        <div>
        <?php require("../header.php");?>
           <?php echo $body_content; ?>
        <?php require("../footer.php");?>
        </div>
    </body>
  </html>