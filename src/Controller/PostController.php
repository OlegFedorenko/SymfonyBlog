<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\Posts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post); //Строим форму используя PostType

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) // Валидируем и записываем в базу данных
        {
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Success!');

            return $this->redirectToRoute('post_show',['id' => $post->getId()]);
        }

        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_show", requirements={"id" = "\d+"})
     * @ParamConverter("post", options={"mapping"={"id"="id"}})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Post $post, Posts $postsService)
    {
        return $this->render('post/show.html.twig',['post'=> $post]);
    }

    public function edit()
    {

    }
}
