<?php

namespace App\Controller;

use App\Entity\RhFunction;
use App\Form\RhFunctionType;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhFunctionRepository;
use App\Service\Utils;
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
            BiceaAdminRepository $biceaAdminRepository, Utils $utils)
    {
        $function = new RhFunction();

        $form = $this->createForm(RhFunctionType::class, $function);
        $form->handleRequest($request);

        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        if($form ->isSubmitted() && $form->isValid()){
            $function->setCreatedAt(new \DateTime('now') );
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
    public function edit_function($id, RhFunctionRepository $repository, Request $request, ObjectManager $manager, Utils $utils){
        $function = $repository->find($id);
        if ($function != null) {
            $form = $this->createForm(RhFunctionType::class,$function);
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
                'fonction'=>$function,
                'form' =>$form->createView()
            ]);
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('functions');
        }


    }

    /**
     * @Route("/delete/function/{id}", name ="delete_function")
     */
    public function delete_fonction($id, RhFunctionRepository $repository, ObjectManager $manager, Utils $utils){
        $function = $repository->find($id);
        if ($function != null){
            $manager->remove($function);
            $manager->flush();
            $this->addFlash(
                'info',
                'Fonction supprimée avec succes!'
            );
            return $this ->redirectToRoute('functions');
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('functions');
        }

    }
}


