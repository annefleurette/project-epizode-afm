<?php
namespace AnneFleurMarchat\Epizode\Controller;

require_once('src/Model/SeriesManager.php');
require_once('src/Model/EpisodesManager.php');
require_once('src/Model/CommentsManager.php');
require_once('src/Model/MembersManager.php');

use AnneFleurMarchat\Epizode\Model\SeriesManager;
use AnneFleurMarchat\Epizode\Model\EpisodesManager;
use AnneFleurMarchat\Epizode\Model\MembersManager;

class SeriesController {

    public function displayHomepage()
    {
        $seriesManager = new SeriesManager();
        // On affiche les nouvelles séries éditeurs & amateurs
        $seriesLastThreePublishers = $seriesManager->getLastThreeSeriesPublishers();
        $seriesLastThreeUsers = $seriesManager->getLastThreeSeriesUsers();
        $seriesLastSix = array_merge($seriesLastThreePublishers, $seriesLastThreeUsers);
        // On affiche les top 10 en termes de séries
        $seriesTopTenPublishers = $seriesManager->topTenSeriesPublishers();
        $seriesTopTenUsers = $seriesManager->topTenSeriesUsers();
        require('./src/View/frontend/displayHomepageView.php');
    }

    public function displayResearch($postkeyword)
    {
        $seriesManager = new SeriesManager();
        $postkeyword = htmlspecialchars($postkeyword);
        // On récupère les résultats de la recherche
        // Séries
        $researchSeriesResults = $seriesManager->getResearchSeriesResults('%'.$postkeyword.'%');
        // Auteurs
        $researchAuthorsResults = $seriesManager->getResearchAuthorsResults('%'.$postkeyword.'%');
        // Episodes
        $researchEpisodesResults = $seriesManager->getResearchEpisodesResults('%'.$postkeyword.'%'); 
        require('./src/View/frontend/displayResearchView.php');
    }
    
    public function writeSeries()
    {
        require('./src/View/backend/writeSeriesView.php');
    }
    
