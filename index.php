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
			if(isset($_SESSION))
			{
				if($_SESSION['level'] >=30){ // Niveau admin
					switch($_GET['action'])
					{
						// Members
						case 'admin':
							$membersController->displayAdmin();
						break;
						case 'deleteMember':
							if(isset($_GET['idmember']))
							{
								$membersController->deleteMember($_GET['idmember']);
							}else{
								require('src/View/404error.php');
							}
							break;
						// Series
						case 'adminDeleteSeries':
							if(isset($_GET['idseries']))
							{
								$seriesController->adminDeleteSeries($_GET['idseries']);
							}else{
								require('src/View/404error.php');
							}
							break;
						// Episodes
						case 'adminDeleteEpisode':
							if(isset($_GET['idepisode']))
							{
								$episodesController->adminDeleteEpisode($_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'removeAlertEpisode_post':
							if(isset($_GET['idepisode']))
							{
								$episodesController->removeAlertEpisodePost($_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}
							break;
						// Comments
						case 'deleteComment':
							if(isset($_GET['idcomment']))
							{
								$commentsController->deleteComment($_GET['idcomment']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'removeAlertComment_post':
							if(isset($_GET['idcomment']))
							{
								$commentsController->removeAlertCommentPost($_GET['idcomment']);
							}else{
								require('src/View/404error.php');
							}
							break;
						default: break;
					}
				}
				if($_SESSION['level'] >=20){ // Niveau éditeur
					switch($_GET['action'])
					{
						case 'updateAccount_post':
							if(isset($_POST['email']))
							{
								$membersController->updateAccountPublisherPost($_POST['email'], isset($_POST['resetpassword']) ? $_POST['resetpassword'] : null, isset($_POST['resetpassword2']) ? $_POST['resetpassword2'] : null, isset($_POST['description']) ? $_POST['description'] : null);
							}
						break;
						default: break;
					}
				}
				if($_SESSION['level'] >=10){ // Niveau utilisateur
					switch($_GET['action'])
					{
						// Membres
						case 'subscription':
							$membersController->displayDashboard();
						break;
						case 'login':
							$membersController->displayDashboard();
						break;
						case 'logout':
							$membersController->logout();
						break;
						case 'displayMember':
						if(isset($_GET['idmember']))
						{
							$membersController->displayMember($_GET['idmember']);
						}else{
							require('src/View/403error.php');
						}
						break;
						case 'deleteAccount':
							$membersController->deleteAccount();
						break;
						// Series
						case 'homepage':
							$seriesController->displayHomepage();
						break;
						case 'research':
							if(isset($_POST['keyword']) AND $_POST['keyword'] != NULL)
							{
								$seriesController->displayResearch($_POST['keyword']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'dashboard':
							$membersController->displayDashboard();
						break;
						case 'account':
							$membersController->displayAccount();
						break;
						case 'updateAccount_post':
							if(isset($_POST['email']))
							{
								$membersController->updateAccountUserPost($_POST['email'], isset($_POST['resetpassword']) ? $_POST['resetpassword'] : null, isset($_POST['resetpassword2']) ? $_POST['resetpassword2'] : null, isset($_POST['avatar']) ? $_POST['avatar'] : null, isset($_POST['description']) ? $_POST['description'] : null);
							}
						break;
						case 'writeSeries':
							$seriesController->writeSeries();
						break;
						case 'writeSeries_post':
							if(isset($_POST['titleSeries']) AND isset($_POST['descriptionSeries']) AND isset($_POST['rights']) AND isset($_POST['tags']))
							{
								$seriesController->writeSeriesPost((isset($_POST['author'])) ? $_POST['author'] : null, (isset($_POST['descriptionAuthor'])) ? $_POST['descriptionAuthor'] : null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags'], (isset($_POST['metaSeries'])) ? $_POST['metaSeries'] : null);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'updateSeries':
							if(isset($_GET['idseries']))
							{
								$seriesController->updateSeries($_GET['idseries']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'updateSeries_post':
							if(isset($_POST['titleSeries']) AND isset($_POST['descriptionSeries']) AND isset($_POST['rights']) AND isset($_POST['tags']) AND isset($_GET['idseries']))
							{
								$seriesController->updateSeriesPost((isset($_POST['author'])) ? $_POST['author'] : null, (isset($_POST['descriptionAuthor'])) ? $_POST['descriptionAuthor'] : null, $_POST['titleSeries'], $_POST['descriptionSeries'], $_POST['rights'], $_POST['tags'], (isset($_POST['metaSeries'])) ? $_POST['metaSeries'] : null, $_GET['idseries']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'userDeleteSeries':
							if(isset($_GET['idseries']))
							{
								$seriesController->userDeleteSeries($_GET['idseries']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'displaySeries':
							if(isset($_GET['idseries']))
							{
								$seriesController->displaySeries($_GET['idseries']);
							}else{
								require('src/View/404error.php');
							}
							return;
						case 'addSubscription':
							$seriesController->addSubscription($_GET['idseries']);
							break;
						case 'removeSubscription':
							$seriesController->removeSubscription($_GET['idseries']);
							break;
						case 'removeSubscriptionLibrary':
							$seriesController->removeSubscriptionLibrary($_GET['idseries']);
							break;
						//Episodes
						case 'writeEpisode':
							if(isset($_GET['idseries']))
							{
								$episodesController->writeEpisode($_GET['idseries']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'writeEpisode_post':
							if(isset($_POST['numberEpisode']) AND isset($_POST['titleEpisode']) AND isset($_POST['contentEpisode']) AND isset($_GET['idseries']))
							{
								$episodesController->writeEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, $_POST['numberEpisode'], $_POST['titleEpisode'], $_POST['contentEpisode'], (isset($_POST['priceEpisode'])) ? $_POST['priceEpisode'] : 0, (isset($_POST['promotionEpisode'])) ? $_POST['promotionEpisode'] : 0, (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : null, $_POST['nbCharacters'], (isset($_POST['metaEpisode'])) ? $_POST['metaEpisode'] : null, $_GET['idseries']);
							
							}else{
								require('src/View/403error.php');
							}
							break;
						case 'lookEpisode':
							if(isset($_GET['idseries']) AND isset($_GET['idepisode']))
							{
								$episodesController->lookEpisode($_GET['idseries'], $_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'updateEpisode':
							if(isset($_GET['idseries']) AND isset($_GET['idepisode']))
							{
								$episodesController->updateEpisode($_GET['idseries'], $_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'updateEpisode_post':
							if(isset($_POST['titleEpisode']) AND isset($_POST['contentEpisode']) AND isset($_POST['nbCharacters']) AND isset($_GET['idseries']) AND isset($_GET['idepisode']))
							{
								$episodesController->updateEpisodePost((isset($_POST['save'])) ? $_POST['save'] : null, (isset($_POST['numberEpisode'])) ? $_POST['numberEpisode'] : null, $_POST['titleEpisode'], $_POST['contentEpisode'], (isset($_POST['priceEpisode'])) ? $_POST['priceEpisode'] : 0, (isset($_POST['promotionEpisode'])) ? $_POST['promotionEpisode'] : 0, (isset($_POST['dateEpisode'])) ? $_POST['dateEpisode'] : date('Y-m-dTH:i', strtotime('+2 hours')), $_POST['nbCharacters'], (isset($_POST['metaEpisode'])) ? $_POST['metaEpisode'] : null, $_GET['idseries'], $_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}						
							break;
						case 'userDeleteEpisode':
							if(isset($_GET['idseries']) AND isset($_GET['idepisode']))
							{
								$episodesController->userDeleteEpisode($_GET['idseries'], $_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'displayEpisode':
							if(isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']))
							{
								$episodesController->displayEpisode($_GET['idseries'], $_GET['number'], $_GET['idepisode']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'addLike':
							$episodesController->addLike($_GET['idepisode']);
							break;
						case 'removeLike':
							$episodesController->removeLike($_GET['idepisode']);
							break;
						case 'addAlertEpisode':
							$episodesController->addAlertEpisode($_GET['idepisode']);
							break;
						// Comments
						case 'writeComment_post':
							if(isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']) AND isset($_POST['comment']))
							{
								$commentsController->writeCommentPost($_GET['idseries'], $_GET['number'], $_GET['idepisode'], $_POST['comment']);
							}else{
								require('src/View/404error.php');
							}
							break;
						case 'addAlertComment':
							$commentsController->addAlertComment($_GET['idcomment']);
							break;
						default: break;
					}
				}
			}else{
				require('src/View/403error.php');
			}
		}else{
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
					}else{
						require('src/View/404error.php');
					}
					break;
				case 'login':
					$membersController->login($_GET);
					break;
				case 'login_post':
					if(isset($_POST['email']) AND isset($_POST['password']))
					{
						$membersController->loginPost($_POST['email'], $_POST['password'], isset($_POST['remember']) ? $_POST['remember'] : "off");
					}else{
						require('src/View/404error.php');
					}
					break;
				case 'forgetPassword':
					$membersController->forgetPassword();
				break;
				case 'forgetPassword_post':
					if(isset($_POST['email']))
					{
						$membersController->forgetPasswordPost($_POST['email']);
					}
					break;
				case 'resetPassword':
					if(isset($_GET['token']))
					{
						$membersController->resetPassword($_GET['token']);
					}else{
						require('src/View/404error.php');
					}
					break;
				case 'resetPassword_post':
					if(isset($_POST['password']) AND isset($_POST['password2']) AND isset($_GET['token']))
					{
						$membersController->resetPasswordPost($_POST['password'], $_POST['password2'], $_GET['token']);
					}else{
						require('src/View/404error.php');
					}
					break;
				case 'displayMember':
					if(isset($_GET['idmember']))
					{
						$membersController->displayMember($_GET['idmember']);
					}else{
						require('src/View/403error.php');
					}
					break;
				// Séries
				case 'homepage':
					$seriesController->displayHomepage();
					break;
				case 'research':
					if(isset($_POST['keyword']) AND $_POST['keyword'] != NULL)
					{
						$seriesController->displayResearch($_POST['keyword']);
					}else{
						$seriesController->displayHomepage();
					}
					break;
				case 'displaySeries':
					if(isset($_GET['idseries']))
					{
						$seriesController->displaySeries($_GET['idseries']);
					}else{
						require('src/View/404error.php');
					}
					break;
					case 'addSubscription':
						$seriesController->addSubscription($_GET['idseries']);
					break;
					case 'removeSubscription':
						$seriesController->removeSubscription($_GET['idseries']);
					break;
				// Episodes
				case 'displayEpisode':
					if(isset($_GET['idseries']) AND isset($_GET['number']) AND isset($_GET['idepisode']))
					{
						// On bloque l'accès du visiteur aux 3 premiers épisodes seulement
						if($_GET['number'] < 4){
							$episodesController->displayEpisode($_GET['idseries'], $_GET['number'], $_GET['idepisode']);
						}else{
							require('src/View/403error.php');
						}
					}else{
						require('src/View/404error.php');
					}
					break;
				case 'addLike':
					$episodesController->addLike($_GET['idepisode']);
					break;
				case 'removeLike':
					$episodesController->removeLike($_GET['idepisode']);
					break;
				default:
				require('src/View/403error.php');
			}
		}
	}else{
		require('src/View/404error.php');
	}
}catch(Exception $e){
	$errorMessage = $e->getMessage();
	require('src/View/404error.php');
}