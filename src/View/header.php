<header>
    <nav class="menu menu__main menu-desktop">
        <div>
            <a href="index.php?action=homepage">
                <img src="./public/images/logo_epizode_purple.png" alt="Epizode"/>
            </a>
        </div>
        <ul>
            <li><a class="menu__main-link" href="index.php?action=homepage">Accueil</a></li>
            <?php if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "user" OR $_SESSION['type'] == "publisher"))
            {
            ?>
                <!-- <li>Coins (+ valeur calculée)</li> Sera à utiliser quand on ajoutera le paiement -->
                <li><a class="menu__main-link" href="index.php?action=dashboard">Mon tableau de bord</a></li>
                <li><a class="menu__main-link" href="index.php?action=account">Mon compte</a></li>
                <li><a class="menu__main-link" href="index.php?action=logout">Déconnexion</a></li>
            <?php
            }elseif(isset($_SESSION['pseudo']) AND $_SESSION['type'] == "admin")
            {
            ?>  
                <li><a class="menu__main-link" href="index.php?action=admin">Mon tableau de bord</a></li>
                <li><a class="menu__main-link" href="index.php?action=logout">Déconnexion</a></li>
            <?php
            }else{
            ?>
                <!-- <li><a href="#">Découvrir</a></li> Page de présentation du concept -->
                <li><a class="menu__main-link" href="index.php?action=subscription">Inscription</a></li>
                <li><a class="menu__main-link"href="index.php?action=login">Connexion</a></li>
            <?php
            }
            ?>
            <li>
                <form action="index.php?action=research" method="post" enctype="multipart/form-data"> 
                    <input type="search" id="site-search" name="keyword">
                    <input class="cta" type="submit" name="search" value="Rechercher">
                </form>
            </li>
        </ul>
    </nav>
    <nav class="menu-mobile" role="navigation">
        <div class="menu-mobile-logo">
            <a href="index.php?action=homepage">
                <img src="./public/images/logo_epizode_purple.png" alt="Epizode"/>
            </a>
        </div> 
        <div id="menuToggle">
                <!--
                A fake / hidden checkbox is used as click reciever,
                so you can use the :checked selector on it.
                -->
                <input type="checkbox" />
                <!--
                Some spans to act as a hamburger.
                -->
                <span></span>
                <span></span>
                <span></span>
                <!--
                Too bad the menu has to be inside of the button
                but hey, it's pure CSS magic.
                -->
                <ul id="menu-mobile-list">
                    <li><a class="menu__main-link" href="index.php?action=homepage">Accueil</a></li>
                    <?php if(isset($_SESSION['pseudo']) AND ($_SESSION['type'] == "user" OR $_SESSION['type'] == "publisher"))
                    {
                    ?>
                        <!-- <li>Coins (+ valeur calculée)</li> Sera à utiliser quand on ajoutera le paiement -->
                        <li><a class="menu__main-link" href="index.php?action=dashboard">Mon tableau de bord</a></li>
                        <li><a class="menu__main-link" href="index.php?action=account">Mon compte</a></li>
                        <li><a class="menu__main-link" href="index.php?action=logout">Déconnexion</a></li>
                    <?php
                    }elseif(isset($_SESSION['pseudo']) AND $_SESSION['type'] == "admin")
                    {
                    ?>  
                        <li><a class="menu__main-link" href="index.php?action=admin">Mon tableau de bord</a></li>
                        <li><a class="menu__main-link" href="index.php?action=logout">Déconnexion</a></li>
                    <?php
                    }else{
                    ?>
                        <!-- <li><a href="#">Découvrir</a></li> Page de présentation du concept -->
                        <li><a class="menu__main-link" href="index.php?action=subscription">Inscription</a></li>
                        <li><a class="menu__main-link"href="index.php?action=login">Connexion</a></li>
                    <?php
                    }
                    ?>
                    <li>
                        <form class="search-mobile" action="index.php?action=research" method="post" enctype="multipart/form-data"> 
                            <input type="search" id="site-search" name="keyword">
                            <br/>
                            <input class="cta cta-mobile" type="submit" name="search" value="Rechercher">
                        </form>
                    </li>
                </ul>
        </div>
    </nav>
</header>