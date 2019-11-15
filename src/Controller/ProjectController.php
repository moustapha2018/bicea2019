<?php

namespace App\Controller;

use App\Entity\BiceaAdmin;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\BiceaAdminRepository;
use App\Repository\ProjectRepository;
use App\Repository\PrTaskRepository;
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
                                 BiceaAdminRepository $biceaAdminRepository)
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){

            //get admin current
            $adminCurrent = $request->getSession()->get('administrator')->getId();
            if ($adminCurrent != Null){
                $admin = $biceaAdminRepository->find($adminCurrent);
            }else{
                $admin_idUser = $request->getSession()->get('user')->getBiceaAdmin();
                $admin = $biceaAdminRepository->fin($admin_idUser);
            }
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


        $admin_id = $biceaAdminRepository->find($request->getSession()->get('administrator')->getId());
        $projects = $repository->findBy( array('BiceaAdmin' => $admin_id->getId()));

        return $this->render('project/project.html.twig', [
            'form' => $form->createView(),
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/edit/project/{id}", name ="edit_project")
     */
    public function edit_project($id, ProjectRepository $repository, Request $request, ObjectManager $manager){
        $project = $repository->find($id);
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
    }

    /**
     * @Route("/delete/project/{id}", name ="delete_project")
     */
    public function delete_project($id, ProjectRepository $repository, ObjectManager $manager){
        $project = $repository->find($id);
        $manager->remove($project);
        $manager->flush();
        $this->addFlash(
            'info',
            'project supprimée avec succes!'
        );
        return $this ->redirectToRoute('projects');
    }

    /**
    * @Route("view/projects", name ="view_projects")
    */
    public function viewProjects(Request $request, BiceaAdminRepository $biceaAdminRepository,ProjectRepository $projectRepository )
    {

        $adminCurrent = $request->getSession()->get('administrator');
        if ($adminCurrent != null){
            $admin_id = $biceaAdminRepository->find($adminCurrent->getId());
            $projects = $projectRepository->findBy( array('BiceaAdmin' => $admin_id->getId()));
        }else{
            $userCurrent = $request->getSession()->get('user');
            if ($userCurrent != null){
                $idAdmin = $userCurrent->getBiceaAdmin();
                $projects = $projectRepository->findBy( array('BiceaAdmin' => $idAdmin->getId()));
            }
        }


        return $this->render('project/project_view.html.twig', [
            'projects' => $projects
        ]);
    }

    /**
     * @Route("tasks/project/{id}", name ="task_parameter")
     */

    public function taskParameter($id,Request $request, PrTaskRepository $prTaskRepository,
                      ProjectRepository $projectRepository, BiceaAdminRepository $biceaAdminRepository)
    {
        $admin_id = $biceaAdminRepository->find($request->getSession()->get('administrator')->getId());
        $tasks = $prTaskRepository->findBy(array('Project'=> $id , 'BiceaAdmin' => $admin_id->getId()));
        return $this->render('project/tasks_parameters.html.twig', [
            'tasks' => $tasks
        ]);

    }
}
