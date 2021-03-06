<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\throwException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BookController extends AbstractController
{
    /**
    * @Route("/booklist", methods="GET", name="book_list_api")
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
     * @IsGranted("ROLE_STAFF")
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
     * @IsGranted("ROLE_ADMIN")
     * @Route("/book/add", name="book_add")
     */
    public function bookAdd(Request $request) {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           //code x??? l?? vi???c upload ???nh
           //B1: l???y ???nh t??? file upload
           $image = $book->getCover();
           //B2: ?????t t??n m???i cho ???nh => ?????m b???o m???i ???nh s??? c?? 1 t??n duy nh???t
           $imgName = uniqid(); //unique id
           //B3: l???y ??u??i ???nh (image extension)
           $imgExtension = $image->guessExtension();
           //Note: c???n edit code l???i trong file Book Entity (Book.php)
           //B4: n???i t??n m???i & ??u??i ???nh th??nh t??n ho??n ch???nh ????? l??u v??o DB & th?? m???c
           $imageName = $imgName . "." . $imgExtension;
           //B5: di chuy???n ???nh v??o th?? m???c ch??? ?????nh
           try {
             $image->move(
                 $this->getParameter('book_cover'), $imageName
                 /* Note: c???n khai b??o ???????ng d???n th?? m???c ch???a ???nh
                 ??? file config/services.yaml */
             );  
           } catch (FileException $e) {
               throwException($e);
           }
           //B6: l??u t??n ???nh v??o DB
           $book->setCover($imageName);
       
            //?????y d??? li???u t??? form v??o DB
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($book);
            $manager->flush();

            //hi???n th??? th??ng b??o v?? redirect v??? trang book index
            $this->addFlash("Success", "Add book succeed");
            return $this->redirectToRoute("book_index");
        }

        return $this->renderForm("book/add.html.twig",
        [
            'bookForm' => $form
        ]);
    }

    /**
     * @IsGranted("ROLE_STAFF")
     * @Route("/book/edit/{id}", name="book_edit")
     */
    public function bookEdit(Request $request, $id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //code x??? l?? vi???c upload ???nh
            //B1: l???y d??? li???u ???nh t??? form
            $file = $form['cover']->getData();
            //B2: check xem ???nh c?? null kh??ng
            if ($file != null) { //ng?????i d??ng update ???nh m???i
                //B3: l???y ???nh t??? file upload
                $image = $book->getCover();
                //B4: ?????t t??n m???i cho ???nh
                $imgName = uniqid();
                //B5: l???y extension c???a file ???nh
                $imgExtension = $image->guessExtension();
                //B6: n???i t??n m???i v?? extension th??nh t??n file ho??n ch???nh
                $imageName = $imgName . "." . $imgExtension;
                //B7: di chuy???n ???nh v??o th?? m???c project
                try {
                    $image->move($this->getParameter('book_cover'), $imageName);
                } catch (FileException $e) {
                    throwException($e);
                }
                //B8: l??u t??n ???nh v??o DB
                $book->setCover($imageName);
            }

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

    /**
     * @Route("/book/sort/id/asc", name="sort_book_id_asc")
     */
    public function sortBookByIdAsc (BookRepository $bookRepository) {
        $books = $bookRepository->sortBookIdAsc();
        return $this->render("book/index.html.twig",
        [
            'books' => $books
        ]);
    }

     /**
     * @Route("/book/sort/id/desc", name="sort_book_id_desc")
     */
    public function sortBookByIdDesc (BookRepository $bookRepository) {
        $books = $bookRepository->sortBookIdDesc();
        return $this->render("book/index.html.twig",
        [
            'books' => $books
        ]);
    }

    /**
     * @Route("/book/search", name="search_book_by_title")
     */
    public function searchBookByTitle (BookRepository $bookRepository, Request $request) {
        $title = $request->get("title");
        $books = $bookRepository->searchByTitle($title);
        return $this->render("book/index.html.twig",
        [
            'books' => $books
        ]);
    }
}
