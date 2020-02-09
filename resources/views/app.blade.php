<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Time Table Manager</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="has-navbar-fixed-top">
	<div id="app">
	</div>

	<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
