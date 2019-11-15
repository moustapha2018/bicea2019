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

        //get current user
        $userCurrent = $request->getSession()->get('user');
        if ($userCurrent != Null){
            //Get the admin of user
            $adminUser = $biceaAdminRepository->find($userCurrent->getBiceaAdmin());
            if($adminUser->getActivitySector() == BiceaAdmin::business){
                return $this->render("home_user/home_user_business.html.twig",[
                    'infoSociety' => [
                            'sectorActivity' => $adminUser->getActivitySector(),
                            'companyName' =>$adminUser->getCompanyName()
                        ],
                    'administratorUser' => $adminUser
                ]);

            }else if($adminUser->getActivitySector() == BiceaAdmin::education){
                return $this->render("home_user/home_user_education.html.twig",[
                    'infoSociety' => [
                        'sectorActivity' => $adminUser->getActivitySector(),
                        'companyName' =>$adminUser->getCompanyName(),
                        'functionUser' => $userCurrent
                    ],

                ]);

            }else if ($adminUser->getActivitySector() == BiceaAdmin::bicea){
                return $this->render('home_user/home_user_bicea.html.twig', [
                    'infoSociety' => [
                        'sectorActivity' => $adminUser->getActivitySector(),
                        'companyName' =>$adminUser->getCompanyName()
                    ],
                ]);
            }
        }

    }
}
