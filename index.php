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
					// Episodes
					case 'removeAlertEpisode_post':
						$episodesController->removeAlertEpisodePost($_GET['idepisode']);
						break;
					// Comments
					case 'deleteComment':
						$commentsController->deleteComment($_GET['idcomment']);
						break;
					case 'removeAlertComment_post':
						$commentsController->removeAlertCommentPost($_GET['idcomment']);
						break;
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
						$membersController->logout();
						break;
					// Series
					case 'writeSeries':
						$seriesController->writeSeries();
						break;	
					case 'writeSeries_post':
						//$backendController->writeSeriesPost(1, $_POST['author'], $_POST['descriptionAuthor'], $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['tags'], $_POST['rights']);
						$seriesController->writeSeriesPost(1, null, null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags']);
						break;
					case 'updateSeries':
						$seriesController->updateSeries($_GET['idseries']);
						break;
					case 'updateSeries_post':
						$seriesController->updateSeriesPost(1, null, null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags'], $_GET['idseries']);
						break;
					case 'updateSeriesDeleted':
						$seriesController->updateSeriesDeleted($_GET['idseries']);
						break;
					case 'deleteSeries':
						$seriesController->deleteSeries($_GET['idseries']);
						break;
					//Episodes
					case 'writeEpisode':
						$episodesController->writeEpisode($_GET['idseries']);
						break;
					case 'writeEpisode_post':
						$episodesController->writeEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, $_POST['numberEpisode'], $_POST['titleEpisode'], $_POST['contentEpisode'], $_POST['priceEpisode'], $_POST['promotionEpisode'], (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : null, $_POST['nbCharacters'], $_GET['idseries']);
						break;
					case 'lookEpisode':
						$episodesController->lookEpisode($_GET['idseries'], $_GET['idepisode']);
						break;
					case 'updateEpisode':
						$episodesController->updateEpisode($_GET['idseries'], $_GET['idepisode']);
						break;
					case 'updateEpisode_post':
						$episodesController->updateEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, (isset($_POST['numberEpisode'])) ? $_POST['numberEpisode'] : null, $_POST['titleEpisode'], $_POST['contentEpisode'], $_POST['priceEpisode'], $_POST['promotionEpisode'], (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : date('Y-m-dTH:i', strtotime('+2 hours')), $_POST['nbCharacters'], $_GET['idseries'], $_GET['idepisode']);
						break;
					case 'updateEpisodeDeleted':
						$episodesController->updateEpisodeDeleted($_GET['idseries'], $_GET['idepisode']);
						break;
					case 'deleteEpisode':
						$episodesController->deleteEpisode($_GET['idepisode']);
						break;
					case 'alertEpisode_post':
						$episodesController->alertEpisodePost($_GET['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']);
						break;
					// Comments
					case 'writeComment_post':
						$commentsController->writeCommentPost($_GET['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like'], $_POST['comment']);
						break;	
					case 'alertComment_post':
						$commentsController->alertCommentPost($_GET['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like'], $_GET['idcomment']);
						break;
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
				//if(isset($_GET['subscription']))
				//{
					$seriesController->displaySeries((isset($_GET['idmember'])) ? $_GET['idmember'] : 1, 12, $_GET['subscription']);
					break;
				//}else{
					//require('src/View/404error.php');
				//}
            // Episodes
			case 'displayEpisode':
				if(isset($_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']))
				{
					$episodesController->displayEpisode((isset($_GET['idmember'])) ? $_GET['idmember'] : -1, $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']);
					break;
				}else{
					require('src/View/404error.php');
				}
			case 'logout':
				$membersController->logout();
				break;
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