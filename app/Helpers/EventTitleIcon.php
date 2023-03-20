<?php

use Illuminate\Support\Str;

if (! function_exists('eventTitleIcon')) {
    function eventTitleIcon(int $number, string $title)
    {
        switch ($number) {
            case 2:
                $name = '<i class="las la-user-tie"></i> '.$title;
                break;
            case 3:
                $name = '<i class="las la-clock"></i> '.$title;
                break;
            case 4:
                $name = '<i class="lab la-font-awesome-flag"></i> '.$title;
                break;
            case 5:
                $name = '<i class="las la-envelope"></i> '.$title;
                break;
            case 6:
                $name = '<i class="las la-utensils"></i> '.$title;
                break;
            default:
                $name = '<i class="las la-phone"></i> '.$title;
                break;
        }
        return $name;
    }
}
