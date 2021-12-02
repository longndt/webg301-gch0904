<?php

namespace App\Controller;

use App\Entity\PersonDetail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class person_detailDetailController extends AbstractController
{
    /**
     * @Route("/persondetail/view/{id}", name = "view_person_detail")
     */
    public function viewPersonDetail ($id) {
        $person = $this->getDoctrine()->getRepository(PersonDetail::class)->find($id);
        return $this->render("person/detail.html.twig",
        [
            'person' => $person
        ]
    );
    }

    /**
     * @Route("/persondetail/delete/{id}", name = "delete_person_detail_by_id")
     */
    public function deletePersonDetail ($id) {

    }

    /**
     * @Route("/persondetail/add", name = "add_person_detail")
     */
    public function addPersonDetail (Request $request) {

    }

    /**
     * @Route("/persondetail/edit/{id}", name = "edit_person_detail")
     */
    public function editPersonDetail (Request $request, $id) {
        
    }
}
