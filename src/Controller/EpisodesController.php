<?php
namespace AnneFleurMarchat\Epizode\Controller;

require_once('src/Model/SeriesManager.php');
require_once('src/Model/EpisodesManager.php');
require_once('src/Model/CommentsManager.php');
require_once('src/Model/MembersManager.php');

use AnneFleurMarchat\Epizode\Model\SeriesManager;
use AnneFleurMarchat\Epizode\Model\EpisodesManager;
use AnneFleurMarchat\Epizode\Model\CommentsManager;

class EpisodesController {

    public function writeEpisode($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            require('./src/View/backend/writeEpisodeView.php');
        }else{
            require('./src/View/403error.php');
        }
    }

    public function writeEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice, $postpromotion, $postdate, $postsigns, $seriesId)
    {
        $episodesManager = new EpisodesManager();
        $seriesManager = new SeriesManager();
        //On compte le nombre d'épisodes de la série qui ont été publiés
        $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
        $count_episode_published = intval($nbepisodes);
        $count_episode_publishable = $count_episode_published + 1;
        if(isset($postsave))
        { // Si le bouton Enregistrer est choisi
            // Enregistrement de l'épisode dans la base de données
            $postsave = htmlspecialchars($postsave);
            $postnumber = htmlspecialchars($postnumber);
            $posttitle = htmlspecialchars($posttitle);
            $postprice = htmlspecialchars($postprice);
            $postpromotion = htmlspecialchars($postpromotion);
            $postdate = htmlspecialchars($postdate);
            $postsigns = htmlspecialchars($postsigns);
            $seriesId = htmlspecialchars($seriesId);
            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
            $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber, $seriesId);
            if (empty($episode_unitary_published))
            {
                // Si le montant de la promotion est bien inférieur au montant du prix
                if ($postpromotion <= $postprice)
                {
                    // On enregistre le nouvel épisode
                    $addEpisode = $episodesManager->addEpisode($postnumber, $posttitle, $postcontent, "inprogress", null, $seriesId, $postprice, $postpromotion, $postsigns);
                    header("Location: index.php?action=updateSeries&idseries=" .$seriesId. "&tab=2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: index.php?action=writeEpisode&idmember&idseries=" .$seriesId);
                }
            }else{
                // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                $_SESSION['tempNumber'] = $postnumber;
                $_SESSION['tempTitle'] = $posttitle;
                $_SESSION['tempContent'] = $postcontent;
                $_SESSION['tempPrice'] = $postprice;
                $_SESSION['tempPromotion'] = $postpromotion;
                $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                header("Location: index.php?action=writeEpisode&idmember&idseries=" .$seriesId);
            }
        }else{ // Si le bouton Publier est choisi
            // Enregistrement de l'épisode à publier dans la base de données
            // Si la date est bien au bon format
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])$/", $postdate))
            {
                $postnumber = htmlspecialchars($postnumber);
                $posttitle = htmlspecialchars($posttitle);
                $postprice = htmlspecialchars($postprice);
                $postpromotion = htmlspecialchars($postpromotion);
                $postsigns = htmlspecialchars($postsigns);
                $seriesId = htmlspecialchars($seriesId);
                $postdate = htmlspecialchars($postdate);
                // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber, $seriesId);
                $current_episode = intval($postnumber);
                if(empty($episode_unitary_published) AND ($current_episode === $count_episode_publishable))
                { // On publie un nouvel épisode
                    // Si le montant de la promotion est bien inférieur au montant du prix
                    if ($postpromotion <= $postprice)
                    {
                        // Si la date de l'épisode à publier est bien postérieure au dernier épisode publié
                        $episode_unitary_published = $episodesManager->getEpisodePublished($count_episode_published, $seriesId);
                        if(strtotime($postdate) > strtotime($episode_unitary_published['date']))
                        {
                            $addEpisode = $episodesManager->addEpisode($postnumber, $posttitle, $postcontent, "published", $postdate, $seriesId, $postprice, $postpromotion, $postsigns);
                            // On passe la série en publiée
                            $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                            header("Location: index.php?action=updateSeries&idseries=" .$seriesId. "&tab=2");
                        }else{
                            // On prépare des variables de session temporaires pour anticiper les erreurs
                            $_SESSION['tempNumber'] = $postnumber;
                            $_SESSION['tempTitle'] = $posttitle;
                            $_SESSION['tempContent'] = $postcontent;
                            $_SESSION['tempPrice'] = $postprice;
                            $_SESSION['tempPromotion'] = $postpromotion;
                            $_SESSION['error'] = "Vous devez publier votre épisode à une date postérieure au dernier épisode publié, c'est-à-dire le " . $episode_unitary_published['date'];
                            header("Location: index.php?action=writeEpisode&idseries=" .$seriesId);
                        }
                    }else{
                        $_SESSION['tempNumber'] = $postnumber;
                        $_SESSION['tempTitle'] = $posttitle;
                        $_SESSION['tempContent'] = $postcontent;
                        $_SESSION['tempPrice'] = $postprice;
                        $_SESSION['tempPromotion'] = $postpromotion;
                        $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                        header("Location: index.php?action=writeEpisode&idseries=" .$seriesId);
                    }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                    header("Location: index.php?action=writeEpisode&idseries=" .$seriesId);
                }
            }else{
                // On prépare des variables de session temporaires pour anticiper les erreurs
                $_SESSION['tempNumber'] = $postnumber;
                $_SESSION['tempTitle'] = $posttitle;
                $_SESSION['tempContent'] = $postcontent;
                $_SESSION['tempPrice'] = $postprice;
                $_SESSION['tempPromotion'] = $postpromotion;
                $_SESSION['error'] = "La date saisie n'est pas au bon format";
                header("Location: index.php?action=writeEpisode&idseries=" .$seriesId);
            }
        }
    }

    public function lookEpisode($seriesId, $episodeId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $seriesId = htmlspecialchars($seriesId);
        $episodeId = htmlspecialchars($episodeId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            // On vérifie que l'épisode existe bien
            $episodesIdList = $episodesManager->getEpisodesIdList($seriesId);
            if (in_array($episodeId, $episodesIdList))
            {
                // On affiche les informations de la série
                $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
                // On affiche les informations de l'épisode
                $oneEpisodesUser = $episodesManager->getEpisodeId($episodeId);
                require('./src/View/backend/lookEpisodeView.php');
            }else{
                require('./src/View/404error.php');
            }
        }else{
            require('./src/View/403error.php');
        }
    }

    public function updateEpisode($seriesId, $episodeId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $seriesId = htmlspecialchars($seriesId);
        $episodeId = htmlspecialchars($episodeId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            // On vérifie que l'épisode existe bien
            $episodesIdList = $episodesManager->getEpisodesIdList($seriesId);
            if (in_array($episodeId, $episodesIdList))
            {
                // On affiche l'épisode
                $oneEpisode = $episodesManager->getEpisodeId($episodeId);
                require('./src/View/backend/updateEpisodeView.php');
            }else{
                require('./src/View/404error.php');
            }
        }else{
            require('./src/View/403error.php');
        }  
    }

    public function updateEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice, $postpromotion, $postdate, $postsigns, $seriesId, $episodeId)
    {
        $episodesManager = new EpisodesManager();
        $seriesManager = new SeriesManager();
        //On compte le nombre d'épisodes de la série qui ont été publiés
        $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
        $count_episode_published = intval($nbepisodes);
        $count_episode_publishable = $count_episode_published + 1;
        // On récupère des informations sur l'épisode
        $oneEpisode = $episodesManager->getEpisodeId($episodeId);
        if(isset($postsave))
        { // Si le bouton Enregistrer est choisi
            // Modification de l'épisode dans la base de données
            // Si les données ont bien été saisies
            $postsave = htmlspecialchars($postsave);
            $postnumber = htmlspecialchars($postnumber);
            $posttitle = htmlspecialchars($posttitle);
            $postprice = htmlspecialchars($postprice);
            $postpromotion = htmlspecialchars($postpromotion);
            $postsigns = htmlspecialchars($postsigns);
            $seriesId = htmlspecialchars($seriesId);
            $episodeId = htmlspecialchars($episodeId);
            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
            $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber, $seriesId);
            if (empty($episode_unitary_published))
            {
                // Si le montant de la promotion est bien inférieur au montant du prix
                if ($postpromotion <= $postprice)
                {
                    // On modifie l'épisode
                    $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "inprogress", null, $postprice, $postpromotion, $postsigns, $episodeId);
                    header("Location: index.php?action=updateSeries&idseries=" .$seriesId. "&tab=2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
                }
            }else{
                // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                $_SESSION['tempNumber'] = $postnumber;
                $_SESSION['tempTitle'] = $posttitle;
                $_SESSION['tempContent'] = $postcontent;
                $_SESSION['tempPrice'] = $postprice;
                $_SESSION['tempPromotion'] = $postpromotion;
                $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
            }
        }else{ // Si le bouton Publier est choisi
            // Modification de l'épisode à publier dans la base de données
            $posttitle = htmlspecialchars($posttitle);
            $postprice = htmlspecialchars($postprice);
            $postpromotion = htmlspecialchars($postpromotion);
            $postsigns = htmlspecialchars($postsigns);
            $seriesId = htmlspecialchars($seriesId);
            $episodeId = htmlspecialchars($episodeId);
            // Si un numéro d'épisode a été saisi
            if(isset($postnumber))
            {
                $postnumber = htmlspecialchars($postnumber);
                //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber, $seriesId);
                $current_episode = intval($postnumber);
                if(empty($episode_unitary_published) AND ($current_episode === $count_episode_publishable))
                {
                    // Si le montant de la promotion est bien inférieur au montant du prix
                    if ($postpromotion <= $postprice)
                    {
                        // Si la date est bien au bon format
                        if(isset($postdate) AND preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])$/", $postdate))
                        {
                            $postdate = htmlspecialchars($postdate);
                            // On modifie l'épisode
                            $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "published", $postdate, $postprice, $postpromotion, $postsigns, $episodeId);
                            $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                        }else{
                            // On modifie l'épisode
                            $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "published", $oneEpisode['date'], $postprice, $postpromotion, $postsigns, $episodeId);  
                            $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                        }
                        header("Location: index.php?action=updateSeries&idseries=" .$seriesId. "&tab=2");
                    }else{
                        $_SESSION['tempNumber'] = $postnumber;
                        $_SESSION['tempTitle'] = $posttitle;
                        $_SESSION['tempContent'] = $postcontent;
                        $_SESSION['tempPrice'] = $postprice;
                        $_SESSION['tempPromotion'] = $postpromotion;
                        $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                        header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
                        }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                    header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
                }
            }else{
                // Si le montant de la promotion est bien inférieur au montant du prix
                if ($postpromotion <= $postprice)
                {
                    if(isset($postdate) AND preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])$/", $postdate))
                    {
                        $postdate = htmlspecialchars($postdate);
                        // On modifie l'épisode
                        $updateEpisode = $episodesManager->updateEpisode($oneEpisode['number'], $posttitle, $postcontent, "published", $postdate, $postprice, $postpromotion, $postsigns, $episodeId);
                        $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                    }else{
                        // On modifie l'épisode
                        $updateEpisode = $episodesManager->updateEpisode($oneEpisode['number'], $posttitle, $postcontent, "published", $oneEpisode['date'], $postprice, $postpromotion, $postsigns, $episodeId);
                        $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                    }
                    header("Location: index.php?action=updateSeries&idseries=" .$seriesId. "&tab=2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
                }
            }        
        } 
    }      

    public function updateEpisodeStatus($seriesId, $episodeId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $seriesId = htmlspecialchars($seriesId);
        $episodeId = htmlspecialchars($episodeId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            // On vérifie que l'épisode existe bien
            $episodesIdList = $episodesManager->getEpisodesIdList($seriesId);
            if (in_array($episodeId, $episodesIdList))
            {
                // On passe le statut de l'épisode en supprimé
                $updateEpisodeStatus = $episodesManager->updateEpisodeStatus("deleted", $episodeId);
                // On compte le nombre d'épisodes de la série
                $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
                // On repasse le statut de la série à en cours quand il n'y a plus d'épisodes publiés
                if($nbepisodes < 1){
                    $updateSeriesStatus = $seriesManager->updateSeriesStatus("inprogress", $seriesId);
                }
                header("Location: index.php?action=updateSeries&idseries=" .$seriesId. "&tab=2");
            }else{
                require('./src/View/404error.php');
            }
        }else{
            require('./src/View/403error.php');
        }  
    }

