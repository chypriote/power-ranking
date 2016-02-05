<?php
	$whitelist = array(
    '127.0.0.1',
    '::1',
    'localhost'
);
if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$local="/power/public/";
}
?>
<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?= $pagetitle ?> | LoL Power Rankings</title>
		<meta name="description" content="Community powered League of Legends power rankings">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?= $local ?>css/normalize.css">
		<link rel="stylesheet" href="<?= $local ?>css/main.css">

		<script src="/js/vendor/modernizr-2.8.3.min.js"></script>
	</head>