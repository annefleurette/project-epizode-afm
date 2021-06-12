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

class CommentsController {

    public function writeCommentPost($memberId, $seriesId, $episodeNumber, $episodeId, $episodeLikesNumber, $postcomment)
    {
        $commentsManager = new CommentsManager();
        $memberId = htmlspecialchars($memberId);
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        $episodeLikesNumber = htmlspecialchars($episodeLikesNumber);
        //if(isset($sessionpseudo)) Si l'utilisateur est bien connecté
        if(true) {
            // Si le commentaire a bien été saisi
            if (isset($postcomment))
            {
                $postcomment = htmlspecialchars($postcomment);
                $addComment = $commentsManager->addComment($memberId, $episodeId, $postcomment);
                header("Location: index.php?action=displayEpisode&idmember=" .$memberId . "&idseries=" .$seriesId. "&number=" .$episodeNumber. "&idepisode=" .$episodeId. "&like=" .$episodeLikesNumber);
            }else{
                $_SESSION['error'] = "Vous n'avez pas saisi votre commentaire";
                header("Location: index.php?action=displayEpisode&idmember=" .$memberId . "&idseries=" .$seriesId. "&number=" .$episodeNumber. "&idepisode=" .$episodeId. "&like=" .$episodeLikesNumber);
            }
        }else{
            header('Location: index.php?action=login');
        }
    }

// A compléter avec l'espace d'administration
    public function deleteComment($commentId)
    {
        $commentsManager = new CommentsManager();
        // On supprime le commentaire
        $commentId = htmlspecialchars($commentId);
        $deleteComment = $commentsManager->deleteComment($commentId);
        header("Location: ");
    }

    public function alertCommentPost($memberId, $seriesId, $episodeNumber, $episodeId, $episodeLikesNumber, $commentId)
    {
        $commentsManager = new CommentsManager;
        $memberId = htmlspecialchars($memberId);
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        $episodeLikesNumber = htmlspecialchars($episodeLikesNumber);
        $commentId = htmlspecialchars($commentId);
        // On signale un commentaire
        $alert = 1;
        $updateAlertComment = $commentsManager->updateCommentAlert($alert, $commentId);
        header("Location: index.php?action=displayEpisode&idmember=" .$memberId . "&idseries=" .$seriesId. "&number=" .$episodeNumber. "&idepisode=" .$episodeId. "&like=" .$episodeLikesNumber);
    }

    // A compléter avec l'espace d'administration
    public function removeAlertCommentPost($commentId)
    {
        $commentsManager = new CommentsManager;
        $commentId = htmlspecialchars($commentId);
        // On enlève le signalement d'un commentaire
        $alert = 0;
        $updateAlertComment = $commentsManager->updateCommentAlert($alert, $commentId);
        header("Location: ");
    }
}