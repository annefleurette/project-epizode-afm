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
			case 'writeSeries':
				$backendController->writeSeries();
				break;	
			case 'writeSeries_post':
				//$backendController->writeSeriesPost(1, $_POST['author'], $_POST['descriptionAuthor'], $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['tags'], $_POST['rights']);
				$backendController->writeSeriesPost(1, null, null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags']);
				break;
			case 'updateSeries':
				$backendController->updateSeries($_GET['id']);
				break;
			case 'updateSeries_post':
				$backendController->updateSeriesPost(1, null, null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags'], $_GET['id']);
				break;
			case 'displaySeries':
				$frontendController->displaySeries(12);
				break;
			case 'writeEpisode':
				$backendController->writeEpisode();
				break;
		}
	}else{
		echo "Erreur sur la page";
	}
}catch(Exception $e){
	$errorMessage = $e->getMessage();
	//require('src/View/404error.php');
}