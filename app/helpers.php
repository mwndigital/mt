<?php

use Illuminate\Support\Str;

if(!function_exists('generate_excerpt')){
    function generate_excerpt($content, $limit = 120) {
        //Strip HTML tags
        $text = strip_tags($content);

        //Limit the number
        $excerpt = Str::limit($text, $limit);

        return $excerpt;
    }
}
