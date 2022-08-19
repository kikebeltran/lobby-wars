<?php

namespace App\Controller\LobbyWars;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    public function index()
    {

        return $this->render('signature/index.html.twig');

    }

}

