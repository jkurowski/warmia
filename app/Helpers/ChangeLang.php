<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('changeLang')) {
    function changeLang($lang)
    {
        $route = Route::getCurrentRoute();
        $routeName = $route->getName();
        $parameters = $route->parameters();
        $parameters['locale'] = $lang;

        return route($routeName, $parameters);
    }
}