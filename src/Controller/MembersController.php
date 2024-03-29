<?php
namespace AnneFleurMarchat\Epizode\Controller;

require_once('src/Model/SeriesManager.php');
require_once('src/Model/EpisodesManager.php');
require_once('src/Model/CommentsManager.php');
require_once('src/Model/MembersManager.php');

use AnneFleurMarchat\Epizode\Model\MembersManager;

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
				if($memberInfo['type'] == "admin")
				{ // Si le membre est admin
					if(isset($_SESSION['previousurl'])) {
						header('Location: index.php' .$_SESSION['previousurl']);
						unset($_SESSION['previousurl']);
					}else{
						header('Location: index.php?action=admin'); 
						unset($_SESSION['previousurl']);
					}
				}else{ // Si le membre est éditeur ou utilisateur
					if(isset($_SESSION['previousurl'])) {
						header('Location: index.php' .$_SESSION['previousurl']);
					}else{
						header('Location: index.php?action=writeSeries'); 
					}
				}
			}else{
                $_SESSION['tempEmail'] = $postemail;
                $_SESSION['error'] = "Mauvais identifiant ou mot de passe";
                header("Location: index.php?action=login");
			}
		}
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

}