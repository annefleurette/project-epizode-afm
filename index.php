<?php
session_start();
require_once('src/Controller/FrontEndController.php');
require_once('src/Controller/BackEndController.php');

use AnneFleurMarchat\Epizode\Controller\FrontendController;
use AnneFleurMarchat\Epizode\Controller\BackendController;

try {
	$frontendController = new FrontendController();
	$backendController = new BackendController();
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			// Members
			case 'subscription':
				$frontendController->subscription();
				break;
			case 'subscription_post':
				$frontendController->subscriptionPost($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['password2']);
				break;
			case 'login':
				$frontendController->login();
				break;
			case 'login_post':
				$frontendController->loginPost($_POST['email'], $_POST['password'], $_POST['remember']);
				break;
			case 'logout':
				$frontendController->logout();
				break;
			//Series
			case 'writeSeries':
				$backendController->writeSeries();
				break;	
			case 'writeSeries_post':
				//$backendController->writeSeriesPost(1, $_POST['author'], $_POST['descriptionAuthor'], $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['tags'], $_POST['rights']);
				$backendController->writeSeriesPost(1, null, null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags']);
				break;
			case 'updateSeries':
				$backendController->updateSeries($_GET['idseries']);
				break;
			case 'updateSeries_post':
				$backendController->updateSeriesPost(1, null, null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags'], $_GET['idseries']);
				break;
			case 'updateSeriesDeleted':
				$backendController->updateSeriesDeleted($_GET['idseries']);
				break;
			case 'deleteSeries':
				$backendController->deleteSeries($_GET['idseries']);
				break;
			case 'displaySeries':
				$frontendController->displaySeries((isset($_GET['idmember'])) ? $_GET['idmember'] : 1, 12, $_GET['subscription']);
				break;
			//Episodes
			case 'writeEpisode':
				$backendController->writeEpisode($_GET['idseries']);
				break;
			case 'writeEpisode_post':
				$backendController->writeEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, $_POST['numberEpisode'], $_POST['titleEpisode'], $_POST['contentEpisode'], $_POST['priceEpisode'], $_POST['promotionEpisode'], (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : null, $_POST['nbCharacters'], $_GET['idseries']);
				break;
			case 'lookEpisode':
				$backendController->lookEpisode($_GET['idseries'], $_GET['idepisode']);
				break;
			case 'updateEpisode':
				$backendController->updateEpisode($_GET['idseries'], $_GET['idepisode']);
				break;
			case 'updateEpisode_post':
				$backendController->updateEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, (isset($_POST['numberEpisode'])) ? $_POST['numberEpisode'] : null, $_POST['titleEpisode'], $_POST['contentEpisode'], $_POST['priceEpisode'], $_POST['promotionEpisode'], (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : date('Y-m-dTH:i', strtotime('+2 hours')), $_POST['nbCharacters'], $_GET['idseries'], $_GET['idepisode']);
				break;
			case 'updateEpisodeDeleted':
				$backendController->updateEpisodeDeleted($_GET['idseries'], $_GET['idepisode']);
				break;
			case 'deleteEpisode':
				$backendController->deleteEpisode($_GET['idepisode']);
				break;
			case 'displayEpisode':
				$frontendController->displayEpisode((isset($_GET['idmember'])) ? $_GET['idmember'] : -1, $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']);
				break;
			case 'alertEpisode_post':
				$frontendController->alertEpisodePost($_GET['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like']);
				break;
			case 'removeAlertEpisode_post':
				$backendController->removeAlertEpisodePost($_GET['idepisode']);
				break;
			case 'writeComment_post':
				$frontendController->writeCommentPost($_GET['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like'], $_POST['comment']);
				break;	
			case 'deleteComment':
				$backendController->deleteComment($_GET['idcomment']);
				break;
			case 'alertComment_post':
				$frontendController->alertCommentPost($_GET['idmember'], $_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_GET['like'], $_GET['idcomment']);
				break;
			case 'removeAlertComment_post':
				$backendController->removeAlertCommentPost($_GET['idcomment']);
				break;
		}
	}else{
		echo "Erreur sur la page";
	}
}catch(Exception $e){
	$errorMessage = $e->getMessage();
	//require('src/View/404error.php');
}