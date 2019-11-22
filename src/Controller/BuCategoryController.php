<?php

namespace App\Controller;

use App\Entity\BuCategory;
use App\Form\BuCategoryType;
use App\Repository\BiceaAdminRepository;
use App\Repository\BuCategoryRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BuCategoryController extends AbstractController
{
    /**
     * @Route("/bu/category", name="bu_categories")
     */
    public function category(Request $request, BiceaAdminRepository $biceaAdminRepository,
                                 Utils $utils, ObjectManager $manager, BuCategoryRepository $buCategoryRepository)
    {
        $category = new BuCategory();

        //get the admin curent

        $admin = $utils->getAdmin($request, $biceaAdminRepository);

        $form = $this->createForm(BuCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category->setBiceaAdmin($admin);
            $category->setCreatedAt(new \DateTime('now'));

            $manager->persist($category);
            $manager->flush();
            $this->addFlash(
                'success',
                'Client est nregistré avec succes!'
            );
            return $this->redirectToRoute('bu_categories');
        }


        return $this->render('bu_category/bu_category.html.twig', [
            'categories' => $buCategoryRepository->findBy(array('BiceaAdmin' => $admin->getId())),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/category/{id}", name ="edit_bu_category")
     */
    public function edit_category($id, BuCategoryRepository $buCategoryRepository, Request $request, ObjectManager $manager, Utils $utils)
    {
        $category = $buCategoryRepository->find($id);
        if ($category != null) {
            $form = $this->createForm(BuCategoryType::class, $category);
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $manager->flush();
                    $this->addFlash(
                        'info',
                        'Categorie modifiée avec succes!'
                    );
                    return $this->redirectToRoute('bu_categories');
                }
            }
            return $this->render('bu_category/edit_bu_category.html.twig', [
                'category' => $category,
                'form' => $form->createView()
            ]);
        } else {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_categories');
        }
    }

    /**
     * @Route("/delete/category/{id}", name ="delete_bu_category")
     */
    public function delete_category($id, BuCategoryRepository $buCategoryRepository,
                                    Utils $utils, ObjectManager $manager)
    {
        $category = $buCategoryRepository->find($id);
        if ($category != null){
            $manager->remove($category);
            $manager->flush();
            $this->addFlash(
                'info',
                'Categorie supprimée avec succes!'
            );
            return $this ->redirectToRoute('bu_categories');
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_categories');
        }

    }

}
