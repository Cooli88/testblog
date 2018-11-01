<?php

namespace Controllers;

class Admin extends \App\Controller
{
    public function index ()
    {
        return $this->render('Admin');
    }
}