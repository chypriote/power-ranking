<?php
// Routes

$app->get('/', function ($request, $response, $args) {
	// Sample log message
	$this->logger->info("Slim-Skeleton '/' route");
	$args['test'] = "Standings";
	$args['pagetitle'] = "Home";
	// Render index view
	return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/login', function ($request, $response, $args) {
	global $redditSettings;
	$this->logger->info("Login initiated");
	$reddit = new \Rudolf\OAuth2\Client\Provider\Reddit([
    'clientId'      => $redditSettings['clientId'],
    'clientSecret'  => $redditSettings['clientSecret'],
    'redirectUri'   => $redditSettings['redirectUri'],
    'userAgent'     => $redditSettings['userAgent'],
    'scopes'        => $redditSettings['scope'],
	]);

	return $this->renderer->render($response, 'login.phtml', $args);
});

$app->group('/ranking', function () {
	$this->get('/lcseu', function ($request, $response, $args) {
		$teams = Team::all();

		return $this->renderer->render($response, 'standings.phtml', [
			'teams' => $teams,
			'test' => 'Standings',
			'pagetitle' => 'LCS EU'
			]);
	})->setName('lcseu');
	$this->get('/lcsna', function ($request, $response, $args) {
		return true;
	})->setName('lcsna');
;});
