<?php

namespace Core;

class Response
{
    public function json($array, $status = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($status);
        echo json_encode($array);
        exit();
    }
}
