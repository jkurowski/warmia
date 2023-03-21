<?php

if (! function_exists('boxPlace')) {
    function boxPlace(int $number)
    {
        switch ($number) {
            case '1':
                return 'O inwestycji';
            case '2':
                return 'W pigułce';
            case '3':
                return 'Boksy na tle';
            case '4':
                return 'Standard';
            case '5':
                return 'Udogodnienia';
        }
    }
}
