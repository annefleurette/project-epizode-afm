<header>
    <nav>
        <a href="#">
            <img src="#" alt="Epizode"/>
        </a>
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Recherche</a></li>
            <?php if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "user" OR $_SESSION['type'] == "publisher"))
            {
            ?>
                <li>Coins (+ valeur calculée)</li>
                <li><a href="#">Mon compte</a></li>
            <?php
            } elseif(isset($_SESSION['pseudo']) AND $_SESSION['type'] == "admin")
            {
            ?>
                <li><a href="#">Déconnexion</a></li>
            <?php
            } else {
            ?>
                <li><a href="#">Découvrir</a></li>
                <li><a href="#">Connexion</a></li>
            <?php  
            }
            ?>
        </ul>
    </nav>  
</header>