<?php

namespace App\Controller;

use App\Entity\RhUser;
use App\Form\RhUserType;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhUserRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RhUserController extends AbstractController
{
    /**
     * @Route("/user", name="users")
     */
    public function user(Request $request, ObjectManager $manager, RhUserRepository $repository,
                         BiceaAdminRepository $adminRepository,Utils $utils)
    {
        $user = new RhUser();

        //get the admin curent

        $admin = $utils->getAdmin($request,$adminRepository);

        $form = $this->createForm(RhUserType::class, $user, array('idAdmin' => $admin->getId()));
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){

            $filesystem = new Filesystem();

            $fileContract = $user->getContract();
            $fileNameContract = md5(uniqid()).'.'.$fileContract->guessExtension();
            $fileContract->move($this->getParameter('upload_directory'), $fileNameContract);
            $user->setContract($fileNameContract);

            $filePhoto = $user->getPhoto();
            $fileNamePhoto = md5(uniqid()).'.'.$filePhoto->guessExtension();
            $filePhoto->move($this->getParameter('upload_directory'), $fileNamePhoto);
            $user->setPhoto($fileNamePhoto);

            $filePassport= $user->getPassport();
            $fileNamePassport = md5(uniqid()).'.'.$filePassport->guessExtension();
            $filePassport->move($this->getParameter('upload_directory'), $fileNamePassport);
            $user->setPassport($fileNamePassport);

            $new_directory = $utils->searchReplace($admin->getLoginCompany().'-'.$user->getLoginUser(), $this->getParameter( 'upload_directory'));

            if($filesystem->exists($new_directory)){
                $filesystem->remove([$this->getParameter( 'upload_directory')]);
                $this->addFlash("error", "Ce colaborateur a dejà un dossier ou cet identifiant existe déjà");
                return $this->redirectToRoute('users');

            }else{

                $filesystem->rename($this->getParameter( 'upload_directory'), $new_directory);

                $user->setBiceaAdmin($admin);
                $user->setCreatedAt(new \DateTime('now') );
                $user->setIsActive(0);
                $user->setIsAccountant(0);
                $user->setIsProjectManager(0);
                $user->setIsAdministratorManagement(0);
                $user->setIsCustomerSupplierShareHolser(0);
                $user->setIsHumanRessource(0);
                $user->setIsMovement(0);
                $user->setIsStockTransport(0);
                $user->setIsOperation(0);
                $manager->persist($user);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'Colaborateur e nregistré avec succes!'
                );
                return $this->redirectToRoute('users');
            }

        }

        return $this->render('rh_user/user.html.twig', [
            'users' => $repository->findBy( array('BiceaAdmin' => $admin->getId())),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit_user/{id}", name ="edit_user")
     */
    public function edit_user($id, Request $request, RhUserRepository $repository, ObjectManager $manager,
                              BiceaAdminRepository $adminRepository, Utils $utils)
    {
        $user = $repository->find($id);
        if ($user != null){
            $admin = $utils->getAdmin($request,$adminRepository);
            $lastDossier = strtolower($admin->getLoginCompany().'-'.$user->getLoginUser());

            $form = $this->createForm(RhUserType::class, $user, array('idAdmin' =>$admin->getId() ));

            if($request->isMethod('POST'))
            {
                $form->handleRequest($request);
                if($form->isValid())
                {
                    $filesystem = new Filesystem();

                    $filesystem->remove(['uploads/'.$lastDossier]);

                    $fileContract = $user->getContract();
                    $fileNameContract = md5(uniqid()).'.'.$fileContract->guessExtension();
                    $fileContract->move($this->getParameter('upload_directory'), $fileNameContract);
                    $user->setContract($fileNameContract);

                    $filePhoto = $user->getPhoto();
                    $fileNamePhoto = md5(uniqid()).'.'.$filePhoto->guessExtension();
                    $filePhoto->move($this->getParameter('upload_directory'), $fileNamePhoto);
                    $user->setPhoto($fileNamePhoto);

                    $filePassport= $user->getPassport();
                    $fileNamePassport = md5(uniqid()).'.'.$filePassport->guessExtension();
                    $filePassport->move($this->getParameter('upload_directory'), $fileNamePassport);
                    $user->setPassport($fileNamePassport);



                    $new_directory = $utils->searchReplace($admin->getLoginCompany().'-'.$user->getLoginUser(), $this->getParameter( 'upload_directory'));

                    if($filesystem->exists($new_directory)){
                        $filesystem->remove([$this->getParameter( 'upload_directory')]);
                        $this->addFlash("error", "Ce colaborateur a dejà un dossier ou cet identifiant existe déjà");
                        return $this->redirectToRoute('users');

                    }else{

                        $filesystem->rename($this->getParameter( 'upload_directory'), $new_directory);

                        $admin = $adminRepository->find($request->getSession()->get('administrator')->getId());
                        $user->setBiceaAdmin($admin);
                        $manager->flush();
                        $this->addFlash(
                            'success',
                            'Modifications avec succes!'
                        );
                        return $this->redirectToRoute('users');
                    }
                }
            }


            return $this->render('rh_user/edit_user.html.twig', [
                'form' => $form->createView(),
                'user' => $user
            ]);

        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('users');
        }
    }

    /**
     * @Route("/view/{id}", name ="view_user")
     */
    public function view_user($id, RhUserRepository $repository, Utils $utils){

        $user = $repository->find($id);
        if ($user != null){
            return $this->render('rh_user/view_user.html.twig', [
                'user' => $user
            ]);

        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('users');
        }
    }

    /**
     * @Route("/delete_user/{id}", name ="delete_user")
     */
    public function delete_user($id, RhUserRepository $repository, ObjectManager $manager, Utils $utils){

        $user = $repository->find($id);
        $filesystem = new Filesystem();
        if ($user != null){
            $nonDossier = $user->getLoginUser();
            $filesystem->remove(['uploads/'.$nonDossier]);

            $manager->remove($user);
            $manager->flush();
            $this->addFlash(
                'info',
                'Utilisateur supprimé avec succes!'
            );

            return $this ->redirectToRoute('users');

        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('users');
        }
    }

}
