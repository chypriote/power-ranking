<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
	// Sample log message
	$this->logger->info("Slim-Skeleton '/' route");
	$args['test'] = "Standings";
	$args['pagetitle'] = "Home";
	// Render index view
	return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/ranking', function () {
	$this->get('/lcseu', function ($request, $response, $args) {
		$teams = getTeams('lcseu');
		return $this->renderer->render($response, 'standings.phtml', [
			'teams' => $teams
			]);
	})->setName('lcseu');
	$this->get('/lcsna', function ($request, $response, $args) {
		return true;
	})->setName('lcsna');
;});
