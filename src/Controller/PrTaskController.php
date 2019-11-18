<?php

namespace App\Controller;

use App\Entity\PrTask;
use App\Form\PrTaskType;
use App\Repository\BiceaAdminRepository;
use App\Repository\ProjectRepository;
use App\Repository\PrTaskRepository;
use App\Service\Utils;
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
                          BiceaAdminRepository $biceaAdminRepository, Utils $utils)
    {
        $task = new PrTask();
        //get admin current
        $admin = $utils->getAdmin($request,$biceaAdminRepository);

        $form = $this->createForm(PrTaskType::class, $task, array('idAdmin' => $admin->getId()));
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid()){
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
        return $this->render('pr_task/pr_task.html.twig', [
            'form' => $form->createView(),
            'tasks' => $repository->findBy( array('BiceaAdmin' => $admin->getId()))
        ]);
    }

    /**
     * @Route("/edit/pr/task/{id}", name ="edit_pr_task")
     */
    public function edit_project($id, PrTaskRepository $repository, Request $request,
                                 ObjectManager $manager, Utils $utils){
        $task = $repository->find($id);
        if ($task != null){
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
        }else{
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('tasks');
        }
    }

    /**
     * @Route("/delete/pr/task/{id}", name ="delete_pr_task")
     */
    public function delete_project($id, PrTaskRepository $repository, ObjectManager $manager, Utils $utils){
        $task = $repository->find($id);
        if ($task != null){
            $manager->remove($task);
            $manager->flush();
            $this->addFlash(
                'info',
                'tache supprimée avec succes!'
            );
            return $this ->redirectToRoute('tasks');
        }else
        {
            $this->addFlash(
                $utils->messageObjetNotFound()[0],
                $utils->messageObjetNotFound()[1]
            );
            return $this->redirectToRoute('tasks');
        }

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
