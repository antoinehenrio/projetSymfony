<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    /**
     * @Route("/search/produit", name="search.produit", methods="POST")
     */
    public function search(Request $request)
    {
        $recherche = $request->request->get('search');
        return $this->searchResult($recherche);
    }

    /**
     * @Route("/search/produit/{recherche}", name="search.produit.liste")
     */
    public function searchResult($recherche)
    {
        $produitsRepository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $produitsRepository->searchLike($recherche);
        return $this->render('admin/produits/index.html.twig',[
            'produits' => $produits
        ]);
    }
}
