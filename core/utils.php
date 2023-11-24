<?php

// https://www.w3schools.com/php/php_form_validation.asp
class Utils
{
    public static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}