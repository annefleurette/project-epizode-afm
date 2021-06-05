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

    public function subscription()
	{
		require('./src/View/frontend/subscriptionView.php');
	}
    public function subscriptionPost($postpseudo, $postemail, $postpassword, $postpassword2)
	{
		$membersManager = new MembersManager();
		if (isset($postpseudo) AND isset($postemail) AND isset($postpassword) AND isset($postpassword2))
		{
			// On récupère tous les pseudos et emails des membres inscrits
			$getPseudos = $membersManager->getMembersPseudo();
            $getEmails = $membersManager->getMembersEmail();
			$postemail = htmlspecialchars($postemail);
			$postpseudo = htmlspecialchars($postpseudo);
			$postpassword = htmlspecialchars($postpassword);
			$postpassword2 = htmlspecialchars($postpassword2);
			// Si le pseudo est bien nouveau
			if(!in_array(strtolower($postpseudo), $getPseudos) AND !in_array(strtolower($postemail), $getEmails))
			{
			// Si l'adresse email possède bien le bon format
				if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#", $postemail))
				{
				//Si le mot de passe correspond bien à sa vérification
					if($postpassword == $postpassword2) {
					$pass_hache = password_hash($postpassword, PASSWORD_DEFAULT);
                    // On ajoute un membre
                    $type = "user";
                    $postpseudo = strtolower($postpseudo);
                    $postemail = strtolower($postemail);
					$addMember = $membersManager->addMember($postpseudo, $postemail, $pass_hache, $type);
                    $_SESSION['validation'] = "Merci pour votre inscription " .$postpseudo. " et bienvenue dans la communauté Epizode !";
					header('Location: index.php?action=login');
					//Envoi d'un email de confirmation
						$to      = $postemail;
						$subject = 'Confirmation d\'inscription';
						$message = 'Merci, nous vous confirmons votre inscription à Epizode ! Pour se connecter : www.epizode.fr';
						$headers = array(
							'From' => 'no-reply@epizode.fr',
						);
						mail($to, $subject, $message, $headers);
					}else{
                        $_SESSION['tempPseudo'] = $postpseudo;
                        $_SESSION['tempEmail'] = $postemail;
                        $_SESSION['error'] = "Les mots de passe ne correspondent pas";
                        header("Location: index.php?action=subscription");
					}
				}else{
                    $_SESSION['tempPseudo'] = $postpseudo;
                    $_SESSION['tempEmail'] = $postemail;
                    $_SESSION['error'] = "Cette adresse email n'existe pas";
                    header("Location: index.php?action=subscription");
				}
			}else{
                $_SESSION['tempPseudo'] = $postpseudo;
                $_SESSION['tempEmail'] = $postemail;
                $_SESSION['error'] = "Ce pseudo ou cette adresse email est déjà utilisé(e)";
                header("Location: index.php?action=subscription");
			}
		}else{
            $_SESSION['tempPseudo'] = $postpseudo;
            $_SESSION['tempEmail'] = $postemail;
            $_SESSION['error'] = "Vous n'avez pas rempli tous les champs";
            header("Location: index.php?action=subscription");
		}
	}
    public function login()
	{
		require('./src/View/frontend/loginView.php');
	}
    public function loginPost($postemail, $postpassword, $postremember)
	{
		$membersManager = new MembersManager();
		if (isset($postemail) AND (isset($postpassword)))
		{
			$postemail = htmlspecialchars($postemail);
			$postpassword = htmlspecialchars($postpassword);
			// On récupère les informations de membre qui correspondent à l'email saisi
			$memberInfo = $membersManager->getMemberInfo(strtolower($postemail));
			if(!$memberInfo)
			{
                $_SESSION['tempEmail'] = $postemail;
                $_SESSION['error'] = "Mauvais identifiant ou mot de passe";
                header("Location: index.php?action=login");
			}else{
				$isPasswordCorrect = password_verify($postpassword, $memberInfo['password']);
				if ($isPasswordCorrect)
				{
					session_start();
					$_SESSION['pseudo'] = $memberInfo['pseudo'];
					$_SESSION['type'] = $memberInfo['type'];
					if($postremember == "on")
                    { // On enregistre l'email que si l'utilisateur le souhaite
                        setcookie($postemail, time()+365*24*3600, null, null, false, true);
					}
					if($memberInfo['type'] == "admin")
					{ // Si le membre est admin
						header('Location: index.php?action=admin'); 
					}else{ // Si le membre est éditeur ou utilisateur
						header('Location: index.php?action=writeSeries');
					}
				}else{
                    $_SESSION['tempEmail'] = $postemail;
                    $_SESSION['error'] = "Mauvais identifiant ou mot de passe";
                    header("Location: index.php?action=login");
				}
			}
		}else{
            $_SESSION['tempEmail'] = $postemail;
            $_SESSION['error'] = "Vous n'avez pas rempli tous les champs";
            header("Location: index.php?action=login");
		}
	}
	public function logout()
	{
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location: index.php?action=subscription'); 
	}
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