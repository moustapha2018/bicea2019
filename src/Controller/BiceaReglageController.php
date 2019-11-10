<?php

namespace App\Controller;


use App\Repository\BiceaAdminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BiceaReglageController extends AbstractController
{
    /**
     * @Route("/reglage", name="reglage")
     */
    public function reglage( BiceaAdminRepository $adminRepository)
    {
        $adminsOrganisme = $adminRepository->findAll();
        return $this->render('bicea_admin/reglage.html.twig', [
            'adminsOrganismes' => $adminsOrganisme

        ]);
    }

    /**
     * @Route("/activer/{id}", name ="activer")
     */
    public function active($id,BiceaAdminRepository $adminRepository, ObjectManager $manager){
        $amin = $adminRepository->find($id);
        $amin->setActive(1);
        $manager->flush();
        return $this->redirectToRoute('reglage');

    }
    /**
    * @Route("/desactiver/{id}", name ="desactiver")
    */
    public function desactive($id, BiceaAdminRepository $adminRepository, ObjectManager $manager){
        $admin = $adminRepository->find($id);
        $admin->setActive(0);

        $manager->flush();

        return $this->redirectToRoute('reglage');

    }

    /**
     * @Route("/payer/{id}", name ="payer")
     */
    public function payer($id, BiceaAdminRepository $adminRepository, ObjectManager $manager){
        $admin = $adminRepository->find($id);
        $admin->setPaid(1);
        $manager->flush();
        return $this->redirectToRoute('reglage');

    }
    /**
     * @Route("/depayer/{id}", name ="depayer")
     */
    public function depayer($id, BiceaAdminRepository $adminRepository, ObjectManager $manager){
        $admin = $adminRepository->find($id);
        $admin->setPaid(0);
        $manager->flush();

        return $this->redirectToRoute('reglage');

    }

}
