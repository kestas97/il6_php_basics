<?php

namespace Controller;

use Core\AbstractController;
use Model\Ad;

class Home extends AbstractController
{
    public function index()
    {
        $this->data['popular'] = Ad::getPopularOne(5);
        $this->data['newest'] = Ad::getNewest(5);
        $this->render('parts/home');

    }
}
