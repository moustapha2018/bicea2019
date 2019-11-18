<?php
/**
 * Created by PhpStorm.
 * User: toure
 * Date: 05/11/2019
 * Time: 22:09
 */

namespace App\Service;


class Utils
{

    public function searchReplace($replace, $subject ){
        $search = "dossierutilisateur";
      return $new_directory = strtolower ( str_replace($search, $replace, $subject) );
    }

    public function getAdmin($request,$biceaAdminRepository){
        //get current User
        $userCurrent = $request->getSession()->get('user');
        //get current Admin
        $adminCurrent = $request->getSession()->get('administrator');
        if ($adminCurrent != null){
            $admin = $biceaAdminRepository->find($adminCurrent->getId());
        }else if ($userCurrent != null){

            $admin = $biceaAdminRepository->find($userCurrent->getBiceaAdmin());
        }else{
            $this->addFlash(
                'info',
                'Veillez vous reconnecté votre session a expiré!'
            );
            return $this->redirectToRoute('login');
        }

        return $admin;
    }

    public function messageObjetNotFound(){

       $type = 'info';
       $message = 'objet a ete supprimé par un autre utilisateur ou in n\'existe pas dans la based non trouvé';
       //$infos = ['type'=>$type, 'message' =>$message];
       return array($type,$message);
    }






}