<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Time Table Manager</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
</head>

<body class="has-navbar-fixed-top">
	<div id="app">
	</div>

	<script src="<?php echo e(mix('js/app.js')); ?>"></script>
</body>

</html>
