<?php
// load validation libphonenumber
require __DIR__ . '/vendor/autoload.php';

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

require "./core/utils.php";


$errors = array();
// taken from https://www.w3schools.com/php/php_form_url_email.asp
if (empty($_POST["name"])) {
    $errors['name'] = "Name is required";
} else {
    $name = Utils::test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors['name'] = "Please enter valid name. Only letters and white space allowed.";
    }
}

// taken from https://www.w3schools.com/php/php_form_url_email.asp
if (empty($_POST["email"])) {
    $errors['email'] = "Email is required";
} else {
    $email = Utils::test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
}

if (empty($_POST["city"])) {
    $errors['city'] = "City is required";
} else {
    $city = Utils::test_input($_POST["city"]);
    // check if city only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
        $errors['city'] = "Please enter valid name of the city. Only letters and white space allowed.";
    }
}

if (empty($_POST["phone"])) {
    $errors['phone'] = "Phone number is required";
} else {
    $phone = Utils::test_input($_POST["phone"]);

    try {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $ph = $phoneUtil->parse($phone);
        if ($phoneUtil->isValidNumber($ph)) {
            $phone = $phoneUtil->format($ph, PhoneNumberFormat::INTERNATIONAL);
        } else {
            $errors['phone'] = "Invalid phone number, use international format like: +420 777 111 222";
        }
    } catch (Exception $e) {
        $errors['phone'] = 'Invalid phone number, use international format like: +420 777 111 222';
    }

}

if (!empty($errors)) {
    // send bad request with validation errors set
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(400);
    echo json_encode(array('validation_errors' => $errors));
} else {
    $app = require "./core/app.php";
    try {
        // Create new instance of user
        $user = new User($app->db);
        // Insert it to database with POST data
        $user->insert(array(
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'phone' => $phone,
        ));
        // Redirect back to index
        header('Location: index.php');
    } catch (Exception $e) {
        header('Content-Type: application/json; charset=utf-8');
        http_send_status(500);
        echo json_encode(array('errors' => $e->getMessage()));
    }
}