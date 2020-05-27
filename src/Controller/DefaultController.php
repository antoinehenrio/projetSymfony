<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Service\MailTestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
