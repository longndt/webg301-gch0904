<?php

namespace App\Controller;

use App\Entity\Blog;
use phpDocumentor\Reflection\Types\Resource_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Regex;

class BlogController extends AbstractController
{
  //   SELECT * FROM Blog;
  #[Route('/blog/viewall', methods: 'GET', name: 'view_all_blog')]
  public function viewAllBlogAction (SerializerInterface $serializer) {
    //lấy dữ liệu từ DB và lưu vào array
    $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
    //convert dữ liệu thành chuẩn JSON (XML)
    $json = $serializer->serialize($blogs,'json');
    $xml = $serializer->serialize($blogs,'xml');
    //trả về API thông qua Response
    return new Response($json,
                        Response::HTTP_OK,  //200
                        [
                            'content-type' => 'application/json'
                        ]
    );
  }

   //   SELECT * FROM Blog WHERE blog_id = '$id';
  /**
   * @Route("/blog/view/{id}", methods = {"GET"}, name = "view_blog_by_id")
   */
  public function viewBlogByIdAction (SerializerInterface $serializer, $id) {
    $blog = $this->getDoctrine()->getRepository(Blog::class)->find($id); 
    //trả về thông báo lỗi nếu không tìm thấy Blog ID 
    if ($blog == null) {
        $error = "Blog not found !";
        return new Response($error,
                    Response::HTTP_NOT_FOUND //404
    );
    }
    $xml = $serializer->serialize($blog, 'xml');
    return new Response($xml,
                        Response::HTTP_OK, //200
                        [
                            'content-type' => 'application/xml'
                        ]
    );
  }

  /**
   * @Route("/blog/delete/{id}", methods = {"DELETE"}, name = "delete_blog_api")
   */
   public function deleteBlogAction ($id) {
       $blog = $this->getDoctrine()->getRepository(Blog::class)->find($id);
       if ($blog == null) {
           $error = "Blog not found";
           return new Response($error,
                    Response::HTTP_BAD_REQUEST,  //400
                    [
                        'content-type' => 'text/html'
                    ]
           );
       }
       //gọi đến Manager để xóa dữ liệu khỏi DB
       $manager = $this->getDoctrine()->getManager();
       $manager->remove($blog);
       $manager->flush();
       return new Response("delete success",
                            Response::HTTP_ACCEPTED //204
    );
   }

   #[Route('/blog/add', methods: 'POST', name: 'add_blog_api')]
   public function addBlogAction (Request $request) {
       try {
            $blog = new Blog();
            $data = json_decode($request->getContent(),true);
            $blog->setTitle($data['Title']);
            $blog->setContent($data['Content']);
            $blog->setAuthor($data['Author']);
            $blog->setDate(\DateTime::createFromFormat('Y-m-d',$data['Date']));

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();

            return new Response("add success", Response::HTTP_CREATED); //code: 201
       } catch(\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST); //code: 400
       }
   }

   #[Route('/blog/edit/{id}', methods: 'PUT', name: 'edit_blog_api')]
   public function editBlogAction (Request $request, $id) {
        try {
            $blog = $this->getDoctrine()->getRepository(Blog::class)->find($id);
            if ($blog == null) {
                return new Response (null, Response::HTTP_BAD_REQUEST);
            }
            $data = json_decode($request->getContent(),true);
            $blog->setTitle($data['Title']);
            $blog->setContent($data['Content']);
            $blog->setAuthor($data['Author']);
            $blog->setDate(\DateTime::createFromFormat('Y-m-d',$data['Date']));

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();

            return new Response("edit success"); //code: 204
    } catch(\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST); //code: 400
    }
   }

}
