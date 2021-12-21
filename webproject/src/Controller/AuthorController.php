<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/authors', name : 'author_index')]
    public function authorIndex () {
        $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();
        return $this->render("author/index.html.twig",
        [
            'authors' => $authors
        ]);
    }

    #[Route('/author/detail/{id}', name : 'author_detail')]
    public function authorDetail ($id) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        if ($author == null) {
            $this->addFlash("Error", "Author not existed");
            return $this->redirectToRoute("author_index");
        } 
        return $this->render("author/detail.html.twig",
        [
            'author' => $author
        ]);
    }

    #[Route('/author/delete/{id}', name : 'author_delete')]
    public function authorDelete ($id) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        if ($author == null) {
            $this->addFlash("Error", "Author delete failed");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($author);
            $manager->flush();
            $this->addFlash("Success", "Author delete succeed");
        }
        return $this->redirectToRoute('author_index');
    }
    
    #[Route('/author/add', name : 'author_add')]
    public function authorAdd (Request $request) {
        $author = new Author();
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($author);
            $manager->flush();

            $this->addFlash("Success", "Add author succeed");
            return $this->redirectToRoute("author_index");
        }

        return $this->renderForm("author/add.html.twig",
        [
            'authorForm' => $form
        ]);
    }

    #[Route('/author/edit/{id}', name : 'author_edit')]
    public function authorEdit (Request $request, $id) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($author);
            $manager->flush();

            $this->addFlash("Scccess", "Edit author succeed");
            return $this->redirectToRoute("author_index");
        }

        return $this->renderForm("author/edit.html.twig",
        [
            'authorForm' => $form
        ]);
    }
}
