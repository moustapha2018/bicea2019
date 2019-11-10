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





}