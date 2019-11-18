<?php

namespace App\Controller;

use App\Entity\BiceaAdmin;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\BiceaAdminRepository;
use App\Repository\ProjectRepository;
use App\Repository\PrTaskRepository;
use App\Service\Utils;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("new/project", name="projects")
     */

    public function project(Request $request, ObjectManager $manager, ProjectRepository $repository,
                                 BiceaAdminRepository $biceaAdminRepository, Utils $utils)
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        if($form ->isSubmitted() && $form->isValid()){
            $project->setBiceaAdmin($admin);
            $project->setCreatedAt(new \DateTime('now') );
            $manager->persist($project);
            $manager->flush();
            $this->addFlash(
                'info',
                'project enregistrée avec succes!'
            );
            return $this->redirectToRoute('projects');

        }
        return $this->render('project/project.html.twig', [
            'form' => $form->createView(),
            'projects' => $repository->findBy( array('BiceaAdmin' => $admin->getId()))
        ]);
    }

    /**
     * @Route("/edit/project/{id}", name ="edit_project")
     */
    public function edit_project($id, ProjectRepository $repository, Request $request,
                                 ObjectManager $manager, Utils $utils){
        $project = $repository->find($id);
        if ($project != null)
        {
            $form = $this->createForm(ProjectType::class,$project);
            if($request->isMethod('POST'))
            {
                $form->handleRequest($request);
                if($form->isValid())
                {
                    $manager->flush();
                    $this->addFlash(
                        'info',
                        'project modifiée avec succes!'
                    );
                    return $this->redirectToRoute('projects');
                }
            }
            return $this ->render('project/edit_project.html.twig',[
                'project'=>$project,
                'form' =>$form->createView()
            ]);

        }else
        {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('projects');

        }
    }

    /**
     * @Route("/delete/project/{id}", name ="delete_project")
     */
    public function delete_project($id, ProjectRepository $repository, ObjectManager $manager, Utils $utils){
        $project = $repository->find($id);
        if ($project != null)
        {
            $manager->remove($project);
            $manager->flush();
            $this->addFlash(
                'info',
                'project supprimée avec succes!'
            );
            return $this ->redirectToRoute('projects');
        }else
        {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('projects');
        }
    }

    /**
    * @Route("view/projects", name ="view_projects")
    */

    public function viewProjects(Request $request, BiceaAdminRepository $biceaAdminRepository,
                                 ProjectRepository $projectRepository, Utils $utils )
    {
        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        return $this->render('project/project_view.html.twig', [
            'projects' => $projectRepository->findBy( array('BiceaAdmin' => $admin->getId()))
        ]);
    }

    /**
     * @Route("tasks/project/{id}", name ="task_parameter")
     */

    public function taskParameter($id,Request $request, PrTaskRepository $prTaskRepository,
                      Utils $utils, BiceaAdminRepository $biceaAdminRepository)
    {
        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        return $this->render('project/tasks_parameters.html.twig', [
            'tasks' => $prTaskRepository->findBy(array('Project'=> $id , 'BiceaAdmin' => $admin->getId()))
        ]);

    }
}
