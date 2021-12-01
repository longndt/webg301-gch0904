<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
     /**
      * @Route("/person/add", name = "add_person")
      */
      public function addPerson (Request $request) {
         $personForm = $this->createForm(PersonType::class);
         $personForm->handleRequest($request);
         if ($personForm->isSubmitted() && $personForm->isValid()) {
            $person = $personForm->getData();
            $name = $person->getName();
            $age = $person->getAge();
            $birthday = $person->getBirthday();
            $gender = $person->getGender();

            //code add dữ liệu vào DB
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();

            return $this->redirectToRoute("view_person",
            [
               'name' => $name,
               'age' => $age,
               'birthday' => $birthday,
               'gender' => $gender
            ]);
         }
         return $this->renderForm("person/add.html.twig",
         [
            'personForm' => $personForm
         ]);
      }

      /**
       * @Route("/person/view", name = "view_person")
       */
      public function viewPerson (Request $request) {
         $name = $request->query->get("name");
         $age = $request->query->get("age");
         $birthday = $request->query->get("birthday");
         $gender = $request->query->get("gender");

         return $this->render("person/view.html.twig",
            [
               'name' => $name,
               'age' => $age,
               'birthday' => $birthday,
               'gender' => $gender
            ]
      );
      }
}
