<?php

namespace App\Controller;

use App\Entity\BiceaAdmin;
use App\Entity\RhUser;
use App\Repository\BiceaAdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeUserController extends AbstractController
{
    /**
     * @Route("/home/user", name="homePageUser")
     */
    public function homePageUser(Request $request, BiceaAdminRepository $biceaAdminRepository)
    {
        $userCurrent = $request->getSession()->get('user');
        $admin = $biceaAdminRepository->find($userCurrent->getBiceaAdmin());
        $infoSociety = [
            'idAdminSociety'=> $admin->getId(),
            'activitySector' => $admin->getActivitySector(),
            'companyName' =>$admin->getCompanyName()
        ];
        $session = $request->getSession();
        $session->set('society', $infoSociety);

        if ($userCurrent != Null){
            //Get the admin of user

            if($admin->getActivitySector() == BiceaAdmin::business){
                return $this->render("home_user/home_user_business.html.twig");

            }else if($admin->getActivitySector() == BiceaAdmin::education){
                return $this->render("home_user/home_user_education.html.twig");

            }else if ($admin->getActivitySector() == BiceaAdmin::bicea){

                return $this->render('home_user/home_user_bicea.html.twig');
            }
        }

    }
}
