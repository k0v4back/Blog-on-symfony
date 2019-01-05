<?php

namespace App\Controller\post;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DisplayOnePostController extends AbstractController
{
    /**
     * @Route("post/{id}", name="show_one_post", requirements={"id"="\d+"})
     */
    public function showPost($id)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findPostById($id);

        if ($post != null){
            return $this->render('post/displayOnePost.html.twig', [
                'post' => $post[0]
            ]);
        }else{
            return $this->redirectToRoute('main');
        }
    }

}