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

    public function displaySeries($idseries = 12)
	{
        $seriesManager = new SeriesManager();
        $episodesManager = new EpisodesManager;
        $membersManager = new MembersManager();
        // On récupère les informations sur la série
        $oneSeriesUserData = $seriesManager->getOneSeriesData($idseries);
        // On récupère tous les épisodes de la série
        $episodesPublishedList = $episodesManager->getEpisodesPublishedList($idseries);
        $nbepisodes_published = count($episodesPublishedList);
        // On récupère des informations sur des séries qui ont des tags en commun
        $tags = explode(', ', $oneSeriesUserData['tags']);
        $nbtags = count($tags);
        $allTagsSeries = [];
        for ($i = 0; $i < $nbtags; $i++) {
            $seriesCommonTags[$i] = $seriesManager->getCommonTagsSeries($tags[$i]);
            array_push($allTagsSeries, $seriesCommonTags[$i]);
        }  
		require('./src/View/frontend/displaySeriesView.php');
	}
	
}