// A compléter avec l'espace d'administration        
    public function deleteEpisode($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        // On supprime définitivement l'épisode
        $deleteEpisode = $episodesManager->deleteEpisode($episodeId);
        header("Location: "); 
    }

    public function displayEpisode($seriesId, $episodeNumber, $episodeId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $commentsManager = new CommentsManager();
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        // On vérifie que la série existe bien en récupérant les id de toutes les séries publiées
        $getAllIdSeries = $seriesManager->getAllIdSeries();
        if(in_array($seriesId, $getAllIdSeries))
        {
            // On vérifie que l'épisode existe bien
            $episodesIdList = $episodesManager->getEpisodesIdList($seriesId);
            if (in_array($episodeId, $episodesIdList))
            {
                // On affiche les informations de la série
                $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
            }
            // On récupère les informations de l'épisode
            $episode_unitary_published = $episodesManager->getEpisodePublished($episodeNumber, $seriesId);
            $episodeLikes = $episodesManager->getEpisodeLikes($episodeId);
            $episodeLikers = $episodesManager->getEpisodeLikers($episodeId);
            // On affiche les boutons précédents/suivants
            $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
            $totalepisodes = intval($nbepisodes[0]);
            $episode_current = intval($episodeNumber);
            $episode_before = $episode_current - 1;
            $episode_next = $episode_current + 1;
            // On affiche les commentaires de l'épisode
            $episodeCommentsList = $commentsManager->getCommentsEpisode($episode_unitary_published["id"]);
            // On compte le nombre de commentaires
            $nbcomments = $commentsManager->countCommentsPublished($episode_unitary_published["id"]);
            $totalcomments = intval($nbcomments[0]);
            require('./src/View/frontend/displayEpisodeView.php');
        }else{
            require('./src/View/404error.php');
        }
    }

    public function addLike($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        $episodeLike = $episodesManager->addEpisodeLike($episodeId, $_SESSION['idmember']);
        $episodeLikes = $episodesManager->getEpisodeLikes($episodeId);
        echo json_encode($episodeLikes);
    }

    public function removeLike($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        $deleteLike = $episodesManager->deleteLike($episodeId, $_SESSION['idmember']);
        $episodeLikes = $episodesManager->getEpisodeLikes($episodeId);
        echo json_encode($episodeLikes);
    }

    public function addAlertEpisode($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        $alert = 1;
        $updateAlertEpisode = $episodesManager->updateEpisodeAlert($alert, intval($episodeId));
    }

// A compléter avec l'espace d'administration
    public function removeAlertEpisodePost($episodeId)
    {
        $episodesManager = new EpisodesManager;
        $episodeId = htmlspecialchars($episodeId);
        // On enlève le signalement d'un épisode
        $alert = 0;
        $updateAlertEpisode = $episodesManager->updateEpisodeAlert($alert, $episodeId);
        header("Location: ");
    }

}