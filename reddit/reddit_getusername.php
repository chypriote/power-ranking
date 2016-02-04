<?php

	function user_identity($access_token, $refresh_token) {
		//lets retrieve username of the logged in user
		$user_info_url = "https://oauth.reddit.com/api/v1/me";

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$user_info_url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: bearer ".$access_token, "User-Agent: flairbot/1.0 by ".$username));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);


		$result = curl_exec($ch);
		$result = json_decode($result);

		if(isset($result->error)) {
			//access token has expired. Use the refresh token to get a new access token and then make REST api calls.
			$url = "https://ssl.reddit.com/api/v1/access_token";
			$fields = array("grant_type" => "refresh_token", "refresh_token" => $refresh_token);

			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');

			$ch = curl_init();

			curl_setopt($ch,CURLOPT_URL, "https://ssl.reddit.com/api/v1/access_token");
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $client_id.":".$client_secret);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

			$result = curl_exec($ch);
			$result = json_decode($result);

			//new access token
			$access_token = $result->access_token;

			curl_close($ch);

			$user_info_url = "https://oauth.reddit.com/api/v1/me";

			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$user_info_url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: bearer ".$access_token, "User-Agent: flairbot/1.0 by ".$username));
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);


			$result = curl_exec($ch);
			curl_close($ch);

			$result = json_decode($result);
			echo $user_name = $result->name;
		} else {
			echo $user_name = $result->name;
		}
		curl_close($ch);
	}