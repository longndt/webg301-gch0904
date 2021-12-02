<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonController extends AbstractController
{
    /**
     * @Route("/person/viewall/" , name = "view_all_person")
     */
    public function viewAllPerson () {
        $persons = $this->getDoctrine()->getRepository(Person::class)->findAll();
        return $this->render("person/index.html.twig",
            [
                'persons' => $persons
            ]
        );
    }

    /**
     * @Route("/person/view/{id}", name = "view_person")
     */
    public function viewPerson ($id) {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        return $this->render("person/view.html.twig",
            [
                'person' => $person
            ]
        );
    }

    /**
     * @Route("/person/delete/{id}", name = "delete_person_by_id")
     */
    public function deletePerson ($id) {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($person);
        $manager->flush();
        return $this->redirectToRoute("view_all_person");
    }

    /**
     * @Route("/person/add", name = "add_person")
     */
    public function addPerson (Request $request) {

    }

    /**
     * @Route("/person/edit/{id}", name = "edit_person")
     */
    public function editPerson (Request $request, $id) {
        
    }
}
