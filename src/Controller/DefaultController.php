<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Service\MailTestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Marques;
use App\Form\MarquesType;
use App\Repository\MarquesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


    public function renderMenu(MarquesRepository $marquesRepository): Response
    {
        return $this->render('_menu.html.twig', [
            'marques' => $marquesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/mail", name="mail")
     */
    public function mail(MailTestService $email){
        $produitrepo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $produitrepo->find(200);
        dd($produit);
        //Envoi de mail
        $email->sendProduit($produit);
        return $this->redirectToRoute('produits');

    }
}
