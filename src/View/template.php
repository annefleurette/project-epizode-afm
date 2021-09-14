<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
        <!-- <base href="http://www.epizode.fr/"> -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script> 
        <script src="https://kit.fontawesome.com/d1f6a249f3.js" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
        <link rel="stylesheet" href="./public/css/style.css" />
        <link rel="shortcut icon" type="image/png" href="./public/images/logo.png"/>
        <title><?php echo $head_title; ?></title>
        <meta name="robots" content="noindex">
    </head>
    <body>
    <div>
        <?php require("./src/View/header.php");
        // Pour afficher l'erreur sur la page
        if(isset($_SESSION['error']))
        {
        ?>
            <p><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']);
        }
    	echo $body_content;
        require("./src/View/footer.php");?>
        </div>
    </body>
  </html>