<?php

namespace App\Controller;

use App\Entity\Job;
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
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();
        return $this->render("job/index.html.twig",
        [
            'jobs' => $jobs
        ]);
    }

    /**
     * @Route("/job/view/{id}", name = "view_job")
     */
    public function viewJob ($id) {
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);
        return $this->render("job/detail.html.twig",
        [
            'job' => $job
        ]);
    }

    /**
     * @Route("/job/delete/{id}", name = "delete_job_by_id")
     */
    public function deleteJob ($id) {
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($job);
        return $this->redirectToRoute("view_all_job");
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
