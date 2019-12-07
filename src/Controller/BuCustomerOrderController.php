<?php

namespace App\Controller;


use App\Entity\BuArticle;
use App\Repository\BuArticleRepository;
use App\Repository\BuCategoryRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuCustomerOrderController extends AbstractController
{
    /**
     * @Route("/bu/customer/order/{id}", name="bu_customer_orders")
     */
    public function customerOrder($id, Request $request, BuArticleRepository $buArticleRepository,
                                  BuCategoryRepository $buCategoryRepository, PaginatorInterface $paginator)
    {
        $articles = $paginator->paginate(
            //$this->repository->findAllByNameAscQuery(),
            $buArticleRepository->findBy( array('BiceaAdmin' => $id)),
            $request->query->getInt('page', 1),
            4
        );
        $session = $request->getSession();
        $session->set('companyId', $id);
        //$articles = $buArticleRepository->findBy( array('BiceaAdmin' => $id));
        $categories = $buCategoryRepository->findBy(array('BiceaAdmin' => $id));

        return $this->render('bu_customer_order/bu_customer_order.html.twig', [
            'articles' => $articles,
            'categories' => $categories

        ]);

    }

    /**
     * @Route("/articles/{id}", name="article.show")
     * @param BuArticle $article
     * @return Response
     */
    public function show(BuArticle $article,  $id, BuArticleRepository $buArticleRepository):Response
    {

        $article = $buArticleRepository->find($id);
        return $this->render('bu_customer_order/show.html.twig',[
            "article" => $article,
            "Current_menu" => "article_menu"
        ]);

    }


}
