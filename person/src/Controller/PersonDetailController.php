<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class person_detailDetailController extends AbstractController
{
    /**
     * @Route("/person_detail/view/{id}", name = "view_person_detail")
     */
    public function viewPersonDetail ($id) {
        
    }

    /**
     * @Route("/person_detail/delete/{id}", name = "delete_person_detail_by_id")
     */
    public function deletePersonDetail ($id) {

    }

    /**
     * @Route("/person_detail/add", name = "add_person_detail")
     */
    public function addPersonDetail (Request $request) {

    }

    /**
     * @Route("/person_detail/edit/{id}", name = "edit_person_detail")
     */
    public function editPersonDetail (Request $request, $id) {
        
    }
}
