<?php

namespace App\Controller;

use App\Repository\BuArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BuPanierController extends AbstractController
{
    /**
     * @var BuArticleRepository
     */
    private $repository;

    /**
     * @param BuArticleRepository $repository
     */


    public function __construct(BuArticleRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @param Request $request
     * @return Response
     */
    public  function nbArticle(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('bu_panier/boutonPanier/boutonPanier.html.twig',[
            "articles" => $articles
        ]);
    }

    /**
     * @Route("/add/{id}", name="add.panier")
     * @param SessionInterface $session
     * @param Request $request
     * @param $id
     * @return Response
     */

    public function addToPanier(SessionInterface $session, Request $request, $id)
    {


        if (!$session->has('panier'))
            $session->set('panier', array());
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {

            if ($request->query->get('qte') != null)

                $panier[$id] = $request->query->get('qte');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;
            $this->addFlash('success', 'Article ajouté avec succès !');

        }

        $session->set('panier', $panier);


        return $this->redirect($this->generateUrl('panier'));
    }
    /**
     * @Route("/delete/panier/article/{id}", name="deleteArticle.panier")
     * @param SessionInterface $session
     * @param $id
     * @return Response
     */

    public function deleteArticle(SessionInterface $session, $id)
    {
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier', $panier);
            $this->addFlash('danger', 'Article supprimé avec succès !');
        }

        return $this->redirect($this->generateUrl('panier'));

    }

    /**
     * @Route("/delete/panier", name="delete.panier")
     * @param Request $request
     * @return Response
     */

    public function deletePanier(Request $request): Response
    {
        $session = $request->getSession();
        //$session->clear();
        $session->set('panier', array());

        return $this->redirect($this->generateUrl('panier'));

    }
    /**
     * @Route("/panier}", name="panier")
     * @param Request $request
     * @return Response
     */

    public function index(Request $request): Response
    {
        $session = $request->getSession();

        $article = $this->repository->findArray(array_keys($session->get('panier')));

        if (!$session->has('panier')) $session->set('panier', array());

        return $this->render('bu_panier/panier.html.twig',[
            "articles" => $article,
            "panier" => $session->get('panier')
        ]);
    }
}
