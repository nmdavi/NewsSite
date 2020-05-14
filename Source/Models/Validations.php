<?php

namespace Source\Models;

class Validations
{
    static function validateName($value)
    {
        $special_chars = preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~°ºª\\\\]/', $value);
        $numbers = preg_match('/[0-9]/', $value);

        if (!empty($value) && isset($value) && !$special_chars && $numbers === false) {
            $value = preg_replace("/\s+/", " ", $value); // substitue espaço duplo por um.
            $value = htmlspecialchars(addslashes(trim(strip_tags($value))));

            if (strpos($value, '/') || strlen($value) > 45) {
                return false;
            }

            return $value;
        }

        return false;
    }

    static function validateEmail($value)
    {
        if (!empty($value) && isset($value)) {
            $value = filter_var($value, FILTER_SANITIZE_EMAIL);
            $value = trim($value);

            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            return $value;
        }

        return false;
    }
}
