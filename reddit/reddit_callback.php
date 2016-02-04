<?php

	$client_id = "";
	$client_secret = "";
	$username = "";

	if(isset($_GET["error"])) {
		echo $_GET["error"];
	} else {
		if($_COOKIE["reddit_login_nonce"] == $_GET["state"]) {
			$url = "https://ssl.reddit.com/api/v1/access_token";
			$fields = array("grant_type" => "authorization_code",
											"code" => $_GET["code"],
											"redirect_uri" => "http://labs.qnimate.com/reddit-login/redirect.php");

			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');

			$ch = curl_init();

			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $client_id.":".$client_secret);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

			$result = curl_exec($ch);
			$result = json_decode($result);

			curl_close($ch);

			$access_token = $result->access_token;
			$refresh_token = $result->refresh_token;
		} else {
			echo "Please try to login again";
		}
	}