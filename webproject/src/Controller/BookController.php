<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
    * @Route("/getbooklist", methods="GET", name="book_list_api")
    */
    public function getBookList() : JsonResponse {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->json(['books' => $books], 200);
    }
   
    /**
    * @Route("/books", name="book_index")
    */
    public function bookIndex() {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render("book/index.html.twig",
        [
            'books' => $books
        ]);
    }

    /**
     * @Route("/book/detail/{id}", name="book_detail")
     */
    public function bookDetail($id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        if ($book == null) {
            $this->addFlash("Error", "Book not exist");
            return $this->redirectToRoute("book_index");
        }
        return $this->render("book/detail.html.twig",
        [
            'book' => $book
        ]);
    }

    /** 
     * @Route("/book/delete/{id}", name="book_delete")
     */
    public function bookDelete($id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        if ($book == null) {
            $this->addFlash("Error", "Book delete failed");  
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($book);
            $manager->flush();
            $this->addFlash("Success", "Book delete succeed"); 
        }
        return $this->redirectToRoute("book_index");
    }

    /**
     * @Route("/book/add", name="book_add")
     */
    public function bookAdd(Request $request) {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($book);
            $manager->flush();

            $this->addFlash("Success", "Add book succeed");
            return $this->redirectToRoute("book_index");
        }

        return $this->renderForm("book/add.html.twig",
        [
            'bookForm' => $form
        ]);
    }

    /**
     * @Route("/book/edit/{id}", name="book_edit")
     */
    public function bookEdit(Request $request, $id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($book);
            $manager->flush();

            $this->addFlash("Success", "Edit book succeed");
            return $this->redirectToRoute("book_index");
        }

        return $this->renderForm("book/edit.html.twig",
        [
            'bookForm' => $form
        ]);
    }

}
