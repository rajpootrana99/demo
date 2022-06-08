<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data['title'] = "Home";
        return view('templates/header', $data)
            . view('pages/home')
            . view('templates/footer');
    }

    public function view($page = 'home')
    {
        // ...
    }
}