    public function writeSeriesPost($postauthorname = null, $postauthordescription = null, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag)
    {
        $seriesManager = new SeriesManager();
        $membersManager = new MembersManager();
        $postauthorname = htmlspecialchars($postauthorname);
        $postauthordescription = htmlspecialchars($postauthordescription);
        $postseriestitle = htmlspecialchars($postseriestitle);
        $postseriessummary = htmlspecialchars($postseriessummary);
        $postseriesright = htmlspecialchars($postseriesright);
        $postseriestag = htmlspecialchars($postseriestag);
        $pricing = "paying";
        $publishing = "inprogress";
        // Testons si le titre est bien unique pour l'utilisateur
        $getAllTitles = $seriesManager->getAllTitles($_SESSION['idmember']);
        if(!in_array($postseriestitle, $getAllTitles))
        {
            // Si une image est ajoutée
            // Testons si l'image a bien été envoyée et s'il n'y a pas d'erreur
            if (isset($_FILES['cover']) AND $_FILES['cover']['error'] == 0)
            {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['cover']['size'] <= 1000000)
                {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['cover']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'png');
                    if (in_array($extension_upload, $extensions_autorisees))
                    {   
                        // On peut valider le fichier et le stocker définitivement
                        $n = 20;
                        $code = bin2hex(random_bytes($n));
                        $covername = $postseriestitle;
                        $covername = str_replace(' ','_',$covername);
                        $newname = $_SESSION['idmember'] . '_' . $code . '_' . basename($_FILES['cover']['name']);
                        move_uploaded_file($_FILES['cover']['tmp_name'], './public/images/' .$newname);
                        $imagealt = $postseriestitle;
                        $imageurl = './public/images/' .$newname;
                        $imagetype = "cover";
                        // On enregistre une image
                        $addImage = $membersManager->addImage($code, $imagetype, $imagealt, $imageurl);
                        // On récupère l'id d'une image sur la base de son url
                        $imageId = $membersManager->getImageId($imageurl);
                        // On enregistre une cover
                        $addCover = $seriesManager->addCover($imageId);
                        // On récupère l'id d'une cover sur la base de l'id_cover
                        $coverId = $seriesManager->getCoverId($imageId);
                        // On crée une variable de session temporaire
                    }else{
                        // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                        $_SESSION['tempAuthorname'] = $postauthorname;
                        $_SESSION['tempAuthordescription'] = $postauthordescription;
                        $_SESSION['tempSeriestitle'] = $postseriestitle;
                        $_SESSION['tempSummary'] = $postseriessummary;
                        $_SESSION['tempRights'] = $postseriesright;
                        $_SESSION['tempTags'] = $postseriestag;
                        $_SESSION['error'] = "Le fichier n'est pas une image";
                        header("Location: index.php?action=writeSeries");
                    }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempAuthorname'] = $postauthorname;
                    $_SESSION['tempAuthordescription'] = $postauthordescription;
                    $_SESSION['tempSeriestitle'] = $postseriestitle;
                    $_SESSION['tempSummary'] = $postseriessummary;
                    $_SESSION['tempRights'] = $postseriesright;
                    $_SESSION['tempTags'] = $postseriestag;
                    $_SESSION['error'] = "Le fichier est trop volumineux";
                    header("Location: index.php?action=writeSeries");
                }
            }else{
                $coverId = 1; // Affiche par défaut
            }
            // On enregistre la nouvelle série
            $addNewSeries = $seriesManager->addSeries($postseriestitle, $postseriessummary, intval($_SESSION['idmember']), $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription);
            // On récupère l'id de la série à partir de son titre, de l'id de l'auteur et de l'id_cover
            $seriesId = $seriesManager->getSeriesId($_SESSION['idmember'], $postseriestitle);
            // Enregistrement des tags
            // On enlève les espaces en début et fin de chaîne
            $postseriestag = trim($postseriestag);
            $tagname = explode(",", $postseriestag);
            for ($i = 0; $i < count($tagname); $i++)
            {
                // On vérifie que le tag n'existe pas déjà
                $getAllTags = $seriesManager->getAllTags();
                if(!in_array(strtolower($postseriestag), $getAllTags))
                {
                    // On enregistre le tag
                    $newtag[$i] = strtolower($tagname[$i]);
                    if($newtag[$i] != NULL)
                    {
                        $addNewTag = $seriesManager->addTag($newtag[$i]);
                    }
                }
                // On récupère l'id du tag
                $tagId = $seriesManager->getTagId($newtag[$i]);
                // On associe le tag à la série
                $addTagSeries = $seriesManager->addTagSeries($tagId, $seriesId);
            }
            header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
        }else{
            // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
            $_SESSION['tempAuthorname'] = $postauthorname;
            $_SESSION['tempAuthordescription'] = $postauthordescription;
            $_SESSION['tempSeriestitle'] = $postseriestitle;
            $_SESSION['tempSummary'] = $postseriessummary;
            $_SESSION['tempRights'] = $postseriesright;
            $_SESSION['tempTags'] = $postseriestag;
            $_SESSION['error'] = "Vous avez déjà créé une série avec le même titre !";
            header("Location: index.php?action=writeSeries");
        }
    }

    public function updateSeries($seriesId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            // On affiche la série
            $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
            $seriesCover = $seriesManager->getSeriesCover($seriesId);
            $tagSeries = $seriesManager->getTagSeries($seriesId);
            $alltags = implode(",", $tagSeries);
            // On affiche les épisodes publiés
            $episodesList = $episodesManager->getEpisodesList($seriesId);
            // On compte le nombre d'épisodes de la série qui ont été publiés
            $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
            require('./src/View/backend/updateSeriesView.php');
        }else{
            require('./src/View/403error.php');
        }
    }

    public function updateSeriesPost($postauthorname = null, $postauthordescription = null, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag, $seriesId)
    {
        $seriesManager = new SeriesManager();
        $membersManager = new MembersManager();
        $postauthorname = htmlspecialchars($postauthorname);
        $postauthordescription = htmlspecialchars($postauthordescription);
        $postseriestitle = htmlspecialchars($postseriestitle);
        $postseriessummary = htmlspecialchars($postseriessummary);
        $postseriesright = htmlspecialchars($postseriesright);
        $postseriestag = htmlspecialchars($postseriestag);
        $seriesId = htmlspecialchars($seriesId);
        $pricing = "paying";
        $publishing = "inprogress";
        // Testons si le titre est bien unique pour l'utilisateur
        // On récupère tous les titres de série publiées par l'utilisateur
        $getAllTitles = $seriesManager->getAllTitles($_SESSION['idmember']);
        // On récupère le titre actuel
        $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
        // On l'enlève de $getAllTitles
        $getAllTitles = array_diff($getAllTitles, str_split($oneSeriesUserData['title'], 10000));
        if(!in_array($postseriestitle, $getAllTitles))
        {
            // Si l'image de couverture change
            // Testons si l'image a bien été envoyée et s'il n'y a pas d'erreur
            if (isset($_FILES['cover']) AND $_FILES['cover']['error'] == 0)
            {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['cover']['size'] <= 1000000)
                {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['cover']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'png');
                    if (in_array($extension_upload, $extensions_autorisees))
                    {   
                        // On récupère l'URL de l'image déjà enregistrée pour la série
                        $imageSeriesUrl = $membersManager->getImageSeriesUrl($seriesId);
                        $imageSeriesUrlShort = substr($imageSeriesUrl, 2);
                        $DirUrlShort = substr(__DIR__, 0, -14);
                        $imageUrl = $DirUrlShort.$imageSeriesUrlShort;
                        // On supprime l'image du dossier
                        unlink($imageUrl);
                        // On récupère l'id de l'image associée à la série
                        $imageSeriesId = $membersManager->getImageSeriesId($seriesId);
                        // On peut valider le nouveau fichier et le stocker définitivement
                        $n = 20;
                        $code = bin2hex(random_bytes($n));
                        $covername = $postseriestitle;
                        $covername = str_replace(' ','_',$covername);
                        $newname = $_SESSION['idmember'] . '_' . $code . '_' . basename($_FILES['cover']['name']);
                        move_uploaded_file($_FILES['cover']['tmp_name'], './public/images/' .$newname);
                        $imagealt = $postseriestitle;
                        $imageurl = './public/images/' .$newname;
                        $imagetype = "cover";
                        // On enregistre une image
                        $addImage = $membersManager->addImage($code, $imagetype, $imagealt, $imageurl);
                        // On récupère l'id d'une image sur la base de son url
                        $imageId = $membersManager->getImageId($imageurl);
                        // On enregistre une cover
                        $addCover = $seriesManager->addCover($imageId);
                        // On récupère l'id d'une cover sur la base de l'id_cover
                        $coverId = $seriesManager->getCoverId($imageId);
                        // On modifie la série
                        $updateSeries = $seriesManager->updateSeries($postseriestitle, $postseriessummary, $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription, $seriesId);
                        // On supprime l'ancienne image sur le serveur
                        $deleteImage = $membersManager->deleteImage($imageSeriesId);
                        // On récupère les id des tags d'une série
                        $tagIdSeries = $seriesManager->getIdTagSeries($seriesId);
                        // On supprime les tags d'une série
                            for ($i = 0; $i < count($tagIdSeries); $i++) {
                                $deleteTagSeries = $seriesManager->deleteTagSeries($tagIdSeries[$i], $seriesId);
                            }
                            // On enlève les espaces en début et fin de chaîne
                            $postseriestag = trim($postseriestag);
                            $tagname = explode(",", $postseriestag);
                            for ($i = 0; $i < count($tagname); $i++) {
                                // On vérifie que le tag n'existe pas déjà
                                $getAllTags = $seriesManager->getAllTags();
                                if(!in_array(strtolower($postseriestag), $getAllTags))
                                {
                                    // On enregistre le tag
                                    $newtag[$i] = strtolower($tagname[$i]);
                                    $newtag[$i] = trim($newtag[$i]);
                                    if($newtag[$i] != NULL)
                                    {
                                        $addNewTag = $seriesManager->addTag($newtag[$i]);
                                    }
                                }
                                // On récupère l'id du tag
                                $tagId = $seriesManager->getTagId($newtag[$i]);
                                // On associe le tag à la série
                                $addTagSeries = $seriesManager->addTagSeries($tagId, $seriesId);
                            }
                            header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
                    }else{
                        // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                        $_SESSION['tempAuthorname'] = $postauthorname;
                        $_SESSION['tempAuthordescription'] = $postauthordescription;
                        $_SESSION['tempSeriestitle'] = $postseriestitle;
                        $_SESSION['tempSummary'] = $postseriessummary;
                        $_SESSION['tempRights'] = $postseriesright;
                        $_SESSION['tempTags'] = $postseriestag;
                        $_SESSION['error'] = "Le fichier n'est pas une image !";
                        header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
                    }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempAuthorname'] = $postauthorname;
                    $_SESSION['tempAuthordescription'] = $postauthordescription;
                    $_SESSION['tempSeriestitle'] = $postseriestitle;
                    $_SESSION['tempSummary'] = $postseriessummary;
                    $_SESSION['tempRights'] = $postseriesright;
                    $_SESSION['tempTags'] = $postseriestag;
                    $_SESSION['error'] = "Le fichier est trop volumineux";
                    header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
                }
            }
            // Si l'image de couverture ne change pas
            // On récupère l'id d'une cover sur la base de l'id_cover
            $seriesIdCover = $seriesManager->getSeriesIdCover($seriesId);
            // On modifie la série
            $updateSeries = $seriesManager->updateSeries($postseriestitle, $postseriessummary, $pricing, $publishing, $postseriesright, $seriesIdCover, $postauthorname, $postauthordescription, $seriesId);
            // On récupère les id des tags d'une série
            $tagIdSeries = $seriesManager->getIdTagSeries($seriesId);
            // On supprime les tags d'une série
            for ($i = 0; $i < count($tagIdSeries); $i++)
            {
                $deleteTagSeries = $seriesManager->deleteTagSeries($tagIdSeries[$i], $seriesId);
            }
            // On enlève les espaces en début et fin de chaîne
            $postseriestag = trim($postseriestag);
            $tagname = explode(",", $postseriestag);
            for ($i = 0; $i < count($tagname); $i++)
            {
                // On vérifie que le tag n'existe pas déjà
                $getAllTags = $seriesManager->getAllTags();
                if(!in_array(strtolower($postseriestag), $getAllTags))
                {
                    // On enregistre le tag
                    $newtag[$i] = strtolower($tagname[$i]);
                    $newtag[$i] = trim($newtag[$i]);
                    if($newtag[$i] != NULL)
                    {
                        $addNewTag = $seriesManager->addTag($newtag[$i]);
                    }
                }
                // On récupère l'id du tag
                $tagId = $seriesManager->getTagId($newtag[$i]);
                // On associe le tag à la série
                $addTagSeries = $seriesManager->addTagSeries($tagId, $seriesId);
            }
            header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
        }else{
            // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
            $_SESSION['tempAuthorname'] = $postauthorname;
            $_SESSION['tempAuthordescription'] = $postauthordescription;
            $_SESSION['tempSeriestitle'] = $postseriestitle;
            $_SESSION['tempSummary'] = $postseriessummary;
            $_SESSION['tempRights'] = $postseriesright;
            $_SESSION['tempTags'] = $postseriestag;
            $_SESSION['error'] = "Vous avez déjà créé une série avec le même titre !";
            header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
        }
    }

    public function updateSeriesStatus($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            // On passe le statut de la série en supprimé
            $updateSeriesDeleted = $seriesManager->updateSeriesStatus("deleted", $seriesId);
            header("Location: index.php?action=dashboard&tab=2"); 
        }else{
            require('./src/View/403error.php');
        }
    }

