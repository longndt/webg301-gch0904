<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CarController extends AbstractController
{
    /**
     * @Route("/car/viewall/" , name = "view_all_car")
     */
    public function viewAllCar() 
    {
        $cars = $this->getDoctrine()->getRepository(Car::class)->findAll();
        return $this->render(
            "car/index.html.twig",
            [
                'cars' => $cars
            ]
        );
        // return $this->json(
        //     ['cars' => $cars ]
        // );
    }

    /**
     * @Route("/car/view/{id}", name = "view_car")
     */
    public function viewCar($id)
    {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        if ($car != null) {
            return $this->render(
                "car/detail.html.twig",
                [
                    'car' => $car
                ]
            );
        } else {
            return $this->redirectToRoute("view_all_car");
        }
    }

    /**
     * @Route("/car/delete/{id}", name = "delete_car_by_id")
     */
    public function deleteCar($id)
    {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        if ($car != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($car);
            $manager->flush();
        }
        return $this->redirectToRoute("view_all_car");
    }

    /**
     * @Route("/car/add", name = "add_car")
     */
    public function addCar(Request $request)
    {
        $car = new Car;
        $carForm = $this->createForm(CarType::class, $car);
        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($car);
            $manager->flush();
            return $this->redirectToRoute("view_all_car");
        }
        return $this->renderForm(
            "car/add.html.twig",
            [
                'carForm' => $carForm
            ]
        );
    }

    /**
     * @Route("/car/edit/{id}", name = "edit_car")
     */
    public function editCar(Request $request, $id)
    {
        $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
        $carForm = $this->createForm(CarType::class, $car);
        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($car);
            $manager->flush();
            return $this->redirectToRoute("view_all_car");
        }
        return $this->render(
            "car/edit.html.twig",
            [
                'carForm' => $carForm->createView()
            ]
        );
    }

    /**
     * @Route("/car/sort/price/desc", name = "sort_price_desc_car")
     */
    public function sortCarPriceDesc()
    {
        $manager = $this->getDoctrine()->getManager();
        $query = $manager->createQuery(
            "
                SELECT c
                FROM App\Entity\Car c
                ORDER BY c.CarPrice DESC
            "
        );
        $result = $query->getResult();
        return $this->render("car/index.html.twig",
        [
            'cars' => $result
        ]);  
    }

    /**
     * @Route("/car/sort/price/asc", name = "sort_price_asc_car")
     */
    public function sortCarPriceAsc(CarRepository $repository) {
        $result = $repository->sortPriceAsc();
        return $this->render("car/index.html.twig",
        [
            'cars' => $result
        ]);                              
    }

    /**
     * @Route("/car/sort/model/asc", name = "sort_model_asc_car")
     */
    public function sortCarModelAsc(CarRepository $carRepository) {
        $result = $carRepository->sortModelAsc();
        return $this->render("car/index.html.twig",
        [
            "cars" => $result
        ]);
    }

     /**
     * @Route("/car/sort/model/desc", name = "sort_model_desc_car")
     */
    public function sortCarModelDesc(CarRepository $carRepository) {
        $result = $carRepository->sortModelDesc();
        return $this->render("car/index.html.twig",
        [
            "cars" => $result
        ]);
    }

    /**
     * @Route("/car/search", name = "sort_by_name_car")
     */
    public function sortCar (CarRepository $carRepository, Request $request) {
        $name = $request->get("name");
        $result = $carRepository->searchByName($name);
        return $this->render("car/index.html.twig",
        [
            "cars" => $result
        ]);
    }
}
