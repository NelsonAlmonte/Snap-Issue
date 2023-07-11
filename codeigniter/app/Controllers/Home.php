<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function capture(): string
    {
        return view('template/header') . 
            view('capture') .
            view('template/footer');
    }

    public function onboarding(): string
    {
        return view('onboarding');
    }
}
