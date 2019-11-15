<?php

namespace App\Controller;

use App\Entity\PrTask;
use App\Form\PrTaskType;
use App\Repository\BiceaAdminRepository;
use App\Repository\ProjectRepository;
use App\Repository\PrTaskRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrTaskController extends AbstractController
{
    /**
     * @Route("/pr/task", name="tasks")
     */
    public function task( Request $request,  ObjectManager $manager, PrTaskRepository $repository,
                          BiceaAdminRepository $biceaAdminRepository)
    {
        $task = new PrTask();

        //get admin current
        $adminCurrent = $request->getSession()->get('administrator')->getId();
        if ($adminCurrent != Null){
            $admin = $biceaAdminRepository->find($adminCurrent);
        }else{
            $userCurrent = $request->getSession()->get('user');
            $BiceaAdmin = $userCurrent->getBiceaAdmin();
            $admin = $biceaAdminRepository->fin($BiceaAdmin);
        }

        $form = $this->createForm(PrTaskType::class, $task, array('idAdmin' => $admin->getId()));
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
            $task->setBiceaAdmin($admin);
            $task->setCreatedAt(new \DateTime('now') );
            $task->setIsDoing(0);
            $task->setIsFinished(0);
            $manager->persist($task);
            $manager->flush();
            $this->addFlash(
                'info',
                'Taches enregistrée avec succes!'
            );
            return $this->redirectToRoute('tasks');

        }


        $admin_id = $biceaAdminRepository->find($request->getSession()->get('administrator')->getId());
        $tasks = $repository->findBy( array('BiceaAdmin' => $admin_id->getId()));

        return $this->render('pr_task/pr_task.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/edit/pr/task/{id}", name ="edit_pr_task")
     */
    public function edit_project($id, PrTaskRepository $repository, Request $request, ObjectManager $manager){
        $task = $repository->find($id);
        $form = $this->createForm(PrTaskType::class,$task);
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $manager->flush();
                $this->addFlash(
                    'info',
                    'Tâche modifiée avec succes!'
                );
                return $this->redirectToRoute('tasks');
            }
        }
        return $this ->render('pr_task/edit_pr_task.html.twig',[
            'task'=>$task,
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/delete/pr/task/{id}", name ="delete_pr_task")
     */
    public function delete_project($id, PrTaskRepository $repository, ObjectManager $manager){
        $task = $repository->find($id);
        $manager->remove($task);
        $manager->flush();
        $this->addFlash(
            'info',
            'tache supprimée avec succes!'
        );
        return $this ->redirectToRoute('projects');
    }

    /**
     * @Route("start/task/{id}", name ="startTask")
     */
    public function startTask($id, PrTaskRepository $prTaskRepository, ObjectManager $manager){
        $prTask = $prTaskRepository->find($id);

        if ($prTask->getIsDoing() == 0 ){
            $prTask->setIsDoing(1);
            $manager->flush();
            return $this->redirectToRoute('task_parameter', array('id' => $prTask->getProject()->getId() ));
        }else{
            $prTask->setIsDoing(0);
            $manager->flush();
            return $this->redirectToRoute('task_parameter', array('id' => $prTask->getProject()->getId() ));
        }
    }

    /**
     * @Route("end/task/{id}", name ="endTask")
     */
    public function endTask($id, Request $request, PrTaskRepository $prTaskRepository, ObjectManager $manager){
        $prTask = $prTaskRepository->find($id);
        if ($prTask->getIsFinished() == 0 ){
            $prTask->setIsFinished(1);
            $prTask->setIsDoing(1);
            $manager->flush();
            return $this->redirectToRoute('task_parameter', array('id' => $prTask->getProject()->getId() ));
        }else{
            $prTask->setIsFinished(0);
            $prTask->setIsDoing(0);
            $manager->flush();
            return $this->redirectToRoute('task_parameter', array('id' => $prTask->getProject()->getId() ));
        }
    }

}
