<?php

/** Check Input Error */

if (!function_exists('hasError')) {
    function hasError($errors, string $name): ?String
    {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}

/** Set Sidebar Active */

if (!function_exists('setSidebarActive')) {

    function setSidebarActive(array $routes): ?String
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }

        return '';
    }
}
