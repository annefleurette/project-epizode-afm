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

        public function writeSeriesPost($getidmember = 1, $postauthorname = null, $postauthordescription = null, $postseriestitle, $postseriessummary, $postseriestag, $postseriesright)
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
                    $postseriestag = htmlspecialchars($postseriestag);
                    $postseriesright = htmlspecialchars($postseriesright);
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
                                // On récupère l'id d'une cover sur la base de l'id de l'image
                                $coverId = $seriesManager->getCoverId($imageId);
                                var_dump($postseriestitle);
                                var_dump($postseriessummary);
                                var_dump($getidmember);
                                var_dump($pricing);
                                var_dump($publishing);
                                var_dump($postseriesright);
                                var_dump($coverId);
                                var_dump($postauthorname);
                                var_dump($postauthordescription);
                                // On enregistre la nouvelle série
                                $addNewSeries = $seriesManager->addSeries($postseriestitle, $postseriessummary, $getidmember, $pricing, $publishing, $postseriesright, $coverId, $postauthorname, $postauthordescription);
                                // On récupère l'id de la série à partir de son titre et de l'id de l'auteur
                                $seriesId = $seriesManager->getSeriesId($postseriestitle, $getidmember);
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
}