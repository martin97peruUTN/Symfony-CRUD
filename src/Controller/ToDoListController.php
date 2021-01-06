<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index(): Response
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy([],["id"=>"DESC"]);
        return $this->render("index.html.twig",["tasksitas"=>$tasks]);
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $title=trim($request->request->get("title"));
        if(empty($title)){
            return $this->redirectToRoute("to_do_list");
        }
        $entityManager = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setTitle($title);
        $entityManager->persist($task);
        $entityManager->flush();
        return $this->redirectToRoute("to_do_list");
    }

    /**
     * @Route("/switch-status/{id}", name="switch_status")
     */
    public function switchStatus($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)->find($id);
        $task->setStatus(!$task->getStatus());
        $em->persist($task);
        $em->flush();
        return $this->redirectToRoute("to_do_list");
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)->find($id);
        $em->remove($task);
        $em->flush();
        return $this->redirectToRoute("to_do_list");
    }
}
