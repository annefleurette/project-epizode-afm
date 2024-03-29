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
        // On en garde 6 composées de 3 éditeurs et 3 amateurs
        $seriesLastSix = array_merge($seriesLastThreePublishers, $seriesLastThreeUsers);
        // On affiche les top 5 en termes de séries éditeurs & amateurs
        $seriesTopFivePublishers = $seriesManager->topFiveSeriesPublishers();
        $seriesTopFiveUsers = $seriesManager->topFiveSeriesUsers();
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
    
    public function writeSeriesPost($postauthorname, $postauthordescription, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag, $postmeta)
    {
        $seriesManager = new SeriesManager();
        $membersManager = new MembersManager();
        $postauthorname = htmlspecialchars($postauthorname);
        $postauthordescription = htmlspecialchars($postauthordescription);
        $postseriestitle = htmlspecialchars($postseriestitle);
        $postseriessummary = htmlspecialchars($postseriessummary);
        $postseriesright = htmlspecialchars($postseriesright);
        $postseriestag = htmlspecialchars($postseriestag);
        $postmeta = htmlspecialchars($postmeta);
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
                    }else{
                        // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                        $_SESSION['tempAuthorname'] = $postauthorname;
                        $_SESSION['tempAuthordescription'] = $postauthordescription;
                        $_SESSION['tempSeriestitle'] = $postseriestitle;
                        $_SESSION['tempSummary'] = $postseriessummary;
                        $_SESSION['tempRights'] = $postseriesright;
                        $_SESSION['tempTags'] = $postseriestag;
                        $_SESSION['tempMetaSeries'] = $postmeta;
                        $_SESSION['error'] = "Le fichier n'est pas une image";
                        header("Location: writeSeries");
                    }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempAuthorname'] = $postauthorname;
                    $_SESSION['tempAuthordescription'] = $postauthordescription;
                    $_SESSION['tempSeriestitle'] = $postseriestitle;
                    $_SESSION['tempSummary'] = $postseriessummary;
                    $_SESSION['tempRights'] = $postseriesright;
                    $_SESSION['tempTags'] = $postseriestag;
                    $_SESSION['tempMetaSeries'] = $postmeta;
                    $_SESSION['error'] = "Le fichier est trop volumineux";
                    header("Location: writeSeries");
                }
            }else{
                $coverId = 253; // Affiche par défaut
            }
            // On enregistre la nouvelle série
            $addNewSeries = $seriesManager->addSeries($postseriestitle, $postseriessummary, intval($_SESSION['idmember']), $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription, $postmeta);
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
            header("Location: updateSeries/" .$seriesId);
        }else{
            // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
            $_SESSION['tempAuthorname'] = $postauthorname;
            $_SESSION['tempAuthordescription'] = $postauthordescription;
            $_SESSION['tempSeriestitle'] = $postseriestitle;
            $_SESSION['tempSummary'] = $postseriessummary;
            $_SESSION['tempRights'] = $postseriesright;
            $_SESSION['tempTags'] = $postseriestag;
            $_SESSION['tempMetaSeries'] = $postmeta;
            $_SESSION['error'] = "Vous avez déjà créé une série avec le même titre !";
            header("Location: writeSeries");
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

    public function updateSeriesPost($postauthorname, $postauthordescription, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag, $postmeta, $seriesId)
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
        $postmeta = htmlspecialchars($postmeta);
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
                        $imageSeriesUrl = $seriesManager->getImageSeriesUrl($seriesId);
                        // On évite de supprimer l'image par défaut
                        if($imageSeriesUrl != "./public/images/cover_default.png")
                        {
                            $imageSeriesUrlShort = substr($imageSeriesUrl, 2);
                            $DirUrlShort = substr(__DIR__, 0, -14);
                            $imageUrl = $DirUrlShort.$imageSeriesUrlShort;
                            // On supprime l'image du dossier
                            unlink($imageUrl);
                        }
                        // On récupère l'id de l'image associée à la série
                        $imageSeriesId = $seriesManager->getImageSeriesId($seriesId);
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
                        $updateSeries = $seriesManager->updateSeries($postseriestitle, $postseriessummary, $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription, $postmeta, $seriesId);
                        // On évite de supprimer l'image par défaut
                        if($imageSeriesUrl != "./public/images/cover_default.png")
                        {
                            // On supprime l'ancienne image sur le serveur
                            $deleteImage = $membersManager->deleteImage($imageSeriesId);
                        }
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
                            header("Location: updateSeries/" .$seriesId);
                    }else{
                        // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                        $_SESSION['tempAuthorname'] = $postauthorname;
                        $_SESSION['tempAuthordescription'] = $postauthordescription;
                        $_SESSION['tempSeriestitle'] = $postseriestitle;
                        $_SESSION['tempSummary'] = $postseriessummary;
                        $_SESSION['tempRights'] = $postseriesright;
                        $_SESSION['tempTags'] = $postseriestag;
                        $_SESSION['tempMetaSeries'] = $postmeta;
                        $_SESSION['error'] = "Le fichier n'est pas une image !";
                        header("Location: updateSeries/" .$seriesId);
                    }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempAuthorname'] = $postauthorname;
                    $_SESSION['tempAuthordescription'] = $postauthordescription;
                    $_SESSION['tempSeriestitle'] = $postseriestitle;
                    $_SESSION['tempSummary'] = $postseriessummary;
                    $_SESSION['tempRights'] = $postseriesright;
                    $_SESSION['tempTags'] = $postseriestag;
                    $_SESSION['tempMetaSeries'] = $postmeta;
                    $_SESSION['error'] = "Le fichier est trop volumineux";
                    header("Location: updateSeries/" .$seriesId);
                }
            }
            // Si l'image de couverture ne change pas
            // On récupère l'id d'une cover sur la base de l'id_cover
            $seriesIdCover = $seriesManager->getSeriesIdCover($seriesId);
            // On modifie la série
            $updateSeries = $seriesManager->updateSeries($postseriestitle, $postseriessummary, $pricing, $publishing, $postseriesright, $seriesIdCover, $postauthorname, $postauthordescription, $postmeta, $seriesId);
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
            header("Location: updateSeries/" .$seriesId);
        }else{
            // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
            $_SESSION['tempAuthorname'] = $postauthorname;
            $_SESSION['tempAuthordescription'] = $postauthordescription;
            $_SESSION['tempSeriestitle'] = $postseriestitle;
            $_SESSION['tempSummary'] = $postseriessummary;
            $_SESSION['tempRights'] = $postseriesright;
            $_SESSION['tempTags'] = $postseriestag;
            $_SESSION['tempMetaSeries'] = $postmeta;
            $_SESSION['error'] = "Vous avez déjà créé une série avec le même titre !";
            header("Location: updateSeries/" .$seriesId);
        }
    }

    public function userDeleteSeries($seriesId)
    {
        $seriesManager = new SeriesManager();
        $membersManager = new MembersManager();
        $seriesId = htmlspecialchars($seriesId);
        // On vérifie que la série est bien une série créée par le membre
        $getAllSeriesId = $seriesManager->getAllSeriesId($_SESSION['idmember']);
        if (in_array($seriesId, $getAllSeriesId)) {
            // On récupère l'URL de l'image déjà enregistrée pour la série
            $imageSeriesUrl = $seriesManager->getImageSeriesUrl($seriesId);
            // On évite de supprimer l'image par défaut
            if($imageSeriesUrl != "./public/images/poster_default.png")
            {
                $imageSeriesUrlShort = substr($imageSeriesUrl, 2);
                $DirUrlShort = substr(__DIR__, 0, -14);
                $imageUrl = $DirUrlShort.$imageSeriesUrlShort;
                // On supprime l'image du dossier
                unlink($imageUrl);
                // On récupère l'id de l'image associée à la série
                $imageSeriesId = $seriesManager->getImageSeriesId($seriesId);
                // On supprime l'ancienne image sur le serveur
                $deleteImage = $membersManager->deleteImage($imageSeriesId);
                }
            // On supprime définitivement la série
            $deleteSeries = $seriesManager->deleteSeries($seriesId);
            header("Location: dashboard/2");   
        }else{
            require('./src/View/403error.php');
        }
    }
      
    public function adminDeleteSeries($seriesId)
    {
        $seriesManager = new SeriesManager();
        $membersManager = new MembersManager();
        $seriesId = htmlspecialchars($seriesId);
        // On récupère l'URL de l'image déjà enregistrée pour la série
        $imageSeriesUrl = $seriesManager->getImageSeriesUrl($seriesId);
        // On évite de supprimer l'image par défaut
        if($imageSeriesUrl != "./public/images/cover_default.png")
        {
            $imageSeriesUrlShort = substr($imageSeriesUrl, 2);
            $DirUrlShort = substr(__DIR__, 0, -14);
            $imageUrl = $DirUrlShort.$imageSeriesUrlShort;
            // On supprime l'image du dossier
            unlink($imageUrl);
            // On récupère l'id de l'image associée à la série
            $imageSeriesId = $seriesManager->getImageSeriesId($seriesId);
            // On supprime l'ancienne image sur le serveur
            $deleteImage = $membersManager->deleteImage($imageSeriesId);
        }
        // On supprime définitivement la série
        $deleteSeries = $seriesManager->deleteSeries($seriesId);
        header("admin/2"); 
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
            $oneSeriesPublicData = $seriesManager->getOneSeriesPublicData($seriesId);
            // On vérifie que la série est bien publiée donc publique
            if($oneSeriesPublicData['publishing'] == "published")
            {
                $seriesSubscription = $seriesManager->getSeriesSubscriptions($seriesId);
                $seriesSubscribers = $seriesManager->getSeriesSubscribers($seriesId);
                // On récupère tous les épisodes de la sérifde
                $episodesPublishedList = $episodesManager->getEpisodesPublishedList($seriesId);
                $nbepisodes_published = count($episodesPublishedList);
                // On récupère des informations sur des séries qui ont des tags en commun
                $tags = explode(', ', $oneSeriesPublicData['tags']);
                $nbtags = count($tags);
                $allTagsSeries = [];
                for ($i = 0; $i < $nbtags; $i++)
                {
                    $seriesCommonTags = $seriesManager->getCommonTagsSeries($tags[$i]);
                    array_push($allTagsSeries, $seriesCommonTags);
                }  
                require('./src/View/frontend/displaySeriesView.php');
            }else{
                require('./src/View/403error.php');
            }
        }else{
            require('./src/View/404error.php');
        }
    }

    public function addSubscription($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On ajoute une série à sa bibliothèque
        $addSubscription = $seriesManager->addSeriesSubscription($seriesId, $_SESSION['idmember'], 1);
        $seriesSubscription = $seriesManager->getSeriesSubscriptions($seriesId);
        echo json_encode($seriesSubscription);
    }

    public function removeSubscription($seriesId)
    {
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On retire une série à sa bibliothèque depuis la page série
        $deleteSubscription = $seriesManager->deleteSubscription($seriesId, $_SESSION['idmember']);
        $seriesSubscription = $seriesManager->getSeriesSubscriptions($seriesId);
        echo json_encode($seriesSubscription);
    }

    public function removeSubscriptionLibrary($seriesId)
    {   
        $seriesManager = new SeriesManager();
        $seriesId = htmlspecialchars($seriesId);
        // On retire une série à sa bibliothèque depuis son tableau de bord
        $deleteSubscription = $seriesManager->deleteSubscription($seriesId, $_SESSION['idmember']);
        header("Location: dashboard");
    }
    
}