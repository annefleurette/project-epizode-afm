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

class MembersController {

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
					$_SESSION['id'] = $memberInfo['id'];
					$_SESSION['pseudo'] = $memberInfo['pseudo'];
					$_SESSION['type'] = $memberInfo['type'];
					if($postremember == "on")
                    { // On enregistre l'email que si l'utilisateur le souhaite
                        setcookie($postemail, time()+365*24*3600, null, null, false, true);
					}
                    // On inclut la gestion des authorisations
                    include('./src/Utils/authorization.php');
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

}