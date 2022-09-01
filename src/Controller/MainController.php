<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
//    /**
//     * @Route("/", name="app_home")
//     */
//    public function index(): Response
//    {
//        return $this->render('home/home.html.twig', [
//            'controller_name' => 'MainController',
//        ]);
//    }


//
//    public function home(){
//        return $this->render(home/home.html.twig);
//    }


    /**
     * @Route("/", name="main_home")
     */
    public function home(){
        return $this->render('home/home.html.twig');
    }
    /**
     * @Route("/aboutUs/", name="main_about_us")
     */
    public function aboutUs(){
        return $this->render('home/about_us.html.twig');
    }
    /**
     * @Route("/test/", name="main_test")
     */
    public function test(){
        return $this->render('home/test.html.twig');
    }


}
