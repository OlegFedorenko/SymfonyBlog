<?php

namespace App\Controller;

use App\Service\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Posts $posts)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'posts' => $posts->getLastThree(),
        ]);
    }

    /**
     * @Route("/all", name="show_all")
     */
    public function all(Posts $posts)
    {
        return $this->render('post/showAll.html.twig', [
            'controller_name' => 'DefaultController',
            'posts' => $posts->getAll(),
        ]);
    }
}
