<?php

namespace App\Controller;

use App\Entity\Car;
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
        $cars = $this->getDoctrine()->getRepository(Car::class)->findAll();
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
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
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
       $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($car);
       $manager->flush();
       return $this->redirectToRoute("view_all_car");
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
