<?php

namespace App\Controller\post;

use App\Entity\Post;
use App\Form\post\PostCreateFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeletePostController extends AbstractController
{
    /**
     * @Route("/manage/post/delete/{id}", name="manage_post_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function managePosts($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository(Post::class)->findOneBy(array('id' => $id));

        if ($entity != null){
            $em->remove($entity);
            $em->flush();

            return $this->redirectToRoute('manage_post');
        }

    }
}