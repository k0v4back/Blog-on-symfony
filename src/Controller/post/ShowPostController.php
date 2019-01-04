<?php

namespace App\Controller\post;

use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowPostController extends AbstractController
{
    /**
     * @Route("/manage/post/show/{id}", name="manage_post_show")
     * @IsGranted("ROLE_ADMIN")
     */
    public function postShow($id)
    {
        $doctrine = $this->getDoctrine()->getManager();
        $post = $doctrine->getRepository(Post::class)->findOneBy(array('id' => $id));

        if($post != null){
            return $this->render('post/showPost.html.twig', [
                'post' => $post
            ]);
        }
    }
}