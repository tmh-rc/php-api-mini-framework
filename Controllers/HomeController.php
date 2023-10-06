<?php

namespace Controllers;

class HomeController
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello, Welcome',
        ]);
    }
}
