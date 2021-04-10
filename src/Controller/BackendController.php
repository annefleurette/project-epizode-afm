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
                                $newname = $code . '_' . basename($_FILES['cover']['name']);
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
                                // On enregistre la nouvelle série
                                $addNewSeries = $seriesManager->addSeries($postseriestitle, $postseriessummary, $getidmember, $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription);
                                // On récupère l'id de la série à partir de son titre, de l'id de l'auteur et de l'id_cover
                                $seriesId = $seriesManager->getSeriesId($coverId);
                                // Enregistrement des tags
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
                                header("Location: index.php?action=updateSeries&id=" .$seriesId);
                            }else{
                                echo "Le fichier n'est pas une image !";
                            }
                        }else{
                            echo "Le fichier est trop volumineux";
                        }
                    }else{
                        echo "Il y a eu un problème dans l'envoi du fichier";
                    }
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
        public function updateSeries($getid)
        {
            $seriesManager = new SeriesManager();
            // On affiche la série
            $getid = htmlspecialchars($getid);
            $oneSeriesUserData = $seriesManager->getOneSeriesData($getid);
            $seriesCover = $seriesManager->getSeriesCover($getid);
            $tagSeries = $seriesManager->getTagSeries($getid);
            $alltags = implode(",", $tagSeries);
            require('./src/View/backend/updateSeriesView.php');
        }
        public function updateSeriesPost($getidmember = 1, $postauthorname = null, $postauthordescription = null, $postseriestitle, $postseriessummary, $postseriesright, $postseriestag, $seriesId)
        {
            $seriesManager = new SeriesManager();
            $membersManager = new MembersManager();
            //if($_SESSION['type'] === "publisher")
            if(true)
            { // Si le créateur est un éditeur
                if(isset($postseriestitle) AND isset($postseriessummary) AND isset($postseriestag) AND isset($postseriesright))
                { // Si l'image de couverture change
                    // Si les données existent
                    $getidmember = htmlspecialchars($getidmember);
                    $postauthorname = htmlspecialchars($postauthorname);
                    $postauthordescription = htmlspecialchars($postauthordescription);
                    $postseriestitle = htmlspecialchars($postseriestitle);
                    $postseriessummary = htmlspecialchars($postseriessummary);
                    $postseriesright = htmlspecialchars($postseriesright);
                    $postseriestag = htmlspecialchars($postseriestag);
                    $pricing = "paying";
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
                                $code = bin2hex(random_bytes($n));
                                $newname = $code . '_' . basename($_FILES['cover']['name']);
                                move_uploaded_file($_FILES['cover']['tmp_name'], './public/images/' .$newname);
                                $imagealt = $postseriestitle;
                                $imageurl = './public/images/' .$newname;
                                $imagetype = "cover";
                                // On récupère l'id de l'image déjà enregistrée pour la série
                                $imageSeriesId = $membersManager->getImageSeriesId($seriesId);
                                // On modifie une image
                                $updateImage = $membersManager->updateImage($code, $imagetype, $imagealt, $imageurl, $imageSeriesId);
                                // On récupère l'id de la cover déjà enregistrée pour la série
                                $coverId = $seriesManager->getCoverId($imageSeriesId);
                                // On modifie une cover
                                $updateCover = $seriesManager->updateCover($imageSeriesId, $coverId);
                                // On modifie la série
                                $updateSeries = $seriesManager->updateSeries($postseriestitle, $postseriessummary, $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription, $seriesId);
                                // Enregistrement des tags
                                $tagname = explode(",", $postseriestag);
                                for ($i = 0; $i < count($tagname); $i++) {
                                    // On vérifie que le tag n'existe pas déjà
                                    $getAllTags = $seriesManager->getAllTags();
                                    if(!in_array(strtolower($postseriestag), $getAllTags))
                                    {
                                        // On crée le tag
                                        $newtag[$i] = strtolower($tagname[$i]);
                                        $addTag = $seriesManager->addTag($newtag[$i]);
                                    }
                                    // On récupère l'id du tag
                                    $tagId = $seriesManager->getTagId($newtag[$i]);
                                    // On modifie le tag associé à la série
                                    $updateTagSeries = $seriesManager->updateTagSeries($tagId, $seriesId);
                                }
                                header("Location: index.php?action=updateSeries&id=" .$seriesId);
                            }else{
                                echo "Le fichier n'est pas une image !";
                            }
                        }else{
                            echo "Le fichier est trop volumineux";
                        }
                    }else{
                        echo "Il y a eu un problème dans l'envoi du fichier";
                    }
                    // Si l'image de couverture ne change pas
                    // On récupère l'id d'une cover sur la base de l'id_cover
                    $seriesIdCover = $seriesManager->getSeriesIdCover($seriesId);
                    // On modifie la série
                     $updateSeries = $seriesManager->updateSeries($postseriestitle, $postseriessummary, $pricing, $publishing, $postseriesright, $seriesIdCover, $postauthorname, $postauthordescription, $seriesId);
                    // Enregistrement des tags
                    $tagname = explode(",", $postseriestag);
                    for ($i = 0; $i < count($tagname); $i++) {
                        // On vérifie que le tag n'existe pas déjà
                        $getAllTags = $seriesManager->getAllTags();
                        if(!in_array(strtolower($postseriestag), $getAllTags))
                        {
                            // On crée le tag
                            $newtag[$i] = strtolower($tagname[$i]);
                            $addTag = $seriesManager->addTag($newtag[$i]);
                        }
                        // On récupère l'id du tag
                        $tagId = $seriesManager->getTagId($newtag[$i]);
                        // On modifie le tag associé à la série
                        $updateTagSeries = $seriesManager->updateTagSeries($tagId, $seriesId);
                    }
                    header("Location: index.php?action=updateSeries&id=" .$seriesId);
                }
            }
        }
        public function writeEpisode()
        {
            require('./src/View/backend/writeEpisodeView.php');
        }

        public function writeEpisodePost($postsave, $postnumber, $posttitle, $postcontent, $postprice)
        {
            $seriesManager = new SeriesManager();
            $episodesManager = new EpisodesManager();
            //On compte le nombre d'épisodes de la série qui ont été publiés
            $nbepisodes = $episodesManager->countEpisodesPublished($idseries);
            $count_episode_published = intval($nbepisodes);
            $count_episode_publishable = $count_episode_published + 1;
            if(isset($postsave))
            { // Si le bouton Enregistrer est choisi
                // Enregistrement de l'épisode dans la base de données
                // Si les données ont bien été saisies
                if(isset($postnumber) AND isset($posttitle) AND isset($postcontent) AND isset($postprice))
                {
                    //Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés
                    $postnumber = htmlspecialchars($postnumber);
                    $posttitle = htmlspecialchars($posttitle);
                    $postprice = htmlspecialchars($postprice);
                    $episode_unitary_published = $episodesManager->getEpisodePublished($postnumber);
                    if (empty($episode_unitary_published))
                    {
                        // On enregistre le nouvel épisode
                        $req_add_episode = $episodeManager->addEpisodeInprogress($postnumber, $posttitle, $postcontent);
                        header('Location: http://www.jeanforteroche.com/admin');
                    }else{
                        echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
                    }
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
                }
            }else{ // Si le bouton Publier est choisi
                // Enregistrement de l'épisode à publier dans la base de données
                // Si les données ont bien été saisies
                if(isset($postnumber) AND isset($posttitle) AND isset($postcontent))
                {
                    // Si le numéro d'épisode n'existe pas déjà parmi les épisodes publiés et si ce numéro est bien le +1 du dernier épisode publié
                    $postnumber = htmlspecialchars($postnumber);
                    $posttitle = htmlspecialchars($posttitle);
                    $episode_unitary_published = $episodeManager->getEpisodePublished($postnumber);
                    $current_episode = intval($postnumber);
                    if(empty($episode_unitary_published) AND ($current_episode == $count_episode_publishable))
                    { // On publie un nouvel épisode
                        $req_add_episode_published = $episodeManager->addEpisodePublished($postnumber, $posttitle, $postcontent);
                        header('Location: http://www.jeanforteroche.com/admin');
                    }else{
                        echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous avez déjà publié ce numéro d\'épisode ou cet épisode n\'est pas le suivant du dernier épisode publié !</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
                    }
                }else{
                    echo '<div><p style="font-family: Lato; color: #122459; text-align: center; margin-top: 54px; margin-bottom: 50px; padding: 0 15px;">Vous n\'avez pas rempli tous les champs</p><p style="font-family: Lato; text-align: center; color: #122459; padding: 0 15px;"><a href="http://www.jeanforteroche.com/write">Recommencer</a></p></div>';
                }
            }
        }
}