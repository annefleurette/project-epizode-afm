<?php
session_start();

require_once('src/Controller/FrontEndController.php');
require_once('src/Controller/BackEndController.php');

use AnneFleurMarchat\Epizode\Controller\FrontendController;
use AnneFleurMarchat\Epizode\Controller\BackendController;

try {
	//$frontendController = new FrontendController();
	$backendController = new BackendController();
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'writeSeries':
				$backendController->writeSeries();
				break;	
			case 'writeSeries_post':
				$backendController->writeSeriesPost($_GET['id'], $_POST['author'], $_POST['descriptionAuthor'], $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['cover'], $_POST['tags'], $_POST['rights']);
				break;
		}
	//}else{
		// A compléter
	}
}catch(Exception $e){
	$errorMessage = $e->getMessage();
	//require('src/View/404error.php');
}