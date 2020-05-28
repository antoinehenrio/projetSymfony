<?php

namespace App\Controller\Admin;

use App\Entity\Marques;
use App\Form\MarquesType;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/marques")
 */
class MarquesController extends AbstractController
{
    /**
     * @Route("/", name="marques_index", methods={"GET"})
     */
    public function index(MarquesRepository $marquesRepository): Response
    {
        return $this->render('marques/index.html.twig', [
            'marques' => $marquesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="marques_new", methods={"GET","POST"})
     */
    public function new(Request $request,MarquesRepository $marquesRepository): Response
    {
        $marque = new Marques();
        $form = $this->createForm(MarquesType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marque);
            $entityManager->flush();

            return $this->redirectToRoute('marques_index');
        }

        return $this->render('marques/new.html.twig', [
            'marque' => $marque,
            'form' => $form->createView(),
            'marques' => $marquesRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="marques_show", methods={"GET"})
     */
    public function show(Marques $marque,MarquesRepository $marquesRepository): Response
    {
        return $this->render('marques/show.html.twig', [
            'marque' => $marque,
            'marques' => $marquesRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/show", name="marques_show_produits", methods={"GET"})
     */
    public function showProduits(Marques $marque,MarquesRepository $marquesRepository): Response
    {
        $produits = $marque->getProduits();
        return $this->render('marques/show.html.twig_produits', [
            'marque' => $marque,
            'produits' => $produits,
            'marques' => $marquesRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="marques_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Marques $marque,MarquesRepository $marquesRepository): Response
    {
        $form = $this->createForm(MarquesType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marques_index');
        }

        return $this->render('marques/edit.html.twig', [
            'marque' => $marque,
            'form' => $form->createView(),
            'marques' => $marquesRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="marques_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Marques $marque,MarquesRepository $marquesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('marques_index');
    }
}
