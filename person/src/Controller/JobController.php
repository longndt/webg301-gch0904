<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobController extends AbstractController
{
    /**
     * @Route("/job/viewall/" , name = "view_all_job")
     */
    public function viewAllJob () {
        $jobs = $this->getDoctrine()->getRepository(job::class)->findAll();
    }

    /**
     * @Route("/job/view/{id}", name = "view_job")
     */
    public function viewJob ($id) {
        
    }

    /**
     * @Route("/job/delete/{id}", name = "delete_job_by_id")
     */
    public function deleteJob ($id) {

    }

    /**
     * @Route("/job/add", name = "add_job")
     */
    public function addJob (Request $request) {

    }

    /**
     * @Route("/job/edit/{id}", name = "edit_job")
     */
    public function editJob (Request $request, $id) {
        
    }
}
