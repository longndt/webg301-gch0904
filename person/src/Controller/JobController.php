<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
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
        if ($job != null) {
            return $this->render("job/detail.html.twig",
            [
                'job' => $job
            ]);
        } else {
            return $this->redirectToRoute("view_all_job");
        }
    }

    /**
     * @Route("/job/delete/{id}", name = "delete_job_by_id")
     */
    public function deleteJob ($id) {
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);
        if ($job != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($job);
            $manager->flush();
        }
        return $this->redirectToRoute("view_all_job");
    }

    /**
     * @Route("/job/add", name = "add_job")
     */
    public function addJob (Request $request) {
        $job = new Job;
        $jobForm = $this->createForm(JobType::class, $job);
        $jobForm->handleRequest($request);
        if ($jobForm->isSubmitted() && $jobForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($job);
            $manager->flush();
            return $this->redirectToRoute("view_all_job");
        } 
        return $this->renderForm("job/add.html.twig",
        [
            'jobForm' => $jobForm
        ]);
    }

    /**
     * @Route("/job/edit/{id}", name = "edit_job")
     */
    public function editJob (Request $request, $id) {
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);
        $jobForm = $this->createForm(JobType::class, $job);
        $jobForm->handleRequest($request);
        if ($jobForm->isSubmitted() && $jobForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($job);
            $manager->flush();
            return $this->redirectToRoute("view_all_job");
        } 
        return $this->renderForm("job/edit.html.twig",
        [
            'jobForm' => $jobForm
        ]);
    }
}
