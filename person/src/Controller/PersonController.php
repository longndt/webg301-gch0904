<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\PersonDetail;
use App\Form\PersonType;
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
        if ($person != null) {
            return $this->render("person/detail.html.twig",
            [
                'person' => $person
            ]
            );
        } else {
            return $this->redirectToRoute("view_all_person");
        }     
    }

    /**
     * @Route("/person/delete/{id}", name = "delete_person_by_id")
     */
    public function deletePerson ($id) {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        if ($person != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($person);
            $manager->flush();
        }
        return $this->redirectToRoute("view_all_person");
    }

    /**
     * @Route("/person/add", name = "add_person")
     */
    public function addPerson (Request $request) {
        $person = new Person;
        $personForm = $this->createForm(PersonType::class, $person);
        $personForm->handleRequest($request);
        if ($personForm->isSubmitted() && $personForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();
            return $this->redirectToRoute("view_all_person");
        }
        return $this->renderForm("person/add.html.twig",
        [
            'personForm' => $personForm
        ]);
    }

    /**
     * @Route("/person/edit/{id}", name = "edit_person")
     */
    public function editPerson (Request $request, $id) {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);
        $personForm = $this->createForm(PersonType::class, $person);
        $personForm->handleRequest($request);
        if ($personForm->isSubmitted() && $personForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();
            return $this->redirectToRoute("view_all_person");
        }
        return $this->renderForm("person/edit.html.twig",
        [
            'personForm' => $personForm
        ]);
    }
}
