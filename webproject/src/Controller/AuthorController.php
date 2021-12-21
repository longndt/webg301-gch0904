<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/author/{id}', name : 'author_detail')]
    public function authorDetail ($id) {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        if ($author == null) {
            $this->addFlash("Error", "Author not existed");
            return $this->redirect("author_index");
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
    
}
