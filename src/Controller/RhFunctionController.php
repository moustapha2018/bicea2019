<?php

namespace App\Controller;

use App\Entity\RhFunction;
use App\Form\RhFunctionType;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhFunctionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RhFunctionController extends AbstractController
{
    /**
     * @Route("/new/function", name="functions")
     */
    public function function(Request $request, ObjectManager $manager, RhFunctionRepository $repository,
            BiceaAdminRepository $biceaAdminRepository)
    {
        $function = new RhFunction();

        $form = $this->createForm(RhFunctionType::class, $function);
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){
            $function->setCreatedAt(new \DateTime('now') );
            $adminCurrent = $request->getSession()->get('administrator')->getId();
            $admin = $biceaAdminRepository->find($adminCurrent);
            $function->setBiceaAdmin($admin);
            $manager->persist($function);
            $manager->flush();
            $this->addFlash(
                'info',
                'Fonction enregistrée avec succes!'
            );
            return $this->redirectToRoute('functions');

        }


        $admin_id = $biceaAdminRepository->find($request->getSession()->get('administrator')->getId());
        $functions = $repository->findBy( array('BiceaAdmin' => $admin_id->getId()));

        return $this->render('rh_function/function.html.twig', [
            'form' => $form->createView(),
            'functions' => $functions
        ]);
    }

    /**
     * @Route("/edit/function/{id}", name ="edit_function")
     */
    public function edit_fonction($id, RhFunctionRepository $repository, Request $request, ObjectManager $manager){
        $fonction = $repository->find($id);
        $form = $this->createForm(RhFunctionType::class,$fonction);
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $manager->flush();
                $this->addFlash(
                    'info',
                    'Fonction modifiée avec succes!'
                );
                return $this->redirectToRoute('functions');
            }
        }
        return $this ->render('rh_function/edit_function.html.twig',[
            'fonction'=>$fonction,
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/delete/function/{id}", name ="delete_function")
     */
    public function delete_fonction($id, RhFunctionRepository $repository, ObjectManager $manager){
        $fonction = $repository->find($id);
        $manager->remove($fonction);
        $manager->flush();
        $this->addFlash(
            'info',
            'Fonction supprimée avec succes!'
        );
        return $this ->redirectToRoute('functions');
    }
}
