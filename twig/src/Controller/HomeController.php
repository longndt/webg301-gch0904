<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/demo', name: 'demo')]
    public function demo() {
        return $this->render("home/demo.html.twig");
    }

    #[Route('/greenwich', name: 'greenwich')]
    public function greenwich() {
        return $this->render("home/greenwich.html.twig");
    }
}
