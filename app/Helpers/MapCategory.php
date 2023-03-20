<?php

if (! function_exists('mapCategory')) {
    function mapCategory(int $number)
    {
        switch ($number) {
            case '1':
                return "Inwestycja";
            case '2':
                return "Park / skwer";
            case '3':
                return "Restauracja";
            case '4':
                return "Edukacja";
            case '5':
                return "Kościół";
            case '6':
                return "Sklep spożywczy";
            case '7':
                return "Sport";
            case '8':
                return "Zdrowie";
            case '9':
                return "Paczkomat";
            case '10':
                return "Inne";
        }
    }
}
