<?php

use App\Route;

(new Route)->get('/', function() {
	echo "welcome";
});

(new Route)->get('/home', function() {
	echo "home";
});

(new Route)->get('/settings', function() {
	echo "settings";
});