<?php

namespace App\Helpers;

class ResponseDataBuilder
{
    public static function buildWithData($message, $data){
        return [
            "message" => $message,
            "data" => $data,
        ];
    }

    public static function buildWithoutData($message){
        return [
            "message" => $message,
        ];
    }
}
