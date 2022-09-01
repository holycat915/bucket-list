<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
//    $auteurs = array();

    /**
     * @Route("/", name="main_home")
     */
    public function home(){
        return $this->render('home/home.html.twig');
    }
    /**
     * @Route("/aboutUs", name="main_about_us")
     */
    public function aboutUs(){
        // ATTENTION : le chemin est relatif au contrôleur frontal donc au répertoire "public"
        $rawData = file_get_contents("../data/team.json");
        // Ou mettre le second paramètre à true pour travailler par rapport au répertoire courant
        // $rawData = file_get_contents("../data/team.json", true);
        // // il faut décoder la chaîne en tableau associatif

        $teammembers = json_decode($rawData, true);
        dump($teammembers);
        return $this->render('home/about_us.html.twig',
            ['teammembers' => $teammembers]);
    }
    /**
     * @Route("/test/", name="main_test")
     */
    public function test(){
        return $this->render('home/test.html.twig');
    }


}
