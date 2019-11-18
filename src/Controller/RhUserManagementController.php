<?php

namespace App\Controller;

use App\Repository\BiceaAdminRepository;
use App\Repository\RhUserRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RhUserManagementController extends AbstractController
{
    /**
     * @Route("/rh/user/management", name="rhUserManagement")
     */
    public function RhUserManagement(Request $request, RhUserRepository $rhUserRepository,
                                     BiceaAdminRepository $biceaAdminRepository, Utils $utils)
    {
        //get the admin curent
        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        return $this->render('rh_user_management/rh_user_management.html.twig', [
            'RhUsers' => $rhUserRepository->findBy( array('BiceaAdmin' => $admin->getId())),
        ]);
    }

    /**
     * @Route("activate/{id}", name="activation")
     */
    public  function activation($id,  RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsActive() == 0){
            $user->setIsActive(1);
        }else{
            $user->setIsActive(0);
        }
        $manager->flush();
      return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("management/{id}", name="management")
     */
    public  function management($id,  RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsProjectManager() == 0){
            $user->setIsProjectManager(1);
        }else{
            $user->setIsProjectManager(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("accounting/{id}", name="accounting")
     */
    public  function accounting($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsAccountant() == 0){
            $user->setIsAccountant(1);
        }else{
            $user->setIsAccountant(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("humanRessource/{id}", name="humanRessource")
     */
    public  function humanRessource($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsHumanRessource() == 0){
            $user->setIsHumanRessource(1);
        }else{
            $user->setIsHumanRessource(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("administratorManagement/{id}", name="administratorManagement")
     */
    public  function administratorManagement($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsAdministratorManagement() == 0){
            $user->setIsAdministratorManagement(1);
        }else{
            $user->setIsAdministratorManagement(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("customerSupplierShareHolser/{id}", name="customerSupplierShareHolser")
     */
    public  function customerSupplierShareHolser($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsCustomerSupplierShareHolser() == 0){
            $user->setIsCustomerSupplierShareHolser(1);
        }else{
            $user->setIsCustomerSupplierShareHolser(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("operation/{id}", name="operation")
     */
    public  function operation($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsOperation() == 0){
            $user->setIsOperation(1);
        }else{
            $user->setIsOperation(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("movement/{id}", name="movement")
     */
    public  function movement($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsMovement() == 0){
            $user->setIsMovement(1);
        }else{
            $user->setIsMovement(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }

    /**
     * @Route("stockTransport/{id}", name="stockTransport")
     */
    public  function stockTransport($id, RhUserRepository $rhUserRepository, ObjectManager $manager){

        $user = $rhUserRepository->find($id);
        if($user->getIsStockTransport() == 0){
            $user->setIsStockTransport(1);
        }else{
            $user->setIsStockTransport(0);
        }
        $manager->flush();
        return $this->redirectToRoute('rhUserManagement');
    }


}
