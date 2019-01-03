<?php

namespace App\Controller\post;

use App\Entity\Post;
use App\Form\post\PostCreateFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends AbstractController
{
    /**
     * @Route("/manage/post", name="manage_post")
     * @IsGranted("ROLE_ADMIN")
     */
    public function managePosts(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostCreateFormType::class, $post);
        $form->handleRequest($request);

        return $this->render('cabinet/createPost.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}