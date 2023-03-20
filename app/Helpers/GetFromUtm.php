<?php

if (! function_exists('getFromUtm')) {
    if (! function_exists('getFromUtm')) {
        function getFromUtm($array, $param)
        {
            foreach($array->toArray() as $item){
                if($item['argument'] == $param){

                    if($param == 'fbclid' || $param == 'gclid') {
                        return '('.$param.') '.$item['value'];
                    } else {
                        return $item['value'];
                    }
                }
            }
        }
    }
}
