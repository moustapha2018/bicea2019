<?php

namespace App\Controller;


use App\Entity\BiceaAdmin;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="homePage")
     */
    public function home(Request $request, BiceaAdminRepository $adminRepository, RhUserRepository $rhUserRepository)

    {
        //get admin current
        $adminCurrent = $request->getSession()->get('administrator');
        if ($adminCurrent!= Null){
            if ($adminCurrent->getActivitySector() == BiceaAdmin::bicea){
                    $adminsOrganisme = $adminRepository->findAll();
                    return $this->render('home/homeBicea.html.twig', [
                        'adminsOrganismes' => $adminsOrganisme
                    ]);

                return $this->render('home/homeBicea.html.twig' );
            }
            if ($adminCurrent->getActivitySector() == BiceaAdmin::business){

                return $this->render('home/homeBusiness.html.twig' );
            }
            if ($adminCurrent->getActivitySector() == BiceaAdmin::education){

                return $this->render('home/homeEducation.html.twig' );
            }

        }else{
            return $this->render('index.html.twig' );
        }

        //get user current
        $userCurrent = $request->getSession()->get('user');


    }


}
