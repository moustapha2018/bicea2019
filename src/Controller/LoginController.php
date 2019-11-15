<?php

namespace App\Controller;

use App\Entity\BiceaAdmin;


use App\Entity\RhUser;
use App\Repository\BiceaAdminRepository;
use App\Repository\RhFunctionRepository;
use App\Repository\RhUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    # ----data of login form
    const status = 'status';
    const login = 'loginUser';
    const password = 'password';
    const collaborater = 'Collaborateur';
    const administrator = 'Administrateur';
    const loginCompany = 'loginCompany';



    /**
     * @Route("/", name="login")
     */
    public function login(Request $request, RhUserRepository $userRepository, BiceaAdminRepository $adminRepository)
    {
        $userEntity = new RhUser();
        $adminEntity = new BiceaAdmin();

        if ($request->getMethod() == 'POST'){
            if($request->get(self::status) == self::collaborater) {
                $user = $userRepository->findOneBy(array($userEntity::loginUser => $request->get(self::login)));

                if ($user == Null ){
                    $this->addFlash('warning', 'Ce compte n\'existe pas');

                    return $this->redirectToRoute("login");

                }else if ($user->getPassword() != $request->get(self::password)) {
                    $this->addFlash('warning', 'Votre mot de passe est incorrect');

                    return $this->redirectToRoute("login");

                }else if ($user->getIsActive() == 0) {
                    $this->addFlash('warning', 'Votre compte est désactiver contactez votre organisme');

                    return $this->redirectToRoute("login");
                } else{
                    $session = $request->getSession();
                    $session->set('user', $user);
                    return $this->redirectToRoute('homePageUser');
                }

            }else if($request->get(self::status) == self::administrator) {
                $admin = $adminRepository->findOneBy(array($adminEntity::loginAdmin => $request->get(self::login)));

                if ($admin == Null or $admin->getActive() == 0){
                    $this->addFlash(
                        'warning',
                        'Ce compte n\'existe pas ou il a été desactivé contacter Biacea');

                    return $this->redirectToRoute('homePageAdmin');

                }else if ($admin->getPassword() != $request->get(self::password)) {
                    $this->addFlash(
                        'warning',
                        'Votre mot de passe est incorrect');

                    return $this->redirectToRoute("login");

                }else if($admin->getLoginCompany() != $request->get(self::loginCompany)){
                    $this->addFlash(
                        'warning',
                        ' Identifiant organisme incorrect');

                    return $this->redirectToRoute("login");
                } else{
                    $session = $request->getSession();
                    $session->set('administrator',$admin);
                    return $this->redirectToRoute('homePageAdmin');
                }
            }else{
                $this->addFlash(
                    'warning',
                    'Ce secteur d\'activité n\'est pas fourni par notre entreprise' );

                return $this->redirectToRoute("login");
            }


        }

        return $this->render('index.html.twig');
    }

    /**
     * @Route("/logout", name ="logout")
     */

    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->invalidate(); //here we can now clear the session.
        return $this ->redirectToRoute('login');
    }



}
