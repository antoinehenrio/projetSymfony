<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Produits;
use App\Form\ContactType;
use App\Service\MailTestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index()
    {
        $produitRepository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $produitRepository->findBy(['Actif'=>true]);

        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'toto' => 'Coucou'
        ]);
    }

    /**
     * @Route("/produits/add", name="produits_add")
     */
    public function add()
    {
        $produit = new Produits();
        $produit->setTitre('TV 106 cm')
            ->setCouleur(2)
            ->setDescription('Ma Description')
            ->setPoids(10)
            ->setPriceTTC(120)
            ->setStockQte(4);

        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();

        return $this->redirectToRoute('produits');
    }

    /**
     * @Route("/produits/details/{slug}", name="produit_detail", requirements={"slug" : "[a-zA-Z0-9\-]*"})
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detail(Produits $produit, Request $request, MailTestService $email){

        $contact = new Contact();
        $contact->setProduit($produit);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email->sendProduit($produit);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('produit_detail', [
                'slug' => $produit->getSlug()
            ]);
        }


        return $this->render('produits/details.html.twig',[
            'produit' => $produit,
            'current_menu' => 'produits',
            'form' => $form->createView()
        ]);
    }
}