// A compléter avec l'espace d'administration        
    public function deleteSeries($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On supprime définitivement la série
        $deleteSeries = $seriesManager->deleteSeries($seriesId);
        header("Location: "); 
    }

    public function displaySeries($seriesId)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager;
        $seriesId = htmlspecialchars($seriesId);
        // On vérifie que la série existe bien en récupérant les id de toutes les séries publiées
        $getAllIdSeries = $seriesManager->getAllIdSeries();
        if(in_array($seriesId, $getAllIdSeries))
        {
            // On récupère les informations sur la série
            $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
            $seriesSubscription = $seriesManager->getSeriesSubscriptions($seriesId);
            $seriesSubscribers = $seriesManager->getSeriesSubscribers($seriesId);
            // On récupère tous les épisodes de la sérifde
            $episodesPublishedList = $episodesManager->getEpisodesPublishedList($seriesId);
            $nbepisodes_published = count($episodesPublishedList);
            // On récupère des informations sur des séries qui ont des tags en commun
            $tags = explode(', ', $oneSeriesUserData['tags']);
            $nbtags = count($tags);
            $allTagsSeries = [];
            for ($i = 0; $i < $nbtags; $i++)
            {
                $seriesCommonTags[$i] = $seriesManager->getCommonTagsSeries($tags[$i]);
                array_push($allTagsSeries, $seriesCommonTags[$i]);
            }  
            require('./src/View/frontend/displaySeriesView.php');
        }else{
            require('./src/View/404error.php');
        }
    }

    public function addSubscription($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        $addSubscription = $seriesManager->addSeriesSubscription($seriesId, $_SESSION['idmember']);
        $seriesSubscription = $seriesManager->getSeriesSubscriptions($seriesId);
        echo json_encode($seriesSubscription);
    }

    public function removeSubscription($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        $deleteSubscription = $seriesManager->deleteSubscription($seriesId, $_SESSION['idmember']);
        $seriesSubscription = $seriesManager->getSeriesSubscriptions($seriesId);
        echo json_encode($seriesSubscription);
    }

    public function removeSubscriptionLibrary($seriesId)
    {   
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        $deleteSubscription = $seriesManager->deleteSubscription($seriesId, $_SESSION['idmember']);
        header("Location: index.php?action=dashboard");
    }
    
}