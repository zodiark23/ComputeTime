<?php

/**
 * Converts seconds into readable word.
 * > After 24 hours will show the exact date.
 */
function relativeTime($seconds){
    $raw = floor($seconds / 60);

    $min = round($raw, 2);

    $hour = round(($min / 60),2);

    $word = "";

    if($hour >= 1){
        if($hour <= 1){
            $word = "an hour ago";
        }elseif($hour <= 24){
            $word = floor($hour)." hours ago";
        }else{
            $word = "default";
        }
    }elseif($min >= 1){
        if($min <= 1){
            $word = "a minute ago";
        }else{
            $word = round($min,2)." minutes ago";
        }
    }elseif($min <= 1 && $seconds < 60){
        $word = "just now";
    }

    return $word;
}

?>
