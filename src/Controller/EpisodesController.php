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

    public function writeEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice, $postpromotion, $postsigns, $postmeta, $seriesId)
    {
        $episodesManager = new EpisodesManager();
        $seriesManager = new SeriesManager();
        //On compte le nombre d'épisodes de la série qui ont été publiés
        $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
        $count_episode_published = intval($nbepisodes);
        // L'épisode suivant à publier prendra +1
        $count_episode_publishable = $count_episode_published + 1;
        if(isset($postsave))
        { // Si le bouton Enregistrer est choisi
            // Enregistrement de l'épisode dans la base de données
            $postsave = htmlspecialchars($postsave);
            $postnumber = htmlspecialchars($postnumber);
            $posttitle = htmlspecialchars($posttitle);
            $postprice = htmlspecialchars($postprice);
            $postpromotion = htmlspecialchars($postpromotion);
            $postsigns = htmlspecialchars($postsigns);
            $postmeta = htmlspecialchars($postmeta);
            $seriesId = htmlspecialchars($seriesId);
            //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
            $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber, $seriesId);
            if (empty($episode_unitary_published))
            {
                // Si le montant de la promotion est bien inférieur au montant du prix
                if ($postpromotion <= $postprice)
                {
                    // On enregistre le nouvel épisode
                    $addEpisode = $episodesManager->addEpisode($postnumber, $posttitle, $postcontent, "inprogress", $seriesId, $postprice, $postpromotion, $postsigns, $postmeta);
                    header("Location: updateSeries/" .$seriesId. "/2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['metaEpisode'] = $postmeta;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: writeEpisode/series/" .$seriesId);
                }
            }else{
                // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                $_SESSION['tempNumber'] = $postnumber;
                $_SESSION['tempTitle'] = $posttitle;
                $_SESSION['tempContent'] = $postcontent;
                $_SESSION['tempPrice'] = $postprice;
                $_SESSION['tempPromotion'] = $postpromotion;
                $_SESSION['metaEpisode'] = $postmeta;
                $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                header("Location: writeEpisode/series/" .$seriesId);
            }
        }else{ // Si le bouton Publier est choisi
            // Enregistrement de l'épisode à publier dans la base de données
            $postnumber = htmlspecialchars($postnumber);
            $posttitle = htmlspecialchars($posttitle);
            $postprice = htmlspecialchars($postprice);
            $postpromotion = htmlspecialchars($postpromotion);
            $postsigns = htmlspecialchars($postsigns);
            $seriesId = htmlspecialchars($seriesId);
            $postmeta = htmlspecialchars($postmeta);
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
                    $addEpisode = $episodesManager->addEpisode($postnumber, $posttitle, $postcontent, "published", $seriesId, $postprice, $postpromotion, $postsigns, $postmeta);
                    // On passe la série en publiée
                    $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                    header("Location: updateSeries/" .$seriesId. "/2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['metaEpisode'] = $postmeta;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: writeEpisode/series/" .$seriesId);
                }
            }else{
                // On prépare des variables de session temporaires pour anticiper les erreurs
                $_SESSION['tempNumber'] = $postnumber;
                $_SESSION['tempTitle'] = $posttitle;
                $_SESSION['tempContent'] = $postcontent;
                $_SESSION['tempPrice'] = $postprice;
                $_SESSION['tempPromotion'] = $postpromotion;
                $_SESSION['metaEpisode'] = $postmeta;
                $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                header("Location: writeEpisode/series" .$seriesId);
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

    public function updateEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice, $postpromotion, $postsigns, $postmeta, $seriesId, $episodeId)
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
            $postmeta = htmlspecialchars($postmeta);
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
                    $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "inprogress", $postprice, $postpromotion, $postsigns, $postmeta, $episodeId);
                    header("Location: updateSeries/" .$seriesId. "/2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['metaEpisode'] = $postmeta;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: updateEpisode/" .$seriesId . "/" .$episodeId);
                }
            }else{
                // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                $_SESSION['tempNumber'] = $postnumber;
                $_SESSION['tempTitle'] = $posttitle;
                $_SESSION['tempContent'] = $postcontent;
                $_SESSION['tempPrice'] = $postprice;
                $_SESSION['tempPromotion'] = $postpromotion;
                $_SESSION['metaEpisode'] = $postmeta;
                $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                header("Location: updateEpisode/" .$seriesId . "/" .$episodeId);
            }
        }else{ // Si le bouton Publier est choisi
            // Modification de l'épisode à publier dans la base de données
            $posttitle = htmlspecialchars($posttitle);
            $postprice = htmlspecialchars($postprice);
            $postpromotion = htmlspecialchars($postpromotion);
            $postsigns = htmlspecialchars($postsigns);
            $postmeta = htmlspecialchars($postmeta);
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
                        // On modifie l'épisode
                        $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "published", $postprice, $postpromotion, $postsigns, $postmeta, $episodeId);
                        $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                        header("Location: updateSeries/" .$seriesId. "/2");
                    }else{
                        $_SESSION['tempNumber'] = $postnumber;
                        $_SESSION['tempTitle'] = $posttitle;
                        $_SESSION['tempContent'] = $postcontent;
                        $_SESSION['tempPrice'] = $postprice;
                        $_SESSION['tempPromotion'] = $postpromotion;
                        $_SESSION['metaEpisode'] = $postmeta;
                        $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                        header("Location: updateEpisode/" .$seriesId . "/" .$episodeId);
                        }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['metaEpisode'] = $postmeta;
                    $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                    header("Location: updateEpisode/" .$seriesId . "/" .$episodeId);
                }
            }else{
                // Si le montant de la promotion est bien inférieur au montant du prix
                if ($postpromotion <= $postprice)
                {
                    // On modifie l'épisode
                    $updateEpisode = $episodesManager->updateEpisode($oneEpisode['number'], $posttitle, $postcontent, "published", $postprice, $postpromotion, $postsigns, $postmeta, $episodeId);
                    $updateSeriesStatus = $seriesManager->updateSeriesStatus("published", $seriesId);
                    header("Location: updateSeries/" .$seriesId. "/2");
                }else{
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['metaEpisode'] = $postmeta;
                    $_SESSION['error'] = "Saisissez une promotion inférieure ou égale au prix de votre épisode";
                    header("Location: updateEpisode/" .$seriesId . "/" .$episodeId);
                }
            }        
        } 
    }      

    public function userDeleteEpisode($seriesId, $episodeId)
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
                // On supprime définitivement l'épisode
                $deleteEpisode = $episodesManager->deleteEpisode($episodeId);
                // On compte le nombre d'épisodes de la série
                $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
                // On repasse le statut de la série à en cours quand il n'y a plus d'épisodes publiés
                if($nbepisodes < 1){
                    $updateSeriesStatus = $seriesManager->updateSeriesStatus("inprogress", $seriesId);
                }
                header("Location: updateSeries/" .$seriesId. "/2");
            }else{
                require('./src/View/404error.php');
            }
        }else{
            require('./src/View/403error.php');
        }  
    }
      
    public function adminDeleteEpisode($episodeId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        // On récupère l'id de la série
        $idSeriesEpisode = $episodesManager->getIdSeriesEpisode($episodeId);
        // On supprime définitivement l'épisode
        $deleteEpisode = $episodesManager->deleteEpisode($episodeId);
        // On compte le nombre d'épisodes de la série
        $nbepisodes = $episodesManager->countEpisodesPublished($idSeriesEpisode);
        // On repasse le statut de la série à en cours quand il n'y a plus d'épisodes publiés
        if($nbepisodes < 1){
            $updateSeriesStatus = $seriesManager->updateSeriesStatus("inprogress", $idSeriesEpisode);
        }
        header("Location: admin/3"); 
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
                // On récupère les informations de la série
                $oneSeriesPublicData = $seriesManager->getOneSeriesPublicData($seriesId);
            }
            // On s'assure que la série est publiée donc publique
            if($oneSeriesPublicData['publishing'] == "published")
            {
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
                $next_episode_unitary_published = $episodesManager->getEpisodePublished($episode_next, $seriesId);
                $prev_episode_unitary_published = $episodesManager->getEpisodePublished($episode_before, $seriesId);
                // On affiche les commentaires de l'épisode
                $episodeCommentsList = $commentsManager->getCommentsEpisode($episode_unitary_published["id"]);
                // On compte le nombre de commentaires
                $nbcomments = $commentsManager->countCommentsPublished($episode_unitary_published["id"]);
                $totalcomments = intval($nbcomments[0]);
                require('./src/View/frontend/displayEpisodeView.php');
            }else{
                require('./src/View/403error.php');
            }
        }else{
            require('./src/View/404error.php');
        }
    }

    public function addLike($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        // On ajoute un like à un épisode
        $episodeLike = $episodesManager->addEpisodeLike($episodeId, $_SESSION['idmember']);
        // On récupère le nombre de likes actualisés
        $episodeLikes = $episodesManager->getEpisodeLikes($episodeId);
        echo json_encode($episodeLikes);
    }

    public function removeLike($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        // On retire un like à un épisode
        $deleteLike = $episodesManager->deleteLike($episodeId, $_SESSION['idmember']);
        // On récupère le nombre de likes actualisés
        $episodeLikes = $episodesManager->getEpisodeLikes($episodeId);
        echo json_encode($episodeLikes);
    }

    public function addAlertEpisode($episodeId)
    {
        $episodesManager = new EpisodesManager();
        $episodeId = htmlspecialchars($episodeId);
        $alert = 1;
        // On ajoute un signalement à un épisode
        $updateAlertEpisode = $episodesManager->updateEpisodeAlert($alert, intval($episodeId));
    }

    public function removeAlertEpisodePost($episodeId)
    {
        $episodesManager = new EpisodesManager;
        $episodeId = htmlspecialchars($episodeId);
        // On enlève le signalement d'un épisode
        $alert = 0;
        $updateAlertEpisode = $episodesManager->updateEpisodeAlert($alert, $episodeId);
        header("Location: admin/3"); 
    }

}