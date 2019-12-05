<?php

namespace App\Controller;


use App\Entity\BuArticle;
use App\Form\BuArticleType;
use App\Repository\BiceaAdminRepository;
use App\Repository\BuArticleRepository;
use App\Service\Utils;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BuArticleController extends AbstractController
{
    /**
     * @Route("/bu/article", name="bu_articles")
     */
   public function article(Request $request, BiceaAdminRepository $biceaAdminRepository,
                                 Utils $utils, ObjectManager $manager, BuArticleRepository $buArticleRepository)
    {
        $article = new BuArticle();

        //get the admin curent

        $admin = $utils->getAdmin($request, $biceaAdminRepository);

        $form = $this->createForm(BuArticleType::class, $article, array('idAdmin' => $admin));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $filesystem = new Filesystem();

            $fileImage = $article->getImage();
            $fileNameImage = md5(uniqid()).'.'.$fileImage->guessExtension();
            $fileImage->move($this->getParameter('upload_directory_images_articles'), $fileNameImage);
            $article->setImage($fileNameImage);
            $new_directory = $utils->searchReplace($admin->getLoginCompany().'-'.$article->getArticleName(), $this->getParameter( 'upload_directory_images_articles'));

            if($filesystem->exists($new_directory)){
                $filesystem->remove([$this->getParameter( 'upload_directory_images_articles')]);
                $this->addFlash("error", "Cet article a dejà une image");
                return $this->redirectToRoute('bu_articles');

            }else {

                $filesystem->rename($this->getParameter('upload_directory_images_articles'), $new_directory);
                $article->setBiceaAdmin($admin);
                $article->setCreatedAt(new \DateTime('now'));

                $manager->persist($article);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'Article est enregistré avec succes!'
                );
                return $this->redirectToRoute('bu_articles');
            }
        }


        return $this->render('bu_article/bu_article.html.twig', [
            'articles' => $buArticleRepository->findBy(array('BiceaAdmin' => $admin->getId())),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/article/{id}", name ="edit_bu_article")
     */
    public function edit_article($id, BuArticleRepository $buArticleRepository, Request $request,
                                 ObjectManager $manager, Utils $utils, BiceaAdminRepository $adminRepository)
    {

        $article = $buArticleRepository->find($id);
        $admin = $utils->getAdmin($request,$adminRepository);
        if ($article != null) {
            $form = $this->createForm(BuArticleType::class, $article,array('idAdmin' =>$admin->getId() ));
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $manager->flush();
                    $this->addFlash(
                        'info',
                        'Article modifié avec succes!'
                    );
                    return $this->redirectToRoute('bu_articles');
                }
            }
            return $this->render('bu_article/edit_bu_article.html.twig', [
                'article' => $article,
                'form' => $form->createView()
            ]);
        } else {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_articles');
        }
    }

    /**
     * @Route("/delete/article/{id}", name ="delete_bu_article")
     */
    public function delete_category($id, BuArticleRepository $buArticleRepository,
                                    Utils $utils, ObjectManager $manager)
    {
        $article = $buArticleRepository->find($id);
        if ($article != null){
            $manager->remove($article);
            $manager->flush();
            $this->addFlash(
                'info',
                'Article supprimée avec succes!'
            );
            return $this ->redirectToRoute('bu_articles');
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('bu_articles');
        }

    }
}
