<?php

namespace App\Controller;

use App\Entity\RhContract;
use App\Form\RhContractType;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhContractRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RhContractController extends AbstractController
{
    /**
     * @Route("/rh/contract", name="rh_contracts")
     */
    public function contract(Request $request, RhContractRepository $rhContractRepository, ObjectManager $manager,
                            BiceaAdminRepository $biceaAdminRepository, Utils $utils)
    {
        $contract = new RhContract();

        $admin = $utils->getAdmin($request,$biceaAdminRepository);
        $form = $this->createForm(RhContractType::class, $contract, array('idAdmin' => $admin->getId()));
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){
            $contract->setCreatedAt(new \DateTime('now') );
            $contract->setBiceaAdmin($admin);
            $manager->persist($contract);
            $manager->flush();
            $this->addFlash(
                'info',
                'Contrat enregistré avec succes!'
            );
            return $this->redirectToRoute('rh_contracts');
        }



        return $this->render('rh_contract/rh_contract.html.twig', [
            'contracts' => $rhContractRepository->findBy( array('BiceaAdmin' => $admin->getId())),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/contract/{id}", name ="edit_rh_contract")
     */
    public function edit_function($id, RhContractRepository $rhContractRepository, Request $request,
                                  ObjectManager $manager,Utils $utils){
        $contract = $rhContractRepository->find($id);
        if ($contract != null) {
            $form = $this->createForm(RhContractType::class,$contract);
            if($request->isMethod('POST'))
            {
                $form->handleRequest($request);
                if($form->isValid())
                {
                    $manager->flush();
                    $this->addFlash(
                        'info',
                        'Contrat modifiée avec succes!'
                    );
                    return $this->redirectToRoute('rh_contracts');
                }
            }
            return $this ->render('rh_contract/edit_rh_contract.html.twig',[
                'contract'=>$contract,
                'form' =>$form->createView()
            ]);
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('rh_contracts');
        }
    }

    /**
     * @Route("/delete/contract/{id}", name ="delete_rh_contract")
     */
    public function delete_fonction($id, RhContractRepository $rhContractRepository, ObjectManager $manager,
                                    Utils $utils){
        $contract = $rhContractRepository->find($id);
        if ($contract != null){
            $manager->remove($contract);
            $manager->flush();
            $this->addFlash(
                'info',
                'Contrat supprimée avec succes!'
            );
            return $this ->redirectToRoute('rh_contracts');
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('rh_contracts');
        }

    }
}
