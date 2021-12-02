<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
      /**
     * @Route("/car/viewall/" , name = "view_all_car")
     */
    public function viewAllCar () {
        $cars = $this->getDoctrine()->getRepository(car::class)->findAll();
        return $this->render("car/index.html.twig",
            [
                'cars' => $cars
            ]
        );
    }

    /**
     * @Route("/car/view/{id}", name = "view_car")
     */
    public function viewCar ($id) {
        $car = $this->getDoctrine()->getRepository(car::class)->find($id);
        return $this->render("car/detail.html.twig",
            [
                'car' => $car
            ]
        );
    }

    /**
     * @Route("/car/delete/{id}", name = "delete_car_by_id")
     */
    public function deleteCar ($id) {

    }

    /**
     * @Route("/car/add", name = "add_car")
     */
    public function addCar (Request $request) {

    }

    /**
     * @Route("/car/edit/{id}", name = "edit_car")
     */
    public function editCar (Request $request, $id) {
        
    }
}