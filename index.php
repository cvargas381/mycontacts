<?php
// Must be called first to have access to any session data
session_start();

// "Import" functions
require('config/db.php');
require('config/app.php');
require('lib/functions.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<script src="vendor/jquery-ui-1.10.0.custom/js/jquery-1.9.0.js"></script>
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="styles.css" />
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<title>Contacts</title>
	</head>
	<body>
		<div id="wrapper" class="container">
			<header>
				<?php include('layout/header.php') ?>
			</header>
			<nav>
				<?php include('layout/nav.php') ?>
			</nav>
			<section role="main">
				<?php include('layout/main.php') ?>
			</section>
			<footer>
				<?php include('layout/footer.php') ?>
			</footer>
		</div>
	</body>
</html>