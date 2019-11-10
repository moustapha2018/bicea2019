<?php

namespace App\Controller;

use App\Repository\BiceaAdminRepository;
use App\Repository\RhUserRepository;
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
                                     BiceaAdminRepository $biceaAdminRepository)
    {
        //get the admin curent
        $adminCurrent = $biceaAdminRepository->find($request->getSession()->get('administrator')->getId());


        return $this->render('rh_user_management/rh_user_management.html.twig', [
            'RhUsers' => $rhUserRepository->findBy( array('BiceaAmin' => $adminCurrent->getId())),
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

}
