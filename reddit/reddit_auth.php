<?php

	$nonce = rand();
	$redirect_uri = "http://ranking.chypriote.me";
	$client_id = "MZvnbQ8eCPrFGQ";

	setcookie("reddit_login_nonce",$nonce);

	header("Location: " . "https://ssl.reddit.com/api/v1/authorize?client_id=". $client_id ."&response_type=code&state=". $nonce ."&redirect_uri=". $redirect_uri ."&duration=permanent&scope=identity");
