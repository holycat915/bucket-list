<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

//    public function list(WishRepository $wishRepository): Response
//    {
//        $wishes = $wishRepository->findBy([],['dateCreated'=>'ASC']);
//        // On passe la variable à twig
//
////        dd($wishes);
//
//
//        return $this->render('wish/list.html.twig', [
//            "wishes" => $wishes
//        ]);
//    }

    /**
     * @Route("/wish/all", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
        // récupère les Wish publiés, du plus récent au plus ancien
        // $wishes = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);
        // on appelle une méthode personnalisée ici pour éviter d'avoir trop de requêtes.
        $wishes = $wishRepository->findPublishedWishesWithCategories();
        return $this->render('wish/list.html.twig', [
            // les passe à Twig
            "wishes" => $wishes
        ]);
    }





    /**
     * @Route("/wish/detail/{id}", name="wish_detail")
     */
    public function detail($id, WishRepository $wishRepository): Response
    {
        $wish =$wishRepository->find($id);
        return $this->render('wish/detail.html.twig', [
            "wish"=>$wish
        ]);
    }

    /**
     * @Route("/wish/create", name="wish_create")
     */
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response{

        $wish = new Wish();
        $wish->setDateCreated(new \DateTime());
        $wish->setIsPublished(true);

        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){

            $entityManager->persist($wish);
            $entityManager->flush($wish);


            $this->addFlash('success','wish added!');

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        // traiter le formulaire
        return $this->renderForm('wish/create.html.twig', [
            'wishForm' => $wishForm //->createView()
        ]);
    }
}