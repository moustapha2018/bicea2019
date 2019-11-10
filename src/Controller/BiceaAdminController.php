<?php

namespace App\Controller;

use App\Entity\BiceaAdmin;
use App\Form\BiceaAdminType;
use App\Repository\BiceaAdminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BiceaAdminController extends AbstractController
{
    /**
     * @Route("/new/register", name="register")
     */

    public function register(Request $request, ObjectManager $manager, BiceaAdminRepository $repository)
    {
        $admin = new BiceaAdmin();
        $form = $this->createForm(BiceaAdminType::class, $admin);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $admin->setCreatedAt(new \DateTime('now'));
            $admin->setActive(1);
            $admin->setPaid(0);
            $manager->persist($admin);
            $manager->flush();
            $this->addFlash(
                'success',
                'Compte créer avec success! Notez vos identifiants de connexion,  id Entreprise:'.$admin->getLoginCompany().' Identifiant: '.$admin->getLoginAdmin().''
            );
            return $this->redirectToRoute('register');
        }

        return $this->render('bicea_admin/register.html.twig', [
            'form' => $form->createView(),
        ]);

    }
    /**
     * @Route("/new/admin", name="admins")
     */

    public function admin(Request $request, ObjectManager $manager, BiceaAdminRepository $repository)
    {
        $admin = new BiceaAdmin();
        $form = $this->createForm(BiceaAdminType::class, $admin);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()) {
            $admin->setCreatedAt(new \DateTime('now'));
            $admin->setActive(1);
            $admin->setPaid(0);
            $manager->persist($admin);
            $manager->flush();
            $this->addFlash(
                'success',
                'Compte créer avec success! Notez vos identifiants de connexion,  id Entreprise:'.$admin->getLoginCompany().' Identifiant: '.$admin->getLoginAdmin().''
            );
            return $this->redirectToRoute('admins');
        }

        $admins = $repository->findAll();
        return $this->render('bicea_admin/admin.html.twig', [
            'form' => $form->createView(),
            'admins' => $admins
        ]);

    }

    /**
     * @Route("/edit/admin/{id}", name ="edit_admin")
     */
    public function edit_admin($id, BiceaAdminRepository $repository, Request $request,ObjectManager $manager){
        $admin = $repository->find($id);
        $form = $this->createForm(BiceaAdminType::class,$admin);
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $manager->flush();
                $this->addFlash(
                    'success',
                    'Administrateur modifié avec succes!'
                );
                return $this->redirectToRoute('admins');
            }
        }
        return $this ->render('bicea_admin/edit_admin.html.twig',[
            'admin'=>$admin,
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/delete/admin/{id}", name ="delete_admin")
     */
    public function delete_organisme($id, BiceaAdminRepository $repository,ObjectManager $manager){
        $admin = $repository->find($id);
        $manager->remove($admin);
        $manager->flush();
        $this->addFlash(
            'info',
            'administrateur supprimé avec succes!'
        );
        return $this ->redirectToRoute('admins');
    }
}
