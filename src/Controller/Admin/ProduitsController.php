<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use App\Form\ProduitEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/admin/produits", name="produits_index")
     */
    public function index()
    {
        /*
        $user = $this->getUser();
        dump($user);
        $hasAccess = $this->isGranted('ROLE_TOTO');
        dump($hasAccess);
        $this->denyAccessUnlessGranted('ROLE_TITI');
        */

        $produitsRepository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $produitsRepository->findAll();
        return $this->render('admin/produits/index.html.twig',[
            'produits' => $produits
        ]);
    }

 /*   /**
     * @Route  ("/admin/produit/add", name="admin.produit.add")
     */
    /*public function add(Request $request){
        $produit = new Produits();
        $form = $this->createForm(ProduitEditType::class,$produit);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
        }

        return $this->render('admin/produits/add.html.twig',[
            'form' => $form->createView()
        ]);
    }*/

    /**
     * @Route("/admin/produits/new", name="produits_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitEditType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('admin/produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produits/edit/{id}", name="produits_edit")
     */
    public function edit(Produits $produit, Request $request){
        $form = $this->createForm(ProduitEditType::class,$produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           $em = $this->getDoctrine()->getManager();
           $em->flush();
        }

        return $this->render('admin/produits/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produits/{id}", name="produits_show", methods={"GET"})
     */
    public function show(Produits $produit): Response
    {
        return $this->render('admin/produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/admin/produits/delete/{id}", name="produits_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produits $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produits_index');
    }
}