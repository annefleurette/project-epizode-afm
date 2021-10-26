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
        <script src='https://cdn.tiny.cloud/1/rusvh5uity3vzz9zncbvyfu2ngucer16rijxcr2fhxwkn4mb/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script src="https://kit.fontawesome.com/d1f6a249f3.js" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css" />
        <link rel="stylesheet" href="./public/css/style.css" />
        <link rel="shortcut icon" type="image/png" href="./public/images/favicon_epizode.png" alt="Epizode"/>
        <title><?php echo $head_title; ?></title>
        <meta name="robots" content="noindex">
        <script>
            tinymce.init({
            selector: '#contentEpisode',
            content_css : './public/css/style.css',
            inline_styles : false,
            plugins: "autoresize, wordcount",
            autoresize_overflow_padding: 15,
            autoresize_bottom_margin: 15,
            min_height: 500,
            convert_fonts_to_spans : false,
            invalid_elements: "span, p, a",
            forced_root_block : false,
            force_br_newlines : true,
            force_p_newlines : false,
            init_instance_callback: function (editor) {
            $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
            }
            });
        </script>
    </head>
    <body>
    <div class="container">
        <?php require("./src/View/header.php");
        // Pour afficher l'erreur sur la page
        if(isset($_SESSION['error']))
        {
        ?>
            <p><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']);
        }
        // Pour afficher une confirmation sur la page
        if(isset($_SESSION['confirm']))
        {
        ?>
            <p><?php echo $_SESSION['confirm']; ?></p>
            <?php unset($_SESSION['confirm']);
        }
    	echo $body_content;
        require("./src/View/footer.php");?>
        </div>
    </body>
  </html>