<?php

/*
* This is template of database config.
* Fill out database configuration options below and rename this file to 'database.php'
*/

function envOrDefault($var, $default) {
    $env = getenv($var);
    return !$env ? $default : $env;
}
// local defaults from docker-compose.tml
$database = array(
	'address' 	=> envOrDefault('DB_ADDRESS', 'localhost:3306'),
	'username'	=> envOrDefault('DB_USER', 'root'),
	'password'	=> envOrDefault('DB_PASSWORD', 'local'),
	'database'	=> envOrDefault('DB_DATABASE', 'app')
);
