<?php

$app = require "./core/app.php";

// Create new instance of user
$user = new User($app->db);

// TODO: add server side validation here, validate data in $_POST

// Insert it to database with POST data
$user->insert(array(
	'name' => $_POST['name'],
	'email' => $_POST['email'],
	'city' => $_POST['city'],
    'phone' => $_POST['phone'],
));

// Now we should get all users from the database to refresh the view
$users = $user::find($app->db, '*');
// and respond with JJSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode(array('users' => $users));

