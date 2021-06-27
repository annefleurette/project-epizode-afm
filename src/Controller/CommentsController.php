<?php
namespace AnneFleurMarchat\Epizode\Controller;

require_once('src/Model/SeriesManager.php');
require_once('src/Model/EpisodesManager.php');
require_once('src/Model/CommentsManager.php');
require_once('src/Model/MembersManager.php');

use AnneFleurMarchat\Epizode\Model\CommentsManager;

class CommentsController {

    public function writeCommentPost($seriesId, $episodeNumber, $episodeId, $episodeLikesNumber, $postcomment)
    {
        $commentsManager = new CommentsManager();
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        $episodeLikesNumber = htmlspecialchars($episodeLikesNumber);
        $postcomment = htmlspecialchars($postcomment);
        $addComment = $commentsManager->addComment($_SESSION['idmember'], $episodeId, $postcomment);
        header("Location: index.php?action=displayEpisode&idseries=" .$seriesId. "&number=" .$episodeNumber. "&idepisode=" .$episodeId. "&like=" .$episodeLikesNumber);
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

    public function alertCommentPost($seriesId, $episodeNumber, $episodeId, $episodeLikesNumber, $commentId)
    {
        $commentsManager = new CommentsManager;
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        $episodeLikesNumber = htmlspecialchars($episodeLikesNumber);
        $commentId = htmlspecialchars($commentId);
        // On signale un commentaire
        $alert = 1;
        $updateAlertComment = $commentsManager->updateCommentAlert($alert, $commentId);
        header("Location: index.php?action=displayEpisode&idseries=" .$seriesId. "&number=" .$episodeNumber. "&idepisode=" .$episodeId. "&like=" .$episodeLikesNumber);
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