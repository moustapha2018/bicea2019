<?php

namespace App\Controller;


use App\Entity\BiceaAdmin;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeAdminController extends AbstractController
{
    /**
     * @Route("/home/Admin", name="homePageAdmin")
     */
    public function homeAdmin(Request $request, BiceaAdminRepository $adminRepository, RhUserRepository $rhUserRepository)

    {
        //get admin current
        $adminCurrent = $request->getSession()->get('administrator');
        $admin = $adminCurrent;
        $infoSociety = [
            'idAdminSociety'=> $admin->getId(),
            'activitySector' => $admin->getActivitySector(),
            'companyName' =>$admin->getCompanyName()
        ];
        $session = $request->getSession();
        $session->set('society', $infoSociety);

        if ($adminCurrent!= Null){
            if ($adminCurrent->getActivitySector() == BiceaAdmin::bicea){
                    $adminsOrganisme = $adminRepository->findAll();
                    return $this->render('home_admin/homeBicea.html.twig', [
                        'adminsOrganismes' => $adminsOrganisme
                    ]);

                return $this->render('home_admin/homeBicea.html.twig' );
            }
            if ($adminCurrent->getActivitySector() == BiceaAdmin::business){

                return $this->render('home_admin/homeBusiness.html.twig' );
            }
            if ($adminCurrent->getActivitySector() == BiceaAdmin::education){

                return $this->render('home_admin/homeEducation.html.twig' );
            }

        }else{
            return $this->render('index.html.twig' );
        }




    }




}
