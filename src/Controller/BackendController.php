<?php
namespace AnneFleurMarchat\Epizode\Controller;

require_once('src/Model/SeriesManager.php');
require_once('src/Model/EpisodesManager.php');
require_once('src/Model/CommentsManager.php');
require_once('src/Model/MembersManager.php');

use AnneFleurMarchat\Epizode\Model\SeriesManager;
use AnneFleurMarchat\Epizode\Model\EpisodesManager;
use AnneFleurMarchat\Epizode\Model\CommentsManager;
use AnneFleurMarchat\Epizode\Model\MembersManager;

class BackendController {

        public function writeSeries()
        {
            require('./src/View/backend/writeSeriesView.php');
        }
        
        public function writeSeriesPost($getidmember = 1, $postauthorname = null, $postauthordescription = null, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag)
        {
            $seriesManager = new SeriesManager();
            $membersManager = new MembersManager();
            //if($_SESSION['type'] === "publisher")
            if(true)
            { // Si le créateur est un éditeur
                if(isset($postseriestitle) AND isset($postseriessummary) AND isset($postseriestag) AND isset($postseriesright))
                { // Si les données existent
                    $getidmember = htmlspecialchars($getidmember);
                    $postauthorname = htmlspecialchars($postauthorname);
                    $postauthordescription = htmlspecialchars($postauthordescription);
                    $postseriestitle = htmlspecialchars($postseriestitle);
                    $postseriessummary = htmlspecialchars($postseriessummary);
                    $postseriesright = htmlspecialchars($postseriesright);
                    $postseriestag = htmlspecialchars($postseriestag);
                    $pricing = "paying";
                    $publishing = "inprogress";
                    // Testons si le titre est bien unique pour l'utilisateur
                    $getAllTitles = $seriesManager->getAllTitles($getidmember);
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
                                    $newname = $getidmember . '_' . $code . '_' . basename($_FILES['cover']['name']);
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
                        $addNewSeries = $seriesManager->addSeries($postseriestitle, $postseriessummary, intval($getidmember), $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription);
                        // On récupère l'id de la série à partir de son titre, de l'id de l'auteur et de l'id_cover
                        $seriesId = $seriesManager->getSeriesId($getidmember, $postseriestitle);
                        // Enregistrement des tags
                        $tagname = explode(",", $postseriestag);
                        for ($i = 0; $i < count($tagname); $i++)
                        {
                            // On vérifie que le tag n'existe pas déjà
                            $getAllTags = $seriesManager->getAllTags();
                            if(!in_array(strtolower($postseriestag), $getAllTags))
                            {
                                // On enregistre le tag
                                $newtag[$i] = strtolower($tagname[$i]);
                                $addNewTag = $seriesManager->addTag($newtag[$i]);
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
                }else{
                    $_SESSION['error'] = "Vous n'avez pas saisi toutes les données";
                    header("Location: index.php?action=writeSeries");
                }
            }
            /*if($_SESSION['type'] === "user")
            { // Si le créateur est un utilisateur
                if(isset($postseriestitle) AND isset($$postseriessummary) AND isset($postseriescover) AND isset($postseriestag) AND isset($postseriesright))
                { // Si les données existent
                    $getidmember = htmlspecialchars($getidmember);
                    $postauthorname = null;
                    $postauthordescription = null;
                    $postseriestitle = htmlspecialchars($postseriestitle);
                    $postseriessummary = htmlspecialchars($postseriessummary);
                    $postseriestag = htmlspecialchars($postseriestag);
                    $postseriesright = htmlspecialchars($postseriesright);
                    $pricing = "free";
                    $publishing = "inprogress";
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
                                $newname = bin2hex(random_bytes($n));
                                move_uploaded_file($_FILES['cover']['tmp_name'], '../../public/images/' . basename($_FILES['cover'][$newname]));
                                $imagealt = $postseriestitle;
                                $imageurl = '../../public/images/' . basename($_FILES['cover'][$newname]);
                                $imagetype = "cover";
                            }else{
                                echo "Le fichier n'est pas une image !";
                            }
                        }else{
                            echo "Le fichier est trop volumineux";
                        }
                    }else{
                        echo "Il y a eu un problème dans l'envoi du fichier";
                    }
                    // On enregistre une image
                    $addImage = $membersManager->addImage($newname, $imagetype, $imagealt, $imageurl);
                    // On récupère l'id d'une image sur la base de son url
                    $imageId = $membersManager->getImageId($imageurl);
                    // On enregistre une cover
                    $addCover = $seriesManager->addCover($imageId);
                    // On récupère l'id d'une cover sur la base de l'id de l'image
                    $coverId = $seriesManager->getCoverId($imageId);
                    // On enregistre la nouvelle série
                    $addSeries = $seriesManager->addSeries($postseriestitle, $postseriessummary, $getidmember, $pricing, $publishing, $postseriesrights, $coverId, $postauthorname, $postauthordescription);
                    // On récupère l'id de la série à partir de son titre et de l'id de l'auteur
                    $seriesId = $seriesManager->getSeriesId($postseriestitle, $getidmember);
                    // Enregsitrement des tags
                    $tagname = explode(",", $postseriestag);
                    for ($i = 1; $i < count($tagname); $i++) {
                        // On enregistre le tag
                        $addTag = $seriesManager->addTag($tagname[$i]);
                        // On récupère l'id du tag
                        $tagId = $seriesManager->getTagId($tagname[$i]);
                        // On associe le tag à la série
                        $addTagSeries = $seriesManager->addTagSeries($tagId, $seriesId);
                     }
                     header('Location: src/View/writeSeriesView.php');
                }
            }*/
        }
        public function updateSeries($seriesId)
        {
            $seriesManager = new SeriesManager();
            $episodesManager = new EpisodesManager();
            $seriesId = htmlspecialchars($seriesId);
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
        }
        public function updateSeriesPost($getidmember = 1, $postauthorname = null, $postauthordescription = null, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag, $seriesId)
        {
            //var_dump($_POST);
            //exit;
            $seriesManager = new SeriesManager();
            $membersManager = new MembersManager();
            //if($_SESSION['type'] === "publisher")
            if(true)
            { // Si le créateur est un éditeur
                if(isset($postseriestitle) AND isset($postseriessummary) AND isset($postseriestag) AND isset($postseriesright))
                {
                    // Si les données existent
                    $getidmember = htmlspecialchars($getidmember);
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
                    $getAllTitles = $seriesManager->getAllTitles($getidmember);
                    // On récupère le titre actuel
                    $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
                    // On l'envlève de $getAllTitles
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
                                    $newname = $getidmember . '_' . $code . '_' . basename($_FILES['cover']['name']);
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
                                    $tagname = explode(",", $postseriestag);
                                    for ($i = 0; $i < count($tagname); $i++) {
                                        // On vérifie que le tag n'existe pas déjà
                                        $getAllTags = $seriesManager->getAllTags();
                                        if(!in_array(strtolower($postseriestag), $getAllTags))
                                        {
                                            // On enregistre le tag
                                            $newtag[$i] = strtolower($tagname[$i]);
                                            $addNewTag = $seriesManager->addTag($newtag[$i]);
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
                        for ($i = 0; $i < count($tagIdSeries); $i++) {
                            $deleteTagSeries = $seriesManager->deleteTagSeries($tagIdSeries[$i], $seriesId);
                        }
                        $tagname = explode(",", $postseriestag);
                        for ($i = 0; $i < count($tagname); $i++) {
                            // On vérifie que le tag n'existe pas déjà
                            $getAllTags = $seriesManager->getAllTags();
                            if(!in_array(strtolower($postseriestag), $getAllTags))
                            {
                                // On enregistre le tag
                                $newtag[$i] = strtolower($tagname[$i]);
                                $addNewTag = $seriesManager->addTag($newtag[$i]);
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
            }
        }
// A compléter avec l'espace d'administration  
        public function updateSeriesDeleted($seriesId)
        {
            $seriesManager = new SeriesManager();
            $seriesId = htmlspecialchars($seriesId);
            // On passe le statut de la série en supprimé
            $updateSeriesDeleted = $seriesManager->updateSeriesDeleted("deleted", $seriesId);
            header("Location: "); 
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
        public function writeEpisode($seriesId)
        {
            // regarder dans la bdd s'il existe
            $seriesId = htmlspecialchars($seriesId);
            require('./src/View/backend/writeEpisodeView.php');
//Redirection vers créer une série
        }
        public function writeEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice, $postpromotion, $postdate, $postsigns, $seriesId)
        {
            $episodesManager = new EpisodesManager();
            //On compte le nombre d'épisodes de la série qui ont été publiés
            $nbepisodes = $episodesManager->countEpisodesPublished($seriesId);
            $count_episode_published = intval($nbepisodes);
            $count_episode_publishable = $count_episode_published + 1;
            if(isset($postsave))
            { // Si le bouton Enregistrer est choisi
                // Enregistrement de l'épisode dans la base de données
                // Si les données ont bien été saisies
                if(isset($postnumber) AND isset($posttitle) AND isset($postcontent) AND isset($postprice))
                {
                    $postnumber = htmlspecialchars($postnumber);
                    $posttitle = htmlspecialchars($posttitle);
                    $postprice = htmlspecialchars($postprice);
                    $postpromotion = htmlspecialchars($postpromotion);
                    $postsigns = htmlspecialchars($postsigns);
                    $seriesId = htmlspecialchars($seriesId);
                    //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                    $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber, $seriesId);
                    if (empty($episode_unitary_published))
                    {
                        // On enregistre le nouvel épisode
                        var_dump($postnumber);
                        var_dump($posttitle);
                        var_dump($postcontent);
                        var_dump($seriesId);
                        var_dump($postprice);
                        var_dump($postpromotion);
                        var_dump($postsigns);
                        $addEpisode = $episodesManager->addEpisode($postnumber, $posttitle, $postcontent, "inprogress", null, $seriesId, $postprice, $postpromotion, $postsigns);
                        header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
                    }else{
                        // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                        $_SESSION['tempNumber'] = $postnumber;
                        $_SESSION['tempTitle'] = $posttitle;
                        $_SESSION['tempContent'] = $postcontent;
                        $_SESSION['tempPrice'] = $postprice;
                        $_SESSION['tempPromotion'] = $postpromotion;
                        $_SESSION['error'] = "Vous avez déjà publié ce numéro d'épisode ou cet épisode n'est pas le suivant du dernier épisode publié ! Le dernier épisode de la série publié est le numéro " . $count_episode_published;
                        header("Location: index.php?action=writeEpisode&idseries=" .$seriesId);
                    }
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Vous n'avez pas rempli tous les champs";
                    header("Location: index.php?action=writeEpisode&idseries=" .$seriesId);
                }
            }else{ // Si le bouton Publier est choisi
                // Enregistrement de l'épisode à publier dans la base de données
                // Si les données ont bien été saisies
                if(isset($postnumber) AND isset($posttitle) AND isset($postcontent) AND isset($postprice) AND isset($postdate) AND preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])$/", $postdate))
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
                        // Si la date de l'épisode à publier est bien postérieure au dernier épisode publié
                        $episode_unitary_published = $episodesManager->getEpisodePublished($count_episode_published, $seriesId);
                        if(strtotime($postdate) > strtotime($episode_unitary_published['date']))
                        {
                            $addEpisode = $episodesManager->addEpisode($postnumber, $posttitle, $postcontent, "published", $postdate, $seriesId, $postprice, $postpromotion, $postsigns);
                            header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
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
                    $_SESSION['error'] = "Vous n'avez pas rempli tous les champs";
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
            // On affiche les informations de la série
            $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
            // On affiche les informations de l'épisode
            $oneEpisodesUser = $episodesManager->getEpisodeId($episodeId);
            require('./src/View/backend/lookEpisodeView.php');
        }
        public function updateEpisode($seriesId, $episodeId)
        {
            $episodesManager = new EpisodesManager();
            $seriesId = htmlspecialchars($seriesId);
            $episodeId = htmlspecialchars($episodeId);
            // On affiche l'épisode
            $oneEpisode = $episodesManager->getEpisodeId($episodeId);
            require('./src/View/backend/updateEpisodeView.php');
        }
        public function updateEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice, $postpromotion, $postdate, $postsigns, $seriesId, $episodeId)
        {
            $episodesManager = new EpisodesManager();
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
                if(isset($postnumber) AND isset($posttitle) AND isset($postcontent) AND isset($postprice))
                {
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
                        // On modifie l'épisode
                        $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "inprogress", null, $postprice, $postpromotion, $postsigns, $episodeId);
                        header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
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
                    // On prépare des variables de session temporaires pour anticiper les erreurs et éviter à l'utilisateur de resaisir toutes ses données
                    $_SESSION['tempNumber'] = $postnumber;
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Vous n'avez pas rempli tous les champs";
                    header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
                }
            }else{ // Si le bouton Publier est choisi
                // Modification de l'épisode à publier dans la base de données
                // Si les données ont bien été saisies
                if(isset($posttitle) AND isset($postcontent) AND isset($postprice))
                {
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
                        if (empty($episode_unitary_published) AND ($current_episode === $count_episode_publishable))
                        {
                            if(isset($postdate) AND preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])$/", $postdate))
                            {
                                $postdate = htmlspecialchars($postdate);
                                // On modifie l'épisode
                                $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "published", $postdate, $postprice, $postpromotion, $postsigns, $episodeId);
                            }else{
                                // On modifie l'épisode
                                $updateEpisode = $episodesManager->updateEpisode($postnumber, $posttitle, $postcontent, "published", $oneEpisode['date'], $postprice, $postpromotion, $postsigns, $episodeId);  
                            }
                            header("Location: index.php?action=updateSeries&idseries=" .$seriesId); 
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
                        if(isset($postdate) AND preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])T([0-1][0-9]|2[0-3]):([0-5][0-9])$/", $postdate))
                        {
                            $postdate = htmlspecialchars($postdate);
                            // On modifie l'épisode
                            $updateEpisode = $episodesManager->updateEpisode($oneEpisode['number'], $posttitle, $postcontent, "published", $postdate, $postprice, $postpromotion, $postsigns, $episodeId);
                        }else{
                            // On modifie l'épisode
                            $updateEpisode = $episodesManager->updateEpisode($oneEpisode['number'], $posttitle, $postcontent, "published", $oneEpisode['date'], $postprice, $postpromotion, $postsigns, $episodeId);   
                        }
                        header("Location: index.php?action=updateSeries&idseries=" .$seriesId);
                    }   
                }else{
                    // On prépare des variables de session temporaires pour anticiper les erreurs
                    if(isset($postnumber))
                    {
                        $_SESSION['tempNumber'] = $postnumber;
                    }
                    $_SESSION['tempTitle'] = $posttitle;
                    $_SESSION['tempContent'] = $postcontent;
                    $_SESSION['tempPrice'] = $postprice;
                    $_SESSION['tempPromotion'] = $postpromotion;
                    $_SESSION['error'] = "Vous n'avez pas rempli tous les champs";
                    header("Location: index.php?action=updateEpisode&idseries=" .$seriesId . "&idepisode=" .$episodeId);
                }
            }
        }
        public function updateEpisodeDeleted($seriesId, $episodeId)
        {
            $episodesManager = new EpisodesManager();
            $seriesId = htmlspecialchars($seriesId);
            $episodeId = htmlspecialchars($episodeId);
            // On passe le statut de l'épisode en supprimé
            $updateEpisodeDeleted = $episodesManager->updateEpisodeDeleted("deleted", $episodeId);
            header("Location: index.php?action=updateSeries&idseries=" .$seriesId . "&idepisode=" .$episodeId); 
        }
// A compléter avec l'espace d'administration        
        public function deleteEpisode($seriesId, $episodeId)
        {
            $episodesManager = new EpisodesManager();
            $seriesId = htmlspecialchars($seriesId);
            $episodeId = htmlspecialchars($episodeId);
            // On supprime définitivement l'épisode
            $deleteEpisode = $episodesManager->deleteEpisode($episodeId);
            header("Location: "); 
        }

}