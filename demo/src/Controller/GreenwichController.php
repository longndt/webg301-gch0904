<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreenwichController extends AbstractController
{
    /**
     * @Route("/gw/gch0904", name = "gw_route")
     */
    public function index(): Response
    {
        $greenwich = "Dai hoc Greenwich Vietnam";
        $fpt = "Dai hoc FPT";
        $year = 2021;
        $sports = array('football','badminton','running');
       
        return $this->render('greenwich/index.html.twig', 
        [
            'sports' => $sports,
            'fpt' => $fpt,
            'year' => $year,
            'gw' => $greenwich
        ]);
    }
    #[Route('/symfony', name: 'symfony_route')]
    public function test() {
        return $this->render('greenwich/symfony.html');
    }
}
