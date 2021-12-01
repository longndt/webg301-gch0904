<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/task/add", name = "add_task")
     */
    public function addTask (Request $request) {
        $task = new Task();
        $taskForm = $this->createFormBuilder($task)
                         ->add('Title', TextType::class,
                                [
                                    'label' => 'Title of task',
                                    'required' => false  //nullable = true
                                ]
                         )
                         ->add('Content', TextType::class,
                                [
                                    'attr' => [
                                        'minlength' => 10,
                                        'maxlength' => 20
                                    ]
                                ]
                          )
                         ->add('DueDate', DateType::class,
                                [
                                    'widget' => 'single_text'
                                ]
                         )
                         ->add('Add', SubmitType::class)
                         ->getForm()
        ;
        $taskForm->handleRequest($request);
        if ($taskForm->isSubmitted() && $taskForm->isValid()) {
            $data = $taskForm->getData();
            $title = $data->Title;
            $content = $data->Content;
            $duedate = $data->getDueDate();
            return $this->render("task/view.html.twig",
            [
                'title' => $title,
                'content' => $content,
                'duedate' => $duedate
            ]);
        }
        return $this->render("task/add.html.twig",
        [
            'taskForm' => $taskForm->createView()
        ]);
    }
}
