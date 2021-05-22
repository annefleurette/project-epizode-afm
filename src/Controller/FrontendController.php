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

class FrontendController {

    public function displaySeries($memberId = 1, $seriesId = 12, $seriesSubscriptionNumber)
	{
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager;
        $memberId = htmlspecialchars($memberId);
        $seriesId = htmlspecialchars($seriesId);
        $seriesSubscriptionNumber = htmlspecialchars($seriesSubscriptionNumber);
        // On récupère les informations sur la série
        $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
        // On gère les abonnements
         if(intval($seriesSubscriptionNumber) === 1)
         {
             // On ajoute un abonnement à une série
             $seriesSubscription = $seriesManager->addSeriesSubscription($seriesId, $memberId);
         }elseif(intval($seriesSubscriptionNumber) === -1) 
         {
             // On supprime un abonnement à une série
             $deleteSubscription = $seriesManager->deleteSubscription($seriesId, $memberId);
         }
        // On récupère tous les épisodes de la série
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
	}
    public function displayEpisode($memberId, $seriesId, $episodeNumber, $episodeId, $episodeLikesNumber)
    {
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager();
        $commentsManager = new CommentsManager();
        $memberId = htmlspecialchars($memberId);
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        $episodeLikesNumber = htmlspecialchars($episodeLikesNumber);
        // On affiche les informations de la série
        $oneSeriesUserData = $seriesManager->getOneSeriesData($seriesId);
        // On gère les likes
        if(intval($episodeLikesNumber) === 1)
        {
            // On ajoute un like à un épisode
            $episodeLike = $episodesManager->addEpisodeLike($episodeId, $memberId);
        }elseif(intval($episodeLikesNumber) === -1) 
        {
            // On supprime un like à un épisode
            $deleteLike = $episodesManager->deleteLike($episodeId, $memberId);
        }
        // On récupère les informations de l'épisode
        $episode_unitary_published = $episodesManager->getEpisodePublished($episodeNumber, $seriesId);
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
    }
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
    public function alertEpisodePost($memberId, $seriesId, $episodeNumber, $episodeId, $episodeLikesNumber)
    {
        $episodesManager = new EpisodesManager;
        $memberId = htmlspecialchars($memberId);
        $seriesId = htmlspecialchars($seriesId);
        $episodeNumber = htmlspecialchars($episodeNumber);
        $episodeId = htmlspecialchars($episodeId);
        $episodeLikesNumber = htmlspecialchars($episodeLikesNumber);
        // On signale un épisode
        $alert = 1;
        $updateAlertEpisode = $episodesManager->updateEpisodeAlert($alert, $episodeId);
        header("Location: index.php?action=displayEpisode&idmember=" .$memberId . "&idseries=" .$seriesId. "&number=" .$episodeNumber. "&idepisode=" .$episodeId. "&like=" .$episodeLikesNumber);
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
}