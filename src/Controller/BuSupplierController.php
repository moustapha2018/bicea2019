<?php

namespace App\Controller;

use App\Entity\BuSupplier;
use App\Form\BuSupplierType;
use App\Repository\BiceaAdminRepository;
use App\Repository\BuSupplierRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BuSupplierController extends AbstractController
{
    /**
     * @Route("/bu/supplier", name="bu_suppliers")
     */
    public function supplier(Request $request, BuSupplierRepository $buSupplierRepository,
                             ObjectManager $manager, Utils $utils, BiceaAdminRepository $biceaAdminRepository)
    {
        $supplier = new BuSupplier();

        //get the admin curent

        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        $form = $this->createForm(BuSupplierType::class, $supplier);
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){

            $supplier->setBiceaAdmin($admin);
            $supplier->setCreatedAt(new \DateTime('now') );

            $manager->persist($supplier);
            $manager->flush();
            $this->addFlash(
                'success',
                'Fournisseur est nregistré avec succes!'
            );
            return $this->redirectToRoute('bu_suppliers');
        }

        return $this->render('bu_supplier/bu_supplier.html.twig', [
            'suppliers' => $buSupplierRepository->findBy( array('BiceaAdmin' => $admin->getId())),
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/edit/supplier/{id}", name ="edit_bu_supplier")
     */
    public function edit_supplier($id, BuSupplierRepository $buSupplierRepository, Request $request, ObjectManager $manager, Utils $utils)
    {
        $supplier = $buSupplierRepository->find($id);
        if ($supplier != null) {
            $form = $this->createForm(BuSupplierType::class, $supplier);
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $manager->flush();
                    $this->addFlash(
                        'info',
                        'Fournisseur modifiée avec succes!'
                    );
                    return $this->redirectToRoute('bu_suppliers');
                }
            }
            return $this->render('bu_supplier/edit_bu_supplier.html.twig', [
                'supplier' => $supplier,
                'form' => $form->createView()
            ]);
        } else {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_suppliers');
        }
    }

    /**
     * @Route("/delete/supplier/{id}", name ="delete_bu_supplier")
     */
    public function delete_fonction($id, BuSupplierRepository $buSupplierRepository,
                                    Utils $utils, ObjectManager $manager)
    {
        $supplier = $buSupplierRepository->find($id);
        if ($supplier != null){
            $manager->remove($supplier);
            $manager->flush();
            $this->addFlash(
                'info',
                'Fournisseur supprimée avec succes!'
            );
            return $this ->redirectToRoute('bu_suppliers');
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_suppliers');
        }

    }
}
