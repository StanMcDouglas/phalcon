<?php
namespace Library;

class Helpers {

public static function cutWithWords($text, $length, $end) {
    $textLength = strlen($text);
    if ($textLength <= $length) {
        return $text;
    }
    while($text[$length] != ' ' && $length < $textLength) {
        $length++;
    }
    return substr($text, 0, $length).$end;
}


}