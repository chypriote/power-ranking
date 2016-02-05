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

$app->get('/connect', function($request, $response, $args) {
	$reddit = new reddit();
	return $this->renderer->render($response, 'login.phtml', $return);
});

$app->get('/login', function ($request, $response, $args) {
	$this->logger->info("Login initiated");

	$reddit = new reddit();
	$return['user'] = $reddit->getUserAbout('chypriote');
	return $this->renderer->render($response, 'login.phtml', $return);
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
