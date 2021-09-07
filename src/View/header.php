<header>
    <nav>
        <a href="#">
            <img src="#" alt="Epizode"/>
        </a>
        <ul>
            <li><a href="index.php?action=homepage">Accueil</a></li>
            <?php if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "user" OR $_SESSION['type'] == "publisher"))
            {
            ?>
                <!-- <li>Coins (+ valeur calculée)</li> Sera à utiliser quand on ajoutera le paiement -->
                <li><a href="#">Mon compte</a></li>
                <li><a href="index.php?action=dashboard">Mon tableau de bord</a></li>
                <li><a href="index.php?action=logout">Déconnexion</a></li>
            <?php
            }elseif(isset($_SESSION['pseudo']) AND $_SESSION['type'] == "admin")
            {
            ?>  
                <li><a href="index.php?action=admin">Mon tableau de bord</a></li>
                <li><a href="index.php?action=logout">Déconnexion</a></li>
            <?php
            }else{
            ?>
                <!-- <li><a href="#">Découvrir</a></li> Page de présentation du concept -->
                <li><a href="index.php?action=login">Connexion</a></li>
            <?php
            }
            ?>
            <li>
                <form action="index.php?action=research" method="post" enctype="multipart/form-data"> 
                    <input type="search" id="site-search" name="keyword">
                    <input type="submit" name="search" value="Rechercher">
                </form>
            </li>
        </ul>
    </nav>  
</header>