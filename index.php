<?php
session_start();
require_once('src/Controller/MembersController.php');
require_once('src/Controller/SeriesController.php');
require_once('src/Controller/EpisodesController.php');
require_once('src/Controller/CommentsController.php');

use AnneFleurMarchat\Epizode\Controller\MembersController;
use AnneFleurMarchat\Epizode\Controller\SeriesController;
use AnneFleurMarchat\Epizode\Controller\EpisodesController;
use AnneFleurMarchat\Epizode\Controller\CommentsController;

try {
	$membersController = new MembersController();
	$seriesController = new SeriesController();
	$episodesController = new EpisodesController();
	$commentsController = new CommentsController();
	if(isset($_GET['action']))
	{
		if(isset($_SESSION['level']))
		{
			if($_SESSION['level'] >=30){ // Niveau admin
				switch($_GET['action'])
				{
					// Series
					case 'deleteSeries':
						if(isset($_GET['idseries']))
						{
							$seriesController->deleteSeries($_GET['idseries']);
							break;
						}else{
							require('src/View/404error.php');
						}
					// Episodes
					case 'removeAlertEpisode_post':
						if(isset($_GET['idepisode']))
						{
							$episodesController->removeAlertEpisodePost($_GET['idepisode']);
							break;
						}else{
							require('src/View/404error.php');
						}
					// Comments
					case 'deleteComment':
						if(isset($_GET['idcomment']))
						{
							$commentsController->deleteComment($_GET['idcomment']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'removeAlertComment_post':
						if(isset($_GET['idcomment']))
						{
							$commentsController->removeAlertCommentPost($_GET['idcomment']);
							break;
						}else{
							require('src/View/404error.php');
						}
					default: break;
				}
			}
			if($_SESSION['level'] >=20){ // Niveau éditeur
				switch($_GET['action'])
				{
					default: break;
				}
			}
			if($_SESSION['level'] >=10){ // Niveau utilisateur
				switch($_GET['action'])
				{
					// Membres
					case 'logout':
						if(isset($_SESSION)){
							$membersController->logout();
							break;
						}else{
							require('src/View/404error.php');
						}
					// Series
					case 'writeSeries':
						if(isset($_SESSION['idmember']) AND ($_SESSION['idmember'] == $_GET['idmember']))
						{
							$seriesController->writeSeries($_SESSION['idmember']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'writeSeries_post':
						if(isset($_SESSION['idmember']) AND isset($_POST['titleSeries']) AND isset($_POST['descriptionSeries']) AND isset($_POST['rights']) AND isset($_POST['tags']))
						{
							$seriesController->writeSeriesPost($_SESSION['idmember'], $_POST['author'], $_POST['descriptionAuthor'], $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'updateSeries':
						if(isset($_SESSION['idmember']) AND isset($_GET['idseries']) AND ($_SESSION['idmember'] == $_GET['idmember']))
						{
							$seriesController->updateSeries($_SESSION['idmember'], $_GET['idseries']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'updateSeries_post':
						if(isset($_SESSION['idmember']) AND isset($_POST['titleSeries']) AND isset($_POST['descriptionSeries']) AND isset($_POST['rights']) AND isset($_POST['tags']) AND isset($_GET['idseries']))
						{
							$seriesController->updateSeriesPost($_SESSION['idmember'], $_POST['author'], $_POST['descriptionAuthor'], $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags'], $_GET['idseries']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'updateSeriesDeleted':
						if(isset($_SESSION['idmember'], $_GET['idseries']) AND ($_SESSION['idmember'] == $_GET['idmember']))
						{
							$seriesController->updateSeriesDeleted($_SESSION['idmember'], $_GET['idseries']);
							break;
						}else{
							require('src/View/404error.php');
						}
					//Episodes
					case 'writeEpisode':
						if(isset($_GET['idseries']))
						{
							$episodesController->writeEpisode($_GET['idseries']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'writeEpisode_post':
						if(isset($_POST['numberEpisode']) AND isset($_POST['titleEpisode']) AND isset($_POST['contenEpisode']) AND isset($_POST['priceEpisode']) AND isset($_POST['nbCharacters']) AND isset($_GET['idseries']))
						{
							$episodesController->writeEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, $_POST['numberEpisode'], $_POST['titleEpisode'], $_POST['contentEpisode'], $_POST['priceEpisode'], $_POST['promotionEpisode'], (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : null, $_POST['nbCharacters'], $_GET['idseries']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'lookEpisode':
						if(isset($_GET['idseries']) AND isset($_GET['idepisode']))
						{
							$episodesController->lookEpisode($_GET['idseries'], $_GET['idepisode']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'updateEpisode':
						if(isset($_GET['idseries']) AND isset($_GET['idepisode']))
						{
							$episodesController->updateEpisode($_GET['idseries'], $_GET['idepisode']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'updateEpisode_post':
						if(isset($_POST['titleEpisode']) AND isset($_POST['contenEpisode']) AND isset($_POST['priceEpisode']) AND isset($_POST['nbCharacters']) AND isset($_GET['idseries']) AND isset($_GET['idepisode']))
						{
							$episodesController->updateEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, (isset($_POST['numberEpisode'])) ? $_POST['numberEpisode'] : null, $_POST['titleEpisode'], $_POST['contentEpisode'], $_POST['priceEpisode'], $_POST['promotionEpisode'], (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : date('Y-m-dTH:i', strtotime('+2 hours')), $_POST['nbCharacters'], $_GET['idseries'], $_GET['idepisode']);
							break;						
						}else{
							require('src/View/404error.php');
						}
					case 'updateEpisodeDeleted':
						if(isset($_GET['idseries']) AND isset($_GET['idepisode']))
						{
							$episodesController->updateEpisodeDeleted($_GET['idseries'], $_GET['idepisode']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'deleteEpisode':
						if(isset($_GET['idepisode']))
						{
							$episodesController->deleteEpisode($_GET['idepisode']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'alertEpisode_post':
						if(isset($_SESSION['idmember']) AND isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']) AND isset($_GET['like'])) 
						{
							$episodesController->alertEpisodePost($_SESSION['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']);
							break;
						}else{
							require('src/View/404error.php');
						}
					// Comments
					case 'writeComment_post':
						if(isset($_SESSION['idmember']) AND isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']) AND isset($_GET['like']) AND isset($_POST['comment']))
						{
							$commentsController->writeCommentPost($_SESSION['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like'], $_POST['comment']);
							break;
						}else{
							require('src/View/404error.php');
						}
					case 'alertComment_post':
						if(isset($_SESSION['idmember']) AND isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']) AND isset($_GET['like']) AND isset($_GET['idcomment']))
						{
							$commentsController->alertCommentPost($_SESSION['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like'], $_GET['idcomment']);
							break;
						}else{
							require('src/View/404error.php');
						}
					default: break;
				}
			}
		}
		switch($_GET['action'])
		{
			// Niveau visiteur
			// Membres
            case 'subscription':
				$membersController->subscription();
				break;
			case 'subscription_post':
				if(isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['password2']))
				{
					$membersController->subscriptionPost($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['password2']);
					break;
				}else{
					require('src/View/404error.php');
				}
			case 'login':
				$membersController->login();
				break;
			case 'login_post':
				if(isset($_POST['email']) AND isset($_POST['password']))
				{
					$membersController->loginPost($_POST['email'], $_POST['password'], $_POST['remember']);
					break;
				}else{
					require('src/View/404error.php');
				}
            // Séries
			case 'displaySeries':
				if(isset($_GET['idseries']) AND isset($_GET['subscription']))
				{
					$seriesController->displaySeries((isset($_SESSION['idmember'])) ? $_GET['idmember'] : 1, $_GET['idseries'], $_GET['subscription']);
					break;
				}else{
					require('src/View/404error.php');
				}
            // Episodes
			case 'displayEpisode':
				if(isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']) AND isset($_GET['like']))
				{
					$episodesController->displayEpisode((isset($_GET['idmember'])) ? $_GET['idmember'] : -1, $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']);
					break;
				}else{
					require('src/View/404error.php');
				}
			default:
			require('src/View/404error.php');
		}
	}else{
		echo "Erreur sur la page";
	}
}catch(Exception $e){
	$errorMessage = $e->getMessage();
	require('src/View/404error.php');
}