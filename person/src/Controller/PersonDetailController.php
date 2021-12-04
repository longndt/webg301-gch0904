<?php

namespace App\Controller;

use App\Entity\PersonDetail;
use App\Form\PersonDetailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonDetailController extends AbstractController
{
   /**
    * @Route("/persondetail/add", name = "add_person_detail")
    */
    public function addPersonDetail (Request $request) {
        $personDetail = new PersonDetail;
        $personDetailForm = $this->createForm(PersonDetailType::class,$personDetail);
        $personDetailForm->handleRequest($request);
        if ($personDetailForm->isSubmitted() && $personDetailForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($personDetail);
            $manager->flush();
            return $this->redirectToRoute("view_all_person");
        }
        return $this->renderForm("/person_detail/add.html.twig",
        [
            'personDetailForm' => $personDetailForm
        ]);
    }

    /**
     * @Route("/persondetail/edit/{id}", name = "edit_person_detail")
     */
    public function editPersonDetail (Request $request, $id) {
        $personDetail = $this->getDoctrine()->getRepository(PersonDetail::class)->find($id);
        $personDetailForm = $this->createForm(PersonDetailType::class, $personDetail);
        $personDetailForm->handleRequest($request);
        if ($personDetailForm->isSubmitted() && $personDetailForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($personDetail);
            $manager->flush();
            return $this->redirectToRoute("view_all_person");
        }
        return $this->renderForm("/person_detail/edit.html.twig",
        [
            'personDetailForm' => $personDetailForm
        ]);
    }
}
