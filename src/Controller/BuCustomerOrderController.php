<?php

namespace App\Controller;


use App\Entity\BuArticle;
use App\Repository\BiceaAdminRepository;
use App\Repository\BuArticleRepository;
use App\Repository\BuCustomerOrderRepository;
use App\Service\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuCustomerOrderController extends AbstractController
{
    /**
     * @Route("/bu/customer/order", name="bu_customer_orders")
     */
    public function customerOrder(Request $request, BiceaAdminRepository $adminRepository, Utils $utils,
                                  BuArticleRepository $buArticleRepository)
    {
        $admin = $utils->getAdmin($request,$adminRepository);
        $articles =$buArticleRepository->findBy( array('BiceaAdmin' => $admin->getId()));

        return $this->render('bu_customer_order/bu_customer_order.html.twig', [
            'articles' => $articles,
            'Current_menu' => 'article_menu'
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
