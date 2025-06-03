<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function ok(mixed $data = null)
    {
        return [
            'data' => $data,
        ];
    }
}
