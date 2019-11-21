<?php

namespace App\Controller;

use App\Entity\BuCustomer;
use App\Form\BuCustomerType;
use App\Repository\BiceaAdminRepository;
use App\Repository\BuCustomerRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BuCustomerController extends AbstractController
{
    /**
     * @Route("/bu/customer", name="bu_customers")
     */
    public function customer(Request $request, BiceaAdminRepository $biceaAdminRepository,
                             Utils $utils, ObjectManager $manager, BuCustomerRepository $buCustomerRepository)
    {
        $customer = new BuCustomer();

        //get the admin curent

        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        $form = $this->createForm(BuCustomerType::class, $customer);
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){

            $customer->setBiceaAdmin($admin);
            $customer->setCreatedAt(new \DateTime('now') );

            $manager->persist($customer);
            $manager->flush();
            $this->addFlash(
                'success',
                'Client est nregistré avec succes!'
            );
            return $this->redirectToRoute('bu_customers');
        }



        return $this->render('bu_customer/bu_customer.html.twig', [
            'customers' => $buCustomerRepository->findBy( array('BiceaAdmin' => $admin->getId())),
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/edit/customer/{id}", name ="edit_bu_customer")
     */
    public function edit_function($id, BuCustomerRepository $buCustomerRepository, Request $request, ObjectManager $manager, Utils $utils)
    {
        $customer = $buCustomerRepository->find($id);
        if ($customer != null) {
            $form = $this->createForm(BuCustomerType::class, $customer);
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $manager->flush();
                    $this->addFlash(
                        'info',
                        'Client modifiée avec succes!'
                    );
                    return $this->redirectToRoute('bu_customers');
                }
            }
            return $this->render('bu_customer/edit_bu_customer.html.twig', [
                'customer' => $customer,
                'form' => $form->createView()
            ]);
        } else {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_customers');
        }
    }

    /**
     * @Route("/delete/customer/{id}", name ="delete_bu_customer")
     */
    public function delete_fonction($id, BuCustomerRepository $buCustomerRepository,
                                    Utils $utils, ObjectManager $manager)
    {
        $customer = $buCustomerRepository->find($id);
        if ($customer != null){
            $manager->remove($customer);
            $manager->flush();
            $this->addFlash(
                'info',
                'Client supprimée avec succes!'
            );
            return $this ->redirectToRoute('bu_customers');
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_customers');
        }

    }
}
