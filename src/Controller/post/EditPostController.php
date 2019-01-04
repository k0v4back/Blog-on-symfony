<?php

namespace App\Controller\post;

use App\Entity\Post;
use App\Form\post\PostEditFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditPostController extends AbstractController
{
    /**
     * @Route("/manage/post/edit/{id}", name="manage_post_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editPost(Request $request, $id)
    {
        $doctrine = $this->getDoctrine()->getManager();
        $post = $doctrine->getRepository(Post::class)->findOneBy(array('id' => $id));

        if ($post != null){

            $form = $this->createForm(PostEditFormType::class, $post);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    'Post successfully edited!!'
                );
                return $this->redirectToRoute('manage_post');
            }
            return $this->render('post/editPost.html.twig', array(
                'form' => $form->createView(),
            ));
        }
        return $this->redirectToRoute('manage_post');
    }
}