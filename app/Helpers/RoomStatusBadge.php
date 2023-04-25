<?php

if (! function_exists('roomStatusBadge')) {
    function roomStatusBadge(int $number)
    {
        $statuses = [
            1 => __('cms.available'),
            2 => __('cms.reservation'),
            3 => __('cms.sold'),
            4 => __('cms.rented'),
        ];

        $statusClass = 'list-status-' . $number;

        return sprintf('<span class="list-status %s">%s</span>', $statusClass, $statuses[$number] ?? '');
    }
}
