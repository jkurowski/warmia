<?php

if (! function_exists('roomStatus')) {
    function roomStatus(int $number)
    {
        $statuses = [
            1 => __('cms.available'),
            2 => __('cms.reservation'),
            3 => __('cms.sold'),
            4 => __('cms.rented'),
        ];

        return $statuses[$number] ?? null;
    }
}
