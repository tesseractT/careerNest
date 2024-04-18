<?php

/** Check Input Error */

if (!function_exists('hasError')) {
    function hasError($errors, string $name) : ?String
    {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}
