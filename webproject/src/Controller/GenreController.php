<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genres", name = "genre_index")
     */
    public function genreIndex() {
        $genres = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        return $this->render("genre/index.html.twig",
        [
            'genres' => $genres
        ]);
    }

    /**
     * @Route("/genre/{id}", name = "genre_detail")
     */
    public function genreDetail($id) {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
        if ($genre == null) {
            $this->addFlash("Error", "Genre not existed");
        }
        return $this->render("genre/detail.html.twig",
        [
            'genre' => $genre
        ]);
    }

    /**
     * @Route("/genre/delete/{id}", name = "genre_delete")
     */
    public function genreDelete($id) {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
        if ($genre == null) {
            $this->addFlash("Error", "Genre delete failed");
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($genre);
            $manager->flush();
            $this->addFlash("Success", "Genre delete succeed");
        }
        return $this->redirectToRoute("genre_index");
    }

    /**
     * @Route("/genre/add", name = "genre_add")
     */
    public function genreAdd(Request $request) {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($genre);
            $manager->flush();

            $this->addFlash("Success", "Add genre succeed");
            return $this->redirectToRoute("genre_index");
        }

        return $this->renderForm("genre/add.html.twig",
        [
            'genreForm' => $form
        ]);
    }

    /**
     * @Route("/genre/edit/{id}", name = "genre_edit")
     */
    public function genreEdit(Request $request, $id) {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($genre);
            $manager->flush();

            $this->addFlash("Success", "Edit genre succeed");
            return $this->redirectToRoute("genre_index");
        }

        return $this->render("genre/edit.html.twig",
        [
            'genreForm' => $form->createView()
        ]);
    }
}
