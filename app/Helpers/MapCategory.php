<?php

if (! function_exists('mapCategory')) {
    function mapCategory(int $number)
    {
        switch ($number) {
            case '1':
                return "Inwestycja";
            case '2':
                return "Stadion";
            case '3':
                return "Piekarnia";
            case '4':
                return "Apteka";
            case '5':
                return "Sklep";
            case '6':
                return "Stacja paliw";
            case '7':
                return "Restauracja";
            case '8':
                return "Przedszkole";
            case '9':
                return "Szkoła";
            case '10':
                return "Kościół";
        }
    }
}