<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/hanoi', name: 'hanoi_route')]
    public function hanoiAction ()  {
        $hanoi = "Ha Noi";
        $vietnam = "Viet Nam";
        return $this->render(
            '/home/hanoi.html.twig',
        [
           'hn' => $hanoi,
           'vn' => $vietnam
        ]
    );
    }
}
