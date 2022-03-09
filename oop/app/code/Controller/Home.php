<?php

declare(strict_types=1);
namespace Controller;

use Core\AbstractController;
use Core\Interfaces\ControllerInterface;
use Model\Ad;
use Model\Message as MessageModel;

class Home extends AbstractController implements ControllerInterface
{
    public function index(): void
    {
        $this->data['popular'] = Ad::getPopularOne(5);
        $this->data['newest'] = Ad::getNewest(5);
        $this->render('parts/home');

    }
}