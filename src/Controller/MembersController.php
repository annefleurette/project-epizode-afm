<?php
namespace AnneFleurMarchat\Epizode\Controller;

require_once('src/Model/SeriesManager.php');
require_once('src/Model/EpisodesManager.php');
require_once('src/Model/CommentsManager.php');
require_once('src/Model/MembersManager.php');

use AnneFleurMarchat\Epizode\Model\MembersManager;
use AnneFleurMarchat\Epizode\Model\SeriesManager;
use AnneFleurMarchat\Epizode\Model\EpisodesManager;
use AnneFleurMarchat\Epizode\Model\CommentsManager;

class MembersController {

    public function subscription()
	{
		require('./src/View/frontend/subscriptionView.php');
	}

    public function subscriptionPost($postpseudo, $postemail, $postpassword, $postpassword2)
	{
		$membersManager = new MembersManager();
		// On récupère tous les pseudos et emails des membres inscrits
		$getPseudos = $membersManager->getMembersPseudo();
        $getEmails = $membersManager->getMembersEmail();
		$postpseudo = htmlspecialchars($postpseudo);
		$postemail = htmlspecialchars($postemail);
		$postpassword = htmlspecialchars($postpassword);
		$postpassword2 = htmlspecialchars($postpassword2);
		// Si le pseudo est bien nouveau
		if(!in_array(strtolower($postpseudo), $getPseudos) AND !in_array(strtolower($postemail), $getEmails))
		{
			// Si l'adresse email possède bien le bon format
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$#", $postemail))
			{
				//Si le mot de passe correspond bien à sa vérification
				if($postpassword == $postpassword2)
				{
					$pass_hache = password_hash($postpassword, PASSWORD_DEFAULT);
					// On ajoute un membre
					$type = "user";
					$postpseudo = strtolower($postpseudo);
					$postemail = strtolower($postemail);
					$token = random_int(100000000, 999999999);
					$confirmation = "confirmed";
					$addMember = $membersManager->addMember($postpseudo, $postemail, $pass_hache, $type, $confirmation, $token);
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
	}

    public function login($get)
	{
		if(isset($get['ref']) AND (isset($get['idseries'])))
		{
			if(isset($get['number']) AND (isset($get['idepisode'])))
			{
				$_SESSION['previousurl'] = "?action=" .$get['ref']. "&idseries=" .$get['idseries']. "&number=" .$get['number']. "&idepisode=" .$get['idepisode'];
			}else{
				$_SESSION['previousurl'] = "?action=" .$get['ref']. "&idseries=" .$get['idseries'];
			}
		}
		require('./src/View/frontend/loginView.php');
	}

    public function loginPost($postemail, $postpassword, $postremember)
	{
		$membersManager = new MembersManager();
		$postemail = htmlspecialchars($postemail);
		$postpassword = htmlspecialchars($postpassword);
		$postremember = htmlspecialchars($postremember);
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
				$_SESSION['idmember'] = $memberInfo['id'];
				$_SESSION['pseudo'] = $memberInfo['pseudo'];
				$_SESSION['type'] = $memberInfo['type'];
				if($postremember == "on")
                { // On enregistre l'email que si l'utilisateur le souhaite
                    setcookie($postemail, time()+365*24*3600, null, null, false, true);
				}
                // On inclut la gestion des autorisations
                include('./src/Utils/authorization.php');
				if($_SESSION['type'] == "admin")
				{
					if(isset($_SESSION['previousurl'])) {
						header('Location: index.php' .$_SESSION['previousurl']);
						unset($_SESSION['previousurl']);
					}else{
						header('Location: index.php?action=admin'); 
						unset($_SESSION['previousurl']);
					}
				}elseif($_SESSION['type'] == "publisher" OR $_SESSION['type'] == "user")
				{
					if(isset($_SESSION['previousurl'])) {
						header('Location: index.php' .$_SESSION['previousurl']);
						unset($_SESSION['previousurl']);
					}else{
						header('Location: index.php?action=dashboard'); 
						unset($_SESSION['previousurl']);
					}
				}
			}else{
                $_SESSION['tempEmail'] = $postemail;
                $_SESSION['error'] = "Mauvais identifiant ou mot de passe";
                header("Location: index.php?action=login");
			}
		}
	}

	public function forgetPassword()
	{
		require('./src/View/frontend/displayForgetPasswordView.php');
	}

	public function forgetPasswordPost($postemail)
	{
		$membersManager = new MembersManager();
		$postemail = htmlspecialchars($postemail);
		// On récupère les informations de membre qui correspondent à l'email saisi
		$memberInfo = $membersManager->getMemberInfo(strtolower($postemail));
		if(!$memberInfo)
		{
            $_SESSION['tempEmail'] = $postemail;
            $_SESSION['error'] = "Mauvais identifiant";
            header("Location: index.php?action=forgetPassword");
		}else{
			//Envoi d'un email de réinitialisation
			$to      = $postemail;
			$subject = 'Réinitialisation du mot de passe';
			$message = 'Vous avez oublié votre mot de passe, cliquez ici pour le réinitialiser : http://localhost:8888/p5/project-epizode-afm/index.php?action=resetPassword&idmember=' .$memberInfo['id']. '&token=' .$memberInfo['token'];
			$headers = array(
				'From' => 'no-reply@epizode.fr',
			);
			mail($to, $subject, $message, $headers);
			$_SESSION['confirm'] = "Un email de réinitialisation de mot de passe vient de vous être envoyé !";
			header("Location: index.php?action=homepage");
		}
	}

	public function resetPassword($getidmember, $gettoken)
	{
		$membersManager = new MembersManager();
		$getidmember = htmlspecialchars($getidmember);
		$gettoken = htmlspecialchars($gettoken);
		// On récupère les informations du membre
		$userProfile = $membersManager->getMemberProfileData(intval($getidmember));
		if(!$userProfile)
		{
            header("Location: index.php?action=403error");
		}else{
			// Si le token est bien le même que celui enregistré sur la base de données
			if($gettoken == $userProfile['token']){
			require('./src/View/frontend/displayResetPasswordView.php');
			}else{
				header("Location: index.php?action=403error");
			}
		}
	}

	public function resetPasswordPost($getidmember, $postpassword, $postpassword2, $gettoken)
	{
		$membersManager = new MembersManager();
		$getidmember = htmlspecialchars($getidmember);
		$postpassword = htmlspecialchars($postpassword);
		$postpassword2 = htmlspecialchars($postpassword2);
		$gettoken = htmlspecialchars($gettoken);
		//Si le mot de passe correspond bien à sa vérification
		if($postpassword == $postpassword2)
		{
			$pass_hache = password_hash($postpassword, PASSWORD_DEFAULT);
			// On enregistre le nouveau mot de passe
			$updatePassword = $membersManager->updatePassword($getidmember, $pass_hache);
			// On modifie le token
			$token = random_int(100000000, 999999999);
			$updateToken = $membersManager->updateToken($getidmember, $token);
			$_SESSION['confirm'] = "Le nouveau mot de passe est bien enregistré";
            header("Location: index.php?action=login");
		}else{
            $_SESSION['error'] = "Les mots de passe ne correspondent pas";
            header("Location: index.php?action=resetPassword&idmember=" .$getidmember. '&token=' .$gettoken);
		}
	}

	public function displayDashboard()
	{
		$membersManager = new MembersManager();
		// On récupère les informations du membre
		$userData = $membersManager->getMemberData($_SESSION['idmember']);
		// On récupère les séries auxquelles un membre est abonné
		$getAllSubscriptionSeries = $membersManager->getAllSubscriptionSeries($_SESSION['idmember']);
		// On récupère toutes les séries écrites par un membre
		$getAllSeriesMember = $membersManager->getAllSeriesMember($_SESSION['idmember']);
		require('./src/View/backend/displayDashboardView.php');
	}

	public function displayAdmin()
	{
		$membersManager = new MembersManager();
		$seriesManager = new SeriesManager();
		$episodesManager = new EpisodesManager();
		$commentsManager = new CommentsManager();
		// On récupère les informations du membre
		$userData = $membersManager->getMemberData($_SESSION['idmember']);
		// On récupère les informations de tous les membres
		$usersData = $membersManager->getMembersProfileData();
		// On récupère les informations de toutes les séries
		$getAllSeries = $seriesManager->getAllSeries();
		// On récupère l'ensemble des épisodes signalés
		$getAlertEpisodes = $episodesManager->getAlertEpisodes();
		// On récupère l'ensemble des épisodes
		$getAllEpisodes = $episodesManager->getAllEpisodes();
		// On réucpère l'ensemble des commentaires signalés
		$getAlertComments = $commentsManager->getAlertComments();
		// On récupère l'ensemble des commentaires
		$getAllComments = $commentsManager->getAllComments();
		require('./src/View/backend/displayAdminView.php');
	}

	public function displayAccount()
	{
		$membersManager = new MembersManager();
		require('./src/View/backend/displayAccountView.php');
	}

	public function logout()
	{
		session_start();
		$_SESSION = array();
		session_destroy();
		header('Location: index.php?action=subscription'); 
	}

	public function displayMember($getidmember = 1)
	{
		$membersManager = new MembersManager();
		$getidmember = htmlspecialchars($getidmember);
		// On récupère les informations du membre
		$userData = $membersManager->getMemberData($getidmember);
		// On récupère toutes les séries écrites par un membre
		$getAllSeriesMember = $membersManager->getAllSeriesMember($getidmember);
		// On récupère toutes les séries auxquelles un membre est abonné
		$getAllSubscriptionSeries = $membersManager->getAllSubscriptionSeries($getidmember);
		// On récupère la liste des auteurs d'un éditeur
		$authorsList = $membersManager->getAuthorsList($getidmember);
		require('./src/View/frontend/displayMemberView.php');
	}

	public function deleteMember($memberId)
    {
        $membersManager = new MembersManager();
        $memberId = htmlspecialchars($memberId);
        // On supprime définitivement le membre
        $deleteMember = $membersManager->deleteMember($memberId);
        header('Location: index.php?action=admin'); 
    }

}